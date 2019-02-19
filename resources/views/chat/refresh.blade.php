@if(count($data) > 0)
	@foreach($data as $v)
	<div class="panel panel-primary" style="margin:5px 0 0 0;">
		<div class="panel-heading">
			<p style="margin:0;padding:0">Written by {{$v->last_name.', '.$v->first_name}} on {{$v->created_at}}</p>
		</div>
		<div class="panel-body">
			<p style="margin:0;padding:0;text-align:right"><small>{{$v->message_txt}}</small></p>
		</div>
	</div>
	@endforeach
@else
	<p>No Message found.</p>
@endif