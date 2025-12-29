@extends('layouts.user')

@section('content')
<h2>Packages</h2><br/>
 {!! Form::open(['action'=>'UserPack@store']) !!}
    <div class="form-{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>Package Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Package Name">
         @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div><br/>
    <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
        <label>What's Include</label>
        <textarea rows="3" class="form-control" name="about" placeholder="What's Include">{{ old('about') }}</textarea>
         @if ($errors->has('about'))
        <span class="help-block">
          <strong>{{ $errors->first('about') }}</strong>
        </span>
      @endif
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                <label>Package Price</label>
	    		<input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Package Price">
                @if ($errors->has('price'))
        <span class="help-block">
          <strong>{{ $errors->first('price') }}</strong>
        </span>
      @endif
    		</div>
    	</div>
    	<div class="col-md-6">
    		<div class="form-group{{ $errors->has('dates') ? ' has-error' : '' }}">
                <label>Tour Days</label>
                <input type="text" name="dates" class="form-control" value="{{ old('dates') }}" placeholder="Tour Days">
                @if ($errors->has('dates'))
        <span class="help-block">
          <strong>{{ $errors->first('dates') }}</strong>
        </span>
      @endif
            </div>
    	</div>
    </div>
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input type="hidden" name="post_id" value="{{$new}}">
    
    <center><button class="btn btn-primary"> Submit</button></center>   
 {!! Form::close() !!}
 <br/><br/>
 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Package Name</th>
        <th>What's Include</th>
        <th>Package Price</th>
        <th>Tour Days</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>       
    @foreach($pack as $packs)

      <tr>
        <td>{{$packs->name}}</td>
        <td>{{$packs->about}}</td>
        <td><i class="fa fa-rupee"></i> {{$packs->price}}</td>
        <td>{{$packs->dates}}</td>
        <td>
          <?php $id = base64_encode($packs->id); ?>
          <a href="{{route('user.package.edit', $id)}}" class="btn btn-success pull-left"><i class="fa fa-edit"></i></a>
            {!! Form::open(['action'=>['UserPack@destroy', $packs->id], 'method'=>'DELETE']) !!}
                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
            {!! Form::close() !!}
        </td>
      </tr>


   
    
    @endforeach
     

    </tbody>
  </table>
</div>
@stop