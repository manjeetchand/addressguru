<?php 
	use App\Coaching;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 newbanner">
			<div class="w3-content w3-section">
			@foreach($banner as $ban)
			<?php 
				$cato = json_decode($ban->category);
			?>
				@foreach($cato as $cateo)
				<?php 
					$arr = array($cateo);
				?>
					@if(in_array($category_id, $arr))

						<a href="<?php $banpost = Coaching::find($ban->coaching_id);  ?>{{url('/', $banpost->slug)}}"><img src="/images/{{$ban->image}}" class="img-responsive mySlides" alt="{{$ban->name}}"></a>

					@endif

				@endforeach
				
			@endforeach
			</div>

		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-2 search-padding">
			<div class="filter-stop">
			<div class="filter-search-top">
				Search Filters <i class="fa fa-filter"></i>
			</div>
			<div class="visible-xs visible-sm">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
					<ul class="nav navbar-nav newbar">
						<li class="dropdown newli">
					      	<a class="dropdown-toggle lia" data-toggle="dropdown" href="#"><i class="fa fa-trophy" style="background-color:#D094D9;color:#fff;"></i><br/><span>Top Results</span></a>
					      	<ul class="dropdown-menu">
					      		{!! Form::open(['action'=>'Search@store']) !!}
					      		<li><input type="radio" name="top" value="5" onclick="this.form.submit()"> <span> Top 5 {{$cat->name}} in {{$city}}</span></li>
								<li><input type="radio" name="top" value="10" onclick="this.form.submit()"> <span> Top 10 {{$cat->name}} in {{$city}}</span></li>
								<li><input type="radio" name="top" value="15" onclick="this.form.submit()"> <span> Top 15 {{$cat->name}} in {{$city}}</span></li>
								<li><input type="radio" name="top" value="20" onclick="this.form.submit()"> <span> Top 20 {{$cat->name}} in {{$city}}</span></li>
								<input type="hidden" name="category" value="{{$category_id}}">
								<input type="hidden" name="city" value="{{$city}}">
								{!! Form::close() !!}
					      	</ul>
					    </li>
						<li class="dropdown newli">
					      	<a class="dropdown-toggle lia" data-toggle="dropdown" href="#"><i class="fa fa-map-marker red"></i><br/><span>Locality</span></a>
					      	<ul class="dropdown-menu">
					      		{!! Form::open(['action'=>'Search@store']) !!}
					      			@foreach($contacts as $per)
										@if($per->location != "")
					        				<li><input type="radio" name="local" value="{{$per->location}}" onclick="this.form.submit()" required="required">  {{$per->location}}<br/></li>
					        			@endif
									@endforeach
									<input type="hidden" name="category" value="{{$category_id}}">
									<input type="hidden" name="city" value="{{$city}}">
					        	{!! Form::close() !!}
					      	</ul>
					    </li>
					    <li class="dropdown newli">
					      	<a class="dropdown-toggle lia" data-toggle="dropdown" href="#"><i class="fa fa-building-o blue"></i><br/><span>City</span></a>
					      	<ul class="dropdown-menu">
					      		{!! Form::open(['action'=>'Search@store']) !!}
								@foreach($unique as $news)

									<li><input type="radio" name="city" value="{{$news}}" onclick="this.form.submit()" required="required"> {{$news}}</li>

								@endforeach
									<input type="hidden" name="path" value="{{$category_id}}">

								{!! Form::close() !!}
					      	</ul>
					    </li>
					    
					    
					</ul>
					</div>
				</nav> 
			</div>
			<div class="hidden-xs hidden-sm">
				<div class="filter-search-top-head">
				&nbsp;<i class="fa fa-trophy"></i> Top Results
			</div>
			<div class="filter-search-middle">
				{!! Form::open(['action'=>'Search@store']) !!}
				<ul class="topul">
					<li><input type="radio" name="top" value="5" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 5 {{$cat->name}} in {{$city}}"> Top 5 {{$cat->name}}...</span></li>
					<li><input type="radio" name="top" value="10" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 10 {{$cat->name}} in {{$city}}"> Top 10 {{$cat->name}}...</span></li>
					<li><input type="radio" name="top" value="15" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 15 {{$cat->name}} in {{$city}}"> Top 15 {{$cat->name}}...</span></li>
					<li><input type="radio" name="top" value="20" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 20 {{$cat->name}} in {{$city}}"> Top 20 {{$cat->name}}...</span></li>
				</ul>
				<input type="hidden" name="category" value="{{$category_id}}">
				<input type="hidden" name="city" value="{{$city}}">
			</div>
			
				{!! Form::close() !!}
			<div class="filter-search-top-head">
				&nbsp;<i class="fa fa-map-marker"></i> Locality
			</div>
			<div class="filter-search-middle">
				{!! Form::open(['action'=>'Search@store']) !!}
				@foreach($contacts as $per)
					@if($per->location != "")
					<input type="radio" name="local" value="{{$per->location}}" onclick="this.form.submit()" required="required"> <span data-toggle="tooltip" data-placement="top" title="{{$per->location}}"> {{substr($per->location, 0, 21)}}...</span><br/>
					@endif
				@endforeach
				<input type="hidden" name="category" value="{{$category_id}}">
				<input type="hidden" name="city" value="{{$city}}">
			</div>
			
				{!! Form::close() !!}
			
			<div class="filter-search-top-head">
				&nbsp;<i class="fa fa-building-o"></i> City
			</div>
			<div class="filter-search-middle">
				{!! Form::open(['action'=>'Search@store']) !!}
				@foreach($unique as $news)

					<input type="radio" name="city" value="{{$news}}" onclick="this.form.submit()" required="required"> <span data-toggle="tooltip" data-placement="top" title="{{$news}}"> {{substr($news, 0, 21)}}</span><br/>

				@endforeach
				<input type="hidden" name="path" value="{{$category_id}}">

				{!! Form::close() !!}
				
			</div>
			</div>
			</div>
		</div>
		
		<div class="col-md-8 search-padding">
		<div class="top-ticker">
			<span class="visible-xs">
				
				<b>{{count($data)}}</b> records in <b>0.{{rand('0','100')}} sec</b> | 
			 @foreach($category as $cat)
				'<b>{{$cat->name}}</b>'
			@endforeach 
			in

			'<b>{{$city}}</b>'
			</span>
			<span class="hidden-xs">
			<b>{{count($data)}}</b> records in <b>0.{{rand('0','100')}} seconds</b> | 
			You searched 
			 @foreach($category as $cat)
				'<b>{{$cat->name}}</b>'
			@endforeach 
			in

			'<b>{{$city}}</b>'
			</span>
		</div>	
		
		@foreach($data as $key => $value)
			@if(isset($value[0]))

			<div class="search-top">
				<div class="row search">
					<div class="col-xs-4 left-right top-pad bancho2">

						@if($value[0]->category->id == 52)

								<a href="{{url('/profiles', $value[0]->slug)}}"><img src="/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-responsive" style="width:300px;height:200px;margin-bottom:5px;">
							@if($value[0]->paid != 0)
							<span class="verified-cricle">
								<img src="/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
							</span>
							@endif
							</a>
							
								</a>

								@else

								<a href="{{url('/', $value[0]->slug)}}"><img src="/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-responsive" style="width:300px;height:200px;margin-bottom:5px;">
							@if($value[0]->paid != 0)
							<span class="verified-cricle">
								<img src="/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
							</span>
							@endif
							</a>
							
								</a>

								@endif
						
							
						
					</div>
					<div class="col-xs-7 col-md-8 col-sm-8 left-right bancho">
						@if($value[0]->category->id == 52)

								<a href="{{url('/profiles', $value[0]->slug)}}" class="search-heading"><span>{{$value[0]->business_name}}</span>
							
								</a>

								@else

								<a href="{{url('/', $value[0]->slug)}}" class="search-heading"><span>{{$value[0]->business_name}}</span>
							
								</a>

								@endif
						
						<address class="visible-xs">{{substr($value[0]->business_address, 0, 25)}}...</address>
						
						@if($value[0]->category->id == 19)
							<span class="visible-xs" style="font-size:11px;font-family:arial;"><i class="fa fa-calendar"></i> {{date('d F, Y', strtotime($value[0]->created_at))}}</span>
						@endif
						@if($value[0]->rent == "")


								@else

								<span class="visible-xs" style="font-size:11px;font-family:arial;"><b>Starting Price:</b> {{$value[0]->rent}}...</span>

								@endif
						<div class="hidden-xs" style="color:#5a5555;">
						
							<i class="fa fa-map-marker"></i> {{substr($value[0]->business_address, 0, 50)}}... <br/>
							@if($value[0]->category->id == 19)
							<i class="fa fa-calendar"></i> {{date('d F, Y', strtotime($value[0]->created_at))}}<br/>
							@endif
							 @foreach($category as $cat)
								<i class="fa fa-tags"></i> {{$cat->name}}<br/>
								 @endforeach 
								@if($value[0]->only_for == "")

								@else

								<i class="fa fa-tag"></i> {{$value[0]->only_for}}<br/>

								@endif
								
								@if($value[0]->service == '[""]')


								@else

								<b>Services:</b> 
								<?php

          							$ser=json_decode($value[0]->service);?>
              						@foreach ($ser as $key => $sers) 
              						
                          
              						    {{substr($sers, 0, 20)}}, 
            
              						@endforeach

        						<br/>

								@endif
								@if($value[0]->course == '[""]')


								@else

								@if($value[0]->category->id == 52)

								<b>Qulification:</b> 

								@else

								<b>Courses:</b> 

								@endif
								
								<?php

          							$cor=json_decode($value[0]->course);?>
              						@foreach ($cor as $keys => $cors) 
              						
                          
              						    {{substr($cors, 0, 20)}}, 
            
              						@endforeach

        						<br/>

								@endif
								@if($value[0]->facility == '[""]')


								@else

								@if($value[0]->category->id == 52)

								<b>Work Experience:</b> 

								@else

								<b>Facilities:</b> 

								@endif
								
								<?php

          							$fac=json_decode($value[0]->facility);?>
              						@foreach ($fac as $keyss => $facs) 
              						
                          
              						    {{substr($facs, 0, 20)}}, 

            						@endforeach
              						

        						<br/>

								@endif
								@if($value[0]->rent == "")


								@else

								<b>Starting Price:</b> {{$value[0]->rent}}...<br/>

								@endif
							</div>
						
						<div class="search-down">

							@if($value[0]->category->id == 52)

								<a href="{{url('/profiles', $value[0]->slug)}}" class="btn btn-primary btn-sm pull-right but hidden-xs">View More</a>

								@else

								<a href="{{url('/', $value[0]->slug)}}" class="btn btn-primary btn-sm pull-right but hidden-xs">View More</a>

								@endif
						
						
					</div>
					</div>
					<div class="col-xs-1 hidden-sm col-md-0 col-sm-0 visible-xs" style="padding:0px;">
						@if($value[0]->category->id == 52)

								<a href="{{url('/profiles', $value[0]->slug)}}" class="btn btn-success but green-button">View</a>

								@else

								<a href="{{url('/', $value[0]->slug)}}" class="btn btn-success but green-button">View</a>

								@endif
						
					</div>
					
					
				
			</div>


		</div>

			

		<style type="text/css">center{display:none;}.filter-stop{display:block!important;}</style>
				
			@endif
		@endforeach
		<br/>

		<center><img src="/images/listing.png" class="img-responsive"></center>
		<style type="text/css">
			.filter-stop{display:none;}
		</style>
		</div>
		<div class="col-md-2 hidden-xs hidden-sm search-padding">
			<div class="thumbnail" style="margin-top:20px;">
				<a href="http://www.dsom.in/" target="_blank" rel="nofollow"><img src="/images/dsom.jpg" class="img-responsive" alt="Dehradun School of Online Marketing"></a>
			</div>
		</div>
		
	</div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
