<template>
    <div class="container my-5">
        <form @submit.prevent="SendSuggest()" @keydown="form.onKeydown($event)" >
        <div class="row justify-content-md-center align-items-center">
            <div class="col-lg-6 p-5">
                <img src="/images/vendor/suggest.jpg" alt="" class="img-fluid rounded-radius ">
            </div>
            <div class="col-lg-6 text-center">
                <div class="row">
                    <div class="col-lg-6">
                        <sui-container text-align="justified">
                            <p class="h5"><strong>{{ $t('collaborate_yourInf') }}</strong></p>
                            <div class="ui form">
                                <div class="field" :class="{ 'error': form.errors.has('yourname') }">
                                    <label class="ml-3">{{ $t('collaborate_name') }}</label>
                                    <input :placeholder="$t('colaborate_yourname')" class="rounded-pill" v-model="form.yourname" :class="{ 'error': form.errors.has('yourname') }"/>
                                    <has-error :form="form" field="yourname" class="ml-3"/>
                                </div>
                                <div class="field" :class="{ 'error': form.errors.has('youraddress') }">
                                    <label class="ml-3">{{ $t('collaborate_local') }}</label>
                                    <input :placeholder="$t('colaborate_youraddress')" class="rounded-pill" v-model="form.youraddress"  :class="{ 'error': form.errors.has('youraddress') }"/>
                                    <has-error :form="form" field="youraddress" class="ml-3"/>
                                </div>

                                <div class="field" :class="{ 'error': form.errors.has('yourphone') }">
                                    <label class="ml-3">{{ $t('collaborate_phone') }}</label>
                                    <input type="number" :placeholder="$t('colaborate_yourphone')" class="rounded-pill" v-model="form.yourphone" :class="{ 'error': form.errors.has('yourphone') }"/>
                                    <has-error :form="form" field="yourphone" class="ml-3"/>
                                </div>
                                
                            </div>   
                        </sui-container>    
                    </div>
                    <div class="col-lg-6">
                        <sui-container text-align="justified">
                            <p class="h5"><strong>{{ $t('collaborate_ownerInfo') }}</strong></p>
                            <div class="ui form">
                                <div class="field"  :class="{ 'error': form.errors.has('ownername') }">
                                    <label class="ml-3">{{ $t('collaborate_name') }}</label>
                                    <input :placeholder="$t('colaborate_ownername')" class="rounded-pill"  v-model="form.ownername" :class="{ 'is-invalid': form.errors.has('ownername') }"/>
                                    <has-error :form="form" field="ownername" class="ml-3"/>
                                </div>
                                <div class="field"  :class="{ 'error': form.errors.has('owneraddress') }">
                                    <label class="ml-3">{{ $t('collaborate_local') }}</label>
                                    <input :placeholder="$t('colaborate_owneraddress')" class="rounded-pill"  v-model="form.owneraddress" :class="{ 'is-invalid': form.errors.has('owneraddress') }"/>
                                    <has-error :form="form" field="owneraddress" class="ml-3"/>
                                </div>

                                <div class="field"  :class="{ 'error': form.errors.has('ownerphone') }">
                                    <label class="ml-3">{{ $t('collaborate_phone') }}</label>
                                    <input type="number" :placeholder="$t('colaborate_ownerphone')" class="rounded-pill" v-model="form.ownerphone" :class="{ 'is-invalid': form.errors.has('ownerphone') }"/>
                                    <has-error :form="form" field="ownerphone" class="ml-3"/>
                                </div>                                    
                            </div>   
                        </sui-container>    
                    </div>
                </div>  
                
                <sui-button type="submit" class="text-center mt-4 red">{{$t('collaborate_form_btn')}}</sui-button> 
            </div>
        </div>
        </form>
    </div>
</template>
<script>
import Form from 'vform'
export default {
    data(){
        return {
            form: new Form({
                yourname: '',
                youraddress: '',
                yourphone: '',
                ownername: '',
                owneraddress: '',
                ownerphone: ''
            }),
        }
    },
    methods:{
        async SendSuggest(){
            try {
                const { data } = await this.form.post('api/suggested-properties')
                this.status = data.status
                this.form.reset()
                this.$toastr.defaultStyle = {"background-color": "#21ba45"};
                this.$toastr.s( this.$t('collaborate_success') );
            } catch (error) {
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(this.$t('collaborate_error'));
                console.log(error);
            }
        }
    }
}
</script>