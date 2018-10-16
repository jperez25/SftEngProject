@extends ('layouts.app')


@section('content')
@if($user->userPicture)
    <img src= "data:{{$user->userPictureType}};base64,{{Auth::user()->userPicture}}" height="100" width="100">
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
@endsection