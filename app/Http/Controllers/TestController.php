<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DangKy;
use Auth;
use Carbon\Carbon; // set time
use App\GiangVien;
class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showtest() ///show trang home cua sinh vien ra
    {
    	$gv = new GiangVien();
    	$xyz = $gv->get_namhoc_hientai();
    	$abc = $gv->get_hocky_hientai();
        return view('giangvien.test')->with(array('namhoc'=>$xyz,'hocky'=>$abc));
    }
    
    
}
