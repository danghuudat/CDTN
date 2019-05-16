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
            'name_sach'=>$this->name_sach,
            'hinhanh'=>$this->hinhanh,
            'namxb'=>$this->namxb,
            'soluong'=>$this->soluong,
            'mieuta'=>$this->mieuta,
            'nxb_id'=>$this->nxb_id,
            'nxb_name'=>$this->nhaxuatban->name_nxb,
            'luotmuonsach'=>$this->solanmuon,
            'noibat'=>$this->noibat,
            'tacgia_id'=>$this->tacgia_id,
            'theloai_id'=>$this->theloai_id,
            'user_id'=>$this->user_id,
            'name_tg'=>$this->tacgia->name_tg,
            'name_tl'=>$this->theloai->name_tl

        ];
    }
}
