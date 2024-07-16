{{-- نفس الداتا المبعوتة في صفحة
my-order-detials.blade.php
path => /my-orders/1
في بداية الصفحة اكتب التالي
@php
  dd($order);
@endphp
--}}

{{--<main>
    <h1>{{ __("Order") }}</h1>
    <div class="bg-white p-4 my-4 shadow rounded">
        --}}{{-- <div> {{ __("Order Status") }} : <span>{{ $order->status }}</span> </div>
        <div> {{ __("Order Payment Status") }} : <span>{{ $order->payment_status }}</span> </div> --}}{{--
        <div> {{ __("Order Number") }} : <span>{{ $order->order_number }}</span> </div>
        <div> {{ __("Date") }} : <span>{{ $order->created_at->format('Y-m-d') }}</span> </div>
        <div> {{ __("Time") }} : <span>{{ $order->created_at->format('h:i A') }}</span> </div>
        <div> {{ __("Final Price") }} : <span>{{ $order->final_price }}</span> </div>
        <div> {{ __("Order Payment Method") }} : <span> {{ __("Cash On Delivery") }} </span> </div>
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
        @foreach ($order->orderDetails as $orderDetails)

            <a href="{{ asset($orderDetails->product->thumbnail) }}" target="_blank" >
                <img src="{{ $message->embed( asset($orderDetails->product->thumbnail) ) }}" class="mw-100 mh-100" />
            </a>

            <div> {{ __("Product Name") }} : <a href="{{ route('product', $orderDetails->product->id) }}"
                                                target="_blank">
                                    <span>{{ $orderDetails->product->title }} (
                                        {{ $orderDetails->variant->variant_name }} )</span>
                </a> </div>
            <div> {{ __("Variant") }} : <span> {{ $orderDetails->variant->variant_name }}
                                </span> </div>
            <div> {{ __("Variant SKU") }}: <span>
                                    {{ $orderDetails->variant->sku }} </span> </div>
            <div> {{ __("Unit Price") }} : <span>{{ $orderDetails->price }}</span> </div>
            <div>{{ __("Quantity") }} : <span>{{ $orderDetails->quantity }}</span> </div>
            <div> {{ __("Total Price") }} :
                <span>{{ $orderDetails->price * $orderDetails->quantity }}</span>
            </div>
        @endforeach
    </div>
</main>--}}

<div style="max-width: 600px; margin: 0 auto; overflow: hidden; ">
    <div style="padding: 20px; display: block; overflow: hidden; margin-bottom: 10px;">
        <img src="{{ $message->embed( asset( '/storage/' . $settings->where( 'type', 'general' )->first()->value['logo_path'] ) ) }}"  alt="" style="width: 80px; height: 80px; display: inline-block; float:left; padding-right: 20px; border-right: 1px solid #707070;">
        <div style="display: inline-block; float:left; margin-left: 20px;">
            <h6 style="font-size: 18px; font-weight: bold; color: #000;margin: 0; margin-bottom: 5px; text-transform: capitalize;">{{ $settings->where( 'type', 'general' )->first()->value['website_name'] }}</h6>
            <p style="font-size: 12px; font-weight: normal; line-height: 12px; color: #707070;max-width: 160px;">{{ $settings->where( 'type', 'general' )->first()->value['website_address'] }}</p>
        </div>
    </div>

    <div style="display: block; text-align: center">
        <h3 style="max-width:200px; margin: 20px auto;text-transform: uppercase; font-size: 20px; font-weight: bold; border-bottom: 1px solid #eee; padding-bottom: 15px; color: #000;">Dear Customer,</h3>
        <h4 style="color: #0b9f5b; font-size: 18px; text-transform: uppercase;font-weight: bold;">Thanks You</h4>
        <p style="font-size: 12px; text-transform: uppercase; color: #2d2d2d;">FOR YOUR RECENT Daaralamirat PURCHASE.</p>

        <div style="min-width:200px;max-width:400px;margin: 20px auto;font-size: 16px; font-weight: bold; border: 1px solid #707070; color: #707070; padding: 10px 20px; display: block; text-transform: uppercase;">Order Number: {{ $order->order_number }}</div>

    </div>

    <p style="margin: 30px 0;font-size: 12px; font-weight: normal; line-height: 14px; color: #707070; text-align: center;">We strive to make our products meet your expectations and welcome any feedback you may have to meet this goal. Should you have any questions or require assistance, please do not hesitate to contact us by visiting {{ config('app.url') }}/contact.</p>

    <table style="font-size: 16px;line-height: 16px; width: 100%; float: left; border-collapse: collapse; color: #000;">
        @foreach ($order->orderDetails as $orderDetails)
        <tr style="border: 1px solid #707070;">
            <td style="width: 10%"><img src="{{ $message->embed( asset($orderDetails->product->thumbnail) ) }}" alt="" style="width: 50px;height: 50px;padding: 5px;"></td>
            <td style="width: 65%;padding: 5px;"><a href="{{ route('product', $orderDetails->product->id) }}">{{ $orderDetails->product->title }} (
                    {{ $orderDetails->variant->variant_name }} )</a></td>
            <td style="width: 5%;border: 1px solid #707070; text-align: center">{{ $orderDetails->quantity }}</td>
            <td style="width: 15%; text-align: right; padding: 5px;border: 1px solid #707070;">{{ $orderDetails->price }}</td>
        </tr>
        @endforeach

        @if ($order?->coupon)
        <tr style="text-align: right">
            <td colspan="2"></td>
            <td style="padding: 10px;">Applied Coupon:</td>
            <td style="padding: 10px;">{{  $order->coupon->discount_type == 'percent' ?  $order->coupon->discount_value . ' %' : $order->coupon->discount_value  }}</td>
        </tr>
        @endif
        @if ( $settings->keyBy('type')['general']->value['vat'] > 0 )
            <tr style="text-align: right">
                <td colspan="2"></td>
                <td style="padding: 10px;">Vat:</td>
                <td style="padding: 10px;">{{ $order->vat }}</td>
            </tr>
        @endif
        <tr style="text-align: right">
            <td colspan="2"></td>
            <td style="padding: 10px;">Shipping Price:</td>
            <td style="padding: 10px;">{{ $order->shipping_price }}</td>
        </tr>
        <tr style="text-align: right">
            <td colspan="2"></td>
            <td style="padding: 10px;">Final Price:</td>
            <td style="padding: 10px;">{{ $order->final_price }}</td>
        </tr>
    </table>

    <table style="margin: 30px 0; width: 100%; color: #000;">
        <tr>
            <td>Order Payment Method:</td>
        </tr>
        <tr style="border-bottom: 1px solid #707070;">
            <td style="text-indent: 1rem">Cash On Delivery</td>
        </tr>
    </table>
    @php
        $address = $order->userAddress;
    @endphp
    <table style="margin: 30px 0; width: 100%; color: #000;">
        <tr>
            <td>Order Address:</td>
        </tr>
        <tr>
            <td style="padding: auto 1rem"> 
                <p style="text-indent: 1rem">Governorate : {{ $address->governorate }},</p> 
                <p style="text-indent: 1rem">City: {{ $address->city }}, </p> 
                <p style="text-indent: 1rem">Street : {{ $address->street }}, </p> 
                <p style="text-indent: 1rem">House Number : {{ $address->house_number }} </p> 
                <p style="text-indent: 1rem">Phone : {{ $address->phone1 }}, {{ $address->phone2 }} </p>
            </td>
        </tr>
    </table>

</div>
