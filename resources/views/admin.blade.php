@extends('layouts.app')

@section('content')



    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
        
    @endif
    <div  id="nav">
        <navbar></navbar>
    </div>    
    <br>
    <div  id="app">
        <mainvue></mainvue>
    </div>


    <script>
        $(document).ready(function(){
           
            $("#navbarDropdown").click(function(){
                
                if($("#logout-menu").css('opacity') == '0' ){
                    $("#logout-menu").css('height','inherit')
                    $("#logout-menu").css('width','inherit')
                    $("#logout-menu").css('opacity','1');
                    $("#logout-menu").css('display','block');
                }else{
                    $("#logout-menu").css('height','0')
                    $("#logout-menu").css('width','0')
                    $("#logout-menu").css('opacity','0');
                    $("#logout-menu").css('display','none');
                }
            });

            $("*:not(#navbarDropdown)").click(function(){
                $("#logout-menu").css('height','0')
                $("#logout-menu").css('width','0')
                $("#logout-menu").css('opacity','0');
                $("#logout-menu").css('display','none');
            });
        })
    </script>

    <style>
        .navbar{
            height : .5cm !important;
            background-color : white !important;
            box-shadow : none;
            z-index : 1;
        }
        #navbarDropdown{
            display : flex;
            flex-direction : row;
        }
        #navbarDropdown span{
            margin-top:5%;
            margin-right : .2cm;
            font-weight : bold;
        }
        .icon-user{
            width : 1cm;
            height : 1cm;
            border-radius : 50%;
            background-color : rgba(175,175,175,.6);
            border-style: solid;
            border-width : 1px;
            overflow:hidden;
        }

        .icon-user img {
            width : 100%;
            height : 100%;
        }

        .logout-menu {
            right : 0;
            margin-top : .5cm;
            width : inherit;
            height : inherit ;
            opacity : 0;
            position:absolute ;
            box-shadow: 5px 5px 10px rgba(73, 73, 73, .6);
            border-style: solid;
            border-width: 1px; 
            border-color: rgba(53, 52, 52, 0.664);
            padding: .2cm;
            border-radius : 10px; 
            background-color : white;
            transition: all .5s ease-in;
            display: none;
        }
        .logout-menu a:hover{ 
            border-radius : 5px; 
            box-shadow: 5px 5px 10px rgba(73, 73, 73, .6);
            
            background-color : #007bff !important; 
            color : white !important; 
            border-color : #007bff ; 
        }
        #app{
            margin-top: 2cm;
        }
    </style>
@endsection
