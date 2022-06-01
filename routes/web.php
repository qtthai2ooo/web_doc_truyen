<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\theloai;
use App\truyen;
use App\comment;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('te', function () {
	$user = user::all();
	foreach ($user as $t) {
		echo $t->id.'<br>';
	}
});

	Route::group(['prefix'=>'truyen'],function(){
		Route::get('danhsach', 'PageController@getDanhSach');
		Route::get('sua/{id}', 'PageController@getSua');
		Route::get('them', 'PageController@getThem');
		Route::get('xoa/{id}', 'PageController@getXoa');

		Route::post('them', 'PageController@postThem');
		Route::post('sua/{id}', 'PageController@postSua');




		Route::get('suachuong/{id}', 'PageController@getSuachuong');
		Route::get('themchuong/{id}', 'PageController@getThemchuong');
		Route::get('xoachuong/{id}/{idtruyen}', 'PageController@getXoachuong');

		Route::post('themchuong', 'PageController@postThemchuong');
		Route::post('suachuong/{id}', 'PageController@postSuachuong');
		
	});
		Route::get('lienhe', 'PageController@lienhe');

		Route::get('trangchu', 'PageController@trangchu');
		Route::get('lienhe', 'PageController@lienhe');
		
		Route::get('theloai/{id}.html', 'PageController@theloai');
		
		Route::get('truyen/{id}.html', 'PageController@truyen');
		Route::get('chuong/{id}.html', 'PageController@chuong');

		Route::get('dangnhap', 'PageController@getDangnhap');
		Route::post('dangnhap', 'PageController@postDangnhap');

		Route::get('dangxuat', 'PageController@getDangxuat');

		Route::post('comment/{id}', 'PageController@postcomment');


		Route::get('nguoidung', 'PageController@getNguoidung');
		Route::post('nguoidung', 'PageController@postNguoidung');

		Route::get('dangky', 'PageController@getdangky');
		Route::post('dangky', 'PageController@postdangky');

		Route::post('timkiem', 'PageController@timkiem');

