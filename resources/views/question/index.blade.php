@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row"><br>
		@if(count($data) > 0)
			@foreach($data as $value)
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<p>Written By {{$value->last_name.' '.$value->first_name.' on '. Carbon\Carbon::parse($value->created_at)->format('d-m-Y i') }}	</p>
						</div>
						<div class="panel-body">
							<h3 style="margin:0;padding:0"><a style="btn btn-link" href="/question/{{$value->id}}">{{$value->question_txt}}</a></h3>
						</div>
					</div>
				</div>
			@endforeach
			{{$data->links()}}
		@else
			<p>No Question found.</p>
		@endif
	</div>
</div>
@endsection