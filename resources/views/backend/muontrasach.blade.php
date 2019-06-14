@extends('backend.master')
@section('style')
    <style>
        img{
            box-shadow: 0px 2px 5px 5px #dfd3d3;
            margin-top: 10px;

        }
        th.dt-center, td.dt-center { text-align: center; }
        #infomuonsach,#hoadon {
            font-family: Tahoma;
            font-size: 16px;
            line-height: 20px;
        }
        #hoadon u {
            font-weight: bold;
        }
        #infomuonsach table{
            font-size: 14px;
        }

        #infomuonsach u {
            font-weight: bold;
        }
        #hoadon p span{

            font-weight: bold;
        }
        #hoadon h3{
            text-align: center;
            font-weight: bold;
        }
        #infomuonsach p span{

            font-weight: bold;
        }
        #infomuonsach h3{
            text-align: center;
            font-weight: bold;
        }
        .text-header {
            padding: 10px 10px;
        }
        .text-header p{
            float: right;
            margin-right: 5em;
        }
        .text-body{
            margin: 0;
            padding: 0;
        }
        .text-body p{
            text-transform: capitalize;
            padding: 10px 10px;
            margin: 0;

        }
        .text-body table{
            text-align: center;
            text-transform: capitalize;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: red;
        }
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: #F44336;
            background: #333333;
        }

    </style>
    @endsection
