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
        .mieuta{
            margin-left: 50px;
            margin-right: 50px;

            text-align: justify;
        }
    </style>

    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Sách
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
            <th>Tên Sách</th>
            <th>Tác Giả</th>
            <th>Năm xuất bản</th>
            <th>Số lượng</th>
            <th>Modifly</th>

        </tr>
        </thead>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="SachModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="MoDalSach" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="information">
                        <div class="row">
                            <div class="col-sm-4">
                                <img width="200px" id="imagebook" style="margin-left: 50px;    margin-top: 10px;    box-shadow: 0px 2px 5px 5px #dfd3d3;" alt="">
                            </div>
                            <div class="col-sm-7">
                                <div class="text-deltais">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <hr>
                                <div class="mieuta">

                                </div>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <form id="formsubmit" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Tên Sách:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " id="name" name="name">
                                <span id="errorname" style="color: red"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Tác Giả:</label>
                                    <div class="col-sm-8">
                                        <select name="tacgia_id" class="form-control" id="tacgia_id">
                                            @foreach($tacgia as $tg)
                                                <option value="{{$tg->id}}">{{$tg->name_tacgia}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Nhà Xuất Bản:</label>
                                    <div class="col-sm-8">
                                        <select name="nxb_id" class="form-control" id="nxb_id">
                                            @foreach($nhaxuatban as $nxb)
                                                <option value="{{$nxb->id}}">{{$nxb->name_nxb}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-4 col-form-label">Thể Loại Sách:</label>
                                    <div class="col-sm-8">
                                        <select name="theloai_id" class="form-control" id="theloai_id">

                                            @foreach($theloai as $tl)
                                                <option value="{{$tl->id}}">{{$tl->name_tl}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label  class="col-form-label">Hình Ảnh:</label>
                                    <input type="file" class="form-control hide " id="hinhanh" name="hinhanh" >
                                    <img src="1.png" alt="" id="clickimage" >
                                    <span id="errorhinhanh" style="color: red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">Năm xuất bản:</label>
                            <div class="col-sm-3">
                                <select  class="form-control" id="namxb" name="namxb">

                                    <?php
                                    $a=date('Y');
                                    for ($a;$a>=1900;$a--){
                                    ?>
                                    <option value="{{$a}}">{{$a}}</option>
                                    <?php }?>
                                </select>
                            </div>
                            <label  class="col-sm-2 col-form-label">Số Lượng:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="soluong" id="soluong">
                                <span id="errorsoluong" style="color: red"></span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Giới thiệu:</label>
                            <textarea id="gioithieu" name="gioithieu" rows="5" class="form-control" placeholder="Viết"></textarea>

                            <span id="errorgioithieu" style="color: red"></span>
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

                ajax:'{{asset("admin/book/data")}}',
                columns:[
                    {data:'id',"width":"5%"},
                    {data:'tensach',"width":"20%",'render':function (data,type,row) {
                            return '<img width="80px" src="images/sach/'+row.hinhanh+'"/><p style="text-transform: capitalize">'+row.tensach+'</p>';
                        }},
                    {data:'name_tg'},

                    {data:'namxb'},
                    {data:'soluong'},

                    {data:'Modifly',
                        "searchable": false,
                        "orderable":false,
                        "render": function (data, type, row) {
                            return '<button class="btn btn-outline-warning muonsach ">Mượn sách</button>&nbsp;<button class="btn btn-outline-info info" title="info" value="'+row.id+'"><i class="fas fa-info-circle"></i></button>&nbsp;<button class="btn btn-outline-primary edit" value="' + row.id + '"><i class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-outline-danger delete" value="' + row.id + '"><i class="fas fa-trash"></i></button>'
                        }},

                ]
            });
            $(document).on('click','.info',function () {
                $.ajax({
                    url:'{{asset("admin/book/info")}}',
                    type:'POST',
                    dataType:'json',
                    data:{id:$(this).val()},
                    success:function (data) {
                        $('#SachModal').modal('show');
                        $('.modal-title').text(data.tensach);
                        $('.information').show();
                        $('#formsubmit').hide();
                        $('#imagebook').attr('src','images/sach/'+data.hinhanh);
                        var html='';
                        html+='<p><i class="nav-icon fas fa-book"></i> <b>Tên Sách:</b> '+data.tensach +' </p>';
                        html+='<p><i class="nav-icon fas fa-user "></i> <b>Tác Giả:</b> '+data.tacgia.name_tacgia+'</p>';
                        html+='<p><i class="far fa-list-alt"></i> <b>Thể Loại:</b> '+data.theloai.name_tl+'</p>';
                        html+='<p><i class="fab fa-fort-awesome"></i> <b>Nhà Xuất Bản:</b> '+data.nhaxuatban.name_nxb+'</p>';
                        html+='<p><i class="fas fa-calendar-alt"></i> <b>Năm Xuất Bản:</b> '+data.namxb+'</p>';
                        html+='<p><i class="fas fa-box-open"></i> <b>Hiện còn:</b> '+data.soluong+' quyển</p>';

                        $('.text-deltais').html(html);
                        $('.mieuta').html('<p><b style="font-size: 2em">Giới thiệu:</b> '+data.mieuta+' </p>');

                    }
                })

            });
            $(document).on('click','.add',function () {
                $('#SachModal').modal('show');
                $('#formsubmit').show();
                $('.information').hide();
                $("#namxb option[value=1996]").attr('selected','selected');
                $('.modal-title').text('Thêm mới');
                $('.submitbutton').text('Thêm mới');
                $('#action').val('Add');
                $('#name').removeClass('is-invalid');
                $('#errorname').text('');
                $('#soluong').removeClass('is-invalid');
                $('#errorsoluong').text('');
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
                    url: '{{asset("admin/book/edit")}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {id:$(this).val()},
                    success:function(data){
                        $('#SachModal').modal('show');
                        $('#formsubmit').show();
                        $('.information').hide();

                        $('.modal-title').text('Edit '+data.tensach);
                        $('.submitbutton').text('Update');
                        $('#action').val('Edit');
                        $('#name').val(data.tensach);
                        $("#tacgia_id option[value="+data.tacgia_id+"]").attr('selected','selected');
                        $("#nxb_id option[value="+data.nxb_id+"]").attr('selected','selected');
                        $("#theloai_id option[value="+data.theloai_id+"]").attr('selected','selected');
                        $("#namxb option[value="+data.namxb+"]").attr('selected','selected');
                        $('#gioithieu').val(data.mieuta);
                        $('#soluong').val(data.soluong);

                        $('#clickimage').attr('src','images/sach/'+data.hinhanh);
                        $('#name').removeClass('is-invalid');
                        $('#errorname').text('');




                    }
                })


            });
            $(document).on('click','.delete',function () {
                if (confirm('Bạn muốn xóa?')){

                    $.ajax({
                        url:'{{asset("admin/book/delete")}}',
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
                        url:'{{asset("admin/book/add")}}',
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
                                $('#SachModal').modal('hide');
                                $('#formsubmit')[0].reset();
                            }

                        }
                    });

                }else if($('#action').val()==='Edit'){
                    var formData=new FormData(this);
                    formData.append('id',$('.submitbutton').val());

                    $.ajax({
                        url:'{{asset('admin/book/update')}}',
                        type:'POST',
                        dataType:'json',
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
                                $('#SachModal').modal('hide');
                                $('#formsubmit')[0].reset();
                            }

                        }

                    });
                }
            })
        } );


    </script>
@stop
