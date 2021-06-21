<template>
    <div class="">
        <Navout/>        
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <sui-card class=" rounded-radius py-5 shadow" style="background: url('images/services/1.jpg') no-repeat center center; background-size: cover;">
                                <sui-card-content>
                                    <sui-container text-align="justified">
                                        <p>{{ $t('services_phrase1') }}</p>   
                                    </sui-container>           
                                </sui-card-content>
                            </sui-card>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <sui-card class=" rounded-radius py-5 shadow">
                                <sui-card-content>
                                    <sui-container text-align="justified">
                                        <p>{{ $t('services_phrase1') }}</p>     
                                    </sui-container>           
                                </sui-card-content>
                            </sui-card>
                        </div>
                        <div class="col-lg-6">
                            <sui-card class=" rounded-radius py-5 shadow">
                                <sui-card-content>
                                    <sui-container text-align="justified">
                                        <p>{{ $t('services_phrase2') }}</p>   
                                    </sui-container>           
                                </sui-card-content>
                            </sui-card>
                        </div>
                        <div class="col-lg-6">
                            <sui-card class=" rounded-radius py-5 shadow" style="background: url('images/services/2.jpg') no-repeat center center; background-size: cover;">
                                <sui-card-content>
                                    <sui-container text-align="justified">
                                        <p>{{ $t('services_phrase2') }}</p>    
                                    </sui-container>           
                                </sui-card-content>
                            </sui-card>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

  
                    <sui-grid divided="vertically">
                        <sui-grid-row :columns="2">
                        <sui-grid-column>
                        
                            <!--<sui-card-header class="">
                                <h2 is="sui-header" icon text-align="center">
                                    <sui-label class="massive circular main-red ">
                                        1
                                    </sui-label>
                                </h2>
                                <sui-header-content  class="text-center">{{ $t('personal_data') }} </sui-header-content>
                            </sui-card-header>!-->

                            <sui-form>
                                <sui-form-field>
                                    <label class="ml-3">{{ $t('name') }}</label>
                                    <input :placeholder="$t('placeholder_name')" class="rounded-pill"/>
                                </sui-form-field>

                                <sui-form-field>
                                    <label class="ml-3">{{ $t('identification') }}</label>
                                    <input :placeholder="$t('placeholder_ID')" class="rounded-pill"/>
                                </sui-form-field>

                                <sui-form-field>
                                    <label class="ml-3">{{ $t('address') }}</label>
                                    <input :placeholder="$t('placeholder_address')" class="rounded-pill"/>
                                </sui-form-field>

                                <sui-form-field>
                                    <label class="ml-3">{{ $t('phone') }}</label>
                                    <input :placeholder="$t('placeholder_phone')" class="rounded-pill"/>
                                </sui-form-field>

                                <sui-form-field>
                                    <label class="ml-3">{{ $t('email') }}</label>
                                    <input :placeholder="$t('placeholder_email')" class="rounded-pill"/>
                                </sui-form-field>
                                
                                <sui-button type="submit">Submit</sui-button>
                            </sui-form>
                        </sui-grid-column>
                        <sui-grid-column>    
                            <!--<sui-card-header class="">
                                <h2 is="sui-header" icon text-align="center">
                                    <sui-label class="massive circular main-red ">
                                        2
                                    </sui-label>
                                </h2>
                                <sui-header-content  class="text-center">{{ $t('service_data') }} </sui-header-content>
                            </sui-card-header>!-->

                            <div class="ui form">
                                    <div class="field">
                                        <label class="ml-3">{{ $t('requested_service') }}</label>
                                        <select class="ui dropdown rounded-pill" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                            <option value="">{{ $t('placeholder_req_serv') }}</option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                        <has-error :form="form" field="type" />
                                    </div>
                                    <div class="field">
                                        <label class="ml-3">{{ $t('property_location') }}</label>
                                        <select class="ui dropdown rounded-pill" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                            <option value="">{{ $t('placeholder_prop_loc') }}</option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                        <has-error :form="form" field="type" />
                                    </div>

                                    <div class="field">
                                        <label class="ml-3">{{ $t('how_receive_proposal') }}</label>
                                        <select class="ui dropdown rounded-pill" v-model="form.type" :class="{ 'is-invalid': form.errors.has('type') }">
                                            <option value="">{{ $t('placeholder_receiv_prop') }}</option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                        <has-error :form="form" field="type" />
                                    </div>

                                <div class="field">
                                    <label class="ml-3">{{ $t('property_archives') }}</label>
                                    <div class="ui action input">
                                        <input type="text" id="_attachmentName" class="rounded-pill" :placeholder="$t('placeholder_prop_arch')">
                                        <label for="attachmentName" class="ui icon button btn-file">
                                            <sui-icon name="spinner" loading />
                                            <input type="file" id="attachmentName" name="attachmentName" style="display: none">
                                        </label>
                                    </div>
                                </div>  
                                
                                <div class="field">
                                    <!--<label class="">{{ $t('uploaded_archives') }}</label>!-->
                                    <sui-image-group size="tiny">
                                        <sui-image :src="src" class="rounded"/>
                                        <sui-image :src="src" class="rounded"/>
                                        <sui-image :src="src" class="rounded"/>
                                    </sui-image-group>
                                </div>
                                
                                <sui-button type="submit">Submit</sui-button>
                            </div>
                        </sui-grid-column>
                        </sui-grid-row>
                    </sui-grid>
                    
                </div>
            </div>
        </div>

        <card :title="$t('services')">
            {{ $t('you_are_logged_in') }}
        </card>
        
    </div>
</template>

<script>
 
import Navout from '~/components/Navout'
import Footer from '~/components/Footer'
import Form from 'vform'
export default {
  /* middleware: 'auth', */
    name: 'services',
    components:{
        Navout,
        Footer
    },
    layout: "basic",
    middleware: "guest",

    data: () => ({
        form: new Form({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            phone: ''
        }),
        src: 'images/services/1.jpg'
    }),    
    /* computed: mapGetters({
        authenticated: 'auth/check'
    }), */
    metaInfo () {
        return { 
                title: this.$t('services')
            }
    }
}
</script>


<style lang="scss">
   .main-red{
      background-color:#FF3D47!important;
   }   
   .alignCenter{
      align-content: center!important;
      justify-content: center!important;
   }
   .rounded-radius{
   border-radius: 2em!important;
   }
</style>