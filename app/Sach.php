<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    protected $table='sach';
    protected $guarded=[];
    public function theloai(){
        return $this->belongsTo('App\TheLoaiSach','theloai_id');
    }
    public function nhaxuatban(){
        return $this->belongsTo('App\NhaXuatBan','nxb_id');
    }
    public function TacGia(){
        return $this->belongsTo('App\TacGia','tacgia_id');
    }
}
