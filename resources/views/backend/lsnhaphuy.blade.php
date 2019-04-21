@extends('backend.master')
@section('content')
    @if(Auth::user()->level !=1)
        @include('backend.Not-Found')
        @else
        <style>
            .activels{
                background-color: #f0f0f0;
            }
        </style>
        <div class="row mt-3">
            <div class="col-md-9">
                <h1 class="page-header ">Lịch sử Nhập và Hủy sách
                </h1>
            </div>

        </div>
        <hr>
        <ul class="timeline timeline-inverse">
            <!-- timeline time label -->
            @foreach($lichsu as $ngay =>$values)
                <li class=" list-group-item  lichsu" id="">
                    <b>
                        {{date('d-m-Y',strtotime($ngay))}}
                    </b>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <ul class="timeline timeline-inverse">
                    @foreach ($values as $value)

                        <li>
                            <i class=" @if($value->status==1)fa fas fa-book bg-success @elseif($value->status==2)fa fas fa-book bg-primary @elseif($value->status==3) fa far fa-times-circle bg-danger @elseif($value->status==4) fa fas fa-plus-circle bg-success  @endif  "></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i>{{date_format($value->created_at,'D,M Y H:i A')}} </span>

                                <h3 class="timeline-header"><a href="#" style="color: @if($value->status==1) green @elseif($value->status==2) blue @elseif($value->status==2) red @endif ">@if($value->status==1)Nhập thêm số lượng sách @elseif($value->status==2)Giảm số lượng sách @elseif($value->status==3) Xóa sách @elseif($value->status==4) Thêm mới sách @endif</a></h3>

                                <div class="timeline-body">
                                    <table class=" table table-bordered">
                                        @if($value->status==1 || $value->status==2)
                                            <td width="30%">Tên Sách: {{$value->sach->name_sach}}</td>
                                            <td>Số lượng: {{$value->soluong}}</td>
                                        @elseif($value->status==3 )
                                            <td width="30%">{{$value->ghichu}}</td>
                                        @elseif($value->status==4)
                                            <td width="30%">Tên Sách: {{$value->sach->name_sach}}</td>
                                            <td>Thể loại: {{$value->sach->theloai->name_tl}}</td>
                                            <td>Tác giả: {{$value->sach->tacgia->name_tg}}</td>

                                        @endif
                                    </table>

                                </div>

                            </div>
                        </li>

                    @endforeach
                </ul>
            @endforeach
        </ul>
        @endif

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.lichsu').next().toggle()
            $('.lichsu:first').addClass('activels');
            if($('.lichsu:first').addClass('activels')) {
                $('.lichsu:first').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').next().show();

            }
            $('.lichsu').click(function () {
                if($(this).hasClass('activels')){


                }else{
                    $('.lichsu').next().slideUp()
                    $('.abcde').remove()
                    $(this).next().toggle(1000);
                    $(this).addClass('activels').append('<i class="fas fa-chevron-down abcde" style="float: right"></i>').siblings().removeClass('activels');

                }
            })
        })
    </script>
    @stop