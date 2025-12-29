<div class="col-md-6{{ $errors->has('payment') ? ' has-error' : '' }}">
            <label>Payment Mode <span>*</span></label><br/>
            @if(isset($paymentMode))
            @foreach($paymentMode as $Payment)
                    <input type="checkbox" name="payment[]" value="{{$Payment->name}}" @if(is_array(old('payment')) && in_array('{{$Payment->name}}', old('payment'))) checked @endif <?php 
                            if (strpos(isset($listing) ? $listing->payment : '', '{{$Payment->name}}') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> {{$Payment->name}}&nbsp;&nbsp;
            @endforeach
            @endif
    
            {{--<input type="checkbox" name="payment[]" value="Debit/Credit Card" @if(is_array(old('payment')) && in_array('Debit/Credit Card', old('payment'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->payment : '', 'Debit/Credit Card') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Debit/Credit Card&nbsp;&nbsp;
            <input type="checkbox" name="payment[]" value="Net Banking" @if(is_array(old('payment')) && in_array('Net Banking', old('payment'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->payment : '', 'Net Banking') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Net Banking&nbsp;&nbsp;
            <input type="checkbox" name="payment[]" value="Cheque"  @if(is_array(old('payment')) && in_array('Cheque', old('payment'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->payment : '', 'Cheque') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Cheque&nbsp;&nbsp;
            <input type="checkbox" name="payment[]" value="Other" @if(is_array(old('payment')) && in_array('Other', old('payment'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->payment : '', 'Other') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Other --}}
            @if ($errors->has('payment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment') }}</strong>
                            </span>
                        @endif
          </div>