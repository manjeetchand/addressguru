<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 mb-3">
                    <div class="row d-flex align-items-center justify-content-evenly">
                        <div class="col-md-8 d-flex justify-content-start gap-3">
                            <div class="col-2 d-flex align-items-center">
                            <div  style="border: 1px solid #cccc;padding: 2px;border-radius: 4px;"> 
                                @foreach($data as $key => $value)
                                    @if(isset($value[0]) && $value[0]->paid <= 1)
                                        <?php 
                                            $rating = Rating::where('post_id', '=', $value[0]->id)->where('status', '=', 1)->get();
                                        ?>
                                        <div class="search-top">
                                            @if($value[0]->category->id == 52)
                                                <a href="{{url('/profiles', $value[0]->slug)}}">
                                            @else
                                                <a href="{{url('/', $value[0]->slug)}}">
                                            @endif
                                                <div class="row search">
                                                    <div class="col-md-3 col-12 left-right top-pad bancho2">
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
                                                    <div class="col-md-7 col-12 left-right bancho">
                                                        @if($value[0]->category->id == 52)
                                                            <a href="{{url('/profiles', $value[0]->slug)}}" class="search-heading">
                                                                <h2 class="fw-bold text-dark" style="font-size:22px">{{$value[0]->business_name}}</h2>
                                                            </a>
                                                        @else
                                                            <a href="{{url('/', $value[0]->slug)}}" class="search-heading">
                                                                <h2 class="fw-bold text-dark" style="font-size:22px">{{$value[0]->business_name}}</h2>
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
                                                            <i class="fa fa-tags fa-fw"></i> {{$category->name}}<br/>
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
                                                        <button type="button" class="btn btn-success btn-md fw-bold px-3">
                                                            <i class="bi bi-telephone-fill"></i> &nbsp;Show Number
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-md fw-bold px-3" style="border: 1px solid;">
                                                            <i class="bi bi-chat-quote-fill"></i> &nbsp;Enquire Now
                                                        </button>
                                                    </div>
                                                    <div class="col-md-2 d-none d-md-block" style="border-left:1px solid #eee;height:188px;">
                                                        <div class="search-down1">
                                                            <div class="rating">
                                                                <?php 
                                                                    $total = 0;
                                                                    $counts = count($rating);

                                                                    foreach ($rating as $check) {
                                                                        $total+= $check->rating; 
                                                                    }

                                                                    if ($total == "") {
                                                                        echo "No reviews";
                                                                    } else {
                                                                        if($total > 0 && $counts > 0) {
                                                                            $review = $total / $counts;
                                                                        } else {
                                                                            $review = 0;
                                                                        }

                                                                        for($i = 0; $i < 5; $i++) {
                                                                            if($i < $review) {
                                                                                echo "<i class='fa fa-star'></i>";
                                                                            } else {
                                                                                break;
                                                                            }
                                                                        }
                                                                        echo " <b>".substr($review, 0,3)."</b>";
                                                                    }
                                                                ?>
                                                            </div>
                                                            @if($value[0]->category->id == 52)
                                                                <a href="{{url('/profiles', $value[0]->slug)}}" class="btn btn-primary btn-sm hidden-xs">View More</a>
                                                            @else
                                                                <a href="{{url('/', $value[0]->slug)}}" class="btn btn-primary btn-sm hidden-xs">View More</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <style type="text/css">.filter-stop{display:block!important;}</style>
                                    @endif
                                @endforeach
                            </div>
                            </div>
                        </div>
                        <div class="col-3">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>