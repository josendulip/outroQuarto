<template>
  <div class="row justify-content-center">
    <div class="col-md-8 invoice-data">
      <div class="card">
        <div class="card-header bg-main text-white d-flex justify-content-between  align-items-center">
          <div class="text-muted">
            <img src="/images/logo/200x48W.png" alt="OutroQuarto" width="180">
          </div>
          <div class="d-flex align-items-center">
            <sui-icon name="file alternate" size="big" />
            <div class="pay">
              {{ $t('mypanel_vefy__table_invoice') }} N.º{{ $route.params.id_trans }} <br>
              {{ $t('mypanel_payment_date') }} {{ form.created_at | ExtensoFormato }}
            </div>
          </div>
        </div>
        <div class="card-body background-body-card ">
          <div class="row data">
            <div class="col-md-7 from d-flex justify-content-start align-items-baseline">
              <div class="mx-2">
                {{ $t('mypanel_payment_from') }}:
              </div>
              <div class="mt-3">
                <sui-list>
                  <sui-list-item> <strong>OutroQuarto</strong></sui-list-item>
                  <sui-list-item>{{ $t('address_footer') }}: sequele, Luanda</sui-list-item>
                  <sui-list-item>{{ $t('email') }}: account@outroquarto.com</sui-list-item>
                  <sui-list-item>{{ $t('phone_footer') }}: +244 928 32-25-36</sui-list-item>
                  <sui-list-item>{{ $t('manager') }}: Anton Lima/ID: 45</sui-list-item>
                </sui-list>
              </div>
            </div>
            <div class="col-md-5 to d-flex justify-content-start align-items-baseline">
              <div class="mx-2">
                {{ $t('mypanel_payment_to') }}:
              </div>
              <div class="mt-3">
                <sui-list>
                  <sui-list-item> <strong>{{ form.username }}</strong></sui-list-item>
                  <sui-list-item>{{ $t('address_footer') }}: {{ form.user_address }}, {{ form.user_city }}</sui-list-item>
                  <sui-list-item>{{ $t('email') }}: {{ form.email }}</sui-list-item>
                  <sui-list-item>{{ $t('phone_footer') }}: {{ form.phone }}</sui-list-item>
                  <sui-list-item :title="$t('b_i_n')">
                    B.I N.º: {{ form.identity }}
                  </sui-list-item>
                </sui-list>
              </div>
            </div>
          </div>
          <hr>
          <h5 class="card-title text-center">
            {{ $t('schedule_service') }}
          </h5>
          <sui-table basic="very">
            <sui-table-header>
              <sui-table-row>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('view_house_details_desc2') }}
                  </sui-button>
                </sui-table-header-cell>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('property_table_heard_Type') }}
                  </sui-button>
                </sui-table-header-cell>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('mypanel_duration') }}
                  </sui-button>
                </sui-table-header-cell>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('mypanel_quantity') }}
                  </sui-button>
                </sui-table-header-cell>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('announce_form_price') }}
                  </sui-button>
                </sui-table-header-cell>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('announce_form_Fee') }}
                  </sui-button>
                </sui-table-header-cell>
                <sui-table-header-cell :width="5" class="px-1">
                  <sui-button size="mini" fluid>
                    {{ $t('mypanel_status') }}
                  </sui-button>
                </sui-table-header-cell>
              </sui-table-row>
            </sui-table-header>
            <sui-table-body>
              <sui-table-row class="text-center">
                <sui-table-cell>{{ $t('schedule_service') }}</sui-table-cell>
                <sui-table-cell>{{ $t('schedule_standart') }}</sui-table-cell>
                <sui-table-cell>{{ $t('schedule_idenfined') }}</sui-table-cell>
                <sui-table-cell>1</sui-table-cell>
                <sui-table-cell>{{ form.paid_amount }}.00</sui-table-cell>
                <sui-table-cell>{{ form.percentage }}%</sui-table-cell>
                <sui-table-cell v-if="form.status === 'resolved'">
                  {{ $t('schedulStatus_confirm') }}
                </sui-table-cell>
              </sui-table-row>
            </sui-table-body>
          </sui-table>
          <hr>
          <div class="d-flex justify-content-end my-5">
            <div class="px-3">
              <sui-list class="font-weight-bolder">
                <sui-list-item>{{ $t('mypanel_subtotal') }}: {{ form.paid_amount | currency("KZ", 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}</sui-list-item>
                <sui-list-item>{{ $t('mypanel_staxa') }}: {{ form.percentage }}</sui-list-item>
                <sui-list-item>{{ $t('mypanel_total') }}: {{ form.paid_amount - form.outroQuarto_amount | currency("KZ", 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}</sui-list-item>
              </sui-list>
            </div>
          </div>
          <div class="text-center">
            <div is="sui-button-group" size="mini">
              <sui-button color="red">
                {{ $t('mypanel_downl_pdf') }}
              </sui-button>
              <sui-button-or :text="$t('welcome_or')" />
              <sui-button size="mini" color="red" @click="printInvoice">
                {{ $t('mypanel_downl_print') }}
              </sui-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import printJS from 'print-js'
export default {
  components: { printJS },
  data: () => ({
    form: new Form({
      user_id: '',
      property_id: '',
      id_transation: '',
      username: '',
      identity: '',
      phone: '',
      email: '',
      user_address: '',
      user_city: '',
      user_country: '',
      user_photo: '',
      iban: '',
      slug: '',
      house_code: '',
      house_city: '',
      house_county: '',
      house_district: '',
      house_street: '',
      paid_user_id: '',
      paid_user_name: '',
      paid_user_email: '',
      paid_user_phone: '',
      paid_user_address: '',
      paid_amount: '',
      paid_receipt: '',
      paid_date: '',
      percentage: '',
      outroQuarto_amount: '',
      trans_method: '',
      receipt: '',
      service: '',
      description: '',
      status: '',
      created_at: ''
    }),
    invoice: {}
  }),
  mounted () {
    this.getInvoice()
  },
  methods: {
    getInvoice () {
      axios
        /*
        .get(`/api/get-invoice/${this.$route.params.id_trans}`)
        .then((data) => { this.form.fill(data); this.invoice = data }) */
        .get('/api/get-invoice/' + this.$route.params.id_trans).then(({ data }) => { this.form.fill(data); this.invoice = data })
    },
    printInvoice () {
      printJS({
        printable: 'printJS-form',
        type: 'html',
        // Inherit all the original styles
        targetStyles: ['*']
      })
    }
  }
}
</script>
<style lang="scss">
.background-body-card {
  background: #f8f9fa;
}
.background-button {
  background: #ddd7d7;
  color:black
}
@media print {
  .not-print {
    display: none;
  }
  .background-body-card {
    background: #f8f9fa;
  }
  .card-header{
    background-color: #FF5859!important;
  }
  .printThis{
    width: 100%;
    text-align: center;
    background: #f8f9fa;
  }
}
</style>
