@extends('layouts.admin')

@section('content')
 <div class="row">
</div>
<div>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm" style="margin-top:10px;"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
    <a href="{{route('payment-package.create')}}" class="btn btn-success btn-sm" style="margin-top:10px;"><i class="fa fa-plus fa-fw"></i> Add Plans</a>
</div>

<h3><i class="fa fa-file fa-fw"></i> Payment Plans With Type :</h3><hr>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>S.No</th>        
            <th>Name </th>
            <th>Type</th>
            <th>Price</th>
            <th>Seq.</th>
            <th>Days</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @if(isset($plans))
            @foreach($plans as $key => $plan)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <b>{{$plan->name}}</b>
                        <br> Status :
                            @if($plan->status == 1)
                              <span class="badge badge-success">Active</span> 
                            @else
                              <span class="badge badge-danger">In-Active</span> 
                            @endif
                        <br> Created Date : {{ $plan->created_at->format('d/m/Y h:i A') }}
                    </td>
                    <td><b>{{$plan->type}} <br> PAID TYPE :
                         @if($plan->price >= 1)
                            <span class="badge badge-primary">Paid</span>
                         @else
                           <span class="badge badge-primary">Free</span>
                         @endif
                         </b>
                    </td>
                    <td><b>{{$plan->price}} </b></td>
                    <td><b>{{$plan->sequence}}</b></td>
                    <td>DAYS: {{$plan->days}}  <br>DEAL: {{$plan->deal}} </td>
                    <td>
                        <!-- <a href="" class="btn btn-primary btn-sm pull-left"><i class="fa fa-eye fa-fw"></i></a> -->
                        <a href="{{ route('payment-package.edit', $plan->id) }}" style="margin-left:10px;" class="btn btn-success btn-sm pull-left"><i class="fa fa-edit"></i> Edit</a>
                    </td>
                </tr>
                <tr>
                  <td colspan="8"><b>Description</b> : {{$plan->description}}</td>
                </tr>
            @endforeach
            @endif
           
        </tbody>
    </table>
</div>
@endsection