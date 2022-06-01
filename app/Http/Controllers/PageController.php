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
        'password.required'=>'Bạn chưa nhập mật khẩu',
        'email.required'=>'Bạn chưa nhập email',
        ]);
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect('trangchu');
            }
            else{
               return redirect('dangnhap')->with('thongbao','Đăng nhập thất bại');
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
        'name.required'=>'Bạn chưa nhập tên',
        ]);
     $user = Auth::user();
     $user->name = $request->name;
     if($request->password != null){
        $this->validate($request,
        [
        'passwordAgain' => 'required|same:password'
        ],
        [
        'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp',
        ]);
     $user->password = bcrypt($request->password);
    }
     $user->save();

    return redirect('nguoidung')->with('thongbao','Sưa thành công');
     
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
        'name.required'=>'Bạn chưa nhập tên',
        'email.required'=>'Bạn chưa nhập email',
        'email.email'=>'sai định dạng email',
        'email.unique'=>'Email đã tồn tại',
        'password.required'=>'Bạn chưa nhập mật khẩu',
        'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
        'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp',
        'email.required'=>'Bạn chưa nhập nội dung',
        ]);
     $user = new User;
     $user->name = $request->name;
     $user->email = $request->email;
     $user->password = bcrypt($request->password);
     $user->save();

    return redirect('dangky')->with('thongbao','Đăng ký thành công');
     
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
        'NoiDung.required'=>'Bạn chưa nhập bình luận',
        ]);
     $idtruyen = $id;  
     $truyen = truyen::find($id); 
     $comment = new comment;
     $comment->id_truyen  = $idtruyen;
     $comment->id_user = Auth::user()->id;
     $comment->noidung = $request->NoiDung;
     $comment->save();
        
        return redirect('truyen/'.$id.'.html')->with('thongbao','bình luận thành công');
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
    	return redirect('truyen/danhsach')->with('thongbao','Xoá thành công');
    }
     public function postThem(Request $request){
     	$this->validate($request,
     	[
    	'tentruyen' => 'required|unique:truyen,tentruyen',
        'tacgia' => 'required',
        'gioithieu' => 'required',
    	],
    	[
    	'tentruyen.unique'=>'Tiêu đề đã tồn tại',
        'tentruyen.required'=>'Bạn chưa nhập tên truyện',
        'tacgia.required'=>'Bạn chưa nhập tác giả',
        'gioithieu.required'=>'Bạn chưa nhập tóm tắt',
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

    return redirect('truyen/them')->with('thongbao','Thêm thành công');
     
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
        'tentruyen.required'=>'Bạn chưa nhập tên truyện',
        'tacgia.required'=>'Bạn chưa nhập tác giả',
        'gioithieu.required'=>'Bạn chưa nhập tóm tắt',
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

     return redirect('truyen/sua/'.$id)->with('thongbao','Sửa thành công');
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

    	return redirect('truyen/sua/'.$idtruyen)->with('thongbao','Xoá thành công');
    }
     public function postThemchuong(Request $request){
     	$this->validate($request,
     	[
    	'chuongso' => 'required',
        'tenchuong' => 'required',
        'noidung' => 'required',
    	],
    	[
        'chuongso.required'=>'Bạn chưa nhập số chương',
        'tenchuong.required'=>'Bạn chưa nhập tên chương',
        'noidung.required'=>'Bạn chưa nhập noidung',
    	]);
     $chuongtruyen = new chuongtruyen;
     $id = $request->id_truyen;
     $chuongtruyen->chuongso = $request->chuongso;
     $chuongtruyen->id_truyen = $id;
     $chuongtruyen->tenchuong = $request->tenchuong;
     $chuongtruyen->noidung = $request->noidung;
    $chuongtruyen->save();

    return redirect('truyen/sua/'.$id)->with('thongbao','Thêm thành công');
     
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
    	'chuongso.required'=>'Bạn chưa nhập số chương',
        'tenchuong.required'=>'Bạn chưa nhập tên chương',
        'noidung.required'=>'Bạn chưa nhập noidung',
    	]);
     $id = $request->id_truyen;
     $chuongtruyen->chuongso = $request->chuongso;
     $chuongtruyen->tenchuong = $request->tenchuong;
     $chuongtruyen->noidung = $request->noidung;
    $chuongtruyen->save();

     return redirect('truyen/sua/'.$id)->with('thongbao','Sửa thành công');
    }


}

