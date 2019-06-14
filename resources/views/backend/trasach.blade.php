@extends('backend.master')
@section('style')
    <style>
        #hoadonsach {
            font-family: Tahoma;
            font-size: 16px;
            line-height: 20px;
        }
        #hoadonsach u {
            font-weight: bold;
        }
        #hoadonsach p span{

            font-weight: bold;
        }
        #hoadonsach h3{
            text-align: center;
            font-weight: bold;
        }


        #phieumuon{
            font-family: Tahoma;
            font-size: 16px;
            line-height: 20px;
        }
        #phieumuon u {
            font-weight: bold;
        }
        #phieumuon p span{

            font-weight: bold;
        }
        #phieumuon h3{
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
    </style>
    @endsection
@section('content')

    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Trả Sách

            </h1>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-5">
            <form class="form-inline" id="searchpm">
                <select class="form-control mb-2 mr-sm-2" id="column" name="column">
                    <option value="id">Mã phiếu mượn</option>
                    {{--<option value="email">Tên tài khoản</option>--}}
                </select>
                <input required type="text" class="form-control mb-2 mr-sm-2" id="tukhoa" name="tukhoa" value="15" placeholder="Nhập .....">


                <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-sm-4"></div>

    </div>
    <div class="row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8" id="phieumuon">
        </div>
        <div class="col-sm-2"></div>

    </div>



@endsection
@section('script')
    <script>
        $(document).ready(function () {
            // $('#HoaDonModal').modal('show')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#searchpm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("admin/muontrasach/searchpm")}}',
                    type:'POST',
                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function (data) {
                        $('#phieumuon').html(data);
                    }
                })
            })
            $(document).on('click','.buttontrasach',function () {
                $('#TraSachModal').modal('show');
                $('.err').hide();
            });
            // $(document).on('click','#close',function () {
            //     $('.err').hide();
            // });
            $('#closehd').click(function () {
                window.location.href='{{asset("admin/muontrasach")}}';
            });
            {{--$('#HoaDonModal').on('hidden.bs.modal', function (e) {--}}
                {{--window.location.href='{{asset("admin/muontrasach")}}';--}}
            {{--})--}}
            $(document).one('click','#clicksubmit',function (e) {
                e.preventDefault();

                var a=[];
                var b=[];
                var formData=new FormData($('#formtrasach')[0]);
                $('.sach_id:checked').each(function () {
                    a.push($(this).val());
                    b.push($('#tinhtrang-'+$(this).val()).val());
                });
                formData.append('sach_id',a);
                formData.append('tinhtrang',b);
                $.ajax({
                    url:'{{"admin/muontrasach/trasach"}}',
                    type:'POST',
                    data: formData,
                    cache:false,
                    processData:false,
                    contentType:false,
                    success:function (data) {
                        if (data.success !=''){
                            alert(data.success);
                            $('#TraSachModal').modal('hide');
                            var id=data.hoadon;
                            $.ajax({
                                url:'{{asset("admin/hoadonsach/hdct")}}',
                                type:'GET',
                                data:{id:id},
                                success:function (data) {

                                    // $('#HoaDonModal').modal('show');
                                    $('#phieumuon').html(data);
                                    $('#convert-pdf').html('<a href="{{asset('admin/hoadonsach/hoadonpdf')}}'+'/'+id+'" target="_blank" class="btn btn-danger"> Convert PDF</a>')
                                }
                            });


                        }else{
                            $('.err').show();
                            $('.err').html(' <p>Tài khoản thiếu: '+data.errors.toString().replace(
                                /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ để trả sách. <a href="admin/user">Vui lòng nạp tiền</a><span id="close" style="float: right;color: #3a4343;cursor: pointer">&times;</span></p>')
                        }

                    }
                })
            })
            {{--$(document).on('submit','#formtrasach',function (e) {--}}

            {{--})--}}
        })
    </script>

@stop