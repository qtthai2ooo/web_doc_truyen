@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Truyện
                            <small>Đăng truyện</small>
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
                        <form action="truyen/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="theloai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên truyện</label>
                                <input class="form-control" name="tentruyen" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tên tác giả</label>
                                <input class="form-control" name="tacgia" placeholder="Nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <textarea class="form-control ckeditor " name="gioithieu" id="Demo" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input class="form-control" type="file" name="Hinh" />
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
