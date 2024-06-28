{{-- نفس الداتا المبعوتة في صفحة 
my-order-detials.blade.php
path => /my-orders/1
في بداية الصفحة اكتب التالي
@php
  dd($order);
@endphp
--}}