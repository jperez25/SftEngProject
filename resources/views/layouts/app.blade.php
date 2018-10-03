<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <!-- url('https://nerdymates.com/static/img/regular/family-essay.jpg');background-repeat: no-repeat; background-size: 100%; padding-bottom: 70px; -->
    <body style= "background-color: black">
        <div id="app">

            @include('layouts.nav')            

            <div class="container">
                @yield('homePage')
            </div>

            <div class="container">
                @yield('content')
            </div>
            
            @include('layouts.footer')
        </div>  
    </body>    
</html>
