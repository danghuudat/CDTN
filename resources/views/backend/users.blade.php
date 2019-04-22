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
                    <h1 class="page-header ">Users
                        <small>List</small>
                    </h1>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary refresh" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> Refresh</button>&nbsp;<button class="btn btn-success add"><i class="fas fa-user-plus"></i> AddUser</button>
                </div>
            </div>


            <hr>
        <table id="example" class="table display cell-border mt-2" style="width:100%">
            <thead>
            <tr>

                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Modifly</th>

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
                <div class="modal-body shownaptien">

                    <form id="formnaptien">
                        <div class="form-group">
                            <label  class="col-form-label">Số tiền:</label>
                            <input type="text" class="form-control " id="tiennap">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary buttonnt" value="" ></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>


                </div>
                <div class="information">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="" class="avatar" width="250px" alt="" style="margin: 10px 30px;">
                        </div>
                        <div class="col-md-7">
                            <div class="infouser">

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
                            <label  class="col-form-label">Họ tên:</label>
                            <input type="text" class="form-control " id="name">
                            <span id="errorname" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Email:</label>
                            <input type="email"  class="form-control" id="email">
                            <span id="erroremail" style="color: red"></span>

                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Chứng minh thư:</label>
                            <input type="text"  class="form-control" id="CMT" onblur="valiCMT(this.value)">
                            <span id="errorCMT" style="color: red"></span>

                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Level:</label>
                            <select class="form-control" id="level" onchange="ChangeLevel(this.value)">
                                <option value="0">User</option>
                                @if(Auth::user()->level==1)

                                <option value="1">Quản lý</option>
                                <option value="2">Nhân viên</option>
                                    @endif
                            </select>
                        </div>
                        <div class="form-group" id="displaystatus">
                            <label  class="col-form-label">Loại TK:</label>
                            {{--<select class="form-control" id="loaiTK">
                                <option value="1">Thường</option>
                                <option value="2">Vip I</option>
                                <option value="3">Vip II</option>

                            </select>--}}
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
            $('.text-lsnaptien').scroll();

            var table= $('#example').DataTable({
                "order": [[ 2, "asc" ]],
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                paging: true,
                processing:false,


                ajax:'{{asset('admin/user/data')}}',
                columns:[
                    {data:'name'},
                    {data:'email'},
                    {data:'level',"render": function (data, type, row) {

                            if (row.level === 1) {
                                return 'Quản lý';
                            }else if(row.level === 0){
                                return 'User';
                            }else if(row.level === 2){
                                return 'Nhân viên';
                            };

                        }},
                    {data:'tien',"render": function (data, type, row) {

                            if (row.level === 1||row.level===2 ){
                                    return '';
                            }else{
                                return'<p>'+data.toString().replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ <button class="btn btn-outline-warning naptien" title="nạp tiền" style="float: right" value="'+row.id+'"><i class="fas fa-dollar-sign"></i> Nạp tiền</button></p>';

                            };

                        }},
                    {data:'activated',"render": function (data, type, row) {

                            if (row.activated === 1 ){
                                if(row.level===1||row.level===2){
                                    return '';
                                }else {
                                    return '<p style="color: #31b131">Đã kích hoạt</p>';
                                }
                            }else{
                                return'<p style="color: red">Chưa kích hoạt</p>';
                            };

                    }},
                    {data:'Modifly',
                        "searchable": false,
                        "orderable":false,
                        "render": function (data, type, row) {
                            if (row.activated==0){
                                return '<button class="btn btn-outline-info info" title="info" value="'+row.id+'"><i class="fas fa-info-circle"></i></button>&nbsp;<button class="btn btn-outline-success activated" title="Phê duyệt"  value="'+row.id+'"><i class="far fa-check-circle"></i></button>&nbsp;<button class="btn btn-outline-danger delete" title="Hủy bỏ" value="'+row.id+'"><i class="fas fa-times-circle"></i></button>'
                            }else {
                                return '<button class="btn btn-outline-info info" title="info" value="'+row.id+'"><i class="fas fa-info-circle"></i></button>&nbsp;<button class="btn btn-outline-primary edit" value="' + row.id + '"><i class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-outline-danger delete" value="' + row.id + '"><i class="fas fa-trash"></i></button>'
                            }
                    }},

                ]
            });
            $(document).on('click','.naptien',function () {
                $.ajax({
                    url: '{{asset("admin/user/edit")}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {id:$(this).val()},
                    success:function(data){
                        data=data.data;
                        $('#modaluser').removeClass('modal-lg');
                        $('#UserModal').modal('show');
                        $('.shownaptien').show();
                        $('#formsubmit').hide();
                        $('.information').hide();
                        $('.buttonnt').text('Nạp tiền');
                        $('.buttonnt').val(data.id);

                        $('.modal-title').text('Nạp tiền tài khoản: '+data.name);

                    }
                })
            });
            $('#formnaptien').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("admin/naptien/add")}}',
                    type:'POST',
                    dataType:'json',
                    data:{id:$('.buttonnt').val(),tiennap:$('#tiennap').val()},
                    success:function (data) {
                        alert(data.success);
                        $('#UserModal').modal('hide');
                        table.ajax.reload();
                    }
                })
            });
            $(document).on('click','.info',function () {
                $('#modaluser').addClass('modal-lg');
                $('.shownaptien').hide();
                $.ajax({
                    url: '{{asset("admin/user/edit")}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {id:$(this).val()},
                    success:function(data){
                        $('#UserModal').modal('show');
                        $('.modal-title').text('Infomation '+data.data.name);
                        $('#formsubmit').hide();
                        $('.information').show();
                        $('.avatar').attr('src','images/'+data.data.hinhanh);
                        var abc='';
                        abc='<nav>\n' +
                            '<div class="nav nav-tabs" id="nav-tab" role="tablist">\n' +
                            '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>';
                        if(data.data.level===0) {
                            abc += '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Lịch sử nạp tiền</a>';
                        }
                        abc+='</div>\n' +
                            '</nav>\n' +
                            '<div class="tab-content" id="nav-tabContent">\n' +
                            '<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><div class="text-deltais"></div></div>\n' +
                            '<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><div class="text-lsnaptien"></div></div>\n' +
                            '</div>'
                        $('.infouser').html(abc);
                        var html='';
                        html+='<p><i class="nav-icon fas fa-ad teal"></i> <b>Name:</b> '+data.data.name +' </p>';
                        html+='<p><i class="nav-icon fas fa-envelope "></i> <b>Email:</b> '+data.data.email+'</p>';
                        html+='<p><i class="fas fa-id-card"></i> <b>Chứng minh thư:</b> '+data.data.CMT+'</p>';
                        if (data.data.level===1){
                            html+='<p><i class="far fa-star"></i> <b>Chức vụ:</b> Quản lý</p>';
                        };
                        if (data.data.level===0){
                            html+='<p><i class="far fa-star"></i> <b>Chức vụ:</b> User</p>';
                        };
                        if (data.data.level===2){
                            html+='<p><i class="far fa-star"></i> <b>Chức vụ:</b> Nhân viên</p>';
                        };

                        if(data.data.beginloaiTK!=null && data.data.endloaiTK!=null){
                            if (data.data.loaiTK===1){
                                html+='<p><i class="fas fa-chess-knight"></i> <b>Loại tài khoản:</b> Thường</p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày đăng ký TK Thường:</b> '+data.data.beginloaiTK+'</p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày hết hạn TK Thường:</b> '+data.data.endloaiTK+'</p>';

                            };
                            if (data.data.loaiTK===2){
                                html+='<p><i class="fas fa-chess-knight"></i><b>Loại tài khoản:</b> Vip I</p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày đăng ký TK Vip I:</b> '+data.data.beginloaiTK+'</p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày hết hạn TK Vip I:</b> '+data.data.endloaiTK+'</p>';

                            };
                            if (data.data.loaiTK===3){
                                html+='<p><i class="fas fa-chess-knight"></i> <b>Loại tài khoản:</b>Vip II</p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày đăng ký TK Vip II</b> '+data.data.beginloaiTK+'</p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày hết hạn TK Vip II:</b> '+data.data.endloaiTK+'</p>';


                            };
                        }else{
                            if (data.data.level===0){
                                html+='<p><i class="fas fa-chess-knight"></i> <b>Loại tài khoản:</b> <span style="color: red">Đợi kích hoạt</span> </p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày đăng ký TK Thường:</b> <span style="color: red">Đợi kích hoạt</span></p>';
                                html+='<p><i class="far fa-clock"></i> <b>Ngày hết hạn TK Thường:</b> <span style="color: red">Đợi kích hoạt</span></p>';
                            };
                        }
                        if(data.data.level===0){
                            html+='<p><i class="fas fa-dollar-sign"></i><b> Số tiền hiện có:</b> '+data.data.tien.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ</p>';
                        }
                        $('.text-deltais').html(html);
                        var lsnt='';
                        $.each(data.vitien,function (key,value) {
                            lsnt+='<ul class="list-group">\n' +
                                '  <li class="list-group-item"><i class="far fa-clock"></i> '+value.ngaynap+': Đã nạp '+value.tiennap.toString().replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ <span style="float: right">'+value.nguoinap+'</span></li>\n' +
                                '</ul>';
                        });

                        $('.text-lsnaptien').html(lsnt);
                    }
                })

            });
            $(document).on('click','.activated',function () {
                $.ajax({
                    url:'{{asset("admin/user/active")}}',
                    type:'POST',
                    dataType:'json',
                    data:{value:$(this).val()},
                    success:function(data){
                        alert(data.success);
                        table.ajax.reload();
                    }
                })
            });

            $(document).on('click','.add',function () {
                $('#UserModal').modal('show');
                $('.shownaptien').hide();
                $('#formsubmit').show();
                $('.information').hide();
                $('#modaluser').removeClass('modal-lg');
                $('.resetpassword').hide();
                $('.modal-title').text('Thêm mới');
                $('.submitbutton').text('Thêm mới');
                $('#action').val('Add');
                $('#name').removeClass('is-invalid');
                $('#errorname').text('');
                $('#email').removeClass('is-invalid');
                $('#erroremail').text('');
                $('#CMT').removeClass('is-invalid');
                $('#errorCMT').text('');
                $('#CMT').prop('readonly', false);
                $('#email').prop('readonly', false);
                $('#formsubmit')[0].reset();


            });
            $(document).on('click','.resetpassword',function () {
                $.ajax({
                    url:'{{asset("admin/user/resetpass")}}',
                    type:'POST',
                    dataType:'json',
                    data:{value:$(this).val()},
                    success:function(data){
                        alert(data.success);

                        $('#UserModal').modal('hide');
                    }
                })
            });
            $(document).on('click','.edit',function () {
                $('.submitbutton').val($(this).val());
                $('.resetpassword').val($(this).val());
                $('.shownaptien').hide();
                $.ajax({
                    url: '{{asset("admin/user/edit")}}',
                    type: 'GET',
                    dataType: 'json',
                    data: {id:$(this).val()},
                    success:function(data){
                        data=data.data;
                        $('#modaluser').removeClass('modal-lg');
                        $('#UserModal').modal('show');
                        $('#formsubmit').show();
                        $('.information').hide();
                        if (data.level==1||data.level==2){
                            $('#displaystatus').hide();
                        }else{
                            $('#displaystatus').show();
                        }
                        $('.modal-title').text('Edit '+data.name);
                        $('.submitbutton').text('Update');
                        $('#action').val('Edit');
                        $('.resetpassword').show();
                        $('#CMT').prop('readonly', true);
                        $('#email').prop('readonly', true);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#CMT').val(data.CMT);
                        $('#level').val(data.level);
                        $('#loaiTK').val(data.loaiTK);
                        $('#name').removeClass('is-invalid');
                        $('#errorname').text('');
                        $('#email').removeClass('is-invalid');
                        $('#erroremail').text('');
                        $('#CMT').removeClass('is-invalid');
                        $('#errorCMT').text('');



                    }
                })


            });
            $(document).on('click','.delete',function () {
                if (confirm('Bạn muốn xóa?')){
                    $.ajax({
                        url:'{{asset("admin/user/delete")}}',
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
                    var email=$('#email').val();
                    var CMT=$('#CMT').val();
                    var level=$('#level').val();
                    //var loaiTK=$('#loaiTK').val();
                    var _token=$('input[name="_token"]').val();

                    $.ajax({
                        url:'{{asset("admin/user/add")}}',
                        type: 'POST',
                        dataType: 'json',
                        data: {name: name,email:email,CMT:CMT,level:level,_token:_token},
                        success:function (data) {
                            if(data.errors.length >0){
                                if(data.errors[0].name){
                                    $('#name').addClass('is-invalid');
                                    $('#errorname').text(data.errors[0].name);
                                }else{
                                    $('#name').removeClass('is-invalid');
                                    $('#errorname').text('');
                                }
                                if(data.errors[0].email){
                                    $('#email').addClass('is-invalid');
                                    $('#erroremail').text(data.errors[0].email);
                                }else{
                                    $('#email').removeClass('is-invalid');
                                    $('#erroremail').text('');
                                }
                                if(data.errors[0].CMT){
                                    $('#CMT').addClass('is-invalid');
                                    $('#errorCMT').text(data.errors[0].CMT);
                                }else{
                                    $('#CMT').removeClass('is-invalid');
                                    $('#errorCMT').text('');
                                }
                            }else{
                                alert(data.success);
                                table.ajax.reload();
                                $('#UserModal').modal('hide');
                                $('#formsubmit')[0].reset();
                            }

                        }
                    });

                }else if($('#action').val()==='Edit'){
                    var name=$('#name').val();
                    var level=$('#level').val();
                    var loaiTK=$('#loaiTK').val();
                    var _token=$('input[name="_token"]').val();
                    $.ajax({
                        url:'{{asset('admin/user/update')}}',
                        type:'POST',
                        dataType:'json',
                        data: {id:$('.submitbutton').val(),name: name,level:level,loaiTK:loaiTK,_token:_token},
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
                                $('#UserModal').modal('hide');
                                $('#formsubmit')[0].reset();
                            }

                        }

                    });
                }
            })
        } );


    </script>
@stop
