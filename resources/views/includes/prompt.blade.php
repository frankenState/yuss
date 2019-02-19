@if(count($errors) > 0)
<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Error!</strong>
	<ul>
	@foreach($errors->all() as $error)
	 	<li>{!!$error!!}</li>
	@endforeach
	</ul>
</div>
@endif

@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		{{session('error')}}
	</div>
@endif