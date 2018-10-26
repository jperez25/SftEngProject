<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <!-- url('https://nerdymates.com/static/img/regular/family-essay.jpg');background-repeat: no-repeat; background-size: 100%; padding-bottom: 70px; -->
    <body style= "background-color: white">
        <div id="app">

            @include('layouts.nav')            

            
            @yield('homePage')
                

            <div class="container">
                @yield('content')
            </div>
            
            <div style="align:center;">
                @include('layouts.footer')
            </div>
            
        </div>
        <script src="js/app.js"></script>
        <script>
            var slider = document.getElementById("radius");
            var output = document.getElementById("value");
            output.innerHTML = slider.value;

            slider.oninput = function() {
            output.innerHTML = slider.value;
            }
        </script>
    </body>   
</html>
