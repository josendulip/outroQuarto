<template>
  <div>
    <sui-card class="rounded-radius py-1 shadow w-100 bg-light topCard position-absolute">
      <sui-card-content>
        <card v-if="mustVerifyEmail" :title="$t('register')">
          <div class="alert alert-success" role="alert">say somenthig</div>
        </card>
        <form
          @submit.prevent="schedule()"
          method="POST"
          enctype="multipart/form-data"
          @keydown="form.onKeydown($event)"
        >
          <alert-success :form="form" :message="$t('info_updated')" />
          <sui-container>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <sui-button
                circular
                icon="arrow left"
                @click.prevent="removeComponent(house_details.house_code)"
              ></sui-button>
              
              <label class="btn btn-md badge-pill text-white bg-main radio">
                    <span
                    class="text-white"
                    @click="house_code = !house_code"
                     :class="{ 'is-invalid': form.errors.has('house_code') }"
                    >
                    <i class="home icon" v-if="!form.house_code"></i>
                    <i class="chevron down icon text-success" v-else></i>
                    <input
                      type="radio"
                      v-model="form.house_code"
                      :value="house_details.house_code"
                      :class="{ 'is-invalid': form.errors.has('house_code') }"
                      class="d-none"
                    />{{ $t('schedule_form_houseId') }}
                    <has-error :form="form" field="house_code"/>
                    </span>
              </label>

              <!-- <sui-button
                class="btn btn-md badge-pill text-white bg-main"
                @click="house_code = !house_code"
              >
                {{ $t("schedule_form_btn") }}
              </sui-button> -->
            </div>
          </sui-container>

          <sui-container text-align="justified" class="my-2">
            <sui-form>
              <sui-form-field>
                <!-- <label class="ml-3">{{ $t("schedule_form_name") }}</label> -->
                <input
                  v-model="form.name"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                  class="rounded-pill"
                  :placeholder="$t('schedule_form_name')"
                  
                />
                <has-error :form="form" field="name" />
              </sui-form-field>
            </sui-form>
          </sui-container>
          <sui-container>
            <sui-form equal-width>
              <sui-form-field>
                <sui-form-fields>
                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_identity") }}</label> -->
                    <input
                      v-model="form.identity"
                      :class="{ 'is-invalid': form.errors.has('identity') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_identity')"
                      readonly
                    />
                    <has-error :form="form" field="identity" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_address") }}</label> -->
                    <input
                      v-model="form.address"
                      :class="{ 'is-invalid': form.errors.has('address') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_address')"
                      readonly
                    />
                    <has-error :form="form" field="address" />
                  </sui-form-field>
                </sui-form-fields>
              </sui-form-field>
            </sui-form>
          </sui-container>
          <sui-container>
            <sui-form equal-width>
              <sui-form-field>
                <sui-form-fields>
                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_phone") }}</label> -->
                    <input
                      v-model="form.phone"
                      :class="{ 'is-invalid': form.errors.has('phone') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_phone')"
                      readonly
                    />
                    <has-error :form="form" field="phone" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_email") }}</label> -->
                    <input
                      v-model="form.email"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_email')"
                      readonly
                    />
                    <has-error :form="form" field="email" />
                  </sui-form-field>
                </sui-form-fields>
              </sui-form-field>
            </sui-form>
          </sui-container>
          <sui-container>
            <sui-form equal-width>
              <sui-form-field>
                <sui-form-fields>
                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_date") }}</label> -->
                    <!--  <input
                          v-model="form.date"
                          :class="{ 'is-invalid': form.errors.has('date') }"
                          class="rounded-pill" :placeholder="$t('schedule_form_date')"
                        /> -->
                    <!-- <date-pick v-model="form.date"  class="rounded-pill "></date-pick> 
                    
                     v-bind:input-class="{
                        'datepicker-input-reg': true,
                        'is-invalid-input': errors.has('event_date'),
                      }"
                       v-bind:v-validate="{ required: true, date_format: 'YYYY-MM-DD' }"-->
                    <datepicker
                      v-bind:language="'pt-br'"
                      v-bind:placeholder="$t('schedule_form_date')"
                     
                      v-bind:min="'2020-01-01'"
                      v-bind:max="'2030-12-31'"
                      v-bind:data-vv-as="'Please enter your visit date'"
                      v-model="schedul.date"
                     
                     
                      name="event_date"
                      id="event_date"
                      class="rounded-pill"
                    ></datepicker>
                    <!-- <span
                      class="form-error"
                      :class="{ 'is-visible': errors.has('event_date') }"
                      >{{ errors.first("event_date") }}</span
                    > -->
                    <!-- <PickDate v-model="form.date"></PickDate> -->
                    <has-error :form="form" field="date" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_time") }}</label> -->
                    <TimePicker
                      v-model="schedul.time"
                      :class="{ 'is-invalid': schedul.errors.has('time') }"
                      :required="true"
                      :disabled="false"
                      :placeholder="$t('schedule_form_time')"
                    ></TimePicker>
                    <!-- <input
                          v-model="form.time"
                          :class="{ 'is-invalid': form.errors.has('time') }"
                          class="rounded-pill" :placeholder="$t('schedule_form_time')"
                        /> -->
                    <has-error :form="form" field="time" />
                  </sui-form-field>
                </sui-form-fields>
              </sui-form-field>
            </sui-form>
          </sui-container>
          <hr />
          <sui-container class="mb-2">
            <sui-tab :menu="{ text: true }">
              <sui-tab-pane  icon="users" title="Account" :attached="false">
                Account Nº.
              </sui-tab-pane>
              <sui-tab-pane  icon="linkify" title="IBAN" :attached="false">
                IBAN
              </sui-tab-pane>
              <sui-tab-pane  icon="file alternate outline" title="Send attach" :attached="false">
                <span v-if="fileName.split('.')[1] === 'pdf'">{{fileName}}</span>
                    <sui-image v-else
                          :src="filepreview" 
                          class="img-thumbnail w-100 h-100" fluid
                          v-show="filepreview"
                        />
                        {{  }}
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" 
                          @change="fileSelected" id="receipt_promo" aria-describedby="receipt_promo">
                        <label class="custom-file-label" for="receipt_promo">{{ $t('mypanel_verif_upload_file') }}</label>
                      </div>
                    </div>
              </sui-tab-pane>
            </sui-tab>
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
</template>
<script>
import Form from "vform";
import axios from "axios";
/* import DatePick from 'vue-date-pick'; */
/* import Timeselector from 'vue-timeselector'; */
import Datepicker from "./TouchDatePicker.vue";
import TimePicker from "./TimePicker.vue";
import PickDate from "./PickDate.vue";
//import moment from "moment";
//import Index from '../pages/my-panel/index.vue';
export default {
  props: ["house_details"],
  components: { Datepicker, TimePicker, PickDate },
    IndextaInfo() {
    return { title: this.$t("home") };
  },
  data: () => ({
    form: new Form({
      id: "",
      name: "",
      identity: "",
      phone: "",
      email: "",
      address: "",
      house_code: "",
     /*  house_city: "",
      house_county: "",
      house_district: "",
      house_street: "",
      price:"",
      date: "",
      time: "",
      receipt: "",
      request_type: "Schedule Visit", */
    }),    
    schedul: new Form({
      price: 200,
      date: "",
      time: "",
      receipt: "",
      request_type: "Schedule Visit",
    }),
    house_code: false,
    mustVerifyEmail: false,
    filepreview:"",
    fileName:"",
  }),
  methods: {
    removeComponent(house_code) {
      this.$emit("emit-remove", house_code);
    },
    loadUser() {
      axios.get("/api/get-user").then(({ data }) => this.form.fill(data));
    },
    
    //SCHEDULE VISIT
    fileSelected(e) {
      
      this.schedul.receipt = e.target.files[0];
        if( this.schedul.receipt ){
        if ( /\.(jpe?g|png|gif|pdf)$/i.test( this.schedul.receipt.name ) ) {
             if (this.schedul.receipt.size > 4096 * 4096) {
                e.preventDefault();
                alert('File too big (> 16MB)');
                return;
              }else{
                let reader = new FileReader();
                reader.readAsDataURL(this.schedul.receipt);
                reader.onload = (e) => {
                  this.filepreview = e.target.result;
                  this.fileName=this.schedul.receipt.name;
                }
            };
        }else{
          alert('incompatible format');
          this.$refs.inputFile.values=null;
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_form_msg_photo_type'));

        }
      }
    },
    schedule() {
      let formData = new FormData();
      formData.append("user_id", this.form.id);
      formData.append("username", this.form.name);
      formData.append("phone", this.form.phone);
      formData.append("email", this.form.email);
      formData.append("address", this.form.address);
      formData.append("house_code", this.form.house_code);
      formData.append("house_city", this.house_details.city);
      formData.append("house_county", this.house_details.county);
      formData.append("house_district", this.house_details.district);
      formData.append("house_street", this.house_details.street);
      formData.append("price", this.schedul.price);
      formData.append("date", this.schedul.date);
      formData.append("time", this.schedul.time);
      formData.append("receipt", this.schedul.receipt);
      formData.append("request_type", this.schedul.request_type);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else if (this.form.house_code == "" || this.form.house_code == undefined) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_form_mgs_houdeID'));
      }
      else if (this.form.phone == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_form_mgs_phone'));
      }else if (this.form.name == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t("schedule_form_mgs_name"));
      }else if (this.schedul.date == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_form_mgs_date'));
      }else if (this.schedul.time == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_form_mgs_time'));
      }else if (this.schedul.receipt == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('schedule_form_mgs_recept'));
      }else {
          this.schedul.busy = true
        axios
          .post("/api/send-request-to-visit", formData)
          .then(() => {
            this.schedul.reset();
            this.schedul.clear();
             this.fileName = ""; this.filepreview = "";
            this.$toastr.defaultStyle = { "background-color": "#21ba45" };
            this.$toastr.s(this.$t("schedule_form_suscceful_toastr"));
            //this.$router.push({ name: "my-panel.properties" });
          })
          .catch(() => {});
      }
    },

  },
  mounted() {
    this.loadUser();
  },
};
</script>
<style lang="scss">
.rounded-radius {
  border-radius: 2em !important;
}
.vdpArrowPrev:after {
  border-right-color: #ff5859;
}

.vdpArrowNext:after {
  border-left-color: #ff5859;
}

.vdpCell.selectable:hover .vdpCellContent,
.vdpCell.selected .vdpCellContent {
  background: #ff5859;
}

.vdpCell.today {
  color: #ff5859;
}

.vdpTimeUnit > input:hover,
.vdpTimeUnit > input:focus {
  border-bottom-color: #ff5859;
}
.vdpComponent {
  border-radius: 2em !important;
}
label.radio {
  cursor: pointer;
}

label.radio input {
  position: absolute;
  top: 0;
  left: 0;
  visibility: hidden;
  pointer-events: none;
}

label.radio span {
  /* padding: 3px 9px; */
  /* border: 1px solid #dc3545; */
  display: inline-block;
  color: #dc3545;
  /* border-radius: 5px; */
  /* font-size: 11px; */
  text-transform: uppercase;
}

label.radio input:checked + span {
  border-color: #dc3545;
  background-color: #dc3545;
  color: #fff;
}
</style>
