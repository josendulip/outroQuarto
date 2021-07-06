<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">{{ $t("schedulVisits") }}</h3>
      
      <sui-menu compact>
      <a is="sui-menu-item" size="tiny">
          <sui-icon name="bell outline" /> {{ $t('scheduled') }}
          <sui-label color="red" floating>
            {{ schedules }}
          </sui-label>
      </a>
      </sui-menu>
    </div>
  <div class="row justify-content-md-center">
  <div class="col-10">
    <div v-if="schedules.length == ''">
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
    <sui-table basic="very" v-else >
      <sui-table-header>
        <sui-table-row>
          <sui-table-header-cell>{{ $t('schedulLinked') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedule_form_address') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulCreatedAt') }}</sui-table-header-cell>
          <sui-table-header-cell class="text-center">{{ $t('userpanel_receipt') }}</sui-table-header-cell>
          <sui-table-header-cell>{{ $t('schedulStatus') }}</sui-table-header-cell>
        </sui-table-row>
      </sui-table-header>
      <sui-table-body>
        <sui-table-row v-for="schedul in mySchedules.data" :key="schedul.id">
          <sui-table-cell><a href="javascript:void(0)" @click.prevent="viewSchedul(schedul.id)">{{ schedul.house_code}}</a></sui-table-cell>
          <sui-table-cell>{{ schedul.house_street }}, {{ schedul.house_district }}, {{ schedul.house_county }}, {{ schedul.house_city }}</sui-table-cell>
          <sui-table-cell>{{ schedul.created_at | MultipleLocaleSupport}}</sui-table-cell>
          <sui-table-cell class="text-center"><a :href="'/' + schedul.receipt" target="_blank">Download <br><i class="file alternate outline icon"></i></a></sui-table-cell>
          <sui-table-cell>         
              <a v-if="schedul.status == 'pending'"><sui-icon name="circle" color="red"/> {{ $t('schedulStatus_pending') }} </a>
              <a v-else-if="schedul.status == 'resolved'"><sui-icon name="circle" color="blue"/>{{ $t('schedulStatus_resolved') }}  </a>
              <a v-else-if="schedul.status == 'confirmed'"><sui-icon name="circle" color="green"/> {{ $t('schedulStatus_confirm') }} </a>
              <a v-else><sui-icon name="circle" color="red"/> {{ $t('schedulStatus_pending') }} </a>
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
import Form from "vform";
import axios from "axios";
export default {
    name: 'user.schedules',
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
            axios.get("/api/my-schedules-user/?page=" + page).then((response) => {
                this.mySchedules = response.data;
            });
        },
        viewSchedul(schedul) {
        this.$router.push("my-schedule-message/" + schedul);
        },
        async loadschedules() {          
          try {
              const response = await fetch("/api/my-schedules-user");
              const result = await response.json();
              this.mySchedules = result;
              //console.log(this.myHouses);
          } catch (error) {
              console.log(error);
          } 
        },
        
        async countSchedules() {
        try {
            const response = await fetch("/api/user-count-schedules");
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