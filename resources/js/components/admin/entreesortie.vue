<template>
    <div class="content-entree-sortie">

        <div class="modal fade" id="destinationsModal">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                        Total de consommaiton par Destination
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <th>Destination</th>
                                <th>Total TR</th>
                            </thead>
                            <tbody>
                                <tr v-for="destination in totalDestinations">
                                    <td>{{destination.destination}} DA</td>
                                    <td>{{destination.total_tr}} DA</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="deleteEntreeModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Suppression de l'entrée :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   Voulez-vous vraiment supprimer cette entrée ?
                   <div class="row">
                        <div class="form-group col-md-10">
                            <label >Désignation</label>
                            <input class="form-control input" maxlength="100" disabled
                            placeholder="Désignation" v-model="designation" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label >Date de péromption</label>
                            <input class="form-control input" type="date" disabled
                            placeholder="Date de péromption" v-model="date_peromption"
                            required>
                        </div>
                        <div class="form-group col-md-3">
                                <label >Prix PPA</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Prix ppa" v-model="prix_ppa" min="0"  step="0.01" required>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label >Prix TR</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="prix TR" v-model="prix_tr" min="0"  step="0.01" required>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label >Prix Net</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="prix Net" v-model="prix_net" min="0"  step="0.01" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label >Quantité</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Quantite" min="1" v-model="quantite" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>N° de Facture</label>
                            <model-select
                                :disabled="true"
                                :options="factures"
                                v-model="facture"
                                placeholder="Facture">
                            </model-select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Fournisseur</label>
                            <div>{{fournisseur}}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-danger mr-auto" 
                    @click="deleteEntree(id)">
                        Supprimer
                    </button>
                    <button class="btn" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>

        <div class="modal fade" id="editEntreeModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Mise à jour de l'Entrée</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="updateEntree">
                    <div class="modal-body">
                       
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label >Désignation</label>
                                <input class="form-control input" maxlength="100" disabled
                                placeholder="Désignation" v-model="designation" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label >Date de péromption</label>
                                <input class="form-control input" type="date" disabled
                                placeholder="Date de péromption" v-model="date_peromption"
                                required>
                            </div>
                            <div class="form-group col-md-3">
                                 <label >Prix PPA</label>
                                <input class="form-control input" type="number" maxlength="100" disabled
                                placeholder="Prix ppa" v-model="prix_ppa" min="0"  step="0.01" required>
                               
                            </div>
                            <div class="form-group col-md-3">
                                <label >Prix TR</label>
                                <input class="form-control input" type="number" maxlength="100" disabled
                                placeholder="prix TR" v-model="prix_tr" min="0"  step="0.01" required>
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label >Prix Net</label>
                                <input class="form-control input" type="number" maxlength="100" disabled
                                placeholder="prix Net" v-model="prix_net" min="0"  step="0.01" required>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label >Quantité</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="Quantite" min="1" v-model="quantite" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>N° de Facture</label>
                                <model-select
                                    :options="factures"
                                    v-model="facture"
                                    placeholder="Facture">
                                </model-select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Fournisseur</label>
                                <div>{{fournisseur}}</div>
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

        <div class="modal fade" id="deleteSortieModal">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Suppression de la sortie :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   Voulez-vous vraiment supprimer cette sortie ?
                   <div class="row">
                        <div class="form-group col-md-10">
                            <label >Désignation</label>
                            <input class="form-control input" maxlength="100" disabled
                            placeholder="Désignation" v-model="designation" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label >Restant</label>
                            <input class="form-control input" maxlength="100" disabled
                            placeholder="Quantité restante" v-model="reste" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label >Date de péromption</label>
                            <input class="form-control input" type="date" disabled
                            placeholder="Date de péromption" v-model="date_peromption"
                            required>
                        </div>
                        <div class="form-group col-md-3">
                                <label >Prix PPA</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Prix ppa" v-model="prix_ppa" min="0"  step="0.01" required>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label >Prix TR</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="prix TR" v-model="prix_tr" min="0"  step="0.01" required>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label >Prix Net</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="prix Net" v-model="prix_net" min="0"  step="0.01" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label >Quantité</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Quantite" min="1" v-model="quantite" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ordonnance</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Ordonnance" min="1" v-model="ordonnance" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Destination</label>
                            <div>{{destination}}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-danger mr-auto" 
                    @click="deleteSortie()">
                        Supprimer
                    </button>
                    <button class="btn" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>

        <div class="modal fade" id="editSortieModal">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modification de la sortie :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   <div class="row">
                        <div class="form-group col-md-10">
                            <label >Désignation</label>
                            <input class="form-control input" maxlength="100" disabled
                            placeholder="Désignation" v-model="designation" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label >Restant</label>
                            <input class="form-control input" maxlength="100" disabled
                            placeholder="Quantité restante" v-model="reste" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label >Date de péromption</label>
                            <input class="form-control input" type="date" disabled
                            placeholder="Date de péromption" v-model="date_peromption"
                            required>
                        </div>
                        <div class="form-group col-md-3">
                                <label >Prix PPA</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Prix ppa" v-model="prix_ppa" min="0"  step="0.01" required>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label >Prix TR</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="prix TR" v-model="prix_tr" min="0"  step="0.01" required>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label >Prix Net</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="prix Net" v-model="prix_net" min="0"  step="0.01" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label >Quantité</label>
                            <input class="form-control input" type="number" maxlength="100"
                            placeholder="Quantite" min="1" v-model="quantite" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ordonnance</label>
                            <input class="form-control input" type="number" maxlength="100" disabled
                            placeholder="Ordonnance" min="1" v-model="ordonnance" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Destination</label>
                            <model-select
                                :options="destinations"
                                v-model="destination"
                                placeholder="Destination">
                            </model-select>
                        </div>
                    </div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success mr-auto" 
                    @click="updateSortie()">
                        Valider
                    </button>
                    <button class="btn" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>

        <div class="row col-md-12">
            <h3 class="mr-auto ml-auto">Sorties du {{date | moment('dddd DD MMMM YYYY')}}</h3>
        </div>
        <div class="row col-md-12">
            <download-excel :data = "sorties" :fields="sortiesFields" class="button-fixed"> 
                <button class="btn btn-success">Exporter vers Excel</button>
            </download-excel>
            <button class="btn btn-primary" data-target="#destinationsModal" 
            @click="getTotalDestination()"  data-toggle="modal">
                Somme par destinataires
            </button>
        </div>
        <div class="sorties">
            <table class="table table-custom">
                <thead>
                    <th>Ordonnance</th>
                    <th>Destination</th>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Date de péromption</th>
                    <th>Prix PPA</th>
                    <th>prix Net</th>
                    <th>Prix TR</th>
                    <th>Consommation PPA</th>
                    <th>Consommation Net</th>
                    <th>Consommation TR</th>
                    <th></th>
                    <th></th>
                </thead>
                <thead>
                    <th><input v-model="filterOrdonnance"></th>
                    <th><input v-model="filterDestination"></th>
                    <th><input v-model="filterDesignationS"></th>
                    <th><input v-model="filterQuantiteS"></th>
                    <th><input v-model="filterDateS"></th>
                    <th><input v-model="filterPPAS"></th>
                    <th><input v-model="filterNETS"></th>
                    <th><input v-model="filterTRS"></th>
                    <th><input v-model="filterCPPAS"></th>
                    <th><input v-model="filterCNETS"></th>
                    <th><input v-model="filterCTRS"></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="sortie in filteredListS">
                        <td>{{sortie.num_ordonnance}}</td>
                        <td>{{sortie.destination}}</td>
                        <td>{{sortie.designation}}</td>
                        <td>{{sortie.quantite}}</td>
                        <td>{{sortie.date_peromption | moment('DD/MM/YYYY')}}</td>
                        <td>{{sortie.prix_ppa.toFixed(2)}}</td>
                        <td>{{sortie.prix_net.toFixed(2)}}</td>
                        <td>{{sortie.prix_tr.toFixed(2)}}</td>
                        <td>{{sortie.conso_ppa.toFixed(2)}}</td>
                        <td>{{sortie.conso_net.toFixed(2)}}</td>
                        <td>{{sortie.conso_tr.toFixed(2)}}</td>
                        <td>
                            <i class="material-icons" 
                            @click="prepareSortie(sortie.id,sortie.designation,sortie.prix_ppa,sortie.prix_tr,sortie.prix_net,sortie.quantite, sortie.date_peromption, sortie.num_ordonnance,sortie.destination)"
                            data-toggle="modal" data-target="#editSortieModal">
                                edit
                            </i>
                        </td>
                        <td>
                            <i class="material-icons" @click="prepareSortie(sortie.id,sortie.designation,sortie.prix_ppa,sortie.prix_tr,sortie.prix_net,sortie.quantite, sortie.date_peromption, sortie.num_ordonnance,sortie.destination)"
                            data-toggle="modal" data-target="#deleteSortieModal">
                                delete
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row col-md-12">
            <h3 class="mr-auto ml-auto">Entrées du {{date | moment('dddd DD MMMM YYYY')}}</h3>
        </div>
        <div class="row col-md-12">
            <download-excel :data = "entrees" :fields="entreesFields" class="button-fixed"> 
                <button class="btn btn-success">Exporter vers Excel</button>
            </download-excel>
        </div>
        <div class="entrees">
            <table class="table table-custom">
                <thead>
                    <th>Facture</th>
                    <th>Fournisseur</th>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Date de péromption</th>
                    <th>Prix PPA</th>
                    <th>prix Net</th>
                    <th>Prix TR</th>
                    <th>Consommation PPA</th>
                    <th>Consommation Net</th>
                    <th>Consommation TR</th>
                    <th></th>
                    <th></th>
                </thead>
                <thead>
                    <th><input v-model="filterFacture"></th>
                    <th><input v-model="filterFournisseur"></th>
                    <th><input v-model="filterDesignationE"></th>
                    <th><input v-model="filterQuantiteE"></th>
                    <th><input v-model="filterDateE"></th>
                    <th><input v-model="filterPPAE"></th>
                    <th><input v-model="filterNETE"></th>
                    <th><input v-model="filterTRE"></th>
                    <th><input v-model="filterCPPAE"></th>
                    <th><input v-model="filterCNETE"></th>
                    <th><input v-model="filterCTRE"></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="entree in filteredListE">
                        <td>{{entree.num_facture}}</td>
                        <td>{{entree.fournisseur}}</td>
                        <td>{{entree.designation}}</td>
                        <td>{{entree.quantite}}</td>
                        <td>{{entree.date_peromption | moment('DD/MM/YYYY')}}</td>
                        <td>{{entree.prix_ppa.toFixed(2)}}</td>
                        <td>{{entree.prix_net.toFixed(2)}}</td>
                        <td>{{entree.prix_tr.toFixed(2)}}</td>
                        <td>{{entree.conso_ppa.toFixed(2)}}</td>
                        <td>{{entree.conso_net.toFixed(2)}}</td>
                        <td>{{entree.conso_tr.toFixed(2)}}</td>
                        <td>
                            <i class="material-icons" 
                            @click="prepareEntree(entree.id,entree.designation,entree.prix_ppa,entree.prix_tr,entree.prix_net,entree.quantite, entree.date_peromption, entree.num_facture)"
                            data-toggle="modal" data-target="#editEntreeModal">
                                edit
                            </i>
                        </td>
                        <td>
                            <i class="material-icons" @click="prepareEntree(entree.id,entree.designation,entree.prix_ppa,entree.prix_tr,entree.prix_net,entree.quantite, entree.date_peromption, entree.num_facture)"
                            data-toggle="modal" data-target="#deleteEntreeModal">
                                delete
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        date : String('')
    },
    data(){
        return {
            sortiesFields : {
                'Ordonnance':'num_ordonnance',
                'Destination':'destination',
                'Designation':'designation',
                'Quantité': 'quantite',
                'Date de péromption': 'date_peromption',
                'Prix PPA':'prix_ppa',
                'Prix Net':'prix_net',
                'Prix TR' : 'prix_tr',
                'Consommation PPA': 'conso_ppa',
                'Consommation Net':'conso_net',
                'Consommation TR': 'conso_tr',
            },
            sorties : [], 
            sortie : {},
            entreesFields : {
                'Facture':'num_facture',
                'Fournisseur':'fournisseur',
                'Designation':'designation',
                'Quantité': 'quantite',
                'Date de péromption': 'date_peromption',
                'Prix PPA':'prix_ppa',
                'Prix Net':'prix_net',
                'Prix TR' : 'prix_tr',
                'Consommation PPA': 'conso_ppa',
                'Consommation Net':'conso_net',
                'Consommation TR': 'conso_tr',
            },
            entrees : [],
            entree : {},
            dateEntree : String(''),
            dateSortie : String(''),
            
            id : Number(0),
            designation : String(''),
            quantite : Number(0),
            prix_ppa : Number(0),
            prix_tr : Number(0),
            prix_net : Number(0),
            date_peromption : Date(),
            facture : String(''),
            factures : [],
            fournisseur : String(''),
            fournisseurs : [],
            destinations : [],
            destination  : String(''),
            ordonnance : String(''),
            reste : Number(0),

            totalDestinations : [],

            filterDesignationS:'',
            filterDateS:'',
            filterQuantiteS:'',
            filterPPAS:'',
            filterNETS:'',
            filterTRS:'',
            filterCPPAS:'',
            filterCNETS:'',
            filterCTRS:'',
            filterOrdonnance : '',
            filterDestination : '',

            filterDesignationE:'',
            filterDateE:'',
            filterQuantiteE:'',
            filterPPAE:'',
            filterNETE:'',
            filterTRE:'',
            filterCPPAE:'',
            filterCNETE:'',
            filterCTRE:'',
            filterFacture : '',
            filterFournisseur : '',
        }
    },
    watch : {
        facture : function(val){
            var trouve = false;
            for (let index = 0; index < this.factures.length && trouve == false ;index++){
                if(this.factures[index]['numero'] == val){
                    trouve = true
                    this.fournisseur = this.factures[index]['fournisseur']
                }
            }
        }
    },
    methods: {
        prepareEntree(id,designation,prix_ppa,prix_tr,prix_net,quantite, date_peromption,facture){
            this.id = id 
            this.prix_ppa = prix_ppa
            this.prix_tr = prix_tr
            this.prix_net = prix_net
            this.quantite = quantite
            this.date_peromption = date_peromption
            this.designation = designation
            this.facture = facture
        },
        prepareSortie(id,designation,prix_ppa,prix_tr,prix_net,quantite, date_peromption,ordonnance,destination){
            this.id = id 
            this.prix_ppa = prix_ppa
            this.prix_tr = prix_tr
            this.prix_net = prix_net
            this.quantite = quantite
            this.date_peromption = date_peromption
            this.designation = designation
            this.destination = destination
            this.ordonnance = ordonnance
            axios.post('/getResteProduit',{
                id : this.id
            })
            .then((response)=>{
                console.log(response.data)
                this.reste = response.data;
            },(error)=>{
                alert(error);
            })
        },
        getListeEntree(){
            axios.post('/listeEntree',{
                dateEntree : this.dateEntree , 
            })
            .then((response)=>{
                this.entrees = response.data
                for (let index = 0; index < this.entrees.length; index++) {
                    this.entrees[index].conso_ppa = this.entrees[index].prix_ppa * this.entrees[index].quantite
                    this.entrees[index].conso_tr = this.entrees[index].prix_tr * this.entrees[index].quantite
                    this.entrees[index].conso_net = this.entrees[index].prix_net     * this.entrees[index].quantite
                }
                console.log(this.entrees);
            },(error)=>{
                alert(error);
            })
        },
        updateEntree(){
            axios.post('/updateEntree',{
                dateEntree : this.dateEntree , 
                facture : this.facture, 
                quantite : this.quantite , 
                produitID : this.id,
            })
            .then((response)=>{
                this.getListeEntree()
                $('#editEntreeModal').modal('hide');
                $('.modal-backdrop').remove()
            },(error)=>{
                alert(error);
            })
        },
        deleteEntree(){
            axios.post('/deleteEntree',{
                dateEntree : this.dateEntree , 
                facture : this.facture, 
                produitID : this.id, 
            })
            .then((response)=>{
                this.getListeEntree()
                $('#deleteEntreeModal').modal('hide');
                $('.modal-backdrop').remove()
            },(error)=>{
                alert(error);
            })
        },


        getListeSortie(){
            axios.post('/listeSorties',{
                dateSortie : this.dateSortie , 
            })
            .then((response)=>{
                this.sorties = response.data
                for (let index = 0; index < this.sorties.length; index++) {
                    this.sorties[index].conso_ppa = this.sorties[index].prix_ppa * this.sorties[index].quantite
                    this.sorties[index].conso_tr = this.sorties[index].prix_tr   * this.sorties[index].quantite
                    this.sorties[index].conso_net = this.sorties[index].prix_net * this.sorties[index].quantite
                }
            },(error)=>{
                alert(error);
            })
        },
        updateSortie(){
            if(this.reste - this.quantite < 0){
                alert('La quantité que vous essayer de sortir est supérieure à ce que vous avez en stock');
            }else{
                axios.post('/updateSortie',{
                    dateSortie : this.dateSortie , 
                    produitID : this.id, 
                    ordonnance : this.ordonnance,
                    quantite : this.quantite , 
                    destination : this.destination
                })
                .then((response)=>{
                    $('#editSortieModal').modal('hide');
                    $('.modal-backdrop').remove()
                    this.getListeSortie();
                },(error)=>{
                    alert(error);
                })
            }
            
        },
        deleteSortie(){
            axios.post('/deleteSortie',{
                dateSortie : this.dateSortie , 
                ordonnance : this.ordonnance, 
                produitID : this.id, 
            })
            .then((response)=>{
                $('#deleteSortieModal').modal('hide');
                $('.modal-backdrop').remove()
                this.getListeSortie();
            },(error)=>{
                alert(error);
            })
        },

        getListeDestination() {
            axios.get("/getListeDestination")
            .then((response)  =>  {
                this.destinations = response.data
                for (let index = 0; index < this.destinations.length; index++) {
                    this.destinations[index]['value'] = this.destinations[index]['destination']
                    this.destinations[index]['text']  = this.destinations[index]['destination']
                }
            }, (error)  =>  {
                alert(error);
            })
        },

        getListeFactures(){
            axios.get("/getListeFacture")
            .then((response)  =>  {
                this.factures = response.data
                for (let index = 0; index < this.factures.length; index++) {
                    this.factures[index]['value'] = this.factures[index]['numero']
                    this.factures[index]['text']  = this.factures[index]['numero']
                }
            }, (error)  =>  {
                alert(error);
            })
        },

        getTotalDestination(){
            axios.post('/getTotalDestination',{
                dateSortie : this.dateSortie,
            })
            .then((response)=>{
                this.totalDestinations = response.data
                console.log(this.totalDestinations)
            },(error)=>{
                alert(error);
            })
        }
    },
    computed : {
        filteredListS() {
            var tableau = JSON.parse(JSON.stringify(this.sorties))
            if(this.filterDestination.length >0){
                tableau = tableau.filter( produit=> 
                produit.destination.toUpperCase().includes(this.filterDestination.toUpperCase()) );
            }
            if(this.filterOrdonnance.length >0){
                tableau = tableau.filter( produit=> 
                produit.num_ordonnance.toUpperCase().includes(this.filterOrdonnance.toUpperCase()) );
            }
            if(this.filterDesignationS.length >0){
                tableau = tableau.filter( produit=> 
                produit.designation.toUpperCase().includes(this.filterDesignationS.toUpperCase()) );
            }
            if(this.filterDateS.length >0){
                tableau = tableau.filter( produit=> 
                produit.date_peromption.toUpperCase().includes(this.filterDateS.toUpperCase()) );
            }
            if(this.filterQuantiteS.length >0){
                tableau = tableau.filter( produit=> 
                produit.quantite.toString().toUpperCase().includes(this.filterQuantiteS.toUpperCase()) );
            }
            if(this.filterPPAS.length >0){
                tableau = tableau.filter( produit=> 
                produit.prix_ppa.toString().toUpperCase().includes(this.filterPPAS.toUpperCase()) );
            }
            if(this.filterTRS.length >0){
                tableau = tableau.filter( produit=> 
                produit.prix_tr.toString().toUpperCase().includes(this.filterTRS.toUpperCase()) );
            }
            if(this.filterNETS.length >0){
                tableau = tableau.filter( produit=> 
                produit.prix_net.toString().toUpperCase().includes(this.filterNETS.toUpperCase()) );
            }
            if(this.filterCPPAS.length >0){
                tableau = tableau.filter( produit=> 
                produit.conso_ppa.toString().toUpperCase().includes(this.filterCPPAS.toUpperCase()) );
            }
            if(this.filterCTRS.length >0){
                tableau = tableau.filter( produit=> 
                produit.conso_tr.toString().toUpperCase().includes(this.filterCTRS.toUpperCase()) );
            }
            if(this.filterCNETS.length >0){
                tableau = tableau.filter( produit=> 
                produit.conso_net.toString().toUpperCase().includes(this.filterCNETS.toUpperCase()) );
            }


            return tableau;
        },

        filteredListE() {
            var tableau = JSON.parse(JSON.stringify(this.entrees))
            if(this.filterFacture.length >0){
                tableau = tableau.filter( produit=> 
                produit.num_facture.toUpperCase().includes(this.filterFacture.toUpperCase()) );
            }
            if(this.filterFournisseur.length >0){
                tableau = tableau.filter( produit=> 
                produit.fournisseur.toUpperCase().includes(this.filterFournisseur.toUpperCase()) );
            }
            if(this.filterDesignationE.length >0){
                tableau = tableau.filter( produit=> 
                produit.designation.toUpperCase().includes(this.filterDesignationE.toUpperCase()) );
            }
            if(this.filterDateE.length >0){
                tableau = tableau.filter( produit=> 
                produit.date_peromption.toUpperCase().includes(this.filterDateE.toUpperCase()) );
            }
            if(this.filterQuantiteE.length >0){
                tableau = tableau.filter( produit=> 
                produit.quantite.toString().toUpperCase().includes(this.filterQuantiteE.toUpperCase()) );
            }
            if(this.filterPPAE.length >0){
                tableau = tableau.filter( produit=> 
                produit.prix_ppa.toString().toUpperCase().includes(this.filterPPAE.toUpperCase()) );
            }
            if(this.filterTRE.length >0){
                tableau = tableau.filter( produit=> 
                produit.prix_tr.toString().toUpperCase().includes(this.filterTRE.toUpperCase()) );
            }
            if(this.filterNETE.length >0){
                tableau = tableau.filter( produit=> 
                produit.prix_net.toString().toUpperCase().includes(this.filterNETE.toUpperCase()) );
            }
            if(this.filterCPPAE.length >0){
                tableau = tableau.filter( produit=> 
                produit.conso_ppa.toString().toUpperCase().includes(this.filterCPPAE.toUpperCase()) );
            }
            if(this.filterCTRE.length >0){
                tableau = tableau.filter( produit=> 
                produit.conso_tr.toString().toUpperCase().includes(this.filterCTRE.toUpperCase()) );
            }
            if(this.filterCNETE.length >0){
                tableau = tableau.filter( produit=> 
                produit.conso_net.toString().toUpperCase().includes(this.filterCNETE.toUpperCase()) );
            }
            return tableau;
        }
    },
    beforeMount(){
        this.dateEntree = this.$props.date
        this.dateSortie = this.$props.date
        this.getListeEntree();
        this.getListeSortie();
        this.getListeFactures();
        this.getListeDestination();
    }
}
</script>

