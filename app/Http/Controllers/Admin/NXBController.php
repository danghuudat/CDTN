<?php

namespace App\Http\Controllers\Admin;

use App\NhaXuatBan;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class NXBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.nhaxuatban');
    }

    public function getData(){
        return response([
            'data'=>NhaXuatBan::all(),
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
            'name'=>'required|unique:nhaxuatban,name_nxb',

        ],[
            'name.required'=>'Tên NXB không được để trống',
            'name.unique'=>'Tên NXB đã tồn tại'

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $nxb=new NhaXuatBan();
            $nxb->name_nxb=$request->name;
            $nxb->slug_name_nxb=str_slug($request->name,'-');
            $nxb->save();
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
        return NhaXuatBan::find($request->id);
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
            'name'=>'required|unique:nhaxuatban,name_nxb,'.$request->id.',id',

        ],[
            'name.required'=>'Tên NXB không được để trống',
            'name.unique'=>'Tên NXB đã tồn tại'

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $nxb=NhaXuatBan::find($request->id);
            $nxb->name_nxb=$request->name;
            $nxb->slug_name_nxb=str_slug($request->name,'-');
            $nxb->save();
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
        NhaXuatBan::destroy($request->id);
        return response([
            'success'=>'Bạn đã xóa thành công'
        ]);
    }
}
