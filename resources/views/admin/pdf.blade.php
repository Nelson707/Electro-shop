<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Order Derails</h1>

Customer Name: <h4>{{ $order->name }}</h4>
Customer Email: <h4>{{ $order->email }}</h4>
Customer Phone: <h4>{{ $order->phone }}</h4>
Customer Address: <h4>{{ $order->address }}</h4>
Customer ID: <h4>{{ $order->user_id }}</h4>

Product Name: <h4>{{ $order->product_title }}</h4>
Product Quantity: <h4>{{ $order->quantity }}</h4>
Product Price: <h4>{{ $order->price }}</h4>
Product Payment_status: <h4>{{ $order->payment_status }}</h4>
Product ID: <h4>{{ $order->product_id }}</h4>

<br>
<img src="Product Images/{{ $order->image }}" height="250" width="250">
</body>
</html>