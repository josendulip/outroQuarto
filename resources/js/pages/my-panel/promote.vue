<template>
  <div>
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">
        {{ $t("myPanel_title_two") }}
      </h3>
      <span>
        <sui-button v-show="table" icon="cube" @click="cubes()" />
        <sui-button v-show="cube" icon="table" @click="tables()" />
      </span>
    </div>
    <div v-show="cube" class="row cube">
      <div v-for="house in promoHouses" :key="house.id" class="col-md-3 mb-4">
        <sui-card>
          <sui-card-content>
            <sui-card-header>
              {{ house.request_type }}
            </sui-card-header>
          </sui-card-content>
          <sui-card-content>
            <sui-header size="tiny" class="text-uppercase text-danger">
              <a is="sui-label" tag> {{ house.status }} </a>
            </sui-header>
            <div class="ui small feed">
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a>{{ $t('mypanel_promo_table_price') }}</a> {{ house.total_amount | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
                  </div>
                </div>
              </div>
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a>{{ $t('mypanel_promo_table_days') }}</a> {{ house.total_days }}
                  </div>
                </div>
              </div>
              <div class="event">
                <div class="content">
                  <div class="summary">
                    {{ $t('mypanel_verificaRec') }} <a :href="'/' + house.receipt_promo" target="_blank"> {{ $t('mypanel_Download') }} </a>
                  </div>
                </div>
              </div>
            </div>
            <!-- end of base semantic ui, to be updated in the future with sui-feed -->
          </sui-card-content>
          <sui-card-content extra>
            <sui-button :content="$t('mypanel_verificate_btn')" basic @click="promoteHouse(house.house_code)" />
          </sui-card-content>
        </sui-card>
      </div>
    </div>
    <div v-show="table" class="row table mx-2">
      <sui-table color="red">
        <sui-table-header>
          <sui-table-row>
            <sui-table-header-cell>{{ $t('mypanel_promo_table_id') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_promo_table_type') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_promo_table_days') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_promo_table_price') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_promo_table_invoice') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_promo_table_status') }}</sui-table-header-cell>
          </sui-table-row>
        </sui-table-header>
        <sui-table-body>
          <sui-table-row v-for="promoHouse in promoHouses" :key="promoHouse.id">
            <sui-table-cell><a href="javascript:void(0)" @click.prevent="promoteHouse(promoHouse.house_code)">{{ promoHouse.house_code }}</a></sui-table-cell>
            <sui-table-cell>{{ promoHouse.request_type }}</sui-table-cell>
            <sui-table-cell>{{ promoHouse.total_days }}</sui-table-cell>
            <sui-table-cell>{{ promoHouse.total_amount }}</sui-table-cell>
            <sui-table-cell><a :href="promoHouse.receipt_promo" target="_blank">{{ $t('mypanel_Download') }}</a></sui-table-cell>
            <sui-table-cell>{{ promoHouse.status }}</sui-table-cell>
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
    promoHouses: {},
    cube: false,
    table: true
  }),
  mounted () {
    this.loadPromoHouses()
    this.loadMyHouses()
  },
  methods: {
    cubes () { this.cube = true; this.table = false },
    tables () { this.table = true; this.cube = false },
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
    async loadPromoHouses () {
      try {
        const response = await fetch('/api/request-promo')
        const result = await response.json()
        this.promoHouses = result
        // console.log(this.promoHouses);
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>
<style lang="scss">
.myProfileImage{
    object-fit: cover;
    width: 100%;
    height: 200px;
}
</style>
