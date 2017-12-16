<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoMon extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "BoMon";
    protected $primaryKey = 'bm_ma';
    public $timestamps = false;
    protected $fillable = [
        'bm_ten',
    ];
    public function get_bm_ma() {
        return $this->attributes['bm_ma'];
    }
    public static function get_bomon(){
    	$result=BoMon::get();
    	return $result;
    }

}
