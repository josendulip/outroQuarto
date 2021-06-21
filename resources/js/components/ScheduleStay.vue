<template>
  <div>
    <sui-card class="rounded-radius py-1 shadow w-100 bg-light topCard position-absolute">
      <sui-card-content>
        <card v-if="mustVerifyEmail" :title="$t('register')">
          <div class="alert alert-success" role="alert">say somenthig</div>
        </card>
        <form
          @submit.prevent="StoreAppointments()"
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
              <sui-form-field>
                <sui-checkbox radio v-model="form.house_code"  :value="house_details.house_code" />
              </sui-form-field>
              <button
                type="submit"
                class="btn btn-md badge-pill text-white bg-main"
                :loading="form.busy"
              >
                {{ $t("schedule_form_btn") }}
              </button>
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
                <has-error :form="form" field="name" class="text-white" />
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
                    />
                    <has-error :form="form" field="identity" class="text-white" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_residence") }}</label> -->
                    <input
                      v-model="form.address"
                      :class="{ 'is-invalid': form.errors.has('address') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_residence')"
                    />
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
                    />
                    <has-error :form="form" field="phone" class="text-white" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_email") }}</label> -->
                    <input
                      v-model="form.email"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_email')"
                    />
                    <has-error :form="form" field="email" class="text-white" />
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
                    <!-- <label class="ml-3">{{ $t("schedule_form_dateOfEntry") }}</label> -->
                    <datepicker
                      v-bind:language="'pt-br'"
                      v-bind:placeholder="$t('schedule_form_date')"
                      
                      v-bind:min="'2020-01-01'"
                      v-bind:max="'2030-12-31'"
                      v-bind:data-vv-as="'Please enter your visit date'"
                      v-model="form.date"
                      
                      name="event_date"
                      id="event_date"
                      class="rounded-pill"
                    ></datepicker>
                    <!-- v-bind:input-class="{
                        'datepicker-input-reg': true,
                        'is-invalid-input': errors.has('event_date'),
                      }"
                    v-bind:v-validate="{ required: true, date_format: 'YYYY-MM-DD' }"
                    <span
                      class="form-error"
                      :class="{ 'is-visible': errors.has('event_date') }"
                      >{{ errors.first("event_date") }}</span
                    > -->
                    <has-error :form="form" field="date" class="text-white" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_duration") }}</label> -->
                    <TimePicker
                      v-model="form.time"
                      :class="{ 'is-invalid': form.errors.has('time') }"
                      :required="true"
                      :disabled="false"
                      :placeholder="$t('schedule_form_time')"
                    ></TimePicker>
                    <has-error :form="form" field="time" class="text-white" />
                  </sui-form-field>
                </sui-form-fields>
              </sui-form-field>
            </sui-form>
          </sui-container>
          <hr />
          <sui-container>
            <sui-form equal-width>
              <sui-form-field>
                <sui-form-fields>
                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_payment") }}</label> -->
                    <select
                      class="ui dropdown rounded-pill text-muted"
                      v-model="form.payment"
                      :class="{ 'is-invalid': form.errors.has('payment') }"
                    >
                      <option disabled value="">{{ $t("schedule_form_payment") }}</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5+">5+</option>
                    </select>

                    <has-error :form="form" field="payment" class="text-white" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_service") }}</label> -->
                    <select
                      class="ui dropdown rounded-pill text-muted"
                      v-model="form.service"
                      :class="{ 'is-invalid': form.errors.has('service') }"
                    >
                      <option disabled value="">{{ $t("schedule_form_service") }}</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5+">5+</option>
                    </select>
                    <has-error :form="form" field="service" class="text-white" />
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
                    <!-- <label class="ml-3">{{ $t("schedule_form_card_number") }}</label> -->
                    <input
                      v-model="form.card_number"
                      :class="{ 'is-invalid': form.errors.has('card_number') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_card_number')"
                    />
                    <has-error :form="form" field="card_number" class="text-white" />
                  </sui-form-field>

                  <sui-form-field>
                    <!-- <label class="ml-3">{{ $t("schedule_form_validation") }}</label> -->
                    <input
                      v-model="form.validation"
                      :class="{ 'is-invalid': form.errors.has('validation') }"
                      class="rounded-pill"
                      :placeholder="$t('schedule_form_validation')"
                    />
                    <has-error :form="form" field="validation" class="text-white" />
                  </sui-form-field>
                </sui-form-fields>
              </sui-form-field>
            </sui-form>
          </sui-container>
          <div class="divider row"></div>
          <sui-container>
            <div class="field float-right">
              <sui-button type="submit" :loading="form.busy"  :disabled="form.busy">{{
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
import { mapGetters } from "vuex";
import Form from "vform";
import axios from "axios";
import Datepicker from "./TouchDatePicker.vue";
import TimePicker from "./TimePicker.vue";
import PickDate from "./PickDate.vue";
//import moment from "moment";
export default {
  middleware: "auth",
  props: ["house_details"],
  components: { Datepicker, TimePicker, PickDate },
  metaInfo() {
    return { title: this.$t("home") };
  },
  data: () => ({
    form: new Form({
      name: "",
      identity: "",
      house_code: "",
      address: "",
      phone: "",
      email: "",
      date: "",
      time: "",
      payment: "",
      service: "",
      card_number: "",
      validation: "",
    }),
    mustVerifyEmail: false,
  }),
  methods: {
    removeComponent(house_code) {
      this.$emit("emit-remove", house_code);
    },
    loadUser() {
      axios.get("/api/get-user").then(({ data }) => (this.form.fill(data)))
    },
    StoreAppointments()
    {
      this.form.post('/api/appointment').then(() => {
          Fire.$emit('AfterCreated'); // serve para atualizar a pagina dos usuarios 
          this.review = false
          this.$toastr.s(
              this.$t('appointment_message_suscceful_toastr')
          );
          this.form.reset()
          this.form.clear()
          //location.reload();
          console.log('Done');
      })
      .catch(error => {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('appointment_message_error_toastr') 
        );
        console.log(error);
      })
    }
  },
  computed: mapGetters({
    user: "auth/user",
    authenticated: "auth/check",
  }),
  mounted() {
    this.loadUser();
  },
};
</script>
