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
            <h1 class="page-header ">Thể loại
                <small>Danh sách</small>
            </h1>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-secondary refresh" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> Refresh</button>&nbsp;<button class="btn btn-success add"><i class="fas fa-user-plus"></i> Thêm đồ uống</button>
        </div>
    </div>
    {{csrf_field()}}

    <hr>
    <table id="example" class="table display cell-border mt-2" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên thể loại</th>
            <th></th>
        </tr>
        </thead>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="TheLoaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " id="modaltheloai" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm thể loại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-form-label">Tên thể loại</label>
                        <input type="email"  class="form-control" id="theloai" placeholder="Tên thể loại">
                        <span id="errorname" style="color: red"></span>

                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action" value="">
                    <button  class="btn btn-primary submitbutton" id="addDrinks" onclick="addDrink()" >Thêm mới</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " id="modaltheloai" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa thể loại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="col-form-label">Tên thể loại</label>
                        <input type="email"  class="form-control" id="edittheloai" >
                        <span id="errorname" style="color: red"></span>

                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action" value="">
                    <button  class="btn btn-primary submitbutton" id="EditDrinks" >Edit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( document ).ready(function() {
        var table= $('#example').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            paging: true,
            processing:false,

            ajax:'{{asset('admin/theloai_douong/data')}}',
            columns:[
                {data:'id'},
                {data:'theloai_douong_name'},
                {data:'Modifly',
                    "render": function (data, type, row){
                        return '</button>&nbsp;<button class="btn btn-outline-primary edit"  placeholder="'+row.theloai_douong_name+'" value="' + row.id + '" ><i class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-outline-danger delete"  placeholder="'+row.theloai_douong_name+'" value="' + row.id + '" ><i class="fas fa-trash"></i></button>'
                }},
            ]
        });
        $(document).on('click','.add',function () {
            $('#TheLoaiModal').modal('show');
            $('#errorname').text("");


        });
        $(document).on('click','.edit',function () {
            var _token=$('input[name="_token"]').val();
            $('.submitbutton').val($(this).val());
            var placeholder =$(this).attr('placeholder');
            $('#edittheloai').attr("placeholder",placeholder);
            alert($(this).val());
            $('#EditModal').modal('show');
            $.ajax({
                url: '{{asset("admin/theloai_douong/edit")}}',
                type: 'POST',
                dataType: 'json',
                data: {id:$(this).val(),
                        _token:_token},
                success:function(data){

                }
            })


        });

    });
    function addDrink() {
        var _token=$('input[name="_token"]').val();
        $.ajax({
            url:'{{asset("admin/theloai_douong/add")}}',
            type: 'POST',
            dataType: 'json',
            data: {name: $("#theloai").val(),_token:_token},
            success:function (data) {
                if(data.errors.length >0){
                    $('#name').addClass('is-invalid');
                    $('#errorname').text(data.errors[0].name);
                }else{
                    alert(data.success);
                    /*table.ajax.reload();
                    $('#UserModal').modal('hide');
                    $('#formsubmit')[0].reset();*/
                }

            }
        });


    }

</script>
@stop
