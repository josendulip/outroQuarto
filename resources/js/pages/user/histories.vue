<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center">
      <h3 class="text-muted">
        {{ $t("userpanel_history") }}
      </h3>
      <sui-menu compact>
        <router-link is="sui-menu-item" :to="{ name: 'user.welcome' }" size="tiny">
          {{ $t('mypanel_back') }}
        </router-link>
      </sui-menu>
    </div>
    <div class="row justify-content-md-center">
      <div v-if="histories.length <= 0" class="d-flex justify-content-center">
        <transition name="fade">
          <sui-message
            v-if="visible"
            header="Welcome back!"
            content="There is no any data here. Sorry"
            dismissable
            @dismiss="handleDismiss"
          />
        </transition>
        <p v-if="!visible">
          Message will come back in 2s
        </p>
      </div>
      <sui-table basic="very">
        <sui-table-header>
          <sui-table-row>
            <sui-table-header-cell class="text-capitalize">
              {{ $t('myadmin_user_Id') }}
            </sui-table-header-cell>
            <sui-table-header-cell>{{ $t('schedulCreatedAt') }}</sui-table-header-cell>
            <sui-table-header-cell>{{ $t('announce_form_type') }}</sui-table-header-cell>
            <sui-table-header-cell>
              {{ $t('schedulLink') }}
            </sui-table-header-cell>
            <sui-table-header-cell>{{ $t('mypanel_action') }}</sui-table-header-cell>
          </sui-table-row>
        </sui-table-header>
        <sui-table-body>
          <sui-table-row v-for="(history, index) in histories.data" :key="history.id">
            <sui-table-cell>{{ index }}</sui-table-cell>
            <sui-table-cell>{{ history.created_at | MultipleLocaleSupport }}</sui-table-cell>
            <sui-table-cell>
              <span v-if=" history.type === 'Land'">{{ $t('annou_form_land') }}</span>
              <span v-else-if=" history.type === 'outhouse'">{{ $t('annou_form_type_outhouse') }}</span>
              <span v-else>{{ history.type }}</span>
            </sui-table-cell>
            <sui-table-cell><a href="javascript:void(0)" @click.prevent="viewHouse(history.house_code)">{{ history.house_code }}</a></sui-table-cell>
            <sui-table-cell class="text-center">
              <a href="javascript:void(0)" color="red" @click.prevent="deleteHistory(history.id)"><i class="window close icon" :title="$t('property_delete')" /></a>
            </sui-table-cell>
          </sui-table-row>
        </sui-table-body>
        <sui-table-footer>
          <sui-table-row>
            <sui-table-header-cell colspan="5">
              <pagination :data="histories" @pagination-change-page="getResults" />
            </sui-table-header-cell>
          </sui-table-row>
        </sui-table-footer>
      </sui-table>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'user.histories',
  data () {
    return {
      histories: {},
      visible: true
    }
  },
  mounted () {
    this.loadHouses()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadHouses()
    })
  },
  methods: {
    viewHouse (houseCode) {
      this.$router.push('/view/' + houseCode)
      axios.post('api/create-history/' + houseCode).then(() => {
        console.log('added to history')
      })
    },
    // IF THERE IS NOTHING
    handleDismiss () {
      this.visible = false
      setTimeout(() => {
        this.visible = true
      }, 2000)
    },
    async loadHouses () {
      try {
        const response = await fetch('/api/histories-houses')
        const result = await response.json()
        this.histories = result
      } catch (error) {
        console.log(error)
      }
    },
    getResults (page = 1) {
      axios.get('/api/histories-houses/?page=' + page).then((response) => {
        this.histories = response.data
      })
    },
    deleteHistory (id) {
      // eslint-disable-next-line no-undef
      Fire.$emit('after-created')
      axios.post('/api/delete-history/' + id).then(() => {
        console.log('Deleted')
      })
    }
  }
}
</script>
