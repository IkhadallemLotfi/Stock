<template>
    <div class="container">
        

        <div class="modal fade" id="deleteFactureModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Suppression de la Facture : {{facture.numero}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   Voulez-vous vraiment supprimer cette facture, si vous procédez vous ne pourrez plus 
                   l'assigner pour de nouveaux employés.
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success mr-auto" 
                    @click="deleteFacture()">
                        Supprimer
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>

        <div class="modal fade" id="addFactureModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="addFacture">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                 <label >N° de facture</label>
                                <input class="form-control input" type="text" maxlength="100"
                                placeholder="Numéro de facture" v-model="facture.numero" required>
                               
                            </div>
                            <div class="form-group col-md-4">
                                <label >Date</label>
                                <input class="form-control input" type="date" maxlength="100"
                                    v-model="facture.date_facture" required>
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label >Fournisseur</label>
                                <model-select
                                    :options="fournisseurs"
                                    v-model="facture.fournisseur"
                                    placeholder="Fournisseur">
                                </model-select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mr-auto" >
                            Valider
                        </button>
                        <button  data-dismiss="modal" class="btn btn-secondary">
                            Fermer
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editFactureModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Modifier une facture</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="updateFacture">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                 <label >N° de facture</label>
                                <input class="form-control input" type="text" maxlength="100"
                                disabled v-model="facture.numero" required>
                               
                            </div>
                            <div class="form-group col-md-4">
                                <label >Date</label>
                                <input class="form-control input" type="date" maxlength="100"
                                v-model="facture.date_facture" required>
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label >Fournisseur</label>
                                <model-select
                                    :options="fournisseurs"
                                    v-model="facture.fournisseur"
                                    placeholder="Fournisseur">
                                </model-select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mr-auto" >
                            Valider
                        </button>
                        <button  data-dismiss="modal" class="btn btn-secondary">
                            Fermer
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-info">
                <h3>Liste des Facture</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-info ml-auto mr-auto" data-toggle="modal" 
                data-target="#addFactureModal" @click="initForm()" >
                    Ajouter
                </button>
                <table class="table table-factures table-responsive">
                    <thead>
                        <tr>
                            <th>N° de facture</th>
                            <th>Fournisseur</th>
                            <th>Date</th>
                            <th>Date de création</th>
                            <th>Date de mise à jour</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                
                    <tbody >
                        <tr v-for="value in factures" >
                            <td>
                                <span>{{value.numero }}</span>
                            </td>
                            <td>
                                {{value.fournisseur}}
                            </td>
                            <td>
                                {{value.date_facture | moment('DD/MM/YYYY')}}
                            </td>
                            <td>
                                {{value.created_at | moment('DD/MM/YYYY')}}
                            </td>
                            <td>
                                {{value.updated_at | moment('DD/MM/YYYY')}}
                            </td>
                            <td>
                                <i class="material-icons" @click="facture=value" 
                                data-toggle="modal" data-target="#editFactureModal">
                                    edit
                                </i>
                            </td>
                            <td>
                                <i class="material-icons" @click="facture=value" 
                                data-toggle="modal" data-target="#deleteFactureModal">
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
                factures : [],
                facture : {},
                fournisseurs : [],
                fournisseur : '',
            }
        },
        methods : {
            initForm(){
                this.facture = {
                    'date_facture': Date(),
                    'fournisseur': '',
                    'numero': '',
                }
            },
            getListeFournisseur(){
                axios.get("/getListeFournisseur")
                .then((response)  =>  {
                    this.fournisseurs = response.data
                    for (let index = 0; index < response.data.length; index++) {
                        this.fournisseurs[index]['value'] = response.data[index]['fournisseur']
                        this.fournisseurs[index]['text'] = response.data[index]['fournisseur']
                    }
                }, (error)  =>  {
                    alert(error);
                })
            },
            getListeFacture() {
            //récupère la liste des activité de l'employé pour la date selectionnee
                axios.get("/getListeFacture")
                .then((response)  =>  {
                    this.factures = response.data
                }, (error)  =>  {
                    alert(error);
                })
            },

            addFacture(){
                console.log(this.facture.date_facture);
                axios.post('/addFacture', {
                    dateFacture : this.facture.date_facture, 
                    fournisseur : this.facture.fournisseur, 
                    numFacture :  this.facture.numero,
                })
                .then((response)  =>  {
                    this.facture = {};
                    this.getListeFacture();
                    $('#addFournisseurModal').modal('hide');
                    $('.modal-backdrop').remove()
                }, (error)  =>  {
                    alert(error);
                });
            },

            updateFacture(){
                let formData = new FormData();
                formData.append('dateFacture',this.facture.date_facture)
                formData.append('fournisseur',this.facture.fournisseur)
                formData.append('numFacture',this.facture.numero)

                axios.post('/updateFacture', {headers: {'Content-Type': 'multipart/form-data' }}, formData)
                .then((response)  =>  {
                    this.facture = {};
                    this.getListeFacture();
                    $('#editFournisseurModal').modal('hide');
                    $('.modal-backdrop').remove()
                }, (error)  =>  {
                    alert(error);
                });
            },

            deleteFacture(){
                axios.delete("/deleteFacture/"+this.facture.numero+"")
                .then((response) => {
                    this.getListeFacture();
                    $('#deleteFactureModal').modal('hide');
                    $('.modal-backdrop').remove()
                }, (error)=> {
                    alert(error)
                });
            },
        },
        beforeMount(){
            this.getListeFournisseur();
            this.getListeFacture();
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

    .table-factures{
        margin-left: auto;
        margin-right: auto;
        width: 100%;
    }

    .table-factures tbody td:nth-child(2):hover{
        cursor: pointer;
    }

</style>