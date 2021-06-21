<template>
    <div class="container text-center">
        <div class="row justify-content-center">
        <sui-card style="width: 50%;">
            <sui-card-content>
            <sui-image
                src="/images/profile/user-default.png" style="width: 70px;"
            />
            <sui-card-header class="my-2">{{ this.form.name }}</sui-card-header>
            <sui-card-meta>{{ this.form.role }}</sui-card-meta>
            <sui-card-description>
                {{ $t("myadmin_user_topMessage1") }}
            </sui-card-description>
            </sui-card-content>
            <sui-card-content extra>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="$route.params.slug == 'null'">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ $route.params.slug }}!</strong> You should check if this user really exist.
                </div>                
                <span v-else>
                    <form @submit.prevent="updateUser()" @keydown="form.onKeydown($event)">
                        <alert-success :form="form" :message="$t('alert_created')" />
                        <!-- Email & Name-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                                <has-error :form="form" field="name"  :placeholder="$t('name')" autocomplete="off"/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="form.identity" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="identity" :placeholder="$t('identity')">
                                <has-error :form="form" field="identity" autocomplete="off" />
                            </div>
                        </div>

                        <!-- Bith & Identity-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                                <has-error :form="form" field="email" :placeholder="$t('placeholder_email')"/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="text" name="password" :placeholder="$t('password')">
                                <has-error :form="form" field="password"/>
                            </div>
                        </div>

                        <!-- phone & city-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <PickDate v-model="form.birth" :placeholder="$t('birth')" name="birth" :class="{ 'is-invalid': form.errors.has('birth') }"></PickDate>
                                <has-error :form="form" field="birth" :placeholder="$t('birth')"/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" type="text" name="phone" :placeholder="$t('placeholder_phone')">
                                <has-error :form="form" field="phone"/>
                            </div>
                        </div>

                        <!-- address-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
                                <has-error :form="form" field="address" :placeholder="$t('placeholder_address')"/>
                            </div>
                            <div class="col-md-6">
                                <input v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" type="text" name="city" :placeholder="$t('city')">
                                <has-error :form="form" field="city" />
                            </div>
                        </div>

                        <!-- birth & city-->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input v-model="form.country" :class="{'is-invalid': form.errors.has('country') }" class="form-control" type="text" name="country" :placeholder="$t('country')">
                                <has-error :form="form" field="country" />
                            </div>
                            <div class="col-md-6">
                                <sui-form-field :class="{'error': form.errors.has('role_user') }">
                                <sui-dropdown
                                    :placeholder="$t('role_user')"
                                    selection
                                    class="w-100"
                                    :options="options"
                                    v-model="form.role"
                                />
                                </sui-form-field>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select v-model="authorizations"  @change="authorizerUser(form.id)" class="form-control">
                                    <option disabled value="">{{ $t('myadmin_user_authorize') }}</option>
                                    <option value="authorized">Authorized</option>
                                    <option value="unauthorized">Unauthorized</option>
                                </select>
                                <!-- <sui-form-field>
                                    <sui-dropdown
                                        :placeholder="$t('myadmin_user_authorize')"
                                        selection
                                        class="w-100"
                                        :options="authorizations"
                                        v-model="authorizations.value"
                                        @change="authorizerUser(form.id)"
                                    />
                                </sui-form-field> -->
                            </div>
                            <div class="col-md-6 ml-md-auto">
                            <v-button :loading="form.busy" type="primary" class="btn-block">
                                {{ $t('update') }}
                            </v-button>
                            </div>
                        </div>
                    </form>
                </span>
                <sui-container text-align="center" class="mt-3">
                    <router-link :to="{name: 'admin.users'}" class="ui button basic tiny secondary">{{ $t('mypanel_back') }}</router-link>
                </sui-container>
            </sui-card-content>
        </sui-card>
        </div>        
    </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import axios from "axios";
import PickDate from "../../components/PickDate.vue";
import datepicker from "../../components/TouchDatePicker.vue";
export default {
    scrollToTop: false,
    name: "admin.edit.user",
    components: { PickDate, datepicker },
    metaInfo () {
        return { title: this.$t('settings') }
    },
    data:() => ({
        form: new Form({
            id:'',
            name: '',
            email: '',
            password: '',
            identity: '',
            birth: '',
            phone: '',
            address: '',
            city: '',
            country: '',
            photo: '',
        }), 
        options: [
            {
                text: 'User',
                value: 'user',
            },
            {
                text: 'Owner',
                value: 'owner',
            },
            {
                text: 'Employer',
                value: 'employer',
            },
            {
                text: 'admin',
                value: 'admin',
            },
        ],
        authorizations: ""
    }),
    methods:{
        authorizerUser(id){
            axios.post('/api/authorize/' + id)
            .then(()=>{
                Fire.$emit('AfterCreated'); // serve para atualizar a pagina dos usuarios 
                                
                this.$toastr.defaultStyle = {"background-color": "#21ba45"};
                this.$toastr.s(this.$t('myadmin_user_topMessage3'));   
                this.$router.push({ name: 'admin.users'});

            })
        },
        getUser(){
            axios.get("/api/get-user-info/" + this.$route.params.slug).then(({data})=>{this.form.fill(data)})
        },
        updateUser(){
            this.form.put("/api/my-users/" + this.form.id).then(() => {
                Fire.$emit('AfterCreated');
                //this.$router.push({ name: "my-panel" });
                this.imagepreview ="";  
                this.$toastr.defaultStyle = {"background-color": "#21ba45"};
                this.$toastr.s(this.$t('myadmin_user_topMessage3'));   
            })
            .catch((error) => {
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(this.$t('myadmin_user_topMessage4'));
                console.log(error);
            });
        },
    },
    computed: mapGetters({
        user: 'auth/user'
    }),

    created() {
        this.getUser();
        Fire.$on('AfterCreated', ()=>{ 
            this.getUser();
        })
    },
}
</script>