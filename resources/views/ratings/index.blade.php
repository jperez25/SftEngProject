@extends ('layouts.app')

@section ('content')
<h3>Your ratings</h3>
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
@endsection