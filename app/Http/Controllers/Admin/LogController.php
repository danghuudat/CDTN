<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class LogController extends Controller
{
    public function getLogin(){
        return view('login');
    }
    public function postLogin(Request $request){
        if ($request->checkbox=='Remember'){
            $remember=true;
        }else{
            $remember=false;
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->pw],$remember)) {
            if (Auth::user()->level==1||Auth::user()->level==2){

                return response([
                    'link'=>'admin'

                ]);
            }else{
                if (Auth::user()->activated==1){
                    return response([
                        'link'=>'/'
                    ]);
                }else{
                    return response([
                        'active'=>'Chưa kích hoạt.Bạn cần đến gặp quản lý để kích hoạt tài khoản.'
                    ]);
                }

            }
        }else{
            return response([
                'error'=>'Sai tên tài khoản hoặc mật khẩu. Vui lòng kiểm tra lại'
            ]);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('login');

    }
    public function getRegister(){
        return view('frontend.register');
    }
    public function postRegister(Request $request){
        $success='';
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->CMT=$request->CMT;
        $user->level=0;
        $user->loaiTK=null;
        $user->beginloaiTK=null;
        $user->endloaiTK=null;
        $user->activated=0;
        $user->hinhanh='profile.png';
        $user->tien=0;
        $user->password=bcrypt($request->pw);
        $user->save();
        $success='Bạn đã đăng ký thành công.Vui lòng liên hệ quản lý để kích hoạt tài khoản.';
        return response([
            'success'=>$success,
        ]);
    }
}
