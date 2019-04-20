@extends('backend.master')
@section('content')
    <style>
        .activels{
            background-color: #f0f0f0;
        }
    </style>
    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Lịch sử nạp tiền
            </h1>
        </div>

    </div>
    <hr>
    <ul class="list-group mt-3">
        @foreach($ngaynap as $ngay =>$values)
        <li class="list-group-item lichsu" value=""><b>{{$ngay}}</b></li>
            <ul>
                <li class="list-group-item">
                @foreach($values as $value)

                    <table class=" table table-bordered">
                        <td width="30%">Tài khoản: {{$value->user->email}}</td>
                        <td width="20%">Số tiền: {{number_format($value->tiennap,0,'.','.')}} VNĐ</td>
                        <td width="25%">Người nạp TK: {{$value->nguoinap}}</td>
                        <td width="25%">Ngày nạp: {{date_format($value->created_at,'d-m-Y H:i A')}}</td>

                    </table>


                @endforeach
                </li>
            </ul>
        @endforeach
    </ul>
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