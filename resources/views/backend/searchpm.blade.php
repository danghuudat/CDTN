<h3>Phiếu Mượn Sách</h3>
<div class="text-header">
    <u>Mã phiếu mượn</u>: {{$phieumuon->id}}
    <p><span>Ngày:</span> {{date('d-m-Y',strtotime($phieumuon->ngaymuon))}}</p>
</div>

<div class="text-body">
    <p><span>Tài Khoản:</span> {{$phieumuon->user->email}}</p>
    <p><span>Chứng minh thư:</span> {{$phieumuon->user->CMT}}</p>
    <p><span>Số Điện Thoại:</span> {{$phieumuon->user->SDT ? $phieumuon->user->SDT : 'Không có'}}</p>
    <p><span>Loại Tài Khoản:</span> @if($phieumuon->user->loaiTK == 1) Thường @elseif($phieumuon->user->loaiTK == 2) Vip I @elseif($phieumuon->user->loaiTK == 3) Vip II @endif</p>
    <p><span>Thời gian:</span> Từ {{date('d-m-Y',strtotime($phieumuon->ngaymuon))}} đến {{date('d-m-Y',strtotime($phieumuon->hantra))}} </p>
    <p><span>Tiền Đặt Cọc:</span> {{number_format($phieumuon->tiendatcoc,0,'.','.')}} VNĐ</p>
    <table class="table table-bordered mt-2">
        <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên Sách</th>
            <th scope="col">Tác Giả</th>
            <th scope="col">Thể loại</th>
            <th scope="col">Nhà xuất bản</th>
            <th scope="col">Tình trạng</th>
            <th scope="col">Ngày trả</th>
        </tr>
        </thead>
        <tbody>
        @foreach($phieumuon->books->all() as $stt=> $sach)
            <tr>
                <td>{{$stt+1}}</td>
                <td style="text-align: left">{{$sach->name_sach}}</td>
                <td>{{$sach->tacgia->name_tg}}</td>
                <td>{{$sach->theloai->name_tl}}</td>
                <td>{{$sach->nhaxuatban->name_nxb}}</td>
                <td>{{$sach->pivot->active==0 ? 'Đang mượn' : 'Đã trả'}}</td>
                <td>{{$sach->pivot->ngaytra==null ? 'Đang mượn' : date('d-m-Y',strtotime($sach->pivot->ngaytra))}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="btn btn-outline-success buttontrasach" style="float: right;margin-right: 3em;">Trả Sách</button>

</div>
<!-- Modal -->
<div class="modal fade" id="TraSachModal"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{$phieumuon->user->email}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formtrasach">
                    <div class="form-group">
                        <div class="alert alert-danger err">

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tình trạng sách:</label>
                        @foreach($phieumuon->books->all() as $key=> $sach)
                            @if($sach->pivot->active ==0)
                                <div class="row">
                                    <div class="col-sm-1">
                                    </div>
                                    <div class="col-sm-6 ">
                                        <input type="checkbox"  class="sach_id" checked value="{{$sach->id}}">
                                        {{$sach->name_sach}}
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <select class="form-control"  id="tinhtrang-{{$sach->id}}">
                                            <option value="BT">Bình thường</option>
                                            <option value="25">Hư hỏng 25%</option>
                                            <option value="50">Hư hỏng 50%</option>
                                            <option value="75">Hư hỏng 75%</option>
                                            <option value="LM">Làm mất</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden" name="id" value="{{$phieumuon->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success idphieu" id="clicksubmit" >Trả sách</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
