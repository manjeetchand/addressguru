@extends('layouts.admin')
<title>Template</title>

@section('content')
<br/>
<a href="{{url('/admin')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  <i class="fa fa-plus fa-fw"></i>Add Template
</button>

<h1>Category</h1><hr/>
<div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
      	<th>ID</th>
        <th>Label</th>
        <th>Message</th>
        <th>Type</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    	@if(isset($templates))
    	@foreach($templates as $template)
          <tr>
          	<td>{{$template->id}}</td>
            <td>{{$template->title}}</td>
            <td>{{$template->type}}</td>
            <td>{{$template->message}}</td>
            <td>
                <a href="#" class="btn btn-warning pull-left"  data-toggle="modal" data-target="#editModal{{$template->id}}">
                    <i class="fa fa-edit"></i>
                </a>
            {!! Form::open(['route' => ['admin-template.destroy', $template->id], 'method' => 'DELETE']) !!}
                <button type="submit" class="btn btn-danger" style="margin-left: 10px;" onclick="return confirmDelete()">
                    <i class="fa fa-trash"></i>
                </button>
            {!! Form::close() !!}
            </td>
          </tr>
          
          <div class="modal" id="editModal{{$template->id}}" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Template</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('admin-template.update',$template->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type" id="templateType">
                                        <option value="whatshapp" @if($template->type == 'whatshapp')selected @endif >Whatshapp</option>
                                        <option value="email" @if($template->type == 'email')selected @endif >Email</option>
                                        <option value="sms" @if($template->type == 'sms')selected @endif >SMS</option>
                                    </select>
                                    	@if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                         @endif
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" id="templateTitle" value="{{$template->title}}">
                                </div>
                                	@if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                     @endif
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" name="message" id="templateMessage" >{{$template->message}}</textarea>
                                </div>
                            	@if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                 @endif
                            </div>
            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit fa-fw"></i>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    	@endforeach
    	@endif
    </tbody>
  </table>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Template</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('admin-template.store')}}" method="POST">
          @csrf
      <!-- Modal body -->
      <div class="modal-body">
            <div class="form-group">
                <label>Type</label>
               <select class="form-control" name="type">
                   <option value="whatshapp">Whatshapp</option>
                   <option value="email">Email</option>
                   <option value="sms">SMS</option>
               </select>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message"></textarea>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus fa-fw"></i>Add</button>
      </div>
      </form>

    </div>
  </div>
</div>


<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this template?');
}
</script>

@stop