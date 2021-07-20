<template>
  <div class="container">
    <sui-table celled>
      <sui-table-header>
        <sui-table-row>
          <sui-table-header-cell>Trans. ID </sui-table-header-cell>
          <sui-table-header-cell>{{ $t('mypanel_payment_Method') }}</sui-table-header-cell>
          <sui-table-header-cell :title="$t('mypanel_payment_orgAmounts')">
            {{ $t('mypanel_payment_orgAmount') }}
          </sui-table-header-cell>
          <sui-table-header-cell title="OutroQuarto Service Fee">
            {{ $t('mypanel_payment_fee') }}
          </sui-table-header-cell>
          <sui-table-header-cell :title="$t('mypanel_payment_fees')">
            {{ $t('mypanel_payment_fact') }}
          </sui-table-header-cell>
          <sui-table-header-cell :title="$t('mypanel_payment_origInvoices')">
            {{ $t('mypanel_payment_origInvoice') }}
          </sui-table-header-cell>
          <sui-table-header-cell :title="$t('mypanel_payment_transfs')">
            {{ $t('mypanel_payment_transf') }}
          </sui-table-header-cell>
          <sui-table-header-cell :title="$t('mypanel_payment_status')">
            Status
          </sui-table-header-cell>
          <sui-table-header-cell> {{ $t('mypanel_action') }}</sui-table-header-cell>
        </sui-table-row>
      </sui-table-header>
      <sui-table-body>
        <sui-table-row v-for="mypayment in mypayments.data" :key="mypayment.id">
          <sui-table-cell :title="$t('mypanel_payment_id_trans')">
            <a href="javascript:void(0)" @click="checkInvoice(mypayment.id_transation)">{{ mypayment.id_transation }}</a>
          </sui-table-cell>
          <sui-table-cell>
            <span v-if="mypayment.trans_method === 'By Bank transfer'">{{ $t('myadmin_schedul_view_item18') }}</span>
            <span v-else-if="mypayment.trans_method === 'By bank reference'">{{ $t('myadmin_schedul_view_item19') }}</span>
            <span v-else-if="mypayment.trans_method === 'By deposit to order'">{{ $t('myadmin_schedul_view_item20') }}</span>
            <span v-else-if="mypayment.trans_method === 'Transfer by IBAN'">{{ $t('myadmin_schedul_view_item21') }}</span>
            <span v-else :title="mypayment.description">
              <span slot="trigger">{{ $t('myadmin_schedul_view_item22') }}</span>
            </span>
          </sui-table-cell>
          <sui-table-cell>{{ mypayment.paid_amount | currency("KZ", 2, { spaceBetweenAmountAndSymbol: true, symbolOnLeft: false }) }}</sui-table-cell>
          <sui-table-cell>{{ mypayment.percentage }}%</sui-table-cell>
          <sui-table-cell>{{ mypayment.paid_amount - mypayment.outroQuarto_amount | currency("KZ", 2, { spaceBetweenAmountAndSymbol: true, symbolOnLeft: false }) }}</sui-table-cell>
          <sui-table-cell><a :href="'/' + mypayment.paid_receipt" target="_blank" rel="noopener noreferrer" :title="$t('mypanel_payment_origInvoices')">Invoice</a></sui-table-cell>
          <sui-table-cell><a :href="'/' + mypayment.receipt" target="_blank" rel="noopener noreferrer" :title="$t('mypanel_payment_transfs')">Borderô</a></sui-table-cell>
          <sui-table-cell v-if="mypayment.status === 'Not approved'" state="error">
            <sui-icon name="attention" />
            {{ mypayment.status }}
          </sui-table-cell>
          <sui-table-cell v-if="mypayment.status === 'resolved'" positive>
            <sui-icon name="check" />
            {{ mypayment.status }}
          </sui-table-cell>
          <sui-table-cell v-if="mypayment.status === 'pending'" warning>
            <sui-icon name="hourglass half" />
            {{ mypayment.status }}
          </sui-table-cell>
          <sui-table-cell><i class="clipboard list icon" /> {{ $t('mypanel_Download') }}</sui-table-cell>
        </sui-table-row>
      </sui-table-body>
      <sui-table-footer>
        <sui-table-row>
          <sui-table-header-cell colspan="9">
            <pagination :data="mypayments" @pagination-change-page="getResults" />
          </sui-table-header-cell>
        </sui-table-row>
      </sui-table-footer>
    </sui-table>
  </div>
</template>
<script>
import axios from 'axios'
import Form from 'vform'
export default {
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
      status: ''
    }),
    mypayments: {}
  }),
  mounted () {
    this.loadPayments()
  },
  methods: {
    getResults (page = 1) {
      axios.get('api/get-my-payments/?page=' + page).then((response) => {
        this.mypayments = response.data
      })
    },
    checkInvoice (idTransation) {
      this.$router.push('payment/elect_invoice/' + idTransation)
    },
    async loadPayments () {
      try {
        const response = await fetch('api/get-my-payments')
        const result = await response.json()
        this.mypayments = result
        // console.log(this.myHouses);
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
