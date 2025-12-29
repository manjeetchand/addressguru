@extends('layouts.agent')

@section('content')
<br/>
<a href="{{url('/Partner Dashboard')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h1>Your Earning</h1><hr/>
<div class="row">
    <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Listing name</th>
        <th>Amount</th>
        <th>GST (18%)</th>
        <th>Gateway Charges (4%)</th>
        <th>Total</th>
        <th>Your Earning</th>
      </tr>
    </thead>
    <tbody>    
    <?php $total = 0; ?>   
    @foreach($payment as $per)

      <tr>
        <td><a href="{{url('preview', $per->post ? $per->post->slug : '#')}}">{{$per->post ? $per->post->business_name : 'Listing Deleted!'}}</a></td>
        <td>₹ {{$per->amount}}</td>
        <td><?php 
          $gsts= 18; 

          $pers = ($per->amount / 100) * $gsts; 

          echo "₹ ".number_format($pers, 2)." (-)";

            $pays = $per->amount - $pers;
        ?></td>
        <td>
          <?php 
              $gateways = 4;

              $cals = ($pays / 100) * $gateways;

              echo "₹ ".number_format($cals, 2)." (-)";
          ?>
        </td>
        <td>
          <?php 
              $charges = $pays - $cals;

              echo "₹ ".number_format($charges, 2);
          ?>
        </td>
        <td>
          <?php 
             $coms = 40;

            $comms = ($charges / 100) * $coms;

            echo "₹ ".number_format($comms, 2);

            $total += $comms;
          ?>
        </td>
      </tr>
    
   @endforeach
      <tr>
        <td><b>Total</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b>₹ {{number_format($total)}}</b></td>
      </tr>

    </tbody>
  </table>
</div>
</div>
@stop