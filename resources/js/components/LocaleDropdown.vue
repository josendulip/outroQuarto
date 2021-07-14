<template>
  <li v-if="Object.keys(locales).length > 1" class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
    >
      <span v-if="locales[locale] == 'BR'"><img src="/images/flags/ao.svg" style="width:15px; height:9px; object-fit:cover;"> PT</span>
      <span v-else><img src="/images/flags/gb.svg" style="width:15px; height:9px; object-fit:cover;"> {{ locales[locale] }}</span>
    </a>
    <div class="dropdown-menu">
      <a v-for="(value, key) in locales" :key="key" class="dropdown-item" href="#"
         @click.prevent="setLocale(key)"
      >
        <span v-if="value == 'EN' || value == 'BR'">
          <span v-if="value == 'BR'">PT</span>
          <span v-else>{{ value }}</span>
        </span>
      </a>
    </div>
  </li>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
    }
  }
}
</script>
