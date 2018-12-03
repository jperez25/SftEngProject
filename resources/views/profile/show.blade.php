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
<br />
<div class='row'>
	<div class="col-sm-2">
		<a href="/ratings/{{$user->id}}"><button type="button" class="btn btn-primary">View Users Ratings</button></a>
	</div>

	<div class="col-sm-2">
		@if(!Auth::user()->isReqSent($user->id))
			<a href="friendrequest/{{$user->id}}" id="addFriendBtn"><button type="button" class="btn btn-primary">Add friend</button></a>
		@endif

		@if(Auth::user()->isFriend($user->id) == 0)
			<label for="Pending" class="btn btn-warning">Pending</label>
		@else
			<label for="Pending" class="btn btn-success">You are friends</label>
		@endif
	</div>
</div>

<br />
 {{Form::open(array('action' => array('ProfileController@update', $user->id), 'method' => 'PATCH', 'id' => 'report_user_form'), array('id' => 'report_user_form'))}}
  {{ csrf_field() }}
 <input type="hidden" value = "{{$user->id}}" id = "id" name = "id">
 <input type="hidden" value = "flag" id = "flag" name = "flag">

 <div class='row'>
	<div class="col-sm-6">
		<a href="#myModal" class="btn btn-danger trigger-btn" data-toggle="modal">Report User</a>
	</div>
</div>
{{Form::close()}}


@if(Auth::user()->level == 2)
	<br />
	{!! Form::model($user, ['method' => 'DELETE','route' => ['profile.destroy', $user->id]]) !!}
		{{ csrf_field() }}
		<div class='row'>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-danger">Ban User</button>
			</div>
		</div>
	{{Form::close()}}

	<br />
	 
	@if($user->flag == 1)
		{{Form::open(array('action' => array('ProfileController@update', $user->id), 'method' => 'PATCH'))}}
			{{ csrf_field() }}
			<input type="hidden" value = "{{$user->id}}" id = "id" name = "id">
			<input type="hidden" value = "unflag" id = "unflag" name = "unflag">
			<div class='row'>
				<div class="col-sm-6">
					<button type="submit" class="btn btn-primary">Unflag User</button>
				</div>
			</div>
		{{Form::close()}}
	@endif
@endif	

<script>
	function report_user() {
		var form = document.getElementById("report_user_form");
		console.log(form);
  		form.submit();
	}
</script>

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
				<p>Do you really want to report this user?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" id="confirm" onclick=report_user()>Report</button>
			</div>
		</div>
	</div>
</div>     
@endsection