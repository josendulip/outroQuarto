<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">{{ $t("schedulVisits") }}</h3>
      {{ $route.params.id }}
     <sui-menu compact>
      <router-link  is="sui-menu-item" :to="{ name: 'my-panel.scheduling' }" size="tiny">
          <sui-icon name="bell outline" /> {{ $t('scheduled') }}
          <sui-label color="red" floating>
            {{ countTheSchedules }}
          </sui-label>
      </router-link>
      </sui-menu>
    </div>
  <div class="row justify-content-md-center">
      <div class="col-8">

        <sui-segment piled>
            <sui-segment inverted circular style="width:132px; height:132px;">
                <sui-header inverted class="text-capitalize">
                    {{ mySchedule.status }}
                    <sui-header sub>{{mySchedule.price   | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true })}}</sui-header>
                </sui-header>
            </sui-segment> 
            <div class="text-center">
                <p class=""><strong>{{ $t('myadmin_schedul_view_item1') }}</strong> <br><a href="">{{ mySchedule.username }}</a></p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item2') }}</strong> <br> {{ mySchedule.address }}</p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item3') }}</strong> <br>{{ mySchedule.phone }} / <a href="">{{ mySchedule.email }}</a> </p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item4') }}</strong> <br>{{ mySchedule.date }} - {{ mySchedule.time}}</p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item5') }}</strong> <br><a :href="'/' + mySchedule.receipt" target="_blank">{{ mySchedule.receipt }}</a></p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item6') }}</strong> <br>{{ mySchedule.house_county }} - {{ mySchedule.house_city }}</p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item7') }}</strong> <br><a href="javascript:void(0)" @click="viewHouse(mySchedule.house_code)">{{ mySchedule.house_code }}</a></p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item8') }}</strong> <br>{{ mySchedule.house_county }}</p>
                <p class=""><strong>{{ $t('myadmin_schedul_view_item9') }}</strong> <br>{{ mySchedule.created_at | MultipleLocaleSupport}}</p>

                <sui-button :content="$t('myadmin_schedul_view_item10')" v-if="mySchedule.status == 'Not approved'" basic @click="approveSchedule(mySchedule.id)"/>
                <sui-button :content="$t('myadmin_schedul_view_item11')" v-else color="green"  basic @click="desapproveSchedule(mySchedule.id)"/>
            </div>
            
        </sui-segment>
          <!-- <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ mySchedule.username }}</h4>
              <p class="card-text">{{ mySchedule.address }}</p>
            </div>
          </div> -->
      </div>
  <!-- <div class="col-8" v-for="(mySchedule, index) in mySchedules.data" :key="mySchedule.id">
        <p>Caro(a) Propertário(a), </p>
        <p>O(A) Senhor(a) recebeu uma solicitação de visita do seu imóvel com ID: <a href="#" @click.prevent="viewHouse(mySchedule.house_code)">{{mySchedule.house_code}}</a> para <strong class="font-weight-bold">
          {{mySchedule.date | dddd}},
          {{mySchedule.date | LL}} 
          às {{mySchedule.time}}
          </strong>. 
          Pelo usuário {{mySchedule.username}}, tel: {{mySchedule.phone}}, email: {{mySchedule.email}}.</p>
        <p>Por favor confirme a visita ou remarque para uma data que seja mais conveniente.</p>
        <p>OutroQuarto agradece pela preferencia</p>          
        <div class="col-8 px-0">
          <div class="" v-if="mySchedule.status === 'resolved'">
            <sui-button size="mini" basic><sui-icon name="chevron down" color="blue"/> {{ $t('schedulStatus_resolved') }}</sui-button>
          </div>
          <div class="" v-else>
            <sui-button size="mini" basic v-if="mySchedule.status === 'confirmed'"><sui-icon name="chevron down" color="green"/> {{ $t('schedulStatus_confirm') }}</sui-button>
            <sui-button size="mini" basic @click="confirmSchedul(mySchedule.id)" v-else>{{mySchedule.id}} <sui-icon name="chevron down" color="green" v-if="status"/>  {{ $t('schedulStatus_confirm_btn')   }}</sui-button>
            <sui-button size="mini" :content="$t('schedulStatus_schedul_btn')" basic @click="rescheduleShow  =index"/>
          </div>            
          <div class="" v-show="rescheduleShow == index"> 
            <sui-card class="rounded-radius shadow w-100 bg-light topCard">
            <sui-card-content> 
              <div class="field float-right">
                <sui-icon name="close" link @click.prevent="rescheduleShow = -1"/>
              </div>
                <sui-container>
                  <sui-form equal-width>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field>
                          <datepicker
                          class="rounded-radius-without"
                            v-bind:language="'pt-br'"
                            v-bind:placeholder="$t('schedule_form_date')"                     
                            v-bind:min="'2021-01-01'"
                            v-bind:max="'2030-12-31'"
                            v-bind:data-vv-as="'Please enter your visit date'"
                            v-model="form.date"
                            name="event_date"
                            id="event_date"
                          ></datepicker>
                          <has-error :form="form" field="date" />
                      </sui-form-field> 
                        <sui-form-field>
                          <vue-timepicker v-model="form.time" format="H:mm:ss" input-width="100%" input-class="pading" :placeholder="$t('schedule_form_time')" drop-direction="down" :minute-interval="10" :second-interval="10" close-on-complete></vue-timepicker>
                          <has-error :form="form" field="time" />
                      </sui-form-field> 
                      <sui-form-field>
                          <sui-button type="submit" :loading="form.busy" :disabled="form.busy" @click.prevent="reschedule(mySchedule.id)">{{
                            $t("schedule_form_btn")
                          }}</sui-button>
                      </sui-form-field>
                    </sui-form-fields>
                  </sui-form-field>
                </sui-form>
                </sui-container>
            </sui-card-content>
                <div class="card-footer">
                    <pagination :data="mySchedules" @pagination-change-page="getResults"></pagination>
                </div>
            </sui-card>
          </div>
        </div>   
        <hr> 
  </div> -->
  </div>
  </div>
