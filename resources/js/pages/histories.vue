<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">{{ $t("schedulVisits") }}</h3>
      
      <sui-menu compact>
      <router-link  is="sui-menu-item" :to="{ name: 'my-panel.scheduling' }" size="tiny">
          <sui-icon name="bell outline" /> {{ $t('scheduled') }}
          <sui-label color="red" floating>
            {{ schedules }}
          </sui-label>
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
  name: 'my-panel.schedules',
  data(){
        return{
            histories: {},
            visible: true 
        }
    }, 
    methods:{
        viewHouse(house_code)
        {
            this.$router.push('view/' + house_code)
            axios.post('api/create-history/' + house_code).then(() => {
                console.log("added to history")
            })
        },
        //IF THERE IS NOTHING 
        handleDismiss() {
            this.visible = false;
            setTimeout(() => {
                this.visible = true;
            }, 2000);
        },
        async loadHouses() {
            try {
                const response = await fetch('api/favourites-houses')
                const result = await response.json()
                this.favourites = result
            }catch (error){
                console.log(error)
            }             
        },
    },
    mounted(){
        this.loadHouses();
    }
};
</script>