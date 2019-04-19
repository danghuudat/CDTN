<?php

namespace App\Http\Controllers\Admin;

use App\NhaXuatBan;
use App\Sach;
use App\TacGia;
use App\TheLoaiSach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['theloai']=TheLoaiSach::all();
        $data['nhaxuatban']=NhaXuatBan::all();
        $data['tacgia']=TacGia::all();

        return view('backend.sach',$data);
    }
    public function getData(){
        return \App\Http\Resources\Sach::collection(Sach::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Info(Request $request)
    {
        $sach=Sach::find($request->id);
        $sach->theloai;
        $sach->tacgia;
        $sach->nhaxuatban;
        return $sach;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error_array=[];
        $success='';
        $validation = Validator::make($request->all(), [
            'name'=>'unique:sach,tensach'
        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $sach=new Sach();
            if($request->file('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->name,'-') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/sach'), $new_name);
                $sach->hinhanh=$new_name;

            }else{
                $sach->hinhanh='notimage.png';
            }

            $sach->tensach=$request->name;
            $sach->tensach_slug=str_slug($request->name,'-');
            $sach->mieuta=$request->gioithieu;
            $sach->namxb=$request->namxb;
            $sach->soluong=$request->soluong;
            $sach->nxb_id=$request->nxb_id;
            $sach->tacgia_id=$request->tacgia_id;
            $sach->theloai_id=$request->theloai_id;
            $sach->user_id=Auth::user()->id;

            $sach->save();
            $success='Bạn đã thêm mới thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return Sach::find($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $error_array=[];
        $success='';
        $validator=Validator::make($request->all(),[
            'name'=>'unique:sach,tensach,'.$request->id.',id'
        ]);
        if ($validator->fails()){
            $error_array[]=$validator->messages();
        }else{
            $sach=Sach::find($request->id);
            if ($request->hasFile('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->name,'-') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/sach'), $new_name);
                $sach->hinhanh=$new_name;
                if($sach->hinhanh!='notimage.png'){
                    unlink('images/sach/'.$sach->hinhanh);
                }
            }
            $sach->tensach=$request->name;
            $sach->tensach_slug=str_slug($request->name,'-');
            $sach->mieuta=$request->gioithieu;
            $sach->namxb=$request->namxb;
            $sach->soluong=$request->soluong;
            $sach->nxb_id=$request->nxb_id;
            $sach->tacgia_id=$request->tacgia_id;
            $sach->theloai_id=$request->theloai_id;
            $sach->user_id=Auth::user()->id;

            $sach->save();
            $success='Bạn đã update thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Sach::destroy($request->id);
        return response([
            'success'=>'Bạn đã xóa thành công'
        ]);
    }
}
