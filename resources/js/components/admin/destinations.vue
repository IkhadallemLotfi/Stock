<template>
    <div class="container">


        <div class="modal fade" id="deleteDestinationModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Suppression du Destination : {{destinationDelete}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                   Voulez-vous vraiment supprimer cette destnation, si vous procédez vous ne pourrez plus 
                   l'assigner pour de nouveaux employés.
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer mr-auto">
                    <button class="btn btn-success" 
                    @click="deleteDestination(destinationDelete)">
                        Supprimer
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
                
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header card-header-info">
                <h3>Liste des Destination</h3>
            </div>
            <div class="card-body">
                <input v-model="destination" >
                <button type="button" class="btn btn-info" :disabled="destination =='' " @click="addDestination">
                    Ajouter un destination
                </button>
                <table class="table table-fonction table-responsive">
                    <thead>
                        <tr>
                            <th>Destination</th>
                            <th></th>
                        </tr>
                    </thead>
                
                    <tbody >
                        <tr v-for="value in destinations" >
                            <td>
                                <span>{{value.destination }}</span>
                            </td>
                            <td>
                                <i class="material-icons" @click="setDestinationToDelete(value.destination)" 
                                data-toggle="modal" data-target="#deleteDestinationModal">
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
                destinations : [],
                destination : '',
                destinationDelete : String,
            }
        },
        methods : {
            
            getListeDestination() {
                axios.get("/getListeDestination")
                .then((response)  =>  {
                    this.destinations = response.data
                }, (error)  =>  {
                    alert(error);
                })
            },

            addDestination(){
                axios.post("/addDestination",{destination:this.destination})
                .then((response)  =>  {
                    this.destination = '';
                    this.getListeDestination();

                }, (error)  =>  {
                    alert(error);
                });
            },

            deleteDestination(destination){
                axios.delete("/deleteDestination/"+destination+"")
                .then((response) => {
                    this.getListeDestination();
                    $('#deleteDestinationModal').modal('hide');
                    $('.modal-backdrop').remove()
                }, (error)=> {
                    alert(error)
                });
            },

            setDestinationToDelete(destination){
                this.destinationDelete = destination;
            },
        },
        beforeMount(){
            this.getListeDestination();
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