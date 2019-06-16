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
                <h1>Phiếu mượn</h1>
                <table class="table table-bordered" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>Mã phiếu mượn</th>
                        <th>Ngày mượn</th>
                        <th>Hạn Trả</th>
                        <th>Trạng thái</th>
                        <th>Xem chi tiết</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($phieumuon as $pm)
                        <tr>
                            <td>{{$pm->id}}</td>
                            <td>{{date("d-m-Y", strtotime($pm->ngaymuon))}}</td>
                            <td>{{date("d-m-Y", strtotime($pm->hantra))}}</td>
                            <td>{{$pm->active==0 ? 'Đang mượn' : 'Đã trả'}}</td>
                            <td><a href="{{asset('phieumuon/'.$pm->id)}}" target="_blank" class="btn btn-outline-success">Xem chi Tiết</a></td>
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