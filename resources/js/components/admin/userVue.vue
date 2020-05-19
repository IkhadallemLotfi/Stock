<template>
    <div class="content">

        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter un rédacteur</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="addUser">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input class="form-control input" maxlength="100"
                                placeholder="Email" v-model="email"
                                required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                <label class="label">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input class="form-control input" maxlength="100"
                                placeholder="nom" v-model="nom"
                                required pattern="^(([a-zA-Z])+( |-)?([a-zA-Z])+)+$">
                                <label class="label">Nom</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control input" maxlength="100"
                                placeholder="prenom" v-model="prenom"
                                required pattern="^(([a-zA-Z])+( |-)?([a-zA-Z])+)+$">
                                <label class="label">Prénom</label>
                            </div>
                            <div class="form-group col-md-4">
                                <input class="form-control input" maxlength="100"
                                placeholder="titre" v-model="titre"
                                required>
                                <label class="label">Titre</label>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <label>Description</label>
                        </div>
                        <div class="row col-md-12">
                            <textarea class="col-md-12" v-model="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mr-auto" >
                            Valider
                        </button>
                        <button  data-dismiss="modal" class="btn btn-secondary" @click="userCompte={}" >
                            Fermer
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalBloquer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Bloquer l'utilisateur</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        Voulez vous vraiment <b><span v-if="userCompte.etat_compte==0">dé</span>bloquer</b> 
                        le compte de cet utilisateur: 
                        <p><b>{{userCompte.name+"  "+userCompte.prenom}}</b></p>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button 
                        class="btn btn-success mr-auto" @click="bloquerDebloquerUser(userCompte.id)">
                            Confirmer
                        </button>
                        <button class="btn btn-secondary" data-dismiss="modal" @click="idCompte=0">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h3>Liste des rédacteurs</h3>
            </div>
            <div class="card-body">
                <table class="table table-users">
                    <thead>
                        <th>Dé/Bloquer</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Titre</th>
                        <th>Date d'inscription</th>
                    </thead>
                    <tbody>
                        <tr v-for="(user,key ) in users">
                            <td 
                                @click="userCompte= user" data-target="#modalBloquer" data-toggle="modal"
                                style="text-align:center;
                                vertical-align: middle; ">
                                <i v-if="user.etat_compte == 0" class="text-danger material-icons">
                                    lock
                                </i>
                                <i v-if="user.etat_compte != 0" class="text-danger material-icons" >
                                    lock_open
                                </i>
                            </td>
                            <td>
                                {{user.name}}
                            </td>
                            <td>
                                {{user.prenom}}
                            </td>
                            <td>
                                {{user.email}}
                            </td>
                            <td>
                                {{user.titre}}
                            </td>
                            <td>
                                {{user.created_at | moment('dddd DD MMMM YYYY HH:mm:ss') }}
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class=" row col-md-12">
            <button type="button" class="btn btn-success ml-auto mr-auto" 
            data-toggle="modal"  data-target="#myModal">
                Ajouter
            </button>
        </div>
    </div>    
</template>

<script>
export default {
    data(){
        return{
            users : [],
            nom : String('') , 
            prenom : String(''),
            email : String('') ,
            titre : String(''),
            description : String(''),
            userCompte : Number(''),
        }
    },
    methods: {
        getUsers(){
            axios.get('/listeUsers')
            .then((response)=>{
                this.users = response.data;
            },(error)=>{
                alert(error);
            });
        },

        bloquerDebloquerUser(userID){
            axios.post('/bloquerDebloquer',{id:userID})
            .then( (response) =>{
                this.userCompte = {};
                this.getUsers();
                $('#modalBloquer').modal('hide');
                $('.modal-backdrop').remove()
            },(error) =>{
                alert(error);
            })
        },


        addUser(){
            axios.post("/addUser",{
                email : this.email,
                nom : this.nom,
                prenom : this.prenom,
                titre : this.titre,
                description : this.description
            })
            .then((response)  =>  {
                this.getUsers();
                $('#myModal').modal('hide');
                $('.modal-backdrop').remove()
            }, (error)  =>  {
                alert(error);
            })
        },
        reinitialiserForm(){
            this.nom  = this.email = this.prenom = this.titre = this.description = '';
        },
    },
    beforeMount(){
        this.getUsers();
    }
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
     *:not(.material-icons){
        font-family :'Roboto' !important;
    }
    .table-users{
        width: 100%;
    }

</style>