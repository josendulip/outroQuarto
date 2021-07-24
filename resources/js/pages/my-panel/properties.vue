<template>
  <div class="">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">
        {{ $t("myPanel_title_two") }}
      </h3>
      <span>
        <sui-button v-show="column" icon="cube" @click="cubeless()" />
        <sui-button v-show="cube" icon="table" @click="tables()" />
        <sui-button v-show="table" icon="columns" @click="columns()" />
        <router-link :to="{ name: 'my-panel.new.home' }">
          <sui-button icon="plus square">{{ $t('mypanel_add_new_home') }}</sui-button>
        </router-link>
      </span>
    </div>
    <!-- COLLUMN -->
    <transition name="fade" mode="out-in">
      <div v-if="column" class="row column">
        <div v-for="house in myHouses.data" :key="house.id" class="col-md-3 mb-4">
          <sui-card class="content-house rounded-radius w-100">
            <sui-image :src="'./' + house.profile" class="myProfileImage" />
            <p class="title-house">
              <span v-if="house.add_images =='has'">
                <i class="images outline icon" /> <small>{{ $t('property_has_yes') }}</small>
              </span>
              <span v-if="house.add_images == 'hasnot'">
                <i class="unlink icon" /> <small>{{ $t('property_has_no') }}</small>
              </span>
            </p>
            <div class="overlay-house" />
            <div class="button-house">
              <div is="sui-button-group">
                <sui-button icon="pencil" :title="$t('myPanel_card_footer_edit')" @click.prevent="editHouse(house.house_code)" />
                <!-- {{$t("myPanel_card_footer_edit")}} -->
                <sui-button icon="eye icon" :title="$t('myPanel_card_footer_view')" @click.prevent="viewHouse(house.house_code)" />
                <!-- {{ $t("myPanel_card_footer_view") }} -->
                <sui-button icon="clipboard list" :title="$t('property_verify')" @click="verification(house.house_code)" />
                <sui-button icon="bullhorn" :title="$t('mypanel_promotion_btn')" @click="promoteHouse(house.house_code)" />
                <sui-button icon="trash alternate" :title="$t('myPanel_card_footer_delete')" @click="deleteHouse(house.id)" />
              </div>
              <button class="btn btn-warning mb-0 button-down text-white" @click="addImages(house.house_code)">
                {{ $t('property_add_img') }}
              </button>
            </div>
            <sui-card-content>
              <sui-card-header> {{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}/{{ house.payment_METHOD }}</sui-card-header>
              <sui-card-meta> {{ $t("announce_public_at") }} {{ house.created_at | OnlyDate }}</sui-card-meta>
              <sui-card-description class="text-lowercase">
                <span v-if="house.type">
                  <span v-if="house.type == 'Land'" class="text-capitalize">
                    {{ $t("annou_form_land") }}
                  </span>
                  <span v-else>{{ house.type }}</span>
                </span>
                <span v-if="house.room">, {{ house.room }} {{ $t("announce_form_room") }},</span>
                <span v-if="house.living_room">, {{ house.living_room }} {{ $t("announce_form_living_room") }},</span>
                <span v-if="house.bathroom">, {{ house.bathroom }} {{ $t("announce_form_bathroom") }}</span>
              </sui-card-description>
            </sui-card-content>
            <sui-card-content extra>
              <span v-if="house.add_images =='has'">
                <sui-icon name="images outline" /> {{ $t('property_has_') }}
              </span>
              <span v-if="house.add_images == 'hasnot'" class="text-danger">
                <sui-icon name="unlink" /> {{ $t('property_has_not') }}
              </span>
              <!-- {{ $t("home_form_type") }}: -->
              <!-- <div v-for="hasPhoto in hasPhotos" :key="hasPhoto.id">
                <span v-if="hasPhoto.house_code == house.house_code" class="d-inline">
                  <i class="images outline icon"></i>
                </span>
              </div> -->
              <!-- <span
                v-if="house.period == 'long period'"
                class="font-weight-bold text-lowercase"
                >{{ $t("home_form_type_long") }}</span
              >
              <span v-else class="font-weight-bold text-lowercase">{{
                $t("home_form_type_short")
              }}</span> -->
            </sui-card-content>
          </sui-card>
        </div>
      </div>
    </transition>
    <!-- TABLE -->
    <transition name="fade" mode="out-in">
      <div v-if="table" class="row px-3 justify-content-center">
        <div class="col-md-11 mb-4">
          <sui-table basic="very">
            <sui-table-header>
              <sui-table-row>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t('property_table_heard_photo') }}
                </sui-table-header-cell>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t("annou_form_state") }}
                </sui-table-header-cell>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t('property_table_heard_Type') }}
                </sui-table-header-cell>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t('property_table_heard_price') }}
                </sui-table-header-cell>
                <sui-table-header-cell>
                  <sui-popup :content="$t('announce_form_living_room')" position="top center">
                    <span slot="trigger">{{ $t("mypanel_l") }}</span>
                  </sui-popup> |
                  <sui-popup :content="$t('announce_form_room')" position="top center">
                    <span slot="trigger">{{ $t("mypanel_r") }}</span>
                  </sui-popup> |
                  <sui-popup :content="$t('announce_form_kitchen')" position="top center">
                    <span slot="trigger">{{ $t("mypanel_k") }}</span>
                  </sui-popup> |
                  <sui-popup :content="$t('announce_form_bathroom')" position="top center">
                    <span slot="trigger">{{ $t("mypanel_b") }}</span>
                  </sui-popup> |
                  <sui-popup :content="$t('announce_form_furniture')" position="top center">
                    <span slot="trigger">{{ $t("mypanel_f") }}</span>
                  </sui-popup> |
                  <sui-popup :content="$t('announce_form_garden')" position="top center">
                    <span slot="trigger">{{ $t("mypanel_s") }}</span>
                  </sui-popup>
                </sui-table-header-cell>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t("announce_public_at") }}
                </sui-table-header-cell>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t("view_house_details_city") }}
                </sui-table-header-cell>
                <sui-table-header-cell class="text-capitalize">
                  {{ $t("mypanel_action") }}
                </sui-table-header-cell>
              </sui-table-row>
            </sui-table-header>
            <sui-table-body>
              <sui-table-row v-for="house in myHouses.data" :key="house.id">
                <sui-table-cell><sui-image :src="'./' + house.profile" /></sui-table-cell>
                <sui-table-cell> <p class="text-muted" v-text="house.status" /> </sui-table-cell>
                <sui-table-cell>
                  <span v-if="house.type == 'Land'" class="text-capitalize">
                    {{ $t("annou_form_land") }}
                  </span>
                  <span v-else>{{ house.type }}</span>
                </sui-table-cell>
                <sui-table-cell> {{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}/{{ house.payment_METHOD }}</sui-table-cell>
                <sui-table-cell>
                  <span v-if="house.living_room">{{ house.living_room }}</span>
                  <span v-if="house.room">| {{ house.room }}</span>
                  <span v-if="house.kitchen">| {{ house.kitchen }}</span>
                  <span v-if="house.bathroom">| {{ house.bathroom }}</span>
                  <span v-if="house.furniture == 'not'" class="text-capitalize"> {{ $t("annou_form_garden_not") }}</span>
                  <span v-if="house.furniture == 'yes'" class="text-capitalize"> {{ $t("annou_form_garden_yes") }}</span>
                  <span v-if="house.garden == 'not'" class="text-capitalize">| {{ $t("annou_form_garden_not") }}</span>
                  <span v-if="house.garden == 'yes'" class="text-capitalize">| {{ $t("annou_form_garden_yes") }}</span>
                </sui-table-cell>
                <sui-table-cell>{{ house.created_at | OnlyDate }}</sui-table-cell>
                <sui-table-cell>{{ house.city }}</sui-table-cell>
                <sui-table-cell>
                  <sui-button circular color="blue" icon="edit outline" @click.prevent="editHouse(house.house_code)" />
                  <sui-button circular color="grey" icon="low vision" @click.prevent="viewHouse(house.house_code)" />
                  <sui-button circular color="red" icon="delete" @click="deleteHouse(house.id)" />
                </sui-table-cell>
              </sui-table-row>
            </sui-table-body>
          </sui-table>
        </div>
      </div>
    </transition>
    <!-- CUBE -->
    <transition name="fade" mode="out-in">
      <div v-if="cube" class="row column">
        <div v-for="house in myHouses.data" :key="house.id" class="col-md-3 mb-4 px-1">
          <div class="Mycard">
            <sui-image :src="'./' + house.profile" class="card-img-top myProfileImage" :alt="house.house_code" fluid />
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
                <span v-if="house.type">
                  <span v-if="house.type == 'Land'" class="text-capitalize">
                    {{ $t("annou_form_land") }}
                  </span>
                  <span v-else>{{ house.type }}</span>
                </span>
                <span v-if="house.room">, {{ house.room }} {{ $t("announce_form_room") }}</span>
                <span v-if="house.living_room">, {{ house.living_room }} {{ $t("announce_form_living_room") }}</span>
                <span v-if="house.bathroom">, {{ house.bathroom }} {{ $t("announce_form_bathroom") }}</span>
              </p>
            </div>
            <div class="d-flex justify-content-between">
              <sui-button size="mini" :content="$t('property_delete')" basic @click="deleteHouse(house.id)" />
              <sui-button size="mini" :content="$t('property_verify')" basic @click="verification(house.house_code)" />
              <sui-button size="mini" :content="$t('property_promote')" basic @click="promoteHouse(house.house_code)" />
            </div>
          </div>
        </div>
      </div>
    </transition>
    <!-- NONE -->
    <div v-if="myHouses.data <= 0" class="row justify-content-center">
      <div class="ui small message">
        <h3 class="main-color">
          <i class="exclamation triangle icon" /> {{ $t("mypanel_message") }}
        </h3>
        <p class="text-blue d-block text-center">
          <router-link :to="{ name: 'my-panel.new.home' }">
            <i class="bullhorn icon" /> {{ $t("owner_house") }}
          </router-link>
        </p>
      </div>
    </div>
    <div class="pagination">
      <pagination :data="myHouses" @pagination-change-page="getResults" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Form from 'vform'
import axios from 'axios'

export default {
  /*  middleware: 'auth', */
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'my-panel.properties',
  components: {},
  data: () => ({
    myHouses: {},
    form: new Form({
      city: '',
      county: '',
      district: '',
      street: '',
      period: '',
      type: '',
      payment_METHOD: '',
      price: '',
      room: '',
      living_room: '',
      kitchen: '',
      bathroom: '',
      garden: '',
      furniture: '',
      state: '',
      description: '<h5>Hi!</h5><p>Write your content here...</p>',
      profile: ''
    }),
    column: true,
    table: false,
    cube: false,
    hasPhotos: {}
  }),
  computed: mapGetters({
    user: 'auth/user',
    authenticated: 'auth/check'
  }),
  mounted () {
    this.loadMyHouses()
    // this.hasHousePhotos();
    // this.MouseOverHouse();
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadMyHouses()
    })
  },
  methods: {
    cubeless () {
      this.column = false
      this.table = false
      this.cube = true
    },
    tables () {
      this.table = true
      this.cube = false
      this.column = false
    },
    columns () {
      this.column = true
      this.cube = false
      this.table = false
    },
    addImages (houseCode) {
      this.$router.push('/add-images/' + houseCode)
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
    deleteHouse (id) {
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
        if (result.value) { // se o resultado for verdadeiro
          // mandar o request to server
          axios.post('api/delete-house/' + id)
            .then(() => {
              // eslint-disable-next-line no-undef
              Fire.$emit('after-created')
              // eslint-disable-next-line no-undef
              Swal.fire(
                this.$t('deleted'),
                this.$t('msg_deleted_success'),
                'success'
              )
            }).catch(() => {
              // eslint-disable-next-line no-undef
              Swal.fire(this.$t('msg_deleted_error'), 'error')
            })
        }
      })
    },
    viewHouse (houseCode) {
      /* axios.post('api/save-views/' + house_code)
        .then(()=>{
            Fire.$emit('AfterCreated'); // serve para atualizar a pagina dos usuarios
            this.review = false
            this.$toastr.s(
                this.$t('view_rating_message_suscceful_toastr')
            );
            this.form.reset()
            this.form.clear()
          }) */
      this.$router.push('view/' + houseCode)
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

    getResults (page = 1) {
      axios.get('api/my-houses/?page=' + page).then((response) => {
        this.myHouses = response.data
      })
    }
    /* MouseOverHouse(house){
      axios.get("api/has-photos/" + house).then(({ data }) => (this.hasPhotos = data))
      console.log(house)
    }, */
    /* hasHousePhotos(){
        axios.get("/api/has-photos").then(({ data }) => (this.hasPhotos = data))
    }  */
    /* loadMyHouses(){
        axios.get("/api/my-houses").then(({ data }) => (this.myHouses = data))
    } */
  }
}
</script>
<style lang="scss">
.rounded-radius {
  border-radius: 2em !important;
  //cursor: pointer;
}
/* .ui.card > :first-child,
.ui.cards > .card > :first-child {
  border-radius: 1.9rem 1.9rem 0 0 !important;
  border-top: none !important;
} */

/* Estilizar o cartao da casa */
.content-house {
  position: relative;
}

.overlay-house {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 2em !important;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

.content-house:hover .overlay-house {
  display: block;
  background: rgba(0, 0, 0, 0.473);
}

.myProfileImage{
    object-fit: cover;
    width: 100%;
    height: 200px;
  /* position: absolute;
  width: 500px;
        height: 300px;
        left: 0; */
}

.title-house {
  position: absolute;
  /* width: 500px; */
  width: 100%;
  left: 0;
  top: 120px;
  font-weight: 700;
  font-size: 30px;
  text-align: center;
  text-transform: uppercase;
  color: white;
  z-index: 1;
  transition: top 0.5s ease;
}

.content-house:hover .title-house {
  top: 90px;
}

.button-house {
  position: absolute;
  /* width: 500px; */
  width: 100%;
  left: 0;
  top: 180px;
  text-align: center;
  opacity: 0;
  transition: opacity 0.35s ease;
}

.button-house a {
  width: 200px;
  padding: 12px 48px;
  text-align: center;
  color: white;
  border: solid 2px white;
  z-index: 1;
}

.content-house:hover .button-house {
  opacity: 1;
}
</style>
