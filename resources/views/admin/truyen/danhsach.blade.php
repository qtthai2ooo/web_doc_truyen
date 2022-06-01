@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                        {{session('thongbao')}}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <h1 class="page-header">Truyện
                            <small>Danh sách {{count($truyen)}}</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên truyện </th>
                                <th>Hình ảnh </th>
                                <th>Giới thiệu</th>
                                <th>Sửa  </th>
                              
                                <th>Tác giả</th>
                                <th>Xoá</th>
                                  <th>Thể loại</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($truyen as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td>{{$tt->tentruyen}}</td>
                                <td><img width="100px" src="anh_truyen/{{$tt->hinhanh}}"></td>
                                <td>{{$tt->gioithieu}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="truyen/sua/{{$tt->id}}">Sửa</a></td>
                                <td>{{$tt->tacgia}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="truyen/xoa/{{$tt->id}}"> Xoá</a></td>
                                
                                <td>{{$tt->theloai->ten}}</td>
                            </tr>
                        @endforeach            
                        </tbody>
                    </table>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection