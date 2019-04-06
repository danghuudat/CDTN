@extends('backend.master')
@section('content')
    <style>
        th.dt-center, td.dt-center { text-align: center; }
        small{
            font-size: 60%;
            font-weight: 400;
            color: #6e6b6b;
        }
        .text-deltais{
            text-align: justify-all;

            margin-top: 20px;
            margin-left: 20px;

        }
        .text-deltais p{
            text-transform: capitalize;

        }
        .text-deltais p i {
            color:red;
            font-weight: bold;
            margin-right: 10px;
        }
        .text-deltais p b {
            margin-right: 10px;
            margin-left: 0px;
        }
        .text-deltais p span {
            color:#e3342f;
        }
    </style>

    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Đồ uống
                <small>Danh sách</small>
            </h1>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-secondary refresh" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> Refresh</button>&nbsp;<button class="btn btn-success add"><i class="fas fa-user-plus"></i> Thêm đồ uống</button>
        </div>
    </div>


    <hr>
    <table id="example" class="table display cell-border mt-2" style="width:100%">
        <thead>
        <tr>

            <th>Tên đồ uống</th>
            <th>Giá cả</th>
            <th>Thể loại</th>

        </tr>
        </thead>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " id="modaluser" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="information">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-deltais">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <form id="formsubmit">
                    <div class="modal-body">

                        <div class="form-group">
                            <label  class="col-form-label">Tên đồ uống:</label>
                            <input type="text" class="form-control " id="name">
                            <span id="errorname" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Giá:</label>
                            <input type="email"  class="form-control" id="email">
                            <span id="erroremail" style="color: red"></span>

                        </div>
                        <div class="form-group" id="displaystatus">
                            <label  class="col-form-label">Loại đồ uống:</label>
                            <select class="form-control" id="status">
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="action" value="">
                        <button type="button"  class="btn btn-default resetpassword" value=""> Reset Password</button>
                        <button type="submit" class="btn btn-primary submitbutton" value="" ></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>

    </div>

@endsection
@section('script')

@stop
