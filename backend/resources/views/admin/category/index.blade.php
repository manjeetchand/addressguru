@extends('layouts.admin')


<title>Category</title>











@section('content')


<br/>


<a href="{{url('/admin')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>


<a href="{{route('admin-category.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Create Category</a>


<a href="{{url('admin-category/payment')}}" class="btn btn-warning btn-sm"><i class="fa fa-plus fa-fw"></i>Payment Mode</a>





<h1>Category</h1><hr/>


<div class="table-responsive">


 <table class="table table-striped table-bordered">


    <thead>


   


      <tr>


      	<th>ID</th>


        <th>Name</th>


        <th>Icon</th>


        <th>Color</th>


        <th>Created at</th>


       


        <th>Operation</th>


      </tr>


    </thead>


    <tbody>


    	


    	@foreach($category as $cat)


        


      <tr>


      	<td>{{$cat->id}}</td>


        <td>{{$cat->name}}</td>


        <td>
          <div class="div" style="background:{{$cat->colors}}; width:75;height:75;padding: 6px;border-radius: 4px;">
            @if($cat->svg_code)
                {{-- Render SVG inline safely --}}
                <div class="svg-icon" style="width:100%">{!! $cat->svg_code !!}</div>
            @elseif($cat->icon)
                <img src="{{ asset($cat->icon) }}" alt="{{ $cat->name }}-icon" style="width:100%">
            @endif
          </div>
        </td>


        <td><span style="background-color:{{$cat->colors}};padding:10px 20px 10px 20px;box-shadow:0px 0px 4px;"></span></td>


        <td>{{date('d F, Y', strtotime($cat->created_at))}}</td>


       


        <td>





          <a href="{{route('admin-sub-category.show', $cat->id)}}" class="btn btn-success pull-left" style="margin-right:10px;"><i class="fa fa-plus"></i></a>


        	


        	<a href="{{route('admin-category.edit', $cat->id)}}" class="btn btn-warning pull-left"><i class="fa fa-edit"></i></a>





        	{!! Form::open(['action'=>['CategoryControl@destroy', $cat->id], 'method'=>'DELETE']) !!}





        		<button class="btn btn-danger" style="margin-left:10px;"><i class="fa fa-trash"></i></button>





        	{!! Form::close() !!}


        </td>


      </tr>


       


    	@endforeach





    </tbody>


  </table>


</div>


<!-- Button to Open the Modal -->


<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">-->


<!--  Open modal-->


<!--</button>-->





<!-- The Modal -->


<!--<div class="modal" id="myModal">-->


<!--  <div class="modal-dialog">-->


<!--    <div class="modal-content">-->





      <!-- Modal Header -->


<!--      <div class="modal-header">-->


<!--        <h4 class="modal-title">Modal Heading</h4>-->


<!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->


<!--      </div>-->





      <!-- Modal body -->


<!--      <div class="modal-body">-->


<!--        Modal body..-->


<!--      </div>-->





      <!-- Modal footer -->


<!--      <div class="modal-footer">-->


<!--        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->


<!--      </div>-->





<!--    </div>-->


<!--  </div>-->


<!--</div>-->





@stop