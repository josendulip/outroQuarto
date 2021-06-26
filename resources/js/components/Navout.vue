<template>
  <nav id="my-navBar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <router-link :to="{ name: 'welcome' }" class="navbar-brand">
        <img :src="src" alt="logo" class="img-fluid">
      </router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent-7"
        aria-controls="navbarSupportedContent-7"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon" />
      </button>
      <div id="navbarSupportedContent-7" class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <!-- <router-link :to="{ name: 'services' }" class="nav-link">
              {{ $t("services") }}
            </router-link> -->
            <a href="#" class="nav-link">
              {{ $t("services") }}
            </a>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'collaborate' }" class="nav-link">
              {{ $t("collaborate") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'advertiser' }" class="nav-link">
              {{ $t("owner_house") }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'login' }" class="nav-link">
              {{ $t("login") }}
            </router-link>
          </li>

          <ul class="navbar-nav">
            <locale-dropdown />
          </ul>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName,
    src: '/images/logo/200x48.png'
  })
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}
</style>
