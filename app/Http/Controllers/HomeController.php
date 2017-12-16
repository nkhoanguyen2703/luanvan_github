<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DangKy;
use Auth;
use GiangvienController;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() ///show trang home cua sinh vien ra
    {
        $mssv=Auth::user()->getAuthIdentifier();
        $dk= new DangKy();
        $kiemtra=$dk->kiemtra_dangky_haychua();
        if($kiemtra==true){ //dang ky roi
            //kiem tra de xuat
            $dexuat = DangKy::get_detai_dexuat($mssv);
            if(count($dexuat) > 0 ){
                return view('home')->with('thongtindetai_dexuat', $dexuat);
            }else{
                $thongtindetai=$dk->get_thongtindetai($mssv);
                return view('home')->with('thongtindetai', $thongtindetai);
            }
            
        }else{
            return redirect()->route('dkdetai');
        }
        //return view('home');
    }
    public function index_of_GV(){
        return redirect()->route('quanlySV');
    }
}
