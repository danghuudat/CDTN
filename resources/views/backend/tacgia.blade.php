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
            color: #e3342f;
        }
        #clickimage{
            width: 6em; border: 1px dashed;background: snow;cursor: pointer; margin-left: 10px
        }
    </style>

    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Tác giả
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
            <th>Tên Tác giả</th>
            <th>Miêu tả</th>
            <th>Modifly</th>

        </tr>
        </thead>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="TGModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " id="MoDalTG" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="formsubmit" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">
                            <label  class="col-form-label">Tên Tác giả:</label>
                            <input type="text" class="form-control " id="name" name="name">
                            <span id="errorname" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Giới thiệu:</label>
                            <textarea id="gioithieu" name="gioithieu" rows="5" class="form-control" placeholder="Viết"></textarea>

                            <span id="errorgioithieu" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Hình Ảnh:</label>
                            <input type="file" class="form-control hide " id="hinhanh" name="hinhanh" >
                            <img src="1.png" alt="" id="clickimage" >
                            <span id="errorhinhanh" style="color: red"></span>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#clickimage').click(function () {
                $('#hinhanh').click();
            })
            $('#hinhanh').change(function (e) {
                console.log(e)
                if (e.target.files && e.target.files[0]){
                    if (e.target.files[0].type =='image/jpg' || e.target.files[0].type =='image/png'||e.target.files[0].type =='image/jpeg'){
                        var reader = new FileReader();
                            //Sự kiện file đã được load vào website
                            reader.onload = function(e){
                                //Thay đổi đường dẫn ảnh
                                $('#clickimage').attr('src',e.target.result);

                            }
                            reader.readAsDataURL(e.target.files[0]);
                    }else{
                        alert('Hình Ảnh không đúng định dạng')
                    }
                }

            });
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

                ajax:'{{asset("admin/book/tacgia/data")}}',
                columns:[
                    {data:'id',"width":"5%"},
                    {data:'name_tg',"width":"20%",'render':function (data,type,row) {
                            return '<img width="130px" src="images/'+row.hinhanh+'"/><p>'+row.name_tg+'</p>';
                        }},
                    {data:'gioithieu',"orderable":false,"width":"60%"},
                    {data:'Modifly',
                        "searchable": false,
                        "orderable":false,
                        "render": function (data, type, row) {
                            return '<button class="btn btn-outline-primary edit" value="' + row.id + '"><i class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-outline-danger delete" value="' + row.id + '"><i class="fas fa-trash"></i></button>'
                        }},

                ]
            });
            $(document).on('click','.add',function () {
                $('#TGModal').modal('show');

                $('.modal-title').text('Thêm mới');
                $('.submitbutton').text('Thêm mới');
                $('#action').val('Add');
                $('#name').removeClass('is-invalid');
                $('#errorname').text('');
                $('#gioithieu').removeClass('is-invalid');
                $('#errorgioithieu').text('');
                $('#clickimage').attr('src','1.png');
                $('#hinhanh').removeClass('is-invalid');
                $('#errorhinhanh').text('');
                $('#hinhanh').val('');
                $('#formsubmit')[0].reset();


            });
            $(document).on('click','.edit',function () {
                $('.submitbutton').val($(this).val());


                $.ajax({
                    url: '{{asset("admin/book/tacgia/edit")}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {id:$(this).val()},
                    success:function(data){
                        $('#TGModal').modal('show');
                        $('.modal-title').text('Edit '+data.name_tg);
                        $('.submitbutton').text('Update');
                        $('#action').val('Edit');
                        $('#name').val(data.name_tg);
                        $('#gioithieu').val(data.gioithieu);
                        $('#clickimage').attr('src','{{asset('images')}}'+'/'+data.hinhanh)
                        $('#name').removeClass('is-invalid');
                        $('#errorname').text('');




                    }
                })


            });
            $(document).on('click','.delete',function () {
                if (confirm('Bạn muốn xóa?')){
                    $.ajax({
                        url:'{{asset("admin/book/tacgia/delete")}}',
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
                    $.ajax({
                        url:'{{asset("admin/book/tacgia/add")}}',
                        type: 'POST',
                        dataType: 'json',
                        data: new FormData(this),
                        contentType:false,
                        cache:false,
                        processData:false,
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
                                $('#TGModal').modal('hide');
                                $('#formsubmit')[0].reset();
                            }

                        }
                    });

                }else if($('#action').val()==='Edit'){
                    var formData=new FormData(this);
                    formData.append('id',$('.submitbutton').val());
                    $.ajax({
                        url:'{{asset("admin/book/tacgia/update")}}',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        contentType:false,
                        cache:false,
                        processData:false,
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
                                $('#TGModal').modal('hide');
                                $('#formsubmit')[0].reset();
                            }

                        }
                    });
                }
            })
        } );


    </script>
@stop
