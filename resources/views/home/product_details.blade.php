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
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{url('/')}}" class="logo">
                            <img src="/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">3</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product01.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>

                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="./img/product02.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                            <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>
                                </div>
                                <div class="cart-summary">
                                    <small>3 Item(s) selected</small>
                                    <h5>SUBTOTAL: $2940.00</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="#">View Cart</a>
                                    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
@include('home.navigation')
<!-- /NAVIGATION -->

<div class="section">
    <div class="container">
        <div class="row" style="display:flex; margin: auto">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                </div>
            @endif

            <div class="col">
                <img src="/Product Images/{{$product->image}}" alt="" width="500" height="400">
            </div>

            <div class="col" style="margin-left: 10px; width: 30%; padding: 10px;">
                <h3>
                    {{ $product->title }}
                </h3>

                @if($product->discount !=null)

                    <h4 style="color: red">
                        Ksh.{{ $product->discount }}
                    </h4>

                    <h4 style="text-decoration: line-through">
                        Ksh.{{ $product->price }}
                    </h4>

                @else

                    <h4 style="color: dodgerblue">
                        Ksh.{{ $product->price }}
                    </h4>

                @endif

                <h5>
                    Category: {{ $product->category }}
                </h5>

                <h5 style="margin-right: 10px">
                    Details: {{ $product->description }}
                </h5>

                <h5>
                    In Stock: {{ $product->quantity }}
                </h5>

                <form action="{{ url('add_cart',$product->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="number" name="quantity" value="1" min="1" style="width: 100px; padding: 10px">
                        </div>

                        <div class="col-md-4">
                            <input type="submit" value="Add to Cart" style="padding: 10px" class="btn btn-warning">
                        </div>
                    </div>

                </form>
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
