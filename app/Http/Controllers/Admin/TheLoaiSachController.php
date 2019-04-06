<?php

namespace App\Http\Controllers\Admin;

use App\TheLoaiSach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class TheLoaiSachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.theloaisach');
    }

    public function getData(){
        return response([
            'data'=>TheLoaiSach::all(),
        ]);
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

        $error_array=[];
        $success='';
        $validation=Validator::make($request->all(),[
            'name'=>'required|unique:theloaisach,name_tl',

        ],[
            'name.required'=>'Tên thể loại không được để trống',
            'name.unique'=>'Tên thể loại đã tồn tại'

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $theloai=new TheLoaiSach();
            $theloai->name_tl=$request->name;
            $theloai->slug_name_tl=str_slug($request->name,'-');
            $theloai->save();
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
        return TheLoaiSach::find($request->id);
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
        $validation=Validator::make($request->all(),[
            'name'=>'required|unique:theloaisach,name_tl,'.$request->id.',id',

        ],[
            'name.required'=>'Tên thể loại không được để trống',
            'name.unique'=>'Tên thể loại đã tồn tại'

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $theloai=TheLoaiSach::find($request->id);
            $theloai->name_tl=$request->name;
            $theloai->slug_name_tl=str_slug($request->name,'-');
            $theloai->save();
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
        TheLoaiSach::destroy($request->id);
        return response([
            'success'=>'Bạn đã xóa thành công'
        ]);
    }
}
