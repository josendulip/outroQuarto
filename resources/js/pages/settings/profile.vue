<template>
    <sui-card class=" rounded-radius w-100">
        <sui-card-content class="" :title="$t('your_info')">
            <p class="small text-uppercase p-3">{{$t('your_info')}}</p>
            <sui-container text-align="justified" class="py-4">
                <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                    <alert-success :form="form" :message="$t('info_updated')" />

                    <!-- Name -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
                        <div class="col-md-7">
                        <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                        <has-error :form="form" field="name" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
                        <div class="col-md-7">
                        <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                        <has-error :form="form" field="email" />
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
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: ''
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
      const { data } = await this.form.patch('/api/settings/profile')

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