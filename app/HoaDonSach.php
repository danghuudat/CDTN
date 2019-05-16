<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDonSach extends Model
{
    protected $table = 'hoadonsach';
    protected $guarded=[];
    public function muontra(){
        return $this->belongsTo('App\MuonSachTraSach');
    }
    public function chitiet(){
        return $this->hasMany('App\ChiTietHoaDonSach','hds_id','id');
    }

}
