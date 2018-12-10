<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="/favicon.ico">

    @yield('title')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/my_style.css') }}">
    @yield('css')
</head>
<body>
@yield('header')
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="#">
                    <h1>Shop - Đồ Chơi</h1>
                    {{--{{ config('app.name', 'Shop-Online') }}--}}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav ">
                    <!-- Authentication Links -->
                    <li><a href="#" class="btn btn-block">Khách Hàng</a></li>
                    <li><a href="#">Giao Dịch</a></li>
                    <li><a href="#">Chi Tiêu</a></li>
                    <li><a href="#">Chấm Công</a></li>
                    <li><a href="#" class="btn btn-block">Nhân Viên</a></li>
                    <li><a href="#">Sản Phẩm</a></li>
                    <li><a href="#">Dịch Vụ</a></li>
                    <li><a href="#">Thống Kê</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container">
    @yield('content')
</div>
@include('admin.layouts.footer')
@yield('item_clone')

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('script')

</body>
</html>