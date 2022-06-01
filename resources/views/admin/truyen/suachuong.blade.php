@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chương
                            <small>{{$chuongtruyen->tenchuong}}</small>
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
                        <form action="truyen/suachuong/{{$chuongtruyen->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_truyen" value="{{$chuongtruyen->id_truyen}}">
                            <div class="form-group">
                                <label>Chương số</label>
                                <input class="form-control" name="chuongso" value="{{$chuongtruyen->chuongso}}" placeholder="Nhập số chương" />
                            </div>
                            <div class="form-group">
                                <label>Tên chương</label>
                                <input class="form-control" name="tenchuong" value="{{$chuongtruyen->tenchuong}}" placeholder="Nhập tên chương" />
                            </div>
                            <div class="form-group">
                                <label>Nôi dung</label>
                                <textarea class="form-control ckeditor " name="noidung" id="Demo" rows="3">{{$chuongtruyen->noidung}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
