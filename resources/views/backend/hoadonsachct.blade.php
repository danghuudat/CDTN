    <h3>Hóa Đơn Trả Sách</h3>
    <div class="text-header">
        <u>Mã Hóa Đơn</u>:{{$hoadon->id}}

        <p><span>Ngày Trả:</span> {{date('d-m-Y',strtotime($hoadon->created_at))}}</p>
    </div>

    <div class="text-body">
        <p><span style="text-decoration: underline">Mã phiếu mượn</span>: {{$hoadon->muontra_id}}</p>
        <p><span>Tài Khoản:</span> {{$hoadon->muontra->user->email}}</p>
        <p><span>Chứng minh thư:</span> {{$hoadon->muontra->user->CMT}}</p>
        <p><span>Số Điện Thoại:</span> {{$hoadon->muontra->user->SDT ? $hoadon->muontra->user->SDT : 'Không có'}}</p>
        <p><span>Loại Tài Khoản:</span> @if($hoadon->muontra->user->loaiTK == 1) Thường @elseif($hoadon->muontra->user->loaiTK == 2) Vip I @elseif($hoadon->muontra->user->loaiTK == 3) Vip II @endif</p>
        <p><span>Thời gian Mượn Sách:</span> Từ {{date('d-m-Y',strtotime($hoadon->muontra->ngaymuon))}} đến {{date('d-m-Y',strtotime($hoadon->muontra->hantra))}} </p>
        <table class="table table-bordered mt-2" style="font-size: 14px ">
            <thead class="thead-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Sách</th>
                <th scope="col">Tác Giả</th>
                <th scope="col">Thể loại</th>
                <th scope="col">Nhà XB</th>
                <th scope="col">Tình trạng sách</th>
                <th scope="col">Tiền bồi thường</th>
            </tr>
            </thead>
            <tbody>
            @foreach($hoadon->chitiet->all() as $stt=> $sach)
                <tr>
                    <td>{{$stt+1}}</td>
                    <td style="text-align: left;">{{$sach->book->name_sach}}</td>
                    <td>{{$sach->book->tacgia->name_tg}}</td>
                    <td>{{$sach->book->theloai->name_tl}}</td>
                    <td>{{$sach->book->nhaxuatban->name_nxb}}</td>
                    <td>@if($sach->tinhtrang==0)
                            Bình thường
                        @elseif($sach->tinhtrang==1)
                            Làm Mất
                        @elseif($sach->tinhtrang==25)
                            Hư Hỏng 25%
                        @elseif($sach->tinhtrang==50)
                            Hư Hỏng 50%
                        @elseif($sach->tinhtrang==75)
                            Hư Hỏng 75%
                        @endif</td>
                    <td>{{number_format($sach->tienphathongsach,0,'.','.')}} VNĐ</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="6">Tiền phạt quá hạn trả</td>
                <td>{{number_format($hoadon->tienquahan,0,'.','.')}} VNĐ</td>
            </tr>
            <tr>
                <td colspan="6">Tiền thuê sách</td>
                <td>{{number_format($hoadon->tienthue,0,'.','.')}} VNĐ</td>
            </tr>
            <tr style="    background-color: rgba(0,0,0,.05);">
                <td colspan="6">Tổng tiền thanh toán</td>
                <td>{{number_format($hoadon->tienthanhtoan,0,'.','.')}} VNĐ</td>
            </tr>
            </tbody>
        </table>
    </div>
