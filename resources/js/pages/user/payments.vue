<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">
        {{ $t("schedulVisits") }}
      </h3>
      <sui-menu compact>
        <router-link is="sui-menu-item" :to="{ name: 'user.welcome' }" size="tiny">
          {{ $t('mypanel_back') }}
        </router-link>
      </sui-menu>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-10">
        <div v-if="payments.length == ''">
          <transition name="fade">
            <sui-message v-if="visible" header="Welcome back!" content="This is a special notification which you can dismiss." dismissable @dismiss="handleDismiss">Infelizmente</sui-message>
          </transition>
          <p v-if="!visible">
            Message will come back in 2s
          </p>
        </div>
        <sui-table v-else basic="very">
          <sui-table-header>
            <sui-table-row>
              <sui-table-header-cell>{{ $t('schedulLinked') }}</sui-table-header-cell>
              <sui-table-header-cell>{{ $t('schedule_form_address') }}</sui-table-header-cell>
              <sui-table-header-cell>{{ $t('schedulpayment') }}</sui-table-header-cell>
              <sui-table-header-cell>{{ $t('userpanel_receipt') }} </sui-table-header-cell>
              <sui-table-header-cell>{{ $t('mypanel_action') }}</sui-table-header-cell>
            </sui-table-row>
          </sui-table-header>
          <sui-table-body>
            <sui-table-row v-for="payment in payments.data" :key="payment.id">
              <sui-table-cell><a href="javascript:void(0)" @click.prevent="viewPayment(payment.id)">{{ payment.house_code }}</a></sui-table-cell>
              <sui-table-cell>{{ payment.house_street }}, {{ payment.house_district }}, {{ payment.house_county }}, {{ payment.house_city }}</sui-table-cell>
              <sui-table-cell>{{ payment.created_at | MultipleLocaleSupport }}</sui-table-cell>
              <sui-table-cell class="text-center">
                <a :href="'/' + payment.receipt" target="_blank">Download <br> <i class="file alternate outline icon" /></a>
              </sui-table-cell>
              <sui-table-cell>
                <a href="javascript:void(0)" color="red" @click.prevent="deletePayment(payment.id)"><i class="window close icon" :title="$t('property_delete')" /></a>
              </sui-table-cell>
            </sui-table-row>
          </sui-table-body>

          <sui-table-footer>
            <sui-table-row>
              <sui-table-header-cell colspan="5">
                <pagination :data="payments" @pagination-change-page="getResults" />
              </sui-table-header-cell>
            </sui-table-row>
          </sui-table-footer>
        </sui-table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Form from "vform";
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'user.payments',
  data () {
    return {
      form: new Form({
        id: '',
        house_code: '',
        house_street: '',
        house_district: '',
        house_county: '',
        house_city: '',
        created_at: '',
        receipt: ''
      }),
      payments: {},
      visible: false
    }
  },
  mounted () {
    this.loadPayments()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadPayments()
    })
  },
  methods: {
    handleDismiss () {
      this.visible = false
      setTimeout(() => {
        this.visible = true
      }, 2000)
    },
    getResults (page = 1) {
      axios.get('/api/my-schedules-user/?page=' + page).then((response) => {
        this.payments = response.data
      })
    },
    viewPayment (schedul) {
      this.$router.push('my-schedule-message/' + schedul)
    },
    async loadPayments () {
      try {
        const response = await fetch('/api/my-schedules-user')
        const result = await response.json()
        this.payments = result
      } catch (error) {
        console.log(error)
      }
    },
    deletePayment (id) {
      // eslint-disable-next-line no-undef
      Swal.fire({
        title: this.$t('question_before_delete'),
        text: this.$t('explantation_before_delete'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('button_delete')
      }).then((result) => {
        if (result.value) { // se o resultado for verdadeiro // mandar o request to server
          this.form.delete('/api/schedule-services/' + id).then(() => {
            // eslint-disable-next-line no-undef
            Swal.fire(
              this.$t('deleted'), this.$t('msg_deleted_success'), 'success'
            )
            // eslint-disable-next-line no-undef
            Fire.$emit('after-created')
          }).catch(() => {
            // eslint-disable-next-line no-undef
            Swal.fire(this.$t('msg_deleted_error'), 'error')
          })
        }
      })
    }
  }
}
</script>