@section('content')


    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Quản lý mượn sách & trả sách
                <small>List</small>
            </h1>
        </div>

            <div class="col-md-3">
                <button class="btn btn-outline-secondary refresh" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> Refresh</button>&nbsp;<a class="btn btn-success" href="{{asset('admin/muontrasach/add')}}"><i class="far fa-plus-square"></i> Đăng ký mượn</a>
            </div>

    </div>


    <hr>
    <table id="example" class="table display cell-border mt-2" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tài khoản mượn</th>
            <th>Ngày mượn</th>
            <th>Hạn trả</th>
            <th>Người đăng ký</th>
            <th>Tình trạng</th>
            <th>Modifly</th>

        </tr>
        </thead>
    </table>
    <div class="modal fade bd-example-modal-lg" id="MTSModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="infomuonsach">

                    </div>
                    <div id="editmuonsach">

                    </div>
                    <div id="trasach">

                    </div>
                    <div id="hoadon">

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "images/sach";
            var $state = $(
                '<span><img width="50px" src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.jpg" class="img-flag" /> ' + state.text + '</span>'
            );
            return $state;
        };
        function editSelect2() {
            $('#sach_id').select2({
                templateResult: formatState,
                width:'100%',

            });
            $('#sach_id').on('select2:select', function (e) {
                var value=$(this).val();

                $.ajax({
                    url:'{{asset("admin/muontrasach/datcoc")}}',
                    type:'POST',
                    dataType:'json',
                    data:{value:value},
                    success:function (data) {
                        $('#tiencoc').html('Số tiền phải đặt cọc: <span style="color:red"> '+data.toString().replace(
                            /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ</span>');
                        $('#tiendc').val(data);

                        if ($('#tienht').val() >$('#tiendc').val()){
                            $('.formnt').show();
                        }
                    }
                })

            });
            $('#sach_id').on('select2:unselect', function (e) {
                var value=$(this).val();
                $.ajax({
                    url:'{{asset("admin/muontrasach/datcoc")}}',
                    type:'POST',
                    dataType:'json',
                    data:{value:value},
                    success:function (data) {
                        $('#tiencoc').html('Tiền đặt cọc: <span style="color:red"> '+data.toString().replace(
                            /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ</span>');
                        $('#tiendc').val(data);
                        if ($('#tienht').val()>$('#tiendc').val()){
                            $('.formnt').hide();
                        }
                    }
                })

            });

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

                ajax:'{{asset("admin/muontrasach/data")}}',
                columns:[
                    {data:'id',"width":"5%"},
                    {data:'taikhoanmuon'},
                    {data:'ngaymuon'},
                    {data:'hantra'},
                    {data:'nguoidk'},
                    {data:'tinhtrang',
                        "render": function (data, type, row) {
                            if (row.tinhtrang==0){
                                if (row.tra>0){
                                    return '<p>Đã Trả: '+row.tra+' quyển - Còn lại: '+row.muon+' quyển</p>';
                                }else{
                                    return '<p> Đang Mượn: '+row.muon+' quyển</p>';
                                }

                            }else{
                                return '<p>Đã trả đủ</p>';
                            }
                        }
                    },
                    {data:'Modifly',
                        "searchable": false,
                        "orderable":false,
                        "render": function (data, type, row) {
                        if (row.tinhtrang==0) {
                            if (row.tra>0){
                                return '<button class="btn btn-outline-info phieumuon" value="' + row.id + '">Phiếu mượn</button>&nbsp<!-- Example single danger button -->\n' +
                                    '<div class="btn-group">\n' +
                                    '  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                                    '    Hành động\n' +
                                    '  </button>\n' +
                                    '  <div class="dropdown-menu">\n' +
                                    '    <a class="dropdown-item hoadon"  id="' + row.id + '">Hóa đơn</a>\n' +
                                    '    <a class="dropdown-item giahan" href="" id="' + row.id + '">Gia hạn</a>\n' +
                                    '  </div>\n' +
                                    '</div> @if(Auth::user()->level==1)<button class="btn btn-danger delete" value="' + row.id + '"><i class="fas fa-trash-alt"></i></button>@endif';
                            }else{
                                return '<button class="btn btn-outline-info phieumuon" value="' + row.id + '">Phiếu mượn</button>&nbsp<!-- Example single danger button -->\n' +
                                    '<div class="btn-group">\n' +
                                    '  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\n' +
                                    '    Hành động\n' +
                                    '  </button>\n' +
                                    '  <div class="dropdown-menu">\n' +
                                    '    <a class="dropdown-item edit" href="" id="' + row.id + '">Edit</a>\n ' +
                                    '    <a class="dropdown-item trasach" href="" id="' + row.id + '">Trả sách</a>\n' +
                                    '    <a class="dropdown-item giahan" href="" id="' + row.id + '">Gia hạn</a>\n' +
                                    '  </div>\n' +
                                    '</div> @if(Auth::user()->level==1)<button class="btn btn-danger delete" value="' + row.id + '"><i class="fas fa-trash-alt"></i></button>@endif';
                            }

                        }else{
                            return '<button class="btn btn-outline-info phieumuon" value="' + row.id + '">Phiếu mượn</button>&nbsp<button class="btn btn-outline-info hoadon" id="'+row.id+'">Hóa đơn</button> '
                        }
                        }},

                ]
            });
            
            $(document).on('click','.delete',function () {
                if(confirm('Bạn muốn xóa?')){
                    $.ajax({
                        url:'{{asset("admin/muontrasach/delete")}}',
                        type:'POST',
                        data:{id:$(this).val()},
                        success:function (data) {
                            alert(data.success);
                            table.ajax.reload();
                        }
                    })
                }
            });

            $(document).on('click','.phieumuon',function () {
                $('#MTSModal').modal('show');
                $('.modal-title').text('');
                $('#infomuonsach').show();
                $('#editmuonsach').hide();
                $('#hoadon').hide();
                $('#trasach').hide();

                $.ajax({
                    url:'{{asset("admin/muontrasach/phieumuon")}}',
                    type:'POST',
                    data:{id:$(this).val()},
                    success:function (data) {
                        $('#infomuonsach').html(data);
                    }
                })
            });
            $(document).on('click','.hoadon',function () {


                $.ajax({
                    url:'{{asset("admin/hoadonsach")}}',
                    type:'POST',
                    data:{id:$(this).attr('id')},
                    success:function (data) {
                        $('#MTSModal').modal('show');
                        $('.modal-title').text('Hóa đơn trả sách');
                        $('#hoadon').show();
                        $('#infomuonsach').hide();
                        $('#editmuonsach').hide();
                        $('#trasach').hide();

                        $('#hoadon').html(data);
                    }
                })
            });

            $(document).on('click','.clickhd',function () {
                $('.hoadon123').addClass('hide')
                $('#hoadon-'+$(this).val()).removeClass('hide');
            });
            
            $(document).on('click','.edit',function (e) {
                e.preventDefault();
                $('#MTSModal').modal('show');
                $('#infomuonsach').hide();
                $('#editmuonsach').show();
                $('#action').val('edit');
                $('#trasach').hide();
                $('#hoadon').hide();

                $.ajax({
                    url:'{{asset("admin/muontrasach/edit")}}',
                    type:'GET',
                    data:{id:$(this).attr('id')},
                    success:function (data) {
                        $('.modal-title').text('Edit Phiếu Mượn');
                        $('#editmuonsach').html(data);
                        $('.buttonedit').text('Update');

                        editSelect2();
                        

                    }
                })
            });
            $(document).on('click','.trasach',function (e) {
                e.preventDefault();
                $('#MTSModal').modal('show');
                $('#infomuonsach').hide();
                $('#editmuonsach').hide();
                $('#trasach').show();
                $('#hoadon').hide();



                var html='';
                $('#trasach').html(html);


            });
            $(document).on('submit','#formeditpm',function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('id',$('.buttonedit').val());
                formData.append('tiendatcoc',$('#tiendc').val());
                $.ajax({
                    url:'{{asset("admin/muontrasach/update")}}',
                    type:'POST',
                    dataType:'json',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function (data) {
                        alert(data.success);
                        table.ajax.reload();
                        $('#MTSModal').modal('hide');
                    }
                })
            })

        });


    </script>
@stop
