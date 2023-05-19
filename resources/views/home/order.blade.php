<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    @include('home.css')

</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-right">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role == '1')
                            <li><a href="{{url('/redirect')}}"></i> Dashboard</a></li>
                            <li><a href="{{url('/logout')}}"></i> Logout</a></li>
                        @else
                            <li><a href="{{url('/logout')}}"></i> Logout</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-user-o"></i> Sign Up</a></li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    @include('home.header')
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<div class="section">
    <div class="container">
        <div class="row">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                </div>
            @endif

            <table class="table">
                <tr class="bg-info">
                    <th class="text-dark">Product title</th>
                    <th class="text-dark">Quantity</th>
                    <th class="text-dark">Price</th>
                    <th class="text-dark">Image</th>
                    <th class="text-dark">Payment status</th>
                    <th class="text-dark">Delivery status</th>
                    <th class="text-dark">Cancel Order</th>
                </tr>

                @foreach($order as $order)
                    <tr>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>
                            <img src="Product Images/{{ $order->image }}" height="100" width="100">
                        </td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>
                            @if($order->delivery_status == 'Processing...')
                            <a href="{{url('cancel_order', $order->id)}}" onclick="return confirm('Are you sure you want to cancel this order')" class="btn btn-danger">Cancel order</a>
                            @else
                                <button type="button" class="btn btn-secondary btn-lg" disabled>Cancel Order</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<!-- FOOTER -->
@include('home.footer')
<!-- /FOOTER -->

@include('home.js')

</body>
</html>
