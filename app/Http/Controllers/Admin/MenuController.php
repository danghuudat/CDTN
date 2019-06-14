<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Theloai_Douong;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index(){
        $theloai=Theloai_Douong::select('id','theloai_douong_name')->get();
        return view('backend.menu',['theloai'=>$theloai]);
    }
    public function getData(){
        return response([
            'data'=> Menu::join('douong_theloai','douong_theloai.id','=','menu.theloai_douong')
                ->select('menu.*','douong_theloai.theloai_douong_name')
                ->get(),
        ]);
    }
    public function getdouong(Request $request){
        return response([
            'data'=> Menu::join('douong_theloai','douong_theloai.id','=','menu.theloai_douong')
                ->where('menu.id','=',$request->id)
                ->select('menu.*','douong_theloai.theloai_douong_name')
                ->get(),
        ]);
    }
    public function store(Request $request){
        \Log::info($request);
        $error_array=[];
        $success='';
        $validation = Validator::make($request->all(), [
            'ten'=>'required',
            'gia'=>'required|numeric|min:1000',

        ],[
            'ten.required'=>'tên đồ uống không được để trống',
            'gia.required'=>'giá không được để trống',
            'gia.numeric'=>'nhập sai kiểu dữ liệu',
            'gia.min'=>'giá không được nhỏ hơn 1000'
        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $menu=new Menu();
            if($request->file('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->ten,'-') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $menu->anh=$new_name;

            }else{
                $menu->anh='profile.png';
            }

            $menu->tendouong=$request->ten;
            $menu->douong_khongdau=str_slug($request->name,'-');
            $menu->gia=$request->gia;
            $menu->theloai_douong=$request->theloai;
            $menu->save();
            $success='Bạn đã thêm mới thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array

        ]);

    }
    public function edit(Request $request){
        \Log::info($request);
        $error_array=[];
        $success='';
        $validation = Validator::make($request->all(), [
            'editten'=>'required',
            'editgia'=>'required|numeric|min:1000',

        ],[
            'editten.required'=>'tên đồ uống không được để trống',
            'editgia.required'=>'giá không được để trống',
            'editgia.numeric'=>'nhập sai kiểu dữ liệu',
            'editgia.min'=>'giá không được nhỏ hơn 1000'
        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();

        }else{
            $menu=Menu::find($request->id);
            if($request->file('hinhanh')){
                $image = $request->file('hinhanh');
                $new_name =str_slug($request->ten,'-') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $menu->anh=$new_name;

            }else{
                $menu->anh='profile.png';
            }

            $menu->tendouong=$request->editten;
            $menu->douong_khongdau=str_slug($request->name,'-');
            $menu->gia=$request->editgia;
            $menu->theloai_douong=$request->theloai;
            $menu->save();
            $success='Bạn đã thêm mới thành công';
        }
        return response([
            'success'=>$success,
            'errors'=>$error_array

        ]);

    }
    public function delete(Request $request){
        Menu::destroy($request->id);
        $susscess='Bạn đã xóa thành công';
        return response([ 'success'=>$susscess,]);
    }
}
