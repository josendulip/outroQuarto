<template>
    <div class="container">
        <div class="row justify-content-center my-5">
            <sui-card class=""  style="width: 50rem;">
                <sui-card-content>
                    <div class="d-flex justify-content-between">
                        <p class="small text-uppercase p-3">{{$t('your_password')}}</p>
                        
                        <router-link  :to="{ name: 'my-panel.profile' }">
                                        
                        <sui-button class="mb-2"
                        circular
                        icon="arrow left"
                        ></sui-button> 
                        </router-link>
                    </div>
                    <sui-container text-align="justified" class="py-4">
                        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                            <alert-success :form="form" :message="$t('password_updated')" />

                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ $t('new_password') }}</label>
                                <div class="col-md-7">
                                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                                <has-error :form="form" field="password" />
                                </div>
                            </div>

                            <!-- Password Confirmation -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
                                <div class="col-md-7">
                                <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
                                <has-error :form="form" field="password_confirmation" />
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row">
                                <div class="col-md-9 ml-md-auto">
                                <v-button :loading="form.busy" type="danger">
                                    {{ $t('update') }}
                                </v-button>
                                </div>
                            </div>
                        </form>   
                    </sui-container>           
                </sui-card-content>
            </sui-card>
        </div>
    </div>
</template>

<script>
import Form from 'vform'

export default {
  scrollToTop: false,
    name: "my-panel.password",
  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async update () {
      await this.form.patch('/api/settings/password')

      this.form.reset()
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