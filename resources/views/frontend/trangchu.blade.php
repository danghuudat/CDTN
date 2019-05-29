@extends('frontend.master')
@section('content')
    <style>

    </style>
    <section class="slider">
        <div class="container">
            <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="slide">
                        <img src="frontend/images/slide1.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>Xin chào mừng đến với LightBook</h3>
                                <h5>Khám phá thế giới qua những cuốn sách và thưởng thức cafe</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="frontend/images/slide2.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>Xin chào mừng đến với LightBook</h3>
                                <h5>Khám phá thế giới qua những cuốn sách và thưởng thức cafe</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="frontend/images/slide3.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <div class="title">
                                    <h3>Xin chào mừng đến với LightBook</h3>
                                    <h5>Khám phá thế giới qua những cuốn sách và thưởng thức cafe</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="frontend/images/slide4.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="#" class="btn">shop books</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-sec">
        <div class="about-img">
            <figure style="background:url(./frontend/images/about-img.jpg)no-repeat;"></figure>
        </div>
        <div class="about-content">
            <h2>Giới thiệu về LightBook,</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. Lorem Ipsum has been the book. </p>
            <p>It has survived not only fiveLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and</p>
            <div class="btn-sec">
                <a href="frontend/about.html" class="btn yellow">Xem thêm</a>
                <a href="frontend/login.html" class="btn black">Đăng ký</a>
            </div>
        </div>
    </section>
    <section class="recent-book-sec">
        <div class="container">
            <div class="title">
                <h2>Những cuốn sách được mượn nhiều</h2>
                <hr>
                <img src="images/bor.png" alt="" style=" position: relative;z-index: 1;top: 20px;">
            </div>
            <div class="row">
                @foreach($sach as $s)
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="item">
                        <div style="margin: 0 15%; margin-bottom: 20px">
                            <img style="box-shadow: 10px 0px 5px 5px #c3c3c3;" width="120px" height="200px" src="{{asset('images/sach/'.$s->hinhanh)}}" alt="img">

                        </div>


                        <h3 style=" font-family: Arial;text-align: center"><a href="{{asset('thuvien/'.$s->name_slug_sach.'.html')}}" style="text-transform: capitalize;">{{$s->name_sach}}</a></h3>

                    </div>
                </div>
                @endforeach
            </div>
            <div class="btn-sec">
                <a href="{{asset('thuvien')}}" class="btn gray-btn">Xem thêm</a>
            </div>
        </div>
    </section>
    <section class="features-sec">
        <div class="container">
            <ul>
                <li>
                    <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <h3>Đăng ký gói vàng</h3>
                    <h5>Safe Shopping Guarantee</h5>
                    <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
                </li>
                <li>
                    <span class="icon return"><i class="fa fa-reply-all" aria-hidden="true"></i></span>
                    <h3>Đăng ký gói bạc</h3>
                    <h5>Moneyback guarantee</h5>
                    <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
                </li>
                <li>
                    <span class="icon chat"><i class="fa fa-comments" aria-hidden="true"></i></span>
                    <h3>Đăng ký gói đồng</h3>
                    <h5>online Consultations</h5>
                    <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
                </li>
            </ul>
        </div>
    </section>
    <section class="offers-sec" style="background:url(frontend/images/offers.jpg)no-repeat;">
        <div class="cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail">
                        <h3>Quảng cáo</h3>
                        <h6>We are now offering some good discount
                            on selected books go and shop them</h6>
                        <a href="frontend/products.html" class="btn blue-btn">Xem chi tiết</a>
                        <span class="icon-point percentage">
                            <img src="frontend/images/precentagae.png" alt="">
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail">
                        <h3>Quảng cáo</h3>
                        <h6>We are now offering some good discount
                            on selected books go and shop them</h6>
                        <a href="frontend/products.html" class="btn blue-btn">Xem chi tiết</a>
                        <span class="icon-point amount"><img src="frontend/images/amount.png" alt=""></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-sec">
        <div class="container">
            <div id="testimonal" class="owl-carousel owl-theme">
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-quote">
            <img src="frontend/images/left-quote.png" alt="quote">
        </div>
        <div class="right-quote">
            <img src="frontend/images/right-quote.png" alt="quote">
        </div>
    </section>
    @endsection
@section('script')

    @stop