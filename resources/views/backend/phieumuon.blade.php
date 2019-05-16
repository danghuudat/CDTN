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
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>