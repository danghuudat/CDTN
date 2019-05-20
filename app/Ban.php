<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $table='qlban';
    protected $guarded=[];
    public function douong(){
        return $this->belongsToMany('App\Menu','id_ban','douong_id');
    }
}
