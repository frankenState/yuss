@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row"><br>
		@if(count($questions) > 0)
			@foreach($questions as $q)
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<p>Written By {{$q->last_name.' '.$q->first_name.' on '. Carbon\Carbon::parse($q->created_at)->format('d-m-Y i') }}	</p>
						</div>
						<div class="panel-body" style="text-align:center">
							<img src="/storage/question_pics/{{$q->question_pic}}" height="70%" width="60%"><hr>
							<h3 style="margin:0;padding:0">{{$q->question_txt}}</h3>
						</div>
						<div class="panel-footer">
							<p style="margin:0;padding:0">Comments</p>
							<hr style="color:red">
							<!-- Comment area -->
							@if(count($comments) > 0)
								@foreach($comments as $comment)
									<div class="panel panel-success">
										<div class="panel-heading">
											<small>By {{$comment->last_name.', '.$comment->first_name}} written on {{$comment->created_at}}</small>
											@if($id == $comment->user_id)
											<a href="/{{$q->id}}/comment/{{$comment->id}}/delete" class="btn btn-danger pull-right btn-xs">Delete</a>
											@endif
										</div>
										<div class="panel-body">
											<p>{{$comment->comment_txt}}</p>
										</div>
									</div>
								@endforeach
							@endif
							<form action="{{ url('/comment/'.$q->id) }}">
								{{ csrf_field() }}
								<div class="form-group">
								
<textarea class="form-control" placeholder="Comment..." name="comment_txt"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			@endforeach
		@else
			<p>No Question found.</p>
		@endif
	</div>
</div>
@endsection