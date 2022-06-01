<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chuongtruyen extends Model
{
    protected $table = "chuongtruyen";

    public function truyen()
    {
    	return $this->belongsTo('App\truyen','id_truyen','id');
    }

    
}
