@extends ('layouts.app')


@section ('content')
@if(Auth::user()->level == 2)
<h3>Flagged Users</h3>
<table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Comment</th>
                  <th></th>
                </tr>
                </thead>
              @foreach($users as $user)
                  <tr>
                    <td></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->parent_age}}</td>
                    <td><a href="/profile/{{$user->id}}"><button type="button" class="btn btn-success">View Profile</button></a></td>
                    <td></td>
                  </tr>
              @endforeach
</table>
@else
    <h4>No admin rights</h4>
@endif
@endsection