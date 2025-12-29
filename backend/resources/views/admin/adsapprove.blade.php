@extends('layouts.admin')


@section('content')
<?php 
    use Illuminate\Support\Facades\Crypt;
    ?>
<meta name="csrf-token" content="{{ csrf_token() }}">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@if(Session::has('insert'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('insert')}}</strong>
          </div>

        @endif

<a href="{{url('admin-marketplace')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<br/><br/>
<input class="form-control" id="myInput" type="text" placeholder="Search..">
<h3>Ads Approval Request</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered" >
    <thead>
   
      <tr>
      	<th style="width:200px;">Business Image</th>
        <th>User</th>
        <th>Title</th>
        <th>Category</th>      
        <th>Created at</th>
        <th style="width:200px;">Status</th>
      </tr>
    </thead>
    <tbody id="myTable">
    	<?php $i = 1; ?>
      @foreach($pro as $pros)
        <tr id="row{{$i}}">
          <td><center><img src="{{url('/')}}/images/{{$pros->medias[0]->name}}" style="width:100px;height:100px;" class="img-responsive" alt="{{$pros->title}}"></center></td>
          <td><a href="{{url('admin-marketplace', $pros->user_id)}}">{{$pros->user->name}}</a></td>
          <td><a href="{{url('marketplace-preview', $pros->slug)}}">{{$pros->title}}</a></td>
          <td>{{$pros->mcategory->name}} <small>({{$pros->msubcategory->name}})</small></td>
          <td>{{date('d M, Y', strtotime($pros->created_at))}}</td>
          <td>
              <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $pros->id; ?>, '<?php echo 'row'.$i; ?>', '<?php echo 'app_btn'.$i; ?>')" class="btn btn-success btn-sm pull-left"><i class="fa fa-check-circle fa-fw"></i> Approve</a>
              <a href="{{url('sell-step-one-edit', Crypt::encrypt($pros->id))}}" class="btn btn-success btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-edit fa-fw"></i></a>
          </td>
        </tr>
        <?php $i++; ?>
      @endforeach

    </tbody>
  </table>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > 0)
    });
  });
});

function get_approve(a, b, c) 
    {
        var pid, row, abtn,

        row = document.getElementById(b);
        abtn = document.getElementById(c);

        abtn.innerHTML = "<i class='fa fa-check fa-fw'></i> Approved";
        abtn.setAttribute('class', 'btn btn-primary pull-left btn-sm');
        abtn.removeAttribute('onclick');
        row.style.background = "#eee";
        setTimeout(function(){row.parentNode.removeChild(row);}, 1000);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{url("approve-ads")}}',
            type: 'POST',
            data: {wid: a},
            success: function(datalink){
                console.log(datalink);
                }
            });
    }
</script>

@stop