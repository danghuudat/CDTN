<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban_douong extends Model
{
    protected $table="ban_douong";
    protected $guarded=[];
    public function douong(){
        return $this->belongsTo('App\Menu','douong_id','id');
    }
}
