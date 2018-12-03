@extends('layouts.app')

@section('content')

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
          <a href="/profile/{{$user->id}}"><button type="button" class="btn btn-success">View Profile</button></a>
          <a href="#myModal" class="btn btn-danger trigger-btn" data-toggle="modal">Delete Friend</a>

          
        </div>
      </div>
    </div>
  @endforeach

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>				
				<h4 class="modal-title">Are you sure?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete this friend? This process cannot be undone.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
        <a href="/deleteFriendReq/{{$user->id}}"><button type="button" class="btn btn-danger">Unfriend</button></a>
			</div>
		</div>
	</div>
</div>     

</div>
@endsection