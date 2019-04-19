<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sach extends JsonResource
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
            'tensach'=>$this->tensach,
            'hinhanh'=>$this->hinhanh,
            'namxb'=>$this->namxb,
            'soluong'=>$this->soluong,
            'mieuta'=>$this->mieuta,
            'nxb_id'=>$this->nxb_id,
            'tacgia_id'=>$this->tacgia_id,
            'theloai_id'=>$this->theloai_id,
            'user_id'=>$this->user_id,
            'name_tg'=>$this->tacgia->name_tacgia

        ];
    }
}
