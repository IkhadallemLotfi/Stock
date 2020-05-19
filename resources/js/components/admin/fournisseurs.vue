<template>
    <div class="container">


        <div class="modal fade" id="deleteFournisseurModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Suppression du Fournisseur : {{fournisseurDelete}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   Voulez-vous vraiment supprimer ce fournisseur, si vous procédez vous ne pourrez plus 
                   l'assigner pour de nouveaux employés.
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success mr-auto" 
                    @click="deleteFournisseur(fournisseurDelete)">
                        Supprimer
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-info">
                <h3>Liste des Fournisseur</h3>
            </div>
            <div class="card-body">
                <input v-model="fournisseur" >
                <button type="button" class="btn btn-info" :disabled="fournisseur =='' " @click="addFournisseur">
                    Ajouter un fournisseur
                </button>
                <table class="table table-fonction table-responsive">
                    <thead>
                        <tr>
                            <th>Fournisseur</th>
                            <th></th>
                        </tr>
                    </thead>
                
                    <tbody >
                        <tr v-for="value in fournisseurs" >
                            <td>
                                <span>{{value.fournisseur }}</span>
                            </td>
                            <td>
                                <i class="material-icons" @click="setFournisseurToDelete(value.fournisseur)" 
                                data-toggle="modal" data-target="#deleteFournisseurModal">
                                    delete
                                </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fournisseurs : [],
                fournisseur : '',
                fournisseurDelete : String,
            }
        },
        methods : {
            
            getListeFournisseur() {
                axios.get("/getListeFournisseur")
                .then((response)  =>  {
                    this.fournisseurs = response.data
                }, (error)  =>  {
                    alert(error);
                })
            },

            addFournisseur(){
                axios.post("/addFournisseur",{fournisseur:this.fournisseur})
                .then((response)  =>  {
                    this.fournisseur = '';
                    this.getListeFournisseur();

                }, (error)  =>  {
                    alert(error);
                });
            },

            deleteFournisseur(fournisseur){
                axios.delete("/deleteFournisseur/"+fournisseur+"")
                .then((response) => {
                    this.getListeFournisseur();
                    $('#deleteFournisseurModal').modal('hide');
                    $('.modal-backdrop').remove()
                }, (error)=> {
                    alert(error)
                });
            },

            setFournisseurToDelete(fournisseur){
                this.fournisseurDelete = fournisseur;
            },
        },
        beforeMount(){
            this.getListeFournisseur();
        }
    }
</script>

<style>

    .iconTrash:hover{
        cursor: pointer;
    }
    .container{
        width: 100%;;
    }

    .table-fonction{
        margin-top: 1cm;
        width: 100%;
    }
    .table-fonction tbody td:nth-child(1){
        margin-top: 1cm;
        width: 100%;
    }


    .table-fonction tbody td:nth-child(2):hover{
        cursor: pointer;
    }

</style>