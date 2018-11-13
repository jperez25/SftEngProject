
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
            <label for="user_picture">Profile Picture</label>
            <input type="file" name="image" >
          </div>
        </div>
        <div class = "row">
          <div class="col-3">
            Name<input type="text" class="form-control" value="{{Auth::user()->name}}" id="name" name="name" >
          </div>
          <div class="col-3">
            Bio<textarea class="form-control" value="{{Auth::user()->bio}}" id="bio" name="bio">{{Auth::user()->bio}}</textarea>
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
                State
                <select class="form-control" id="state" name="state">
                    @if(Auth::user()->state)
                    <option value='{{Auth::user()->state}}' selected='selected'>{{Auth::user()->state}}</option>
                    @else
                    <option value='IL' selected='selected'>Choose a State</option>
                    @endif
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                  </select>
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
          <button type="submit" class="btn btn-primary">Update</button>          
      </div>
      {{Form::close()}}
      <div>
        <div class = "col-3">
            <a href="{{route('profile.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
        </div>

      </div>
    </div>  

@endsection
