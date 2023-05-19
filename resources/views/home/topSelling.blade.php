<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <!-- product -->
                                @foreach($product as $product)
                                    @if($product->tag == 'Top Selling')
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

                                                <div class="product-btns">
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <!-- /product -->

                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>