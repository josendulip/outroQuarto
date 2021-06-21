<template>
    <div class="container text-center">
        <div class="row justify-content-center">
            <sui-card style="width: 50%;">
                <sui-card-content>
                <sui-image
                    v-if="!user.photo"
                    src="/images/profile/empty.jpg"
                    class="center mb-3"
                    style="width: 100px; height:100px; object-fit: cover;"
                />
                <sui-image
                v-else
                    :src="user.photo"
                    class="center mb-3"
                    style="width: 100px; height:100px; object-fit: cover;"
                />
                
                <sui-card-header>{{ user.name }}</sui-card-header>
                <sui-card-meta><span class="text-capitalize" v-if="user.role == 'user'"> {{$t('unnouncent_user')}}</span> <span v-if="user.role == 'owner'">{{$t('anouncent_user')}}</span> </sui-card-meta>
                <sui-card-description>
                    {{ user.name }} requested permission to view your contact details
                </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="user === 'User not found'">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ user }}!</strong> You should check if this user really exist.
                    </div>
                    <span v-else>
                         <!-- Email & Name-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="user.name"   class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <input v-model="user.identity"  class="form-control" readonly>
                            </div>
                        </div>

                        <!-- Bith & Identity-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="user.email"  class="form-control" readonly/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="user.password"  class="form-control" readonly/>
                            </div>
                        </div>

                        <!-- phone & city-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="user.birth"  class="form-control" readonly/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="user.phone"  class="form-control" readonly/>
                            </div>
                        </div>

                        <!-- address-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="user.address"  class="form-control" readonly/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="user.city"  class="form-control" readonly/>
                            </div>
                        </div>

                        <!-- birth & city-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="user.country"  class="form-control" readonly/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="user.role"  class="form-control" readonly/>
                            </div>
                        </div>
                    </span>
                    <sui-container text-align="right" class="mt-3">
                        <router-link :to="{name: 'admin.users'}" class="ui button basic tiny secondary">{{ $t('mypanel_back') }}</router-link>
                    </sui-container>
                </sui-card-content>
            </sui-card>
        </div>        
    </div>
</template>

<script>
import axios from "axios";
export default {
    data:() => ({
        user: {}
    }),
    methods:{
        getUser(){
            axios.get("/api/get-user-info/" + this.$route.params.slug).then(({data})=>{this.user = data})
        }
    },
    created() {
        this.getUser();
    },
}
</script>