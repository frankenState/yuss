@extends('layouts.app')

@section('content')
<div class="container">
	<br>
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 style="padding:0;margin:0">Chat Room</h1>
			</div>
			<div class="panel-body" id="message_target" style="overflow-x: scroll;height:390px">
			<!-- messages area -->
			
			</div>
			<div class="panel-footer">
				<form action="{{ url('/sent') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
<textarea class="form-control" placeholder="Message ..." name="message_txt"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	document.onload=start();
	function start(){
		refreshData();
		setInterval(refreshData, 3000);
	}

	function refreshData(){
		$.get("{{URL::to('/rqst-msgs')}}", function(data){
			$('#message_target').html(data);
		});
	}
</script>
@endsection