<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>PlayDates R Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>
  <body>
    @include('layouts.nav')
    <h3>Your Profile Edit</h3>

{!! Form::model($user, [
    'method' => 'PATCH',
    'route' => ['profile.update', $user->id]
]) !!}
  {{ csrf_field() }}
<div class="wrapper container">
  <div class="form-group">
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
        Parent Age<input type="text" class="form-control" value="{{Auth::user()->parent_age}}" id="parent_age" name="parent_age">
    </div>
    </div>
    <div class = "row">
      <div class="col-3">
        Child Age<input type="text" class="form-control" value="{{Auth::user()->child_age}}" id="child_age" name="child_age">
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
    </div>
    </div>
  </div>

  <div class = "row">
    <div class="col-3">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
  <div>
    <div class = "col-3">
         <a href="/customers/"><button class="btn btn-danger">Cancel</button></a>
    </div>
  </div>
</div>
 


</form>
  </body>
 </html>