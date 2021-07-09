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
      <div v-for="house in vefyHouses" :key="house.id" class="col-md-3 mb-4">
        <sui-card>
          <sui-card-content>
            <sui-card-header>
              {{ $t('mypanel_verification_title') }}
            </sui-card-header>
          </sui-card-content>
          <sui-card-content>
            <sui-header size="tiny" class="text-uppercase text-danger">
              <a is="sui-label" tag> {{ house.status }} </a>
            </sui-header>
            <!--
              sui-feed is not available yet, therefore base semantic ui has been substituted for now
            -->
            <div class="ui small feed">
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a>{{ $t('mypanel_promo_table_price') }}</a> {{ house.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
                  </div>
                </div>
              </div>
              <div class="event">
                <div class="content">
                  <div class="summary">
                    <a>{{ $t('mypanel_vefy__table_date') }}</a> {{ house.date | OnlyDate }} {{ $t('mypanel_verif_at') }} {{ house.time }}
                  </div>
                </div>
              </div>
              <div class="event">
                <div class="content">
                  <div class="summary">
                    {{ $t('mypanel_verificaRec') }} <a :href="'/' + house.receipt" target="_blank"> {{ $t('mypanel_Download') }} </a>
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
        <!-- <div class="Mycard">
          <sui-image :src="'./' + house.profile" class="card-img-top" :alt="house.house_code" fluid />
          <div class="title-house">
            <p class="">
              {{ house.created_at | OnlyDate }}
            </p>
            <div>
              <sui-button color="blue" size="mini" @click.prevent="editHouse(house.house_code)">
                {{ $t("myPanel_card_footer_edit") }}
              </sui-button>

              <sui-button color="red" size="mini" @click.prevent="viewHouse(house.house_code)">
                {{ $t("myPanel_card_footer_view") }}
              </sui-button>
            </div>
          </div>
          <div class="text-black">
            <h5 class="pb-0 mb-0">
              {{ house.city }}, {{ house.county }}
            </h5>
            <p class="pt-0 mt-0">
              {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
              {{ house.living_room }} {{ $t("announce_form_living_room") }},
              {{ house.bathroom }}
              {{ $t("announce_form_bathroom") }}.
            </p>
          </div>
          <div class="d-flex justify-content-between">
            <sui-button size="mini" :content="$t('mypanel_verificate_btn')" basic @click="verification(house.house_code)" />
            <sui-button size="mini" :content="$t('mypanel_promotion_btn')" basic @click="promoteHouse(house.house_code)" />
          </div>
        </div> -->
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
            <sui-table-cell>{{ vefyHouse.date | OnlyDate }} {{ $t('mypanel_verif_at') }} {{ vefyHouse.time }}</sui-table-cell>
            <sui-table-cell>{{ vefyHouse.price }}</sui-table-cell>
            <sui-table-cell><a :href="vefyHouse.receipt" target="_blank">Recept</a></sui-table-cell>
            <sui-table-cell>{{ vefyHouse.status }}</sui-table-cell>
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
