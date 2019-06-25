<?php

namespace App\Http\Controllers;

use App\HoaDonSach;
use App\MuonSachTraSach;
use App\NhaXuatBan;
use App\Sach;
use App\TacGia;
use App\Theloai_Douong;
use App\TheLoaiSach;
use App\User;
use App\ViTien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index(){
        $sach=Sach::orderBy('solanmuon','DESC')->take(10)->get();

        return view('frontend.trangchu',compact('sach'));
    }
    public function cafe(){
        $douong_theloai=Theloai_Douong::all();
        return view('frontend.douong',compact('douong_theloai'));
    }
    public function thuvien(){
        $sachnoibat=Sach::where('noibat','=','1')->inRandomOrder()->get();
        $sach=Sach::orderBy('solanmuon','DESC')->limit(5)->get();
        return view('frontend.thuvien',compact('sachnoibat','sach'));
    }
    public function loadmore_tv(Request $request){
        if ($request->ajax()){
            if ($request->id>0){
                if ($request->action=='tatcasach'){
                    $data=Sach::where('id','<',$request->id)->orderBy('id','DESC')->limit(4)->get();
                }
                if ($request->action=='sachtacgia'){
                    $data=Sach::where('id','<',$request->id)->where('tacgia_id','=',$request->id_tg)->orderBy('id','DESC')->limit(4)->get();
                }
                if ($request->action=='nxbsach'){
                    $data=Sach::where('id','<',$request->id)->where('nxb_id','=',$request->id_nxb)->orderBy('id','DESC')->limit(4)->get();

                }
                if ($request->action=='namxb'){
                    $data=Sach::where('id','<',$request->id)->where('namxb','=',$request->namxb)->orderBy('id','DESC')->limit(4)->get();

                }
                if ($request->action=='theloaisach'){
                    $data=Sach::where('id','<',$request->id)->where('theloai_id','=',$request->id_tl)->orderBy('id','DESC')->limit(4)->get();

                }

            }else{
                if ($request->action=='tatcasach'){
                    $data=Sach::orderBy('id','DESC')->limit(4)->get();
                }
                if ($request->action=='sachtacgia'){
                    $data=Sach::where('tacgia_id','=',$request->id_tg)->orderBy('id','DESC')->limit(4)->get();
                }
                if ($request->action=='nxbsach'){
                    $data=Sach::where('nxb_id','=',$request->id_nxb)->orderBy('id','DESC')->limit(4)->get();

                }
                if ($request->action=='namxb'){
                    $data=Sach::where('namxb','=',$request->namxb)->orderBy('id','DESC')->limit(4)->get();

                }
                if ($request->action=='theloaisach'){
                    $data=Sach::where('theloai_id','=',$request->id_tl)->orderBy('id','DESC')->limit(4)->get();

                }
            }
            $output='';
            $last_id='';
            if (!$data->isEmpty()){

                if ($request->action=='tatcasach'){
                    $min=Sach::min('id');
                    $output.='<div class="row">';
                    foreach ($data as $row){
                        $output.='
                    <div class="col-md-3">
                        <a href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'"><div class="item">
                            <img src="'.asset('images/sach/'.$row->hinhanh).'" width="150px" height="250px" alt="img">
                            <h3 style="text-transform: capitalize"><a href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">'.$row->name_sach.'</a></h3>
                        </div></a>
                    </div>
                    ';
                        $last_id=$row->id;
                    }
                    $output.='</div>';
                    $output.='</div>';
                    if ($min ==$last_id){
                        $output.='';
                    }else{
                        $output.='
                    <div class="btn-sec">
                    <button class="btn red-btn" data-id="'.$last_id.'" id="load_more_button">load More books</button>
                    </div>
                    ';
                    }

                }
                if ($request->action=='sachtacgia'){
                    $min=Sach::where('tacgia_id','=',$request->id_tg)->min('id');
                    $output.='<div class="row pt-4">';
                    foreach ($data as $row){
                        $output.='
                    <div class="col-xs-6 col-sm-4 col-md-3 fix-col pb-4">
                        <a class="fix-img" href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">
                            <img width="150px" height="250px" src="'.asset('images/sach/'.$row->hinhanh).'" alt="img">
                        </a>
                        <div class="tensach">
                            <h3><a href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">'.$row->name_sach.'</a></h3>
                        </div>
                    </div>
                    ';
                        $last_id=$row->id;
                    }
                    $output.='</div>';
                    if ($min ==$last_id){
                        $output.='';
                    }else{
                        $output.='
                    <div class="loadmore">
                       <button class="btn red-btn" data-id="'.$last_id.'" id="load_more_button">load More books</button>
                    </div>
                    ';
                    }
                }
                if ($request->action=='nxbsach'){
                    $min=Sach::where('nxb_id','=',$request->id_nxb)->min('id');
                    $output.='<div class="row pt-4">';
                    foreach ($data as $row){
                        $output.='
                    <div class="col-xs-6 col-sm-4 col-md-3 fix-col pb-4">
                        <a class="fix-img" href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">
                            <img width="150px" height="250px" src="'.asset('images/sach/'.$row->hinhanh).'" alt="img">
                        </a>
                        <div class="tensach">
                            <h3><a href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">'.$row->name_sach.'</a></h3>
                        </div>
                    </div>
                    ';
                        $last_id=$row->id;
                    }
                    $output.='</div>';
                    if ($min ==$last_id){
                        $output.='';
                    }else{
                        $output.='
                    <div class="loadmore">
                       <button class="btn red-btn" data-id="'.$last_id.'" id="load_more_button">load More books</button>
                    </div>
                    ';
                    }
                }
                if ($request->action=='namxb'){
                    $min=Sach::where('namxb','=',$request->namxb)->min('id');
                    $output.='<div class="row pt-4">';
                    foreach ($data as $row){
                        $output.='
                    <div class="col-xs-6 col-sm-4 col-md-3 fix-col pb-4">
                        <a class="fix-img" href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">
                            <img width="150px" height="250px" src="'.asset('images/sach/'.$row->hinhanh).'" alt="img">
                        </a>
                        <div class="tensach">
                            <h3><a href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">'.$row->name_sach.'</a></h3>
                        </div>
                    </div>
                    ';
                        $last_id=$row->id;
                    }
                    $output.='</div>';
                    if ($min ==$last_id){
                        $output.='';
                    }else{
                        $output.='
                    <div class="loadmore">
                       <button class="btn red-btn" data-id="'.$last_id.'" id="load_more_button">load More books</button>
                    </div>
                    ';
                    }
                }
                if ($request->action=='theloaisach'){
                    $min=Sach::where('theloai_id','=',$request->id_tl)->min('id');
                    $output.='<div class="row pt-4">';
                    foreach ($data as $row){
                        $output.='
                    <div class="col-xs-6 col-sm-4 col-md-3 fix-col pb-4">
                        <a class="fix-img" href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">
                            <img width="150px" height="250px" src="'.asset('images/sach/'.$row->hinhanh).'" alt="img">
                        </a>
                        <div class="tensach">
                            <h3><a href="'.asset('thuvien/'.$row->name_slug_sach.'.html').'">'.$row->name_sach.'</a></h3>
                        </div>
                    </div>
                    ';
                        $last_id=$row->id;
                    }
                    $output.='</div>';
                    if ($min ==$last_id){
                        $output.='';
                    }else{
                        $output.='
                    <div class="loadmore">
                       <button class="btn red-btn" data-id="'.$last_id.'" id="load_more_button">load More books</button>
                    </div>
                    ';
                    }
                }
            }else{
                $output.='';
            }
            return $output;
        }
    }
    public function sachinfo($name){
        $sach=Sach::where('name_slug_sach','=',$name)->first();
        $sachlq=Sach::where('id','<>',$sach->id)->where('theloai_id','=',$sach->theloai_id)->inRandomOrder()->take(4)->get();
        return view('frontend.sach-info',compact('sach','sachlq'));
    }
    public function tacgia($name){
        $tacgia=TacGia::where('slug_name_tg','=',$name)->first();
        return view('frontend.tacgia',compact('tacgia'));
    }
    public function nhaxuatban($name){
        $nxb=NhaXuatBan::where('slug_name_nxb','=',$name)->first();
        return view('frontend.nhaxuatban',compact('nxb'));
    }
    public function namxb($name){
        $namxb=Sach::where('namxb','=',$name)->first();
        return view('frontend.namxb',compact('namxb'));
    }
    public function theloaisach($name){
        $tl=TheLoaiSach::where('slug_name_tl','=',$name)->first();
        return view('frontend.theloaisach',compact('tl'));
    }
    public function logoutuser(){
        Auth::logout();
        return redirect('/');
    }
    public function profile(){
        return view('frontend.profile');
    }
    public function editimg(Request $request){
        $user=User::find(Auth::user()->id);
        if($request->hasFile('hinhanh')){

            $image = $request->hinhanh;
            $new_name =str_random() . '.' . $image->getClientOriginalExtension();
            if($user->hinhanh!='profile.png'){
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
    public function editinfo(Request $request){
        $error='';
        $success='';
        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
        $user->diachi=$request->diachi;
        $user->SDT=$request->sdt;
        if ($request->oldpw !=null){
            if (Hash::check($request->oldpw,Auth::user()->password)){
                $user->password=bcrypt($request->newpw);
                $success='Bạn đã cập nhật thành công';
            }else{
                $error='Mật khẩu hiện tại không đúng vui lòng kiểm tra lại.';
            }
        }
        $success='Bạn đã cập nhật thành công';
        $user->save();
        return response([
            'success'=>$success,
            'errors'=>$error
        ]);
    }
    public function lichsu(){
        $lichsu=ViTien::orderBy('ngaynap','DESC')->where('tentaikhoan','=',Auth::user()->email)->get();
        return view('frontend.lichsu',compact('lichsu'));
    }
    public function hoadon(){
        $a=[];
        $user=User::find(Auth::user()->id);
        foreach ($user->muontrasach as $pm){
            foreach ($pm->hoadon as $hd){
                array_push($a,$hd);
            }
        }
        return view('frontend.hdtt',compact('a'));
    }
    public function pdf($id){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->hoadonct_html($id));
        return $pdf->stream();
    }
    function hoadonct_html($id){
        $hoadon=HoaDonSach::find($id);
        return view('backend.pdf_hoadon',compact('hoadon'));
    }
    public function phieumuon(){
        $phieumuon=MuonSachTraSach::where('user_id','=',Auth::user()->id)->get();

        return view('frontend.phieumuon',compact('phieumuon'));
    }
    public function pdfpm($id){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->phieumuonct_html($id));
        return $pdf->stream();
    }
    function phieumuonct_html($id){
        $phieumuon=MuonSachTraSach::find($id);

        return view('backend.pdf_phieumuon',compact('phieumuon'));
    }

}
