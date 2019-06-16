<?php

namespace App\Http\Controllers\Admin;

use App\ChiTietHoaDonSach;
use App\HoaDonSach;
use App\Http\Resources\MuonTraSach as MTResource;
use App\MuonSachTraSach;
use App\Sach;
use App\User;
use App\ViTien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class MSTSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.muontrasach');
    }
    public function getData(){

        return MTResource::collection(MuonSachTraSach::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books=Sach::all();
        return view('backend.msts-add',compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mang=[];
        $ids=[];
        $muonsach=new MuonSachTraSach();
        $muonsach->user_id=$request->user_id;
        $muonsach->ngaymuon=date('Y-m-d');
        $muonsach->hantra= Carbon::now()->addDays($request->thoigian)->toDateString();
        $muonsach->tiendatcoc= $request->tiendatcoc;
        $muonsach->tienthue= (3000*$request->thoigian)*count($request->sach_id);
        $muonsach->songaymuon=$request->thoigian;
        $muonsach->active=0;
        $muonsach->nguoidk=Auth::user()->email;
        $muonsach->save();
        foreach($request->sach_id as $sach){
            $book=Sach::where('name_slug_sach','=',$sach)->first();
            array_push($ids,$book->id);
            array_push($mang,$book);
        };
        foreach ($ids as $id){
            $sach=Sach::find($id);
            $sach->soluong=$sach->soluong - 1;
            $sach->solanmuon+=1;
            $sach->save();
        }
        foreach ($mang as $b){
            $muonsach->books()->attach($b,array('active'=>0));
        };
//        $user=User::find($request->user_id);
//        $user->tien=$user->tien - $request->tiendatcoc;
//        $user->save();

        return response([
            'success'=>'Đã đăng ký mượn sách thành công'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $phieumuon=MuonSachTraSach::find($request->id);

        return view('backend.phieumuon',compact('phieumuon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $infomuontra=MuonSachTraSach::find($request->id);

        $books=Sach::all();
        return view('backend.msts-edit',compact('infomuontra','books'));
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
        $mangsach=[];
        $ids=[];
        $infomt=MuonSachTraSach::find($request->id);

        $sach=$infomt->books;
        foreach ($request->sach_id as $value){
            $book=Sach::where('name_slug_sach','=',$value)->first();
            array_push($ids,$book->id);
            array_push($mangsach,$book);
        }
        foreach ($sach->all() as $a){
            $soluong=Sach::find($a->id);
            $soluong->soluong=$soluong->soluong + 1;
            $soluong->solanmuon-=1;
            $soluong->save();
        }
        $infomt->books()->detach();
        foreach ($mangsach as $b){
            $infomt->books()->attach($b,array('active'=>0));
        };
        foreach ($ids as $id){
            $sach=Sach::find($id);
            $sach->soluong=$sach->soluong - 1;
            $sach->solanmuon+=1;
            $sach->save();
        }
        if ($request->thoigian != $infomt->songaymuon){
            $infomt->tienthue= 3000*$request->thoigian;
            $infomt->songaymuon=$request->thoigian;
        }
        $infomt->tiendatcoc= $request->tiendatcoc;
        $infomt->tienthue= (3000*$request->thoigian)*count($request->sach_id);
        $infomt->save();
        return response([
            'success'=>'Đã update thành công',
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
        $infomt=MuonSachTraSach::find($request->id);
        MuonSachTraSach::destroy($request->id);
        return response([
            'success'=>'Bạn đã xóa thành công',
        ]);
    }
    public function searchuser(Request $request){
        $check='';
        $user=User::where($request->column,'=',$request->tukhoa)->where('activated','=','1')->where('level','<>','1')->where('level','<>','2')->first();
        if($user==''){
            return '<p style="text-align:center;">Không tìm thấy thông tin tài khoản </p>';
        }else{
            $checkmuonsach=$user->muontrasach->all();
            foreach ($checkmuonsach as $checkms){
                if ($checkms->active==0){
                    $check='Đang mượn';
                    break;
                }
            }

            return view('backend.searchuser',compact('user','check'));
        }


    }
    public function datcoc(Request $request){

        $mang=[];
        if ($request->value==''){
            return '0';
        }else{
            foreach ($request->value as $val){
                $b=Sach::where('name_slug_sach','=',$val)->first();
                $c=$b->gia+ $b->gia/2;
                array_push($mang,$c);
            }
            return array_sum($mang);
        }
    }
    public function gettrasach(){
        return view('backend.trasach');
    }
    public function searchpm(Request $request){
        $phieumuon=MuonSachTraSach::where($request->column,'=',$request->tukhoa)->where('active','=','0')->first();
        if (empty($phieumuon)){
            return'<p style="text-align: center;text-transform: capitalize">Không tìm thấy thông tin phiếu mượn.</p>';
        }else{
            return view('backend.searchpm',compact('phieumuon'));

        }
    }
    public function posttrasach(Request $request){

        $mang=[];
        $sach=explode(',',$request->sach_id);
        $tinhtrang=explode(',',$request->tinhtrang);
        $a=array_combine($sach,$tinhtrang);
        $phieumuon=MuonSachTraSach::find($request->id);
        $hoadon=new HoaDonSach();


        $ngayht=Carbon::now();
        $songaymuon= $ngayht->diffInDays($phieumuon->ngaymuon);
        $hoadon->muontra_id=$request->id;
        if ($phieumuon->songaymuon - $songaymuon >=0){
            $hoadon->tienquahan=0;
            $hoadon->songayquahan=0;
            $hoadon->tienthanhtoan=(3000*$phieumuon->songaymuon)*count($a);
            $hoadon->tienthue=$hoadon->tienthanhtoan;
        }else{
            $hoadon->songayquahan=($songaymuon - $phieumuon->songaymuon);
            $hoadon->tienquahan=(5000*($songaymuon - $phieumuon->songaymuon))*count($a);
            $hoadon->tienthanhtoan=(3000*$phieumuon->songaymuon)*count($a) + $hoadon->tienquahan;
            $hoadon->tienthue=$hoadon->tienthanhtoan;
        }
        foreach ($a as $key =>$b){
            $sach=Sach::find($key);
            if ($b=='BT'){
                $tienhongsach=0;
                array_push($mang,$tienhongsach);
            }else if ($b=='LM'){
                $tienhongsach=$sach->gia + ($sach->gia /2);
                array_push($mang,$tienhongsach);
            }else{
                $tienhongsach=($sach->gia * $b)/100;
                array_push($mang,$tienhongsach);
            }
        }
        $hoadon->tienthanhtoan+= array_sum($mang);
        $hoadon->nguoitt=Auth::user()->email;

        $user=User::find($phieumuon->user_id);
        $vitien=new ViTien();
        if (($user->tien - $hoadon->tienthanhtoan) >=0){
            $user->tien-=$hoadon->tienthanhtoan;
            $vitien->tentaikhoan=$user->email;
            $vitien->ngaynap=date('Y-m-d');
            $vitien->tiennap=$hoadon->tienthanhtoan;
            $vitien->status=1;
            $vitien->nguoinap=Auth::user()->email;
            $vitien->save();
            $hoadon->save();
            $user->save();
            foreach ($a as $key=> $b){
                $hoadonct= new ChiTietHoaDonSach();
                $sach=Sach::find($key);
                $phieumuon->books()->updateExistingPivot($sach, array('active'=>1,'ngaytra'=>date('Y-m-d')));
                $hoadonct->hds_id=$hoadon->id;
                $hoadonct->sach_id=$key;
                if ($b==='BT'){
                    $hoadonct->tinhtrang=0;
                    $hoadonct->tienphathongsach=0;
                    $sach->soluong+= 1;
                }
                if ($b==='LM'){
                    $hoadonct->tinhtrang=1;
                    $hoadonct->tienphathongsach=$sach->gia + ($sach->gia /2);
                }
                if ($b==25){
                    $hoadonct->tinhtrang=25;
                    $hoadonct->tienphathongsach=($sach->gia *25)/100;
                    $sach->soluong+= 1;
                }
                if ($b==50){
                    $hoadonct->tinhtrang=50;
                    $hoadonct->tienphathongsach=($sach->gia *50)/100;
                    $sach->soluong+= 1;
                }
                if ($b==75){
                    $hoadonct->tinhtrang=75;
                    $hoadonct->tienphathongsach=($sach->gia *75)/100;
                    $sach->soluong+= 1;
                }
                $sach->save();
                $hoadonct->save();
            }
        }else{
            return response([
                'success'=>'',
                'errors'=>($hoadon->tienthanhtoan-$user->tien)
            ]);
        }


        if (count( $phieumuon->books->where('pivot.active','=','1')->toArray())==count( $phieumuon->books)){
            $phieumuon->active=1;
            $phieumuon->save();
        }

        return response([
            'success'=>'Trả sách thành công',
            'hoadon'=>$hoadon->id,
            'errors'=>''
        ]);
    }
    public function pdf($id){
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->phieumuonct_html($id));
        return $pdf->stream();
    }
    function phieumuonct_html($id){
        $phieumuon=MuonSachTraSach::find($id);

        return view('backend.pdf_phieumuon',compact('phieumuon'));
    }
}
