@extends('layouts.admin')


@section('content')
<br/>

<div class="row">
  <div class="col-md-4">
      {!! Form::open(['action'=>'AdminEditor@store']) !!}
        <h3>Add Editor</h3><hr/>
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Full Name" value="{{old('name')}}" class="form-control">
            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label>Email</label>
            <input type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control">
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
          </div>
          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
            <label>Mobile Number</label>
            <input type="number" name="mobile_number" value="{{old('mobile_number')}}" placeholder="Mobile Number" class="form-control">
            @if ($errors->has('mobile_number'))
            <span class="help-block">
                <strong>{{ $errors->first('mobile_number') }}</strong>
            </span>
        @endif
          </div>
          <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            <label>Select Category</label>
            <select class="form-control" name="category_id">
              <option value="">Choose Category</option>
              @foreach($category as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
              @endforeach
            </select>
             @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
          </div>
          <div class="form-group">
              <center><button class="btn btn-success">Submit</button></center>
          </div>
      {!! Form::close() !!}
  </div>
  <div class="col-md-8">
    <h3>Editors</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th> 
        <th>Category</th>     
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    
      @foreach($user as $users)
        
      <tr>
        
        <td>{{$users->name}}</td>
        <td>{{$users->email}}</td>
        <td>{{$users->role->name}}</td>
      <td>{{$users->category ? $users->category->name : 'uncategorized'}}</td>
       
       
        <td style="width:200px;">
          <a href="{{route('admin-editor.edit', $users->id)}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>
          {{-- {!! Form::open(['method'=>'DELETE', 'action'=>['AdminEditor@destroy', $users->id]]) !!}
            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
          {!! Form::close() !!} --}}
        </td>
      </tr>
      
    @endforeach

    </tbody>
  </table>
</div>
  </div>
</div>



@stop