<template>
  <div>
    <sui-card class="rounded-radius shadow topCard p-4 w-100 position-absolute">
      <sui-card-content>
        <sui-card-header class="d-flex justify-content-between align-items-center h1 py-3">
          {{ $t('announce_form_price')}}
          <div>
              <a is="sui-label" color="green" tag v-if="house_details.state == 'available'">
                <span>{{ $t('view_house_details_stateUp') }}</span>
              </a>
              <a is="sui-label" color="grey" tag v-if="house_details.state == 'occupied'">
                <span>{{ $t('view_house_details_stateDown') }}</span>
              </a>
          </div>
          </sui-card-header>

        <sui-card-description>
          <p class="d-block h4">{{ house_details.price  | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })}}/{{
            house_details.payment_METHOD
          }}
          </p>
        </sui-card-description>
        <sui-divider section />
        <sui-card-header
          >{{ $t("view_house_details_contrat") }}
        </sui-card-header>
        <sui-card-description>
          <span class="d-block">
            {{ $t("view_house_details_type") }} {{ house_details.period }}
          </span>
          <span class="d-block">
            {{ $t("view_house_details_pay") }} {{ house_details.payment_METHOD }}
          </span>
        </sui-card-description>
        <sui-divider section />
        <sui-card-header
          >{{ $t("view_house_details_owner") }}
        </sui-card-header>
        <sui-card-description>
            <span class="d-block">
              <span v-if="user.name">{{ $t('view_house_details_name') }} {{ user.name }}</span>
              <del v-else>{{ $t("view_house_details_empty") }}</del>
            </span>
            <span class="d-block">
              <span v-if="user.city" class="text-capitalize">{{ $t('view_house_details_city') }} {{ user.city }}</span>
              <del v-else class="">{{ $t("view_house_details_empty") }}</del>
            </span>
            <span class="d-block">
              <span v-if="user.county">{{ $t('view_house_details_county') }} {{ user.county }}</span>
              <del v-else class="">{{ $t('view_house_details_county') }} {{ $t("view_house_details_empty") }}</del>
            </span>
        </sui-card-description>
        <sui-card-content extra class="mt-5">
          <sui-container text-align="center" v-if="user.role != 'owner'">

            <button
              class="btn btn-lg text-white bg-main"
              v-if="
                house_details.payment_METHOD == 'Monthly' ||
                house_details.payment_METHOD == 'Quarterly' ||
                house_details.payment_METHOD == 'Semiannual' ||
                house_details.payment_METHOD == 'Annual'"

              @click.prevent="schedule(house_details.house_code)"
            >
              {{ $t("view_house_schedule_visit") }}
            </button>
            <button
              class="btn btn-lg text-white bg-main"
              v-if="
                house_details.payment_METHOD == 'Daily' ||
                house_details.payment_METHOD == 'Weekly'"
              @click.prevent="scheduleStay()"
            >
              {{ $t("view_house_schedule_stay") }}
            </button>
          </sui-container>
          <sui-container text-align="center" v-else>

            <button class="btn btn-lg text-white bg-main">
              {{ $t("view_house_schedule_visit") }}
            </button>
          </sui-container>
        </sui-card-content>
      </sui-card-content>
    </sui-card>
  </div>
</template>
<script>

import { mapGetters } from "vuex";
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';
export default {
  props: ["house_details"],
  components: {DatePick},
  methods: {
    schedule(house_code) {
      this.$emit("emit-schedule", house_code);
    },
    scheduleStay(house_code) {
      this.$emit("emit-schedule-stay", house_code);
    },
  },
  computed: mapGetters({
    user: "auth/user",
    authenticated: "auth/check",
  }),
};
</script>
