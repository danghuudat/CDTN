<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table="menu";
    public function douong_theloai()
    {
        $this->belongsTo('App\Theloai_Douong');
    }
}
