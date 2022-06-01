<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class truyen extends Model
{
    protected $table = "truyen";

    public function theloai()
    {
    	return $this->belongsTo('App\theloai', 'id_theloai','id');
    }
    public function chuongtruyen()
    {
    	return $this->hasMany('App\chuongtruyen', 'id_truyen','id');
    }
    public function comment()
    {
    	return $this->hasMany('App\comment','id_truyen','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
}
