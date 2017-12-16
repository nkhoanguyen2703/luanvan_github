<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Foundation\Auth\SinhVien as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // set time
use Auth;
use DB;
class ChamDiem extends Model
{

    protected $table = "ChamDiem";
    protected $primaryKey = 'cd_id';
    public $timestamps = true; //tat che do quan li Create at, update at
    protected $fillable = [
         'cd_id','gv_ma','lv_ma','diem','nhanxet','created_at','upadated_at'
    ];

    public function laydiemcu($lvma){ //Lấy điểm mà GV đã chấm trước đó để hiện ra, mục đích điều chỉnh
    	$magv=Auth::guard('giangvien')->user()->getAuthIdentifier();
    	$chamdiem= new ChamDiem();
    	$result= $chamdiem->select('diem')
    	->where('gv_ma','=',$magv)
    	->where('lv_ma','=',$lvma)
    	->orderBy('cd_id','desc')
    	->first('diem');
    	
    	return $result;


    }
    public static function thongke(){
        $idsv=Auth::user()->getAuthIdentifier();
        $result = ChamDiem::join('GiangVien','GiangVien.gv_ma','=','ChamDiem.gv_ma')
        ->join('QuyenLV','QuyenLV.lv_ma','=','ChamDiem.lv_ma')
        ->join('SinhVien','SinhVien.sv_ma','=','QuyenLV.sv_ma')
        ->where('SinhVien.sv_ma','=',$idsv)
        ->orderBy('ChamDiem.created_at')
        ->get();
        return $result;
    }
    public static function thongkelai(){
         $idsv=Auth::user()->getAuthIdentifier();
        // $result = DB::table('ChamDiem')
        // ->select(DB::raw('max(cd_id) as id'))
        // ->groupBy('gv_ma')
        // ->get();

        // $res = DB::table('ChamDiem')
        // ->where('cd_id','IN',$result)
        // ->get();
        // return $res;
       $result = DB::table('ChamDiem')
            ->join('GiangVien','GiangVien.gv_ma','=','ChamDiem.gv_ma')
            ->join('QuyenLV','QuyenLV.lv_ma','=','ChamDiem.lv_ma')
            ->join('SinhVien','SinhVien.sv_ma','=','QuyenLV.sv_ma')
            ->select('*')
            
            ->whereIn('cd_id',function ($query){
                $query->select(DB::raw('max(cd_id)'))
                ->from('ChamDiem')
                ->groupBy('gv_ma');
            })
            ->where('SinhVien.sv_ma','=',$idsv)
            ->get();
            return $result;
        
    }
    public static function tinh_so_nguoi_cham(){ 
         $idsv=Auth::user()->getAuthIdentifier();
        
       $result = DB::table('ChamDiem')
            ->join('GiangVien','GiangVien.gv_ma','=','ChamDiem.gv_ma')
            ->join('QuyenLV','QuyenLV.lv_ma','=','ChamDiem.lv_ma')
            ->join('SinhVien','SinhVien.sv_ma','=','QuyenLV.sv_ma')
            ->select('*')
            
            ->whereIn('cd_id',function ($query){
                $query->select(DB::raw('max(cd_id)'))
                ->from('ChamDiem')
                ->groupBy('gv_ma');
            })
            ->where('SinhVien.sv_ma','=',$idsv)
            ->count();
            return $result;
        
    }
    public static function tinh_tong_so_diem(){ 
         $idsv=Auth::user()->getAuthIdentifier();
        
       $result = DB::table('ChamDiem')
            ->join('GiangVien','GiangVien.gv_ma','=','ChamDiem.gv_ma')
            ->join('QuyenLV','QuyenLV.lv_ma','=','ChamDiem.lv_ma')
            ->join('SinhVien','SinhVien.sv_ma','=','QuyenLV.sv_ma')
            ->select('*')
            
            ->whereIn('cd_id',function ($query){
                $query->select(DB::raw('max(cd_id)'))
                ->from('ChamDiem')
                ->groupBy('gv_ma');
            })
            ->where('SinhVien.sv_ma','=',$idsv)
            ->sum('ChamDiem.diem');
            return $result;
        
    }

    public static function trungbinh(){
        $idsv=Auth::user()->getAuthIdentifier();

        $tongdiem = DB::table('ChamDiem') //tinh tong so diem
            ->join('GiangVien','GiangVien.gv_ma','=','ChamDiem.gv_ma')
            ->join('QuyenLV','QuyenLV.lv_ma','=','ChamDiem.lv_ma')
            ->join('SinhVien','SinhVien.sv_ma','=','QuyenLV.sv_ma')
            ->select('*')
            
            ->whereIn('cd_id',function ($query){
                $query->select(DB::raw('max(cd_id)'))
                ->from('ChamDiem')
                ->groupBy('gv_ma');
            })
            ->where('SinhVien.sv_ma','=',$idsv)
            ->sum('ChamDiem.diem');
        
        $songuoi = DB::table('ChamDiem') //tinh tong so nguoi cham', 1 nguoi cham 2 lan thi` tinh' 1 nguoi
            ->join('GiangVien','GiangVien.gv_ma','=','ChamDiem.gv_ma')
            ->join('QuyenLV','QuyenLV.lv_ma','=','ChamDiem.lv_ma')
            ->join('SinhVien','SinhVien.sv_ma','=','QuyenLV.sv_ma')
            ->select('*')
            
            ->whereIn('cd_id',function ($query){
                $query->select(DB::raw('max(cd_id)'))
                ->from('ChamDiem')
                ->groupBy('gv_ma');
            })
            ->where('SinhVien.sv_ma','=',$idsv)
            ->count();

        if($songuoi>0)
        return $tongdiem/$songuoi; //trung binh cong
        else return 'Chưa có điểm';
    }

    public static function doi_diem_thanh_chu($diemso){
        
        if($diemso>=9){
            $kq='A';
        }else if($diemso>=8){
            $kq='B+';
        }else if($diemso>=7){
            $kq='B';
        }else if($diemso>=6.5){
            $kq='C+';
        }else if($diemso>=5.5){
            $kq='C';
        }else if($diemso>=5){
            $kq='D+';
        }else if($diemso>=4){
            $kq='D';
        }else if($diemso>=0.1){
            $kq='KHÔNG ĐẠT';
        }else{
            $kq='Chưa có kết quả';
        }

        return $kq;
    }

}

?>







