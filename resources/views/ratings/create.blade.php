@extends ('layouts.app')

@section ('content')
<h3>Rating for: {{$user->name}}</h3>
<form method="POST" action="/ratings/">
	{{ csrf_field() }}
    <div class="wrapper container">
    <input type="hidden" name="_method" value="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <div class = "row">
            <div class="col-3">
                <p>Give your rating</p>  
                <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2">
            </div>
        <div class="col-3">
            Comment<textarea class="form-control" value="Enter your rating here" id="description" name="description" style="min-height:200px;" require></textarea>
        </div>

        </div>
            <div class = "row">
        <div class="col-3">
            <input type="hidden" class="form-control" value="{{$user->id}}" id="user2_id" name="user2_id">
        </div>
        <div class="col-3">
            <input type="hidden" class="form-control" value="{{Auth::user()->id}}" id="user1_id" name="user1_id">
        </div>        
      </div>

      <div class = "row">
        <div class="col-3">
          <button type="submit" class="btn btn-primary">Add Review</button>       
      </div>
</form>
        <a href="/ratings/{{$user->id}}"><button class="btn btn-danger" type="submit">Cancel</button></a>
@endsection