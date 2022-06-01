 @extends('layout.index')  
 @section('content')
    <div class="container">


    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
        	@include('layout.menu');

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">truyện mới</h2>
	            	</div>
  							@foreach($truyenmoi->sortBy('created_at') as $tt)
                            
                    <div class="">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="anh_truyen/{{$tt->hinhanh}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-12">
                            <h3>{{$tt->tentruyen}}</h3>
                            <p>{{$tt->gioithieu}}</p>
                            <a class="btn btn-primary" href="truyen/{{$tt->id}}.html">Xem thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                </div>
                    @endforeach
                       <div style="text-align:center; ">
                        {{$truyenmoi->links()}}
                    </div>
	            	<div class="panel-body">

                    </div>

		                <!-- end item -->
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
 @endsection