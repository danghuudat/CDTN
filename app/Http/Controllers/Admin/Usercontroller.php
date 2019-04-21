<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\ViTien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('backend.users',compact('users'));
    }
    public function getData(){
        if(Auth::user()->level==2){
            return response([
                'data'=> User::where('id','<>',Auth::user()->id)->where('level','<>','1')->get(),
            ]);
        }
        if (Auth::user()->level==1){
            return response([
                'data'=> User::where('id','<>',Auth::user()->id)->get(),
            ]);
        }

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
            'name'=>'required|',
            'email'=>'required',
            'CMT'=>'required'
        ],[
            'name.required'=>'Tên User không được để trống',
            'email.required'=>'Tên email không được để trống',
            'CMT.required'=>' CMT không được để trống',

        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->CMT=$request->CMT;
            if ($request->level==1||$request->level==2){
                $user->level=$request->level;
                $user->loaiTK=null;
                $user->beginloaiTK=null;
                $user->endloaiTK=null;

            }else{
                $user->level=$request->level;
                $user->loaiTK=$request->loaiTK;
                $user->beginloaiTK=Carbon::now()->toDateString();
                $user->endloaiTK=Carbon::now()->addDays(30)->toDateString();

            }
            $user->activated=1;
            $user->password=bcrypt('1');
            $user->hinhanh='profile.png';
            $user->tien=0;
            $user->save();
            $success='Bạn đã đãng ký thành công';
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
    public function show()
    {
        $lichsu=ViTien::orderBy('ngaynap','DESC')->where('nguoinap','=',Auth::user()->email)->get()->groupBy('ngaynap');
        $user=User::orderBy('created_at','DESC')->get()->groupBy(function ($item){
            return $item->created_at->format('d-m-Y');
        })->toArray();
        $user2=User::orderBy('updated_at','DESC')->get()->groupBy(function ($item){
            return $item->updated_at->format('d-m-Y');
        })->toArray();
        $a=array_merge($user,$user2);
//        dd($a);

//        $user=User::orderBy('ngaykichhoat','DESC')->where('nguoitao','=',Auth::user()->email)->get()->groupBy('ngaykichhoat')->toArray();
//        $lichsu=array_merge($a,$user);
//       dd($lichsu);
        return view('backend.profile',compact('lichsu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $vitien=ViTien::where('user_id','=',$request->id)->orderBy('created_at','DESC')->get();
        return response([
            'data'=>User::find($request->id),
            'vitien'=>$vitien
        ]);
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
            'name'=>'required|',

        ],[
            'name.required'=>'Tên User không được để trống',


        ]);
        if ($validation->fails()) {
            $error_array[]=$validation->messages();
//            foreach (  $validation->messages()->getMessages() as  $messages) {
//                $error_array[]=$messages;
//            }
        }else{
            $user=User::find($request->id);
            $user->name=$request->name;

            if ($request->level==1||$request->level==2){
                $user->level=$request->level;
                $user->loaiTK=null;
                $user->beginloaiTK=null;
                $user->endloaiTK=null;

            }else{
                $user->level=$request->level;
                if ($user->loaiTK!= $request->loaiTK){
                    $user->loaiTK=$request->loaiTK;
                    $user->beginloaiTK=Carbon::now()->toDateString();
                    $user->endloaiTK=Carbon::now()->addDays(30)->toDateString();
                }

            }

            $user->save();

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

        User::destroy($request->id);
        return response([
            'success'=>'Bạn đã xóa thành công'
        ]);
    }
    public function active(Request $request)
    {
        $user=User::find($request->value);
        $user->activated=1;
        $user->save();
        return response([
            'success'=>'Kích hoạt thành công.'
        ]);
    }
    public function resetpass(Request $request)
    {
        $user=User::find($request->value);
        $user->password=bcrypt('1');
        $user->save();
        return response([
            'success'=>'Thành công.ResetPassword thành 1.'
        ]);
    }
    public function editImage(Request $request){
        $user=User::find($request->id);
        if($request->hasFile('hinhanh')){

            $image = $request->hinhanh;
            $new_name =str_random() . '.' . $image->getClientOriginalExtension();
            if($user->hinhanh!='notimage.png'){
                unlink('images/'.$user->hinhanh);
            }
            $user->hinhanh=$new_name;
        }
        $image->move(public_path('images'), $new_name);
        $user->save();
        return response([
            'success'=>'Bạn đã update thành công'
        ]);
    }
    public function editInfo(Request $request){
        $error='';
        $success='';
        $user=User::find(Auth::user()->id);
        if ($request->oldpw !=null){
            if (Hash::check($request->oldpw,Auth::user()->password)){
                $user->password=bcrypt($request->newpw);
                $success='Bạn đã cập nhật thành công';
            }else{
                $error='Mật khẩu hiện tại không đúng vui lòng kiểm tra lại.';
            }
        }
        $user->save();
        return response([
            'success'=>$success,
            'errors'=>$error
        ]);
    }
}
