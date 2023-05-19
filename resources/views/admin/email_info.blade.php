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
                <h2 class="text-center">Send Email to: {{ $order->email }}</h2>

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                        <button type="button" class="close" style="float: right;" data-dismiss="alert" aria-hidden="true">X</button>
                    </div>
                @endif

                <form action="{{ url('send_user_email', $order->id) }}" method="post">
                    @csrf
                    <div>
                        <label>Email Greeting: </label>
                        <input class="form-control" type="text" placeholder="Email Greeting" name="greeting">
                    </div>

                    <div>
                        <label>Email First Line: </label>
                        <input class="form-control" type="text" placeholder="First Line" name="firstLine">
                    </div>

                    <div>
                        <label>Email Body: </label>
                        <textarea class="form-control" type="text" placeholder="body" name="body"></textarea>
                    </div>

                    <div>
                        <label>Email Button Name: </label>
                        <input class="form-control" type="text" name="button">
                    </div>

                    <div>
                        <label>Email Url: </label>
                        <input class="form-control" type="text" placeholder="url" name="url">
                    </div>

                    <div>
                        <label>Email Last Line: </label>
                        <input class="form-control" type="text" placeholder="Last Line" name="lastLine">
                    </div>

                    <div class="mt-3">
                        <input type="submit" value="Send Email" class="btn btn-info" style="color: black">
                    </div>

                </form>
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

