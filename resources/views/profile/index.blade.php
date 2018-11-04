@extends ('layouts.app')


@section('content')
@if(Auth::user()->user_picture)
    <img src= "data:{{Auth::user()->user_picture_type}};base64,{{Auth::user()->user_picture}}" height="100" width="100">
@else
    <img src="{{ URL::to('/') }}/images/blankProfile.png" height="100" width="100">
@endif
<div>Name: {{Auth::user()->name}}</div>
<div>Bio: {{Auth::user()->bio}}</div>
<div>Child Bio: {{Auth::user()->child_bio}}</div>
<div>Parent Age: {{Auth::user()->parent_age}}</div>
<div>Child Age: {{Auth::user()->child_age}}</div>
<div>City: {{Auth::user()->city}}</div>
<div>State: {{Auth::user()->state}}</div>
<a href="profile/edit"><button type="submit" class="btn btn-primary">Edit</button></a>
  
@endsection