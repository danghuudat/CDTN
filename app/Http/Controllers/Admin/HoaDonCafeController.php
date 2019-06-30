<?php

namespace App\Http\Controllers\Admin;

use App\Ban_douong;
use App\HoadonCafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;


class HoaDonCafeController extends Controller
{
    public function index(){
        $hoadon=HoadonCafe::orderBy('id','DESC')->get()->groupBy(function ($item){
            return $item->created_at->format('Y');
        });
        // dd($hoadon);
        return view('backend.hoadoncafe',compact('hoadon'));
    }
    public function showhdct(Request $request)
    {
        $hoadon=HoadonCafe::join('ban_douong','ban_douong.hoadoncafe_id','=','hoadoncafe.id')
            ->join('menu','menu.id','=','ban_douong.douong_id')
            ->where('hoadoncafe_id','=',$request->id)->get();
        \Log::info($hoadon);
//        return $hoadon;
        return response(['hoadon'=>$hoadon]);
    }
    public function pdf($id){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->hoadoncafect_html($id));
        return $pdf->stream();
    }
    function hoadoncafect_html($id){
        $hoadon=HoadonCafe::join('ban_douong','ban_douong.hoadoncafe_id','=','hoadoncafe.id')
            ->join('menu','menu.id','=','ban_douong.douong_id')
            ->select('hoadoncafe.total','hoadoncafe.id','hoadoncafe.user_id_tt','hoadoncafe.created_at','menu.tendouong','menu.gia','ban_douong.soluong')
            ->where('hoadoncafe_id','=',$id)->get();
        return view('backend.cafe_pdf',compact('hoadon'));
    }
}
