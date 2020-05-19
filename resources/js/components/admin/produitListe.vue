<template>
    <div class="content">

        <div class="modal fade" id="deleteProduitModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Suppression de l'article :</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   Voulez-vous vraiment supprimer cet article ? il ne sera plus visible et plus accessible
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-danger mr-auto" 
                    @click="deleteArticle(idToDelete)">
                        Supprimer
                    </button>
                    <button class="btn" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>


        <div class="modal fade" id="importProduitModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Importation d'un fichier de produits :</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <span style="text-align:center">
                            Importer un fichier aura pour effet de remplacer les produit présents au 
                            niveau du stock par des produit présent sur le fichier à importer 
                        </span>
                        <br>
                        <br>
                        <input type="file" v-on:change="handleFileUpload()" id="file" ref="file">
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" @click="impotrFile()" class="btn btn-success mr-auto" >
                            Importer
                        </button>
                        <button  data-dismiss="modal" class="btn btn-secondary">
                            Fermer
                        </button>
                    </div>
                
                </div>
            </div>
        </div>


        <div class="modal fade" id="editProduitModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Modifier un produit</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="editProduit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label >Désignation</label>
                                <input class="form-control input" maxlength="100"
                                placeholder="Désignation" v-model="designation" required>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label >Quantité</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="Quantite" v-model="quantite" required>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label >Date de péromption</label>
                                <input class="form-control input" type="date"
                                placeholder="Date de péromption" v-model="date_peromption"
                                required>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                 <label >Prix PPA</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="Prix ppa" v-model="prix_ppa"  step="0.01" required>
                               
                            </div>
                            <div class="form-group col-md-4">
                                <label >Prix TR</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="prix TR" v-model="prix_tr"  step="0.01" required>
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label >Prix Net</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="prix Net" v-model="prix_net"  step="0.01" required>
                                
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


        <div class="modal fade" id="entreeProduitModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Nouvelle Entrée</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="newEntree">
                    <div class="modal-body">
                        <div class="row col-md-12">
                             <div class="col-md-6">
                                <model-select
                                    :options="designations"
                                    v-model="produitSelected"
                                    placeholder="Désignation">
                                </model-select>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label >Désignation</label>
                                <input class="form-control input" maxlength="100"
                                placeholder="Désignation" v-model="designation" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label >Date de péromption</label>
                                <input class="form-control input" type="date"
                                placeholder="Date de péromption" v-model="date_peromption"
                                required>
                            </div>
                            <div class="form-group col-md-3">
                                 <label >Prix PPA</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="Prix ppa" v-model="prix_ppa" min="0"  step="0.01" required>
                               
                            </div>
                            <div class="form-group col-md-3">
                                <label >Prix TR</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="prix TR" v-model="prix_tr" min="0"  step="0.01" required>
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label >Prix Net</label>
                                <input class="form-control input" type="number" maxlength="100"
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
                                <label >Date d'entrée</label>
                                <input class="form-control input" type="date"
                                placeholder="Date de péromption" v-model="dateEntree"
                                required>
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

        <div class="modal fade" id="sortieProduitModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Nouvelle Sortie</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                
                <form v-on:submit.prevent="newSortie">
                    <div class="modal-body">
                        <div class="row col-md-12">
                            <div class="col-md-6">
                                <model-select
                                    :options="designations"
                                    v-model="produitSelected"
                                    placeholder="Désignation">
                                </model-select>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-6">
                                <label >Quantité restante</label>
                                <input class="form-control input" type="number" maxlength="100"
                                placeholder="Quantite" min="1" v-model="reste" required disabled>
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
                                <label >Date de sortie</label>
                                <input class="form-control input" type="date"
                                placeholder="Date de péromption" v-model="dateSortie"
                                required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Ordonnance</label>
                                <input class="form-control input" required
                                placeholder="Ordonnance" v-model="ordonnance">
                            </div>
                            <div class="col-md-3">
                                <label>Destination</label>
                                <model-select
                                    :options="destinations"
                                    v-model="destination"
                                    placeholder="Destination">
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
        



        <span  class="row col-md-12">
            <button class="btn btn-info"    data-target="#sortieProduitModal" data-toggle="modal">Sorties</button>
            <button class="btn btn-primary" data-target="#entreeProduitModal" data-toggle="modal">Entrées</button>
            <button class="btn btn-success" data-target="#importProduitModal" data-toggle="modal">Importer</button>
            <download-excel :data = "produits" :fields="produitsFields" class="button-fixed" > 
                <button id="downlaod_excel" class="btn btn-warning">Exporter</button>
            </download-excel>
        </span>
        
        <div class="container-table">
            <table class="table table-articles">
                <thead>
                    <th>Designation</th>
                    <th>Date de péromption</th>
                    <th>Quantité</th>
                    <th>Consommation</th>
                    <th>Inventaire</th>
                    <th>Prix PPA</th>
                    <th>Prix Net</th>
                    <th>Prix TR</th>
                    <th>Conso PPA</th>
                    <th>Conso Net</th>
                    <th>Conso TR</th>
                    <th>Total PPA</th>
                    <th>Total Net</th>
                    <th>Total TR</th>
                    <th></th>
                    <th></th>
                </thead>
                <thead>
                    <th><input v-model="filterDesignation"></th>
                    <th><input v-model="filterDate"></th>
                    <th><input v-model="filterQuantite"></th>
                    <th><input v-model="filterConso"></th>
                    <th><input v-model="filterInvent"></th>
                    <th><input v-model="filterPPA"></th>
                    <th><input v-model="filterNET"></th>
                    <th><input v-model="filterTR"></th>
                    <th><input v-model="filterCPPA"></th>
                    <th><input v-model="filterCNET"></th>
                    <th><input v-model="filterCTR"></th>
                    <th><input v-model="filterTPPA"></th>
                    <th><input v-model="filterTNET"></th>
                    <th><input v-model="filterTTR"></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="produit in filteredList" :key="produit.id" 
                    v-bind:class="{ 'perime' : perime(produit.date_peromption), 
                                    'rupture' : ruptureStock(produit.inventaire, produit.quantite), 
                                    'pre-preomption' : prePeromption(produit.date_peromption) }">
                        <td>
                            {{produit.designation}}
                        </td>
                        <td>
                            {{produit.date_peromption | moment('DD/MM/YYYY') }}
                        </td>
                        <td>
                            {{produit.quantite}}
                        </td>
                        <td>
                            {{produit.consommation}}
                        </td>
                        <td>
                            {{produit.inventaire}}
                        </td>
                        <td>
                            {{produit.prix_ppa.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.prix_net.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.prix_tr.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.conso_ppa.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.conso_net.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.conso_tr.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.total_ppa.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.total_net.toFixed(2)}}
                        </td>
                        <td>
                            {{produit.total_tr.toFixed(2)}}
                        </td>
                        <td>
                            <i class="material-icons" 
                            @click="prepareForm(produit.id,produit.designation,produit.prix_ppa,produit.prix_tr,produit.prix_net,produit.quantite, produit.date_peromption)"
                            data-toggle="modal" data-target="#editProduitModal">
                                edit
                            </i>
                        </td>
                        <td>
                            <i class="material-icons" @click="selectProduit(produit.id)"
                            data-toggle="modal" data-target="#deleteProduitModal">
                                delete
                            </i>
                        </td>

                    </tr>
                </tbody>
                
            </table>
        </div>
        <br>
        <div class="row col-md-12">
            <div class="col-md-4 mr-auto row info-globale">
                <div class="row">
                    <div class="container-Input col-md-4">
                        <div>Conso Globale (PPA)</div>
                        <div>{{conso_g_ppa.toFixed(2) + ' DA'}}</div>
                    </div>
                    <div class="container-Input col-md-4 mr-auto ml-auto">
                        <div>Conso Globale (NET)</div>
                        <div>{{conso_g_net.toFixed(2) + ' DA'}}</div>
                    </div>
                    <div class="container-Input col-md-4">
                        <div>Conso Globale (TR)</div>
                        <div>{{conso_g_tr.toFixed(2) + ' DA'}}</div>
                    </div>
                </div>
            </div>
            <vc-calendar class="ml-auto mr-auto col-md-4"
                @dayclick="clickDay($event)"
                is-inline
                is-dark
                :key="vCalendarKey"
                :attributes="attributes"
                :locale="{ id: 'fr', firstDayOfWeek: 1}"
                />
            <div class="ml-auto col-md-4 row info-globale">
                <div class="container-Input col-md-4">
                    <div>Total Global (PPA)</div>
                    <div>{{total_g_ppa.toFixed(2) + ' DA'}}</div>
                </div>
                <div class="container-Input col-md-4 mr-auto ml-auto">
                    <div>Total Global (NET)</div>
                    <div>{{total_g_net.toFixed(2) + ' DA'}}</div>
                </div>
                <div class="container-Input col-md-4">
                    <div>Total Global (TR)</div>
                    <div>{{total_g_tr.toFixed(2) + ' DA'}}</div>
                </div>
            </div>
        </div>
        
        
        <br>
    </div>
