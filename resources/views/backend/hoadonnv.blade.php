@extends('backend.master')
@section('style')
    <style>
        table{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="container">

        <div class="abcde mt-5" >

            <div class="row justify-content-center" >

                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#hoadonsach1" data-toggle="tab">Hóa Đơn Sách</a></li>
                                <li class="nav-item"><a class="nav-link" href="#hoadoncafe" data-toggle="tab">Hóa Đơn Café</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="hoadonsach1">
                                    <table class="table table-bordered" id="tablehds">
                                        <thead>
                                            <tr>
                                                <th>Mã Hóa Đơn</th>
                                                <th>Mã Phiếu mượn</th>
                                                <th>TK mượn</th>
                                                <th>Ngày trả</th>
                                                <th>Xem chi tiết</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($hoadonsach as $hds)
                                            <tr>
                                                <td>{{$hds->id}}</td>
                                                <td>{{$hds->muontra_id}}</td>
                                                <td>{{$hds->muontra->user->email}}</td>
                                                <td>{{date_format($hds->created_at,'d-m-Y H:i A')}}</td>
                                                <td><a href="{{asset('admin/hoadonsach/hoadonpdf/'.$hds->id)}}" target="_blank" class="btn btn-outline-success">Xem chi tiết</a></td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane"  id="hoadoncafe">
                                    <table class="table table-bordered" id="tablehdcf">
                                        <thead>
                                        <tr>
                                            <th>Mã Hóa Đơn</th>
                                            <th>Tên khách hàng</th>
                                            <th>Ngày mua</th>
                                            <th>Xem chi tiết</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($hoadoncafe as $hdcf)
                                            <tr>
                                                <td>{{$hdcf->id}}</td>
                                                <td><?php if($hdcf->email==null){
                                                    echo"khách hàng vô danh";
                                                    }
                                                    else{
                                                        echo($hdcf->email);
                                                    }?></td>
                                                <td>{{date_format($hdcf->created_at,'d-m-Y H:i A')}}</td>
                                                <td><a href="{{asset('admin/hoadon/pdf/'.$hdcf->id)}}" target="_blank" class="btn btn-outline-success">Xem chi tiết</a></td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->

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

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#tablehds').DataTable({
                info:false,
                "columnDefs": [
                    { "orderable": false, "targets": 4 }
                ]            });
            $('#tablehdcf').DataTable()
        })
    </script>
@stop