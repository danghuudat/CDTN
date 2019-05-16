<form id="formeditpm">
    <div class="form-group">
        <label  class="col-form-label">Tài khoản: </label><span id="tentaikhoan">{{$infomuontra->user->email}}</span>

    </div>
    <div class="form-group">
        <label  class="col-form-label">Chọn sách:</label>
        <select class="form-control " required id="sach_id" name="sach_id[]" multiple="multiple" >
            @foreach($books as $book)
                <option  value="{{$book->name_slug_sach}}"
                         @foreach($infomuontra->books->where('pivot.active','=','0') as $sach)

                            @if($book->id==$sach->id)
                                 <?php $book->soluong=$book->soluong+1 ?>
                                    selected="selected"
                            @endif
                         @endforeach

                            @if($book->soluong==0) disabled="disabled" @endif

                >{{$book->name_sach}}


                </option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label  class="col-form-label">Chọn thời gian mượn:</label>
        <select class="form-control" name="thoigian" >
            <option value="7" @if($infomuontra->songaymuon==7) selected @endif>1 tuần</option>
            <option value="14" @if($infomuontra->songaymuon==14) selected @endif>2 tuần</option>
            <option value="21" @if($infomuontra->songaymuon==21) selected @endif>3 tuần</option>
            <option value="30" @if($infomuontra->songaymuon==30) selected @endif>1 tháng</option>


        </select>
    </div>
    <div class="form-group">
        <input type="hidden" value="{{$infomuontra->user->tien}}" id="tienht">
        <span id="tientaikhoan">Tiền trong tài khoản: {{number_format($infomuontra->user->tien,0,'.','.')}} VNĐ</span> <button type="button" class="btn btn-outline-warning formnt" value="" style="display: none;">Nạp tiền</button>

    </div>
    <div class="form-group">
        <input type="hidden" value="{{$infomuontra->tiendatcoc}}" id="tiendc">
        <label  class="col-form-label"><span id="tiencoc">Số tiền phải đặt cọc: {{number_format($infomuontra->tiendatcoc,0,'.','.')}} VNĐ</span> </label>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary buttonedit" value="{{$infomuontra->id}}" >Mượn sách</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</form>
