<?php

namespace App;

// use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Foundation\Auth\SinhVien as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // set time
use Laravel\Scout\Searchable; // search tool
use Auth;
class QuyenLV extends Model
{

    protected $table = "QuyenLV";
    protected $primaryKey = 'lv_ma';
    public $timestamps = false; //tat che do quan li Create at, update at
    protected $fillable = [
         'lv_ma', 'lv_ten','sv_ma'
    ];


    use Searchable;
    public function searchableAs()
    {
        return 'lv_ma';
    }
    
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
    public static function nopluanvan_haychua(){ ///tra ve true neu roi`
        $idsv=Auth::user()->getAuthIdentifier();
        $lv = new QuyenLV();
        $result=$lv->where('sv_ma','=',$idsv)
        
        ->first();
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }
}

?>







