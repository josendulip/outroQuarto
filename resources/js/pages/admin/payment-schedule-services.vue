<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">
        {{ $t("schedulVisits") }}
      </h3>
      {{ $route.params.id }}
      <sui-menu compact>
        <router-link is="sui-menu-item" :to="{ name: 'my-panel.scheduling' }" size="tiny">
          <sui-icon name="bell outline" /> {{ $t('scheduled') }}
          <sui-label color="red" floating>
            {{ countTheSchedules }}
          </sui-label>
        </router-link>
      </sui-menu>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-8">
        <sui-segment piled>
          <sui-segment inverted circular style="width:132px; height:132px;">
            <sui-header inverted class="text-capitalize">
              {{ mySchedule.status }}
              <sui-header sub>
                {{ mySchedule.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}
              </sui-header>
            </sui-header>
          </sui-segment>
          <div class="text-center">
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item1') }}</strong> <br><a href="">{{ mySchedule.username }}</a>
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item2') }}</strong> <br> {{ mySchedule.address }}
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item3') }}</strong> <br>{{ mySchedule.phone }} / <a href="">{{ mySchedule.email }}</a>
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item4') }}</strong> <br>{{ mySchedule.date }} - {{ mySchedule.time }}
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item5') }}</strong> <br><a :href="'/' + mySchedule.receipt" target="_blank">{{ mySchedule.receipt }}</a>
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item6') }}</strong> <br>{{ mySchedule.house_county }} - {{ mySchedule.house_city }}
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item7') }}</strong> <br><a href="javascript:void(0)" @click="viewHouse(mySchedule.house_code)">{{ mySchedule.house_code }}</a>
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item8') }} {{ mySchedule.owner }}</strong> <br>
              <sui-button :content="$t('myadmin_schedul_view_item12')" size="tiny" basic @click="sendMoney(mySchedule.owner)" />
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item9') }}</strong> <br>{{ mySchedule.created_at | MultipleLocaleSupport }}
            </p>
            <sui-button v-if="mySchedule.status == 'Not approved'" :content="$t('myadmin_schedul_view_item10')" basic @click="approveSchedule(mySchedule.id)" />
            <sui-button v-else :content="$t('myadmin_schedul_view_item11')" color="green" basic @click="desapproveSchedule(mySchedule.id)" />
          </div>
        </sui-segment>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import Form from 'vform'
// Manually point to the `/src` folder
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'my-panel.scheduling',
  components: { },
  data () {
    return {
      form: new Form({
        date: '',
        time: '',
        status: 'pending'
      }),
      mySchedule: {},
      countTheSchedules: 0,
      scheduling: false,
      status: '',
      rescheduleShow: -1
    }
  },
  mounted () {
    this.loadSchedule()
    this.countSchedules()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      // this.loadschedules()
      this.loadSchedule()
    })
  },
  methods: {
    sendMoney (owner) {
      axios.post('api/my-schedules/?page=' + owner).then((response) => {
        this.mySchedules = response.data
      })
    },
    getResults (page = 1) {
      axios.get('api/my-schedules/?page=' + page).then((response) => {
        this.mySchedules = response.data
      })
    },
    removeComponent () { this.scheduling = false },
    // RESCHEDULED
    async reschedule (id) {
      // reschedule.
      try {
        if (this.form.date === '') {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('schedule_form_mgs_date'))
        } else if (this.form.time === '') {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('schedule_form_mgs_time'))
        } else {
          const { data } = await this.form.post('/api/reschedule/' + id)
          // eslint-disable-next-line no-undef
          Fire.$emit('after-created')
          this.rescheduleShow = -1
          this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
          this.$toastr.s(this.$t('schedule_msg_reschedul_success'))
          this.status = data.status
        }
      } catch (error) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_msg_reschedul_error'))
        console.log(error)
      }
    },
    viewHouse (houseCode) {
      this.$router.push('/view/' + houseCode)
    },
    async approveSchedule (id) {
      try {
        const { data } = await this.form.post('/api/approve-schedule/' + id)
        // eslint-disable-next-line no-undef
        Fire.$emit('after-created')
        this.status = data.status
        this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
        this.$toastr.s(this.$t('schedule_message_suscceful'))
      } catch (error) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_message_error'))
        console.log(error)
      }
    },
    async desapproveSchedule (id) {
      try {
        const { data } = await this.form.post('/api/desapprove-schedule/' + id)
        // eslint-disable-next-line no-undef
        Fire.$emit('after-created')
        this.status = data.status
        this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
        this.$toastr.s(this.$t('schedule_message_suscceful'))
      } catch (error) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_message_error'))
        console.log(error)
      }
    },
    // COM PAGINATE NAO ESTA A FUNCIONAR
    async loadSchedule () {
      try {
        const response = await fetch('/api/view-schedule-payment/' + this.$route.params.id)
        const result = await response.json()
        this.mySchedule = result
        // console.log(this.myHouses);
      } catch (error) {
        console.log(error)
      }
    },
    async countSchedules () {
      try {
        const response = await fetch('/api/count-schedules')
        const result = await response.json()
        this.countTheSchedules = result
        // console.log(this.myHouses);
      } catch (error) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('view_rating_message_error_toastr'))
        console.log(error)
      }
    }
  }
}
</script>
<style lang="scss">
  .rounded-radius-without {
    border-radius: 0em !important;
  }
  .pading{
    padding: .67857143em 1em!important;
    line-height: 1.21428571em!important;
    padding: .67857143em 1em!important;
  }
</style>
