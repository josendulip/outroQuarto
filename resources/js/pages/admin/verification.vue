<template>
  <div class="row d-flex justify-content-center">
    <!-- WHEN IS RESERVED -->
    <div v-if="form.status == 'reserved'" class="col-md-5">
      <sui-card class="w-100">
        <sui-card-content>
          <sui-card-header>
            {{ $t('mypanel_verification_title') }}
          </sui-card-header>
        </sui-card-content>
        <sui-card-content>
          <sui-header size="tiny" class="text-uppercase text-danger">
            <a is="sui-label" tag> {{ $t('mypanel_vefy_scheduled') }} </a>
          </sui-header>
          <div class="ui small feed">
            <div class="event">
              <div class="content">
                <div class="summary">
                  <a class="text-danger" @click.prevent="viewUser(form.user_slug)">{{ form.username }}</a> {{ $t('mypanel_vefy_add') }} <a class="text-warning" @click.prevent="viewHouse(form.house_code)">{{ form.house_code }}</a> {{ $t('mypanel_vefy_to_vefy') }} {{ form.house_street }}, {{ form.house_district }}, {{ form.house_city }} {{ $t('mypanel_vefy_payment') }} <a class="text-success text-lowercase" target="_blank" :href="'/' + form.receipt">{{ $t('mypanel_Download') }}.</a>
                </div>
              </div>
            </div>
            <div class="event">
              <div class="content">
                <div class="summary text-info">
                  {{ $t('mypanel_vefy_date') }} {{ form.date }} {{ $t('mypanel_verif_at') }} {{ form.time }}.
                </div>
              </div>
            </div>
            <div class="event">
              <div class="content">
                <div class="summary">
                  {{ $t('mypanel_vefy_price') }} : {{ form.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true, thousandsSeparator: '.', decimalSeparator: ',' }) }}
                </div>
              </div>
            </div>
          </div>
          <!-- end of base semantic ui, to be updated in the future with sui-feed -->
        </sui-card-content>
        <sui-card-content extra>
          <router-link :to="{ name: 'admin.verificate'}" class="ui left labeled icon button">
            <i class="left arrow icon" />
            {{ $t('mypanel_vefy_backList') }}
          </router-link>
          <sui-button disabled>
            {{ $t('save') }}
          </sui-button>
        </sui-card-content>
      </sui-card>
    </div>
    <!-- WHEN IS APPROVED -->
    <div v-if="form.status == 'approved'" class="col-md-5">
      <form method="POST" enctype="multipart/form-data" @submit.prevent="update()" @keydown="form.onKeydown($event)">
        <sui-card class="w-100">
          <sui-card-content>
            <sui-card-header>
              {{ $t('mypanel_vefy_approved') }}
            </sui-card-header>
          </sui-card-content>
          <sui-card-content>
            <sui-header size="tiny" class="text-uppercase text-danger">
              <a is="sui-label" tag> {{ $t('mypanel_vefy_scheduled') }} </a>
            </sui-header>
            <div class="ui small feed">
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a class="text-danger" @click.prevent="viewUser(form.user_slug)">{{ form.username }}</a> {{ $t('mypanel_vefy_add') }} <a class="text-warning" @click.prevent="viewHouse(form.house_code)">{{ form.house_code }}</a> {{ $t('mypanel_vefy_to_vefy') }} {{ form.house_street }}, {{ form.house_district }}, {{ form.house_city }}.
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress">{{ $t('home_form_payment') }}</label>
                  <input v-model="form.price" type="text" class="form-control" :placeholder="$t('Type_price')">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">{{ $t('schedule_form_price_reflection') }}</label>
                  <input :value="form.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true, thousandsSeparator: '.', decimalSeparator: ',' })" type="text" class="form-control" :placeholder="$t('schedule_form_price_reflection')" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">{{ $t('schedule_form_dateOfEntry') }}</label>
                  <!-- <datepicker id="event_date" v-model="form.date" :language="'pt-br'" :placeholder="$t('schedule_form_date')" :min="'2020-01-01'" :max="'2030-12-31'" :data-vv-as="'Please enter your visit date'" name="event_date" class="" /> -->
                  <PickDate v-model="form.date" />
                </div>
                <div class="form-group col-md-6">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">{{ $t('schedule_form_time_h') }}</label>
                      <input v-model="form.hour" type="number" min="1" class="form-control" :placeholder="$t('schedule_form_time_h')">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">{{ $t('schedule_form_time_m') }}</label>
                      <input v-model="form.minute" type="number" min="1" class="form-control" :placeholder="$t('schedule_form_time_m')">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of base semantic ui, to be updated in the future with sui-feed -->
          </sui-card-content>
          <sui-card-content extra>
            <router-link :to="{ name: 'admin.verificate'}" class="ui left labeled icon button">
              <i class="left arrow icon" />
              {{ $t('mypanel_vefy_backList') }}
            </router-link>
            <sui-button :loading="form.busy" :disabled="form.busy">
              {{ $t('save') }}
            </sui-button>
          </sui-card-content>
        </sui-card>
      </form>
    </div>
    <!-- WHEN IS PENDING -->
    <div v-if="form.status == 'pending'" class="col-md-5">
      <form method="POST" enctype="multipart/form-data" @submit.prevent="update()" @keydown="form.onKeydown($event)">
        <sui-card class="w-100">
          <sui-card-content>
            <sui-card-header>
              {{ $t('mypanel_vefy_approved') }}
            </sui-card-header>
          </sui-card-content>
          <sui-card-content>
            <sui-header size="tiny" class="text-uppercase text-danger">
              <a is="sui-label" tag> {{ $t('mypanel_vefy_scheduled') }} </a>
            </sui-header>
            <div class="ui small feed">
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a class="text-danger" @click.prevent="viewUser(form.user_slug)">{{ form.username }}</a> {{ $t('mypanel_vefy_add') }} <a class="text-warning" @click.prevent="viewHouse(form.house_code)">{{ form.house_code }}</a> {{ $t('mypanel_vefy_to_vefy') }} {{ form.house_street }}, {{ form.district }}, {{ form.house_city }}.
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputAddress">{{ $t('home_form_payment') }}</label>
                  <input v-model="form.price" type="number" class="form-control" min="1" :placeholder="$t('Type_price')">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputAddress">{{ $t('schedule_form_price_reflection') }}</label>
                  <input :value="form.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true, thousandsSeparator: '.', decimalSeparator: ',' }) " type="text" class="form-control" :placeholder="$t('schedule_form_price_reflection')" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">{{ $t('schedule_form_dateOfEntry') }}</label>
                  <!-- <datepicker id="event_date" v-model="form.date" :language="'pt-br'" :placeholder="$t('schedule_form_date')" :min="'2020-01-01'" :max="'2030-12-31'" :data-vv-as="'Please enter your visit date'" name="event_date" class="" /> -->
                  <PickDate v-model="form.date" />
                </div>
                <div class="form-group col-md-6">
                  <!-- <TimePicker v-model="form.time" :class="{ 'is-invalid': form.errors.has('time') }" :required="true" :disabled="false" :placeholder="$t('schedule_form_time')" /> -->
                  <!-- <vue-timepicker v-model="form.time" format="H:mm" input-width="100%" input-class="py-2" :placeholder="$t('schedule_form_time')" drop-direction="down" :minute-interval="10" :second-interval="10" close-on-complete /> -->
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">{{ $t('schedule_form_time_h') }}</label>
                      <input v-model="form.hour" type="number" min="1" class="form-control" :placeholder="$t('schedule_form_time_h')">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4">{{ $t('schedule_form_time_m') }}</label>
                      <input v-model="form.minute" type="number" min="1" class="form-control" :placeholder="$t('schedule_form_time_m')">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of base semantic ui, to be updated in the future with sui-feed -->
          </sui-card-content>
          <sui-card-content extra>
            <router-link :to="{ name: 'admin.verificate'}" class="ui left labeled icon button">
              <i class="left arrow icon" />
              {{ $t('mypanel_vefy_backList') }}
            </router-link>
            <sui-button :loading="form.busy" :disabled="form.busy">
              {{ $t('save') }}
            </sui-button>
          </sui-card-content>
        </sui-card>
      </form>
    </div>
  </div>
