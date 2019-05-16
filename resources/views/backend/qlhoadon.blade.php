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
                                <ul class="timeline timeline-inverse">
                                    @foreach ($vl as $value)

                                        <li>
                                            <i class=" fa far fa-check-circle bg-success "></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i>{{date_format($value->created_at,'D,M Y H:i A')}} </span>

                                                <h3 class="timeline-header"><a href="#" style="color: @if($value->status==1) green @elseif($value->status==2) blue @elseif($value->status==2) red @endif ">Hóa đơn mã phiếu mượn: {{$value->muontra_id}}</a></h3>

                                                <div class="timeline-body">
                                                    <table class=" table table-bordered">
                                                        <td width="30%">TK mượn: {{$value->muontra->user->email}}</td>
                                                        <td>Ngày mượn: {{date('d-m-Y',strtotime($value->muontra->ngaymuon))}}</td>
                                                        <td width="30%">Người thanh toán: {{$value->nguoitt}}</td>
                                                        <td width="20%"><button class="btn btn-outline-primary hoadonct" data-id="{{$value->id}}">Chi tiết hóa đơn</button>&nbsp;<button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></td>
                                                    </table>

                                                </div>

                                            </div>
                                        </li>

                                    @endforeach
                                </ul>

                            @endforeach
                        </ul>
                    @endforeach
                </ul>

            @endforeach
        </ul>
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

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.nam').next().toggle()
            $('.nam:first').addClass('activels');
            if($('.nam:first').addClass('activels')) {
                $('.nam:first').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').next().show();

            }
            $('.nam').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('.nam').next().slideUp()
                    $('.abcde').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').siblings().removeClass('activels');

                }
            })


            $('.thang').next().toggle()
            $('.thang:first').addClass('activels');
            if($('.thang:first').addClass('activels')) {
                $('.thang:first').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').next().show();

            }
            $('.thang').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('.ngay').removeClass('active')
                    $('.thang').next().slideUp()
                    $('.montharrow').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down montharrow" style="float: right"></i>').siblings().removeClass('activels');
                    if($('.ngay:first').addClass('active')) {
                        // $('.ngay:first b').css('background-color','blue');
                        $('.ngay:first').next().show();

                    }

                }

            })
            $('.ngay').next().toggle()
            $('.ngay:first ').addClass('active');
            if($('.ngay:first').addClass('active')) {
                // $('.ngay:first b').css('background-color','blue');
                $('.ngay:first').next().show();

            }
            $('.ngay').click(function () {
                if($(this).hasClass('active')){


                }else{
                    $('.ngay').next().slideUp();
                    $(this).next().toggle(1000);
                    $(this).addClass('active').siblings().removeClass('active');
                    // $('.ngay b').css('background-color','red');
                    // $(this).children().css('background-color','blue');

                }
            })




            $(document).on('click','.hoadonct',function () {
                $('#modalhdct').modal('show');
                $.ajax({
                    url:'{{asset("admin/hoadon/hdct")}}',
                    type:'GET',
                    data:{id:$(this).attr('data-id')},
                    success:function (data) {
                        $('#hoadonct').html(data)
                    }
                })
            })

        })
    </script>
@stop