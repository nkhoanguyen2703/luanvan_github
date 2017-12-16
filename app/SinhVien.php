<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Foundation\Auth\SinhVien as Authenticatable;
use App\GiangVien;
class SinhVien extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "SinhVien";
    protected $primaryKey = 'sv_ma';

    protected $fillable = [
        'sv_ma', 'password', 'sv_ten','sv_khoahoc','dt_ma','manganh',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getAuthPassword() {
        return $this->password;
    }

    public function get_tenSV(){
        return $this->sv_ten;
    }
    public function getAuthIdentifier() {
        return $this->attributes['sv_ma'];
    }
    public function get_ma_nganh(){
        return $this->manganh;
    }
    public static function list_sinhvien($bomon){ // de? cham diem
        $hockyhientai = GiangVien::get_hocky_hientai();
        $namhochientai = GiangVien::get_namhoc_hientai();
        $result = SinhVien::join('Nganh','Nganh.nganh_ma','=','SinhVien.manganh')
         ->join('BoMon','BoMon.bm_ma','=','Nganh.bm_ma')
         ->join('DangKy','DangKy.sv_ma','=','SinhVien.sv_ma')
         ->join('DeTai','DeTai.dt_ma','=','DangKy.dt_ma')
         ->join('ChuNhiem','ChuNhiem.dt_ma','=','DeTai.dt_ma')
         ->join('GiangVien','GiangVien.gv_ma','=','ChuNhiem.gv_ma')
         ->join('QuyenLV','SinhVien.sv_ma','=','QuyenLV.sv_ma')
         ->join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','DeTai.kh_id')
         ->where('BoMon.bm_ma','=',$bomon)
         ->where('DangKy.kq','=',1)
         ->where('KeHoachLuanVan.MaNamHoc','=',$namhochientai)
         ->where('KeHoachLuanVan.MaHocKy','=',$hockyhientai)
        ->get();
        return $result;
    }

    public static function list_sinhvien_in($magv){ // de? in ds sinh viên đang thực hiện luận văn của GV đang login
         //lay giang vien
        $hockyhientai = GiangVien::get_hocky_hientai();
        $namhochientai = GiangVien::get_namhoc_hientai();
        $result = SinhVien::join('Nganh','Nganh.nganh_ma','=','SinhVien.manganh')
         ->join('DangKy','DangKy.sv_ma','=','SinhVien.sv_ma')
         ->join('DeTai','DeTai.dt_ma','=','DangKy.dt_ma')
         ->join('ChuNhiem','ChuNhiem.dt_ma','=','DeTai.dt_ma')
         ->join('GiangVien','GiangVien.gv_ma','=','ChuNhiem.gv_ma')
         ->join('KeHoachLuanVan','KeHoachLuanVan.kh_id','=','DeTai.kh_id')        
         ->where('DangKy.kq','=',1)
         ->where('GiangVien.gv_ma','=',$magv)
          ->where('KeHoachLuanVan.MaNamHoc','=',$namhochientai)
          ->where('KeHoachLuanVan.MaHocKy','=',$hockyhientai)
        ->get();
        return $result;
    }
    //public $incrementing = false;
}
