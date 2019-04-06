<?php

namespace App\Http\Controllers\Admin;

use App\Theloai_Douong;
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
            'data'=> Theloai_Douong::where('id','<>',Auth::user()->id)->get(),
        ]);
    }
    public function store(Request $request){
        $data=$request->all();
        \Log::info($data);
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
            $theloai->name=$request->name;
            $theloai->save();
            $success='Bạn đã tạo thể loại thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array

        ]);
    }
}
