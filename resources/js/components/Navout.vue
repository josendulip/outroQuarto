<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="my-navBar">
    <div class="container">
      <router-link :to="{ name: 'welcome' }" class="navbar-brand"
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
              <router-link :to="{ name: 'services' }" class="nav-link">{{
                $t("services")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'collaborate' }" class="nav-link">{{
                $t("collaborate")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'advertiser' }" class="nav-link">{{
                $t("owner_house")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link">
                {{ $t("login") }}
              </router-link>
            </li>
            <!--  <li class="nav-item">
              <sui-dropdown :text="$t('account')" item class="simple nav-link">
                <sui-dropdown-menu>
                  <template v-if="authenticated">
                    <router-link :to="{ name: 'home' }" is="sui-dropdown-item">
                      {{ $t("home") }}
                    </router-link>
                  </template>

                  <template v-else>
                    <a href="javascript:void(0)" @click="signIn" is="sui-dropdown-item">
                      {{ $t("login") }}
                    </a>
                    <a href="javascrip:void(0)" @click="signUp" is="sui-dropdown-item">
                      {{ $t("register") }}
                    </a>
                  </template>
                </sui-dropdown-menu>
              </sui-dropdown>
            </li> -->

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
import LocaleDropdown from "./LocaleDropdown";

export default {
  components: {
    LocaleDropdown,
  },

  data: () => ({
    appName: window.config.appName,
    src: "/images/logo/200x48.png",
  }),
};
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}
</style>
