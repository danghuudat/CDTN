<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa Đơn</title>
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
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
<div class="" id="modalhdct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div>
        <div class="content">
            <div class="header">
                <span><h3>Hóa đơn chi tiết</h3></span>
            </div>
            <div class="body">
                <div id="hoadonct">
                    <div class="text-header">
                        <h5 id="mahoadon">Mã Hóa Đơn :{{$hoadon[0]['id']}}</h5>

                        <h5 id="ngaymua">Ngày mua: {{$hoadon[0]['created_at']}}</h5>
                        <h5 id="taikhoan">Tài Khoản: <?php if($hoadon[0]['user_id_tt']==null)
                                                        echo "khách hàng vô danh";
                                                        else{
                                                            $user=\App\User::where('id','=',$hoadon[0]['user_id_tt'])->get();
                                                            echo $user[0]['name'];
                                                        }
                            ?></h5>
                    </div>

                    <div class="text-body">
                        <table class="table table-bordered mt-2" style="font-size: 14px ">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên đồ uống</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Thành tiền</th>

                            </tr>
                            </thead>
                            <tbody id="bodyhoadon">
                            <?php $i=1 ?>
                            @foreach($hoadon as $key=>$value)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td style="text-align: left;font-size: 16px">{{$value['tendouong']}}</td>
                                <td style="font-size: 16px">{{$value['soluong']}}</td>
                                <td style="font-size: 16px">{{$value['gia']}}</td>
                                <td style="font-size: 16px"><?php echo $value['soluong']*$value['gia'] ?></td>
                                <?php
                                $i++;
                                ?>
                            </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div style=" background-color: rgba(0,0,0,.05);">
                            <span colspan="6" style="display: inline-block"><h5>Tổng tiền thanh toán: {{$hoadon[0]['total']}}</h5></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>