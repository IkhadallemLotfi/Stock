<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PharmInvent</title>

    <!-- Scripts -->
    
    
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('img/icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>


    <link href="{{ asset('css/material-dashboard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <script  src="{{ asset('js/jquery.js') }}"></script>
    <script  src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    
    @yield('content')
</body>
</html>

<style>

    .table{
        width : 100%;
    }
    
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 2px grey;
        border-radius: 40px;
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: rgb(156, 156, 156,.8);
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(126, 125, 125, 0.8); 
    }

    ::-webkit-scrollbar-thumb:active {
        background: rgba(87, 86, 86, 0.8); 
    }

    body{
        background-color : #eee;
    }

    .table th {
        border-top-style : none;
        border-bottom-style : none;
    }

    .form-control{
        border-style : none none none none;
    }



    .form-group > .label {
        position: absolute;
        cursor: text;
        top: .4cm;
        left: .1cm;
        transition: all .3s ease-in-out;
    }  






    .navbar{
        height : 1cm !important;
    }

    .card .card-header{
        z-index : 0 !important;
    }

    .nav-link{
        cursor:pointer;
    }

    ul.collapse.nav {
        padding : .2cm 0 .2cm 0;
    }

    .material-icons {
        cursor :pointer !important;
    }
</style>
