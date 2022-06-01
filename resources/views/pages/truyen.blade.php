 @extends('layout.index')
 	@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->
                <!-- Title -->           
                <h1 style="text-align:center; ">{{$truyen->tentruyen}}</h1>
 
                <!-- Preview Image -->
                <div class="col-md-12">

                    <div class="col-md-3">
                         <img class="img-responsive" src="anh_truyen/{{$truyen->hinhanh}}" alt="">
                    </div>
                      <br>

                    <div class="col-md-9">

                        <p >
                            <strong>Ngày đăng: <span class="glyphicon glyphicon-time"></span> </strong>{{$truyen->created_at}}
                        </p>
                        <p >
                        	<strong>Tác giả: </strong>{{$truyen->tacgia}}
                        </p>
                        <p>
                            <strong>Thể loại: </strong>{{$truyen->theloai->ten}}
                        </p>
                        <p>
                            <strong>Người đăng: </strong>{{$truyen->user->name}}
                        </p>
                        <hr>
                        <p class="lead">
                            <strong>Tóm tắt: </strong>{!! $truyen->gioithieu !!}
                        </p>
                     </div>

                </div>

                 <h3>Danh sách chương</h3>
                <!-- Blog Comments -->
                @foreach($truyen->chuongtruyen->sortBy('chuongso') as $ct)
                <!-- Comment -->
                <div class="media">
                    <div class="media-body">
                       <a href="chuong/{{$ct->id}}.html">Chương {{$ct->chuongso}}: {!!$ct->tenchuong!!}</a>
                    </div>
                </div>
                @endforeach
                <!-- Comments Form -->
                @if(Auth::check())
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
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$truyen->id}}" method="POST" role="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
                <hr>
                @endif

                <!-- Posted Comments -->
                @foreach($truyen->comment as $cm)
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" width="50px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeqsC2obCfDygvaz05GKvo2jI3fiiMTOazMrQI8hAao7OresU7Kw&s" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        </h4>
                        {{$cm->noidung}}
                    </div>
                </div>
                @endforeach


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>truyện cùng thể loại</b></div>
                    <div class="panel-body">
                    	@foreach($truyenlienquan as $tlq)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="truyen/{{$tlq->id}}.html">
                                    <img class="img-responsive" src="anh_truyen/{{$tlq->hinhanh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tlq->tentruyen}}</b></a>
                            </div>
                            <p style="padding-left:5px;">{{$tlq->gioithieu}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
        
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>truyện mới</b></div>
                    <div class="panel-body">
						@foreach($truyenmoi as $tt)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="truyen/{{$tt->id}}.html">
                                    <img class="img-responsive" src="anh_truyen/{{$tt->hinhanh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="#"><b>{{$tt->tentruyen}}</b></a>
                            </div>
                            <p style="padding-left:5px;">{{$tt->gioithieu}}</p>
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
    @endsection