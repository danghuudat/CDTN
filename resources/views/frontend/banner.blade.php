<div class="col-md-4">
    <ul class="list-group">
        <a href="/profile.html"><li class="list-group-item @if(\Illuminate\Support\Facades\Request::segment(1)=='profile.html') active @endif">Tài Khoản</li>
        </a>
        <a href="/lichsu.html">
            <li class="list-group-item @if(\Illuminate\Support\Facades\Request::segment(1)=='lichsu.html') active @endif">Lịch sử giao dịch</li>
        </a>
        <a href="/hoadon.html">
            <li class="list-group-item @if(\Illuminate\Support\Facades\Request::segment(1)=='hoadon.html') active @endif">Hóa đơn thanh toán</li>
        </a>
        <a href="/phieumuon.html">
            <li class="list-group-item @if(\Illuminate\Support\Facades\Request::segment(1)=='phieumuon.html') active @endif">Phiếu mượn sách đã mượn</li>
        </a>

    </ul>
</div>