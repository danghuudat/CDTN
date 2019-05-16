<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDonSach extends Model
{
    protected $table='chitiethds';
    protected $guarded=[];
    public function book(){
        return $this->belongsTo('App\Sach','sach_id','id');
    }
}
