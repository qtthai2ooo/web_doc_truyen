<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class theloai extends Model
{
      protected $table = "theloai";

      public function truyen()
    {
    	return $this ->hasMany('App\truyen','id_theloai','id');
    }
    public function chuongtruyen()
    {
    	return $this ->hasManyThrough('App\chuongtruyen','App\truyen','id_theloai','id_truyen','id');
    }
}
