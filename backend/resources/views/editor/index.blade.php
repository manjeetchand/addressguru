@extends('layouts.editor')


@section('content')

 <h3>{{Auth::user()->name}} - Editor Panel</h3><hr style="border-color:black;">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading">Approval Request</div>
          <div class="panel-body" style="padding:6px;">
            <div class="col-md-6">
              <h2><b>{{count($post)}}</b></h2>  
            </div>
            <div class="col-md-6" style="color:#428bca;font-size:60px;">
              <i class="fa fa-spinner pull-right"></i>  
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-footer text-center" style="padding:2px;"><a href="{{route('editor-dashboard.create')}}">View <i class="fa fa-arrow-right"></i></a></div>
      </div>
      </div> 
    	
    
     
     
     
               
    </div>



@stop