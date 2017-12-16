<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon; // set time
//use Illuminate\Foundation\Auth\SinhVien as Authenticatable;
class GiangVien extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "GiangVien";
    protected $primaryKey = 'gv_ma';

    protected $fillable = [
        'gv_ma', 'password', 'gv_ten','bm_ma',
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

    public function get_tenGV(){
        return $this->gv_ten;
    }
    public function get_bomon(){
        return $this->bm_ma;
    }
    public function getAuthIdentifier() {
        return $this->attributes['gv_ma'];
    }
    public static function get_hocky_hientai(){
        $current = Carbon::now()->month;
        if($current<=5){
            return 2;
        }else if($current<=8){
            return 3;
        }else return 1;

    }
    public static function get_namhoc_hientai(){
        $current = Carbon::now()->year;
        $sau = $current+1;
        $truoc= $current -1;
        $hk = Giangvien::get_hocky_hientai();
        if($hk==1){
            $namhoc=$current."-".$sau;
        }else{
            $namhoc=$truoc."-".$current;
        }

        return $namhoc;

    }
    //public $incrementing = false;
}
