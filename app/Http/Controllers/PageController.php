<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\chuongtruyen;
use App\comment;
use App\theloai;
use App\truyen;
use App\User;

class PageController extends Controller
{
	function __construct(){
    	$theloai = theloai::all();
    	$theloaimenu = theloai::all();
    	view()->share('theloai',$theloai);
    	view()->share('theloaimenu',$theloaimenu);
        if(Auth::check()){
            view()->share('nguoidung',Auth::user()); 
        }
    }
    function trangchu(){

        $truyenmoi = truyen::where('id','>',0)->paginate(6); 
    	return view('pages.trangchu',['truyenmoi'=>$truyenmoi]);
    }
    function lienhe(){
    	$theloai = theloai::all();
    	return view('pages.lienhe',['theloai'=>$theloai]);
    }
      function theloai($id){
    	$theloai = theloai::find($id);
    	$truyen = truyen::where('id_theloai',$id)->paginate(5); 
    	return view('pages.theloai',['theloai'=>$theloai,'truyen'=>$truyen]);
    }
       function truyen($id){
    	$truyen = truyen::find($id);
    	$truyenlienquan = truyen::where('id_theloai',$truyen->id_theloai)->take(4)->get(); 
    	$truyenmoi = truyen::all();
    	$truyenmoi = $truyenmoi->sortBy('created_at')->take(4);
    	return view('pages.truyen',['truyen'=>$truyen,'truyenlienquan'=>$truyenlienquan,'truyenmoi'=>$truyenmoi]);
    }
     function chuong($id){
    	$chuongtruyen = chuongtruyen::find($id);
    	$id_truyen = $chuongtruyen->id_truyen;
    	$chuongtruoc = $chuongtruyen->chuongso-1;
    	$chuongsau = $chuongtruyen->chuongso+1;
    	$sochuongsau = chuongtruyen::where([['id_truyen','=',$id_truyen],
    										['chuongso','=',$chuongsau]])->get();
    	$sochuongtruoc = chuongtruyen::where([['id_truyen','=',$id_truyen],
    										['chuongso','=',$chuongtruoc]])->get(); 
    	if($sochuongsau->count() > 0)
    	{foreach ($sochuongsau as $sau) {$sosau = $sau->id;}}
    	else{ $sosau = 'null';}

    	if($sochuongtruoc->count() > 0)
    	{foreach ($sochuongtruoc as $truoc) {$sotruoc = $truoc->id;}}
    	else{ $sotruoc = 'null';}



    	return view('pages.chuong',['chuongtruyen'=>$chuongtruyen,'sosau'=>$sosau,'sotruoc'=>$sotruoc]);
    }
 	  function getDangnhap(){
    	return view('pages.dangnhap');
    }
     function postDangnhap(Request $request){
    	       $this->validate($request,
        [
        'email' => 'required',
        'password' => 'required',
        ],
        [
        'password.required'=>'B???n ch??a nh???p m???t kh???u',
        'email.required'=>'B???n ch??a nh???p email',
        ]);
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect('trangchu');
            }
            else{
               return redirect('dangnhap')->with('thongbao','????ng nh???p th???t b???i');
            }
        
    }
    function getDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }

     public function getNguoidung(){
        Auth::user();
        return view('pages.nguoidung',['nguoidung'=>Auth::user()]);
    }
     public function postNguoidung(Request $request){
        $this->validate($request,
        [
        'name' => 'required',
        ],
        [
        'name.required'=>'B???n ch??a nh???p t??n',
        ]);
     $user = Auth::user();
     $user->name = $request->name;
     if($request->password != null){
        $this->validate($request,
        [
        'passwordAgain' => 'required|same:password'
        ],
        [
        'passwordAgain.same'=>'M???t kh???u nh???p l???i ch??a kh???p',
        ]);
     $user->password = bcrypt($request->password);
    }
     $user->save();

    return redirect('nguoidung')->with('thongbao','S??a th??nh c??ng');
     
    }


     public function getdangky(){
        return view('pages.dangky');
    }
      public function postdangky(Request $request){
        $this->validate($request,
        [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'passwordAgain' => 'required|same:password'
        ],
        [
        'name.required'=>'B???n ch??a nh???p t??n',
        'email.required'=>'B???n ch??a nh???p email',
        'email.email'=>'sai ?????nh d???ng email',
        'email.unique'=>'Email ???? t???n t???i',
        'password.required'=>'B???n ch??a nh???p m???t kh???u',
        'passwordAgain.required'=>'B???n ch??a nh???p l???i m???t kh???u',
        'passwordAgain.same'=>'M???t kh???u nh???p l???i ch??a kh???p',
        'email.required'=>'B???n ch??a nh???p n???i dung',
        ]);
     $user = new User;
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = bcrypt($request->password);
     $user->save();

    return redirect('dangky')->with('thongbao','????ng k?? th??nh c??ng');
     
    }

   function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $truyen = truyen::where('tentruyen','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['truyen'=>$truyen,'tukhoa'=>$tukhoa]);
    }
    function postcomment($id,Request $request){
               $this->validate($request,
        [
        'NoiDung' => 'required',
        ],
        [
        'NoiDung.required'=>'B???n ch??a nh???p b??nh lu???n',
        ]);
     $idtruyen = $id;  
     $truyen = truyen::find($id); 
     $comment = new comment;
     $comment->id_truyen  = $idtruyen;
     $comment->id_user = Auth::user()->id;
     $comment->noidung = $request->NoiDung;
     $comment->save();
        
        return redirect('truyen/'.$id.'.html')->with('thongbao','b??nh lu???n th??nh c??ng');
    }
















    public function getDanhSach(){
    	$tim = Auth::user()->id;
    	$truyen = truyen::where('id_user','like',$tim)->get();
    	return view('admin.truyen.danhsach',['truyen'=>$truyen]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
    	return view('admin.truyen.them',['theloai'=>$theloai]);
    }
    public function getSua($id){
        $theloai = theloai::all();
    	$truyen = truyen::find($id);
    	return view('admin.truyen.sua',['truyen'=>$truyen,'theloai'=>$theloai]);
    }
    public function getXoa($id){
    	$truyen = truyen::find($id);
    	$truyen->delete();
    	return redirect('truyen/danhsach')->with('thongbao','Xo?? th??nh c??ng');
    }
     public function postThem(Request $request){
     	$this->validate($request,
     	[
    	'tentruyen' => 'required|unique:truyen,tentruyen',
        'tacgia' => 'required',
        'gioithieu' => 'required',
    	],
    	[
    	'tentruyen.unique'=>'Ti??u ????? ???? t???n t???i',
        'tentruyen.required'=>'B???n ch??a nh???p t??n truy???n',
        'tacgia.required'=>'B???n ch??a nh???p t??c gi???',
        'gioithieu.required'=>'B???n ch??a nh???p t??m t???t',
    	]);
     $truyen = new truyen;
     $truyen->tentruyen = $request->tentruyen;
     $truyen->id_theloai = $request->theloai;
     $truyen->tacgia = $request->tacgia;
     $truyen->gioithieu = $request->gioithieu;
     $truyen->id_user = Auth::user()->id;
        $i = 0;
     if($request->hasFile('Hinh')){
        $file = $request->file('Hinh');
        $name = $file->getClientOriginalName(); 
        $Hinh = $i."_".$name;
        while (file_exists("anh_truyen/".$Hinh)) {
           $i++;
           $Hinh = $i."_".$name;
        }
        $file->move("anh_truyen",$Hinh);
        $truyen->hinhanh = $Hinh;

     }
     else{
        $truyen->Hinh = "";
     }
    $truyen->save();

    return redirect('truyen/them')->with('thongbao','Th??m th??nh c??ng');
     
    }

    public function postSua(Request $request,$id){
    	$truyen = truyen::find($id);
    	$this->validate($request,
        [
        'tentruyen' => 'required',
        'tacgia' => 'required',
        'gioithieu' => 'required',
        ],
        [
        'tentruyen.required'=>'B???n ch??a nh???p t??n truy???n',
        'tacgia.required'=>'B???n ch??a nh???p t??c gi???',
        'gioithieu.required'=>'B???n ch??a nh???p t??m t???t',
        ]);
     $truyen->tentruyen = $request->tentruyen;
     $truyen->tacgia = $request->tacgia;
     $truyen->gioithieu = $request->gioithieu;
     $truyen->id_theloai = $request->theloai;
        $i = 0;
     if($request->hasFile('Hinh')){
        $file = $request->file('Hinh');
        $name = $file->getClientOriginalName(); 
        $Hinh = $i."_".$name;
        while (file_exists("anh_truyen/".$Hinh)) {
           $i++;
           $Hinh = $i."_".$name;
        }
        $file->move("anh_truyen",$Hinh);
        unlink("anh_truyen/".$truyen->hinhanh);
        $truyen->hinhanh = $Hinh;

     }
    $truyen->save();

     return redirect('truyen/sua/'.$id)->with('thongbao','S???a th??nh c??ng');
    }










    public function getThemchuong($id){
    	$truyen = truyen::find($id);
    	return view('admin.truyen.themchuong',['truyen'=>$truyen]);
    }
    public function getSuachuong($id){
    	$chuongtruyen = chuongtruyen::find($id);
    	return view('admin.truyen.suachuong',['chuongtruyen'=>$chuongtruyen]);
    }
    public function getXoachuong($id,$idtruyen){
    	$chuongtruyen = chuongtruyen::find($id);
    	$chuongtruyen->delete();

    	return redirect('truyen/sua/'.$idtruyen)->with('thongbao','Xo?? th??nh c??ng');
    }
     public function postThemchuong(Request $request){
     	$this->validate($request,
     	[
    	'chuongso' => 'required',
        'tenchuong' => 'required',
        'noidung' => 'required',
    	],
    	[
        'chuongso.required'=>'B???n ch??a nh???p s??? ch????ng',
        'tenchuong.required'=>'B???n ch??a nh???p t??n ch????ng',
        'noidung.required'=>'B???n ch??a nh???p noidung',
    	]);
     $chuongtruyen = new chuongtruyen;
     $id = $request->id_truyen;
     $chuongtruyen->chuongso = $request->chuongso;
     $chuongtruyen->id_truyen = $id;
     $chuongtruyen->tenchuong = $request->tenchuong;
     $chuongtruyen->noidung = $request->noidung;
    $chuongtruyen->save();

    return redirect('truyen/sua/'.$id)->with('thongbao','Th??m th??nh c??ng');
     
    }

  public function postSuachuong(Request $request,$id){
    	$chuongtruyen = chuongtruyen::find($id);
    	$this->validate($request,
     	[
     	'chuongso' => 'required',
        'tenchuong' => 'required',
        'noidung' => 'required',
    	],
    	[
    	'chuongso.required'=>'B???n ch??a nh???p s??? ch????ng',
        'tenchuong.required'=>'B???n ch??a nh???p t??n ch????ng',
        'noidung.required'=>'B???n ch??a nh???p noidung',
    	]);
     $id = $request->id_truyen;
     $chuongtruyen->chuongso = $request->chuongso;
     $chuongtruyen->tenchuong = $request->tenchuong;
     $chuongtruyen->noidung = $request->noidung;
    $chuongtruyen->save();

     return redirect('truyen/sua/'.$id)->with('thongbao','S???a th??nh c??ng');
    }


}

