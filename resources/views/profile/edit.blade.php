
@extends('layouts.app')

@section('content')
<h3>Your Profile Edit</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  {{Form::open(array('action' => array('ProfileController@update', $user), 'method' => 'PATCH', 'files' => true, 'id' => 'update'))}}
    <div class="wrapper container">
      <div class="form-group">
        <div class = "row">
          <div class="col-3">
            <label for="userPicture">Profile Picture</label>
            <input type="file" name="image" >
          </div>
        </div>
        <div class = "row">
          <div class="col-3">
            Name<input type="text" class="form-control" value="{{Auth::user()->name}}" id="name" name="name" >
          </div>
          <div class="col-3">
            Bio<textarea class="form-control" value="{{Auth::user()->bio}}" id="bio" name="bio"></textarea>
          </div>
        </div>
        <div class = "row">
          <div class="col-3">
            Child Bio<input type="text" class="form-control" value="{{Auth::user()->child_bio}}" id="child_bio" name="child_bio">
        </div>
        <div class="col-3">
            Parent Age<input type="number" class="form-control" value="{{Auth::user()->parent_age}}" id="parent_age" name="parent_age">
        </div>
        </div>
        <div class = "row">
          <div class="col-3">
            Child Age<input type="number" class="form-control" value="{{Auth::user()->child_age}}" id="child_age" name="child_age">
        </div>
        <div class="col-3">
            City<input type="text" class="form-control" value="{{Auth::user()->city}}" id="city" name="city">
        </div>

        </div>
            <div class = "row">
          <div class="col-3">
            State<input type="text" class="form-control" value="{{Auth::user()->state}}" id="state" name="state">
        </div>
        
        <div class="col-3">
            <input type="hidden" class="form-control" value="" id="lat" name="lat">
        </div>
        <div class="col-3">
            <input type="hidden" class="form-control" value="" id="lng" name="lng">
        </div>        
      </div>

      <div class = "row">
        <div class="col-3">
        <button type="submit" class="btn btn-primary" onclick="geocode">Update</button>
      </div>
      {{Form::close()}}
      <div>
        <div class = "col-3">
            <a href="{{route('profile.index')}}"><button class="btn btn-danger">Cancel</button></a>
        </div>

      </div>
    </div>  


<script>
          // Call Geocode
          //geocode()
          function geocode(city, state){
            var location = "{{Auth::user()->city}}, {{Auth::user()->state}}";
            alert(location);
            axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
              params:{
                address:location,
                key:'AIzaSyCDIsZKQ-JCkOZV83EdiAygW21wAY4nzZA'
              }
            })
            .then(function(response){
              //Log full response
              //console.log(response)

              //Lat

              var lat = response.data.results[0].geometry.location.lat;
              //console.log(lat);
              var cLat = document.getElementById("lat");
              cLat.value = lat;              
              
              //lng
              var lng = response.data.results[0].geometry.location.lng;
              //console.log(lng);
              var cLng = document.getElementById("lng");
              cLng.value = lng;          
            })
            .catch(function(error){
              console.log(error);
            });
            
          }
</script>

@endsection
