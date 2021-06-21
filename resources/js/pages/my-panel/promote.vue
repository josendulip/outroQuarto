<template>
    <div>
        <div class="row mb-3 justify-content-between align-items-center px-3">
        <h3 class="text-muted">{{ $t("myPanel_title_two") }}</h3>
        <span> 
            <sui-button icon="cube" @click="cubes()"  v-show="table" />
            <sui-button icon="table" @click="tables()" v-show="cube" />
        </span>
        </div>
        <div class="row cube" v-show="cube">
            <div class="col-md-3 mb-4" v-for="house in myHouses.data" :key="house.id">
                <div class="Mycard">
                <sui-image :src="'./' + house.profile"  class="card-img-top myProfileImage" :alt="house.house_code" fluid />
                <div class="title-house">
                    <p class="">{{ house.created_at | OnlyDate }}</p>
                    <div>
                    <sui-button color="blue" size="mini" @click.prevent="editHouse(house.house_code)">{{
                        $t("myPanel_card_footer_edit")
                    }}</sui-button>

                    <sui-button color="red" size="mini" @click.prevent="viewHouse(house.house_code)">
                        {{ $t("myPanel_card_footer_view") }}</sui-button
                    >
                    </div>
                </div>
                <div class="text-black">
                    <h5 class="pb-0 mb-0"> {{ house.city }}, {{ house.county }}</h5>
                    <p class="pt-0 mt-0"> {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }} .</p>
                </div>
                <div class="d-flex justify-content-between">
                    <sui-button size="mini" :content="$t('mypanel_verificate_btn')" basic @click="verification(house.house_code)"/>
                    <sui-button size="mini" :content="$t('mypanel_promotion_btn')" basic @click="promoteHouse(house.house_code)"/>
                </div>
                </div>
            </div>
        </div> 
        <div class="row table mx-2" v-show="table">
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
                    <sui-table-cell><a href="javascript:void(0)" @click.prevent="viewHouse(promoHouse.house_code)">{{  promoHouse.house_code }}</a></sui-table-cell>
                    <sui-table-cell>{{ promoHouse.request_type }}</sui-table-cell>
                    <sui-table-cell>{{ promoHouse.total_days }}</sui-table-cell>
                    <sui-table-cell>{{ promoHouse.total_amount }}</sui-table-cell>
                    <sui-table-cell><a :href="promoHouse.receipt_promo" target="_blank">Recept</a></sui-table-cell>
                    <sui-table-cell>{{ promoHouse.status }}</sui-table-cell>
                </sui-table-row>
            </sui-table-body>
            </sui-table>
        </div>
    </div>
</template>

<script>

export default {
  middleware: 'auth',
  name: "my-panel.promote",
  components: {},
  data: () => ({
    myHouses: {},
    promoHouses: {}, 
    cube: false,
    table: true,
  }),
  methods: {
    cubes(){ this.cube = true; this.table = false},
    tables(){ this.table = true; this.cube = false},
    promoteHouse(house_code) {
      this.$router.push("/promotion/" + house_code);
    },
    verification(house_code){
      this.$router.push("/verification/" + house_code);
    },
    viewHouse(house_code) {
      this.$router.push("view/" + house_code);
    },
    getProfilePhoto() {
      let photo = "../images/property/thumbnail/no-image.png";
      if (this.form.profile) {
        photo = "../" + this.form.profile;
      }
      return photo;
    },    
    async loadMyHouses() {
      try {
        const response = await fetch("api/my-houses");
        const result = await response.json();
        this.myHouses = result;
        //console.log(this.myHouses);
      } catch (error) {
        console.log(error);
      }
    },    
    async loadPromoHouses() {
       try {
        const response = await fetch("/api/request-promo")
        const result = await response.json();
        this.promoHouses = result;
        //console.log(this.promoHouses);
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.loadPromoHouses();
    this.loadMyHouses();
  },
}
</script>
<style lang="scss">
.myProfileImage{  
    object-fit: cover;
    width: 100%;
    height: 200px;
}
</style>