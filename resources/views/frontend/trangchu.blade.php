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
            <p>Đam mê đọc sách có thể trở thành một nguồn thúc đẩy lớn hướng bạn đi tới con đường đúng đắn. Còn hơn thế nữa, bạn có thể truyền cảm hứng của chính mình cho những người khác. Đọc sách khiến con người sống chậm lại, suy nghĩ nhiều hơn về những người xung quanh. Từ những câu chuyện cay đắng từ cuộc đời của các tác giả, nhân vật mà họ cảm thấy trân trọng những điều đơn giản và nhỏ nhặt. Nối kết mọi người đến gần với nhau hơn thông qua những trang sách, bạn đã góp phần rất nhiều vào công cuộc xây dựng một xã hội văn minh, tạo tiền đề cho sự phát triển của các thế hệ tương lai sau này.
            </p>

            <div class="btn-sec">
                <a href="{{asset('gioithieu')}}" class="btn yellow">Xem thêm</a>
                <a href="{{asset('register')}}" class="btn black">Đăng ký</a>
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
    <section class="testimonial-sec">
        <div class="container">
            <div id="testimonal" class="owl-carousel owl-theme">


                <div class="item">
                    <h3>Chủ quán, sáng lập quán, lên ý tưởng</h3>
                    <div class="box-user">
                        <h4 class="author">Đặng Hữu Đạt</h4>
                        <span class="country">Hà Nội</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Đồng chủ quán, đồng sáng lập và lên ý tưởng</h3>
                    <div class="box-user">
                        <h4 class="author">Đặng Ngọc Ánh</h4>
                        <span class="country">Hà Nội</span>
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