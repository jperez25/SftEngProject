@extends ('layouts.app')

@section ('content')
<h3>Rating for: {{$user->name}} </h3>
@section ('content')
{{Form::open(array('action' => array('ReviewController@update', $review->id), 'method' => 'PATCH', 'id' => 'update_review_form'), array('id' => 'update_review_form'))}}
	{{ csrf_field() }}
    <div class="wrapper container">
      <div class="form-group">
        <div class = "row">
            <div class="col-3">
                <p>Give your rating</p>  
                <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{$review->rating}}">
            </div>
        <div class="col-3">
            Comment<textarea class="form-control" id="description" name="description" style="min-height:200px;" required>{{$review->description}}</textarea>
        </div>

        </div>
            <div class = "row">
        <div class="col-3">
            <input type="hidden" class="form-control" value="{{$review->id}}" id="review_id" name="review_id">
        </div>
        <div class="col-3">
            <input type="hidden" class="form-control" value="{{$review->user2_id}}" id="user2_id" name="user2_id">
        </div>           
      </div>

      <div class = "row">
        <div class="col-3">
          <button type="submit" class="btn btn-primary">Add Review</button>       
      </div>
{{Form::close()}}
        <a href="/ratings/{{$user->id}}"><button class="btn btn-danger" type="submit">Cancel</button></a>
@endsection