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
      <div class="col-md-8">
        <sui-segment piled class="w-100">
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
            <p class="text-wrap">
              <strong>{{ $t('myadmin_schedul_view_item5') }}</strong> <br><a :href="'/' + mySchedule.receipt" target="_blank">{{ mySchedule.receipt }}</a>
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item6') }}</strong> <br>{{ mySchedule.house_county }} - {{ mySchedule.house_city }}
            </p>
            <p class="text-wrap">
              <strong>{{ $t('myadmin_schedul_view_item7') }}</strong> <br><a href="javascript:void(0)" class="text-wrap" @click="viewHouse(mySchedule.house_code)">{{ mySchedule.house_code }}</a>
            </p>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item8') }} {{ mySchedule.owner }}</strong> <br>
              <sui-button :content="$t('myadmin_schedul_view_item12')" size="tiny" basic @click.prevent="findUser(mySchedule.owner)" />
            </p>
            <sui-dimmer v-if="!mySchedule.username" active inverted>
              <sui-loader content="Loading..." />
            </sui-dimmer>
            <div v-if="owner.name" class="d-flex justify-content-center">
              <form method="POST" enctype="multipart/form-data" @submit.prevent="sendMoney()" @keydown="form.onKeydown($event)">
                <sui-card>
                  <sui-card-content>
                    <sui-card-header @click.prevent="viewUser(owner.slug)">
                      <a is="sui-list-item" @click.prevent="viewUser(owner.slug)"><sui-image avatar :src="owner.photo" /></a> <br>
                      {{ owner.name }}
                    </sui-card-header>
                    <sui-card-meta>{{ owner.role }}</sui-card-meta>
                    <sui-card-description>
                      <sui-list>
                        <sui-list-item>
                          <sui-list-header>{{ owner.phone }}</sui-list-header>
                          {{ $t('myadmin_schedul_view_item13') }}
                        </sui-list-item>
                        <sui-list-item>
                          <sui-list-header>{{ owner.email }}</sui-list-header>
                          {{ $t('myadmin_schedul_view_item16') }}
                        </sui-list-item>
                        <sui-list-item>
                          <sui-list-header>{{ owner.iban }}</sui-list-header>
                          {{ $t('myadmin_schedul_view_item14') }}
                        </sui-list-item>
                        <sui-list-item>
                          <sui-list-header>{{ owner.city }}</sui-list-header>
                          {{ $t('myadmin_schedul_view_item15') }}
                        </sui-list-item>
                        <sui-list-item>
                          <!-- Transferencia Bancaria-->
                          <sui-form-field :class="{'error': form.errors.has('myadmin_schedul_view_item17') }">
                            <sui-dropdown v-model="trans_method" :options="trans_methods" :placeholder="$t('myadmin_schedul_view_item25')" selection class="w-100" />
                          </sui-form-field>
                        </sui-list-item>
                        <sui-list-item v-if="trans_method">
                          <span v-if="fileName.split('.')[1] === 'pdf'">
                            {{ fileName }}
                          </span>
                          <span v-if="filepreview">
                            <sui-image v-show="filepreview" :src="filepreview" class="img-thumbnail" fluid style="width:262px height:262px; object-fit:cover" />
                          </span>
                          <div class="input-group">
                            <div class="custom-file">
                              <input id="outroquarto_receipt" type="file" class="custom-file-input" aria-describedby="outroquarto_receipt" @change="fileSelVefy">
                              <label class="custom-file-label" for="outroquarto_receipt">{{ $t('mypanel_verif_upload_file') }}</label>
                            </div>
                          </div>
                        </sui-list-item>
                        <sui-list-item v-if="trans_method === 'By another'">
                          <div class="">
                            <textarea v-model="description" class="form-control" :class="{'is-invalid' : description.length == ''}" :placeholder="$t('myadmin_schedul_view_item24')" required />
                            <div class="invalid-feedback">
                              {{ $t('myadmin_schedul_view_item23') }}
                            </div>
                          </div>
                        </sui-list-item>
                        <sui-list-item>
                          <!-- Percentage-->
                          <sui-form-field :class="{'error': form.errors.has('myadmin_schedul_view_item17') }">
                            <sui-dropdown v-model="percentage" :options="percentages" :placeholder="$t('myadmin_schedul_view_item17')" selection class="w-100" />
                          </sui-form-field>
                          <div class="form-group row mt-3">
                            <div class="col-md-4">
                              {{ form.price }} KZ
                            </div>
                            <div class="col-md-4">
                              {{ form.percentage }} %
                            </div>
                            <div class="col-md-4">
                              {{ (form.percentage/100)*form.price }} KZ
                            </div>
                          </div>
                        </sui-list-item>
                      </sui-list>
                    </sui-card-description>
                  </sui-card-content>
                  <sui-button attached="bottom">
                    <sui-icon name="add" /> {{ $t('myadmin_schedul_view_item12') }}
                  </sui-button>
                </sui-card>
              </form>
              <!-- <sui-list v-if="owner.name" bulleted horizontal class="text-danger text-wrap">
                <a is="sui-list-item" @click.prevent="viewUser(owner.slug)"> <sui-image avatar :src="owner.photo" /></a>
                <a is="sui-list-item" @click.prevent="viewUser(owner.slug)">{{ owner.name }}</a>
                <a is="sui-list-item">{{ owner.phone }}</a>
                <a is="sui-list-item">{{ owner.city }}</a>
                <a is="sui-list-item" v-show="owner.iban">{{ owner.iban }}</a>
                <a is="sui-list-item" v-show="!owner.iban" class="text-muted">No IBAN</a>
                <sui-button is="sui-list-item" basic class="text-success" @click.prevent="sendMoney()">
                  {{ $t('myadmin_schedul_view_item12') }}
                </sui-button>
              </sui-list> -->
            </div>
            <p class="">
              <strong>{{ $t('myadmin_schedul_view_item9') }}</strong> <br>{{ mySchedule.created_at | MultipleLocaleSupport }}
            </p>
            <sui-button v-if="mySchedule.status == 'Not approved'" :content="$t('myadmin_schedul_view_item10')" basic @click="approveSchedule(mySchedule.id)" />
            <sui-button v-else :content="$t('myadmin_schedul_view_item11')" color="green" basic @click="desapproveSchedule(mySchedule.id)" />
          </div>
        </sui-segment>
        <!-- Modal -->
        <!-- <sui-modal v-model="opens">
          <sui-modal-header>{{ owner.id }}</sui-modal-header>
          <sui-modal-content image>
            <sui-image
              wrapped
              size="medium"
              src="static/images/avatar/large/rachel.png"
            />
            <sui-modal-description>
              <sui-header>{{ owner.name }}</sui-header>
              <p>
                We've found the following gravatar image associated with your e-mail
                address.
              </p>
              <p>Is it okay to use this photo?</p>
            </sui-modal-description>
          </sui-modal-content>
          <sui-modal-actions>
            <sui-button positive @click.native="toggle">
              OK
            </sui-button>
          </sui-modal-actions>
        </sui-modal> -->
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
        id: '',
        user_id: '',
        house_code: '',
        username: '',
        phone: '',
        email: '',
        address: '',
        house_city: '',
        house_county: '',
        house_district: '',
        house_street: '',
        price: '',
        percentage: null,
        date: '',
        time: '',
        receipt: '',
        request_type: '',
        description: '',
        status: '',
        owner: '',
        created_at: '',
        updated_at: ''
      }),
      trans_methods: [
        {
          text: this.$t('myadmin_schedul_view_item18'),
          value: 'By Bank transfer'
        },
        {
          text: this.$t('myadmin_schedul_view_item19'),
          value: 'By bank reference'
        },
        {
          text: this.$t('myadmin_schedul_view_item20'),
          value: 'By deposit to order'
        },
        {
          text: this.$t('myadmin_schedul_view_item21'),
          value: 'Transfer by IBAN'
        },
        {
          text: this.$t('myadmin_schedul_view_item22'),
          value: 'By another'
        }
      ],
      percentages: [
        {
          text: '10%',
          value: 10
        },
        {
          text: '15%',
          value: 15
        },
        {
          text: '20%',
          value: 20
        },
        {
          text: '25%',
          value: 25
        }
      ],
      fileName: '',
      photospreview: '',
      filepreview: null,
      percentage: '',
      outroquarto_receipt: '',
      trans_method: '',
      description: '',
      mySchedule: {},
      countTheSchedules: 0,
      scheduling: false,
      status: '',
      rescheduleShow: -1,
      opens: false,
      owner: new Form({
        id: '',
        name: '',
        email: '',
        password: '',
        identity: '',
        birth: '',
        phone: '',
        address: '',
        city: '',
        country: '',
        photo: '',
        role: '',
        iban: '',
        slug: ''
      })
    }
  },
  mounted () {
    this.loadSchedule()
    this.countSchedules()
    this.findUser()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadSchedule()
    })
  },
  methods: {
    viewUser (slug) {
      this.$router.push('/admin/view/user/' + slug)
    },
    findUser (owner) {
      axios.get('/api/find-owner/' + owner).then(({ data }) => {
        this.owner.fill(data)
        this.opens = true
      })
    },
    fileSelVefy (e) {
      this.outroquarto_receipt = e.target.files[0]
      if (this.outroquarto_receipt) {
        if (/\.(jpe?g|png|gif|pdf)$/i.test(this.outroquarto_receipt.name)) {
          if (this.outroquarto_receipt.size > 4096 * 4096) {
            e.preventDefault()
            alert('File too big (> 16MB)')
            // eslint-disable-next-line no-useless-return
            return
          } else {
            const reader = new FileReader()
            reader.readAsDataURL(this.outroquarto_receipt)
            reader.onload = (e) => {
              this.filepreview = e.target.result
              this.fileName = this.outroquarto_receipt.name
            }
          }
        } else {
          alert('incompatible format')
          this.$refs.inputFile.values = null
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('schedule_form_msg_photo_type'))
        }
      }
    },
    async sendMoney () {
      const formData = new FormData()
      formData.append('id', this.form.id)
      formData.append('user_id', this.form.user_id)
      formData.append('house_code', this.form.house_code)
      formData.append('username', this.form.username)
      formData.append('phone', this.form.phone)
      formData.append('email', this.form.email)
      formData.append('address', this.form.address)
      formData.append('house_city', this.form.house_city)
      formData.append('house_county', this.form.house_county)
      formData.append('house_district', this.form.house_district)
      formData.append('house_street', this.form.house_street)
      formData.append('price', this.form.price)
      formData.append('percentage', this.percentage)
      formData.append('date', this.form.date)
      formData.append('time', this.form.time)
      formData.append('receipt', this.form.receipt)
      formData.append('request_type', this.form.request_type)
      /* formData.append('description', this.form.description) */
      formData.append('status', this.form.status)
      formData.append('owner', this.form.owner)
      formData.append('created_at', this.form.created_at)
      formData.append('updated_at', this.form.updated_at)
      formData.append('outroquarto_receipt', this.outroquarto_receipt)
      formData.append('trans_method', this.trans_method)
      formData.append('description', this.description)
      if (this.percentage === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_percetage'))
      } else if (this.owner.iban === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_time'))
      } else if (this.outroquarto_receipt === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_recept'))
      } else {
        axios.post('/api/payment-proccess', formData).then(() => {
          // eslint-disable-next-line no-undef
          this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
          this.$toastr.s(this.$t('myadmin_user_topMessage7'))
          this.outroquarto_receipt = ''
          this.trans_method = ''
          this.description = ''
          this.opens = false
        }).catch((error) => {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('myadmin_user_topMessage8'))
          console.log(error)
        })
      }
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
        this.form.fill(result)
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
  .dimmed.dimmable > .ui.animating.dimmer, .dimmed.dimmable > .ui.visible.dimmer, .ui.active.dimmer {
      display: flex;
      align-items: center!important;
      justify-content: center!important;
      }
      .ui.modal,
      .ui.active.modal {
      left: auto !important;
      transform-origin: center !important;
      transition: all ease .5s;
    }
</style>
