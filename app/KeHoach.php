<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Foundation\Auth\SinhVien as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // set time
use App\GiangVien;
class KeHoach extends Model
{

    protected $table = "KeHoachLuanVan";
    protected $primaryKey = 'kh_id';
    public $timestamps = false; //tat che do quan li Create at, update at
    protected $fillable = [
         'kh_ten', 'kh_ngayrade','kh_hanrade','kh_ngaydangky','kh_handangky','MaNamHoc','MaHocKy'
    ];

    public static function get_kehoach_now(){
        $hocky = GiangVien::get_hocky_hientai();
        $namhoc=GiangVien::get_namhoc_hientai();
        $kh=new KeHoach();
        $result=$kh->where('MaNamHoc','=',$namhoc)
        ->where('MaHocKy','=',$hocky)
        ->get();
        return $result;
    }

    public function kiemtraTime($idkh){
        $current = Carbon::now();
        $kehoach= new KeHoach();
        $result=$kehoach->where('kh_id', $idkh)->where('kh_ngayrade', '<=', $current)->where('kh_hanrade', '>=', $current)->first();
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }


    
    

}

?>







