@extends('frontend.master')
@section('style')
    <style>
        a{
            color: black;
            text-decoration: none;
        }
        .pagination>li>a {
            padding: 10px;
        }
        .row{
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @include('frontend.banner')

            <div class="col-md-8">
                <h1>Hóa đơn trả sách</h1>
                <table class="table table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Mã Hóa đơn</th>
                            <th>Mã Phiếu mượn</th>
                            <th>Ngày trả</th>
                            <th>Xem chi tiết</th>
                        </tr>
                    </thead>
                   <tbody>
                   @foreach($a as $hd)
                       <tr>
                           <td>{{$hd->id}}</td>
                           <td>{{$hd->muontra_id}}</td>
                           <td>{{date_format($hd->created_at,'d-m-Y H:i A')}}</td>
                           <td><a href="{{asset('hoadon/'.$hd->id)}}" target="_blank" class="btn btn-outline-success">Xem chi Tiết</a></td>
                       </tr>
                   @endforeach
                   </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true,
                "info": false,
                "order": [[ 0, 'desc' ]]

            });
        });
    </script>
@stop