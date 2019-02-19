@extends('layouts.app')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-primary" style="margin-top:2%">
		<div class="panel-heading">
			<h2 style="margin:0;padding:0">Ask a question</h2>
		</div>
		<div class="panel-body">

			<form class="form-horizontal" action="{{ url('/question') }}" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
			  <div class="form-group">
			    <label for="question_txt" class="col-sm-2 control-label">Question :</label>
			    <div class="col-sm-10">
<textarea placeholder="Your question..." name="question_txt" class="form-control"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <input type="file" name="question_pic">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Submit</button>
			      <a href="/home" class="btn btn-default">Cancel</a>
			    </div>
			  </div>
			</form>

		</div>
	</div>
</div>
@endsection