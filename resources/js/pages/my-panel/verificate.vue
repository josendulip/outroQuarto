<template>
  <div>
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">
        {{ $t("mypanel_verif_verification") }}
      </h3>
      <span>
        <sui-button v-show="table" icon="cube" @click="cubes()" />
        <sui-button v-show="cube" icon="table" @click="tables()" />
      </span>
    </div>
    <div v-show="cube" class="row cube">
      <div v-for="house in vefyHouses" :key="house.id" class="col-md-3 mb-4">
        <sui-card>
          <sui-card-content>
            <sui-card-header>
              {{ $t('mypanel_verification_title') }}
            </sui-card-header>
          </sui-card-content>
          <sui-card-content>
            <sui-header size="tiny" class="text-uppercase text-danger">
              <a is="sui-label" v-if="house.status == 'reserved'" tag class="text-success"> {{ house.status }} </a>
              <a is="sui-label" v-if="house.status == 'approved'" tag class="text-primary"> {{ house.status }} </a>
              <a is="sui-label" v-if="house.status == 'pending'" tag class="text-danger"> {{ house.status }} </a>
            </sui-header>
            <div class="ui small feed">
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a>{{ $t('mypanel_promo_table_price') }}</a> <span v-if="house.price" class="text-success">{{ house.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}</span> <span v-else class="text-muted">{{ $t('mypanel_vefy_awaitin') }}</span>
                  </div>
                </div>
              </div>
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a>{{ $t('mypanel_vefy__table_date') }}</a> <span v-if="house.date">{{ house.date }} {{ $t('mypanel_verif_at') }} {{ house.time }}</span> <span v-else class="text-danger text-lowercase">: {{ $t('mypanel_vefy_nodate') }}</span>
                  </div>
                </div>
              </div>
              <div v-if="house.receipt" class="event">
                <div class="content">
                  <div class="summary">
                    <a :href="'/' + house.receipt" target="_blank"> {{ $t('mypanel_Download') }} </a> <span class="text-lowercase">{{ $t('schedule_form_mgs_recept') }}</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of base semantic ui, to be updated in the future with sui-feed -->
          </sui-card-content>
          <sui-card-content extra>
            <sui-button :content="$t('mypanel_verificate_btn')" basic @click="verification(house.house_code)" />
          </sui-card-content>
        </sui-card>
      </div>
    </div>
    <div v-show="table" class="row table mx-2">
      <sui-table color="red">
        <sui-table-header>
          <sui-table-row>
            <sui-table-header-cell>{{ $t('mypanel_vefy__table_id') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_vefy__table_type') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_vefy__table_date') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_vefy__table_price') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_vefy__table_invoice') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_vefy__table_status') }}</sui-table-header-cell>
          </sui-table-row>
        </sui-table-header>
        <sui-table-body>
          <sui-table-row v-for="vefyHouse in vefyHouses" :key="vefyHouse.id">
            <sui-table-cell><a href="javascript:void(0)" @click.prevent="verification(vefyHouse.house_code)">{{ vefyHouse.house_code }}</a></sui-table-cell>
            <sui-table-cell>{{ vefyHouse.request_type }}</sui-table-cell>
            <sui-table-cell>
              <span v-if="vefyHouse.date"> {{ vefyHouse.date }} {{ $t('mypanel_verif_at') }} {{ vefyHouse.time }} </span>
              <span v-else class="text-muted">{{ $t('mypanel_vefy_nodate') }}</span>
            </sui-table-cell>
            <sui-table-cell>
              <span v-if="vefyHouse.price">{{ vefyHouse.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true, thousandsSeparator: '.', decimalSeparator: ',' }) }}</span>
              <span v-else class="text-muted">{{ $t('mypanel_vefy_awaitin') }}</span>
            </sui-table-cell>
            <sui-table-cell>
              <a v-if="vefyHouse.receipt" :href="'/' + vefyHouse.receipt" target="_blank">{{ $t('mypanel_Download') }}</a>
              <span v-else class="text-muted">{{ $t('mypanel_vefy_awaitin') }}</span>
            </sui-table-cell>
            <sui-table-cell class="text-center">
              <span v-if="vefyHouse.status == 'reserved'">
                <sui-label circular color="green" empty :title="vefyHouse.status" />

              </span>
              <span v-if="vefyHouse.status == 'approved'">
                <sui-label circular color="blue" empty :title="vefyHouse.status" />
              </span>
              <span v-if="vefyHouse.status == 'pending'">
                <sui-label circular color="red" empty :title="vefyHouse.status" />
              </span>
            </sui-table-cell>
          </sui-table-row>
        </sui-table-body>
      </sui-table>
    </div>
  </div>
</template>

<script>

export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'my-panel.promote',
  components: {},
  middleware: 'auth',
  data: () => ({
    myHouses: {},
    vefyHouses: {},
    cube: false,
    table: true
  }),
  mounted () {
    this.loadMyHouses()
    this.loadVefyHouses()
  },
  methods: {
    cubes () {
      this.cube = true
      this.table = false
    },
    tables () {
      this.table = true
      this.cube = false
    },
    editHouse (houseCode) {
      this.$router.push('/edit/' + houseCode)
    },
    promoteHouse (houseCode) {
      this.$router.push('/promotion/' + houseCode)
    },
    verification (houseCode) {
      this.$router.push('/verification/' + houseCode)
    },
    viewHouse (houseCode) {
      this.$router.push('view/' + houseCode)
    },
    getProfilePhoto () {
      let photo = '../images/property/thumbnail/no-image.png'
      if (this.form.profile) {
        photo = '../' + this.form.profile
      }
      return photo
    },
    async loadMyHouses () {
      try {
        const response = await fetch('api/my-houses')
        const result = await response.json()
        this.myHouses = result
        // console.log(this.myHouses);
      } catch (error) {
        console.log(error)
      }
    },
    async loadVefyHouses () {
      try {
        const response = await fetch('/api/request-verification')
        const result = await response.json()
        this.vefyHouses = result
        // console.log(this.promoHouses);
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
