<?php

namespace Modules\Order\Services;

use Illuminate\Support\Str;
use Modules\Order\Models\Order;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Variant;
use Modules\Product\Models\Inventory;
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
            $orderNumber = Str::uuid();
       //     dd($orderNumber);
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
            $orderProduct->price = $totalPrice;
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
