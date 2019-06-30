@extends('frontend.master')
@section('style')
    <style>
        a{
            color: black;
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @include('frontend.banner')

            <div class="col-md-8">
               <h1>Lịch sử giao dịch</h1>
               <table class="table table-bordered">
                    <tr>
                        <th>Nội dung</th>
                        <th>Số tiền</th>
                        <th>Ngày Nạp</th>
                    </tr>
                   @foreach($lichsu as $ls)
                   <tr @if($ls->status==0) style="background: #b6d7b6" @else style="background:#e78181" @endif >
                       <td>{{$ls->status==0 ? 'Nạp tiền' : 'Trừ tiền trả sách'}}</td>
                       <td>{{number_format($ls->tiennap,0,'.','.')}} VNĐ</td>
                       <td>{{date_format($ls->created_at,'d-m-Y H:i A')}}</td>
                   </tr>
                   @endforeach
               </table>
           </div>
        </div>
    </div>

@endsection
@section('script')
    <script>

    </script>
@stop