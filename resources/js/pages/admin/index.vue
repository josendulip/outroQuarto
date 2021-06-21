<template>
  <div id="admin" v-if="user.role === 'admin' || user.role === 'employer'">  <!-- style="background-color: #f7f9fb;" -->
    <SidebarAdmin
      format="push"
      direction="left"
      :opacity="0.15"
      :links="[
        {'id': 1, 'text': $t('myadmin_verify_payments'), 'url':'/admin/schedule-services', 'icon': 'money bill alternate outline icon'},
        {'id': 2, 'text': $t('myadmin_suggested_houses'), 'url':'/admin/suggested-property', 'icon': 'eye icon'},
        {'id': 3, 'text': $t('myadmin_properties'), 'url':'/admin/properties', 'icon': 'home icon'},
        {'id': 4, 'text': $t('myadmin_users'), 'url':'/admin/users', 'icon': 'users icon'},
        {'id': 5, 'text': $t('myadmin_user'), 'url':'/admin/user', 'icon': 'user icon'},
        {'id': 6, 'text': $t('myadmin_profile'), 'url':'/admin/profile', 'icon': 'user circle icon'},
        {'id': 7, 'text': $t('myadmin_profile_pwd'), 'url':'/admin/profile/password', 'icon': 'key icon'},
        
      ]"
      :avatar="user.photo"
      :username="user.name"
      :status="user.status"
      :city="user.city"
      :country="user.country"
      :profile="user.photo"
      :roles="user.role"
    >
    <ul class="">
          <li class="">
            <router-link :to="{ name: 'new_home' }" class="nav-link">{{
              $t("services")
            }}</router-link>
          </li>
          <li class="">
            <router-link :to="{ name: 'collaborate' }" class="nav-link">{{
              $t("")
            }}</router-link>
          </li>
    </ul>
    </SidebarAdmin>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>{{ $t('mypanel_welcome_message_back') }}</h2>
                    <p class="mb-md-0">{{ $t('mypanel_welcome_message_') }}</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<router-link :to="{  name: 'admin.dashboard' }">{{ $t('mypanel_menu_dashboard') }}</router-link>&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor text-capitalize" v-for="(tag, index) in $route.name.split('.')" :key="tag"> <span v-if="index == 1">{{ tag }}</span></p>
                  </div>
                </div>                
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <form action="" class="form-inline">
                      <input class="form-control mr-sm-2 " type="search" :placeholder="$t('search_for')" aria-label="Search">
                    </form>
                </div>
              </div>
            </div>
          </div>
          <hr class="text-danger">
        <transition name="fade" mode="out-in">
            <router-view />
        </transition>
    </div>
  </div>
  <div v-else  class="d-flex justify-content-center my-5">
      <div class="text-center">
        <h1 class="display-1">401</h1>
        <p class="h1">{{ $t('mypanel_mgs')}}</p>
      </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Navigator from "../../components/Navigator";
import Footer from "../../components/Footer";
import Form from "vform";

import SidebarAdmin from '../../components/SidebarAdmin'
export default {
  middleware: 'auth',
  name: "admin",
  components: {
    Navigator,
    Footer,
    'SidebarAdmin': SidebarAdmin,
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

input[type=search] {
	background: #f8f9fa;
	border: solid 1px #ccc;
	padding: 9px 10px 9px 32px;
	
}
input[type=search]:focus {
	width: 300px;
	background-color: #fff;
	border-color: #333;
	border: solid 1px #fff;
}
</style>

