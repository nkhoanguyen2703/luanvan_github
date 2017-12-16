<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon; // set time
class DeTai extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "DeTai";
    protected $primaryKey = 'dt_ma';
    public $timestamps = false;
    protected $fillable = [
        'dt_ma','dt_ten','svdexuat','kh_id'
    ];
    public function get_dt_ma() {
        return $this->attributes['dt_ma'];
    }

    public static function list_detai_of_current_sv(){ // lay luon ten GV va` Ke hoach lV
        ///lay id sinh vien
        $id=Auth::user()->getAuthIdentifier();
        $manganh=Auth::user()->get_ma_nganh();
        $current = Carbon::now();
        
        $result = DeTai::join('KeHoachLuanVan','DeTai.kh_id','=','KeHoachLuanVan.kh_id')
         ->join('ChuNhiem','DeTai.dt_ma','=','ChuNhiem.dt_ma')
         ->join('GiangVien','ChuNhiem.gv_ma','=','GiangVien.gv_ma')
         ->join('BoMon','GiangVien.bm_ma','=','BoMon.bm_ma')
         ->join('Nganh','BoMon.bm_ma','=','Nganh.bm_ma')
         //->join('SinhVien','SinhVien.manganh','=','Nganh.nganh_ma')
         ->where('DeTai.svdexuat','=',null)
         ->where('Nganh.nganh_ma', '=', $manganh)
         ->where('KeHoachLuanVan.kh_ngayrade', '<=', $current)
         ->where('KeHoachLuanVan.kh_handangky', '>=', $current)
        ->get();
       
       return $result;

    }

    public static function kiemtra_thoigian_dangky($madetai){ //kiem tra de tai ts ngay dk hay chua, 
        $current = Carbon::now();
        $result = DeTai::join('KeHoachLuanVan','DeTai.kh_id','=','KeHoachLuanVan.kh_id')
        ->where('DeTai.dt_ma','=',$madetai)
        ->where('KeHoachLuanVan.kh_ngaydangky','<=',$current)
        ->where('KeHoachLuanVan.kh_handangky','>=',$current)
        ->first();

        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }

    public static function list_detai_of_current_gv(){ //Chọn ra kế hoạch gần nhất, mà có đề tài của gv đang chủ nhiệm , lấy thêm đề tài của sv đề xuất trong bộ môn
        ///lay id sinh vien
        $gvid=Auth::guard('giangvien')->user()->getAuthIdentifier();
        
        $kehoachhientai_id = DeTai::join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','Detai.kh_id')
          ->join('ChuNhiem','ChuNhiem.dt_ma','=','DeTai.dt_ma')
          ->join('GiangVien','GiangVien.gv_ma','=','ChuNhiem.gv_ma')
          ->join('DangKy','DangKy.dt_ma','=','DeTai.dt_ma')
          ->join('SinhVien','SinhVien.sv_ma','=','DangKy.sv_ma')
          ->where('ChuNhiem.gv_ma', '=', $gvid)
          ->max('KeHoachLuanVan.kh_id');

          // $hocky = GiangVien::get_hocky_hientai();
          // $namhoc=GiangVien::get_namhoc_hientai();

        $result = DeTai::join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','Detai.kh_id')
          ->where('KeHoachLuanVan.kh_id','=',$kehoachhientai_id)
          ->distinct('DeTai.dt_ma')
          ->get();

       //  $result = DeTai::join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','Detai.kh_id')
       //    ->where('KeHoachLuanVan.MaHocKy','=',$hocky)
       //    ->where('KeHoachLuanVan.MaNamHoc','=',$namhoc)
       //    ->get();
        return $result;
    }
    ///new
    public static function list_detai_chunhiem(){ // hien tai
          $gvid=Auth::guard('giangvien')->user()->getAuthIdentifier();
          $hocky = GiangVien::get_hocky_hientai();
          $namhoc=GiangVien::get_namhoc_hientai();

       $result = DeTai::join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','Detai.kh_id')
          ->join('ChuNhiem','ChuNhiem.dt_ma','=','Detai.dt_ma')
          ->where('KeHoachLuanVan.MaHocKy','=',$hocky)
          ->where('KeHoachLuanVan.MaNamHoc','=',$namhoc)
          ->where('ChuNhiem.gv_ma','=',$gvid)
          ->get();
          return $result;
    }
    public static function list_detai_dx(){
        $gvid=Auth::guard('giangvien')->user()->getAuthIdentifier();

        $result=DeTai::join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','Detai.kh_id')
        ->join('DangKy','DangKy.dt_ma','=','DeTai.dt_ma')
        ->join('SinhVien','SinhVien.sv_ma','=','DangKy.sv_ma')
        ->join('Nganh','Nganh.nganh_ma','=','SinhVien.manganh')
        ->join('BoMon','BoMon.bm_ma','=','Nganh.bm_ma')
        ->join('GiangVien','GiangVien.bm_ma','=','BoMon.bm_ma')

        ->where('GiangVien.gv_ma','=',$gvid)
        ->where('DeTai.svdexuat','!=',NULL)
        ->where('DangKy.kq','=',0)
        ->select('DeTai.dt_ma','DeTai.dt_ten','DeTai.svdexuat','DeTai.dt_noidung')
        ->distinct()
        ->get();
        return $result;
    }

    public static function xoa_detai($madetai){
        $dt = new DeTai();
        $result=$dt->where('dt_ma',$madetai)->delete();
        return $result;
    }

    public static function list_detai_of_search($noidung){
      $result = DeTai::join('DangKy','DangKy.dt_ma','=','DeTai.dt_ma')
       ->join('ChuNhiem','ChuNhiem.dt_ma','=','DeTai.dt_ma')
       ->join('GiangVien','GiangVien.gv_ma','=','ChuNhiem.gv_ma')
       ->join('SinhVien','SinhVien.sv_ma','=','DangKy.sv_ma')
       ->join('Nganh','Nganh.nganh_ma','=','SinhVien.manganh')
       ->join('BoMon','BoMon.bm_ma','=','Nganh.bm_ma')
       ->join('QuyenLV','QuyenLV.sv_ma','=','SinhVien.sv_ma')
      // ->where('DeTai.dt_ten','like','%'.@$noidung.'%')
       ->where('DeTai.dt_ten','like BINARY', '%'.$noidung.'%')
      // ->orwhere('SinhVien.sv_ten','like','%'.$noidung.'%')
      // ->orwhere('GiangVien.gv_ten','like','%'.$noidung.'%')
      // ->orwhere('BoMon.bm_ten','like','%'.$noidung.'%')
      // ->orwhere('Nganh.nganh_ten','like','%'.$noidung.'%')
      ->get();

      
      return $result;
    }

    public static function show_list_detai($magv){
      $hocky = GiangVien::get_hocky_hientai();
      $namhoc=GiangVien::get_namhoc_hientai();
      $result= DeTai::join('ChuNhiem','ChuNhiem.dt_ma','=','DeTai.dt_ma')
      ->join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','DeTai.kh_id')
      ->where('ChuNhiem.gv_ma','=',$magv)
      ->where('KeHoachLuanVan.MaNamHoc','=',$namhoc)
      ->where('KeHoachLuanVan.MaHocKy','=',$hocky)
      ->get();
      return $result;
    }
    




}
