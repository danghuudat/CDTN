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
                            <a href="/Giới thiệu" class="nav-link">Giới thiệu</a>
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

                </div>
            </nav>
        </div>
    </div>
</header>
    @yield('content')
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="navigation">
                    <h4>Navigation</h4>
                    <ul style="">
                        <li><h6><a href="/" style="font-size: 16px !important;" >Trang chủ</a></h6></li>
                        <li><h6><a href="" style="font-size: 16px !important;">Giới thiệu</a></h6></li>
                        <li><h6><a href="/thuvien" style="font-size: 16px !important;">Thư viện</a></h6></li>
                        <li><h6><a href="/cafe" style="font-size: 16px !important;">Cafe</a></h6></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="address" style="line-height: 0 !important;">
                    <h4>Thông tin liên hệ</h4>
                    <h6 style="margin-bottom:0px !important;">Đường Nghiêm Xuân Yêm - Đại Kim - Hoàng Mai - Hà Nội</h6>
                    <h6 style="margin-bottom:0px !important;">Phone : (84-24) 38 58 73 46 </h6>
                    <h6 style="margin-bottom:0px !important;">Email : info@thanglong.edu.vn </h6>
                </div>
                <div class="timing">
                    <h4>Timing</h4>
                    <h6>Mon - Sat: 7am - 10pm</h6>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Thanglong%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.pureblack.de"></a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:300px;}</style></div>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>(C) 2019. All Rights Reserved. Lightbook</h5>
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