</template>
<script>
// eslint-disable-next-line no-unused-vars
import axios from 'axios'
import Form from 'vform'
import Datepicker from '~/components/TouchDatePicker.vue'
import TimePicker from '~/components/TimePicker.vue'
import PickDate from '../../components/PickDate.vue'
import VueTimepicker from 'vue2-timepicker/src'
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'admin.verification',
  // eslint-disable-next-line vue/no-unused-components
  components: { 'toggle-button': TimePicker, PickDate, Datepicker, VueTimepicker },
  data: () => ({
    form: new Form({
      date: '',
      description: null,
      email: '',
      house_city: '',
      house_code: '',
      house_county: '',
      house_district: '',
      house_street: '',
      id: '',
      phone: '',
      price: '',
      receipt: '',
      request_type: '',
      status: 'approved',
      time: '',
      hour: '',
      minute: '',
      user_id: '',
      username: '',
      user_slug: ''
    })
  }),
  mounted () {
    this.getVefy()
  },
  methods: {
    viewUser (slug) {
      this.$router.push('/admin/view/user/' + slug)
    },
    viewHouse (houseCode) {
      this.$router.push('/view/' + houseCode)
    },
    getVefy () {
      this.form.get('/api/all-request-verification/' + this.$route.params.id).then(({ data }) => { this.form.fill(data) })
    },
    update () {
      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else if (this.form.phone === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_phone'))
      } else if (this.form.house_street === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_address'))
      } else if (this.form.price === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_price'))
      } else if (this.form.date === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_date'))
      } else if (this.form.hour === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_time'))
      } else {
        this.form.busy = true
        this.form
          .put('/api/all-request-verification/' + this.form.id)
          .then(() => {
            this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
            this.$toastr.s(this.$t('mypanel_vefy_mgs_toast'))
            this.form.reset()
            this.form.clear()
            // eslint-disable-next-line no-undef
            Fire.$emit('after-created')
            this.form.busy = false
            this.$router.push({ name: 'admin.verificate' })
          })
          .catch(() => {
            this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
            this.$toastr.s(this.$t('mypanel_vefy_mgs_toas_error'))
          })
      }
    }
  }
}
</script>
