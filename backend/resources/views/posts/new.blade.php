<?php 
use App\Coaching;
use App\Rating;
?>
<style>
	.drop-box{
		box-shadow: 0px 0px 10px #ccc;
		padding: 10px;
		width: 100%;
		position: absolute;
		right: 0;
		background-color: #fff;
		z-index: 9999;
		margin-top: 4%;
		border-radius: 28px;	
	}
	.badge.active {
    background-color: #007bff; /* Change to your desired active color */
    color: white;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12 newbanner">
			<div class="w3-content w3-section">
			@foreach($banner as $ban)
				<?php  $cato = json_decode($ban->category); ?>
				@foreach($cato as $cateo)
				<?php  $arr = array($cateo); ?>
					@if(in_array($category_id, $arr))
						<a href="<?php $banpost = Coaching::find($ban->coaching_id);  ?>{{url('/', $banpost->slug)}}"><img src="{{url('/')}}/images/{{$ban->image}}" class="img-responsive mySlides" alt="{{$ban->name}}"></a>
					@endif
				@endforeach
			@endforeach
			</div>
		</div>
	</div>
</div><br/>
<!-- 
<div class="container">
	<div class="row">
		<div class="col-md-12" style="padding:0px 5px 0px 5px;">
			{!! Form::open(['method'=>'POST', 'action'=>'Search@store']) !!}
			<div class="input-group">
    			<input type="text" class="form-control" name="title" list="name" required="required" placeholder="Search Listing By Name">
    			<datalist id="name">
                    @foreach($select_name as $name)
                      <option value="{{$name}}">
                    @endforeach
                </datalist>
    			<input type="hidden" name="city" value="{{$city}}"><input type="hidden" name="cat" value="{{$category->id}}">
    			<div class="input-group-btn">
      				<button class="btn btn-primary" type="submit">
        				<i class="fa fa-search fa-fw"></i> Search
      				</button>
    			</div>
  			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div> -->
<div class="col-md-12" style="padding-left:5px;padding-right:5px;">
	<!-- <div class="top-ticker">
		<span class="visible-xs">
			<b>{{count($data)}}</b> records in <b>0.{{rand('0','100')}} sec</b> | 
			<b>{{$category->name}}</b>
			in <b>{{$city}}</b>
		</span>
		<span class="hidden-xs">
		<b>{{count($data)}}</b> records in <b>0.{{rand('0','100')}} seconds</b> | 
		You searched <b>{{$category->name}}</b>in
		<b>{{$city}}</b>
		</span>
	</div> -->
	<div class="container">
		<section class="section">
			<div class="row">
				<div class="card">
					<div class="card-body">
						<center>
							<div class="col-md-12">
								<div class="w3-content w3-section flex-center">
									<a href="https://www.addressguru.in/dsom-dehradun-school-of-online-marketing">
										<img src="https://www.addressguru.in/Banners/dsom.jpg" class="img-fluid mySlides" alt="DSOM" style="display: none;">
									</a>
									<a href="#">
										<img src="https://www.addressguru.in/Banners/nda_banner.jpeg" class="img-fluid mySlides" alt="NDA" style="display: none;">
									</a>
									<a href="https://www.addressguru.in/dsom-dehradun-school-of-online-marketing">
										<img src="https://www.addressguru.in/images/1882556671.png" class="img-fluid mySlides" alt="DSOM - Dehradun School of Online Marketing" style="display: block;">
									</a>
									<a href="https://www.addressguru.in/devdham-yatra-dehradun">
										<img src="https://www.addressguru.in/images/653331437.png" class="img-fluid mySlides" alt="Devdham Yatra uttarakhand " style="display: none;">
									</a>
								</div>
							</div>
						</center>
						<div class="row">
           					<div style="padding-top:10px;" class="col-md-12">
							<span>
								<a href="https://www.addressguru.in">{{$city}}</a> &gt;
								<a href="" rel="nofollow">{{$category->name}}</a>&gt; 60+ Business Listings
							</span>
							<h1  class="mt-3" style="font-size:22px;font-weight:700 !important;">Top {{$category->name}} in {{$city}}</h1>
						</div>
						<div class="col-md-12 visible-xs mt-3">
							@if(isset($sub) && count($sub)> 0)
								<div class="tabs-upper" id="content">
									<a href="#" class="mx-1">
										<span class="badge" style="margin-left:0px;">All</span>
									</a>
									<!-- Filter badges (Subcategories) -->
									@foreach($sub->take(5) as $s)
										<a href="javascript:void(0)" class="mx-2 filter-badge" data-subcategory="{{ $s->id }}">
											<span class="badge {{ request()->get('subcategory') == $s->id ? 'active' : '' }}">{{ $s->name }}</span>
										</a>
									@endforeach
									@if($sub->count() > 5)
										<a href="javascript:void(0)" onclick="toggle_visibility('menu-drop')">
											<span class="badge">More <i class="fa fa-angle-down"></i></span>
										</a>
									@endif
									<!-- Hidden subcategories that show when "More" is clicked -->
									<div class="drop-box" id="menu-drop" style="display: none;">
										@foreach($sub->skip(5) as $s)
											<a href="javascript:void(0)" class="filter-badge" data-subcategory="{{ $s->id }}">
												<span class="badge {{ request()->get('subcategory') == $s->id ? 'active' : '' }}">{{ $s->name }}</span>
											</a>
										@endforeach
										<div class="clearfix mt-2"></div>
										<div class="alert alert-info text-center" style="margin-bottom:0px;">
											<strong>AD Banner</strong>
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
						<div class="col-lg-12 mb-3 mt-3">
							<div class="row">
								<div class="col-md-9">
									@forelse($data as $key => $value)
									<div class="card mb-2">
										<div class="card-body">
											@if(isset($value[0]) && $value[0]->paid <= 1)
												<?php $rating = Rating::where('post_id', '=', $value[0]->id)->where('status', '=', 1)->get();?>
												@if($value[0]->category->id == 52)
													<a href="{{url('/profiles', $value[0]->slug)}}">
												@else
													<a href="{{url('/', $value[0]->slug)}}">
												@endif
												<div class="row search">
													<div class="col-md-3 col-12">
														@if($value[0]->category->id == 52)
															<a href="{{url('/profiles', $value[0]->slug)}}">
																<img src="{{url('/')}}/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-fluid img-landpage">
																@if($value[0]->paid != 0)
																	<span class="verified-circle">
																		<img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
																	</span>
																@endif
															</a>
														@else
															<a href="{{url('/', $value[0]->slug)}}">
																<img src="{{url('/')}}/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-fluid img-landpage">
																@if($value[0]->paid != 0)
																	<span class="verified-circle">
																		<img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
																	</span>
																@endif
															</a>
														@endif
													</div>
													<div class="col-md-7 col-12">
														@if($value[0]->category->id == 52)
															<a href="{{url('/profiles', $value[0]->slug)}}" class="search-heading">
																<h5 class="fw-bold text-dark">{{$value[0]->business_name}}</h5>
															</a>
														@else
															<a href="{{url('/', $value[0]->slug)}}" class="search-heading">
																<h5 class="fw-bold text-dark">{{$value[0]->business_name}}</h5>
															</a>
														@endif
														<address class="d-md-none">{{substr($value[0]->business_address, 0, 25)}}...</address>
														@if($value[0]->category->id == 19)
															<span class="d-md-none" style="font-size:11px;font-family:arial;">
																<i class="fa fa-calendar fa-fw"></i> {{date('d F, Y', strtotime($value[0]->created_at))}}
															</span>
														@endif
														@if($value[0]->rent != "")
															<span class="d-md-none" style="font-size:11px;font-family:arial;">
																<b>Starting Price:</b> {{$value[0]->rent}}...
															</span>
														@endif
														<div class="d-none d-md-block" style="color:#5a5555;">
															<i class="fa fa-map-marker fa-fw"></i> {{substr($value[0]->business_address, 0, 50)}}... <br/>
															@if($value[0]->category->id == 19)
																<i class="fa fa-calendar fa-fw"></i> {{date('d F, Y', strtotime($value[0]->created_at))}}<br/>
															@endif
															<!-- <i class="fa fa-tags fa-fw"></i> {{$category->name}}<br/> -->
															@if($value[0]->only_for != "")
																<i class="fa fa-tag fa-fw"></i> {{$value[0]->only_for}}<br/>
															@endif
															@if($value[0]->service != '[""]' && $value[0]->service !== "[null]")
																<b>Services:</b> 
																<?php $ser = json_decode($value[0]->service); ?>
																@foreach ($ser as $key => $sers)
																	{{substr($sers, 0, 20)}}, 
																@endforeach
																<br/>
															@endif
															@if($value[0]->course != '[""]' && $value[0]->course !== "[null]")
																@if($value[0]->category->id == 52)
																	<b>Qualification:</b>
																@endif
																<?php $cor = json_decode($value[0]->course); ?>
																@if(count($cor) > 0)
																	<b>Courses:</b>
																	@foreach ($cor as $keys => $cors)
																		{{substr($cors, 0, 20)}}, 
																	@endforeach
																@endif
																<br/>
															@endif
															@if($value[0]->facility !== "[null]")
																@if($value[0]->category->id == 52)
																	<b>Work Experience:</b>
																@endif
																<?php $fac = json_decode($value[0]->facility); ?>
																<b>Facilities:</b>
																@foreach ($fac as $keyss => $facs)
																	{{substr($facs, 0, 20)}}, 
																@endforeach
																<br/>
															@endif
															@if($value[0]->rent != "")
																<b>Starting Price:</b> {{$value[0]->rent}}...<br/>
															@endif
														</div>
														@php
															$ratingsSum = $value[0]->ratings->sum('rating'); 
															$ratingsCount = $value[0]->ratings->count();
															$rating = $ratingsCount > 0 ? $ratingsSum / $ratingsCount : 0; 
														@endphp
														<div class="rating mb-2">	
															@for($i = 0; $i < 5; $i++)
																<i class="fa fa-star{{ $i < round($rating) ? '' : '-o' }}"></i>
															@endfor
															<b> {{ number_format($rating, 1) }} </b>
															<small>({{ $ratingsCount > 0 ? $ratingsCount : 'No' }} Review{{ $ratingsCount != 1 ? 's' : '' }})</small>
														</div>
														<small class="mb-2">{{substr($value[0]->ad_description, 0, 100)}}...</small><br>
														@if($value[0]->personals[0]->ph_number1)
														<button type="button" class="btn btn-success btn-sm fw-bold px-3 mt-2" style="width:155px;" onclick="PhoneNmmber('{{$value[0]->business_name}}',{{$value[0]->personals[0]->ph_number}},{{$value[0]->personals[0]->ph_number1 }})">
															<i class="bi bi-telephone-fill"></i> &nbsp; 
															<span>Show Number</span>
														</button>
														@else
														<button type="button" class="btn btn-success btn-sm fw-bold px-3 mt-2 toggleNumberBtn" style="width:155px;"  >
															<i class="bi bi-telephone-fill"></i> &nbsp; 
															<span class="buttonText">Show Number</span>
														</button>
														@endif
														<button type="button" class="btn btn-primary btn-sm	 fw-bold px-3 mt-2" style="width:155px;" onclick="Enquire({{$value[0]->user_id}},{{$value[0]->id}},'{{$value[0]->business_name}}')">
															<i class="bi bi-chat-quote-fill"></i> &nbsp;Enquire Now
														</button>
													</div>
												</div>
												</a>
											@endif
										</div>
									</div>
									@empty
										<p>No Data Found</p>
									@endforelse
								</div>
								<div class="col-md-3">
									<div class="filter-stop">
										<div class="panel-group" style="border-bottom: 1px solid #212529;background: #f1f1f1;">
											<div class="panel panel-warning">
												<div class="panel-heading text-light" style="background: #0d6efd;">
													<i class="fa fa-building-o fa-fw"></i>	
													Other Cities
												</div>
												<!-- <center class="mt-2">
												<div class="form-group">
													<input type="search" Placeholder="Search" class="form-control" style="width:90%">
												</div>
												</center> -->
												<div class="panel-body px-4 " style="height: 350px; overflow-y:scroll;" >
												@foreach($cities as $news)		
													<label > 
														<input  class="category-link" data-city="{{$news}}" type="radio" name="city" value="{{$news}}" required="required" @if($city == strtolower($news)) checked @endif															>
														<span data-toggle="tooltip" data-placement="top" title="{{$news}}" style="font-size:15px;font-weight:600" class="text-dark">{{substr($news, 0, 21)}}</span>
													</label><br>												
												@endforeach
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="thumbnail">
										<a href="https://www.addressguru.in/dsom-dehradun-school-of-online-marketing">
											<img src="https://www.addressguru.in/Banners/digital-marketing-course.jpg" class="img-responsive" alt="DSOM" style="width: 100%;">
										</a>
									</div>
            					</div>
								<div class="col-md-12 listing-down">
									<div style="background-color:#fff;padding:15px;margin-bottom:15px;box-shadow:0px 0px 4px #ccc;">
										<strong style="font-size:15px;">Here's the list of top 20  {{$category->name}} in {{$city}} </strong>
										<br>
										<br>
										{{--@forelse($data as $key => $value)			
											<strong style="color:#000302;">{{$key+1}}. <a style="color:#000302;" href="https://www.addressguru.in/noodle-house-restaurant-n-cafe">{{$value[0]->business_name}}</a></strong>
											<p style="color:#000302;">{{substr($value[0]->ad_description,0, 400)}}...</p>
										@empty 
										@endforelse--}}
										</div>
								</div>
								<!-- <div class="col-3">
									<div class="filter-stop">
										<div class="filter-search-top">
											Search Filters <i class="fa fa-filter"></i>
										</div>
										<div class="panel-group" style="margin-top:8px;">
											<div class="panel panel-info">
												<div class="panel-heading"><i class="fa fa-trophy fa-fw"></i> Top Results</div>
												<div class="panel-body">
													{!! Form::open(['action'=>'Search@store']) !!}
														<ul class="topul">
															<li><input type="radio" name="top" value="5" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 5 {{$category->name}} in {{$city}}"> Top 5 {{$category->name}} in {{$city}}</span></li>
															<li><input type="radio" name="top" value="10" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 10 {{$category->name}} in {{$city}}"> Top 10 {{$category->name}} in {{$city}}</span></li>
															<li><input type="radio" name="top" value="15" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 15 {{$category->name}} in {{$city}}"> Top 15 {{$category->name}} in {{$city}}</span></li>
															<li><input type="radio" name="top" value="20" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Top 20 {{$category->name}} in {{$city}}"> Top 20 {{$category->name}} in {{$city}}</span></li>
														</ul>
														<input type="hidden" name="category" value="{{$category_id}}">
														<input type="hidden" name="city" value="{{$city}}">
													{!! Form::close() !!}
												</div>
											</div>
											@if(count($sub) != 0)
											<div class="panel panel-success">
												<div class="panel-heading"><i class="fa fa-tags fa-fw"></i> Sub-Category</div>
												<div class="panel-body" style="overflow:auto;max-height:200px;">
													{!! Form::open(['action'=>'Search@store']) !!}
														@foreach($sub as $subs)
															<input type="radio" name="subcategory" value="{{$subs->id}}" onclick="this.form.submit()" required="required"> <span data-toggle="tooltip" data-placement="top" style="font-size:13px;" title="{{$subs->name}}"> {{$subs->name}}</span><br/>
														@endforeach
														<input type="hidden" name="category" value="{{$category_id}}">
														<input type="hidden" name="city" value="{{$city}}">
													{!! Form::close() !!}
												</div>
											</div>
											@endif
											<div class="panel panel-success">
												<div class="panel-heading"><i class="fa fa-map-marker fa-fw"></i> Locality</div>
												<div class="panel-body" style="overflow:auto;max-height:200px;">
													{!! Form::open(['action'=>'Search@store']) !!}
														@foreach($contacts as $per)
															@if($per->location != "")
															<input type="radio" name="local" value="{{$per->location}}" onclick="this.form.submit()" required="required"> <span data-toggle="tooltip" data-placement="top" style="font-size:13px;" title="{{$per->location}}"> {{substr($per->location, 0, 30)}}...</span><br/>
															@endif
														@endforeach
														<input type="hidden" name="category" value="{{$category_id}}">
														<input type="hidden" name="city" value="{{$city}}">
													{!! Form::close() !!}
												</div>
											</div>
											<div class="panel panel-warning">
												<div class="panel-heading"><i class="fa fa-building-o fa-fw"></i> Other Cities</div>
												<div class="panel-body">
													{!! Form::open(['action'=>'Search@store']) !!}
														@foreach($unique as $news)
															<input type="radio" name="city" value="{{$news}}" onclick="this.form.submit()" required="required"> <span data-toggle="tooltip" data-placement="top" title="{{$news}}" style="font-size:13px;"> {{substr($news, 0, 21)}}</span><br/>
														@endforeach
														<input type="hidden" name="path" value="{{$category_id}}">
													{!! Form::close() !!}
												</div>
											</div>
										</div>
									</div><br/>
									<div class="thumbnail">
										<img src="{{url('/')}}/images/newbanner.jpeg" class="img-responsive" alt="AddressGuru">
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 search-padding visible-xs"></div>
		<div class="row fbox_row hidden-xs">
			@foreach($data as $key => $value)
			@if(isset($value[0]) && $value[0]->paid == 2)
				<a href="{{url('/', $value[0]->slug)}}">
				<div class="col-md-3">
					<div class="featured_box">
						<img src="{{url('/')}}/images/{{$value[0]->photo}}" class="img-responsive" alt="{{$value[0]->business_address}}">
						<span class="fbox_ticker">FEATURED</span>
						<div class="fbox_heading">
							<span>{{substr($value[0]->business_address, 0, 25)}}</span>
						</div>
					</div>
				</div>
				</a>
			@endif
			@endforeach
		</div>
	</div>
		<div class="col-md-9 search-padding">
			@if(count($data) == 0)
				<center><img src="{{url('/')}}/images/listing.png" class="img-responsive"></center>
			@else
			<div style="background-color:#fff;" id="phone-wala">	
				@foreach($data as $key => $value)
					@if(isset($value[0]))
					<?php $rating = Rating::where('post_id', '=', $value[0]->id)->where('status', '=', 1)->get();?>
					<div class="search-top">
						<div class="row search">
							<div class="col-md-3 left-right top-pad bancho2">
								@if($value[0]->category->id == 52)
									<a href="{{url('/profiles', $value[0]->slug)}}"><img src="{{url('/')}}/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-responsive img-landpage">
										@if($value[0]->paid != 0)
											<span class="verified-cricle">
												<img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
											</span>
										@endif
									</a>
								@else
								<a href="{{url('/', $value[0]->slug)}}"><img src="{{url('/')}}/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-responsive img-landpage">
									@if($value[0]->paid != 0)
										<span class="verified-cricle">
											<img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
										</span>
									@endif
								</a>
								@endif
							</div>
							<div class="col-xs-7 col-md-7 col-sm-8 left-right bancho">
								@if($value[0]->category->id == 52)
									<h2 class="fw-bold" style="font-size:22px">{{$value[0]->business_name}}</h2>
								@else
									<a href="{{url('/', $value[0]->slug)}}" class="search-heading"><h2 class="fw-bold" style="font-size:22px">{{$value[0]->business_name}}</h2></a>
								@endif
									<address class="visible-xs">{{substr($value[0]->business_address, 0, 25)}}...</address>
								@if($value[0]->category->id == 19)
									<span class="visible-xs" style="font-size:11px;font-family:arial;"><i class="fa fa-calendar fa-fw"></i> {{date('d F, Y', strtotime($value[0]->created_at))}}</span>
								@endif
								@if($value[0]->rent == "")
								@else
									<span class="visible-xs" style="font-size:11px;font-family:arial;"><b>Starting Price:</b> {{$value[0]->rent}}...</span>
								@endif
								<div class="hidden-xs" style="color:#5a5555;">
									<i class="fa fa-map-marker fa-fw"></i> {{substr($value[0]->business_address, 0, 50)}}... <br/>
									@if($value[0]->category->id == 19)
										<i class="fa fa-calendar fa-fw"></i> {{date('d F, Y', strtotime($value[0]->created_at))}}<br/>
									@endif
									<i class="fa fa-tags fa-fw"></i> {{$category->name}}<br/>
									@if($value[0]->only_for == "")
									@else
										<i class="fa fa-tag fa-fw"></i> {{$value[0]->only_for}}<br/>
									@endif
									@if($value[0]->service == '[""]' OR $value[0]->service == '[null]')
									@else
										<b>Services:</b> 
										<?php
											$ser=json_decode($value[0]->service);?>
											@if(count($ser) > 0)
												@foreach ($ser as $key => $sers) 
													{{substr($sers, 0, 20)}}, 
												@endforeach
											@endif
										<br/>
									@endif
									@if($value[0]->course == '[""]' OR $value[0]->course == '[null]')
									@else
										@if($value[0]->category->id == 52)
											<b>Qulification:</b> 
										@else
									@endif
									<?php $cor=json_decode($value[0]->course);?>
										@if(count($cor) > 0)
											<b>Courses:</b> 
											@foreach ($cor as $keys => $cors) 
												{{substr($cors, 0, 20)}}, 
											@endforeach
										@endif
									<br/>
									@endif
										@if($value[0]->facility == '[""]' OR $value[0]->facility == '[null]')
										@else
											@if($value[0]->category->id == 52)
												<b>Work Experience:</b> 
											@else
												<b>Facilities:</b> 
											@endif
											<?php $fac=json_decode($value[0]->facility);?>
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
								</div>
							<div class="col-md-2 hidden-xs" style="border-left:1px solid #eee;height:188px;">
								<div class="search-down1">
									<div class="rating">
										<?php 
											$total = 0;
											$counts = count($rating);
											foreach ($rating as $check) 
											{
												$total+= $check->rating; 
											}
											if ($total == "") 
											{
												echo "No reviews";
											}
											else
											{
												if($total > 0 && $counts > 0)
												{
													$review = $total/$counts;
												}
												else
												{
													$review = 0;
												}
											if ($review < 2) 
											{
												echo "<i class='fa fa-star'></i> <b>".substr($review, 0, 3)."</b>";
											}
											elseif ($review < 3) 
											{
												echo "<i class='fa fa-star'></i><i class='fa fa-star'></i> <b>".substr($review, 0, 3)."</b>";
											}
											elseif ($review < 4) 
											{
												echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> <b>".substr($review, 0, 3)."</b>";
											}
											elseif ($review < 5) 
											{
												echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> <b>".substr($review, 0,3)."</b> ";
											}
											elseif ($review < 6) 
											{
												echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> <b>".substr($review, 0,3)."</b> ";
											}
											}
										?>
									</div>
									@if($value[0]->category->id == 52)
										<a href="{{url('/profiles', $value[0]->slug)}}" class="btn btn-primary btn-sm but hidden-xs">View More</a>
									@else
										<a href="{{url('/', $value[0]->slug)}}" class="btn btn-primary btn-sm but hidden-xs">View More</a>
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
					<style type="text/css">.filter-stop{display:block!important;}</style>
					@endif
				@endforeach
			</div>
			@endif
		<br/>
</div>
<script>
$(document).ready(function () {
    $('#enquiryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
        // Prepare form data
        let formData = $(this).serialize();
        // Send AJAX request
        $.ajax({
            url: $(this).attr('action'), // Form's action attribute
            type: 'POST',
            data: formData,
            beforeSend: function () {
                // Optional: Show a loader or disable the button
                $('.send-enquiry').prop('disabled', true).text('Submitting...');	
            },
            success: function (response) {
                // Handle success response with SweetAlert
                swal("Success!", "Query submitted successfully!", "success");
                $('#enquiryForm')[0].reset(); // Reset the form
                $('.send-enquiry').prop('disabled', false).text('Send Enquiry');
            },
            error: function (xhr) {
                // Handle error response
                if (xhr.status === 422) { // Validation error
                    let errors = xhr.responseJSON.errors;
                    $('.help-block').remove(); // Clear previous errors
                    $.each(errors, function (key, message) {
                        $(`[name="${key}"]`)
                            .closest('.form-group')
                            .append(`<span class="help-block"><small style="color:red;">${message}</small></span>`);
                    });
                    // Show SweetAlert for validation errors
                    swal("Validation Error!", "Please correct the highlighted fields and try again.", "error");
                } else {
                    // Show SweetAlert for general errors
                    swal("Error!", "Something went wrong. Please try again.", "error");
                }
                $('.send-enquiry').prop('disabled', false).text('Send Enquiry');
            }
        });
    });
});
</script>
<script>
  $(document).ready(function() {
      $('.toggleNumberBtn').click(function() {
          var buttonTextElement = $(this).find('.buttonText');
          if (buttonTextElement.text().trim() === 'Show Number') {
              buttonTextElement.text('{{ $value[0]->personals[0]->ph_number ?? "No Number" }}');
          } else {
              buttonTextElement.text('Show Number');
          }
      });
  });
