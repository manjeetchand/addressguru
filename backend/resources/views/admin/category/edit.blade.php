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
        <a href="#panel-1" class="nav-link active" data-bs-toggle="tab">Edit Category</a>
    </li>
    <li class="nav-item">
        <a href="#panel-2" class="nav-link" data-bs-toggle="tab">Edit Facilities</a>
    </li>
    <li class="nav-item">
        <a href="#panel-3" class="nav-link" data-bs-toggle="tab">Edit Services</a>
    </li>
     <li class="nav-item">
        <a href="#panel-4" class="nav-link" data-bs-toggle="tab">Edit Dropdown label</a>
    </li>
    <!--<li class="nav-item">-->
    <!--    <a href="#panel-4" class="nav-link" data-bs-toggle="tab">Edit Form</a>-->
    <!--</li>-->
</ul>
<div class="tab-content mt-4">
    <!-- Panel 1: Edit Category -->
    <div class="tab-pane fade show active mt-4 pt-4" id="panel-1" style="margin-top:20px;">
        <form id="category-form" action="{{route('admin-category.update',$cat->id)}}" method='POST' enctype= multipart/form-data>
			@csrf
            @method('PATCH')
			<div class="row">
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name">Name <span class="text-danger">*</span></label>
					<input type="text" name="name"  id="name" class="form-control" placeholder="Enter Category Name" value="{{ old('name',$cat->name) }}">
					@if ($errors->has('name'))
						<span class="help-block">{{ $errors->first('name') }}</span>
					@endif
				</div>
                    {{-- <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea rows="2"  id="description" class="form-control" name="description" placeholder="Enter Description">{{ old('description',$cat->description) }}</textarea>
                        @if($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                        <label for="meta_title">Meta Title </label>
                        <input type="text" name="meta_title"  id="meta_title" class="form-control" placeholder="Enter Meta Title" value="{{ old('meta_title',$cat->meta_title) }}">
                        @if ($errors->has('meta_title'))
                            <span class="help-block">{{ $errors->first('meta_title') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
                        <label for="meta_description">Meta Description</label>
                        <textarea rows="2"  id="description" class="form-control" name="meta_description" placeholder="Enter Meta Description">{{ old('meta_description',$cat->meta_description) }}</textarea>
                        @if($errors->has('meta_description'))
                            <span class="help-block">{{ $errors->first('meta_description') }}</span>
                        @endif
                    </div> --}}
				
				<div class="form-group {{ $errors->has('svg_code') ? ' has-error' : '' }}">
					<label for="svg_code">Svg Code</label>
					<textarea rows="2"  id="svg_code" class="form-control" name="svg_code" placeholder="Enter Svg Code">{{ old('svg_code',$cat->svg_code) }}</textarea>
					@if($errors->has('svg_code'))
						<span class="help-block">{{ $errors->first('svg_code') }}</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
					<label for="status">Status <span class="text-danger">*</span></label>
					<select class="form-control" name="status" id="status">
						<option value="1" Selected>Active</option>
						<option value="0" >In Active</option>
					</select>
					@if ($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
					@endif
				</div>
				<button class="btn btn-primary" type="submit">Update Category</button>
			</div>
			<div class="col-md-3">
				<div class="form-group {{ $errors->has('colors') ? ' has-error' : '' }}">
					<label id="colors">Color Code <span class="text-danger">*</span></label>
					<input type="text"  id="colors" name="colors" class="form-control" placeholder="Enter Hexa Color Code (Eg: #000) " value="{{ old('colors',$cat->colors) }}">
					@if ($errors->has('colors'))
						<span class="help-block">{{ $errors->first('colors') }}</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
					<label for="icon">Image</label>
					<input type="file" id="icon" name="icon" class="form-control" accept="image/*" onchange="previewImage(event)" value="{{$cat->icon}}">
					@if ($errors->has('icon'))
						<span class="help-block">{{ $errors->first('icon') }}</span>
					@endif
					<br/>
					<!-- Image Preview -->
					<img id="preview" src="{{asset($cat->icon)}}" alt="Image Preview" style="max-height: 150px; margin-top: 10px; border: 1px solid #ccc;border-radius: 4px; padding: 10px;" />
				</div>
			</div>
		    </div>
		</form>
    </div>
    <!-- Panel 2: Edit Facilities -->
    <div class="tab-pane fade mt-4 pt-4" id="panel-2" style="margin-top:20px;">
    <div class="col-md-12 mb-30">
        <a href="javascript:void(0)" class="btn btn-primary btn-add-facility">
            <i class="fa fa-plus"></i> Add Facility
        </a>
         {!! Form::model($cat ?? null, [
            'action' => isset($cat->facilities) ? ['CategoryControl@facilities', $cat->id] : ['CategoryControl@facilities'],
            'method' => isset($cat->facilities) ? 'PATCH' : 'POST',
            'id' => 'facilities-form'
        ]) !!}
        <input name="category_id" type="hidden" value="{{$cat->id}}">
        <div class="facilities-wrapper">
             @if(isset($cat) && $cat->facilities && $cat->facilities->count())
            @foreach($cat->facilities as $facility)<!-- Loop through existing facilities -->
                    <div class="col-md-3 facility-item" style="margin-top:10px;padding:0;">
                        <div class="form-group remin" style="display: flex; align-items: center;">
                            <input type="text" class="form-control" name="facilities[]" value="{{ $facility->name }}" required="">
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
                        <input type="text" class="form-control" name="facilities[]" placeholder="Enter Facility" required="">
                        <a href="javascript:void(0)" class="btn btn-del mt-1">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-12 d-flex aic jcsb" style="padding:0;">
            <button type="submit" class="btn btn-success btn-save-facilities">
                <i class="fa fa-check"></i> Save Facilities
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
    <!-- Panel 3: Edit Services -->
    <div class="tab-pane fade mt-4 pt-4" id="panel-3" style="margin-top:20px;">
        <div class="col-md-12 mb-30">
            <a href="javascript:void(0)" class="btn btn-primary btn-add-service">
                <i class="fa fa-plus"></i> Add Service
            </a>
            {!! Form::model($cat ?? null, [
                'action' => isset($cat->services) ? ['CategoryControl@services', $cat->id] : ['CategoryControl@services'],
                'method' => isset($cat->services) ? 'PATCH' : 'POST',
                'id' => 'services-form'
            ]) !!}
            <input name="category_id" type="hidden" value="{{$cat->id}}">
            <div class="services-wrapper">
            @if(isset($cat) && $cat->services && $cat->services->count())
                @foreach($cat->services as $service)
                    <div class="col-md-3 service-item" style="margin-top:10px;padding:0;">
                        <div class="form-group remin" style="display: flex; align-items: center;">
                            <input type="text" class="form-control" name="services[]" value="{{ $service->name }}" required>
                            <a href="javascript:void(0)" class="btn btn-del mt-1">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-3 service-item" style="margin-top:10px;padding:0;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" name="services[]" placeholder="Enter Service" required>
                        <a href="javascript:void(0)" class="btn btn-del mt-1">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            @endif
            </div>
            <div class="col-md-12 d-flex aic jcsb" style="padding:0;">
                <button type="submit" class="btn btn-success btn-save-services">
                    <i class="fa fa-check"></i> Save Services
                </button>
            </div>
            {!! Form::close() !!}
        </div>
</div>
    <!-- Panel 4: Edit Form -->
 <div class="tab-pane fade mt-4 pt-4" id="panel-4" style="margin-top:20px;">
        <div class="col-md-12 mb-30">
                      <a href="{{route('childSubCategoryList',['id'=> $cat->id,'status'=>1])}}" class="btn btn-primary  pull-left" style="margin-right:10px;">Dropdown</a>
            <a href="javascript:void(0)" class="btn btn-primary btn-add-dropdown">
                <i class="fa fa-plus"></i> Add Dropdwon Label
            </a>
            {!! Form::model($cat ?? null, [
                'action' => isset($cat->childcategory) ? ['AdminSubCategory@childSubCategory', $cat->id] : ['AdminSubCategory@childSubCategory'],
                'method' => isset($cat->childcategory) ? 'PATCH' : 'POST',
                'id' => 'dropdown-form'
            ]) !!}
               <input name="category_id" type="hidden" value="{{$cat->id}}">
                <div class="form-wrapper">
                    @if(isset($cat) && $cat->childcategory && $cat->childcategory->count())
                        @foreach($cat->childcategory as $category)
                            <div class="col-md-3 dropdown-item" style="margin-top:10px;padding:0;">
                                <div class="form-group remin" style="display: flex; align-items: center;">
                                    <input type="text" class="form-control" name="dropdown[]" value="{{ $category->label }}" required>
                                    <a href="javascript:void(0)" class="btn btn-del mt-1">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-3 dropdown-item" style="margin-top:10px;padding:0;">
                            <div class="form-group remin" style="display: flex; align-items: center;">
                                <input type="text" class="form-control" name="dropdown[]" placeholder="Enter Dropdown Name" required>
                                <a href="javascript:void(0)" class="btn btn-del mt-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 d-flex aic jcsb" style="padding:0;">
                    <button type="submit" class="btn btn-success btn-save-services">
                        <i class="fa fa-check"></i> Save Dropdown Label
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
</div>
    <!-- Panel 4: Edit Form -->
{{--  <div class="tab-pane fade mt-4 pt-4" id="panel-4" style="margin-top:20px;">
        <div class="col-md-12 mb-30">
         {!! Form::model($cat, ['action' => ['CategoryForm@update', $cat->id], 'method' => 'PATCH']) !!}
            @if(isset($cat) && $cat->forms && $cat->forms->count())
                @foreach($cat->forms as $form)
                    <div class="form-wrapper row">
                        <input name="category_id" type="hidden" value="{{$cat->id}}">
                         Column label, name, and placeholder fields here... 
                         <input name="category_id" type="hidden" value="{{$cat->id}}">
                                        <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                                            <div class="form-group remin" style="display: flex; align-items: center;">
                                                <input type="text" class="form-control" name="column_label[]" placeholder="Enter Column Label"  value="{{$form->column_label}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                                            <div class="form-group remin" style="display: flex; align-items: center;">
                                                <input type="text" class="form-control" name="column_name[]" placeholder="Enter Column Name"  value="{{$form->column_name}}"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                                            <div class="form-group remin" style="display: flex; align-items: center;">
                                                <input type="text" class="form-control" name="column_placeholder[]" placeholder="Enter Column Place Holder" value="{{$form->column_placeholder}}"   required>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                                <div class="form-group remin" style="display: flex; align-items: center;">
                                    <select class="form-control column-type" name="column_type[]" required>
                                        <option value="" selected disabled>Select an input field</option>
                                        <option value="button" @if($form->column_type == 'button') selected @endif>Button</option>
                                        <option value="checkbox" @if($form->column_type == 'checkbox') selected @endif>Checkbox</option>
                                        <option value="date" @if($form->column_type == 'date') selected @endif>Date</option>
                                        <option value="datetime-local" @if($form->column_type == 'datetime-local') selected @endif>Date and Time</option>
                                        <option value="email" @if($form->column_type == 'email') selected @endif>Email</option>
                                        <option value="file" @if($form->column_type == 'file') selected @endif>File</option>
                                        <option value="hidden" @if($form->column_type == 'hidden') selected @endif>Hidden</option>
                                        <option value="image" @if($form->column_type == 'image') selected @endif>Image</option>
                                        <option value="month" @if($form->column_type == 'month') selected @endif>Month</option>
                                        <option value="number" @if($form->column_type == 'number') selected @endif>Number</option>
                                        <option value="password" @if($form->column_type == 'password') selected @endif>Password</option>
                                        <option value="radio" @if($form->column_type == 'radio') selected @endif>Radio</option>
                                        <option value="text" @if($form->column_type == 'text') selected @endif>Text</option>
                                        <option value="time" @if($form->column_type == 'time') selected @endif>Time</option>
                                        <option value="url" @if($form->column_type == 'url') selected @endif>URL</option>
                                        <option value="week" @if($form->column_type == 'week') selected @endif>Week</option>
                                        <option value="select" @if($form->column_type == 'select') selected @endif>Select</option>
                                        <option value="textarea" @if($form->column_type == 'textarea') selected @endif>Textarea</option>
                                    </select>
                                </div>
                            </div>
                         Column Value Section 
                        <div class="col-md-2 form-item value-section" style="margin-top:10px;padding:0;margin-right:5px;">
                            <button type="button" class="btn btn-primary add-value-btn" style="margin-left: 10px;">Add Value</button>
                        </div>
                         Clone/Delete buttons 
                        <div class="col-md-1 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                            <button type="button" class="btn btn-success clone-btn">+</button>
                            <button type="button" class="btn btn-danger delete-btn">-</button>
                        </div>
    </div>
                @endforeach
            @else
                <div class="form-wrapper row">
                    <input name="category_id" type="hidden" value="{{$cat->id}}">
                <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" name="column_label[]" placeholder="Enter Column Label" required>
                    </div>
                </div>
                <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" name="column_name[]" placeholder="Enter Column Name" required>
                    </div>
                </div>
                <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control" name="column_placeholder[]" placeholder="Enter Column Place Holder" required>
                    </div>
                </div>
                <div class="col-md-2 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <select class="form-control column-type" name="column_type[]" required>
                            <option value="" selected disabled>Select an input field</option>
                            <option value="button">Button</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="date">Date</option>
                            <option value="datetime-local">Date and Time</option>
                            <option value="email">Email</option>
                            <option value="file">File</option>
                            <option value="hidden">Hidden</option>
                            <option value="image">Image</option>
                            <option value="month">Month</option>
                            <option value="number">Number</option>
                            <option value="password">Password</option>
                            <option value="radio">Radio</option>
                            <option value="text">Text</option>
                            <option value="time">Time</option>
                            <option value="url">URL</option>
                            <option value="week">Week</option>
                            <option value="select">Select</option>
                            <option value="textarea">Textarea</option>
                        </select>
                    </div>
                </div>
                 Column Value Section 
                <div class="col-md-2 form-item value-section" style="margin-top:10px;padding:0;margin-right:5px;">
                    <div class="form-group remin" style="display: flex; align-items: center;">
                        <input type="text" class="form-control column-value" name="column_value[]" placeholder="Enter Value">
                        <button type="button" class="btn btn-primary add-value-btn" style="display:none; margin-left: 10px;">Add Value</button>
                    </div>
                </div>
                 Clone/Delete buttons 
                <div class="col-md-1 form-item" style="margin-top:10px;padding:0;margin-right:5px;">
                    <button type="button" class="btn btn-success clone-btn">+</button>
                    <button type="button" class="btn btn-danger delete-btn">-</button>
                </div>
            </div>
            @endif
                <div class="col-md-12 d-flex aic jcsb" style="padding:0;">
                    <button type="submit" class="btn btn-success btn-save-services">
                        <i class="fa fa-check"></i> Save Form
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
</div>--}}
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// $(document).ready(function() {
//     let wrapperIndex = 0; // This should represent the number of existing wrappers
//     // Function to handle changes in column type (for showing/hiding Add Value button)
//     $(document).on('change', '.column-type', function() {
//         let selectedValue = $(this).val();
//         let addValueButton = $(this).closest('.form-wrapper').find('.add-value-btn');
//         // Show "Add Value" button for select, checkbox, radio
//         if (selectedValue === 'select' || selectedValue === 'checkbox' || selectedValue === 'radio') {
//             addValueButton.show();
//         } else {
//             addValueButton.hide();  // Hide "Add Value" button for other types
//         }
//     });
//     // Clone functionality
//     $(document).on('click', '.clone-btn', function() {
//         wrapperIndex++; // Increment wrapper index for each clone
//         let formWrapper = $(this).closest('.form-wrapper').clone();
//         // Clear input values and reset names with new wrapper index
//         formWrapper.find('input').val('');  // Clear input fields
//         formWrapper.find('select').val('');  // Reset select fields
//         // Update names for new cloned wrapper
//         formWrapper.find('.column-value').attr('name', `column_value[${wrapperIndex}][]`);  // Reset column_value index
//         formWrapper.find('.additional-values').remove();  // Remove any additional values from clone
//         // Reset the column-type dropdown to hide "Add Value" button
//         formWrapper.find('.add-value-btn').hide();
//         // Insert the cloned form wrapper
//         formWrapper.insertAfter($(this).closest('.form-wrapper'));
//     });
//     // Delete functionality
//     $(document).on('click', '.delete-btn', function() {
//         if ($('.form-wrapper').length > 1) {
//             $(this).closest('.form-wrapper').remove();
//         } else {
//             alert('At least one form section must remain.');
//         }
//     });
//     // Add Value functionality for multi-value fields
//     $(document).on('click', '.add-value-btn', function() {
//         let currentWrapper = $(this).closest('.form-wrapper');
//         let currentWrapperIndex = currentWrapper.index(); // Get the index of the current wrapper
//         let valueSection = currentWrapper.find('.value-section');
//         // Create new value field with correct index
//         let newValueField = `
//             <div class="form-group additional-values" style="display: flex; align-items: center; margin-top: 10px;">
//                 <input type="text" class="form-control" name="column_value[${currentWrapperIndex}][]" placeholder="Enter Value">
//                 <button type="button" class="btn btn-danger remove-value-btn" style="margin-left: 10px;">Remove</button>
//             </div>`;
//         valueSection.append(newValueField);
//     });
//     // Remove additional value field
//     $(document).on('click', '.remove-value-btn', function() {
//         $(this).closest('.additional-values').remove();
//     });
// });
$(document).ready(function() {
    let wrapperIndex = 0; // This should represent the number of existing wrappers
    // Function to handle changes in column type (for showing/hiding Add Value button)
    $(document).on('change', '.column-type', function() {
        let selectedValue = $(this).val();
        let addValueButton = $(this).closest('.form-wrapper').find('.add-value-btn');
        // Show "Add Value" button for select, checkbox, radio
        if (selectedValue === 'select' || selectedValue === 'checkbox' || selectedValue === 'radio') {
            addValueButton.show();
        } else {
            addValueButton.hide();  // Hide "Add Value" button for other types
        }
    });
    // Clone functionality
    $(document).on('click', '.clone-btn', function() {
        let formWrapper = $(this).closest('.form-wrapper').clone();
        // Clear input values and reset names with new wrapper index
        formWrapper.find('input').val('');  // Clear input fields
        formWrapper.find('select').val('');  // Reset select fields
        // Update names for new cloned wrapper
        formWrapper.find('.column-value').attr('name', `column_value[${wrapperIndex}][]`);  // Reset column_value index
        // Reset the column-type dropdown to hide "Add Value" button
        formWrapper.find('.add-value-btn').hide();
        // Insert the cloned form wrapper
        formWrapper.insertAfter($(this).closest('.form-wrapper'));
        wrapperIndex++; // Increment wrapper index after inserting
    });
    // Delete functionality
    $(document).on('click', '.delete-btn', function() {
        if ($('.form-wrapper').length > 1) {
            $(this).closest('.form-wrapper').remove();
        } else {
            alert('At least one form section must remain.');
        }
    });
    // Add Value functionality for multi-value fields
    $(document).on('click', '.add-value-btn', function() {
        let currentWrapper = $(this).closest('.form-wrapper');
        let currentWrapperIndex = currentWrapper.index(); // Get the index of the current wrapper
        let valueSection = currentWrapper.find('.value-section');
        // Create new value field with correct index
        let newValueField = `
            <div class="form-group additional-values" style="display: flex; align-items: center; margin-top: 10px;">
                <input type="text" class="form-control" name="column_value[${currentWrapperIndex}][]" placeholder="Enter Value">
                <button type="button" class="btn btn-danger remove-value-btn" style="margin-left: 10px;">Remove</button>
            </div>`;
        valueSection.append(newValueField);
    });
    // Remove additional value field
    $(document).on('click', '.remove-value-btn', function() {
        $(this).closest('.additional-values').remove();
    });
});
</script>
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
                alert('Facilities saved successfully!');
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
     $('#services-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                // swal("Success", response.success, "success");
                 alert('Service saved successfully!');// Show success message
                // Optionally, refresh data or append new service inputs
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors; // Get validation errors
                var errorMessages = '';
                $.each(errors, function(key, value) {
                    errorMessages += value[0] + '\n'; // Concatenate error messages
                });
                swal("Error", errorMessages, "error"); // Show errors
            }
        });
    });
      $('#dropdown-form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        // Serialize the form data
        var formData = $(this).serialize();
        // Submit the form via AJAX
        $.ajax({
            type: $(this).attr('method'), // Use POST or PATCH based on method
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                alert('Dropdown saved successfully!');
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
            '<input type="text" class="form-control" name="facilities[]" placeholder="Enter Facility" required>' +
            '<a href="javascript:void(0)" class="btn btn-del mt-1">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>');
        // Append the new facility item to the facilities wrapper
        $('.facilities-wrapper').append(newFacility);
    });
     $('.btn-add-service').click(function() {
        var newService = $('<div class="col-md-3 service-item" style="margin-top:10px;padding:0;">' +
            '<div class="form-group remin" style="display: flex; align-items: center;">' +
            '<input type="text" class="form-control" name="services[]" placeholder="Enter Service" required>' +
            '<a href="javascript:void(0)" class="btn btn-del mt-1">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>');
        $('.services-wrapper').append(newService);
    });
    $('.btn-add-dropdown').click(function() {
        var newDropdown = $('<div class="col-md-3 dropdown-item" style="margin-top:10px;padding:0;">' +
            '<div class="form-group remin" style="display: flex; align-items: center;">' +
            '<input type="text" class="form-control" name="dropdown[]" placeholder="Enter Dropdown Label" required>' +
            '<a href="javascript:void(0)" class="btn btn-del mt-1">' +
            '<i class="fa fa-trash"></i>' +
            '</a>' +
            '</div>' +
            '</div>');
        $('.form-wrapper').append(newDropdown);
    });
    // Function to remove a specific facility input
    $('.facilities-wrapper').on('click', '.btn-del', function() {
        $(this).closest('.facility-item').remove(); // Remove the specific item
    });
     $('.services-wrapper').on('click', '.btn-del', function() {
        $(this).closest('.service-item').remove(); // Remove the specific item
    });
     $('.form-wrapper').on('click', '.btn-del', function() {
        $(this).closest('.dropdown-item').remove(); // Remove the specific item
    });
});
</script>
@stop