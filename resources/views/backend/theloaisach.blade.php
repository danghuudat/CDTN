@extends('backend.master')
@section('style')
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
    @endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-9">
        <h1 class="page-header ">Thể loại Sách
            <small>List</small>
        </h1>
    </div>
    <div class="col-md-3">
        <button class="btn btn-outline-secondary refresh" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> Refresh</button>&nbsp;<button class="btn btn-success add"><i class="far fa-plus-square"></i> Thêm mới</button>
    </div>
</div>


<hr>
<table id="example" class="table display cell-border mt-2" style="width:100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên Thể Loại</th>
        <th>Modifly</th>

    </tr>
    </thead>
</table>
<!-- Modal -->
<div class="modal fade" id="TheLoaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " id="Modaltheloai" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formsubmit">
                <div class="modal-body">

                    <div class="form-group">
                        <label  class="col-form-label">Tên thể loại:</label>
                        <input type="text" class="form-control " id="name">
                        <span id="errorname" style="color: red"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="action" value="">
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
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function valiCMT(value) {
        if (value.length==0){
            $('#errorCMT').text('');
            $('#CMT').removeClass('is-invalid');
        }else
        if(isNaN(value)){
            $('#errorCMT').text('CMT phải là số')
            $('#CMT').addClass('is-invalid');
        }else
        if (value.length>10 || value.length<9){
            $('#errorCMT').text('Độ dài CMT không đúng')
            $('#CMT').addClass('is-invalid');
        } else{
            $('#errorCMT').text('')
            $('#CMT').removeClass('is-invalid');
        }
    }
    function ChangeLevel(level){
        if (level==1||level==2){
            $('#displaystatus').hide();
        }else{
            $('#displaystatus').show();
        }
    };
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table= $('#example').DataTable({
            "columnDefs": [
                {"className": "dt-center", "targets": "_all"}
            ],
            paging: true,
            processing:false,

            ajax:'{{asset('admin/book/theloai/data')}}',
            columns:[
                {data:'id',"width":"5%"},
                {data:'name_tl'},
                {data:'Modifly',
                    "searchable": false,
                    "orderable":false,
                    "render": function (data, type, row) {
                        return '<button class="btn btn-outline-primary edit" value="' + row.id + '"><i class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-outline-danger delete" value="' + row.id + '"><i class="fas fa-trash"></i></button>'
                }},

        ]
    });
        $(document).on('click','.add',function () {
            $('#TheLoaiModal').modal('show');

            $('.modal-title').text('Thêm mới');
            $('.submitbutton').text('Thêm mới');
            $('#action').val('Add');
            $('#name').removeClass('is-invalid');
            $('#errorname').text('');

            $('#formsubmit')[0].reset();


        });
        $(document).on('click','.edit',function () {
            $('.submitbutton').val($(this).val());


            $.ajax({
                url: '{{asset("admin/book/theloai/edit")}}',
                type: 'GET',
                dataType: 'json',
                data: {id:$(this).val()},
                success:function(data){
                    $('#TheLoaiModal').modal('show');
                    $('.modal-title').text('Edit '+data.name_tl);
                    $('.submitbutton').text('Update');
                    $('#action').val('Edit');
                    $('#name').val(data.name_tl);
                    $('#name').removeClass('is-invalid');
                    $('#errorname').text('');




                }
            })


        });
        $(document).on('click','.delete',function () {
            if (confirm('Bạn muốn xóa?')){
                $.ajax({
                    url:'{{asset("admin/book/theloai/delete")}}',
                    type:'GET',
                    data:{id:$(this).val()},
                    success:function (data) {
                        alert(data.success);
                        table.ajax.reload();
                    }
                })
            }
        });
        $('#formsubmit').submit(function (e) {
            e.preventDefault();
            if($('#action').val()==='Add'){
                var name=$('#name').val();
                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:'{{asset("admin/book/theloai/add")}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {name: name},
                    success:function (data) {
                        if(data.errors.length >0){
                            if(data.errors[0].name){
                                $('#name').addClass('is-invalid');
                                $('#errorname').text(data.errors[0].name);
                            }else{
                                $('#name').removeClass('is-invalid');
                                $('#errorname').text('');
                            }
                        }else{
                            alert(data.success);
                            table.ajax.reload();
                            $('#TheLoaiModal').modal('hide');
                            $('#formsubmit')[0].reset();
                        }

                    }
                });

            }else if($('#action').val()==='Edit'){
                var name=$('#name').val();

                var _token=$('input[name="_token"]').val();
                $.ajax({
                    url:'{{asset('admin/book/theloai/update')}}',
                    type:'POST',
                    dataType:'json',
                    data: {id:$('.submitbutton').val(),name: name,_token:_token},
                success:function (data) {
                    if(data.errors.length >0){
                        if(data.errors[0].name){
                            $('#name').addClass('is-invalid');
                            $('#errorname').text(data.errors[0].name);
                        }else{
                            $('#name').removeClass('is-invalid');
                            $('#errorname').text('');
                        }

                    }else{
                        alert(data.success);
                        table.ajax.reload();
                        $('#TheLoaiModal').modal('hide');
                        $('#formsubmit')[0].reset();
                    }

                }

            });
            }
        })
    } );


</script>
@stop
