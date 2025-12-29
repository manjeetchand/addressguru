@if($data == 2)

	@include('admin.forms.form5')
  
@elseif($data == 0)  
	
	<h1>Nothing to show</h1>
 		
@elseif($data == 1)  
	
	@include('admin.forms.form1')
	
@endif