
@extends('layouts.agent')


@section('content')

<div class="row">
  @if(Session::has('insert'))
    <div class="col-md-12"><br/>
      <div class="alert alert-success">
          <strong> {{session('insert')}}</strong>
      </div>
    </div>
    @endif
  <div class="col-md-10 col-xs-12 col-sm-12">
  <div class="row">
    <div class="col-xs-6">
    <h3>Dashboard - <b style="color:#428BCA;">{{Auth()->user()->name}}</b></h3>
    </div>
    <div class="col-xs-6">
      <a href="{{url('marketplace-post')}}" class="btn btn-success pull-right" style="margin-top:15px;">Post Ad</a>
    </div>
  </div>
    <hr style="border-color:black;">
    <div class="row">
    	<div class="col-md-3">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Clients</div>
  				<div class="panel-body" style="padding:6px;">
  					<div class="col-md-6">
  						<h2><b>{{number_format($client)}}</b></h2>	
  					</div>
  					<div class="col-md-6" style="color:#428bca;font-size:60px;">
  						<i class="fa fa-user pull-right"></i>	
  					</div>
  					<div class="clearfix"></div>
  				</div>
  				<div class="panel-footer text-center" style="padding:2px;"><a href="{{route('client.index')}}">View <i class="fa fa-arrow-right"></i></a></div>
			</div>
    	</div>
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Products</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{number_format($product)}}</b></h2> 
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-product-hunt pull-right"></i> 
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('agent-product')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Reviews</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{number_format($rating)}}</b></h2> 
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-star pull-right"></i> 
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('agent/rating')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div> 
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Your Earning</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{$total}}</b></h2> 
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-rupee pull-right"></i> 
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{route('agent-payment.index')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div>         
    </div>
    <hr/>
<div class="row">
    {!! Form::open(['action'=>'PartnerIndex@store']) !!}

        <div class="form-group">
            <center><label>Search Listing</label></center>
            <input type="text" name="find" class="form-control" placeholder="Search Listing" onchange="this.form.submit()">
        </div>
  
    {!! Form::close() !!}
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
                    <td><a href="{{route('agent-banner.show', $msg->id)}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Mark as Read</a></td>
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