</template>
<script>
import axios from 'axios'
import Datepicker from "../../components/TouchDatePicker.vue";
import TimePicker from "../../components/TimePicker.vue";
import PickDate from "../../components/PickDate.vue";
import Form from 'vform';
// Manually point to the `/src` folder
import VueTimepicker from 'vue2-timepicker/src'
export default {
  name: 'my-panel.scheduling',
  components: { Datepicker, TimePicker, PickDate, VueTimepicker },
  data(){
    return{
      form: new Form({
        date: "",
        time: "",
        status:"pending",
      }),
      mySchedule:{},
      countTheSchedules: 0,
      scheduling: false,
      status: "",
      rescheduleShow: -1,
    }
  },
  methods:{
    getResults(page = 1) {
      axios.get("api/my-schedules/?page=" + page).then((response) => {
        this.mySchedules = response.data;
      });
    },
    removeComponent(){this.scheduling = false},
    //RESCHEDULED
    async reschedule(id) {
      // reschedule.
      try {
        if(this.form.date == ""){
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_form_mgs_date'));
        }else if(this.form.time == ""){
           this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_form_mgs_time'));
        }else{
          const { data } = await this.form.post('/api/reschedule/' + id)
        
          Fire.$emit('AfterCreated');
          this.rescheduleShow = -1,
          this.$toastr.defaultStyle = {"background-color": "#21ba45"};
          this.$toastr.s(
              this.$t('schedule_msg_reschedul_success') 
          );
          this.status = data.status
        }
      } catch (error) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_msg_reschedul_error'));
        console.log(error);
      }
    },
    viewHouse(house_code) {
      this.$router.push("/view/" + house_code);
    },
    async approveSchedule(id) {
      try {
          const { data } = await this.form.post('/api/approve-schedule/' + id)
          Fire.$emit('AfterCreated');     
          this.status = data.status;
          this.$toastr.defaultStyle = {"background-color": "#21ba45"};
          this.$toastr.s(this.$t('schedule_message_suscceful'));
          } 
      catch (error) {
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_message_error'));
          console.log(error);          
      }
    },
    async desapproveSchedule(id){
      try {
          const { data } = await this.form.post('/api/desapprove-schedule/' + id)
          Fire.$emit('AfterCreated');     
          this.status = data.status;
          this.$toastr.defaultStyle = {"background-color": "#21ba45"};
          this.$toastr.s(this.$t('schedule_message_suscceful'));
          } 
      catch (error) {
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_message_error'));
          console.log(error);
          
      }
        
    },
    ///COM PAGINATE NAO ESTA A FUNCIONAR 
    async loadSchedule() {
      try {
        const response = await fetch("/api/view-schedule-payment/" + this.$route.params.id);
        const result = await response.json();
        this.mySchedule = result;
        //console.log(this.myHouses);
      } catch (error) {
        console.log(error);
      }
    },
    
    async countSchedules() {
      try {
        const response = await fetch("/api/count-schedules");
        const result = await response.json();
        this.countTheSchedules = result;
        //console.log(this.myHouses);
      } catch (error) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('view_rating_message_error_toastr'));
        console.log(error);
      }
    },
  },
  mounted(){
    this.loadSchedule();
    this.countSchedules();    
    Fire.$on('AfterCreated', ()=>{ 
      //this.loadschedules();
      this.loadSchedule();
    });
  }
}
</script>
<style lang="scss">
  .rounded-radius-without {
    border-radius: 0em !important;
  }
  .pading{
    padding: .67857143em 1em!important;
    line-height: 1.21428571em!important;
    padding: .67857143em 1em!important;
  }
</style>