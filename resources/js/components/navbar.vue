
<template>
<nav class="navbar-custom">
    <div class="brand-collapse" >
        <div class="container-toggle" id="toggle-navbar" >
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="nav_collapse">
        <ul class="navbar-list-custom">
            <li class="nav-item-custom"
            :class="{ active: selected == '1' }" @click="selected = '1';setSelected('1')">
                <router-link :to="{name:'produits'}" class="nav-text" >
                    Produits
                </router-link>
                <div :class="{ active: selected == '1' }"  class="nav-item-custom-bottom"></div>
            </li>

            <li class="nav-item-custom" 
            :class="{ active: selected == '2' }" @click="selected = '2';setSelected('2')">
                <router-link :to="{name:'factures', params: {type:'Mobiles' }}" class="nav-text" >
                    Factures
                </router-link>
                <div style="width:100%;">
                    <div :class="{ active: selected == '2' }"  class="nav-item-custom-bottom"></div>
                </div>
            </li>

            <li class="nav-item-custom" 
            :class="{ active: selected == '3' }" @click="selected = '3';setSelected('3')">
                <router-link :to="{name:'fournisseurs'}" class="nav-text" >
                    Fournisseurs
                </router-link>
                <div style="width:100%;">
                    <div :class="{ active: selected == '3' }"  class="nav-item-custom-bottom"></div>
                </div>
            </li>

            <li class="nav-item-custom" 
            :class="{ active: selected == '4' }" @click="selected = '4';setSelected('4')">
                <router-link :to="{name:'destinations' }" class="nav-text" >
                    Destinations
                </router-link>
                <div style="width:100%;">
                    <div :class="{ active: selected == '4' }"  class="nav-item-custom-bottom"></div>
                </div>
            </li>
            

        </ul>
    </div>
</nav>

</template>
<script>
    $(document).ready(function(){
        $("#toggle-navbar").click(function(){
           
            if($("#nav_collapse ul").css('display') == 'none' ){
                $("#nav_collapse").css('height','5cm')
                $("#nav_collapse  ul").css('display','flex');
            }else{
                $("#nav_collapse").css('height','0')
                $("#nav_collapse  ul").css('display','none');
            }
        });
    })
    export default {
        data() {
            return {
                image: require('../../../public/img/Logo - Copie.png'),
                showNav : Boolean,
                selected : Number,
            }
        },
        created () {
                window.addEventListener('scroll', this.handleScroll);
            },
        destroyed () {
            window.removeEventListener('scroll', this.handleScroll);
        },
        methods :{
            
            handleScroll () {
            
                if(window.scrollY > this.topInitial){
                    this.top = window.scrollY+75;
                }else{
                    this.top = this.topInitial;
                }
            },
            setSelected(number){
                this.selected = number;
                localStorage.setItem('number',this.selected);
            }
        },
        beforeMount(){
            this.selected = localStorage.getItem('number');
            this.showNav = false;
        }
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
    *:not(.material-icons){
        font-family :'Roboto' !important;
    }

    .navbar-custom {
        box-shadow: 0 2px 5px rgb(235, 235, 235);
        padding: 0 !important;
        display: flex;
        flex-direction: row;
        background-color: white;
        box-shadow: 5px 5px 10px rgba(65, 65, 65, .7);
        width: 100%;
        position: fixed;
        z-index: 10 !important
    }
    .brand-collapse .container-toggle{
        display: none;
    }

    .navbar-list-custom{
        margin-left: auto;
        margin-right: auto;
    }
    .nav-item-custom{
        margin-right: 1%;
    }

    .nav-item-custom:hover .nav-text{
        color: #0c88b1 !important;
        text-decoration: none !important;
    }
    .nav-item-custom:hover .nav-item-custom-bottom{
        width: 100%;
    }
    .nav-text.active{
        color: #1a7492 !important;
    }
    .active.nav-item-custom-bottom{
        /*
        -webkit-transform: scaleX(1);
        -moz-transform: scaleX(1);
        -ms-transform: scaleX(1);
        -o-transform: scaleX(1);
        transform: scaleX(1); 
        */
        width: 100%;
    }
    .nav-item-custom-bottom {
        content: "";
        height: 5px;
        bottom: 0;
        position: absolute;
        background-color:#17b978b7;
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        -moz-transition: all 0.3s;
        width: 0;
        /*
        -webkit-transform: scaleX(0);
        -moz-transform: scaleX(0);
        -ms-transform: scaleX(0);
        -o-transform: scaleX(0);
        transform: scaleX(0);
        */
    }


    .nav-item-custom:hover .nav-item-custom-bottom{
        -webkit-transform: scaleX(1) !important;
        -moz-transform: scaleX(1) !important;
        -ms-transform: scaleX(1) !important;
        -o-transform: scaleX(1) !important;
        transform: scaleX(1) !important;
    }
    .nav-text{
        color: black !important;
        font-weight: 400 !important;
        font-size: 19px;
    }

    @media (min-width:992px) {
        .navbar-brand{
            margin:.1cm 0 0 10%;
            width: 4cm;
            position: relative !important;
        }
        .navbar-list-custom{
            display: flex;
            flex-direction: row;
            margin-left: 5% !important;
            width: 95% !important;
            margin-top: .4cm;
        }
        .nav-item-custom {
            width: 3cm;
        }
        .nav-item-custom-bottom {
            top: 1.42cm;
            margin-left: -.1cm;
        }
        
    }

    @media (max-width:991px) {
        .navbar-brand{
            margin:.1cm 0 0 2%;
            width: 4cm;
            position: relative !important;
        }
        .navbar-list-custom{
            display: flex;
            flex-direction: row;
            margin-left: 1% !important;
            width: 95% !important;
            margin-top: .4cm;
        }
        .nav-item-custom {
            width: 3cm;
        }
        .nav-item-custom-bottom {
            top: 1.42cm;
        }
    }

    @media (max-width: 765px) {
        .navbar-brand{
            margin:.1cm 0 0 2.5%;
            width: 4cm;
        }
        #nav_collapse{
            
            height: 0;
            transition: all .3s ease;
        }
        #nav_collapse ul {
            display: none;
        }
        .brand-collapse{
            display:flex;
            flex-direction:row;
            margin: .1cm .1cm 0 0;
        }
        .brand-collapse .container-toggle{
            margin-left:auto;
            display: flex;
            flex-direction: column;
            border-style: solid;
            border-color: rgba(0, 0, 0, 0.7);
            border-width: 1px;
            border-radius: 5px;
            padding: .2cm .2cm 0 .2cm;
            height: 1cm;
            cursor: pointer;
        }
        .brand-collapse .container-toggle div {
            width: .8cm;
            
            margin-bottom: 0;
            border-style: solid none none none; 
            border-color: rgba(65, 65, 65, .7);
        }
        .brand-collapse .container-toggle div:nth-child(1),
        .brand-collapse .container-toggle div:nth-child(2) {
            height: .2cm;
        }
        .brand-collapse .container-toggle div:nth-child(3) {
            height: 0cm;
        }

        .navbar-list-custom{
            display: flex;
            flex-direction: column;
            margin-left: 1% !important;
            width: 95% !important;
            
        }
        .navbar-custom {
            display: flex;
            flex-direction: column;
        }
        .nav-item-custom-bottom {
            position: relative;
            top: 0cm;
        }
        
    }
    .navbar-nav .nav-link {

        padding: 0 0 0 0 !important;
    }
</style>