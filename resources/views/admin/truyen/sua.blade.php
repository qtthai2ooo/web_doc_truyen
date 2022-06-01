@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Truyện
                            <small>{{$truyen->tentruyen}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                    {{$err}}<br>

                                    @endforeach
                                </div>
                            @endif

                            @if(session('thongbao'))
                                <div class="alert alert-success">
                                {{session('thongbao')}}
                                </div>
                            @endif
                        <form action="truyen/sua/{{$truyen->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach($theloai as $tl)
                                        <option
                                        @if($truyen->id_theloai == $tl->id)
                                               {{"selected"}}
                                         @endif
                                        value="{{$tl->id}}">
                                        {{$tl->ten}} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên truyện</label>
                                <input class="form-control" name="tentruyen" value="{{$truyen->tentruyen}}" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <input class="form-control" name="tacgia" value="{{$truyen->tacgia}}" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <textarea class="form-control ckeditor " name="gioithieu" id="Demo" rows="3">{{$truyen->gioithieu}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <img width="100px" src="anh_truyen/{{$truyen->hinhanh}}"><br> <br>
                                <input class="form-control" type="file" name="Hinh" />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->

                 <div class="row">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                        {{session('thongbao')}}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh sách chương
                            <small><a class="btn btn-default" href="truyen/themchuong/{{$truyen->id}}">Đăng chương mới</a></small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Chương số</th>
                                <th>Tên chương</th>
                                <th>Xoá</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($truyen->chuongtruyen as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->chuongso}}</td>
                                <td>{{$cm->tenchuong}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="truyen/xoachuong/{{$cm->id}}/{{$truyen->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="truyen/suachuong/{{$cm->id}}">Edit</a></td>
                            </tr>
                        @endforeach            
                        </tbody>
                    </table>

                </div>
                <!-- /.row -->
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
