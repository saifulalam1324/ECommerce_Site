<!doctype html>
<html lang="en">

<head>
    <title>Order Shipped</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="container" style="background-color: #081621; color: white;">
            <h2>{{$customername}} Your Order Has Been Shipped!</h2>
            <p>Here are the details of your order:</p>
        </div>
        @php
            $grandtotal = $orderdetails->sum('total');
            $discountedtotal = $orderdetails->sum('discounted_tota')
        @endphp
        <div class="container card">
            @foreach ($orderdetails as $order)
                <span>Product Name : {{ $order->product_name }}</span>
                <br>
                <span>Quantity : {{ $order->quantity }}</span>
                <br>
                <span>Total : {{ number_format($order->total, 2) }}</span>
                <br>
                <span>Discounted Total : {{ number_format($order->discounted_tota, 2) }}</span>
                <br>
            @endforeach
        </div>
        <span style="font-weight: bold; background-color: #081621; color: white;">
            <span>Grand Total : {{ number_format($grandtotal, 2) }}</span>
            <br>
            <span>Discounted Total : {{ number_format($discountedtotal, 2) }}</span>
        </span>
        <p>Thank you for shopping with us!</p>
    </div>
</body>

</html>
