<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeTai;
use App\DangKy;
use Auth;
use App\KeHoach;
use App\QuyenLV;
use App\ChamDiem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class SinhvienController extends Controller
{

    public function showDkdetai(){
    	// $list = new Detai();
    	$list=DeTai::list_detai_of_current_sv();
      
    	return view('sinhvien.dkdetai')->with('listDetai', $list);
    }
    public function dangkydetai($madetai){
    	
    	$check_dangky=DangKy::kiemtra_dangky_haychua();
    	if($check_dangky==false){ ///chua dang ky de tai nao

	    	$checkdate=DeTai::kiemtra_thoigian_dangky($madetai);
	    	if($checkdate==true){
	    		$dk = new DangKy();
		    	$dk->sv_ma=Auth::user()->getAuthIdentifier();
		    	$dk->dt_ma=$madetai;
	    		if($dk->save()){
	            	return redirect()->back()->with('alert_ok', 'Đăng ký thành công');
		        }else{
		            return redirect()->back()->with('alert_not', 'Thất bại');
		        }
	    	}else{
	    		return redirect()->back()->with('alert_not', 'Chưa đến thời gian đăng ký');
	    	}
    	}else{
    		return redirect()->back()->with('alert_not', 'Không được đăng ký hoặc đề xuất cùng lúc 2 đề tài');
    	}
    
    }

    public function showDexuat(){
        $kehoach=KeHoach::get_kehoach_now();
        return view('sinhvien.dexuat')->with('kehoach', $kehoach);
    }

    public function dexuat(Request $request){
        $check_dangky=DangKy::kiemtra_dangky_haychua();
        if($check_dangky==false){ ///chua dang ky de tai nao

          $kh=new KeHoach();
          $kh=$kh->kiemtraTime($request->input('slKehoach'));   // kiem tra ngay ra de` cua ke hoach
          if($kh==true){
              $mssv=Auth::user()->getAuthIdentifier();
              $dt= new DeTai;

              /////Lay id de tai tip theo , để save vào bảng đăng ký luôn
              $nextid = DB::table('information_schema.TABLES')-> where('TABLE_SCHEMA', 'luanvan')-> where('TABLE_NAME', 'DeTai')-> value('AUTO_INCREMENT');
              ////////////////////////

              $dt->kh_id=$request->input('slKehoach');
              $dt->dt_ma=$nextid;
              $dt->dt_noidung=$request->input('txtNoidung');
              $dt->dt_ten=$request->input('txtTendetai');
              $dt->svdexuat=$mssv;

              if($dt->save()){ // lưu vào bảng đề tài
                  $dk = new DangKy();
                  $dk->sv_ma=$mssv;
                  $dk->dt_ma=$nextid;
                  
                  $dk->kq=0;
                  if($dk->save()){ //lưu vào bảng Đăng ký với kq =0 
                      return redirect()->back()->with('alert_ok', 'Đề xuất thành công, sinh viên vui lòng chờ duyệt');
                  }else{
                      return redirect()->back()->with('alert_not', 'Thất bại 001x');
                  }

              }else{
                  return redirect()->back()->with('alert_not', 'Thất bại 002x');
              }
          }  
        }else{
            return redirect()->back()->with('alert_not', 'Không được đăng ký hoặc đề xuất cùng lúc 2 đề tài');
        }
    }
    public function showUploadForm(){
        return view('sinhvien.upload');
    }
    
    public function doUpload(Request $request){
        $check = DangKy::kiemtra_duyet_haychua(); //kiem tra sv da dc duyet làm lv rồi chưa ?
        if($check==true){
          $check2=QuyenLV::nopluanvan_haychua();
          if($check2==false){//chua nop LV lan` nao

          

        //Kiểm tra file
             if($request->hasFile('filesTest')){
                $file = $request->filesTest;
                $mssv=Auth::user()->getAuthIdentifier();
                $fileName = 'LV_'.$mssv.'.pdf';

                $destinationPath =public_path()."/luanvan_uploaded/";
                
                if($file->getClientOriginalExtension()=='pdf'){
                    if($file->move($destinationPath,$fileName)){
                      $luanvan = new QuyenLV();
                      $luanvan->lv_ten=$fileName;
                      $luanvan->sv_ma=$mssv;

                          if($luanvan->save()){
                            return redirect()->back()->with('alert_ok_lv', 'Tải lên thành công');
                          }else{
                            return redirect()->back()->with('alert_not_lv', 'Tải lên thất bại');
                          }
                    }else{
                      return redirect()->back()->with('alert_not_lv', 'Chưa tải lên được');
                    }
                }else{
                  return redirect()->back()->with('alert_not_lv', 'Chưa đúng định dạng tệp tin .PDF');
                }
             }else{
                return redirect()->back()->with('alert_not_lv', 'Chưa chọn tệp tin');
             }

            }else return redirect()->back()->with('alert_not_lv', 'Không được nộp luận văn 2 lần');

        }else 
          return redirect()->back()->with('alert_not_lv', 'Chưa đăng ký luận văn');

      }//end function
       
       //Lấy Tên files
          // echo 'Tên Files: '.$file->getClientOriginalName();
          // echo '<br/>';
   
          // //Lấy Đuôi File
          // echo 'Đuôi file: '.$file->getClientOriginalExtension();
          // echo '<br/>';
   
          // //Lấy đường dẫn tạm thời của file
          // echo 'Đường dẫn tạm: '.$file->getRealPath();
          // echo '<br/>';
   
          // //Lấy kích cỡ của file đơn vị tính theo bytes
          // echo 'Kích cỡ file: '.$file->getSize();
          // echo '<br/>';
   
          // //Lấy kiểu file
          // echo 'Kiểu files: '.$file->getMimeType();   

      public function showXemdiem(){
        $lichsudiem = ChamDiem::thongke();
        $diemcuoicung = ChamDiem::thongkelai();
        $ketqua = ChamDiem::trungbinh();
        $diemchu = ChamDiem::doi_diem_thanh_chu($ketqua);

        $tmp = array('gv'=>$lichsudiem,'diemcuoi'=>$diemcuoicung,'tb'=>$ketqua,'diemchu'=>$diemchu);
        return view('sinhvien.xemdiem')->with($tmp);
      }

      public function showSearch(){
        return view('sinhvien.timkiem');
      }
      public function search(Request $request){
         $noidung=$request->input('noidungsearch'); // hien thi OK roi`
         $luanvan=DeTai::list_detai_of_search($noidung);
        return view('sinhvien.timkiem')->with('ketqua', $luanvan);
      }

      


}
