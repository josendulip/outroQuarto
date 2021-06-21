<template>
    <div class="container">
        <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">{{ $t("myPanel_title_two") }}</h3>
      <span>
      <sui-button icon="cube" @click="cubeless()" v-show="column" />
      <sui-button icon="table" @click="tables()" v-show="cube" />
      <sui-button icon="columns" @click="columns()" v-show="table" />
      <router-link :to="{ name: 'my-panel.new.home' }">
      <sui-button icon="plus square">{{ $t('mypanel_add_new_home') }}</sui-button>
      </router-link>
      </span>
    </div>
    <!-- COLLUMN -->
    <transition name="fade" mode="out-in">
      <div class="row column" v-if="column">
        <div class="col-md-3 mb-4" v-for="house in properties" :key="house.id">
          <sui-card class="content-house rounded-radius">
            <sui-image :src="'../' + house.profile" class="myProfileImage" />
            <p class="title-house"> 
              <span v-if="house.add_images =='has'"><i class="images outline icon"></i> <small>{{ $t('property_has_yes') }}</small></span>
              <span v-if="house.add_images == 'hasnot'"><i class="unlink icon"></i> <small>{{ $t('property_has_no') }}</small></span>              
            </p>
            <div class="overlay-house"></div>
            <div class="button-house">
              <div is="sui-button-group">
                <sui-button @click.prevent="editHouse(house.house_code)" icon="pencil"/>
                  <!-- {{$t("myPanel_card_footer_edit")}} -->
                <sui-button @click.prevent="viewHouse(house.house_code)" icon="eye slash outline"/>
                <!-- {{ $t("myPanel_card_footer_view") }} -->
                <sui-button  @click="deleteHouse(house.id)" icon="minus circle"/>
              </div>
            </div>
            <sui-card-content>
              <sui-card-header
                >{{
                  house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true })
                }}
                /{{ house.payment_METHOD }}</sui-card-header
              >
              <sui-card-meta
                >{{ $t("announce_public_at") }}
                {{ house.created_at | OnlyDate }}</sui-card-meta
              >
              <sui-card-description class="text-lowercase"
                >{{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                {{ house.living_room }} {{ $t("announce_form_living_room") }},
                {{ house.bathroom }}
                {{ $t("announce_form_bathroom") }}.</sui-card-description
              >
            </sui-card-content>
            <sui-card-content extra>
              <span v-if="house.add_images =='has'">
              <sui-icon name="images outline" /> {{ $t('property_has_') }}
              </span>
               <span v-if="house.add_images == 'hasnot'">
              <sui-icon name="unlink" /> {{ $t('property_has_not') }}
               </span>
            </sui-card-content>
          </sui-card>
        </div>
      </div>
    </transition>
    <!-- TABLE -->
    <transition name="fade" mode="out-in">
      <div class="row px-3 justify-content-center" v-if="table">
        <div class="col-md-11 mb-4">
        <sui-table basic="very">
          <sui-table-header>
            <sui-table-row>
              <sui-table-header-cell class="text-capitalize">{{ $t("view_house_details_desc")}}</sui-table-header-cell>
              <sui-table-header-cell class="text-capitalize">{{ $t('property_table_heard_photo') }}</sui-table-header-cell>
              <sui-table-header-cell class="text-capitalize">{{ $t('property_table_heard_Type') }}</sui-table-header-cell>
              <sui-table-header-cell class="text-capitalize">{{ $t('property_table_heard_price') }}</sui-table-header-cell>
              <sui-table-header-cell
                ><sui-popup :content="$t('announce_form_living_room')" position="top center">
                  <span slot="trigger">{{ $t("mypanel_l") }}</span></sui-popup
                >|
                <sui-popup
                  :content="$t('announce_form_room')"
                  position="top center"
                >
                  <span slot="trigger">{{ $t("mypanel_r") }}</span></sui-popup
                >
                |
                <sui-popup :content="$t('announce_form_kitchen')" position="top center">
                  <span slot="trigger">{{ $t("mypanel_k") }}</span></sui-popup
                >
                |
                <sui-popup :content="$t('announce_form_bathroom')" position="top center">
                  <span slot="trigger">{{ $t("mypanel_b") }}</span></sui-popup
                >
                |
                <sui-popup :content="$t('announce_form_furniture')" position="top center">
                  <span slot="trigger">{{ $t("mypanel_f") }}</span></sui-popup
                >
                |
                <sui-popup :content="$t('announce_form_garden')" position="top center">
                  <span slot="trigger">{{ $t("mypanel_s") }}</span></sui-popup
                ></sui-table-header-cell
              >
              <sui-table-header-cell class="text-capitalize">{{
                $t("announce_public_at")
              }}</sui-table-header-cell>
              <sui-table-header-cell class="text-capitalize">{{
                $t("annou_form_state")
              }}</sui-table-header-cell>
              <sui-table-header-cell class="text-capitalize">{{
                $t("mypanel_action")
              }}</sui-table-header-cell>
            </sui-table-row>
          </sui-table-header>
          <sui-table-body>
            <sui-table-row v-for="house in properties" :key="house.id">
              <sui-table-cell><sui-image :src="'../' + house.profile" /></sui-table-cell>
              <sui-table-cell
                ><p class="text-muted" v-text="house.status"></p
              ></sui-table-cell>
              <sui-table-cell>{{ house.type }}</sui-table-cell>
              <sui-table-cell>
                {{
                  house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true })
                }}/{{ house.payment_METHOD }}</sui-table-cell
              >
              <sui-table-cell
                >{{ house.living_room }} | {{ house.room }} | {{ house.kitchen }} |
                {{ house.bathroom }} |
                <span class="text-capitalize" v-if="house.furniture == 'not'">{{
                  $t("annou_form_garden_not")
                }}</span>
                <span class="text-capitalize" v-if="house.furniture == 'yes'">{{
                  $t("annou_form_garden_yes")
                }}</span
                >|
                <span class="text-capitalize" v-if="house.garden == 'not'">{{
                  $t("annou_form_garden_not")
                }}</span>
                <span class="text-capitalize" v-if="house.garden == 'yes'">{{
                  $t("annou_form_garden_yes")
                }}</span></sui-table-cell
              >
              <sui-table-cell>{{ house.created_at | OnlyDate }}</sui-table-cell>
              <sui-table-cell>{{ house.state }}</sui-table-cell>
              <sui-table-cell>
                <sui-button
                  circular
                  color="blue"
                  @click.prevent="editHouse(house.house_code)"
                  icon="edit outline"
                />
                <sui-button
                  circular
                  color="grey"
                  @click.prevent="viewHouse(house.house_code)"
                  icon="low vision"
                />
                <sui-button
                  circular
                  color="red"
                @click="deleteHouse(house.id)"
                icon="delete"/>
              </sui-table-cell>
            </sui-table-row>
          </sui-table-body>
        </sui-table>
        </div>
      </div>
    </transition>
    <!-- CUBE -->    
    <transition name="fade" mode="out-in">
      <div class="row column" v-if="cube">
        <div class="col-md-3 mb-4 px-1" v-for="house in properties" :key="house.id">
          <div class="Mycard">
            <sui-image :src="'../' + house.profile"  class="card-img-top myProfileImage" :alt="house.house_code" fluid />
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
            <sui-button size="mini" :content="$t('property_delete')" basic @click="deleteHouse(house.id)"/>
            <sui-button size="mini" :content="$t('property_verify')" basic  @click="verification(house.house_code)"/>
            <sui-button size="mini" :content="$t('property_promote')" basic @click="promoteHouse(house.house_code)"/>
            </div>
          </div>
        </div>
      </div>
    </transition>
    <!-- NONE -->
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import Form from "vform";
import axios from "axios";
export default {
    data:()=>({
        properties: {},
        form: new Form({
            city: "",
            county: "",
            district: "",
            street: "",
            period: "",
            type: "",
            payment_METHOD: "",
            price: "",
            room: "",
            living_room: "",
            kitchen: "",
            bathroom: "",
            garden: "",
            furniture: "",
            state: "",
            description: "<h5>Hi!</h5><p>Write your content here...</p>",
            profile: "",
        }),
        column: true,
        table: false,
        cube: false,
        hasPhotos: {},

    }),
    methods:{
        cubeless(){      
            this.column = false;
            this.table = false;
            this.cube = true;
        },
        tables() {
            this.table = true;
            this.cube = false;
            this.column = false;
        },
        columns() {
            this.column = true;
            this.cube = false;
            this.table = false;
        },
        viewHouse(house_code) {     
            this.$router.push("/view/" + house_code);
        },
        async loadProperties() {
            try {
                const response = await fetch("/api/properties");
                const result = await response.json();
                this.properties = result;
            } catch (error) {
                console.log(error);
            }
        },
    },
    computed: mapGetters({
        user: "auth/user",
        authenticated: "auth/check",
    }),
    mounted() {
        this.loadProperties();
    }
}
</script>