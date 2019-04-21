<?php

namespace App\Http\Controllers\Admin;

use App\TacGia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class TacGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.tacgia');
    }
    public function getData(){
        return response([
            'data'=>TacGia::all(),
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
        $validation = Validator::make($request->all(), [
            'name'=>'unique:tacgia,name_tg'
        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $tacgia=new TacGia();
            if($request->file('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->name,'-') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $tacgia->hinhanh=$new_name;

            }else{
                $tacgia->hinhanh='profile.png';
            }

            $tacgia->name_tg=$request->name;
            $tacgia->slug_name_tg=str_slug($request->name,'-');
            $tacgia->gioithieu=$request->gioithieu;
            $tacgia->save();
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
        return TacGia::find($request->id);
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
        $tacgia=TacGia::find($request->id);
        $error_array=[];
        $success='';
        $validation = Validator::make($request->all(), [
            'name'=>'unique:tacgia,name_tg,'.$request->id.',id'
        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            if($request->hasFile('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->name,'-').'-'.str_random() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                if ($tacgia->hinhanh!='profile.png'){
                    unlink('images/'.$tacgia->hinhanh);
                }
                $tacgia->hinhanh=$new_name;

            }

            $tacgia->name_tg=$request->name;
            $tacgia->slug_name_tg=str_slug($request->name,'-');
            $tacgia->gioithieu=$request->gioithieu;
            $tacgia->save();
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
    public function destroy($id)
    {
        //
    }
}
