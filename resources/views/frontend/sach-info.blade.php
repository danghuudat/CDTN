@extends('frontend.master')
@section('content')
    <style>
        .product-sec .slider-content ul {
            list-style: none;
            width: 100%;
            margin-bottom: 40px;
            float: left;
        }
        .product-sec .slider-content ul li span {
            width: 100%;
            font-weight: bold;
            display: inline-block;
        }

    </style>
    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="/">Trang Chủ</a>
            <a class="breadcrumb-item " href="/thuvien" style="text-transform: capitalize">Thư viện sách</a>
            <span class="breadcrumb-item active" style="text-transform: capitalize">{{$sach->name_sach}}</span>
        </div>
    </div>
    <section class="product-sec">
        <div class="container">
            <h1>{{$sach->name_sach}}</h1>
            <div class="row">
                <div class="col-md-6 slider-sec">
                    <!-- main slider carousel -->
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
                            <div class="active item carousel-item" data-slide-number="0">
                                <img src="{{asset('images/sach/'.$sach->hinhanh)}}"  class="img-fluid">
                            </div>
                            <div class="item carousel-item" data-slide-number="1">
                                <img src="{{asset('images/sach/'.$sach->hinhanh)}}" class="img-fluid">
                            </div>
                            <div class="item carousel-item" data-slide-number="2">
                                <img src="{{asset('images/sach/'.$sach->hinhanh)}}" class="img-fluid">
                            </div>
                        </div>
                        <!-- main slider carousel nav controls -->
                        <ul class="carousel-indicators list-inline">
                            <li class="list-inline-item active">
                                <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">
                                    <img width="100px" src="{{asset('images/sach/'.$sach->hinhanh)}}" class="img-fluid">
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a id="carousel-selector-1" data-slide-to="1" data-target="#myCarousel">
                                    <img width="100px" src="{{asset('images/sach/'.$sach->hinhanh)}}" class="img-fluid">
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a id="carousel-selector-2" data-slide-to="2" data-target="#myCarousel">
                                    <img width="100px" src="{{asset('images/sach/'.$sach->hinhanh)}}" class="img-fluid">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--/main slider carousel-->
                </div>
                <div class="col-md-6 slider-content">
                    <ul>
                        <li>
                            <span >Tác giả : <a href="{{asset('tacgia/'.$sach->tacgia->slug_name_tg.'.html')}}">{{$sach->tacgia->name_tg}}</a> </span>

                        </li>
                        <li>
                            <span >Nhà Xuất Bản : <a href="{{asset('nhaxuatban/'.$sach->nhaxuatban->slug_name_nxb.'.html')}}">{{$sach->nhaxuatban->name_nxb}}</a></span>
                        </li>
                        <li>
                            <span >Thể loại : <a href="{{asset('theloaisach/'.$sach->theloai->slug_name_tl.'.html')}}">{{$sach->theloai->name_tl}}</a></span>
                        </li>
                        <li>
                            <span>Năm xuất bản: <a href="{{asset('namxb/'.$sach->namxb.'.html')}}">{{$sach->namxb}}</a></span>
                        </li>
                        <li>
                            <span>Số lượt mượn: {{$sach->solanmuon}}</span>
                        </li>
                        <li>
                            <span>Giới thiệu :</span>
                            <p style="text-align: justify;font-size: 14px">{{$sach->mieuta}}</p>
                        </li>

                    </ul>
                    <div class="btn-sec">
                        <button class="btn ">Đặt mượn sách</button>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-books">
        <div class="container">
            <h2>Sách liên quan Bạn có thể thích</h2>
            <div class="recomended-sec">
                <div class="row">
                    @foreach($sachlq as $slq)
                    <div class="col-lg-3 col-md-6">
                        <a href="{{asset('thuvien/'.$slq->name_slug_sach.'.html')}}">
                            <div class="item">
                                <img width="120px" src="{{asset('images/sach/'.$slq->hinhanh)}}" alt="img">
                                <h3>{{$slq->name_sach}}</h3>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endsection