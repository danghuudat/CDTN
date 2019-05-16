<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuonSachTraSach extends Model
{
    protected $table='muontrasach';
    protected $guarded=[];
    public function books(){
        return $this->belongsToMany('App\Sach','phieumuon','muontra_id','sach_id')->withPivot('active','ngaytra');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }


}
