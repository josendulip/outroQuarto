<template>
    <div>
        <sui-table single-line class="text-center">
            <sui-table-header>
            <sui-table-row>
                <sui-table-header-cell>Status</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_namw') }}</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_Id') }}</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_Mail') }}</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_phone') }}</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_city') }}</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_role') }}</sui-table-header-cell>
                <sui-table-header-cell>{{  $t('myadmin_user_authorization') }}</sui-table-header-cell>
                <sui-table-header-cell><router-link class="ui button basic fluid tiny secondary" :to="{ name: 'admin.new.user' }">{{  $t('myadmin_user_create') }}</router-link></sui-table-header-cell>
            </sui-table-row>
            </sui-table-header>
            <sui-table-body>
            <sui-table-row v-for="user in users.data" :key="user.id" >
                <sui-table-cell>
                    <a v-if="user.status == 'Active'" class="ui green empty circular label"></a>
                    <a v-if="user.status == 'Inactive'" class="ui red empty circular label"></a>
                </sui-table-cell>
                <sui-table-cell>{{user.name}}</sui-table-cell>
                <sui-table-cell>{{user.identity}}</sui-table-cell>
                <sui-table-cell>{{user.email}}</sui-table-cell>
                <sui-table-cell>{{user.phone}}</sui-table-cell>
                <sui-table-cell>{{user.city}}/{{user.country}}</sui-table-cell> 
                <sui-table-cell>{{user.role}}</sui-table-cell> 
                <sui-table-cell><span v-if="user.authorization == 'authorized'">{{$t('myadmin_user_authorized')}}</span><span v-if="user.authorization == 'unauthorized'">{{$t('myadmin_user_unauthorized')}}</span></sui-table-cell>
                <sui-table-cell>
                    <a class="ui yellow tiny label" @click.prevent="viewUser(user.slug)">View</a>
                    <a class="ui olive tiny label" @click.prevent="editUser(user.slug)">Edit</a>
                    <a class="ui orange tiny label" @click.prevent="deleteUser(user.id)">Delete</a>
                </sui-table-cell>
            </sui-table-row>
            </sui-table-body>
        </sui-table>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import Form from "vform";
import axios from "axios";
export default {
    data(){
        return{
            users: {},
            form: new Form({
                id: '', // Este id eh para editar o user 
                name: '',
                birth: '',
                identity: '',
                email: '',
                email_verified_at: '',
                password: '',
                role: '',
                phone: '',
                photo: '' 
            })
        }
    },
    methods: { 
        editUser(slug) {
        this.$router.push("edit/user/" + slug);
        },
        viewUser(slug) {
        this.$router.push("view/user/" + slug);
        },
        getUsers(){
            axios.get('/api/my-users').then(({data}) => { this.users = {data}})
        },
        deleteUser(id){
                Swal.fire({
                    title: this.$t('question_before_delete'),
                    text: this.$t('explantation_before_delete'),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: this.$t("button_delete")
                }).then((result) => {
                     if (result.value) { //se o resultado for verdadeiro
                        //mandar o request to server
                        this.form.delete('/api/my-users/'+id).then(()=>{
                        
                            Swal.fire(
                                this.$t('deleted'),
                                this.$t('msg_deleted_success'),
                                'success'
                            )
                        Fire.$emit('AfterCreated');   
                        }).catch(()=>{
                            Swal.fire(this.$t('msg_deleted_error'), "error");
                        })
                    }
                })
            },
    },
    created(){
        this.getUsers();
        Fire.$on('AfterCreated', ()=>{ 
            this.getUsers();
        })
    }
}
</script>