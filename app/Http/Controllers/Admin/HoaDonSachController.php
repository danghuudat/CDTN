<?php

namespace App\Http\Controllers\Admin;

use App\ChiTietHoaDonSach;
use App\HoaDonSach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class HoaDonSachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoadon=HoaDonSach::orderBy('id','DESC')->get()->groupBy(function ($item){
            return $item->created_at->format('Y');
        });

        return view('backend.qlhoadon',compact('hoadon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $hoadonsach=HoaDonSach::where('muontra_id','=', $request->id)->get();
        return view('backend.hoadonsach',compact('hoadonsach'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showhdct(Request $request)
    {
        $hoadon=HoaDonSach::find($request->id);
//        return $hoadon;
        return view('backend.hoadonsachct',compact('hoadon'));
    }
    public function pdf($id){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->hoadonct_html($id));
        return $pdf->stream();
    }
    function hoadonct_html($id){
        $hoadon=HoaDonSach::find($id);
        return view('backend.pdf_hoadon',compact('hoadon'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
