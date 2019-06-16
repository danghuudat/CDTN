@extends('frontend.master')
@section('style')
    <style>
        .hide{
            display: none;
        }
        .foter{
            margin-left: 50px;
        }
        #editavatar{
            cursor: pointer;
            position: absolute;
            left: 50px;
            top: 79px;
            display: none;
        }
        .text-deltais{
            padding-left: 50px;
        }
        .avartar{
            position: relative;
        }

        .avartar:hover img{
            opacity: 0.2;
            cursor: pointer;

        }
        .avartar:hover #editavatar{
            display: block;
        }
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
                   <div class="card">
                       <div class="card-header p-2">
                           <ul class="nav nav-pills">
                               <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Thông tin cá nhân</a></li>
                               <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Cài đặt</a></li>
                           </ul>
                       </div><!-- /.card-header -->
                       <div class="card-body">
                           <div class="tab-content">
                               <div class="active tab-pane"  id="information">
                                   <div class="post">
                                       <!-- /.user-block -->
                                       <div class="row">
                                           <div class="col-md-4">
                                               <form id="submitimage" enctype="multipart/form-data">
                                                   <div class="avartar">
                                                       <img class="hinhanh" style="margin-left: 17px" width="250px" src="{{asset('images/'.Auth::user()->hinhanh)}}"  alt="">
                                                       <a href="" class="btn btn-outline-success" id="editavatar" >Chỉnh sửa</a>
                                                       <input type="file" id="image" class="hide" name="hinhanh">
                                                   </div>
                                                   <div class="foter hide">

                                                       <button id="updateimage" type="submit" class="btn btn-outline-primary" value="{{Auth::user()->id}}"><i class="fas fa-wrench"></i></button>
                                                       <a href="" id="imageback" class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
                                                   </div>
                                               </form>


                                           </div>
                                           <div class="col-md-8">
                                               <div class="text-deltais">
                                                   <p><i class="nav-icon fas fa-ad teal"></i> <b>Họ tên:</b> {{Auth::user()->name}}</p>
                                                   <p><i class="nav-icon fas fa-envelope red"></i> <b>Email:</b> {{Auth::user()->email}}</p>
                                                   <p><i class="nav-icon fas fa-mobile-alt orange"></i> <b>Số điện thoại:</b> {{Auth::user()->SDT !=null ?'0'.Auth::user()->SDT : 'Chưa cập nhật' }}</p>
                                                   <p><i class="fas fa-id-card"></i> <b>Chứng minh thư:</b> {{Auth::user()->CMT}}</p>
                                                   @if(Auth::user()->level===0)
                                                       <p><i class="fas fa-chess-knight"></i> <b>Loại tài khoản:</b> {{Auth::user()->loaiTK}}</p>
                                                       <p><i class="far fa-clock"></i> <b>Ngày đăng ký TK Thường:</b> {{Auth::user()->loaiTK}}</p>
                                                       <p><i class="far fa-clock"></i> <b>Ngày hết hạn TK Thường:</b> {{Auth::user()->loaiTK}}</p>
                                                       <p><i class="fas fa-dollar-sign"></i><b> Số tiền hiện có:</b> {{number_format(Auth::user()->tien,0,'.','.')}} VNĐ</p>
                                                   @endif
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                               </div>

                               <div class="tab-pane"  id="settings">
                                   <form class="form-horizontal" id="forminfo">
                                       <div class="row">
                                           <div class="col-sm-8">
                                               <div class="form-group">
                                                   <label for="inputName" class="col-sm-4 control-label">Họ tên</label>

                                                   <div class="col-sm-10">
                                                       <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Chưa cập nhật">

                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label for="inputEmail"  class="col-sm-4 control-label">Email</label>

                                                   <div class="col-sm-10">
                                                       <input type="email" readonly value="{{Auth::user()->email}}" class="form-control"  placeholder="Email">
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label   class="col-sm-4 control-label">CMT</label>

                                                   <div class="col-sm-10">
                                                       <input type="text" readonly value="{{Auth::user()->CMT}}" class="form-control"  >
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-sm-4">
                                               <input type="file" id="imgchange" style="display: none" >
                                               <img  width="150px"   style="cursor: pointer" src="{{asset('images/'.Auth::user()->hinhanh)}}" alt="">

                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputName2"  class="col-sm-4 control-label">Số điện thoại:</label>

                                           <div class="col-sm-5">
                                               <input type="text" class="form-control" value="{{Auth::user()->SDT}}" name="sdt"  placeholder="Chưa cập nhật" id="sdt" >
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <label for="inputName2"  class="col-sm-4 control-label">Địa chỉ</label>

                                           <div class="col-sm-5">
                                               <input type="text" class="form-control" value="{{Auth::user()->diachi}}" name="diachi"  placeholder="Chưa cập nhật" id="diachi" >
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <div class="col-sm-offset-2 col-sm-10">
                                               <div class="checkbox">
                                                   <label>
                                                       <input type="checkbox" id="checkpass">Đổi password
                                                   </label>
                                               </div>
                                           </div>
                                       </div>

                                       <div class="changepw" style="display: none">
                                           <div class="form-group">
                                               <label   class="col-sm-4 control-label">Mật khẩu hiện tại:</label>

                                               <div class="col-sm-5">
                                                   <input type="text" class="form-control"  name="oldpw"  id="oldpw" >
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label   class="col-sm-4 control-label">Mật khẩu mới</label>

                                               <div class="col-sm-5">
                                                   <input type="text" class="form-control" name="newpw" id="newpw" >
                                               </div>
                                           </div>
                                       </div>

                                       <div class="form-group">
                                           <div class="col-sm-offset-2 col-sm-10">
                                               <div class="checkbox">
                                                   <label>
                                                       <input type="checkbox" id="dieukhoan" > I agree to the <a href="#">Điều khoản</a>
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                           <div class="col-sm-offset-2 col-sm-10">
                                               <button type="submit" class="btn btn-primary">Cập nhật</button>
                                           </div>
                                       </div>
                                   </form>
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

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#checkpass').click(function () {
                if ($(this).is(':checked')){
                    $('.changepw').show()
                }else{
                    $('.changepw').hide()
                }
            })

            $('#editavatar').click(function (e) {
                e.preventDefault();
                $('#image').click();
            })
            $('#image').change(function (e) {

                if (e.target.files && e.target.files[0]){
                    if (e.target.files[0].type =='image/jpg' || e.target.files[0].type =='image/png'||e.target.files[0].type =='image/jpeg'){
                        var reader = new FileReader();
                        //Sự kiện file đã được load vào website
                        reader.onload = function(e){
                            //Thay đổi đường dẫn ảnh
                            $('.hinhanh').attr('src',e.target.result);
                            $('.foter').removeClass('hide')

                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }else{
                        alert('Hình Ảnh không đúng định dạng')
                    }
                }

            });
            $('#imageback').click(function (e) {
                e.preventDefault();
                $('.hinhanh').attr('src','{{asset("images/".Auth::user()->hinhanh)}}');
                $('.foter').addClass('hide')
                $('#image').val('');

            })
            $('#submitimage').submit(function (e) {
                e.preventDefault();
                var formData=new FormData(this);
                formData.append('id',$('#updateimage').val());


                $.ajax({
                    url:'{{asset("profile/editimage")}}',
                    type:'POST',
                    dataType:'json',
                    data:formData,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function (data) {
                        alert(data.success);
                        window.location.reload();
                    }

                })
            })
            $('#forminfo').submit(function (e) {
                e.preventDefault();
                if ($('#dieukhoan').is(':checked')){
                    $.ajax({
                        url:'{{asset("profile/editinfo")}}',
                        type:'POST',
                        dataType:'json',
                        data:new FormData(this),
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function (data) {
                            if (data.errors.length>0){
                                alert(data.errors)
                            }else{
                                alert(data.success)
                                window.location.reload();
                            }
                        }

                    })
                }else{
                    alert('Bạn chưa đồng ý điều khoản')
                }

            })
        })
    </script>
@stop