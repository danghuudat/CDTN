<?php

namespace App\Http\Controllers\Admin;

use App\HoaDonSach;
use App\MuonSachTraSach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThongKeController extends Controller
{
    public function index(){
        return view('backend.thongke');
    }
    public function thongke(Request $request){

        $mang=[];
        $mang2=[];
        if ($request->action=="sach"){

            $a= MuonSachTraSach::whereBetween('ngaymuon', [$request->tungay, $request->denngay])->get();
            foreach ($a as $value){
                foreach ($value->books as $sach){
                    array_push($mang, $sach->name_sach);

                }

                }
        }
        if ($request->action=='hoadonsach'){
            $a=HoaDonSach::whereBetween('created_at', [$request->tungay, date('Y-m-d',strtotime(date('Y-m-d',strtotime($request->denngay)). '+1 day'))])->get();
            $mang2=$a;
        }
           return response([
               'sach'=>$mang,
               'hoadonsach'=>$mang2,
           ]);

        }


}
