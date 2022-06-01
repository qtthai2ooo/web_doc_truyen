@extends('layout.index')
@section('content')

    <div class="container">
        @include('layout.slide')
        <div class="row">
          @include('layout.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$theloai->ten}}</b></h4>
                    </div>
                    @foreach($truyen as $tt)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="anh_truyen/{{$tt->hinhanh}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{{$tt->tentruyen}}</h3>
                            <p>{{$tt->gioithieu}}</p>
                            <a class="btn btn-primary" href="truyen/{{$tt->id}}.html">Đọc truyện<span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- Pagination -->
                    <div style="text-align:center; ">
                    	{{$truyen->links()}}
                    </div>
                    
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>

@endsection