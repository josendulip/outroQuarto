<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
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
      <div class="col-10">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">An item</li>
          <li class="list-group-item">A second item</li>
          <li class="list-group-item">A third item</li>
          <li class="list-group-item">A fourth item</li>
          <li class="list-group-item">And a fifth one</li>
        </ul>
        <sui-table basic="very">
          <sui-table-header>
            <sui-table-row>
              <sui-table-header-cell>{{ $t('schedulStatus') }}</sui-table-header-cell>
              <sui-table-header-cell>{{ $t('schedulName') }}</sui-table-header-cell>
              <sui-table-header-cell>{{ $t('announce_form_type') }}</sui-table-header-cell>
              <sui-table-header-cell colspan="2">
                {{ $t('schedulLink') }}
              </sui-table-header-cell>
            </sui-table-row>
          </sui-table-header>
          <sui-table-body>
            <sui-table-row v-for="(history, index) in histories.data" :key="history.id">
              <sui-table-cell>{{ index }}</sui-table-cell>
              <sui-table-cell>{{ history.created_at | MultipleLocaleSupport }}</sui-table-cell>
              <sui-table-cell>{{ history.type }}</sui-table-cell>
              <sui-table-cell><a href="#">{{ history.house_code }}</a></sui-table-cell>
              <sui-table-cell class="text-center">
                <a href="javascript:void(0)" @click.prevent="deleteHistory(history.id)" color="red"><i class="window close icon" :title="$t('property_delete')" /></a>
              </sui-table-cell>
            </sui-table-row>
          </sui-table-body>
          <sui-table-footer>
            <sui-table-row>
              <sui-table-header-cell colspan="4">
                <pagination :data="histories" @pagination-change-page="getResults" />
              </sui-table-header-cell>
            </sui-table-row>
          </sui-table-footer>
        </sui-table>
      </div>
      <div class="col-md-8">
        <div class="d-flex justify-content-center">
          <transition name="fade">
            <sui-message
              v-if="visible"
              header="Sorry!"
              content="There is nothing yet in your history. Try to see some house"
              dismissable
              @dismiss="handleDismiss"
            />
          </transition>
          <p v-if="!visible">
            Message will come back in 2s
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
export default {
  name: 'user.histories',
  data () {
    return {
      histories: {},
      visible: true
    }
  },
  mounted () {
    this.loadHouses()
    Fire.$on('AfterCreated', () => {
      this.loadHouses()
    })
  },
  methods: {
    viewHouse (houseCode) {
      this.$router.push('view/' + houseCode)
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
      Fire.$emit('AfterCreated')
      axios.post('/api/delete-history/' + id).then(() => {
        console.log('Deleted')
      })
    }
  }
}
</script>
