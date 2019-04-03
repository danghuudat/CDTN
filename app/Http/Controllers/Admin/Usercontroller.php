<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Usercontroller extends Controller
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
        return response([
            'data'=> User::all()
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
            $user->level=$request->level;
            $user->status=$request->status;
            $user->activated=1;
            $user->password=bcrypt('1');
            $user->beginstatus=Carbon::now()->toDateString();
            $user->endstatus=Carbon::now()->addDays(30)->toDateString();
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
        return User::find($request->id);
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
            $user->level=$request->level;
            if ($user->status!== $request->status){
                $user->status=$request->status;
                $user->beginstatus=Carbon::now()->toDateString();
                $user->endstatus=Carbon::now()->addDays(30)->toDateString();
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
}
