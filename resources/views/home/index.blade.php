@extends ('layouts.app')

@section ('content')
<table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Parent Age</th>
                  <th>Child Age</th>
                  <th>City</th>
                  <th></th>
                </tr>
                </thead>
                
                @php
                $lat = Auth::user()->lat;
                $lng = Auth::user()->lng;
                $radius = 100;
                $users = DB::select(DB::raw("SELECT*,
                ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( `lat` ) ) ) ) AS distance
                FROM `users` AS u
                where u.lng AND u.lat
                HAVING distance <= {$radius}
                ORDER BY distance ASC"));          
                @endphp

              @foreach($users as $user)
                  <tr>
                    <td>
                      @if($user->userPicture)
                        <img src= "data:{{Auth::user()->userPictureType}};base64,{{Auth::user()->userPicture}}" height="100" width="100">
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
@endsection