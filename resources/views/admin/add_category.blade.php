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
                    <h2 class="h3">Add Category</h2>

                    <form action="{{ url('/new_category') }}" method="post">

                        @csrf

                        <input class="form-control" type="text" name="category" placeholder="Enter Category">

                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category" style="margin-top: 5px; color: #000">
                    </form>
                </div>

                <h1 class="mx-auto" style="width: 200px; font-size: 30px">All Categories</h1>

                <table class="table">
                    <tr class="bg-info">
                        <td class="text-dark">#</td>
                        <td class="text-dark">Category Name</td>
                        <td class="text-dark">Action</td>
                    </tr>

                    @foreach($category as $category)

                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>
                                <a onclick="return confirm('Are you sure you want to delete the category?')" href="{{ url('delete_category',$category->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>

                    @endforeach

                </table>

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

