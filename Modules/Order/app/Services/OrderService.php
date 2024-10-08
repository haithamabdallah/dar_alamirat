<?php

namespace Modules\Order\Services;

use App\Models\Coupon;
use App\Models\Setting;
use Illuminate\Support\Str;
use Modules\Order\Models\Order;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Variant;
use Modules\Product\Models\Inventory;
use Modules\Shipping\Models\Shipping;
use Modules\Order\Models\OrderProduct;

class OrderService
{


    public function createOrder($validatedData)
    {
        $priceOfProduct = $this->getPriceOfProduct($validatedData['product_id']);
        $quantityOfProduct = $this->getQuantityOfProduct($validatedData['product_id']);

        if ($quantityOfProduct < $validatedData['quantity']) {
            throw new \Exception('Insufficient quantity in inventory.');
        }

        try {
            DB::beginTransaction();
            // $orderNumber = Str::uuid();
            // $orderNumber = Str::random(12);
            $part1 = rand(1000, 9999);
            $part2 = rand(1000, 9999);
            $part3 = rand(1000, 9999);
            $part4 = rand(1000, 9999);
            $orderNumber = $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4;
            // dd($orderNumber);
            $order = new Order();
            $order->order_number = $orderNumber;
            $order->user_id = $validatedData['user_id'];
            $order->shipping_id = $validatedData['shipping_id'];
            $order->save();


            $totalPrice = $validatedData['quantity'] * $priceOfProduct;

            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $validatedData['product_id'];
            $orderProduct->variant_id = $validatedData['variant_id'];
            $orderProduct->quantity = $validatedData['quantity'];
            // $orderProduct->price = $totalPrice;
            $orderProduct->price = $priceOfProduct;
            $orderProduct->save();
            // $orderProduct = $order->products()->create([
            //     'product_id' => $validatedData['product_id'],
            //     'variant_id' => $validatedData['variant_id'],
            //     'quantity' => $validatedData['quantity'],
            //     'price' => $totalPrice,
            // ]);


            // if(!$orderProduct){
            //     return "error";
            // }

            // Update inventory quantity
            $this->updateInventoryQuantity($validatedData['product_id'], $validatedData['quantity']);

            DB::commit();

            return $orderProduct;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /*
    ** store order made by checkout page
    */

    public function createCheckoutOrder($validatedData)
    {
        // $priceOfProduct = $this->getPriceOfProduct($validatedData['product_id']);

        try {

            
            $prices = Variant::lazy()->map(function ($variant) {
                return $variant->only(['priceWithDiscount', 'id']);
            })->keyBy('id')->toArray();
            
            DB::beginTransaction();
            // $orderNumber = Str::uuid();
            $part1 = rand(1000, 9999);
            $part2 = rand(1000, 9999);
            $part3 = rand(1000, 9999);
            $part4 = rand(1000, 9999);
            $orderNumber = $part1 . '-' . $part2 . '-' . $part3 . '-' . $part4;
            // dd($orderNumber);
            $order = new Order();
            $order->order_number = $orderNumber;
            $order->user_id = auth()->id();
            $order->shipping_id = $validatedData['shipping_id'];
            $order->user_address_id = $validatedData['address_id'];
            $order->coupon_id = $validatedData['coupon_id'];
            $order->save();

            $carts = auth()->user()->carts->loadMissing('product');

            // $sumOfDiscountedProducts = 0;
            // $sumOfUndiscountedProducts = 0;
            // dd($carts->pluck('variant_id'));
            foreach ($carts as $cart) {
                $quantityOfProduct = $this->getQuantityOfProduct($cart->product_id);

                $variantPrice =  $prices[$cart->variant_id]['priceWithDiscount'];

                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $cart->product_id;
                $orderProduct->variant_id = $cart->variant_id;
                if ($quantityOfProduct < $cart->quantity) {
                    $error = 'Insufficient quantity in inventory.';
                    $orderProduct->quantity = $quantityOfProduct;
                    // throw new \Exception('Insufficient quantity in inventory.');
                    $this->updateInventoryQuantity($cart->product_id, $quantityOfProduct);
                } else {
                    $orderProduct->quantity = $cart->quantity;
                    // Update inventory quantity
                    $this->updateInventoryQuantity($cart->product_id, $cart->quantity);
                }
                $orderProduct->price = $variantPrice;
                $orderProduct->save();
            }

            // $finalPrice = 0;

            $sumOfProductWithoutDiscount = 0;
            $sumOfProductWithDiscount = 0;

            foreach ($carts as $cart) {
                $variantPrice =  $prices[$cart->variant_id]['priceWithDiscount'];
                if ( isset($cart->product->discount_value) && $cart->product->discount_value > 0) {
                    $sumOfProductWithDiscount += $variantPrice * $cart->quantity;
                } else {
                    $sumOfProductWithoutDiscount += $variantPrice * $cart->quantity;
                }
            }

            $sumOfProductWithDiscount = round($sumOfProductWithDiscount, 2);
            $sumOfProductWithoutDiscount = round($sumOfProductWithoutDiscount, 2);
            $purchasePrice = $sumOfProductWithDiscount + $sumOfProductWithoutDiscount;
            
            if ($order->coupon_id != null) {

                $coupon = Coupon::where('id', $order->coupon_id)->firstOrFail();

                if ( 
                    $coupon->usage_count <= $coupon->usage_limit 
                && $coupon->status == true 
                && $coupon->user_usage_count <= $coupon->limit_per_user 
                && $coupon->start_date <= date('Y-m-d') 
                && $coupon->end_date >= date('Y-m-d') 
                && $coupon->min_purchase_limit <= $purchasePrice
                ) {
                    if ($coupon->discount_type == 'percent') {
                        $discount_value = round( $sumOfProductWithoutDiscount * $coupon->discount_value / 100 , 2) ; 
                    } else {
                        $discount_value = $coupon->discount_value;
                    }
                    $sumOfProductWithoutDiscount = $sumOfProductWithoutDiscount - $discount_value ;
                    $sumOfProductWithoutDiscount = round($sumOfProductWithoutDiscount, 2);

                    $coupon->users()->attach($order->user_id);

                    $coupon->usage_count += 1;
                    $coupon->save();
                }
            }

            $shipping = Shipping::where('id', $order->shipping_id)->first();
            $vat = Setting::where('type', 'general')?->first()?->value['vat'] ?? 0;

            $finalPrice = $sumOfProductWithoutDiscount + $sumOfProductWithDiscount;
            $finalPrice = round($finalPrice, 2);

            $vatValue = $finalPrice * $vat / 100;
            $finalPrice = $finalPrice + $vatValue;
            $finalPrice = round($finalPrice, 2);
            $finalPrice = $finalPrice + $shipping->price;
            $finalPrice = round($finalPrice, 2);

            $order->vat = "$vatValue ($vat %)";
            $order->shipping_price = $shipping->price;
            $order->final_price = $finalPrice;
            $order->save();

            // delete cart data
            $carts->each(function ($cart) {
                $cart->delete();
            });

            if (session()->has('coupon')) {
                session()->forget('coupon');
            }

            if (session()->has('cartsCount')) {
                session()->forget('cartsCount');
            }

            if (session()->has('cartTotal')) {
                session()->forget('cartTotal');
            }

            DB::commit();

            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function getPriceOfProduct($productId)
    {
        $variant = Variant::where('product_id', $productId)->first();
        return $variant->price;
    }

    protected function getQuantityOfProduct($productId)
    {
        $productList = Inventory::where('product_id', $productId)->first();
        return $productList->quantity;
    }

    protected function updateInventoryQuantity($productId, $quantity)
    {
        $productList = Inventory::where('product_id', $productId)->first();
        $productList->quantity -= $quantity;
        $productList->save();
    }
}
