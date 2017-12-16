<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\KeHoach;
use App\GiangVien;
use App\DeTai;
use App\ChuNhiem;
use App\DangKy;
use App\SinhVien;
use App\BoMon;
use App\ChamDiem;
use Carbon\Carbon; // set time
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Session;
class GiangvienController extends Controller
{
	public function __construct() {
    	$this->middleware('giangvien',['except' => 'logout']);
    }

    public function showGVhome(){
    	return view('giangvien.index');
    }
////////////////////////////////////////////////////////////////////////////////////////////////

    public function showRaKHLV(){
    	return view('giangvien.KHLV');
    }

    public function themKeHoach(Request $request){
        $kh= new KeHoach;
        $kh->kh_ten=$request->input('txtTenkehoach');
        $kh->kh_ngayrade=$request->input('txtNgayrade');
        $kh->kh_hanrade=$request->input('txtHanrade');
        $kh->kh_ngaydangky=$request->input('txtNgaydangky');
        $kh->kh_handangky=$request->input('txtHandangky');
        $kh->MaHocKy=$request->input('txtHocky');
        $kh->MaNamHoc=$request->input('txtNamhoc');
        if($kh->save()  ){
            
            return redirect()->back()->with('alert_ok', 'Đã thêm kế hoạch luận văn mới');
        }else{
            
            return redirect()->intended('raKHLV')->with('alert_not','Không thành công');
        }
 
    }
/////////////////////////////////////////////////////////////////////////////////////////////////
   

    public function showRadetai(){
        $kehoach=KeHoach::get_kehoach_now();
        return View('giangvien.Radetai')->with('kehoach', $kehoach);
    }



    public function radetai(Request $request){
        $dt=new DeTai;
        $dt->dt_ten=$request->input('txtTendetai');
        $dt->dt_noidung=$request->input('txtNoidung');
        $dt->kh_id=$request->input('slKehoach');

        $kh=new KeHoach();

        $kh=$kh->kiemtraTime($dt->kh_id);  

        //lay id de tai tip theo
        $nextid = DB::table('information_schema.TABLES')-> where('TABLE_SCHEMA', 'luanvan')-> where('TABLE_NAME', 'DeTai')-> value('AUTO_INCREMENT');
        ////////////////////////

        if($kh==true){
            if($dt->save()){
                $cn= new ChuNhiem();
                $cn->gv_ma=Auth::guard('giangvien')->user()->getAuthIdentifier();
                $cn->dt_ma=$nextid;
                if($cn->save()){
                    return redirect()->back()->with('alert_ok', 'Đã thêm đề tài mới');
                }else{
                    return redirect()->back()->with('alert_not', 'Thất bại do không lấy được nextid');
                }
            }else{
                return redirect()->back()->with('alert_not', 'Thất bại');
            }
        }else{
            return redirect()->back()->with('alert_not', 'Chưa đến thời gian nhập đề tài cho kế hoạch này');
        }

        
    }

    public function showQuanlySV(){
        //the old one
        // $thongtin=DeTai::list_detai_of_current_gv();
        // $thongtindangky = new DangKy();
        // $data = array('listdetai'=>$thongtin, 'thongtindk'=>$thongtindangky);
            
        $listdetai = DeTai::list_detai_chunhiem();
        $listdetai_dx = DeTai::list_detai_dx();
        $thongtindangky = new DangKy();

        $data = array('listdetai'=>$listdetai,'listdetaidx'=>$listdetai_dx, 'thongtindk'=>$thongtindangky);
        return view('giangvien.quanlySV')->with($data);
    }
        // if($dt->save()){
        //     return redirect()->back()->with('alert_ok', 'Đã thêm đề tài mới');
        // }else{
        //     return redirect()->back()->with('alert_ok', 'Thất bại');
        // }
    
    public function duyetsv($masv){
        $result = DangKy::duyetsv($masv); //update table Đăng KÝ =1
        
        if($result){
            return redirect()->back()->with('alert_ok', 'Đã duyệt sinh viên '.$masv);
        }else{
            return redirect()->back()->with('alert_not', 'Chưa duyệt được ');
        }
        
    }
    public function tuchoi_sv($masv){
        $result = DangKy::tuchoi_sv($masv); //Xoá dòng đăng ký trong bảng DK
        
        if($result){
            return redirect()->back()->with('alert_ok', 'Đã từ chối sinh viên:  '.$masv);
        }else{
            return redirect()->back()->with('alert_not', 'Có lỗi xảy ra khi từ chối !');
        }
        
    }
    public function duyetsv_dexuat($masv,$madt){ /// vừa update vào bảng DangKy, vừa Insert bảng Chủ nhiệm
        $result = DangKy::duyetsv($masv); //update table Đăng KÝ =1

        if($result){
            $magv=Auth::guard('giangvien')->user()->getAuthIdentifier();
            $chunhiem = new ChuNhiem();
            $chunhiem->gv_ma=$magv;
            $chunhiem->dt_ma=$madt;
            if($chunhiem->save()){
                return redirect()->back()->with('alert_ok', 'Đã duyệt sinh viên: '.$masv.' ,đồng thời chủ nhiệm đề tài: '.$madt);
            }else{
                return redirect()->back()->with('alert_not', 'Chưa duyệt được 001xx');
            }
            
        }else{
            return redirect()->back()->with('alert_not', 'Chưa duyệt được 002xx');
        }
    }
    public function tuchoi_sv_dexuat($masv,$madt){ 
        $result = DangKy::tuchoi_sv($masv); //xoa trong bang Dang ky
        $result2 = DeTai::xoa_detai($madt); // xoa de tai ma sinh vien de xuat
        if($result && $result2){  
            return redirect()->back()->with('alert_ok', 'Đã từ chối sinh viên:  '.$masv);
        }else{
            return redirect()->back()->with('alert_not', 'Có lỗi xảy ra khi từ chối !');
        }
    }

    public function showChamdiem(){
        $listbomon= BoMon::get_bomon();
        $listSV= new SinhVien();
        $diemcu= new ChamDiem();
        $data = array('listbomon'=>$listbomon, 'listSV'=>$listSV, 'diemcu'=>$diemcu);
        return view('giangvien.chamdiem')->with($data);
    }
 
    public function chamdiem(Request $request){
         $chamdiem = new ChamDiem();
         $magv=Auth::guard('giangvien')->user()->getAuthIdentifier();
         $chamdiem->gv_ma=$magv;
         $chamdiem->lv_ma=$request->input('maluanvan');
         
         $chamdiem->diem=$request->input('diem');

        if($chamdiem->save()){
            return redirect()->back()->with('alert_ok', 'Đã cập nhật điểm luận văn');
        }else{
            return redirect()->back()->with('alert_not', 'Chưa cập nhật được điểm'); 
        }
        
    }


    //in danh sach sinh vien
    public function showprintPreview(){
        $magv=Auth::guard('giangvien')->user()->getAuthIdentifier();
        $listSV = SinhVien::list_sinhvien_in($magv);

        if(!empty($listSV)){
            return view('giangvien.printPreview',compact('listSV'));
        }
              
            //return view('giangvien.printPreview')->with('listSV',$listSV);
        //$listSV=SinhVien::all();
        
    }
    
    public function show_dsdetai(){ //show ds de tai hocki nam hoc hien tai
        $magv=Auth::guard('giangvien')->user()->getAuthIdentifier();
        $list = DeTai::show_list_detai($magv);
        return view('giangvien.danhsachdetai')->with('listDT',$list);
    }


      
    
}












