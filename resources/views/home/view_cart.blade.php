<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    @include('home.css')

    <style>
        .cart_img{
            height: 100px;
            width: 100px;
        }
    </style>

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

<!-- NAVIGATION -->
@include('home.navigation')
<!-- /NAVIGATION -->
<div class="section">
    <div class="container">
        <div class="row">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                </div>
            @endif

                <div>
                    <h4>Cart({{ $total_cart }})</h4>
                </div>

            <table class="table">
                <tr>
                    <th>Product Title</th>
                    <th>Product Quantity</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Product Actions</th>
                </tr>

                <?php $totalPrice = 0 ?>
                @foreach($cart as $cart)
                <tr>
                    <td>{{ $cart->product_title }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>Ksh. {{ $cart->price }}</td>
                    <td><img class="cart_img" src="/Product Images/{{ $cart->image }}"></td>
                    <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product ?')" href="{{url('remove_cart', $cart->id)}}">Remove Product</a></td>
                </tr>
                <?php $totalPrice = $totalPrice + $cart->price?>
                @endforeach
            </table>

            <div>
                <h3>Cart Summary</h3>
                <h4>Total Price: Ksh. {{ $totalPrice }}</h4>
            </div>

            <div>
                <h4>Proceed to order</h4>
                <a href="{{url('cash_order')}}" class="btn btn-success">Cash On Delivery</a>
                <a href="{{url('stripe', $totalPrice)}}" class="btn btn-warning">Pay With Card</a>
            </div>
        </div>
    </div>
</div>

<!-- NEWSLETTER -->
@include('home.newsletter')
<!-- /NEWSLETTER -->

<!-- FOOTER -->
@include('home.footer')
<!-- /FOOTER -->

@include('home.js')

</body>
</html>
