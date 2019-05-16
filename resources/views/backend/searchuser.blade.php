<div class="post">
    <!-- /.user-block -->
        <div class="row">
            <div class="col-md-4">
                <div class="avartar">
                    <img class="hinhanh" style="margin-left: 17px" width="250px" src="{{asset('images/'.$user->hinhanh)}}"  alt="">
                </div>
            </div>

            <div class="col-md-8">
                <div class="text-deltais">
                    <p><i class="nav-icon fas fa-ad teal"></i> <b>Họ tên:</b> {{$user->name}}</p>
                    <p><i class="nav-icon fas fa-envelope red"></i> <b>Email:</b> {{$user->email}}</p>
                    <p><i class="nav-icon fas fa-mobile-alt orange"></i> <b>Số điện thoại:</b> {{$user->SDT !=null ? $user->SDT : 'Chưa cập nhật' }}</p>
                    <p><i class="fas fa-id-card"></i> <b>Chứng minh thư:</b> {{$user->CMT}}</p>
                    <p><i class="fas fa-chess-knight"></i> <b>Loại tài khoản:</b>@if( $user->loaiTK==1)Thường @elseif( $user->loaiTK==2) Vip I @elseif( $user->loaiTK==3) Vip II @endif</p>
                    <p><i class="far fa-clock"></i> <b>Ngày đăng ký TK Thường:</b> {{date('d-m-Y',strtotime($user->beginloaiTK))}}</p>
                    <p><i class="far fa-clock"></i> <b>Ngày hết hạn TK Thường:</b> {{date('d-m-Y',strtotime($user->endloaiTK))}}</p>
                    <p><i class="fas fa-dollar-sign"></i><b> Số tiền hiện có:</b> {{number_format($user->tien,0,'.','.')}} VNĐ</p>
                    @if($user->tien>100000)
                        @if($check==='Đang mượn')
                            <button class="btn btn-warning disabled">Mượn Sách</button><small style="color: red;">Tài khoản hiện chưa trả sách. Vui lòng Trả sách để có thể mượn thêm.</small>
                        @else
                        <button class="btn btn-outline-warning" onclick="MuonSach('{{$user->id}}','{{$user->tien}}','{{$user->email}}')">Mượn Sách</button>
                        @endif
                    @else
                        <button class="btn btn-outline-warning" onclick="CheckMuonSach('{{$user->email}}')">Mượn Sách</button>

                    @endif
                </div>

            </div>

        </div>
</div>
