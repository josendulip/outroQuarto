<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">{{ $t("schedulVisits") }}</h3>
      
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
    <div class="col-7" v-show="scheduling"> 
      <sui-card class="rounded-radius shadow w-100 bg-light topCard">
      <sui-card-content> 
        <sui-button class="mb-2"
          circular
          icon="arrow left"
          @click.prevent="removeComponent()"
        ></sui-button>   
        {{ status }} 
        <form
          @submit.prevent="reschedule()"
          method="POST"
          enctype="multipart/form-data"
          @keydown="form.onKeydown($event)"
        >
          <sui-container>
            <sui-form>
              <sui-form-field>
                    <datepicker
                      v-bind:language="'pt-br'"
                      v-bind:placeholder="$t('schedule_form_date')"                     
                      v-bind:min="'2020-01-01'"
                      v-bind:max="'2030-12-31'"
                      v-bind:data-vv-as="'Please enter your visit date'"
                      v-model="form.date"
                      name="event_date"
                      id="event_date"
                    ></datepicker>
                    <has-error :form="form" field="date" />
                  </sui-form-field>
              </sui-form>
          </sui-container>
            <sui-container text-align="justified" class="my-2">
              <sui-form>
                <sui-form-field>
                      <!-- <label class="ml-3">{{ $t("schedule_form_time") }}</label> -->
                      <!-- <TimePicker
                        v-model="form.time"
                        :class="{ 'is-invalid': form.errors.has('time') }"
                        :required="true"
                        :disabled="false"
                        :placeholder="$t('schedule_form_time')"
                      ></TimePicker> -->
                      <!-- https://github.com/phoenixwong/vue2-timepicker -->
                    <vue-timepicker v-model="form.time" format="H:mm:ss" input-width="100%" input-class="rounded-radius" :placeholder="$t('schedule_form_time')" drop-direction="down" :minute-interval="10" :second-interval="10" @input="inputHandler" close-on-complete></vue-timepicker>
                    <has-error :form="form" field="time" />
                </sui-form-field>
              </sui-form>
          </sui-container>
          <div class="divider row"></div>
          <sui-container>
            <div class="field float-right">
              <sui-button type="submit" :loading="form.busy" :disabled="form.busy">{{
                $t("schedule_form_btn")
              }}</sui-button>
            </div>
          </sui-container>
        </form>
      </sui-card-content>
      </sui-card>
    </div>
    <div class="col-7" v-show="message">
        <p>Caro(a) Propertário(a), </p>
        <p>O(A) Senhor(a) recebeu uma solicitação de visita do seu imóvel com ID: <a href="#" @click.prevent="viewHouse(schedule.house_code)">{{schedule.house_code}}</a> para <strong class="font-weight-bold">
          {{schedule.date | dddd}},
          {{schedule.date | LL}} 
          às {{schedule.time}}
          </strong>. 
          Pelo usuário {{schedule.username}}, tel: {{schedule.phone}}, email: {{schedule.email}}.</p>
        <p>Por favor confirme a visita ou remarque para uma data que seja mais conveniente.</p>
        <p>OutroQuarto agradece pela preferencia</p>      
        <hr>
        
        <div class="col-8 px-0">
          <div class="d-flex justify-content-between" v-if="schedule.status === 'resolved'">
            <sui-button size="mini" basic><sui-icon name="chevron down" color="blue"/> {{ $t('schedulStatus_resolved') }}</sui-button>
              <router-link class="ui basic button" :to="{ name: 'my-panel.schedules' }" basic> {{$t('schedulStatus_cancel_btn')}}</router-link>
          </div>
            <div class="d-flex justify-content-between" v-else>
              <sui-button size="mini" basic v-if="schedule.status === 'confirmed'"><sui-icon name="chevron down" color="green"/> {{ $t('schedulStatus_confirm') }}</sui-button>
              <sui-button size="mini" basic @click="confirmSchedul(schedule.id)" v-else><sui-icon name="chevron down" color="green" v-if="status"/> {{ $t('schedulStatus_confirm_btn') }}</sui-button>
              <sui-button size="mini" :content="$t('schedulStatus_schedul_btn')" basic @click="rescheduleShow()"/>
              <router-link class="ui basic button" :to="{ name: 'my-panel.schedules' }" basic> {{$t('schedulStatus_cancel_btn')}}</router-link>
            </div>
        </div>
    </div>
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
  name: 'my-panel.message',
  components: { Datepicker, TimePicker, PickDate, VueTimepicker },
  data(){
    return{
      form: new Form({
        date: "",
        time: "",
        status:"pending",
      }),
      status:"",
      schedule:{},
      countTheSchedules:null, 
      message: true,
      scheduling: false,
    }
  },
  methods:{
    inputHandler (eventData) {
      console.log(eventData)
    },
    async reschedule() {
      // reschedule.
      try {
        if(this.form.date == ""){
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_form_mgs_date'));
        }else if(this.form.time == ""){
           this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_form_mgs_time'));
        }else{
          const { data } = await this.form.post('/api/reschedule/' + this.schedule.id)
        
          Fire.$emit('AfterCreated');
          this.message = true; this.scheduling = false
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
    removeComponent(){this.message = true; this.scheduling = false},
    rescheduleShow(){
      this.message = false
      this.scheduling = true
    },
    viewHouse(house_code) {
      this.$router.push("/view/" + house_code);
    },
    confirmSchedul(id) {
      axios.post("/api/confirm-schedule/" + id)
      .then((data) => {   
        Fire.$emit('AfterCreated');     
        this.status = data.status;
        this.$toastr.defaultStyle = {"background-color": "#21ba45"};
        this.$toastr.s(this.$t('schedule_message_suscceful'));
      })
      .catch((error) => {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_message_error'));
        console.log(error);
      })
    },
    async loadSchedul() {
      try {
        const response = await fetch("/api/get-schedule/" + this.$route.params.id);
        const result = await response.json();
        this.schedule = result;
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
    this.loadSchedul();
    this.countSchedules();
    Fire.$on('AfterCreated', ()=>{ 
      this.loadSchedul();
      this.countSchedules();
    });
  }
}
</script>

<style lang="scss">
  .date-container {
    position: relative;
    display: inline;
  }
</style>