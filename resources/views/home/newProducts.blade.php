<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        @foreach($category as $category)
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#"></a></li>
                            <li><a data-toggle="tab" href="#">{{ $category->category_name }}</a></li>
                        </ul>
                        @endforeach
                    </div>
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
                                    @if($product->tag == 'New')
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
        <!-- /row -->
    </div>
    <!-- /container -->
</div>