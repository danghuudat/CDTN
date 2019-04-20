<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViTien extends Model
{
    protected $table='vitien';
    protected $guarded=[];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
