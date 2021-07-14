import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

// import config from '~/plugins/config'
import 'semantic-ui-css/semantic.min.css'

import '~/plugins'
import '~/components'

require('./plugins/config')

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
