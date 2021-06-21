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
    <div v-if="schedules === 0">
      <transition name="fade">
        <sui-message
          v-if="visible"
          header="Welcome back!"
          content="This is a special notification which you can dismiss."
          dismissable
          @dismiss="handleDismiss"
        >Infelizmente</sui-message>
      </transition>
      <p v-if="!visible"> Message will come back in 2s</p>
    </div>
    <sui-table basic="very" v-else>
      <sui-table-header>
        <sui-table-row>
          <sui-table-header-cell>{{ $t('schedulName') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulPhone') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulEmail') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulCreatedAt') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulLink') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulStatus') }}</sui-table-header-cell>
        </sui-table-row>
      </sui-table-header>
      <sui-table-body>
        <sui-table-row v-for="schedul in mySchedules.data" :key="schedul.id">
          <sui-table-cell>{{ schedul.username }}</sui-table-cell>
          <sui-table-cell>{{ schedul.phone }}</sui-table-cell>
          <sui-table-cell>{{ schedul.email }}</sui-table-cell>
          <sui-table-cell>{{ schedul.created_at | MultipleLocaleSupport}}</sui-table-cell>
          <sui-table-cell><a href="javascript:void(0)" @click.prevent="viewSchedul(schedul.id)">{{ schedul.house_code}}</a></sui-table-cell>
          <sui-table-cell>         
              <a is="sui-label" basic pointing="left" v-if="schedul.status == 'pending'"><sui-icon name="circle" color="red"/> {{ $t('schedulStatus_pending') }} </a>
              <a is="sui-label" basic pointing="left" v-if="schedul.status == 'resolved'"><sui-icon name="circle" color="blue"/>{{ $t('schedulStatus_resolved') }}  </a>
              <a is="sui-label" basic pointing="left" v-if="schedul.status == 'confirmed'"><sui-icon name="circle" color="green"/> {{ $t('schedulStatus_confirm') }} </a>
          </sui-table-cell>
        </sui-table-row>
      </sui-table-body>

      <sui-table-footer>
        <sui-table-row>
          <sui-table-header-cell colspan="5">
            <pagination :data="mySchedules" @pagination-change-page="getResults"></pagination>
          </sui-table-header-cell>
        </sui-table-row>
      </sui-table-footer>
    </sui-table>
  </div>
  </div>
  </div>
</template>
<script>
export default {
  name: 'my-panel.schedules',
  data(){
    return{
      mySchedules:{},
      schedules: 0,
      visible: false,
    }
  },
  methods:{
    handleDismiss() {
      this.visible = false;
      setTimeout(() => {
        this.visible = true;
      }, 2000);
    },
    getResults(page = 1) {
      axios.get("api/my-schedules/?page=" + page).then((response) => {
        this.mySchedules = response.data;
      });
    },
    viewSchedul(schedul) {
      /* axios.post('api/save-views/' + house_code)
        .then(()=>{ 
            Fire.$emit('AfterCreated'); // serve para atualizar a pagina dos usuarios 
            this.review = false
            this.$toastr.s(
                this.$t('view_rating_message_suscceful_toastr') 
            );
            this.form.reset()
            this.form.clear()
          }) */ 
      this.$router.push("view-schedule-message/" + schedul);
    },
    async loadschedules() {
      try {
        const response = await fetch("api/my-schedules");
        const result = await response.json();
        this.mySchedules = result;
        //console.log(this.myHouses);
      } catch (error) {
        console.log(error);
      }
    },
    
    async countSchedules() {
      try {
        const response = await fetch("api/count-schedules");
        const result = await response.json();
        this.schedules = result;
        //console.log(this.myHouses);
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted(){
    this.loadschedules();
    this.countSchedules();
  }
}
</script>