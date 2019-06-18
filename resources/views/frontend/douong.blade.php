@extends('frontend.master')
@section('style')
    <style>
    </style>
@endsection
@section('content')
    <div class="breadcrumb" style="margin-bottom: 20px;">
        <div class="container">
            <a class="breadcrumb-item" href="/">Trang Chủ</a>
            <span class="breadcrumb-item active">Danh sách đồ uống</span>
        </div>
    </div>
    <div class="content" style="position: relative;text-align: center; margin-bottom: 50px">
        <div class="container">
            <div class="body-content mt-3">
                <div class="tatcasach pt-3">
                    <div class="head-title pb-3">
                        <h2>Danh sách đồ uống</h2>
                        <hr>
                    </div>
                    <div class="all-book">
                        @foreach($douong_theloai as $value)
                            <div style="margin-top: 30px">
                                <div><h2>{{$value->theloai_douong_name}}</h2></div>
                                <div class="row" style="margin-top: 30px">
                                    <?php
                                    $menu=DB::table('menu')->where('theloai_douong','=',$value->id)->get();
                                    foreach($menu as $mn){
                                    ?>
                                    <div class="col-md-3">
                                        <div class="item">
                                            <img src="{{asset('images/'.$mn->anh)}}" width="200px" height="250px" alt="img">
                                            <h4 style="text-transform: capitalize">{{$mn->tendouong}}</h4>
                                            <h6 style="color: red">{{$mn->gia}}đ</h6>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>

    </script>
@stop