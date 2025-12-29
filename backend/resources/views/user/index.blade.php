@extends('layouts.user')



@section('content')

<div class="row">
  <div class="col-md-10 col-xs-12 col-sm-12">
    
  

  <div class="row">
    @if(Session::has('insert'))
    <div class="col-md-12"><br/>
      <div class="alert alert-success">
          <strong> {{session('insert')}}</strong>
      </div>
    </div>
    @endif
    <div class="col-xs-8">
    <h3>Dashboard - <b style="color:#428BCA;">{{Auth()->user()->name}}</b></h3>
    </div>
    <div class="col-xs-4">
      <a href="{{url('marketplace-post')}}" class="btn btn-success pull-right" style="margin-top:15px;">Post Ad</a>
    </div>
  </div>
    <hr style="border-color:black;margin:8px;">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Your Listings</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{number_format($listing)}}</b></h2> 
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-list pull-right"></i> 
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('user-post')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Your Product</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{number_format($product)}}</b></h2> 
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-product-hunt pull-right"></i> 
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('user-product')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div>
    	<div class="col-md-3 col-sm-6">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Queries</div>
  				<div class="panel-body" style="padding:6px;">
  					<div class="col-md-6">
  						<h2><b>{{$query}}</b></h2>	
  					</div>
  					<div class="col-md-6" style="color:#428bca;font-size:60px;">
  						<i class="fa fa-question pull-right"></i>	
  					</div>
  					<div class="clearfix"></div>
  				</div>
  				<div class="panel-footer text-center" style="padding:2px;"><a href="{{url('/query')}}">View <i class="fa fa-arrow-right"></i></a></div>
			</div>
    	</div>
      <div class="col-md-3 col-sm-6">
        <div class="panel panel-primary">
          <div class="panel-heading">Reviews</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{$rating}}</b></h2> 
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-star pull-right"></i> 
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('/rating')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div>
     
     
        
    </div>
    @if(count($message) != 0)
    <br/>
    <div class="row">
        <div class="col-md-12">
            <h3><i class="fa fa-tasks"></i> Task Bar</h3>
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Message</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($message as $msg)
                  <tr>
                    <td>{{$msg->msg}} - <span style="font-size:11px;">{{$msg->created_at->diffForHumans()}}</span></td>
                    <td><a href="{{route('Dashboard.show', $msg->id)}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Mark as Read</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
    @endif
</div>
  <div class="col-md-2 hidden-xs hidden-sm"><br/>
      <div class="thumbnail">
          <a href="https://www.dsom.in/"><img src="{{url('/')}}/images/dsom.jpg" class="img-responsive"></a>
      </div>
  </div>
</div>

@stop
