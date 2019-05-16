@extends('backend.master')
@section('content')
    <style>
        .text-deltais{
            margin-left: 25px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: red;
        }
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: #F44336;
            background: #333333;
        }

    </style>
    <div class="row mt-3">
        <div class="col-md-9">
            <h1 class="page-header ">Đăng ký mượn sách

            </h1>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-5">
            <form class="form-inline" id="searchuser">
                <select class="form-control mb-2 mr-sm-2" id="column">
                    <option value="CMT">Chứng minh thư</option>
                    <option value="email">Tên tài khoản</option>
                </select>
                <input required type="text" class="form-control mb-2 mr-sm-2" id="tukhoa" value="1123456789" placeholder="Nhập .....">


                <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-sm-4"></div>

    </div>
    <div class="row mt-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-8" id="infouser">

        </div>
        <div class="col-sm-2"></div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="muonsachModal"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Đăng ký mượn sách</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formmuonsach">
                        <div class="form-group">
                            <label  class="col-form-label">Tài khoản: </label><span id="tentaikhoan"></span>

                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Chọn sách:</label>
                            <select class="form-control " id="sach_id" name="sach_id[]" multiple="multiple" >
                                @foreach($books as $book)

                                    <option  value="{{$book->name_slug_sach}}"  @if($book->soluong==0) disabled="disabled" style="color:red;" @endif >{{$book->name_sach}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Chọn thời gian mượn:</label>
                            <select class="form-control" name="thoigian" >

                                    <option value="7">1 tuần</option>
                                    <option value="14">2 tuần</option>
                                    <option value="21">3 tuần</option>
                                    <option value="30">1 tháng</option>


                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="" id="tienht">
                           <span id="tientaikhoan"></span> <button type="button" class="btn btn-outline-warning naptien" value="" style="display: none;">Nạp tiền</button>

                        </div>
                        <div class="form-group">
                            <input type="hidden" value="0" id="tiendc">
                            <label  class="col-form-label"><span id="tiencoc">Số tiền phải đặt cọc: 0 VNĐ</span> </label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary buttonms" value="" >Mượn sách</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="naptienModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
        function CheckMuonSach(email) {
            alert('Số tiền trong tài khoản quá ít để mượn sách.Vui lòng nạp thêm tiền để mượn sách');
            $('#naptienModal').modal('show');
            $('.modal-title').text('Nạp tiền tài khoản: '+email);
            $('.buttonnt').text('Nạp tiền');
            $('.buttonnt').val(email);

        }
        function InfoUser(column,tukhoa) {
            $.ajax({
                url:'{{asset("admin/muontrasach/searchuser")}}',
                type:'POST',
                data:{column:column,tukhoa:tukhoa},
                success:function (data) {
                    $('#infouser').html(data);
                }
            });
        }
        function MuonSach(id,tien,ten) {
            $('#muonsachModal').modal('show');
            $('.modal-title').text('Đăng ký mượn sách');
            $('.buttonms').val(id);
            $('#tientaikhoan').text('Tiền trong tài khoản: '+tien.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ');
            $('#tentaikhoan').text(ten);
            $('#tienht').val(tien);
            $('.naptien').val(ten);
            if ($('#tienht').val()-$('#tiendc').val()<0){
                $('.naptien').show();
            }else{
                $('.naptien').hide();
            }

        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                       if ($('#tienht').val()-$('#tiendc').val()<0){
                          $('.naptien').show();
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
                        if ($('#tienht').val()-$('#tiendc').val()>0){
                            $('.naptien').hide();
                        }
                    }
                })

            });


            $(document).on('click','.naptien',function () {
                $('#naptienModal').modal('show');
                $('.modal-title').text('Nạp tiền tài khoản: '+$(this).val());
                $('.buttonnt').text('Nạp tiền');
                $('.buttonnt').val($(this).val());
            });
            $(document).on('submit','#formnaptien',function (e) {
                e.preventDefault();
                $.ajax({
                    url:'{{asset("admin/naptien/add")}}',
                    type:'POST',
                    dataType:'json',
                    data:{id:$('.buttonnt').val(),tiennap:$('#tiennap').val()},
                    success:function (data) {
                        alert(data.success);
                        $('#naptienModal').modal('hide');
                        InfoUser($('#column').val(),$('#tukhoa').val());
                        const tienht=parseInt($('#tienht').val());
                        const tiennap=parseInt($('#tiennap').val());
                        const tong=tienht + tiennap;
                        $('#tienht').val(tong);
                        $('#tientaikhoan').text('Tiền trong tài khoản: '+tong.toString().replace(
                            /\B(?=(\d{3})+(?!\d))/g, ".")+' VNĐ');
                        if ($('#tienht').val()-$('#tiendc').val()>0){
                            $('.naptien').hide();
                        }
                    }
                })
            });

            $('#column').change(function () {
                if($(this).val()=='CMT'){
                    $('#tukhoa').attr('type',"text");
                }
                if($(this).val()=='email'){
                    $('#tukhoa').attr('type',"email");
                }
            });

            $(document).on('submit','#searchuser',function (e) {
                e.preventDefault();
                var column=$('#column').val();
                var tukhoa=$('#tukhoa').val();
                if(column=='CMT'){
                    if(isNaN(tukhoa)){
                        alert('khong phai so');
                    }else if(  tukhoa.length >8 && tukhoa.length<11){
                            InfoUser(column,tukhoa);
                    }else {
                        alert('Độ dài Chứng minh thư không hợp lệ');

                    }
                }
                if (column=='email'){
                    InfoUser(column,tukhoa);
                }

            })
            $('#formmuonsach').submit(function (e) {
                e.preventDefault();
                var column=$('#column').val();
                var tukhoa=$('#tukhoa').val();
                var formData= new FormData(this);
                formData.append('user_id',$('.buttonms').val());
                formData.append('tiendatcoc',$('#tiendc').val());

                if($('#tienht').val()-$('#tiendc').val()<0){
                    alert('Tiền của tài khoản hiện tại không đủ để đặt cọc.');
                }else{
                    $.ajax({
                        url:'{{asset("admin/muontrasach/muonsach")}}',
                        type:'POST',
                        dataType:'json',
                        data:formData,
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function (data) {
                            alert(data.success);
                            $('#muonsachModal').modal('hide');
                            // InfoUser(column,tukhoa);
                            window.location.href = '{{asset("admin/muontrasach")}}';
                        }
                    })
                }
            })
        })
    </script>
@stop