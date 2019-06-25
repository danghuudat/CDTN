<?php

namespace App\Http\Controllers\Admin;

use App\Ban;
use App\Ban_douong;
use App\HoadonCafe;
use App\Menu;
use App\Theloai_Douong;
use App\User;
use App\ViTien;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class banController extends Controller
{
    public function index(){
        return view('backend.ban');
    }
    public function getData(){
        return response([
            'data'=> Menu::join('douong_theloai','douong_theloai.id','=','menu.theloai_douong')
                ->select('menu.*','douong_theloai.theloai_douong_name')
                ->get(),
        ]);
    }
    public function checkcmt(Request $request){
        $error='';
        $success='';
        if($request->thanhtoan==1){
            $user=User::where('CMT','=',$request->cmt)->get();
            $tongtien=0;
            if(sizeof($user)!=0){
                for($i=0;$i<sizeof($request['douong']);$i++){
                    $id=str_replace('douong_','',$request['douong'][$i]['id']);
                    $giatien=Menu::find($id);
                    $tongtien+=$request['douong'][$i]['soluong']*$giatien->gia;
                }
                $tt=User::where('CMT','=',$request->socmt)->get();
                $user[0]->tien=$user[0]->tien-$tongtien;
                if($user[0]->tien<0){
                    $error="Không đủ tiền trong tài khoản";
                    return response([
                        'errors'=>$error
                    ]);
                }
                $userID = Auth::user();
                $user[0]->save();
                $success="đặt đồ uống thành công";
                $idUser = HoadonCafe::insertGetId(
                    ['total' => $tongtien, 'user_id_tt' => $user[0]->id,'user_id'=>$userID->id,'created_at'=>date('Y-m-d H:i:s')]
                );
                $user=User::find($user[0]->id);
                ViTien::insert(['tiennap'=>$tongtien,'ngaynap'=>date("Y-m-d"),'status'=>2,'tentaikhoan'=>$user->email,'nguoinap'=>Auth::user()->email]);
                for($i=0;$i<sizeof($request['douong']);$i++){
                    $id=str_replace('douong_','',$request['douong'][$i]['id']);
                    Ban_douong::insert(['hoadoncafe_id'=>$idUser,'douong_id'=>$id,'soluong'=>$request['douong'][$i]['soluong']]);

                }
                return response([
                    'success'=>$success,
                    'name'=>$user
                ]);
            }
            else{
                $error='sai số cmt';
                return response([
                    'errors'=>$error
                ]);
            }
        }
        else{
            $tongtien=0;
            for($i=0;$i<sizeof($request['douong']);$i++){
                $id=str_replace('douong_','',$request['douong'][$i]['id']);
                $giatien=Menu::find($id);
                $tongtien+=$request['douong'][$i]['soluong']*$giatien->gia;

            }
            $userID = Auth::user();
            \Log::info($userID);
            $idUser = HoadonCafe::insertGetId(
                ['total' => $tongtien, 'user_id_tt' => null,'user_id'=>$userID->id]
            );
            for($i=0;$i<sizeof($request['douong']);$i++){
                $id=str_replace('douong_','',$request['douong'][$i]['id']);
                Ban_douong::insert(['hoadoncafe_id'=>$idUser,'douong_id'=>$id,'soluong'=>$request['douong'][$i]['soluong']]);

            }
            $success="đặt đồ uống thành công";
            return response([
                'success'=>$success,
            ]);

        }
    }



}
