<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Theloai_DouongController extends Controller
{
    public function index(){
        return view('backend.Theloai_Douong');
    }
}
