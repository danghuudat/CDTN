@extends('frontend.master')

@section('content')
    <style>
        @media (min-width: 768px) {

            /* show 3 items */
            .carousel-inner .active,
            .carousel-inner .active + .carousel-item,
            .carousel-inner .active + .carousel-item + .carousel-item,
            .carousel-inner .active + .carousel-item + .carousel-item + .carousel-item  {
                display: block;
            }

            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item,
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item,
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
                transition: none;
            }

            .carousel-inner .carousel-item-next,
            .carousel-inner .carousel-item-prev {
                position: relative;
                transform: translate3d(0, 0, 0);
            }

            .carousel-inner .active.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                position: absolute;
                top: 0;
                right: -25%;
                z-index: -1;
                display: block;
                visibility: visible;
            }

            /* left or forward direction */
            .active.carousel-item-left + .carousel-item-next.carousel-item-left,
            .carousel-item-next.carousel-item-left + .carousel-item,
            .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item,
            .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item,
            .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }

            /* farthest right hidden item must be abso position for animations */
            .carousel-inner .carousel-item-prev.carousel-item-right {
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                display: block;
                visibility: visible;
            }

            /* right or prev direction */
            .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
            .carousel-item-prev.carousel-item-right + .carousel-item,
            .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item,
            .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item,
            .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }

        }

        /* Bootstrap Lightbox using Modal */

        #profile-grid { overflow: auto; white-space: normal; }
        #profile-grid .profile { padding-bottom: 40px; }
        #profile-grid .panel { padding: 0 }
        #profile-grid .panel-body { padding: 15px }
        #profile-grid .profile-name { font-weight: bold; }
        #profile-grid .thumbnail {margin-bottom:6px;}
        #profile-grid .panel-thumbnail { overflow: hidden; }
        #profile-grid .img-rounded { border-radius: 4px 4px 0 0;}
        .recent-book-sec .item:hover {
            opacity: 0.5;
            transition: 0.5s;
        }
    </style>

    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="/">Trang Chủ</a>
            <span class="breadcrumb-item active">Thư viện sách</span>
        </div>
    </div>
    <section class="static about-sec">
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <h2>Sách nổi bật</h2>
                </div>
                <div class="col-sm-2">
                    <a href="" class="btn">Xem thêm</a>
                </div>
            </div>

            <div class="recomended-sec">
                <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                        @foreach($sachnoibat as $key=> $snb)
                        <div class="carousel-item col-md-3  {{$key==0 ? 'active' : ''}}">
                            <div class="panel panel-default">
                                <div class="panel-thumbnail">
                                    <a href="#" title="{{$snb->name_slug_sach}}" class="thumb">
                                        <a href="{{asset('thuvien/'.$snb->name_slug_sach.'.html')}}">
                                            <div class="item" >
                                                <img class="img-fluid mx-auto d-block" style="box-shadow: 10px 0px 5px 5px #c3c3c3;" width="120px" height="200px" src="{{asset('images/sach/'.$snb->hinhanh)}}" alt="slide 1">
                                                <h3>{{$snb->name_sach}}</h3>
                                            </div>
                                        </a>


                                    </a>

                                </div>
                            </div>
                        </div>
                            @endforeach
                    </div>
                    {{--<a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">--}}
                        {{--<span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                        {{--<span class="sr-only">Previous</span>--}}
                    {{--</a>--}}
                    {{--<a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">--}}
                        {{--<span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                        {{--<span class="sr-only">Next</span>--}}
                    {{--</a>--}}
                </div>


            </div>
            <h2>Tất cả sách</h2>
            <div class="recent-book-sec">
            </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>

        $('#carouselExample').on('slide.bs.carousel', function (e) {


            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 4;
            var totalItems = $('.carousel-item').length;

            if (idx >= totalItems-(itemsPerSlide-1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i=0; i<it; i++) {
                    // append slides to end
                    if (e.direction=="left") {
                        $('.carousel-item').eq(i).appendTo('.carousel-inner');
                    }
                    else {
                        $('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });


        $('#carouselExample').carousel({
            interval: 2500
        });


        $(document).ready(function() {
            var _token=$('meta[name="csrf-token"]').attr('content');
            load_data('',_token);
            function load_data(id,_token) {
                $.ajax({
                    url:'{{asset('loadmore_tv')}}',
                    type:'POST',
                    data:{id:id,_token:_token,action:'tatcasach'},
                    success:function (data) {
                        $('#load_more_button').remove();
                        $('.recent-book-sec').append(data);
                    }
                })
            }
            $(document).on('click','#load_more_button',function(){
                load_data($(this).attr('data-id'),_token);
            });
            /* show lightbox when clicking a thumbnail */
            $('a.thumb').click(function(event){
                event.preventDefault();
                var content = $('.modal-body');
                content.empty();
                var title = $(this).attr("title");
                $('.modal-title').html(title);
                content.html($(this).html());
                $(".modal-profile").modal({show:true});
            });

        });
    </script>
@stop