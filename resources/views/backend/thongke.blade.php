@extends('backend.master')
@section('style')
    <style>
        .styleform{
            border-radius: 10px;
            border: 1px solid green;
            padding: 5px;
            width: 15%;
            padding-left: 20px;
        }
        .styleformdate{
            border-radius: 10px;
            border: 1px solid green;
            padding: 5px;
            width: 15%;
            padding-left: 20px;
        }
        #hoadonct {
            font-family: Tahoma;
            font-size: 16px;
            line-height: 20px;
        }
        #hoadonct u {
            font-weight: bold;
        }
        #hoadonct p span{

            font-weight: bold;
        }
        #hoadonct h3{
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
            <h1 class="page-header ">Thống kê

            </h1>
        </div>

    </div>
    <hr>
    <div style="text-align: center">
        <form action="" id="formthongke">
            <span>Thống kê theo: </span>
            <select name="action" class="styleform">
                <option value="sach">Sách</option>
                <option value="hoadonsach">Hóa đơn Sách</option>
            </select>
            <span>Từ</span>
            <input class="styleformdate" name="tungay" value="2019-05-11" type="date" >
            <span>Đến</span>
            <input class="styleformdate" name="denngay" value="2019-05-12" type="date">
            <button type="submit" class="btn btn-success">Thống kê</button>
            {{csrf_field()}}
        </form>
    </div>
    <div class="container">
        <div class="datacontent">
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modalhdct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="hoadonct">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        function removeDups(names) {
            var unique = {};
            names.forEach(function(i) {
                if(!unique[i]) {
                    unique[i] = true;
                }
            });
            return Object.keys(unique);
        }
        function compare( a, b ) {
            if ( a.soluong < b.soluong ){
                return -1;
            }
            if ( a.soluong > b.soluong ){
                return 1;
            }
            return 0;
        }
        function ChangeToSlug(string)
        {



            //Đổi chữ hoa thành chữ thường
            slug = string.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");


            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
           return slug;
        }



        $(document).ready(function () {
            $(document).on('click','.hoadonct',function () {
                $('#modalhdct').modal('show');
                $.ajax({
                    url:'{{asset("admin/hoadonsach/hdct")}}',
                    type:'GET',
                    data:{id:$(this).attr('data-id')},
                    success:function (data) {
                        $('#hoadonct').html(data)
                    }
                })
            })
            $('#formthongke').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("admin/thongke")}}',
                    type:'POST',
                    // dataType:'json',
                    data: new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function (data) {
                        if (data.sach.length !=0){
                            var a=data.sach;
                            var b=removeDups(a);
                            var array=[];
                            for(var i=0;i<b.length;i++){
                                var c=0
                                for(var j=0;j<a.length;j++) {
                                    if (b[i] == a[j]) {
                                        c += 1;
                                    }
                                }
                                var d={tensach:b[i],
                                    soluong:c}
                                array.push(d);

                            }
                            array=array.sort( compare  );
                            array=array.reverse();

                            var html='';
                            html+='<table class="table table-bordered mt-4" style="text-align: center">\n' +
                                '                <tr>\n' +
                                '                    <th>Tên sách</th>\n' +
                                '                    <th>Hình ảnh</th>\n' +
                                '                    <th>Số lượng mượn</th>\n' +
                                '                </tr>';
                            array.forEach(function (value) {
                                html+='<tr> <td>'+value.tensach+'</td><td><img width="120px" height="200px" src="{{asset('images/sach/')}}/'+ChangeToSlug(value.tensach)+'.jpg" alt=""></td><td>'+value.soluong+'</td></tr>'
                            })
                            html+='</table>';
                            $('.datacontent').html(html);
                        }else
                        if (data.hoadonsach.length !=0){
                            var html='';
                            html+='<table class="table table-bordered mt-4" style="text-align: center">\n' +
                                '                <tr>\n' +
                                '                    <th>Mã hóa đơn</th>\n' +
                                '                    <th>Chi tiết hóa đơn</th>\n' +
                                '                    <th>Ngày</th>\n' +
                                '                </tr>';
                            data.hoadonsach.forEach(function (value) {
                                html+='<tr> <td>'+value.id+'</td><td><button data-id="'+value.id+'" class="btn btn-outline-info hoadonct">Hóa dơn chi tiết</button></td><td>'+moment(value.created_at).format('D-MM-YYYY, h:mm A');+'</td></tr>'
                            })
                            html+='</table>';
                            $('.datacontent').html(html);
                        }else{
                            $('.datacontent').html('<strong>Không có dữ liệu tìm</strong>');
                        }

                    }
                })
            })
        })
    </script>
    @stop