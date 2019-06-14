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
        #clickimage{
            width: 6em; border: 1px dashed;background: snow;cursor: pointer; margin-left: 10px
        }
        #clickimage2{
            width: 6em; border: 1px dashed;background: snow;cursor: pointer; margin-left: 10px
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
            <th>ID</th>
            <th>Tên đồ uống</th>
            <th>Giá cả</th>
            <th>Thể loại</th>
            <th></th>

        </tr>
        </thead>
    </table>
    <!-- Modal -->
    <form id="modal1">
        <div class="modal fade" id="DoUongModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " id="modaltheloai" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm đồ uống</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label  class="col-form-label">Tên đồ uống</label>
                            <input name="ten"  class="form-control" id="theloai" placeholder="Tên đồ uống">
                            <span id="errorname" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Giá</label>
                            <input name="gia"  class="form-control"  placeholder="Giá">
                            <span id="errorgia" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Thể loại</label>
                            <select class="form-control" name="theloai">
                                <ul>
                                @foreach($theloai as $index =>$values)

                                        <option value="{{$values->id}}" class="list-group-item">
                                            {{$values->theloai_douong_name}}
                                        </option>

                                @endforeach
                                </ul>
                            </select>
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
                        <button type="submit" class="btn btn-primary submitbutton" id="addDrinks" >Thêm mới</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        {{csrf_field()}}
    </form>
    <form id="modal2">
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " id="modaltheloai" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sửa đồ uống</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label  class="col-form-label">Tên đồ uống</label>
                            <input name="editten"  class="form-control" id="editten" placeholder="Tên đồ uống">
                            <span id="errorname2" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Giá</label>
                            <input name="editgia" id="editgia" class="form-control"  placeholder="Giá">
                            <span id="errorgia2" style="color: red"></span>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Thể loại</label>
                            <select class="form-control" name="theloai">
                                <ul>
                                    @foreach($theloai as $index =>$values)

                                        <option value="{{$values->id}}" class="list-group-item">
                                            {{$values->theloai_douong_name}}
                                        </option>

                                    @endforeach
                                </ul>
                            </select>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Hình Ảnh:</label>
                            <input type="file" class="form-control hide " id="hinhanh2" name="hinhanh" >
                            <img src="1.png" alt="" id="clickimage2" >
                            <span id="errorhinhanh" style="color: red"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="action" value="">
                        <button type="submit" class="btn btn-primary submitbutton" id="editDrinks" name="id" >Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        {{csrf_field()}}
    </form>
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

            ajax:'{{asset('admin/menu/data')}}',
            columns:[
                {data:'id'},
                {data:'tendouong',"width":"20%",'render':function (data,type,row) {
                        return '<img width="130px" src="images/'+row.anh+'"/><p>'+row.tendouong+'</p>';
                    }},

                {data:'gia'},
                {data:'theloai_douong_name'},
                {data:'Modifly',
                    "render": function (data, type, row){
                        return '</button>&nbsp;<button class="btn btn-outline-primary edit"  placeholder="'+row.menu+'" value="' + row.id + '" ><i class="fas fa-edit"></i></button>&nbsp;<button class="btn btn-outline-danger delete"  placeholder="'+row.menu+'" value="' + row.id + '" ><i class="fas fa-trash"></i></button>'
                    }},
            ]
        });
        $('#clickimage').click(function () {
            $('#hinhanh').click();
        })
        $('#clickimage2').click(function () {
            $('#hinhanh2').click();
        });
        $('#hinhanh2').change(function (e) {
            console.log(e)
            if (e.target.files && e.target.files[0]){
                if (e.target.files[0].type =='image/jpg' || e.target.files[0].type =='image/png'||e.target.files[0].type =='image/jpeg'){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        //Thay đổi đường dẫn ảnh
                        $('#clickimage2').attr('src',e.target.result);

                    }
                    reader.readAsDataURL(e.target.files[0]);
                }else{
                    alert('Hình Ảnh không đúng định dạng')
                }
            }

        });
        $('#hinhanh').change(function (e) {
            console.log(e)
            if (e.target.files && e.target.files[0]){
                if (e.target.files[0].type =='image/jpg' || e.target.files[0].type =='image/png'||e.target.files[0].type =='image/jpeg'){
                    var reader = new FileReader();
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

        $(document).on('click','.add',function () {
            $('#DoUongModal').modal('show');
            $('#modal1')[0].reset();
            $('#errorname').text("");
            $('#errorgia').text("");
        });
        $(document).on('click','.edit',function () {
           //alert( $('.submitbutton').val($(this).val()));
            $('#errorname2').text("");
            $('#errorgia2').text("");
            $('#modal1')[0].reset();
            $('.submitbutton').val($(this).val())
            $.ajax({
                url: '{{asset("admin/menu/getdouong")}}',
                type: 'GET',
                dataType: 'json',
                data: {id:$(this).val()},
                success:function(data){
                    $('#editten').val(data.data[0].tendouong);
                    $('#editgia').val(data.data[0].gia);
                    $('#EditModal').modal('show');
                    $("#theloai option[value="+data.data[0].theloai_douong+"]").attr('selected','selected');

                }
            })


        });
        $(document).on('click','.delete',function () {
            if (confirm('Bạn muốn xóa?')){
                $.ajax({
                    url:'{{asset("admin/menu/delete")}}',
                    type:'GET',
                    data:{id:$(this).val()},
                    success:function (data) {
                        alert(data.success);
                        table.ajax.reload();
                    }
                })
            }
        });
        $('#modal2').submit(function (e) {
            e.preventDefault();
            var formData=new FormData(this);
            formData.append('id',$('.submitbutton').val());
            $.ajax({
                url:'{{asset("admin/menu/edit")}}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType:false,
                cache:false,
                processData:false,
                success:function (data) {
                    if(data.errors.length >0){
                        $('#errorname2').text(data.errors[0].editten);
                        $('#errorgia2').text(data.errors[0].editgia);

                    }else{
                        alert(data.success);
                        table.ajax.reload();
                        $('#EditModal').modal('hide');
                        //$('#EditModal')[0].reset();
                        $('#modal2')[0].reset();
                    }
                console.log(data);

                }
            });
        })
        $('#modal1').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url:'{{asset("admin/menu/add")}}',
                type: 'POST',
                dataType: 'json',
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function (data) {
                    if(data.errors.length >0){
                        $('#errorname').text(data.errors[0].ten);
                        $('#errorgia').text(data.errors[0].gia);
                        console.log(data.errors)
                    }else{
                        alert(data.success);
                        table.ajax.reload();
                        $('#DoUongModal').modal('hide');
                        $('#modal1')[0].reset();
                    }

                }
            });
        })
    });
</script>
@stop
