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

<!-- SECTION -->

<!-- /SECTION -->

<!-- SECTION -->
@include('home.newProducts')
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->

<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
@include('home.topSelling')
<!-- /SECTION -->

<!-- SECTION -->

<!-- /SECTION -->

<!-- NEWSLETTER -->
@include('home.newsletter')
<!-- /NEWSLETTER -->

<!-- FOOTER -->
@include('home.footer')
<!-- /FOOTER -->

@include('home.js')

</body>
</html>
