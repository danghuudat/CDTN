@extends('backend.master')
@section('content')
    @if(Auth::user()->level!=1)
        @include('backend.Not-Found')
    @else
        <style>
            .activels{
                background-color: #f0f0f0;
            }
            .timeline li{
                margin-right: 0px;
            }
        </style>
        <div class="row mt-3">
            <div class="col-md-9">
                <h1 class="page-header ">Lịch sử nạp tiền
                </h1>
            </div>

        </div>
        <hr>
        <ul class="timeline timeline-inverse">
            @foreach($ngaynap as $nam =>$values)
                <li class="list-group-item lichsu" value=""><b>Năm {{$nam}}</b></li>
                <ul class=" timeline-inverse" >
                    @foreach($values->groupBy(function ($item){return date('m-Y',strtotime( $item->ngaynap));}) as $thang =>$value)
                        <li class="list-group-item thang" style="position: relative;margin-bottom: 10px;">
                            <b>Tháng {{$thang}}</b>
                        </li>
                        <ul class="timeline timeline-inverse">
                            @foreach($value->groupBy(function ($item){return date('d-m-Y',strtotime( $item->ngaynap));}) as $ngay =>$kq)
                                <li class="time-label ngay">
                                    <b style="padding: 5px;display: inline-block;background-color: red;color: whitesmoke;border-radius: 4px;">{{$ngay}}
                                    </b>
                                </li>
                                <ul>
                                    <table class=" table table-bordered">
                                        <tr>
                                            <th>Tài Khoản</th>
                                            <th>Số Tiền</th>
                                            <th>Người Nạp</th>
                                            <th>Ngày Nạp</th>

                                        </tr>
                                        @foreach ($kq as $value)
                                            <tr>
                                                <td width="30%"> {{$value->tentaikhoan}}</td>
                                                <td width="20%">{{number_format($value->tiennap,0,'.','.')}} VNĐ</td>
                                                <td width="25%">{{$value->nguoinap}}</td>
                                                <td width="25%">{{date_format($value->created_at,'d-m-Y H:i A')}}</td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </ul>
                            @endforeach
                        </ul>



                        @endforeach
                        </li>
                </ul>
            @endforeach
        </ul>
    @endif
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(' .nam').next().toggle()
            $(' .nam:first').addClass('activels');
            if($(' .nam:first').addClass('activels')) {
                $(' .nam:first').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').next().show();

            }
            $(' .nam').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $(' .nam').next().slideUp()
                    $(' .abcde').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').siblings().removeClass('activels');

                }
            })


            $(' .thang').next().toggle()
            $(' .thang:first').addClass('activels');
            if($(' .thang:first').addClass('activels')) {
                $(' .thang:first').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').next().show();

            }
            $(' .thang').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $(' .ngay').removeClass('active')
                    $(' .thang').next().slideUp()
                    $(' .montharrow').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').siblings().removeClass('activels');
                    if($(' .ngay:first').addClass('active')) {
                        // $('.ngay:first b').css('background-color','blue');
                        $(' .ngay:first').next().show();

                    }

                }

            })
            $(' .ngay').next().toggle()
            $(' .ngay:first ').addClass('active');
            if($(' .ngay:first').addClass('active')) {
                // $('.ngay:first b').css('background-color','blue');
                $(' .ngay:first').next().show();

            }
            $(' .ngay').click(function () {
                if($(this).hasClass('active')){


                }else{
                    $(' .ngay').next().slideUp();
                    $(this).next().toggle(1000);
                    $(this).addClass('active').siblings().removeClass('active');
                    // $('.ngay b').css('background-color','red');
                    // $(this).children().css('background-color','blue');

                }
            })
        })
    </script>
@stop