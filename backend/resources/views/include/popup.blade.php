<!-- Modal -->
  <center><div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-box">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title text-center" style="color:#337AB7;"><b>Enter Your City Name</b></h3>
        </div>
        <div class="modal-body">        
            {!! Form::open(['action'=>'Search@store']) !!}
                <input type="hidden" name="path" value="PATHHERE" class="form-control pathinput"><br/>
                <input type="text" name="city" class="form-control" list="city" placeholder="Enter Your City" required="required" autofocus value="<?php if(isset($_COOKIE['cityname'])){echo $_COOKIE['cityname'];} ?>">
                <datalist id="city">
                    @foreach($uniques as $unique1)
                      <option value="{{$unique1}}">
                    @endforeach
                </datalist>
                <br/>
                <center><button class="btn btn-primary"><i class="fa fa-search"></i> Search</button></center>   
            {!! Form::close() !!}
        </div>
      </div>
      
    </div>
  </div></center>

