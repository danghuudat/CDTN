<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LSNhapHuy extends Model
{
    protected $table='nhaphuysach';
    protected $guarded=[];
    public function sach(){
        return $this->belongsTo('App\Sach');
    }
}
