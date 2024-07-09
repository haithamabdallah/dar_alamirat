{{-- نفس الداتا المبعوتة في صفحة
my-order-detials.blade.php
path => /my-orders/1
في بداية الصفحة اكتب التالي
@php
  dd($order);
@endphp
--}}
{{--@php
    dd($order);
@endphp

<main>
    <h1>{{ __("Order") }}</h1>
    <div class="bg-white p-4 my-4 shadow rounded">
        <div> {{ __("Order Status") }} : <span>{{ $order->status }}</span> </div>
        <div> {{ __("Final Price") }} : <span>{{ $order->final_price }}</span> </div>
        <div> {{ __("Order Payment Status") }} : <span>{{ $order->payment_status }}</span> </div>
        <div> {{ __("Order Payment Method") }} : <span> Cash On Delivery</span> </div>
        @php
            $address = $order->userAddress;
        @endphp
        <div> {{ __("Order Address") }} :
            <ul>
                <li> {{ __("Governorate") }} : {{ $address->governorate }}</li>
                <li> {{ __("City") }}: {{ $address->city }}</li>
                <li> {{ __("Street") }} : {{ $address->street }}</li>
                <li> {{ __("House Number") }} : {{ $address->house_number }}</li>
            </ul>
        </div>
        @if ($order?->coupon)
            <div> {{ __("Applied Coupon") }} :
                <ul>
                    <li>{{ __("Code") }} : {{ $order->coupon->code }}</li>
                    <li>{{ __("Type") }} : {{ $order->coupon->discount_type }}</li>
                    <li>{{ __("Value") }} : {{ $order->coupon->discount_value }}</li>
                </ul>
            </div>
        @endif
    <!-- order products -->
        @foreach ($order->orderDetails as $orderDetials)

            <div> {{ __("Product Name") }} : <a href="{{ route('product', $orderDetials->product->id) }}"
                                                target="_blank">
                                    <span>{{ $orderDetials->product->title }} (
                                        {{ $orderDetials->variant->variant_name }} )</span>
                </a> </div>
            <div> {{ __("Variant") }} : <span> {{ $orderDetials->variant->variant_name }}
                                </span> </div>
            <div> {{ __("Variant SKU") }}: <span>
                                    {{ $orderDetials->variant->sku }} </span> </div>
            <div> {{ __("Unit Price") }} : <span>{{ $orderDetials->price }}</span> </div>
            <div>{{ __("Quantity") }} : <span>{{ $orderDetials->quantity }}</span> </div>
            <div> {{ __("Total Price") }} :
                <span>{{ $orderDetials->price * $orderDetials->quantity }}</span>
            </div>
        @endforeach
    </div>
</main>--}}
