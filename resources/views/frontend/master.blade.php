<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">
    <base href="{{asset('')}}"/>
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="frontend/css/styles.css">
    <link rel="stylesheet" href="frontend/css/slick.css">
    <link rel="stylesheet" href="frontend/css/slick-theme.css">
    <!-- DataTables CSS -->
    <link href="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    @yield('style')
</head>

<body>
<header>
    <div class="main-menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/"><img width="250px" src="images/logo2.png" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-item active">
                            <a href="/" class="nav-link">Trang chủ</a>
                        </li>
                        <li class="navbar-item">
                            <a href="thuvien" class="nav-link">Thư viện</a>
                        </li>
                        <li class="navbar-item">
                            <a href="/gioithieu" class="nav-link">Giới thiệu</a>
                        </li>
                        <li class="navbar-item">
                            <a href="/cafe" class="nav-link">Cafe</a>
                        </li>
                        @if(Auth::check())
                            <li class="navbar-item">
                                <img width="20px" height="20px" style="border-radius: 50%;border: 1px solid;display: inline-block" src="{{asset('images/'.Auth::user()->hinhanh)}}" alt="">
                                <a href="@if(Auth::user()->level==0) /profile.html @else / @endif" class="nav-link" style="display: inline-block">{{Auth::user()->name}}</a>
                                <a href="logoutuser"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </li>
                        @else
                        <li class="navbar-item">
                            <a href="/login" class="nav-link">Login</a>
                        </li>
                            @endif
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <span class="fa fa-search"></span>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</header>
    @yield('content')
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="address">
                    <h4>Địa Chỉ</h4>
                    <h6>Đường Nghiêm Xuân Yêm - Đại Kim - Hoàng Mai - Hà Nội</h6>
                    <h6>SĐT : 800 1234 5678</h6>
                    <h6>Email : info@thanglong.edu.vn</h6>
                </div>
                <div class="timing">
                    <h4>Giờ mở cửa</h4>
                    <h6>Thứ hai - Thứ sáu: 7am - 10pm</h6>
                    <h6>Thứ bảy: 8am - 10pm</h6>
                    <h6>Chủ nhật: 8am - 11pm</h6>
                </div>
            </div>
            <div class="col-md-3">
                <div class="navigation">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li><a href="gioithieu">Giới thiệu</a></li>
                        <li><a href="thuvien">Cafe</a></li>
                        <li><a href="cafe">Sách</a></li>
                        <li><a href="register">Đăng ký</a></li>
                    </ul>
                </div>
                <div class="navigation">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="">Shipping & Returns</a></li>
                        <li><a href="frontend/privacy-policy.html">Privacy</a></li>
                        <li><a href="frontend/faq.html">FAQ’s</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Thang%20Long%20uni&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.bitgeeks.net/embed-google-map/">embed google map js</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:350px;width:350px;}</style></div>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>(C) 2017. All Rights Reserved. BookStore Wordpress Theme</h5>
                </div>
                <div class="col-md-6">
                    <div class="share align-middle">
                        <span class="fb"><i class="fa fa-facebook-official"></i></span>
                        <span class="instagram"><i class="fa fa-instagram"></i></span>
                        <span class="twitter"><i class="fa fa-twitter"></i></span>
                        <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                        <span class="google"><i class="fa fa-google-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="frontend/js/jquery.min.js"></script>
<script src="frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="frontend/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="frontend/js/slick.min.js"></script>
<script type="text/javascript" src="frontend/js/slick.js"></script>
<script src="frontend/js/custom.js"></script>
<!-- DataTables JavaScript -->
<script src="bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    @yield('script')
</body>

</html>