<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="my-navBar">
    <div class="container">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand"
        ><img :src="src" alt="logo" class="img-fluid"
      /></router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent-7"
        aria-controls="navbarSupportedContent-7"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <router-link :to="{ name: 'services' }" class="nav-link">
              {{ $t("services") }}
            </router-link>
          </li>
          <li v-if="user.role === 'user'" class="nav-item">
            <router-link :to="{ name: 'user.workwithus' }" class="nav-link">{{
              $t("collaborate")
            }}</router-link>
          </li>
          <li class="nav-item" v-if="user.role === 'owner'">
            <router-link :to="{ name: 'my-panel.welcome' }" class="nav-link">{{
              $t("owner")
            }}</router-link>
          </li>
          <li class="nav-item" v-if="user.role === 'admin' || user.role === 'employer'">
            <router-link :to="{ name: 'admin.dashboard' }" class="nav-link">{{
              $t("myadmin")
            }}</router-link>
          </li>
          <li class="nav-item" v-if="user.role === 'user'">
            <router-link :to="{ name: 'user.announce' }" class="nav-link">{{
              $t("home_announce")
            }}</router-link>
          </li>
          <li class="nav-item" v-if="user.role === 'user'">
            <sui-dropdown :text="$t('activities')" item class="simple nav-link">
              <sui-dropdown-menu>
                <template>
                  <router-link :to="{ name: 'user.schedules' }" is="sui-dropdown-item">
                    {{ $t("home_scheduled_visits") }}
                  </router-link>
                  <router-link :to="{ name: 'user.payments' }" is="sui-dropdown-item">
                    {{ $t("home_payment") }}
                  </router-link>
                  <router-link :to="{ name: 'user.assessments' }" is="sui-dropdown-item">
                    {{ $t("home_assessment") }}
                  </router-link>
                  <router-link :to="{ name: 'user.favourites' }" is="sui-dropdown-item">
                    {{ $t("home_favorite") }}
                  </router-link>
                  <router-link :to="{ name: 'user.histories' }" is="sui-dropdown-item">
                    {{ $t("home_history") }}
                  </router-link>
                </template>
              </sui-dropdown-menu>
            </sui-dropdown>
          </li>
          <!-- <li class="nav-item dropdown" v-if="user.role === 'owner'">
            <a
              class="nav-link dropdown-toggle text-dark"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ $t("owner") }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{name: 'announce'}" class="dropdown-item pl-3">
                <i class="bullhorn icon"></i>
                {{ $t("owner_house")}}</router-link>
              <router-link :to="{  name: 'my-panel.welcome' }" class="dropdown-item pl-3">                
                <i class="building outline icon"></i>
                {{ $t('my_house') }}
              </router-link>

              <router-link :to="{  name: 'my-panel' }" class="dropdown-item pl-3"> 
                <i class="calendar alternate outline icon"></i>
                {{ $t('my_agends') }}
              </router-link>
            </div>
          </li> -->
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-dark"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1" />
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                <fa icon="cog" fixed-width />
                {{ $t("settings") }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t("logout") }}
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <sui-dropdown :text="$t('account')" item class="simple nav-link">
              <sui-dropdown-menu>
                <template v-if="authenticated">
                  <router-link :to="{ name: 'home' }" is="sui-dropdown-item">
                    {{ $t("home") }}
                  </router-link>
                </template>
                <template v-else>
                  <router-link :to="{ name: 'login' }" is="sui-dropdown-item">
                    {{ $t("login") }}
                  </router-link>
                  <router-link :to="{ name: 'register' }" is="sui-dropdown-item">
                    {{ $t("register") }}
                  </router-link>
                </template>
              </sui-dropdown-menu>
            </sui-dropdown>
          </template>

          <ul class="navbar-nav">
            <locale-dropdown />
            <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li> -->
          </ul>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "./LocaleDropdown";

export default {
  components: {
    LocaleDropdown,
  },

  data: () => ({
    appName: window.config.appName,
    src: "/images/logo/200x48.png",
  }),

  computed: mapGetters({
    user: "auth/user",
    authenticated: "auth/check",
  }),

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
  },
};
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}
</style>
