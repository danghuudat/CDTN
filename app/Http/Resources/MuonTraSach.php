<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MuonTraSach extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'taikhoanmuon'=>$this->user->email,
            'ngaymuon'=>$this->ngaymuon,
            'tra'=>$this->books->where('pivot.active','=',1)->count(),
            'muon'=>$this->books->where('pivot.active','=',0)->count(),
            'hantra'=>$this->hantra,
            'tinhtrang'=>$this->active,
            'nguoidk'=>$this->nguoidk,
        ];
    }
}