</script>
<script type="text/javascript">
	if( $(window).width() > 960 ){
    	$('#phone-wala').remove();
	}
	else{
		$('#lap-wala').remove();
	}
</script>
<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
</script>
<script>
   document.querySelectorAll('.category-link').forEach(function(link) {
    link.addEventListener('click', function(e) {
        // Assuming the '{{$category->name}}' is being correctly injected by Blade
        var category = "{{ addslashes($category->name) }}"; // Ensure category is safely embedded
        var categoryName = category.toLowerCase().replace(/\s+/g, '-'); // Convert category to a URL-friendly format
        var city = link.getAttribute('data-city').toLowerCase().replace(/\s+/g, '-'); // Get and format city
        var updatedUrl = "{{ url('') }}/" + categoryName + "/" + encodeURIComponent(city);
        // Redirect to the constructed URL
        window.location.href = updatedUrl;
    });
});
</script>
<script>
    // Toggle visibility of the "More" dropdown
    function toggle_visibility(id) {
        var element = document.getElementById(id);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
    // Handle the filter badge click
    document.querySelectorAll('.filter-badge').forEach(function(item) {
        item.addEventListener('click', function() {
            var subcategoryId = item.getAttribute('data-subcategory'); // Get the subcategory ID
            applyFilter(subcategoryId); // Call the function to apply the filter
        });
    });
    // Apply filter using AJAX
    function applyFilter(subcategoryId) {
        // Change the button color (add 'active' class)
        document.querySelectorAll('.filter-badge .badge').forEach(function(badge) {
            badge.classList.remove('active');
        });
        document.querySelector(`[data-subcategory="${subcategoryId}"] .badge`).classList.add('active');
        // Make an AJAX request to the controller
        var url = ""; // Update this with your actual route
        var params = {
            subcategory: subcategoryId
        };
        // AJAX request
        fetch(url + `?subcategory=${subcategoryId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            // Update the list of subcategories based on the AJAX response
            document.getElementById('content').innerHTML = data.view; // Assuming the response includes HTML to update the content
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }
</script>