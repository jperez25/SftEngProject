@extends ('layouts.app')

@section ('content')
<table class="table table-striped table-sm">
              <thead>
                 <form method="post" action="{{ action('HomeController@search') }}">
                  {{ csrf_field() }}
                <div>
                  <p>Radius for PlayDates</p>  
                  <input type="range" min="1" max="100" value="50" id="radius" name="radius">
                  <p>Radius: <span id="value"></span></p>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </form>
                </div>
                </div>
                </div>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Parent Age</th>
                  <th>Child Age</th>
                  <th>City</th>
                  <th></th>
                </tr>
                </thead>
                
                

              @foreach($users as $user)
                  <tr>
                    <td>
                      @if($user->userPicture)
                        <img src= "data:{{Auth::user()->user_picture_type}};base64,{{Auth::user()->user_picture}}" height="100" width="100">
                      @else
                          <img src="{{ URL::to('/') }}/images/blankProfile.png" height="100" width="100">
                      @endif
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->parent_age}}</td>
                    <td>{{$user->child_age}}</td>
                    <td>{{$user->city}}</td>
                    <td>
                      <a href="/profile/{{$user->id}}"><button type="button" class="btn btn-success">View Profile</button></a>
                      <a href="friendrequest/{{$user->id}}"><button type="button" class="btn btn-success">Add friend</button></a>
                    
                    </td>
                  </tr>
              @endforeach

              </tbody>
            </table>
<script>
var slider = document.getElementById("radius");
var output = document.getElementById("value");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>

@endsection