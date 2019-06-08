<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoadonCafe extends Model
{
    protected $table='hoadoncafe';
    public function ban_douong(){
        return $this->hasMany('App\Ban_douong','hoadoncafe_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id_tt','id');
    }

}
