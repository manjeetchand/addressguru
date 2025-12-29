@extends('layouts.admin')


@section('content')
<?php 
use App\Personal;
?>
<br/>
<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h3>Searches - {{number_format($url->total())}} URL's | Live Url's - {{number_format($live)}}</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th>Url</th>        
        <th>Status</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    
        @foreach($url as $urls)
      <tr>
        <td>
          <?php 

          $values = parse_url($urls->url);

          $host = explode('/',$values['path']);

          if (isset($host[5])) 
          {
              $post = Personal::where('is_active', '=', 1)->where('status', '=', 1)->where('category_id', '=', base64_decode($host[5]))->where('city', '=', $host[4])->count();

          }
          elseif (isset($host[4])) 
          {
              $post = Personal::where('is_active', '=', 1)->where('status', '=', 1)->where('category_id', '=', base64_decode($host[4]))->where('city', '=', $host[3])->count();
          }
          elseif (isset($host[3])) 
          {
              $post = Personal::where('is_active', '=', 1)->where('status', '=', 1)->where('category_id', '=', base64_decode($host[3]))->where('city', '=', $host[2])->count();
          }

          ?>
          <a href="{{$urls->url}}" target="_blank">{{$urls->url}} ({{isset($post) ? number_format($post) : 0}})</a>
        </td>
        <td>
          @if($urls->status == 0)
            {!! Form::model($urls, ['method'=>'PATCH', 'action'=>['AdminSearch@update', $urls->id]]) !!}
              <input type="hidden" name="status" value="1">
              <button class="btn btn-success" style="padding:1px 4px 1px 4px;font-size:12px;">Approve</button>
            {!! Form::close() !!}
          @else
            {!! Form::model($urls, ['method'=>'PATCH', 'action'=>['AdminSearch@update', $urls->id]]) !!}
              <input type="hidden" name="status" value="0">
              <button class="btn btn-primary" style="padding:1px 4px 1px 4px;font-size:12px;">Un-Approve</button>
            {!! Form::close() !!}
          @endif
        </td>
        <td style="width:200px;">
         
          {!! Form::open(['method'=>'DELETE', 'action'=>['AdminSearch@destroy', $urls->id]]) !!}
            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
          {!! Form::close() !!}
        </td>
      </tr>
     @endforeach
    

    </tbody>
  </table>
</div>
{!! $url->render() !!}


@stop