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
            <h1 class="page-header ">Đồ uống
                <small>Danh sách</small>
            </h1>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-secondary refresh" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> Refresh</button>&nbsp;<button class="btn btn-success add" onclick="thanhtoan()"><i class="fas fa-money-check-alt"></i> Thanh toán</button>
        </div>
    </div>
    <div id="isPayCard">
        <div class="modal fade" id="CardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " id="modaltheloai" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Trả qua tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="checkbox">
                            <label class="checkbox-inline"><input type="checkbox"  id="traquataikhoan" onchange="trataikhoan()">Trả tài khoản</label>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Số chứng minh thư</label>
                            <input name="cmt"  class="form-control" id="socmt"  placeholder="Số chứng minh thư" disabled>
                            <span id="errorgia" style="color: red"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="action" value="">
                        <button type="submit" class="btn btn-primary submitbutton" onclick="checkcmt()" >Tiếp tục</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        {{csrf_field()}}
    </div>

    {{csrf_field()}}
    <div id="HoaDon">
        <div class="modal fade" id="HoaDonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " id="modaltheloai" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Trả qua tài khoản</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div style="text-align: center"><label>LightBook</label></div>
                            <div style="text-align: center; max-width: 200px; margin: auto">Đại học Thăng Long, đường Nghiêm Xuân Yêm, Hoàng Mai, HN</div>
                            <table style="max-width: 400px; margin: auto" class="table">
                                <thead>
                                <th></th>
                                <th></th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>HD</td>
                                    <td>HD001</td>
                                </tr>
                                <tr>
                                    <td>Khách hàng</td>
                                    <td id="tenkhachhang"></td>
                                </tr>
                                <tr>
                                    <td>Time in</td>
                                    <td id="timein"></td>
                                </tr>

                                </tbody>
                            </table>
                        <div style="max-width: 200px; margin: auto">----------------------------------------</div>
                            <table style="max-width: 400px; margin: auto; " class="table">
                                <thead style="">
                                    <th>Tên món</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </thead>
                                <tbody id="bodyhoadon">

                                </tbody>
                            </table>
                        </div>
                        <div style="max-width: 200px; margin: auto">----------------------------------------</div>
                        <div style="max-width: 200px; margin: auto">
                            <span>Tổng cộng:  &nbsp;</span><span id="tongcong">  </span>
                        </div>

                    <div class="modal-footer">
                        <input type="hidden" id="action" value="">
                        <button type="submit" class="btn btn-primary submitbutton" >Thanh toán</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        {{csrf_field()}}
    </div>

    <hr>
    <table id="example" class="table display cell-border mt-2" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên đồ uống</th>
            <th>Giá cả</th>
            <th>Thể loại</th>
            <th style="width: 200px !important;"></th>
            <th></th>

        </tr>
        </thead>
    </table>
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
                            return '<input class="form-control douong_'+row.id+'" style="width: 150px !important;" type="number" name="quantity" min="1" onkeyup="orderNumber('+row.id+')"  ></input>'
                        }},
                    {data:'Modifly',
                            "render":function(data,type,row){
                            return'<input type="checkbox"   data-gia="'+row.gia+'" onchange="order(this.id)" id="douong_'+row.id+'" value="'+row.tendouong+'" disabled></input>'
                        }}
                ]
            });
        });
        var isPayCard=0;
        function trataikhoan(){
            if($("#traquataikhoan").prop("checked") == true){
                $("#socmt").prop('disabled', false);
                isPayCard=1
            }
            else{
                $("#socmt").prop('disabled', true);
                isPayCard=0
            }
        }
        function thanhtoan(){
            $('#CardModal').modal('show')

        }

        function orderDrink(){
            $('#Ban').modal('show')
        }
        var ordering=[];


        function checkcmt() {
            if (isPayCard == 1) {
                if(ordering.length==0){
                    alert("chưa gọi đồ uống");
                    return false;
                }
                data={'thanhtoan':isPayCard,
                    'cmt' :$("#socmt").val(),
                        'douong':ordering}
                $.ajax({
                    url: '{{asset("admin/ban/checkcmt")}}',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        if(data.errors){
                            alert(data.errors);
                        }
                        else{
                            $('#HoaDonModal').modal('show');


                            document.getElementById("tenkhachhang").innerHTML = data.name[0]['name'];
                            var dateObj = new Date();
                            var month = dateObj.getUTCMonth() + 1; //months from 1-12
                            var day = dateObj.getUTCDate();
                            var year = dateObj.getUTCFullYear();

                            newdate = year + "/" + month + "/" + day;
                            document.getElementById("timein").innerHTML = newdate;
                            var tongcong=0;
                            $('#bodyhoadon').html('');
                            $.each( douong_soluong, function( index, value ) {
                                $( "#bodyhoadon" ).append( "<tr><td>"+value['ten']+"</td><td>"+value['soluong']+"</td><td>"+value['gia']+"</td><td>"+value['gia']*value['soluong']+"</td></tr>" );
                                tongcong=tongcong+(value['gia']*value['soluong']);
                            });
                            douong_soluong=[];
                            document.getElementById("tongcong").innerHTML = tongcong;
                            $("#socmt").prop('disabled', true);
                            $("#traquataikhoan").prop("checked", false);
                            isPayCard=0;
                            $.each(ordering, function (index,value) {
                                $('.'+value.id).val("");
                                $('#'+value.id).prop("checked", false);
                            })
                            ordering=[];
                            douong_soluong=[]

                        }
                    }

                })

            }
            else{
                if(ordering.length==0){
                    alert("chưa gọi đồ uống");
                    return false;
                }
                data={'thanhtoan':isPayCard,
                    'douong':ordering}
                $.ajax({
                    url: '{{asset("admin/ban/checkcmt")}}',
                    type: 'POST',
                    data: data,
                    success: function (data) {
                        if(data.errors){
                            alert(data.errors);
                        }
                        else{
                            var dateObj = new Date();
                            var month = dateObj.getUTCMonth() + 1; //months from 1-12
                            var day = dateObj.getUTCDate();
                            var year = dateObj.getUTCFullYear();

                            newdate = year + "/" + month + "/" + day;
                            document.getElementById("timein").innerHTML = newdate;
                            var tongcong=0;

                            $('#bodyhoadon').html('');

                            $.each( douong_soluong, function( index, value ) {
                                $( "#bodyhoadon" ).append( "<tr><td>"+value['ten']+"</td><td>"+value['soluong']+"</td><td>"+value['gia']+"</td><td>"+value['gia']*value['soluong']+"</td></tr>" );
                                tongcong=tongcong+(value['gia']*value['soluong']);
                            });
                            douong_soluong=[];
                            document.getElementById("tongcong").innerHTML = tongcong;
                            document.getElementById("tenkhachhang").innerHTML = 'Khách hàng';
                            $("#socmt").prop('disabled', true);
                            $("#traquataikhoan").prop("checked", false);
                            $('#HoaDonModal').modal('show')
                            $.each(ordering, function (index,value) {
                                $('.'+value.id).val('');
                                $('#'+value.id).prop("checked", false);
                            })
                            ordering=[];

                        }
                    }

                })

            }
        }
        var douong_soluong=[];
        function order(id) {
            if($("#"+id).prop("checked") == true){
                var b={id : id,
                    soluong:$("."+id).val()}
                ordering.push(b);
                var c={ten:$('#'+id).val(),
                    soluong:$("."+id).val(),
                    gia:$("#"+id).attr('data-gia')
                };
                douong_soluong.push(c);
                console.log(douong_soluong);
            }
            else{
                for(i=0;i<ordering.length;i++){
                    if(ordering[i]['id']==id){
                        ordering.splice(i,1)
                    }
                }
                for(i=0;i<douong_soluong.length;i++){
                    if(douong_soluong[i]['ten']==$('#'+id).val()){
                        douong_soluong.splice(i,1)
                    }
                }
            }
        }
        function orderNumber(a) {
            if($(".douong_"+a).val()==""||$(".douong_"+a).val()==0){
                $("#douong_"+a).prop("checked", false);
                $("#douong_"+a).prop('disabled', true);
                for(i=0;i<ordering.length;i++){
                    if(ordering[i]['id']=="douong_"+a){
                        ordering.splice(i,1)
                    }
                }
            }
            else{
                $("#douong_"+a).prop('disabled', false);
            }
        }
        function showModal() {
            ordering=[];
            $('#DoUong').modal('show')
        }
        function orderban(){
            var _token=$('input[name="_token"]').val();
            var socho=$("#getsocho").val();
            var iscard=0;
            if(ordering==""||ordering==[]){
                alert("đồ uống không được để trống");
                return false;
            }
            if($("#isCard").prop("checked") == true){
                iscard=1;
            }
            var data={
                'socho':socho,
                'douong':ordering,
                '_token':_token,
                'id_ban':ban_id,
                'socmt':$("#getsocmt").val(),
                'iscard':iscard,
            }
            $.ajax({
                url: '{{asset("admin/ban/orderdrink")}}',
                type: 'POST',
                data: data,
                success:function(data) {
                    alert(data.success);


                    if(data.name){
                        document.getElementById("tenkhachhang").innerHTML = data.name[0]['name'];
                    }
                    var dateObj = new Date();
                    var month = dateObj.getUTCMonth() + 1; //months from 1-12
                    var day = dateObj.getUTCDate();
                    var year = dateObj.getUTCFullYear();

                    newdate = day + "/" + month + "/" + year;
                    document.getElementById("timein").innerHTML = newdate;
                    var tongcong=0;
                    $.each( douong_soluong, function( index, value ) {
                        $( "#bodyhoadon" ).append( "<tr><td>"+value['ten']+"</td><td>"+value['soluong']+"</td><td>"+value['gia']+"</td><td>"+value['gia']*value['soluong']+"</td></tr>" );
                        tongcong=tongcong+(value['gia']*value['soluong']);
                    });
                    document.getElementById("tongcong").innerHTML = tongcong;
                    $('#DoUongForm')[0].reset();
                    $('#BanForm')[0].reset();
                    $("#listBan").html("");
                    $.ajax({
                        url: '{{asset("admin/ban/data")}}',
                        type: 'GET',
                        dataType: 'json',

                        success:function(data){
                            $.each(data, function (index, value) {
                                if(value.ghetrong==0){
                                    $('#listBan').append(' <div class="col-sm-2 ban" style="border: 1px solid red" onclick="showModal(this.id)" id="'+value.id+'"><img src="/images/ban.jpg" style="width: 100px; height: 70px"></br><p style="margin-left:15px">'+value.tenban+':'+value.ghetrong+'/'+value.socho+'</p></div>')
                                }
                                else{
                                    $('#listBan').append(' <div class="col-sm-2 ban" onclick="showModal(this.id)" id="'+value.id+'"><img src="/images/ban.jpg" style="width: 100px; height: 70px"></br><p style="margin-left:15px">'+value.tenban+':'+value.ghetrong+'/'+value.socho+'</p></div>')
                                }
                            });
                            $('#DoUong').modal('hide');
                            $('#Ban').modal('hide');
                            $('#hoadon').modal('show');


                        }
                    })



                }
            })
        }
    </script>
@stop