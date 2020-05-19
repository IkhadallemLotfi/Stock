<template>
    <body>
        
        <div class="wrapper ">
            <div class="sidebar" data-color="azure">
                <div class="logo" style="padding: 0 0 0 0;">
                    <div>
                        <img :src="image">
                    </div>
                </div>
                <li  id="visibility" @click="visibility = !visibility" >
                    <i v-if="visibility" class="material-icons">
                        chevron_left
                    </i>
                    <i v-else class="material-icons">
                        chevron_right
                    </i>
                </li>
                <div class="sidebar-wrapper">
                    
                    <ul class="nav">
                        <li class="nav-item"
                        :class="{ active: selected == '1' }" @click="selected = '1';setSelectedItem('1')">
                            <router-link :to="{ name: 'produits' }" class="nav-link" >
                                <i class="fas fa-newspaper"></i>
                                <span>Liste de Produits</span>
                            </router-link>
                        </li>

                        <li class="nav-item" 
                        :class="{ active: selected == '2' }" @click="selected = '2';setSelectedItem('2')">
                            <router-link  :to="{ name: 'addArticleVue' }"  
                            class="nav-link" >
                                <i class="fas fa-plus-circle"></i>
                                <span>Liste des factures</span>
                            </router-link>
                        </li>

                        <li class="nav-item"
                        :class="{ active: selected == '3' }" @click="selected = '3';setSelectedItem('3')">
                            <router-link  :to="{ name: 'assistants' }"  
                            class="nav-link" >
                                <i class="fas fa-users"></i>
                                <span>Liste des utilisateurs</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
                
        </div>
    </body>
</template>

<script>

    $(document).ready(function(){
        $("#visibility").click(function(){
            if($(".sidebar").css('width') == '0px' ){
                $(".sidebar").css('width','6.5cm')
                $(".sidebar-wrapper").css('display','block');
                $("#visibility").css('left','6.5cm')
            }else{
                $("#visibility").css('left','.15cm')
                $(".sidebar").css('width','0')
                $(".sidebar-wrapper").css('display','none');
            }
        });
    })

    export default {
        data() {
            return {
                image: require('../../../../public/img/Logo - Copie.png'),
                selected: String,
                visibility:Boolean(true),
            }
        },
        methods : {
            visible(){
                this.visibility = !this.visibility
            },
            setSelectedItem(num){
                localStorage.setItem('selectedItem',num);
            },
            getSelectedItem(){
                return localStorage.getItem('selectedItem');
            },
            
        },
        beforeMount(){    
            this.selected = localStorage.getItem('selectedItem');
        }
         
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
     *:not(.material-icons){
        font-family :'Roboto' !important;
    }
    .wrapper  {
        min-height: 2cm !important;
        height: inherit;
    }
    .nav.collapse{

        box-shadow: inset 0px 5px 15px rgba(151, 151, 151, 0.5);
        border-style: none none none none;
        border-width: 1px;
        border-color: rgba(0, 0, 0, 0.2);
        transition: all .3s ease;
    }    
    .sidebar-wrapper .nav-link {
        display: flex;
        flex-direction: row;
        height: 1cm;
        margin-top: .5cm;
        font-size: 14px !important;
    }
    .sidebar-wrapper .nav-link svg{
        margin-right: 10%;
        vertical-align: middle;
        font-size: 20px;
    }

    .logo{
        height: 1.5cm;
        width: 100%;
    }
    .logo div{
        margin-top: .75cm;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        transform-origin: center;
    }
    .logo img{
        width: 100%;
        height: 100%;
    }

    @media (min-width:991px) {
        #visibility{
            display: block;
        }
    }

    @media(max-width:991px){
        .sidebar{
            width: 6.5cm;
            left: -7cm;
            background-color: white !important;
            box-shadow: 0 6px 8px rgba(75, 74, 74, 0.5);
            transition: all .3s ease;
            z-index: 10002 !important;
        }

        .sidebar::before{
            background-color: white !important;
        }
        body{
            background-color: white !important;

        }

        #visibility{
            top: 0cm;
            position: absolute;
            left: 6.5cm;
            z-index: 99 !important;
            border-radius: 50%;
            display: inline;
            text-align: center;
            transition: all .3s ease;
            background-color:#343a40;
            border-radius: 50%;
            color: white !important;
            box-shadow: 2px 2px 8px rgba(32, 32, 32, .8);
            padding-top: .2cm;
            text-align: center;
        }
        .sidebar * {
            z-index: 10002 !important;
        }
    
    }
</style>