@extends('layouts.admin')
@section('content')
<style>
    .btn-del {
    display: inline-block; /* Keep it inline with input */
    color: red; /* Change color if needed */
    font-size: 20px; /* Adjust size */
}
</style>
<a href="{{url('admin-category')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
</br>
</br>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="#panel-1" class="nav-link active" data-bs-toggle="tab">{{$cat->label}}</a>
    </li>
</ul>

<div class="tab-content mt-4">
      <!-- Panel 2: Edit Facilities -->
    <div class="tab-pane fade mt-4 pt-4" id="panel-1" style="margin-top:20px;">
    <div class="col-md-12 mb-30">
        <a href="javascript:void(0)" class="btn btn-primary btn-add-facility">
            <i class="fa fa-plus"></i> Add Value's
        </a>
         {!! Form::model($cat ?? null, [
            'action' => isset($cat->parentcat) ? ['AdminSubCategory@value', $cat->id] : ['AdminSubCategory@value'],
            'method' => isset($cat->parentcat) ? 'PATCH' : 'POST',
            'id' => 'facilities-form'
        ]) !!}
        <input name="category_id" type="hidden" value="{{$cat->id}}">
        <div class="facilities-wrapper">
       @if(isset($cat) && $cat->parentcat->isNotEmpty())
            @foreach($cat->parentcat as $facility) <!-- Loop through each parent category -->
                <div class="col-md-3 facility-item" style="margin-top:10px;padding:0;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" name="value[]" value="{{ $facility->value }}" required="">
                        <a href="javascript:void(0)" class="btn btn-del mt-1">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                    @if ($errors->has('facilities.*'))
                        <span class="help-block">
                            <strong>{{ $errors->first('facilities.*') }}</strong>
                        </span>
                    @endif
                </div>
            @endforeach
            @else <!-- If inserting -->
                <div class="col-md-3 facility-item" style="margin-top:10px;padding:0;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" name="value[]" placeholder="Enter Value" required="">
                        <a href="javascript:void(0)" class="btn btn-del mt-1">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-12 d-flex aic jcsb" style="padding:0;">
            <button type="submit" class="btn btn-success btn-save-facilities">
                <i class="fa fa-check"></i> Save Value's
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Show and hide tabs properly without occupying space for hidden tabs
    $('.nav-tabs a').on('click', function(e) {
        e.preventDefault();  // Prevent default action
        $(this).tab('show'); // Show the clicked tab
    });

    // Make sure the first tab is active on page load
    $('.nav-tabs a[href="#panel-1"]').tab('show');

    // Add event listeners to handle hiding/showing tab content
    $('.nav-tabs a').on('shown.bs.tab', function(e) {
        // Ensure only the active tab-pane is visible, remove display from others
        $('.tab-pane').removeClass('show active').hide(); // Hide all tab panes
        $($(e.target).attr('href')).addClass('show active').show(); // Show the clicked tab's content
    });

    // Initialize with the first tab's content shown
    $('.tab-pane').not('#panel-1').hide(); // Hide all but the first panel
});
</script>
<script>
$(document).ready(function() {
    // Handle form submission
    $('#facilities-form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        // Serialize the form data
        var formData = $(this).serialize();
        // Submit the form via AJAX
        $.ajax({
            type: $(this).attr('method'), // Use POST or PATCH based on method
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                // Handle success response
                console.log(response); // Log the response for debugging
                
                // Clear the existing saved facilities list
                $('#saved-facilities').empty();

                // Assuming response.data contains the saved facilities
                $.each(response.data, function(index, facility) {
                    $('#saved-facilities').append('<li class="list-group-item">' + facility.name + '</li>');
                });
                alert('Value saved successfully!');
            },
            error: function(xhr) {
                // Handle error response
                var errors = xhr.responseJSON.errors; // Get validation errors
                var errorMessages = '';
                $.each(errors, function(key, value) {
                    errorMessages += value[0] + '\n'; // Concatenate error messages
                });
                alert(errorMessages); // Show errors
            }
        });
    });
    
    // Function to add new facility input
    $('.btn-add-facility').click(function() {
        var newFacility = $('<div class="col-md-3 facility-item" style="margin-top:10px;padding:0;">' +
            '<div class="form-group remin" style="display: flex; align-items: center;">' +
            '<input type="text" class="form-control" name="value[]" placeholder="Enter Value" required>' +
            '<a href="javascript:void(0)" class="btn btn-del mt-1">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>');

        // Append the new facility item to the facilities wrapper
        $('.facilities-wrapper').append(newFacility);
    });
    
    // Function to remove a specific facility input
    $('.facilities-wrapper').on('click', '.btn-del', function() {
        $(this).closest('.facility-item').remove(); // Remove the specific item
    });
    
});
</script>

@stop