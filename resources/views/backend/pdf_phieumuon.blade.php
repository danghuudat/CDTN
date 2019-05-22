<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phiếu mượn sách</title>
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>

        body {
            font-family: DejaVu Sans;
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
</head>
<body>
<h3 style="font-weight: bold;font-family: DejaVu Sans;">Phiếu Mượn Sách</h3>
<div class="text-header">
    <u style="font-weight: bold">Mã phiếu mượn</u>: {{$phieumuon->id}}
    <p><span>Ngày:</span> {{date('d-m-Y',strtotime($phieumuon->ngaymuon))}}</p>
</div>

<div class="text-body">
    <p><span>Tài Khoản:</span> {{$phieumuon->user->email}}</p>
    <p><span>Chứng minh thư:</span> {{$phieumuon->user->CMT}}</p>
    <p><span>Số Điện Thoại:</span> {{$phieumuon->user->SDT ? $phieumuon->user->SDT : 'Không có'}}</p>
    <p><span>Loại Tài Khoản:</span> @if($phieumuon->user->loaiTK == 1) Thường @elseif($phieumuon->user->loaiTK == 2) Vip I @elseif($phieumuon->user->loaiTK == 3) Vip II @endif</p>
    <p><span>Thời gian:</span> Từ {{date('d-m-Y',strtotime($phieumuon->ngaymuon))}} đến {{date('d-m-Y',strtotime($phieumuon->hantra))}} </p>
    <p><span>Tiền Đặt Cọc:</span> {{number_format($phieumuon->tiendatcoc,0,'.','.')}} VNĐ</p>
    <table class=" mt-2" border="1px solid">
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



</body>
</html>