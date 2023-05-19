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
                        <form action="{{url('search_accessories')}}" method="get">
                            @csrf
                            <select class="input-select">
                                <option value="0">All Categories</option>
                            </select>
                            <input class="input" name="search" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Cart -->

                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">{{ $total_cart }}</div>
                            </a>

                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    <?php $totalPrice = 0 ?>
                                    @foreach($cart as $cart)
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="/Product Images/{{ $cart->image }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name">{{ $cart->product_title }}</h3>
                                                <h4 class="product-price"><span class="qty">{{ $cart->quantity }}</span>Ksh. {{ $cart->price }}</h4>
                                            </div>
                                        </div>
                                            <?php $totalPrice = $totalPrice + $cart->price?>
                                    @endforeach
                                </div>


                                <div class="cart-summary">
                                    <small>{{ $total_cart }} Item(s) selected</small>
                                    <h5>SUBTOTAL KSH: {{ $totalPrice }}</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="{{url('show_cart')}}">View Cart</a>
                                    <a href="{{url('stripe', $totalPrice)}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- /Cart -->

                        <!-- Order -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                {{--                            <span>Your Order</span>--}}
                                <a href="{{url('show_order')}}">Your Order</a>
                                {{--                            <div class="qty">2</div>--}}
                            </a>
                        </div>
                        <!-- /Order -->

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
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Accessory</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <!-- product -->
                                @foreach($product as $product)
                                    @if($product->category == 'Accessory')
                                        <div class="product">
                                            <div class="product-img">
                                                <img src="Product Images/{{$product->image}}" height="250" width="400">
                                                <div class="product-label">
                                                    <span class="new">{{ $product->tag }}</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category }}</p>
                                                <h3 class="product-name"><a href="{{url('product_details', $product->id)}}">{{ $product->title }}</a></h3>
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

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <!-- /product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
    </div>
</div>

<!-- FOOTER -->
@include('home.footer')
<!-- /FOOTER -->

@include('home.js')

</body>
</html>
