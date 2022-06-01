 @extends('layout.index')
 	@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->


                <!-- Blog Post -->

                <!-- Title -->
                <a href="truyen/{{$chuongtruyen->truyen->id}}.html"><h1 style="text-align:center;">{{$chuongtruyen->truyen->tentruyen}}</h1></a>

                <!-- Author -->
                <p class="lead" style="text-align:center;">
                    chương {{$chuongtruyen->chuongso}}: {{$chuongtruyen->tenchuong}}
                </p>
                <div class="col-md-12" style="text-align:center";>
                @if($sotruoc == 'null')
                @else
                <a class="btn btn-primary" href="chuong/{{$sotruoc}}.html"><span class="glyphicon glyphicon-chevron-left"></span>Chương trước</a>
                @endif
                @if($sosau == 'null')
                @else
                <a class="btn btn-primary" href="chuong/{{$sosau}}.html">Chương sau <span class="glyphicon glyphicon-chevron-right"></span></a>
                @endif

                </div>

                <!-- Preview Image -->
                <div class="col-md-12">
                        <!-- Post Content -->
                        <p class="lead">
                        	{!! $chuongtruyen->noidung !!}
                        </p>
                </div>
            </div>
            <div class="col-md-12" style="text-align:center";>
            @if($sotruoc == 'null')
            @else
             <a class="btn btn-primary" href="chuong/{{$sotruoc}}.html"><span class="glyphicon glyphicon-chevron-left"></span>Chương trước</a>
            @endif
            @if($sosau == 'null')
            @else
              <a class="btn btn-primary" href="chuong/{{$sosau}}.html">Chương sau <span class="glyphicon glyphicon-chevron-right"></span></a>
            @endif

            </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
    @endsection