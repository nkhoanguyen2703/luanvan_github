<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Foundation\Auth\SinhVien as Authenticatable;
use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon; // set time
use Auth;
class DangKy extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "DangKy";
    protected $primaryKey = 'dk_id';
    public $timestamps = false; //tat che do quan li Create at, update at

    protected $fillable = [
         'sv_ma', 'dt_ma','kq',
    ];

    public static function kiemtra_dangky_haychua(){ ///tra ve true neu dk roi`
        $idsv=Auth::user()->getAuthIdentifier();
        $dk = new DangKy;
        $result=$dk->where('sv_ma','=',$idsv)->first();
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }
    public static function kiemtra_duyet_haychua(){ ///tra ve true neu dk roi`
        $idsv=Auth::user()->getAuthIdentifier();
        $dk = new DangKy;
        $result=$dk->where('sv_ma','=',$idsv)
        ->where('sv_ma','=',$idsv)
        ->where('kq','=',1)
        ->first();
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }
    public function get_thongtin_dangky($madetai){ // tra ve cac SV dang ky de` tai` $
        $dk= new DangKy();
        $result = $dk->join('SinhVien','SinhVien.sv_ma','=','DangKy.sv_ma')
        ->where('DangKy.dt_ma','=',$madetai)
        //->select( 'SinhVien.sv_ten','SinhVien.sv_ma')
        //->lists('SinhVien.sv_ma')->all(); 
        ->get();
        return $result;
    }
    
    public static function duyetsv($masv){
        $dk = new DangKy();
        $result=$dk->where('sv_ma', $masv)->
        update(['kq' => 1]);
        return $result;
    }
    public static function tuchoi_sv($masv){ //xoa trong bang DK
        $dk = new DangKy();
        $result=$dk->where('sv_ma', $masv)->
        delete();
        return $result;
    }
    public function get_thongtindetai($mssv){   //lay thong tin de tai cua sinh vien , co thong tin GV
        $dk = new DangKy();
        $result= $dk->join('DeTai','DangKy.dt_ma','=','DeTai.dt_ma')
        ->join('ChuNhiem','ChuNhiem.dt_ma','=','DeTai.dt_ma')
        ->join('GiangVien','GiangVien.gv_ma','=','ChuNhiem.gv_ma')
        ->where('sv_ma','=',$mssv)->first();
        return $result;
    }
    public static function get_detai_dexuat($mssv){ // lay thong tin de tai de xuat, chua biet GV
        $dk = new DangKy();
        $result= $dk->join('DeTai','DangKy.dt_ma','=','DeTai.dt_ma')
        ->join('SinhVien','SinhVien.sv_ma','=','DangKy.sv_ma')
        ->where('DangKy.sv_ma','=',$mssv)
        ->where('DeTai.svdexuat','=',$mssv)
        ->where('DangKy.kq','=',0) //new
        ->first();
        return $result;
    }
}
?>