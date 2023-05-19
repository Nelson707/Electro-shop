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
                    <form action="{{url('search_home')}}" method="get">
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