</template>

<script>
     export default {
        data() {
            return {
                produitsFields : {
                    'Designation':'designation',
                    'Date de péromption':'date_peromption',
                    'Quantité':'quantite',
                    'Consommation':'consommation',
                    'Inventaire':'inventaire',
                    'Prix PPA':'prix_ppa',
                    'Prix Net':'prix_net',
                    'Prix TR':'prix_tr',
                    'Conso PPA':'conso_ppa',
                    'Conso Net':'conso_net',
                    'Conso TR':'conso_tr',
                    'Total PPA':'total_ppa',
                    'Total Net':'total_net',
                    'Total TR':'total_tr',
                },
                attributes: [
                    {
                        highlight: 'yellow',
                        contentStyle: {
                            color: 'white',                 // White text
                        },
                        dates: [],
                    },
 
                ],
                vCalendarKey : Number(0),
                conso_g_ppa : Number(0),
                conso_g_net : Number(0),
                conso_g_tr : Number(0),

                total_g_ppa : Number(0),
                total_g_net : Number(0),
                total_g_tr : Number(0),
                
                reste : Number(0),
                produits : [],
                idToDelete : Number,
                file : '',
                designation : String(''),
                produitSelected : Number(0),
                id : Number(0),
                designations : [],
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
                dateSortie : Date(),
                dateEntree : Date(),

                error : Number(0),

                filterDesignation:'',
                filterDate:'',
                filterQuantite:'',
                filterConso:'',
                filterInvent:'',
                filterPPA:'',
                filterNET:'',
                filterTR:'',
                filterCPPA:'',
                filterCNET:'',
                filterCTR:'',
                filterTPPA:'',
                filterTNET:'',
                filterTTR:'',
            }
        },
        watch : {
            produitSelected : function(val){
                this.setEntreeInfo(val)
            },
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
        methods : {
            ruptureStock(invent, quantite){
                if(invent <= quantite * 0.2){
                    
                    return true;
                }else {
                    return false; 
                }
            },
            perime(peromption){
                var today = new Date();
                var datePeromption = new Date(peromption)

                var diff = datePeromption.getTime() - today.getTime()
                diff = diff /(1000*60*60*24)
                if(diff <= 0 ){
                    return true;
                }else {
                    return false; 
                }
            },
            prePeromption(peromption){
                var today = new Date();
                var datePeromption = new Date(peromption)

                var diff = datePeromption.getTime() - today.getTime()
                diff = diff /(1000*60*60*24)
                console.log(diff)
                if(diff <= 180 && diff > 0 ){
                    return true;
                }else {
                    return false; 
                }
            },
            newEntree(){
                axios.post('/newEntree',{
                    dateEntree : this.dateEntree , 
                    facture : this.facture, 
                    quantite : this.quantite , 
                    designation : this.designation,
                    datePeromption :this.date_peromption,
                    prixNet :this.prix_net,
                    prixPpa :this.prix_ppa,
                    prixTr :this.prix_tr,
                })
                .then((response)=>{
                    this.produitSelected = '';
                    this.reste = 0;
                    this.date_peromption = ''; 
                    this.prix_ppa= 0;
                    this.prix_tr = 0 
                    this.prix_net = 0
                    this.getlisteProduits();
                    this.getListeEntree();
                    alert('Entrée effectuée');
                },(error)=>{
                    alert(error);
                })
            },
            newSortie(){
                if(this.reste - this.quantite < 0){
                    alert('La quantité que vous essayer de sortir est supérieure à ce que vous avez en stock');
                }else{
                    axios.post('/newSortie',{
                        dateSortie : this.dateSortie , 
                        ordonnance : this.ordonnance, 
                        produit: this.produitSelected, 
                        quantite : this.quantite , 
                        destination : this.destination,
                    })
                    .then((response)=>{
                        this.produitSelected = '';
                        this.reste = 0;
                        this.date_peromption = ''; 
                        this.prix_ppa= 0;
                        this.prix_tr = 0 
                        this.prix_net = 0
                        if(response.data['code'] == 1){
                            alert();
                            $('#downlaod_excel').click();
                        }
                        this.getlisteProduits();
                        alert('Sortie effectuée');
                    },(error)=>{
                        alert(error);
                    })
                }
                
            },

            setEntreeInfo(id){
                var i = 0
                var trouve = false; 
                while (i < this.produits.length && trouve == false) {
                    if(id == this.produits[i]['id']){
                        this.designation = this.produits[i]['designation']
                        this.date_peromption = this.produits[i]['date_peromption']
                        this.prix_ppa = this.produits[i]['prix_ppa']
                        this.prix_net = this.produits[i]['prix_net']
                        this.prix_tr = this.produits[i]['prix_tr']
                        this.reste = this.produits[i]['inventaire'];
                        trouve = true  
                    }else{
                        i=i+1
                    }
                }
            },
            getListeEntree(){
                axios.get('/listeAllEntree')
                .then((response)=>{
                    console.log(response.data);
                    this.attributes[0]['dates'] = [];
                    for (let index = 0; index < response.data.length; index++) {
                        this.attributes[0]['dates'].splice(0,0,response.data[index]['date_entree'])
                    }
                    this.vCalendarKey = this.vCalendarKey +1
                },(error)=>{
                    this.error++;
                    if(this.error <=1){
                        alert(error);
                    }
                    
                })
            },
            clickDay(event){
                console.log(event['id']);
                console.log(this.attributes)
                let routeData = this.$router.resolve('entreesortie/'+event['id']);
                window.open(routeData.href, '_blank');
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
                console.log(this.file);
            },
            getlisteProduits(){
                console.log('lol')
                axios.get('/getListeProduits')
                .then((response)=>{
                    this.total_g_ppa = 0
                    this.total_g_net = 0
                    this.total_g_tr  = 0

                    this.conso_g_ppa = 0
                    this.conso_g_net = 0
                    this.conso_g_tr  = 0

                    this.designations = []
                    this.produits = response.data
                    for (let index = 0; index < this.produits.length; index++) {
                        this.designations.push({
                            'value' : this.produits[index]['id'], 
                            'text' : this.produits[index]['designation'],
                        });
                        if(this.produits[index]['inventaire'] == null){
                            this.produits[index]['inventaire'] = 0
                        }
                        if(this.produits[index]['consommation'] == null){
                            this.produits[index]['consommation'] = 0
                        }
                        this.produits[index]['inventaire'] = this.produits[index]['quantite'] - this.produits[index]['consommation']
                        this.produits[index]['total_ppa'] = this.produits[index]['prix_ppa'] * this.produits[index]['inventaire']
                        this.produits[index]['total_net'] = this.produits[index]['prix_net'] * this.produits[index]['inventaire']
                        this.produits[index]['total_tr'] = this.produits[index]['prix_tr'] * this.produits[index]['inventaire']
                        this.produits[index]['conso_ppa'] = this.produits[index]['prix_ppa'] * this.produits[index]['consommation']
                        this.produits[index]['conso_net'] = this.produits[index]['prix_net'] * this.produits[index]['consommation']
                        this.produits[index]['conso_tr'] = this.produits[index]['prix_tr'] * this.produits[index]['consommation']
                    
                        this.total_g_ppa += this.produits[index]['total_ppa']
                        this.total_g_net += this.produits[index]['total_net']
                        this.total_g_tr  += this.produits[index]['total_tr']

                        this.conso_g_ppa += this.produits[index]['conso_ppa']
                        this.conso_g_net += this.produits[index]['conso_net']
                        this.conso_g_tr  += this.produits[index]['conso_tr']
                    }
                },(error)=>{
                    this.error++;
                    if(this.error <= 1){
                        alert(error);
                    }
                    
                });
            },
            prepareForm(id,designation,ppa,tr,net,quant,date){
                this.designation = designation 
                this.prix_ppa = ppa 
                this.prix_tr = tr ;
                this.prix_net = net 
                this.quantite = quant 
                this.date_peromption = date
                this.id = id;
            },
            selectProduit(id){
                this.idToDelete = id;
            },
            editProduit(){
                axios.post('/updateProduit',{
                    'designation':this.designation,
                    'prixPpa':this.prix_ppa, 
                    'prixTr':this.prix_tr,
                    'prixNet':this.prix_net, 
                    'quantite':this.quantite, 
                    'datePeromption':this.date_peromption,
                    'id':this.id,
                })
                .then((response)=>{
                    $('#editProduitModal').modal('hide');
                    $('.modal-backdrop').remove()
                    this.getlisteProduits();
                    
                },(error)=>{
                    alert(error);
                })
            },
            deleteArticle(){
                axios.post('/deleteProduit',{
                    id : this.idToDelete
                })
                .then((response)=>{
                    $('#deleteProduitModal').modal('hide');
                    $('.modal-backdrop').remove()
                    this.getlisteProduits();
                    
                },(error)=>{
                    alert(error);
                })
            },
            impotrFile(){
                let formData = new FormData();
                formData.append('file',this.file)
                
                axios.post('/importer',formData,{headers: {'Content-Type': 'multipart/form-data' }} )
                .then((response)=>{
                    $('#importProduitModal').modal('hide');
                    $('.modal-backdrop').remove()
                    this.getlisteProduits();
                    this.file = '';
                    this.$refs.file = [];
                },(error)=>{
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
        },
        computed: {

            filteredList() {
                var tableau = JSON.parse(JSON.stringify(this.produits))
                if(this.filterDesignation.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.designation.toUpperCase().includes(this.filterDesignation.toUpperCase()) );
                }
                if(this.filterDate.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.date_peromption.toUpperCase().includes(this.filterDate.toUpperCase()) );
                }
                if(this.filterQuantite.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.quantite.toString().includes(this.filterQuantite) );
                }
                if(this.filterConso.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.consommation.toString().toUpperCase().includes(this.filterConso.toUpperCase()) );
                }
                if(this.filterInvent.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.inventaire.toString().toUpperCase().includes(this.filterInvent.toUpperCase()) );
                }
                if(this.filterPPA.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.prix_ppa.toString().toUpperCase().includes(this.filterPPA.toUpperCase()) );
                }
                if(this.filterTR.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.prix_tr.toString().toUpperCase().includes(this.filterTR.toUpperCase()) );
                }
                if(this.filterNET.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.prix_net.toString().toUpperCase().includes(this.filterNET.toUpperCase()) );
                }
                if(this.filterTPPA.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.total_ppa.toString().toUpperCase().includes(this.filterTPPA.toUpperCase()) );
                }
                if(this.filterTTR.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.total_tr.toString().toUpperCase().includes(this.filterTTR.toUpperCase()) );
                }
                if(this.filterTNET.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.total_net.toString().toUpperCase().includes(this.filterTNET.toUpperCase()) );
                }
                if(this.filterCPPA.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.conso_ppa.toString().toUpperCase().includes(this.filterCPPA.toUpperCase()) );
                }
                if(this.filterCTR.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.conso_tr.toString().toUpperCase().includes(this.filterCTR.toUpperCase()) );
                }
                if(this.filterCNET.length >0){
                    tableau = tableau.filter( produit=> 
                    produit.conso_net.toString().toUpperCase().includes(this.filterCNET.toUpperCase()) );
                }
                return tableau;
            }
        },

        beforeMount(){
            this.getlisteProduits();
            this.getListeFactures();
            this.getListeEntree();
            this.getListeDestination();
            $(window).focus( $.proxy(function(){
                this.getlisteProduits()
                this.getListeEntree();
            },this));
        },
        created(){
            
        },
    }
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto');
     *:not(.material-icons){
        font-family :'Roboto' !important;
    }
    .container-table{
        max-height: 8cm;
        overflow: auto;
    }
    .table-articles{
        width: 100%;
    }
    .table-articles thead{
        border : 1px solid #435169 !important;
    }
    .table-articles thead th{
        font-size: 14px;
        font-weight: bold;
        text-shadow: 1px 1px #3e5170;
        border : 1px solid #435169 !important;
        background : linear-gradient(#4c5c79,#4e5d7c)!important;
        color : #dae2f0!important;
        border-collapse: collapse;
    }
    .table-articles th input{
        background-color: #34445f;
        border: 1px solid transparent;
        max-height: .7cm;
        padding: 5px;
        color: white;
        border-radius: 5px;
    }
    .table-articles thead{
        border : 1px solid #bbc5d6 !important;
    }
    .table-articles tbody tr {
        border: 1px solid #bbc5d6;
    }
    .table-articles tbody tr td{
        border: 1px solid #bbc5d6;
        padding-top: 0;
        padding-bottom: 0;
        font-size: 12px;
        color: #2c3e50;
        background-color: #d6e1f3;
    }
    .container-input{
        display: flex;
        flex-direction: column;
    }
    .info-globale{
        font-size: 14px;
        font-weight: bold;
    }
    .info-globale:nth-child(1){
        color: #ffb600;
    }
    .info-globale:nth-child(3){
        color: #FF0000;
    }


    .table-articles tbody tr.pre-preomption td{
        background-color: rgb(255, 17, 0) !important;
        transition: all 5s ease-in;
    }
    
    .table-articles tbody tr.perime td{
        background-color: rgba(255, 0, 234, 0.479) !important;
    }
    
    .table-articles tbody tr.rupture td{
        background-color: rgba(29, 29, 29, 0.671) !important;
        color: white;
    }

</style>