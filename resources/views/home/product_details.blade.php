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

<!-- NAVIGATION -->
@include('home.navigation')
<!-- /NAVIGATION -->

<div class="section">
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
                <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
        @endif
        <div class="row" style="display:flex; margin: auto">
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
