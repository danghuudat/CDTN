<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
                return response([
                    'link'=>'/'
                ]);
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
}
