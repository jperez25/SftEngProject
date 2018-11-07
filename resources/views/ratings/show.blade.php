@extends ('layouts.app')

@section ('content')
<table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th></th>
                  <th>Posting Date</th>
                  <th>Rating</th>
                  <th>Comment</th>
                  <th></th>
                </tr>
                </thead>
              @foreach($reviews as $review)
                  <tr>
                  	<td></td>
                    <td>{{$review->created_at}}</td>
                    <td>{{$review->rating}}</td>
                    <td>{{$review->description}}</td>
                    <td></td>
                  </tr>
              @endforeach
</table>
              <form method="POST" action="/ratings/create">
              		{{ csrf_field() }}
                    <input type="hidden" id="userid" name="userid" value="{{$user->id}}">
                    <a href="/ratings/create"><button type="submit" class="btn btn-primary">Add a review</button></a>
                    </form>
@endsection