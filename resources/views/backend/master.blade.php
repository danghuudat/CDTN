<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    {{--<link rel="stylesheet" href="plugins/morris/morris.css">--}}
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet" />
    @yield('style')



</head>
<body class="hold-transition sidebar-mini">
<style>
    .sidebar-dark-primary{
        background-color: #7d6757;
    }
   .active1 {
        color: #fff;
        background-color: black;
    }

</style>
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>

        </ul>

        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="{{asset('login-asset/images/1.jpg')}}"  class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Cafe && Libary</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('images/'.Auth::user()->hinhanh)}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="admin/profile" class="d-block">{{Auth::user()->email}}</a>
                    <a href="#" class="d-block">{{Auth::user()->level==1 ? 'Quản lý' : 'Nhân viên'}}</a>

                </div>

            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview ">
                        <a href="/admin/ban" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Đặt đồ uống

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">

                        <a href="/admin/user" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Quản lý Sách
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="admin/book/theloai" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Thể Loại</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/book/nxb" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Nhà Xuất Bản</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/book/tacgia" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Tác giả</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/book" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Quản lý đồ uống
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="admin/theloai_douong" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Thể Loại</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/menu" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Đồ uống</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Mượn trả && Trả Sách
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="admin/muontrasach" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Danh sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/muontrasach/add" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Mượn Sách</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin/muontrasach/trasach" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Trả sách</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">

                        <a href="/admin/profile" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                ProFile

                            </p>
                        </a>
                    </li>
                    @if(Auth::user()->level==1)
                        <li class="nav-item">

                            <a href="admin/hoadonsach" class="nav-link">
                                <i class="nav-icon fas fa-coins"></i>
                                <p>

                                    Quản lý hóa đơn

                                </p>

                            </a>


                        </li>
                    <li class="nav-item">

                        <a href="admin/naptien/lichsu" class="nav-link">
                            <i class="nav-icon  fas fa-dollar-sign"></i>
                            <p>
                                Lịch sử nạp tiền

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">

                        <a href="admin/book/lsnhaphuy" class="nav-link">
                            <i class="nav-icon  fas fa-dollar-sign"></i>
                            <p>
                                Lịch sử nhập/hủy sách

                            </p>
                        </a>
                    </li>
                    <li class="nav-item">

                        <a href="admin/thongke" class="nav-link">
                            <i class="nav-icon  fas fa-box-open"></i>
                            <p>
                                Thống kê

                            </p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->level==2)
                    <li class="nav-item">

                        <a href="/admin/hoadonnv" class="nav-link">
                            <i class="nav-icon fas fa-coins"></i>
                            <p>
                                Hóa đơn đã tạo

                            </p>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">

                        <a href="/logout" class="nav-link">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                               LogOut

                            </p>
                        </a>
                    </li>



                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" >
                @yield('content')


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019 <a href="{{asset('/')}}">LightBook</a>.</strong>
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.0-alpha
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
{{--<script src="plugins/morris/morris.min.js"></script>--}}

{{--<script src="js/vue.js"></script>--}}
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery/moment.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="dist/js/pages/dashboard.js"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="js/select2.min.js"></script>


@yield('script')
<script>
    var url = window.location;
    var element = $('.mt-2 ul li  a').filter(function() {
        return this.href == url;
    }).addClass('active1').parent().parent().parent().addClass('menu-open').parent();
    if (element.is('li')) {
        element.addClass('active1');
    }
</script>
</body>
</html>
