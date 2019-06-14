<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table="menu";
    public function theloai()
    {
        return $this->belongsTo('App\Theloai_Douong','theloai_douong','id');
    }
}
