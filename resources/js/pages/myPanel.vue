<template>
  <div id="my-panel">
    <sidebar
      format="push"
      direction="left"
      :opacity="0.15"
      :links="[
        {'id': 1, 'text':$t('mypanel_sidebar_menu_myProperties'), 'url':'properties', 'icon': 'home icon'},
        {'id': 2, 'text': $t('mypanel_sidebar_menu_mySchedules'), 'url':'schedules', 'icon': 'calendar alternate icon'},
        {'id': 3, 'text': $t('mypanel_sidebar_menu_payments'), 'url': 'payments', 'icon': 'money bill alternate outline icon'},
        {'id': 4, 'text': $t('mypanel_sidebar_menu_assessments'), 'url': 'assessment', 'icon': 'star outline icon'},
        {'id': 5, 'text': $t('mypanel_sidebar_menu_statistics'), 'url': 'statistics', 'icon': 'chart line icon'},
        
      ]"
      :avatar="user.photo"
      :username="user.name"
      :status="user.status"
      :city="user.city"
      :country="user.country"
    >
    <ul class="">
          <li class="">
            <router-link :to="{ name: 'services' }" class="nav-link">{{
              $t("services")
            }}</router-link>
          </li>
          <li class="">
            <router-link :to="{ name: 'collaborate' }" class="nav-link">{{
              $t("")
            }}</router-link>
          </li>
    </ul>
    </sidebar>
    <div class="container my-5">
      <div class="row">
        <div class="col-md-3 mb-4">
          <h1>{{ $t("myPanel_title_one") }}</h1>
          <h5 class="text-muted">{{ $t("myPanel_title_sub_one") }}</h5>
          <sui-card class="rounded-radius">
            <sui-card-content>
              <sui-card-header>{{ $t("myPanel_title_two") }}</sui-card-header>
              <sui-card-meta>543</sui-card-meta>
              <sui-card-description>
                <ul class="list-group list-group-flush">
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Casas já publicadas
                    <sui-label color="red"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Imoveis Menos vista
                    <sui-label color="red"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Casas mais vista
                    <sui-label color="red"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Imoveis em destaques
                    <sui-label color="red"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Imoveis ocupado
                    <sui-label color="red"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Promover
                    <sui-label color="red"> 2 </sui-label>
                  </li>
                </ul>
              </sui-card-description>
            </sui-card-content>
            <sui-card-content>
              <sui-card-header>{{ $t("myPanel_schedules") }}</sui-card-header>
              <sui-card-meta>543</sui-card-meta>
              <sui-card-description>
                <ul class="list-group list-group-flush">
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Casas agendadas
                    <sui-label color="grey"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Agendamentos marcados
                    <sui-label color="grey"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Agendamentos concluidos
                    <sui-label color="grey"> 2 </sui-label>
                  </li>
                  <li
                    class="list-group-item d-flex justify-content-between align-items-center"
                  >
                    Pagamentos realizados
                    <sui-label color="grey"> 2 </sui-label>
                  </li>
                </ul>
              </sui-card-description>
            </sui-card-content>
            <sui-card-content extra> sfs </sui-card-content>
          </sui-card>
        </div>
        <div class="col-lg-9">
          <h1>{{ $t("myPanel_title_two") }}</h1>
          <div class="row">
            <div class="col-md-4 mb-4" v-for="house in myHouses.data" :key="house.id">
              <sui-card class="content-house rounded-radius">
                <sui-image :src="'./' + house.profile" />
                <p class="title-house">{{ house.created_at | OnlyDate }}</p>
                <div class="overlay-house"></div>
                <div class="button-house">
                  <div is="sui-button-group">
                    <sui-button
                      color="blue"
                      @click.prevent="editHouse(house.house_code)"
                      >{{ $t("myPanel_card_footer_edit") }}</sui-button
                    >
                    <sui-button-or />
                    <sui-button color="red" @click.prevent="viewHouse(house.house_code)">
                      {{ $t("myPanel_card_footer_view") }}</sui-button
                    >
                  </div>
                </div>
                <sui-card-content>
                  <sui-card-header
                    >{{
                      house.price
                        | currency("AKZ", 2, { spaceBetweenAmountAndSymbol: true })
                    }}/{{ house.payment_METHOD }}</sui-card-header
                  >
                  <sui-card-meta
                    >{{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}</sui-card-meta
                  >
                  <sui-card-description class="text-lowercase"
                    >{{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }} .</sui-card-description
                  >
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  {{ $t("home_form_type") }}:
                  <span
                    v-if="house.period == 'long period'"
                    class="font-weight-bold text-lowercase"
                    >{{ $t("home_form_type_long") }}</span
                  >
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span>
                </sui-card-content>
              </sui-card>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Navigator from "../components/Navigator";
import Footer from "../components/Footer";
import Form from "vform";
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

import Sidebar from '../components/Sidebar'
export default {
  /* middleware: 'auth', */
  name: "my-panel",
  components: {
    Navigator,
    Footer,
    'sidebar': Sidebar,
  },
  data: () => ({
    myHouses: {},
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
      description: "<h3>Hi!</h3><p>Write your content here...</p>",
      profile: "",
    }),
  }),
  methods: {
    editHouse(house_code) {
      this.$router.push("edit/" + house_code);
    },
    viewHouse(house_code) {
      this.$router.push("view/" + house_code);
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
  },
  computed: mapGetters({
    user: "auth/user",
    authenticated: "auth/check",
  }),
  mounted() {
    this.loadMyHouses();
  },
};
</script>
<style lang="scss">
.rounded-radius {
  border-radius: 2em !important;
  //cursor: pointer;
}
.ui.card > :first-child,
.ui.cards > .card > :first-child {
  border-radius: 1.9rem 1.9rem 0 0 !important;
  border-top: none !important;
}

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

.content-house .image-house {
  position: absolute;
  /* width: 500px;
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

