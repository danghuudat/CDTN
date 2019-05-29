@extends('frontend.master')
@section('style')
    <style>
        .fixcontainer a{
            text-decoration: none;
        }
        .fixcontainer{
            font-family: "Times New Roman";
        }
        .c-img{
            position: absolute;
            left: 15%;
            top: 240px;
            z-index: 2;
        }
        .c-img img{
            border-radius: 50%;
            border: 12px solid green;
        }
        .contet{
            background-color: #bebebe1a;
            margin-top: 100px;
            padding: 9px 3% 1% 3%;
            border-top: 12px solid green;
            border-bottom: 4px solid green;
            position: relative;
        }
        .tentheloai{
            padding:20px 0 5px 215px;
        }
        .tentheloai>h1>a{
            font-size: 30px;

            color: #31b131;
            text-transform: uppercase;
            text-decoration: none;
        }
        .thongtin{
            padding: 30px 0px 10px 0px;
            text-align: justify;
            font-size: 18px;

        }
        .feature{
            margin-top: 20px;
            background-color: #bebebe1a;
            margin-bottom: 20px;
        }
        .theloaisach>h2{
            font-size: 25px;
            padding: 20px;
            font-weight: bold;
            border-bottom: 2px solid #1b7c4f;
        }

        .contentsach{
            text-align: center;
            padding-bottom: 20px;
        }
        .contentsach img{

            box-shadow: 10px 0px 5px 5px #c3c3c3;
        }
        .tensach>h3>a{
            margin-top: 10px;
            font-size: 15px;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
        }
        .fix-img{
            cursor: pointer;
        }
        .fix-col:hover a{
            color: orange;
        }
        .fix-col >.fix-img:hover img{
            opacity: 0.4;
            transition: 0.5s;
        }
        .loadmore{
            margin-top: 20px;
            text-align: center;
            padding-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="/">Trang Chủ</a>
            <a class="breadcrumb-item " href="/thuvien" style="text-transform: capitalize">Thư viện sách</a>
            <span class="breadcrumb-item active" style="text-transform: capitalize">Năm Xuất Bản</span>
        </div>
    </div>
    <div class="container fixcontainer">
        <div class="c-img">
            <img width="150px" height="150px" src="images/nxb.jpg" alt="">
        </div>
        <div class="contet">
            <div class="tentheloai">
                <h1><a href="{{asset('theloaisach/'.$tl->name_tl.'.html')}}"> {{$tl->name_tl}}</a></h1>
            </div>
        </div>
        <div class="feature">
            <div class="theloaisach">
                <h2>Tất cả sách của <a href="{{asset('theloaisach/'.$tl->name_tl.'.html')}}">{{$tl->name_tl}}</a></h2>
            </div>
            <div class="contentsach" style="text-align: center">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var _token=$('meta[name="csrf-token"]').attr('content');
            var id_tl={{$tl->id}};
            load_data('',_token);
            function load_data(id,_token) {
                $.ajax({
                    url:'{{asset('loadmore_tv')}}',
                    type:'POST',
                    data:{id:id,_token:_token,action:'theloaisach',id_tl:id_tl},
                    success:function (data) {
                        $('#load_more_button').remove();
                        $('.contentsach').append(data);
                    }
                })
            }
            $(document).on('click','#load_more_button',function(){
                load_data($(this).attr('data-id'),_token);
            });
        })
    </script>
@stop