<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form  @submit.prevent="updateSugest()" @keydown="form.onKeydown($event)">
                        <h4 class="card-title">{{ $t('myadmin_suggestor') }} 
                            <span class="float-right" v-if="form.status == 'unread'"><i class="check icon" style="color:red"></i>{{$t('myadmin_suggest_unread')}}</span>
                            <span class="float-right" v-if="form.status == 'read'"><i class="check icon" style="color:green"></i> {{$t('myadmin_suggest_read')}}</span>
                        </h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >{{ $t('myadmin_suggest_name') }}</label>
                                <input v-model="form.yourname" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                                <has-error :form="form" field="name"  :placeholder="$t('name')" autocomplete="off"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">{{ $t('myadmin_suggest_phone') }}</label>
                                <input type="text" class="form-control" v-model="form.yourphone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ $t('myadmin_suggest_address') }}</label>
                            <input type="text" class="form-control" v-model="form.youraddress">
                        </div>
                        <h4 class="card-title">{{ $t('myadmin_ouner') }}</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" >{{ $t('myadmin_suggest_name') }}</label>
                                <input type="text" class="form-control" v-model="form.ownername">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">{{ $t('myadmin_suggest_phone') }}</label>
                                <input type="text" class="form-control" v-model="form.ownerphone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ $t('myadmin_suggest_address') }}</label>
                            <input type="text" class="form-control" v-model="form.owneraddress">
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="status">State</label>
                            <select id="status" class="form-control" v-model="form.status">
                                <option value="unread">{{$t('myadmin_suggest_unread')}}</option>
                                <option value="read">{{$t('myadmin_suggest_read')}}</option>
                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="button">Action</label><br>
                                <button type="submit" class="btn btn-primary btn-block">{{ $t('save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import axios from "axios";
export default {
    data: () => ({
        form: new Form({
            id: "",
            yourname: "", 
            youraddress:"",
            yourphone: "",
            ownername:"",
            owneraddress:"",
            ownerphone:"",
            status:""
        })
    }), 
    methods: {
        loadSuggest(){
            axios.get("/api/get-suggest/" + this.$route.params.id).then(({data}) => { this.form.fill(data)})
        },
        updateSugest(){
            this.form.put("/api/suggested-properties/" + this.$route.params.id).then(() => {
                Fire.$emit('AfterCreated');
                this.$toastr.defaultStyle = {"background-color": "#21ba45"};
                this.$toastr.s(this.$t('myadmin_user_topMessage5'));  
                this.$router.push({ name: "admin.suggested-property" }); 
            })
            .catch((error) => {
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(this.$t('myadmin_user_topMessage6'));
                console.log(error);
            });
        }
    },
    created(){
        this.loadSuggest()
        /* Fire.$on('AfterCreated', ()=>{ 
            this.loadSuggest();
        }) */
    }
}
</script>