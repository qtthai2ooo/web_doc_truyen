            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                    	Menu
                    </li>


	                    <li href="" class="list-group-item menu1">
	                    	Thể loại truyện
	                    	
	                    </li>
	                    <ul>
	                    	@foreach($theloaimenu as $tl)
	                		<li class="list-group-item">
	                			<a href="theloai/{{$tl->id}}.html">{{$tl->ten}}</a>
	                		</li>
	                		@endforeach
	                    </ul>
	                 
                </ul>
            </div>