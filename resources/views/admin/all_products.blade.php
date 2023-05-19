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

                <h1 class="mx-auto h3" style="width: 200px; font-size: 20px">All Products</h1>

                <div class="table-responsive">
                    <table class="table">
                        <tr class="bg-info">
                            <th class="text-dark">#</th>
                            <th class="text-dark">Title</th>
                            <th class="text-dark">Description</th>
                            <th class="text-dark">Image</th>
                            <th class="text-dark">Category</th>
                            <th class="text-dark">Price</th>
                            <th class="text-dark">Discount Price</th>
                            <th class="text-dark">Quantity</th>
                            <th class="text-dark">Tag</th>
                            <th class="text-dark">Actions</th>
                        </tr>

                        @forelse($product as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <img src="/Product Images/{{ $product->image }}">
                                </td>
                                <td>{{ $product->category }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->tag }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ url('edit_product', $product->id) }}">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete this Product?')"  class="btn btn-danger" href="{{ url('delete_product', $product->id) }}">Delete</a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="16">
                                    No Records Found.
                                </td>
                            </tr>

                        @endforelse

                    </table>
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

