

<style>
    #wrap-inner{
        font-family: arial;
        font-size: 14px;
        color: #666;
        padding-left: 20px;
        line-height: 25px;
    }
    #khach-hang h3{
        color: #ff9600;
        margin-bottom: 15px;
    }
    #hoa-don h3{
        color: #ff9600;
        margin-bottom: 15px;
    }
    .bold{
        font-weight: bold;
    }
    .info{
        font-weight: bold;
    }
    table td.price {
        color: red;
    }
    td{
        color: #666;
        padding: 15px;

    }
    .total-price{
        font-weight:bold;
    }

</style>

<div id="wrap-inner">

    <div id="hoa-don">
        <h3>Hóa đơn nạp tiền</h3>
        <div class="row">
            <div class="col-lg-7">
                <table border="1px solid black" class="table-bordered table-responsive">
                    <tr class="bold">
                        <td width="40%">Tên tài khoản</td>
                        <td width="25%">Số tiền nạp</td>
                        <td width="20%">Ngày nạp</td>
                        <td width="15%">Người nạp</td>
                    </tr>
                        <tr>
                            <td>{{$info->tentaikhoan}}</td>
                            <td class="price">{{number_format($info->tiennap,0,'.','.')}} VNĐ</td>
                            <td>{{date('d-m-Y H:i a',strtotime($info->created_at))}}</td>
                            <td >{{$info->nguoinap}}</td>
                        </tr>

                </table>
            </div>
        </div>
    </div>
    <div id="xac-nhan">
        <br>
        <p align="justify">
            <b><br />Cám ơn Quý khách đã sử dụng dịch vụ chúng Tôi!</b>
        </p>
    </div>
</div>