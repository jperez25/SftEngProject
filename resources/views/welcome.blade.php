@extends ('layouts.app')

@section ('homePage')

    <!-- Header -->
    <header class="masthead">
        <div class="container" style="background-image:url('https://nerdymates.com/static/img/regular/family-essay.jpg');background-repeat: no-repeat; background-size: 100%; padding-bottom: 70px;" >
            <div class="intro-text">
            <div class="intro-lead-in">Welcome To Playdates R Us!</div>
            <div class="intro-heading text-uppercase"></div>
            @guest
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="{{route('register')}}">Sign Up!</a>
            @else
            @endguest
            </div>
        </div>
    </header>

@endsection('homePage')

@section ('content')

@endsection('content')


