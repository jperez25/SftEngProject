@extends ('layouts.app')


@section('content')
<!--img src= "data:image/jpeg;base64,-->

<div>Picture <img src="data:image/png;base64,' . {{Auth::user()->userPicture}} . '"></div>
<div>Name: {{Auth::user()->name}}</div>
<div>Bio: {{Auth::user()->bio}}</div>
<div>Child Bio: {{Auth::user()->child_bio}}</div>
<div>Parent Age: {{Auth::user()->parent_age}}</div>
<div>Child Age: {{Auth::user()->child_age}}</div>
<div>City: {{Auth::user()->city}}</div>
<div>State: {{Auth::user()->state}}</div>
<a href="profile/edit"><button type="submit" class="btn btn-primary">Edit</button></a>
  
@endsection