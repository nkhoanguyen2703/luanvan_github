<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChuNhiem extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "ChuNhiem";
    protected $primaryKey = 'cn_id';
    public $timestamps = false;
    protected $fillable = [
        'gv_ma','dt_ma',
    ];

}
