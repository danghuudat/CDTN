<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theloai_Douong extends Model
{
    protected $table='douong_theloai';
    protected $guarded=[];
    public function douong(){
        return $this->hasMany('App\Menu','theloai_douong','id');
    }
}
