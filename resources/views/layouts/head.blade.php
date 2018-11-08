<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Playdates R Us') }}</title>


    <!-- Scripts -->    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script src='https://unpkg.com/axios/dist/axios.min.js'></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">

    <!-- For Welcome page -->
    <link rel="stylesheet" href="{{ URL::asset('css/welcome.css') }}">
    <!-- For Login page -->
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
    
    <!-- Favicon -->    
    <link rel="shortcut icon" href="{{ URL::asset('images/PdRUs_Icon.png') }}" >

    <script src="{{ URL::asset('js/star-rating.js') }}"></script>
    <link  href="{{ URL::asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" >


</head>