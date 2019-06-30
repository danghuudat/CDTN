@extends('backend.master')
@section('style')
    <style>
        .activels{
            background-color: #f0f0f0;
        }
        #hoadonct {
            font-family: Tahoma;
            font-size: 16px;
            line-height: 20px;
        }
        #hoadonct u {
            font-weight: bold;
        }
        #hoadonct p span{

            font-weight: bold;
        }
        #hoadonct h3{
            text-align: center;
            font-weight: bold;
        }
        .text-header {
            padding: 10px 10px;
        }
        .text-header p{
            float: right;
            margin-right: 5em;
        }
        .text-body{
            margin: 0;
            padding: 0;
        }
        .text-body p{
            text-transform: capitalize;
            padding: 10px 10px;
            margin: 0;

        }
        .text-body table{
            text-align: center;
            text-transform: capitalize;
        }
        .timeline li{
            margin-right: 0px;
        }
    </style>
    @endsection
@section('content')
    @if(Auth::user()->level !=1)
        @include('backend.Not-Found')
    @else

        <div class="row mt-3">
            <div class="col-md-9">
                <h1 class="page-header ">Quản lý hóa đơn
                </h1>
            </div>

        </div>
        <hr>
        <div class="abcde" >

            <div class="row justify-content-center" >

                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#hoadonsach1" data-toggle="tab">Hóa Đơn Sách</a></li>
                                <li class="nav-item"><a class="nav-link" href="#hoadoncafe1" data-toggle="tab">Hóa Đơn Café</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="hoadonsach1">
                                    <ul class="timeline timeline-inverse">

                                        <!-- timeline time label -->
                                        @foreach($hoadon as $nam =>$values)
                                            <li class=" list-group-item  nam" id="">
                                                <b>
                                                    Năm {{date('Y',strtotime($nam))}}
                                                </b>
                                            </li>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <ul class=" timeline-inverse" >
                                                @foreach($values->groupBy(function ($item){return $item->created_at->format('m-Y');}) as $thang =>$value)
                                                    <li class="list-group-item thang" style="position: relative;margin-bottom: 10px;">
                                                        <b>Tháng {{$thang}}</b>
                                                    </li>
                                                    <ul class="timeline timeline-inverse">
                                                        @foreach($value->groupBy(function ($item){return $item->created_at->format('d-m-Y');}) as $ngay => $vl)
                                                            <li class="time-label ngay">
                                                                <b style="padding: 5px;display: inline-block;background-color: red;color: whitesmoke;border-radius: 4px;">{{$ngay}}</b>
                                                                <?php
                                                                $tongtien=0;
                                                                $tien=[];
                                                                foreach ($vl as $value){
                                                                    array_push($tien,$value->tienthanhtoan);
                                                                    $tongtien=array_sum($tien);

                                                                }

                                                                ?>
                                                                <span>Tổng tiền trong ngày: {{number_format($tongtien,0,'.','.')}} VNĐ</span>
                                                            </li>
                                                            <ul>



                                                                <table class=" table table-bordered">
                                                                    <tr>
                                                                        <th>Mã hóa đơn</th>
                                                                        <th>TK mượn</th>
                                                                        <th>Ngày mượn</th>
                                                                        <th>Người thanh toán</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    @foreach ($vl as $value)
                                                                        <tr>
                                                                            <td>{{$value->id}}</td>
                                                                            <td width="30%">{{$value->muontra->user->email}}</td>
                                                                            <td>{{date('d-m-Y',strtotime($value->muontra->ngaymuon))}}</td>
                                                                            <td width="30%"> {{$value->nguoitt}}</td>
                                                                            <td width="20%"><button class="btn btn-outline-primary hoadonct" data-id="{{$value->id}}">Chi tiết hóa đơn</button>&nbsp;<button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                                {{--<i class=" fa far fa-check-circle bg-success "></i>--}}

                                                                {{--<div class="timeline-item">--}}
                                                                {{--<span class="time"><i class="fa fa-clock-o"></i>{{date_format($value->created_at,'D,M Y H:i A')}} </span>--}}

                                                                {{--<h3 class="timeline-header"><a href="#" style="color: @if($value->status==1) green @elseif($value->status==2) blue @elseif($value->status==2) red @endif ">Hóa đơn mã phiếu mượn: {{$value->muontra_id}}</a></h3>--}}

                                                                {{--<div class="timeline-body">--}}
                                                                {{--<table class=" table table-bordered">--}}
                                                                {{--<td width="30%">TK mượn: {{$value->muontra->user->email}}</td>--}}
                                                                {{--<td>Ngày mượn: {{date('d-m-Y',strtotime($value->muontra->ngaymuon))}}</td>--}}
                                                                {{--<td width="30%">Người thanh toán: {{$value->nguoitt}}</td>--}}
                                                                {{--<td width="20%"><button class="btn btn-outline-primary hoadonct" data-id="{{$value->id}}">Chi tiết hóa đơn</button>&nbsp;<button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></td>--}}
                                                                {{--</table>--}}

                                                                {{--</div>--}}

                                                                {{--</div>--}}



                                                            </ul>

                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                            </ul>

                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane"  id="hoadoncafe1">
                                    <ul class="timeline timeline-inverse">

                                        <!-- timeline time label -->
                                        @foreach($hoadoncf as $nam =>$values)
                                            <li class=" list-group-item  nam" id="">
                                                <b>
                                                    Năm {{date('Y',strtotime($nam))}}
                                                </b>
                                            </li>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <ul class=" timeline-inverse" >
                                                @foreach($values->groupBy(function ($item){return $item->created_at->format('m-Y');}) as $thang =>$value)
                                                    <li class="list-group-item thang" style="position: relative;margin-bottom: 10px;">
                                                        <b>Tháng {{$thang}}</b>
                                                    </li>
                                                    <ul class="timeline timeline-inverse">
                                                        @foreach($value->groupBy(function ($item){return $item->created_at->format('d-m-Y');}) as $ngay => $vl)
                                                            <li class="time-label ngay">
                                                                <b style="padding: 5px;display: inline-block;background-color: red;color: whitesmoke;border-radius: 4px;">{{$ngay}}</b>
                                                                <?php
                                                                $tongtien=0;
                                                                $tien=[];
                                                                foreach ($vl as $value){
                                                                    array_push($tien,$value->total);
                                                                    $tongtien=array_sum($tien);

                                                                }

                                                                ?>
                                                                <span>Tổng tiền trong ngày: {{number_format($tongtien,0,'.','.')}} VNĐ</span>
                                                            </li>
                                                            <ul>



                                                                <table class=" table table-bordered">
                                                                    <tr>
                                                                        <th>Mã hóa đơn</th>
                                                                        <th>Người mua</th>
                                                                        <th>Ngày mua</th>
                                                                        <th>Người thanh toán</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    @foreach ($vl as $value)
                                                                        <tr>
                                                                            <td>{{$value->id}}</td>
                                                                            <?php
                                                                            if($value->user_id_tt==null)
                                                                            {
                                                                                echo "<td style='width= 30%'>Khách hàng vô danh</td>";
                                                                            }
                                                                            else{
                                                                                $username=\Illuminate\Support\Facades\DB::table('users')->find($value->user_id_tt);
                                                                                echo "<td style='width= 30%'>".$username->name."</td>";
                                                                            }
                                                                            ?>

                                                                            <td width="30%">{{$value->created_at}}</td>
                                                                            <?php
                                                                            $username=\Illuminate\Support\Facades\DB::table('users')->find($value->user_id);
                                                                            echo "<td style='width= 30%'>".$username->name."</td>";
                                                                            ?>
                                                                            <td width="20%"><button class="btn btn-outline-primary hoadonctcf"  data-id="{{$value->id}}">Chi tiết hóa đơn</button></td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                                {{--<i class=" fa far fa-check-circle bg-success "></i>--}}

                                                                {{--<div class="timeline-item">--}}
                                                                {{--<span class="time"><i class="fa fa-clock-o"></i>{{date_format($value->created_at,'D,M Y H:i A')}} </span>--}}

                                                                {{--<h3 class="timeline-header"><a href="#" style="color: @if($value->status==1) green @elseif($value->status==2) blue @elseif($value->status==2) red @endif ">Hóa đơn mã phiếu mượn: {{$value->muontra_id}}</a></h3>--}}

                                                                {{--<div class="timeline-body">--}}
                                                                {{--<table class=" table table-bordered">--}}
                                                                {{--<td width="30%">TK mượn: {{$value->muontra->user->email}}</td>--}}
                                                                {{--<td>Ngày mượn: {{date('d-m-Y',strtotime($value->muontra->ngaymuon))}}</td>--}}
                                                                {{--<td width="30%">Người thanh toán: {{$value->nguoitt}}</td>--}}
                                                                {{--<td width="20%"><button class="btn btn-outline-primary hoadonct" data-id="{{$value->id}}">Chi tiết hóa đơn</button>&nbsp;<button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></td>--}}
                                                                {{--</table>--}}

                                                                {{--</div>--}}

                                                                {{--</div>--}}



                                                            </ul>

                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                            </ul>

                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
        </div>

    @endif
    <div class="modal fade bd-example-modal-lg" id="modalhdct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="hoadonct">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modalhdctcf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span><h3>Hóa đơn chi tiết</h3></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="hoadonctcf">
                        <div class="text-header">
                            <h5 id="mahoadon">Mã Hóa Đơn :53</h5>

                            <h5 id="ngaymua">Ngày mua: 20-05-2019</h5>
                            <h5 id="taikhoan">Tài Khoản: dangngocanh269@gmail.com</h5>
                        </div>

                        <div class="text-body">
                            <table class="table table-bordered mt-2" style="font-size: 14px ">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên đồ uống</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Thành tiền</th>

                                </tr>
                                </thead>
                                <tbody id="bodyhoadon">
                                {{--<th scope="row">1</th>
                                <td style="text-align: left;font-size: 16px">Cafe</td>
                                <td style="font-size: 16px">2</td>
                                <td style="font-size: 16px">10000</td>
                                <td style="font-size: 16px">20000</td>--}}

                                </tbody>
                            </table>
                            <div style=" background-color: rgba(0,0,0,.05);">
                                <span colspan="6" style="display: inline-block"><h5>Tổng tiền thanh toán: <span id="tongtien"></span> </h5></span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="convertPDF()" id="convert-pdf">Convert PDF</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#hoadonsach1 .nam').next().toggle()
            $('#hoadonsach1 .nam:first').addClass('activels');
            if($('#hoadonsach1 .nam:first').addClass('activels')) {
                $('#hoadonsach1 .nam:first').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').next().show();

            }
            $('#hoadonsach1 .nam').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('#hoadonsach1 .nam').next().slideUp()
                    $('#hoadonsach1 .abcde').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').siblings().removeClass('activels');

                }
            })


            $('#hoadonsach1 .thang').next().toggle()
            $('#hoadonsach1 .thang:first').addClass('activels');
            if($('#hoadonsach1 .thang:first').addClass('activels')) {
                $('#hoadonsach1 .thang:first').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').next().show();

            }
            $('#hoadonsach1 .thang').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('#hoadonsach1 .ngay').removeClass('active')
                    $('#hoadonsach1 .thang').next().slideUp()
                    $('#hoadonsach1 .montharrow').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').siblings().removeClass('activels');
                    if($('#hoadonsach1 .ngay:first').addClass('active')) {
                        // $('.ngay:first b').css('background-color','blue');
                        $('#hoadonsach1 .ngay:first').next().show();

                    }

                }

            })
            $('#hoadonsach1 .ngay').next().toggle()
            $('#hoadonsach1 .ngay:first ').addClass('active');
            if($('#hoadonsach1 .ngay:first').addClass('active')) {
                // $('.ngay:first b').css('background-color','blue');
                $('#hoadonsach1 .ngay:first').next().show();

            }
            $('#hoadonsach1 .ngay').click(function () {
                if($(this).hasClass('active')){


                }else{
                    $('#hoadonsach1 .ngay').next().slideUp();
                    $(this).next().toggle(1000);
                    $(this).addClass('active').siblings().removeClass('active');
                    // $('.ngay b').css('background-color','red');
                    // $(this).children().css('background-color','blue');

                }
            })

            $('#hoadoncafe1 .nam').next().toggle()
            $('#hoadoncafe1 .nam:first').addClass('activels');
            if($('#hoadoncafe1 .nam:first').addClass('activels')) {
                $('#hoadoncafe1 .nam:first').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').next().show();

            }
            $('#hoadoncafe1 .nam').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('#hoadoncafe1 .nam').next().slideUp()
                    $('#hoadoncafe1 .abcde').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').siblings().removeClass('activels');

                }
            })


            $('#hoadoncafe1 .thang').next().toggle()
            $('#hoadoncafe1 .thang:first').addClass('activels');
            if($('#hoadoncafe1 .thang:first').addClass('activels')) {
                $('#hoadoncafe1 .thang:first').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').next().show();

            }
            $('#hoadoncafe1 .thang').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('#hoadoncafe1 .ngay').removeClass('active')
                    $('#hoadoncafe1 .thang').next().slideUp()
                    $('#hoadoncafe1 .montharrow').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').siblings().removeClass('activels');
                    if($('#hoadoncafe1 .ngay:first').addClass('active')) {
                        // $('.ngay:first b').css('background-color','blue');
                        $('#hoadoncafe1 .ngay:first').next().show();

                    }

                }

            })
            $('#hoadoncafe1 .ngay').next().toggle()
            $('#hoadoncafe1 .ngay:first ').addClass('active');
            if($('#hoadoncafe1 .ngay:first').addClass('active')) {
                // $('.ngay:first b').css('background-color','blue');
                $('#hoadoncafe1 .ngay:first').next().show();

            }
            $('#hoadoncafe1 .ngay').click(function () {
                if($(this).hasClass('active')){


                }else{
                    $('#hoadoncafe1 .ngay').next().slideUp();
                    $(this).next().toggle(1000);
                    $(this).addClass('active').siblings().removeClass('active');
                    // $('.ngay b').css('background-color','red');
                    // $(this).children().css('background-color','blue');

                }
            })




            $(document).on('click','.hoadonct',function () {
                $('#modalhdct').modal('show');
                $.ajax({
                    url:'{{asset("admin/hoadonsach/hdct")}}',
                    type:'GET',
                    data:{id:$(this).attr('data-id')},
                    success:function (data) {
                        $('#hoadonct').html(data)
                    }
                })
            })
            $(document).on('click','.hoadonctcf',function () {
                $("#bodyhoadon").html("");
                $("#tongtien").html("");
                var id=$(this).attr('data-id');
                $.ajax({
                    url:'{{asset("admin/hoadon/hdct")}}',
                    type:'GET',
                    data:{id:$(this).attr('data-id')},
                    success:function (data) {
                        console.log(data)
                        var i=1;
                        $.each( data['hoadon'], function( index, value ){
                            i+=1;
                            $("#bodyhoadon").append("<tr><td scope='row'>"+i+"</td><td style='font-size: 16px'>"+value.tendouong+"</td><td style='font-size: 16px'>"+value.soluong+"</td><td style='font-size: 16px'>"+value.gia+"</td><td style='font-size: 16px'>"+value.gia*value.soluong+"</td></tr>")
                        })
                        $("#tongtien").append(data['hoadon'][0]['total']+' VNĐ');
                        $("#convert-pdf").attr('data-id',id)
                        $('#modalhdctcf').modal('show');

                    }
                })
            })

        })
        function convertPDF(){
            var id=$("#convert-pdf").attr('data-id');
            window.open("{{asset('admin/hoadon/pdf')}}/"+id)
        }
    </script>
@stop