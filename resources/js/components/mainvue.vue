
<template>
    <div class="content-router">
        <div class="modal fade" id="pwdModal">
            <div class="modal-dialog ">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Changer le mot de passe</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <input class="input form-control" type="password" id="old" 
                                placeholder="old password" v-model="oldPass">
                                <label for="old" class="label">Ancien mot de passe :</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <input class="input form-control" type="password" id="new" 
                                placeholder="New passeword" v-model="newPass">
                                <label for="new" class="label">Nouveau mot de passe</label> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <input class="input form-control" type="password" id="newRepeat" 
                                placeholder="New passeword" v-model="repeatPass">
                                <label for="newRepeat" class="label">Répeter le mot de passe</label> 
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" @click="changePass">
                            Modifier le mot de passe
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <router-view></router-view>
    </div>
    
</template>
<script>
    export default {
        data() {
            return {
                oldPass : String,
                newPass : String,
                repeatPass : String,
                user : {},
            }
        },
        methods :{

            changePass(){
                if(this.newPass != this.repeatPass){
                    alert('Les mots de passes doivent correspondre');
                }else if(this.newPass == this.repeatPass){
                    axios.post('/changePassword',{
                        old:this.oldPass,
                        new:this.newPass,
                        repeat : this.repeatPass,
                    }).then((response)=>{
                        alert('modification effectuée avec succès');
                        $('#userModal').modal('hide')
                        $('.modal-backdrop').remove()
                    },(error)=>{
                         alert(error.response['data']['message']);
                    });
                }
            },
        },
        beforeMount(){
            this.oldPass = '';
            this.newPass = '';
            this.repeatPass = '';
        }
    }
</script>

<style lang="scss">
    .content-router{
        overflow-x: auto;
    }
    @media(min-width:991px){
        .content-router{
            margin-left:auto;
            margin-right: auto;
            width: 95%;
        }
    }

    @media(max-width:991px){
        .content-router{
            width:95%;
        }
        .content-router{
            margin : 1cm 0 0 2%;
        }
    }


    @media(max-width:690px){
        .content-router{
            margin : 1cm 0 0 2%;
        }
    }
    #pwsModal,
    #userModal{
        z-index: 20002 !important;
    }

    .user-icon{
        border-radius: 50%;
        border-style: solid;
        border-width: 1px;
        width : 3cm;
        height: 3cm;
        overflow: hidden;
        margin-left : 2%;

        margin-top: .5cm;
    }
    .user-icon img{
        width: 100%;
        height: 100%;
    }
    .photo-row input{
        vertical-align: middle;
        margin-top: 25%;
    }
</style>