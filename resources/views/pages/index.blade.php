@extends('layouts.app')

@section('content')
<div id="indexcarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#indexcarousel" data-slide-to="0" class="active"></li>
    <li data-target="#indexcarousel" data-slide-to="1"></li>
    <li data-target="#indexcarousel" data-slide-to="2"></li>
     <li data-target="#indexcarousel" data-slide-to="3"></li>
      <li data-target="#indexcarousel" data-slide-to="4"></li>
  </ol>

  <!-- wrapper for slides -->
  <div class="carousel-inner">
     <div class="item active">
      <img src="{{ asset('c_img/1.jpg') }}" alt="Chania">
      <div class="carousel-caption">
        <h3>Frank Lou A. Ubay</h3>
        <p>Enjoying the game of life.</p>
      </div>
    </div>

    <div class="item">
      <img src="{{ asset('c_img/2.jpg') }}" alt="Chicago">
      <div class="carousel-caption">
        <h3>Arth Cris M. Yuson</h3>
        <p>Reaching beyond barriers.</p>
      </div>
    </div>

    <div class="item">
      <img src="{{ asset('c_img/3.jpg') }}" alt="Chicago">
      <div class="carousel-caption">
        <h3>Ariz Jay P. Satinitigan</h3>
        <p>Calcium makes your bones stronger.</p>
      </div>
    </div>

    <div class="item">
      <img src="{{ asset('c_img/4.jpg') }}" alt="Chicago">
      <div class="carousel-caption">
        <h3>Louis Andrew A. Suelto</h3>
        <p>Need for Speed</p>
      </div>
    </div>

    <div class="item">
      <img src="{{ asset('c_img/5.jpg') }}" alt="Chicago">
      <div class="carousel-caption">
        <h3>Cooperation and Coordination</h3>
        <p>YUSS.com is a social networking site that allows you to post your question pertaining to IT related topics.</p>
      </div>
    </div>
  </div>

    <!-- Left and right controls -->
  <a class="left carousel-control" href="#indexcarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#indexcarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="row" style="text-align: center;margin: 10px 7% 0 7%" >
	<div class="col-md-6">
		<div class="thumbnail">
		  <a href="/">
		    <img src="{{ asset('c_img/6.png') }}" alt="Lights" style="width:100%">
		    <div class="caption">
		      <p>Post your question</p>
		    </div>
		  </a>
		</div>
	</div>
	<div class="col-md-6">
		<div class="thumbnail">
		  <a href="/">
		    <img src="{{ asset('c_img/7.jpg') }}" alt="Lights" style="width:100%">
		    <div class="caption">
		      <p>Answer a question</p>
		    </div>
		  </a>
		</div>
	</div>
</div>

@endsection