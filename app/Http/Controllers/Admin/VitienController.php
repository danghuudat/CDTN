<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\ViTien;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VitienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $naptien=new ViTien();
        $naptien->tentaikhoan=$request->id;
        $naptien->tiennap=$request->tiennap;
        $naptien->ngaynap=date('Y-m-d');
        $naptien->nguoinap=Auth::user()->email;
        $naptien->save();
        $info=ViTien::find($naptien->id);
        $user=User::where('email','=',$request->id)->first();
        $user->tien+=$request->tiennap;
        $user->save();
        $email=$user->email;

        Mail::send('backend.emailnaptien',compact('info'), function ($message) use($email) {
            $message->from('cafe.booklight@gmail.com', 'cafebooklight');

            $message->to($email,$email);

            $message->subject('Xác nhận tài khoản nạp tiền của Café Booklight');

        });
        return response([
            'success'=>'Bạn đã nạp tiền thành công.'
        ]);
    }
    public function history(){
        $ngaynap=ViTien::orderBy('ngaynap','DESC')->get()->groupBy(function ($item){
            return date('d-m-Y',strtotime($item->ngaynap));
        });
        return view('backend.lichsunt',compact('ngaynap'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
