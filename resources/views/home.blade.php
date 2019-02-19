
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3" style="text-align:center;background-color:#f3f3f3">
            <img src="storage/profile_pictures/{{$user->profile_picture}}" width="50%" height="50%" class="img-rounded" alt="profile_picture" style="padding:7% 0 10% 0;">

            <table class="table table-striped" style="text-align:right;padding:10% 0 10% 0">
            	<tr>
            		<td>First Name:</td>
            		<td>{{$user->first_name}}</td>
            	</tr>
            	<tr>
            		<td>Last Name:</td>
            		<td>{{$user->last_name}}</td>
            	</tr>
            	<tr>
            		<td>Email:</td>
            		<td>{{$user->email}}</td>
            	</tr>
            </table>
            <a href="/user/update" class="btn btn-primary" style="margin-bottom: 10%">Update</a>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default" style="margin-right:1%;margin-top:2%">
                <div class="panel-heading">
                    <h1>Question <a href="/question/create" class="btn btn-default pull-right">Ask a question</a></h1>
                </div>
                <div class="panel-body">
                     @if(count($questions) > 0)
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>{{count($questions)}} question/s found.</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $v)
                            <tr>
                                <td>{{$v->question_txt}}</td>
                                <td></td>
                                <td>
                                    
                                    <form action="{{url('/question/destroy/' . $v->id)}}" method="POST" class="pull-left">
                                        {{csrf_field()}}
                                        <input type="hidden" _method="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>    
                                    <a  style="margin-left:2%" href="/question/{{$v->id}}/edit" class="btn btn-primary">Edit</a>     
                                </td> 
                            </tr>
                            @endforeach
                            
                          
                        </tbody>
                    </table>
                     @else
                        <p>No Question found.</p>
                     @endif
                     
                        
                </div>
            </div>
        </div>
    </div>
@endsection
