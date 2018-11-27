@extends ('layouts.app')


@section('content')
@if($user->user_picture)
    <img src= "data:{{$user->user_picture_type}};base64,{{$user->user_picture}}" height="100" width="100">
@else
    <img src="{{ URL::to('/') }}/images/blankProfile.png" height="100" width="100">
@endif
<div>Name: {{$user->name}}</div>
<div>Bio: {{$user->bio}}</div>
<div>Child Bio: {{$user->child_bio}}</div>
<div>Parent Age: {{$user->parent_age}}</div>
<div>Child Age: {{$user->child_age}}</div>
<div>City: {{$user->city}}</div>
<div>State: {{$user->state}}</div>
 {{Form::open(array('action' => array('ProfileController@update', $user->id), 'method' => 'PATCH'))}}
  {{ csrf_field() }}
 <input type="hidden" value = "{{$user->id}}" id = "id" name = "id">
 <input type="hidden" value = "flag" id = "flag" name = "flag">
<button type="submit" class="btn btn-primary">Report User</button>
{{Form::close()}}
@if(Auth::user()->level == 2)
	<br />
	<br />
	{!! Form::model($user, ['method' => 'DELETE','route' => ['profile.destroy', $user->id]]) !!}
	{{ csrf_field() }}
                      <button type="submit" class="btn btn-danger">Ban User</button>
     {{Form::close()}}
	@if($user->flag == 1)
	 {{Form::open(array('action' => array('ProfileController@update', $user->id), 'method' => 'PATCH'))}}
  	 {{ csrf_field() }}
 		<input type="hidden" value = "{{$user->id}}" id = "id" name = "id">
 		<input type="hidden" value = "unflag" id = "unflag" name = "unflag">
		<button type="submit" class="btn btn-primary">Unflag User</button>
	{{Form::close()}}
	@endif
@endif	
@endsection