<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    @include('admin.css')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                    </div>
                @endif

                <div class="div_center">

                    <h1 class="h3">Add Product</h1>

                    <form action="{{ url('/create_product') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="div_design">
                            <label>Product Title :</label>
                            <input class="form-control" type="text" name="title" placeholder="Product Title" required>
                        </div>

                        <div class="div_design">
                            <label>Product Description :</label>
                            <textarea class="form-control" name="description" cols="20" rows="5"></textarea>
                        </div>

                        <div class="div_design">
                            <label>Product Price :</label>
                            <input class="form-control" type="number" name="product_price" placeholder="Product price" required>
                        </div>

                        <div class="div_design">
                            <label>Discount Price :</label>
                            <input class="form-control" type="number" name="dis_price" placeholder="Discount Price">
                        </div>

                        <div class="div_design">
                            <label>Product Quantity :</label>
                            <input class="form-control" type="number" name="product_quantity" placeholder="Product quantity" required>
                        </div>

                        <div class="div_design">
                            <label>Product Category :</label>
                            <select class="form-control" name="product_category" required>
                                <option value="" selected="">Add category here</option>

                                @foreach($category as $category)
                                    <option value="{{ $category->getAttributeValue('category_name') }}">{{ $category->getAttributeValue('category_name') }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="div_design">
                            <label>Product Image Here :</label>
                            <input type="file" name="image" required style="margin-top: 5px">
                        </div>

                        <div class="div_design">
                            <input type="submit" name="" value="Add Product" class="btn btn-primary text-black">
                        </div>


                    </form>

                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('admin.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

@include('admin.js')
</body>

</html>

