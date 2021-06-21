<template>
    <sui-card class=" rounded-radius w-100">
        <sui-card-content class="" :title="$t('additional')">
            <p class="small text-uppercase p-3">{{$t('additional')}}</p>
            <sui-container text-align="justified" class="py-4">
                <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                    <alert-success :form="form" :message="$t('info_updated')" />

                    <sui-grid divided="vertically">
                        <sui-grid-row :columns="2">
                        <sui-grid-column>
                            <sui-form>

                                <sui-form-field :class="{ 'error': form.errors.has('identity') }">
                                    <input type="text" name="identity" v-model="form.identity" :class="{ 'is-invalid': form.errors.has('identity') }" :placeholder="$t('identity_additional')" class="rounded-pill form-control" >
                                    <has-error :form="form" field="identity" />
                                </sui-form-field>
                                <sui-form-field :class="{ 'error': form.errors.has('birth') }">
                                    
                                    <input type="text" name="birth" v-model="form.birth" :class="{ 'is-invalid': form.errors.has('birth') }"  :placeholder="$t('birth_additional')" class="rounded-pill"/>
                                    <has-error :form="form" field="birth" />
                                </sui-form-field>
                            
                                <sui-form-field :class="{ 'error': form.errors.has('phone') }">
                                    
                                    <input type="text" name="phone" v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" :placeholder="$t('phone_additional')" class="rounded-pill form-control"/>
                                    <has-error :form="form" field="phone" />
                                </sui-form-field>

                            </sui-form>
                        </sui-grid-column>
                        <sui-grid-column> 
                            <sui-form>   
                                <sui-form-field  :class="{ 'error': form.errors.has('address') }">
                                    
                                    <input type="text" name="address" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" :placeholder="$t('address_additional')" class="rounded-pill  form-control"/>
                                    <has-error :form="form" field="address" />
                                </sui-form-field>
                                <sui-form-field :class="{ 'error': form.errors.has('city') }">
                                    
                                    <input type="text" name="city" v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" :placeholder="$t('city_additional')" class="rounded-pill  form-control"/>
                                    <has-error :form="form" field="city" />
                                </sui-form-field>

                                <sui-form-field>                                    
                                    <input type="text" name="country" v-model="form.country" :class="{ 'is-invalid': form.errors.has('country') }" :placeholder="$t('country_additional')" class="rounded-pill  form-control"/>
                                    <has-error :form="form" field="country" />
                                </sui-form-field>
                            </sui-form>
                        </sui-grid-column>
                        </sui-grid-row>
                    </sui-grid>

                    <!-- Submit Button -->
                    <div class="form-group row">
                        <div class="">
                        <v-button :loading="form.busy" type="danger"  class="rounded-pill">
                            {{ $t('update') }}
                        </v-button>
                        </div>
                    </div>
                </form> 
            </sui-container>           
        </sui-card-content>
    </sui-card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',
  scrollToTop: false,

    metaInfo () {
        return { title: this.$t('settings') }
    },

    data: () => ({
        form: new Form({
            identity:'',
            birth:'',
            phone:'',
            address:'',
            city:'',
            country:'',
        })
    }),

    computed: mapGetters({
        user: 'auth/user'
    }),

    created () {
            // Fill the form with user data.
            this.form.keys().forEach(key => {
            this.form[key] = this.user[key]
        })
    },

    methods: {
        async update () {
        const { data } = await this.form.patch('/api/settings/additional')

        this.$store.dispatch('auth/updateUser', { user: data })
        }
    }
}
</script>

<style lang="scss">
    .main-red{
        background-color:#FF3D47!important;
    } 

    .rounded-radius{
        border-radius: 2em!important;
    }    
</style>