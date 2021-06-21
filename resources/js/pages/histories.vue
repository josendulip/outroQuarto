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
  <sui-table basic="very">
    <sui-table-header>
      <sui-table-row>
        <sui-table-header-cell>{{ $t('schedulName') }}</sui-table-header-cell>
        <sui-table-header-cell>{{ $t('schedulPhone') }}</sui-table-header-cell>
        <sui-table-header-cell>{{ $t('schedulEmail') }}</sui-table-header-cell>
        <sui-table-header-cell>{{ $t('schedulLink') }}</sui-table-header-cell>
        <sui-table-header-cell>{{ $t('schedulStatus') }}</sui-table-header-cell>
      </sui-table-row>
    </sui-table-header>
    <sui-table-body>
      <sui-table-row v-for="history in histories" :key="history.id">
        <sui-table-cell>{{ schedul.username }}</sui-table-cell>
        <sui-table-cell>{{ schedul.phone }}</sui-table-cell>
        <sui-table-cell>{{ schedul.email }}</sui-table-cell>
        <sui-table-cell><a href="#">{{ schedul.house_code }}</a></sui-table-cell>
        <sui-table-cell>          
          <sui-label v-if="schedul.status == 'pending'"> <sui-icon name="circle" color="blue" /> {{ $t('schedulStatus_active') }} </sui-label>
          <sui-label v-if="schedul.status == 'active'"> <sui-icon name="circle" color="red"/> {{ $t('schedulStatus_pending') }} </sui-label>
          <sui-label v-if="schedul.status == 'confimed'"> <sui-icon name="circle" color="green"/> {{ $t('schedulStatus_confirm') }} </sui-label>
          </sui-table-cell>
      </sui-table-row>
    </sui-table-body>
  </sui-table>
  </div>
    <div class="col-md-8">
    <div class="d-flex justify-content-center" v-if="histories.length <= 0">                 
        <transition name="fade">
        <sui-message
            v-if="visible"
            header="Welcome back!"
            content="This is a special notification which you can dismiss."
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
export default {
  name: 'user.histories',
  data(){
        return{
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
};
</script>