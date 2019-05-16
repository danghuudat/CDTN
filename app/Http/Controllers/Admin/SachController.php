<?php

namespace App\Http\Controllers\Admin;

use App\LSNhapHuy;
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
            'name'=>'unique:sach,name_sach'
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
                $new_name =str_slug($request->name,'-'). '.jpg';
                $image->move(public_path('images/sach'), $new_name);
                $sach->hinhanh=$new_name;

            }else{
                $sach->hinhanh='notimage.png';
            }

            $sach->name_sach=$request->name;
            $sach->name_slug_sach=str_slug($request->name,'-');
            $sach->mieuta=$request->gioithieu;
            $sach->namxb=$request->namxb;
            $sach->gia=$request->gia;
            $sach->solanmuon=0;
            $sach->noibat=0;
            $sach->soluong=0;
            $sach->nxb_id=$request->nxb_id;
            $sach->tacgia_id=$request->tacgia_id;
            $sach->theloai_id=$request->theloai_id;



            $sach->save();

            $addsach=new LSNhapHuy();
            $addsach->sach_id=$sach->id;
            $addsach->status=4;
            $addsach->ngay=date('Y-m-d');
            $addsach->ghichu= 'Đã Thêm sách '.$sach->name_sach;
            $addsach->save();
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
            'name'=>'unique:sach,name_sach,'.$request->id.',id'
        ]);
        if ($validator->fails()){
            $error_array[]=$validator->messages();
        }else{
            $sach=Sach::find($request->id);
            if ($request->hasFile('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->name,'-'). '.jpg';


                if($sach->hinhanh!='notimage.png'){
                    unlink('images/sach/'.$sach->hinhanh);
                }
                $image->move(public_path('images/sach'), $new_name);
                $sach->hinhanh=$new_name;


            }
            $sach->name_sach=$request->name;
            $sach->name_slug_sach=str_slug($request->name,'-');
            $sach->mieuta=$request->gioithieu;
            $sach->namxb=$request->namxb;
            $sach->gia=$request->gia;
            $sach->nxb_id=$request->nxb_id;
            $sach->tacgia_id=$request->tacgia_id;
            $sach->theloai_id=$request->theloai_id;

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
//        $sach=Sach::find($request->id);
//        $xoa=new LSNhapHuy();
//        $xoa->sach_id=$request->id;
//        $xoa->status=3;
//        $xoa->ngay=date('Y-m-d');
//        $xoa->ghichu= 'Đã xóa sách '.$sach->name_sach;
//        $xoa->save();
//        Sach::destroy($request->id);
//
//        return response([
//            'success'=>'Bạn đã xóa thành công'
//        ]);
    }
    public function ThemSL(Request $request){
        $nhapsach=new LSNhapHuy();
        $nhapsach->sach_id=$request->id;
        $nhapsach->status=1;
        $nhapsach->soluong=$request->soluong;
        $nhapsach->ngay=date('Y-m-d');
        $nhapsach->save();
        $sach=Sach::find($request->id);
        $sach->soluong+=$request->soluong;
        $sach->save();
        return response([
            'success'=>'Nhập thành công'
        ]);
    }
    public function GiamSL(Request $request){
        $sach=Sach::find($request->id);
        $success='';
        $error='';
        if ($sach->soluong>=$request->soluong){
            $nhapsach=new LSNhapHuy();
            $nhapsach->sach_id=$request->id;
            $nhapsach->status=2;
            $nhapsach->soluong=$request->soluong;
            $nhapsach->ngay=date('Y-m-d');
            $nhapsach->save();
            $sach->soluong -=$request->soluong;
            $sach->save();
            $success='Giảm SL thành công';

        }else{
            $error='Số lượng giảm lớn hơn số lượng hiện tại. Vui lòng kiểm tra lại.';
        }
        return response([
            'success'=>$success,
            'error'=>$error
        ]);

    }
    public function history(){
        $lichsu=LSNhapHuy::orderBy('created_at','DESC')->get()->groupBy('ngay');
//        dd($lichsu);
        return view('backend.lsnhaphuy',compact('lichsu'));
    }
    public function noibat(Request $request){
        $sach=Sach::find($request->id);
        switch ($request->action)
        {
            case 'yes':
                $sach->noibat=1;
                break;
            case 'no':
                $sach->noibat=0;
                break;
        }
        $sach->save();

    }
}