<style>
    .sorties,
    .entrees{
        padding: 0 ! important; 
        width: 100%;
        margin-left : auto;
        margin-right: auto;
        max-height: 7cm;
        overflow: auto;
    }

    .table-custom{
        width: 100%;
    }
    .table-custom thead{
        border : 1px solid #435169 !important;
    }
    .table-custom thead th{
        font-size: 14px;
        font-weight: bold;
        text-shadow: 1px 1px #3e5170;
        border : 1px solid #435169 !important;
        background : linear-gradient(#4c5c79,#4e5d7c)!important;
        color : #dae2f0!important;
        border-collapse: collapse;
    }
    .table-custom th input{
        background-color: #34445f;
        border: 1px solid transparent;
        max-height: .7cm;
        padding: 5px;
        color: white;
        border-radius: 5px;
    }
    .table-custom thead{
        border : 1px solid #bbc5d6 !important;
    }
    .table-custom tbody tr {
        border: 1px solid #bbc5d6;
    }
    .table-custom tbody tr td{
        border: 1px solid #bbc5d6;
        padding-top: 0;
        padding-bottom: 0;
        font-size: 12px;
        color: #2c3e50;
        background-color: #d6e1f3;
    }

    .table-custom thead:nth-child(1) th {
        padding-top : 0 !important ; 
        padding-bottom : 0 !important;
    }
</style>