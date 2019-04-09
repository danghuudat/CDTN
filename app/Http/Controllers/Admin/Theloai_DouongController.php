<?php

namespace App\Http\Controllers\Admin;

use App\Theloai_Douong;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Theloai_DouongController extends Controller
{
    public function index(){
        return view('backend.Theloai_Douong');
    }
    public function getData(){
        return response([
            'data'=> Theloai_Douong::get(),
        ]);
    }
    public function store(Request $request){

        $error_array=[];
        $success='';
        $validation=Validator::make($request->all(),[
            'name'=>'required|',

        ],[
            'name.required'=>'Tên thể loại không được để trống',

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $theloai=new Theloai_Douong();
            $theloai->theloai_douong_name=$request->name;
            $theloai->theloai_douong_name_khongdau=Str::slug($request->name,'-');
            $theloai->save();
            $success='Bạn đã tạo thể loại thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array

        ]);
    }
    public function edit(Request $request)
    {
        $error_array=[];
        $success='';
        $validation=Validator::make($request->all(),[
            'name'=>'required|',

        ],[
            'name.required'=>'Tên thể loại không được để trống',

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $theloai=Theloai_Douong::find($request->id);
            $theloai->theloai_douong_name=$request->name;
            $theloai->theloai_douong_name_khongdau=Str::slug($request->name,'-');
            $theloai->save();
            $success='Bạn đã sửa thể loại thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array

        ]);

    }
    public function destroy(Request $request)
    {
        Theloai_Douong::destroy($request->id);
        return response([
            'success'=>'Bạn đã xóa thành công'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


}
