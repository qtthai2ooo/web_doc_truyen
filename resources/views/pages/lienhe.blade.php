@extends('layout.index')  
	@section('content')
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>Ký túc xá cao đẳng công nghệ thông tin </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>qtthai.18it1@sict.udn.vn</p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>0913xxxx</p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10642.165790980654!2d108.25051650191749!3d15.975939499194949!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb466fcf06b910a38!2zS2hvYSBDw7RuZyBuZ2jhu4cgdGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIC0gxJDhuqFpIGjhu41jIMSQw6AgTuG6tW5n!5e0!3m2!1svi!2s!4v1575123809836!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
	@endsection('content')