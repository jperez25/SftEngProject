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
    <h3>Your Profile</h3>
  		<div>Name: {{Auth::user()->name}}</div>
      <div>Bio: {{Auth::user()->bio}}</div>
      <div>Child Bio: {{Auth::user()->child_bio}}</div>
      <div>Parent Age: {{Auth::user()->parent_age}}</div>
      <div>Child Age: {{Auth::user()->child_age}}</div>
      <div>City: {{Auth::user()->city}}</div>
      <div>State: {{Auth::user()->state}}</div>
      <a href="profile/edit"><button type="submit" class="btn btn-primary">Edit</button></a>
  </body>
 </html>