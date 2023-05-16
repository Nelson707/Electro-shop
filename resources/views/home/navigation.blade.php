<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            @foreach($category as $category)
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="#"></a></li>
                <li><a href="#">{{ $category->category_name }}</a></li>
            </ul>
            @endforeach
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>