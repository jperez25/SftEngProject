@extends ('layouts.app')

@section ('content')

<form method="post" action="{{ action('HomeController@search') }}">
  {{ csrf_field() }}
  <div class="slidecontainer">
    <p>Radius for PlayDates</p>  
    <input type="range" min="1" max="100" value="{{$radius}}" id="radius" name="radius" class="slider">
    <p>Radius: <span id="value"></span></p>
  </div>
  <div>
    <button type="submit" class="btn btn-primary">Search</button>
  </div>
</form>


<div class='row' style = "padding: 5%">
  @foreach($users as $user)
    <div class='col-sm-4'>
      <div class="card" style="width: 18rem; padding-bottom: 2em">
        @if($user->user_picture)
            <img class="card-img-top" src="data:{{$user->user_picture_type}};base64,{{$user->user_picture}}" height="100" width="100" alt="Card image cap">
        @else
            <img class="card-img-top" src="{{ URL::to('/') }}/images/blankProfile.png" height="100" width="100" alt="Card image cap">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{$user->name}}</h5>
          <div class = "cad-text scroll">
              {{$user->bio}}
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Age: {{$user->parent_age}}</li>
          <li class="list-group-item">Child age: {{$user->child_age}}</li>
          <li class="list-group-item">City: {{$user->city}}, {{$user->state}}</li>
        </ul>
        <div class="card-body">
          <a href="/profile/{{$user->id}}"><button type="button" class="btn btn-primary">View Profile</button></a>
          <a href="friendrequest/{{$user->id}}" id="addFriendBtn"><button type="button" class="btn btn-primary">Add friend</button></a>
          @foreach($friends as $friend)                      
            @if(in_array($user->id,(array)$friend, true))
              @if($user->id == $friend->user2_id and $friend->accepted == 0)
                <a href="#" id="pendingBtn"><button type="button" class="btn btn-primary">Pending</button></a>
                @break
              @elseif($user->id == $friend->user2_id and $friend->accepted == 1)
                <a href="#" id="pendingBtn"><button type="button" class="btn btn-success">You are friends</button></a>
                @break
              @endif
            @else
                                        
            @endif
          @endforeach
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection