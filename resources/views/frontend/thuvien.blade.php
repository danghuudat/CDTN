@extends('frontend.master')

@section('content')
    <style>
        .title-content{
            font-family: UVNKIEU;
            font-size: 60px;
            font-weight: bold;
        }
       .head-title{
           margin-bottom: 30px;
           text-align: left;
       }
       .head-title>h2{
            display: inline-block;
           text-align: left;
           left: 0;
           padding: 0px 10px;
           position: relative;
           text-transform: uppercase;
           background: #fff;
       }
        .head-title>hr{

            margin-top: -20px;
            border: 1px solid;
        }
        .slide-noibat{
            clear: both;

        }
        .slick-dots li button:before{
            font-size: 60px;
            color: #9b5858;
        }
        .item>h3{
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            text-transform: capitalize;
        }
        .tatcasach img{
            box-shadow: 10px 0px 5px 5px #c3c3c3;
        }
    </style>

    <div class="breadcrumb" style="margin-bottom: 20px;">
        <div class="container">
            <a class="breadcrumb-item" href="/">Trang Chủ</a>
            <span class="breadcrumb-item active">Thư viện sách</span>
        </div>
    </div>
    <div class="content" style="position: relative;text-align: center;">
        <div class="container">
            <div class="head-content">
                <h1 class="title-content">Thư viện sách</h1>
                <img  src="images/bor.png"  alt="">
            </div>
            <div class="body-content mt-3">
                <div class="noibat">
                   <div class="head-title">
                       <h2>Sách nổi bật</h2>
                       <hr>
                   </div>
                    <div class="slide-noibat pt-3 ">
                        @foreach($sachnoibat as $key=> $snb)

                                <div class="panel panel-default">
                                    <div class="panel-thumbnail">

                                            <a href="{{asset('thuvien/'.$snb->name_slug_sach.'.html')}}">
                                                <div class="item" >
                                                    <img class="img-fluid mx-auto d-block" style="box-shadow: 10px 0px 5px 5px #c3c3c3;" width="120px" height="200px" src="{{asset('images/sach/'.$snb->hinhanh)}}" alt="slide 1">
                                                    <h3>{{$snb->name_sach}}</h3>
                                                </div>
                                            </a>

                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
                <div class="tatcasach pt-3">
                    <div class="head-title pb-3">
                        <h2>Tất cả sách</h2>
                        <hr>
                    </div>
                    <div class="all-book">

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>


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
                        $('.all-book').append(data);
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