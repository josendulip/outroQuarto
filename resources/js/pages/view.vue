<template>
  <div>
    <div v-if="photos.length <=0" class="jumbotron jumbotron-fluid" :style="{'background': 'url(/'+house.profile+')', 'background-size': 'cover', 'background-position':'center center', 'background-repeat':'no-repeat'}">
      <div class="container" style="background: rgba(0,0,0, 0.5)">
        <div class="row">
          <div class="col-md-8 p-3">
            <p class="d-flex justify-content-between align-items-center h1 text-white text-uppercase">
              <span>{{ $t('view_house_details_desc') }}</span>
            </p>
            <p class="lead text-white">
              <span v-if="!readMore" v-html="house.description.slice(0, 150)" />
              <span v-if="readMore" v-html="house.description" />
              <a href="#" @click.prevent="readMore = ! readMore">
                <span v-if="!readMore" class=" text-truncate">{{ $t('view_house_details_readM') }}</span> <span v-if="readMore">{{ $t('view_house_details_readL') }}</span> 
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- eslint-disable-next-line vue/attribute-hyphenation -->
    <hooper v-if="photos.length != 0" :infiniteScroll="true" :itemsToShow="3" :progress="true" :autoPlay="true" :playSpeed="2000">
      <slide v-for="(image, index) in photos" :key="index">
        <img :src="image.src" class="img-fluid d-block" :alt="image.caption" style="height: 350px; width:700px; object-fit:cover;" @click="openGallery(index)">
      </slide>
      <hooper-pagination slot="hooper-addons" mode="fraction" />
    </hooper>
    <div class="container ">
      <div class="row">
        <div class="col-md-8 my-4">
          <div class="mb-3">
            <button class="btn btn-lg text-white bg-main mr-2" @click.prevent="seePhoto =! seePhoto">
              <i class="image icon" /> {{ $t('view_photos_btn') }}
            </button>
            <button class="btn btn-lg text-white bg-main mr-2">
              <i class="map outline icon" />{{ $t('view_maps_btn') }}
            </button>
            <sui-button basic color="red" @click="favourite($route.params.house_code)">
              <i class="heart icon" />{{ $t('view_favourite_btn') }}
            </sui-button>
            <label for="houseCode" @click="review =! review">
              <div class="ui labeled button" tabindex="0">
                <div class="ui basic red button">
                  <i v-if="form.user_id === user.id" class="star icon" />
                  <i v-else class="star outline icon" />{{ $t('view_ratings_btn') }}
                </div>
                <a class="ui basic left pointing red label">
                  ({{ stars | number('0.0') }})
                </a>
              </div>
            </label>
            <sui-button basic color="red" @click="shareMedia =! shareMedia">
              <i class="share alternate icon" /> {{ $t('view_share_btn') }}
            </sui-button>
          </div>
          <transition name="fade" mode="out-in">
            <div v-if="review" class="review">
              <h4 v-if="user.id === house.user_id" class="belongsTo">
                {{ $t('view_rating_message_error') }}
              </h4>
              <span v-else class="belongsTo">
              <form @submit.prevent="form.mode == 'true' ? updateReview() : storeReview()" class="border border-danger p-3" @keydown="form.onKeydown($event)">
                  <div class="form-group d-flex justify-content-between align-items-center">
                      <div class="rate">
                          <StarRating
                              v-model="form.rating"
                              :increment="0.5"
                              :star-size="20"
                              :border-width="4"
                              border-color="#d8d8d8"
                              :rounded-corners="true"
                              :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"
                              :inline="true">
                          </StarRating>
                          <label class="text-lowercase">{{ $t('view_rating_house') }}</label>
                          <input id="houseCode" type="radio" v-model="form.house_code" :value="$route.params.house_code">
                      </div>
                      <sui-button basic v-show="form.mode == 'true'"  color="blue" :disabled="form.busy">{{ $t('view_rating_btn') }}</sui-button>
                      <sui-button basic v-show="form.mode !== 'true'" color="red" :disabled="form.busy">{{ $t('view_rating_btn') }}</sui-button>
                  </div>
                  <div class="form-group">
                        <label for="description">{{ $t('view_your_opinion') }}</label>
                      <textarea v-model="form.description" id="description" class="form-control" rows="2"></textarea>
                  </div>
              </form>
              </span>
            </div>
          </transition>
          <transition name="fade" mode="out-in">
          <ul
          v-if="seePhoto"
          style="margin: 0; padding: 0"
          >
              <li
              v-for="(image, index) in photos"
              :key="index"
              style="display: inline-block; margin: 0 5px 5px 0"
              >
              <img
                  :src="image.src"
                  style="height: 100px; cursor: pointer"
                  @click="openGallery(index)"
              >
              </li>
              <li v-if="photos.length <=0"><h4 class="text-danger">{{ $t('view_house_no_photos') }}!</h4></li>
          </ul>
          </transition>
          <transition>
            <div v-if="shareMedia" class="d-inline">
              <sharenetwork :house-details="house" />
            </div>
          </transition>
          <hr>
          <ul class="nav">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#"><i class="map marker alternate icon"></i> {{ house.city }}, {{ house.county }}</a>
              </li>
              <li class="nav-item">
                  <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="expand icon"></i>  {{ $t("annou_form_land") }}</a>
                  <a v-else class="nav-link" href="#"><i class="home icon"></i> {{ house.type }}</a>
              </li>
              <li class="nav-item">
                  <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="text height icon"></i> {{ house.width }} {{ $t("announce_form_widthW") }}</a>
                  <a v-else class="nav-link" href="#"><i class="tv icon"></i> {{ house.living_room }} {{ $t("announce_form_living_room") }}</a>
              </li>
              <li class="nav-item">
                  <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="text width icon"></i> {{ house.length }} {{ $t("announce_form_lengthL") }}</a>
                  <a v-else class="nav-link" href="#"><i class="bed icon"></i> {{ house.room }} {{ $t("announce_form_room") }}</a>
              </li>
              <li class="nav-item">
                  <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="square full icon"></i> {{ house.area }} {{ $t("announce_form_areaA") }}</a>
                  <a v-else class="nav-link" href="#"><i class="bath icon"></i> {{ house.bathroom }} {{ $t("announce_form_bathroom") }}</a>
              </li>
              <li class="nav-item">
                  <a v-if="house.type != 'Land'" class="nav-link" href="#"><i class="box icon"></i> {{ $t("announce_form_furniture") }} (<em>{{ house.furniture }}</em>)</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="object group outline icon"></i> {{ $t("announce_form_garden") }} (<em>{{ house.garden }}</em>)</a>
              </li>
          </ul>
          <h5>{{ $t('view_house_details_desc') }}</h5>
          <p class="lead" v-html="house.description" />
          <hr>
          <sui-comment-group v-for="review in reviews" :key="review.id" minimal>
            <span v-if="review.house_code === house.house_code">
              <span v-if="review.description">
                <sui-comment>
                  <sui-comment-avatar src="/images/profile/user-default.png" />
                  <sui-comment-content>
                    <a is="sui-comment-author">
                      {{ review.user_name }}
                    </a>
                    <sui-comment-metadata>
                      <div>{{ review.created_at | ExtensoFormato }}</div>
                    </sui-comment-metadata>
                    <sui-comment-text>{{ review.description }}</sui-comment-text>
                    <sui-comment-actions>
                      <sui-comment-action>Reply</sui-comment-action>
                    </sui-comment-actions>
                  </sui-comment-content>
                </sui-comment>
              </span>
            </span>
          </sui-comment-group>
        </div>
        <div class="col-md-4 mt-lg-n5">
            <!-- House Information -->
            <sui-card v-if="house_details" class="rounded-radius shadow topCard p-4 w-100 position-absolute">
            <sui-card-content>
                <sui-card-header class="d-flex justify-content-between align-items-center h1 py-3">
                {{ $t('announce_form_price')}}
                <div>
                    <a is="sui-label" color="green" v-if="house.state == 'available'" tag>
                        <span>{{ $t('view_house_details_stateUp') }}</span>
                    </a>
                    <a is="sui-label" color="grey" v-if="house.state == 'occupied'" tag>
                        <span>{{ $t('view_house_details_stateDown') }}</span>
                    </a>
                </div>
                </sui-card-header>

                <sui-card-description>
                <p class="d-block h4">
                  {{ house.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true }) }}
                </p>
                </sui-card-description>
                <sui-divider section />
                <sui-card-header
                >{{ $t("view_house_details_contrat") }}
                </sui-card-header>
                <sui-card-description>
                  <span v-if="house.payment_METHOD == 'Installment'" class="d-block">
                      {{ $t("view_house_details_pay") }} <span class="text-lowercase font-weight-bold">{{ $t('annou_form_payment_installment') }}</span>
                  </span>
                  <span class="d-block">
                      {{ $t("announce_form_vititfee") }} {{ house.tax_visit | currency("AKZ", 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
                  </span>
                </sui-card-description>
                <sui-divider section />
                <sui-card-header
                >{{ $t("view_house_details_owner") }}
                </sui-card-header>
                <sui-card-description>
                    <ul>
                        <li>
                            <span v-if="house.username">{{ $t('view_house_details_name') }}{{ house.username }}</span>
                            <del v-else>{{ $t("view_house_details_empty") }}</del>
                        </li>
                        <li>
                            <span v-if="house.city" class="text-capitalize">{{ $t('view_house_details_city') }}{{ house.city }}</span>
                            <del v-else class="">{{ $t("view_house_details_empty") }}</del>
                        </li>
                        <li>
                            <span v-if="house.phone">
                                <span v-if="user.authorization == 'authorized'">{{ house.phone }}</span>
                                <span v-else>
                                    {{ $t('view_house_details_phone') }}
                                    <a v-if="user.id === house.user_id">{{ house.phone }}</a>
                                    <a v-else @click.prevent="agendVisit()"><div class="ui mini label">{{ $t("view_house_schedule_view") }}</div></a>
                                </span>
                            </span>
                            <del v-else class="">{{ $t("view_house_details_empty") }}</del>
                        </li>
                    </ul>
                </sui-card-description>
                <sui-card-content extra class="mt-5">
                <sui-container v-if="user.id != house.user_id"  text-align="center">
                    <button class="btn btn-lg text-white bg-main" @click.prevent="agendVisit()">
                    {{ $t("view_house_schedule_visit") }}
                    </button>
                </sui-container>
                <sui-container v-else text-align="center">
                    <button class="btn btn-lg text-white bg-main">
                    {{ $t("view_house_schedule_visit") }}
                    </button>
                </sui-container>
                </sui-card-content>
            </sui-card-content>
            </sui-card>

            <!-- Agend Visit -->

            <!-- INFOMATION ABOUT VERIFICATION -->
            <sui-card v-if="information" class="rounded-radius py-3 shadow w-100">
            <sui-card-content class="mb-2">
                  <sui-container>
                    <div class="mb-2">
                    <sui-button
                        circular
                        icon="arrow left"
                        @click.prevent="descontinuing()"
                    ></sui-button>
                    <!-- <label class="btn btn-md badge-pill text-white bg-main radio">
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
                            :value="house.house_code"
                            :class="{ 'is-invalid': form.errors.has('house_code') }"
                            class="d-none"
                            />{{ $t('schedule_form_houseId') }}
                            <has-error :form="form" field="house_code"/>
                            </span>
                    </label> -->
                    </div>
                </sui-container>
            <div class="p-3">
                <h4 class="text-center">{{ $t('view_house_info1') }}</h4>
                <p>{{ $t('view_house_info2') }}</p>
                <div class="ui list">
                    <div class="item">
                        {{ $t('view_house_info3') }}
                    </div>
                    <div class="item">
                        {{ $t('view_house_info4') }}
                    </div>
                    <div class="item">
                        {{ $t('view_house_info5') }}
                    </div>
                </div>
                <p>{{ $t('view_house_info6') }}</p>
                <p>{{ $t('view_house_info7') }} {{ house.tax_visit  | currency("AKZ", 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}. </p>
            </div>
            <div class="divider row"></div>
                <sui-container>
                <div class="field float-right">
                    <sui-button @click="continuing">{{
                    $t("mypanel_verification_6")
                    }}</sui-button>
                </div>
                </sui-container>
            </sui-card-content>
            </sui-card>

            <transition name="fade" mode="out-in">
                <!-- FORMULARIO PARA REQUEST PEDIDO  -->
                <sui-card v-if="visitComp" class="rounded-radius py-1 shadow w-100 bg-light topCard position-absolute">
                    <sui-card-content>
                        <card v-if="mustVerifyEmail" :title="$t('register')">
                            <div class="alert alert-success" role="alert">say somenthig</div>
                        </card>
                        <form
                        method="POST"
                        @submit.prevent="schedule()"
                        enctype="multipart/form-data"
                        @keydown="schedul.onKeydown($event)"
                        >
                        <alert-success :form="schedul" :message="$t('info_updated')" />
                        <sui-container>
                            <div class="mb-2">
                            <sui-button
                                circular
                                icon="arrow left"
                                @click.prevent="removeComponent()"
                            ></sui-button>
                            <!-- <label class="btn btn-md badge-pill text-white bg-main radio">
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
                                    :value="house.house_code"
                                    :class="{ 'is-invalid': form.errors.has('house_code') }"
                                    class="d-none"
                                    />{{ $t('schedule_form_houseId') }}
                                    <has-error :form="form" field="house_code"/>
                                    </span>
                            </label> -->
                            </div>
                        </sui-container>

                        <sui-container text-align="justified" class="my-2">
                            <sui-form>
                            <sui-form-field>
                                <label class="ml-3">{{ $t("schedule_form_name") }}</label>
                                <input
                                v-model="user.name"
                                class="rounded-pill"
                                :placeholder="$t('schedule_form_name')"
                                    readonly
                                />
                            </sui-form-field>
                            </sui-form>
                        </sui-container>
                        <sui-container>
                            <sui-form equal-width>
                            <sui-form-field>
                                <sui-form-fields>
                                <sui-form-field>
                                    <label class="ml-3">{{ $t("schedule_form_identity") }}</label>
                                    <input
                                    v-model="user.identity"
                                    class="rounded-pill"
                                    :placeholder="$t('schedule_form_identity')"
                                    readonly
                                    />
                                </sui-form-field>

                                <sui-form-field>
                                    <label class="ml-3">{{ $t("schedule_form_address") }}</label>
                                    <input v-model="user.address" class="rounded-pill" :placeholder="$t('schedule_form_address')">
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
                                    <label class="ml-3">{{ $t("schedule_form_phone") }}</label>
                                    <input v-model="user.phone" class="rounded-pill" :placeholder="$t('schedule_form_phone')">
                                </sui-form-field>

                                <sui-form-field>
                                    <label class="ml-3">{{ $t("schedule_form_email") }}</label>
                                    <input
                                    v-model="user.email"
                                    class="rounded-pill"
                                    :placeholder="$t('schedule_form_email')"
                                    readonly
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
                                    <label class="ml-3">{{ $t("schedule_form_date") }}</label>
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
                                    v-model="schedul.date"
                                    v-bind:data-vv-as="'Please enter your visit date'"
                                    id="event_date"
                                    name="event_date"
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
                                    <label class="ml-3">{{ $t("schedule_form_time") }}</label>
                                    <vue-timepicker v-model="schedul.time" format="H:mm" input-width="100%" input-class="rounded-radius padding" :placeholder="$t('schedule_form_time')" drop-direction="down" :minute-interval="10" :second-interval="10"  close-on-complete></vue-timepicker>
                                    <!-- <input
                                        v-model="form.time"
                                        :class="{ 'is-invalid': form.errors.has('time') }"
                                        class="rounded-pill" :placeholder="$t('schedule_form_time')"
                                        /> -->
                                    <has-error :form="schedul" field="time" />
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
                                    <sui-image v-else :src="filepreview" class="img-thumbnail w-100 h-100" v-show="filepreview" fluid />
                                        {{  }}
                                    <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="receipt_promo" @change="fileSelected" aria-describedby="receipt_promo">
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
            </transition>
        </div>
      </div>
    </div>
    <LightBox
      ref="lightbox"
      :media="photos"
      :show-caption="true"
      :show-light-box="false"
    />
  </div>
</template>
<script>
import Footer from '../components/Footer'
import scheduleVisit from '../components/ScheduleVisit'
import ScheduleStay from '../components/ScheduleStay'
import HouseDetails from '../components/HouseDetails'
import Form from 'vform'
import axios from 'axios'

import LightBox from 'vue-it-bigger'
import('vue-it-bigger/dist/vue-it-bigger.min.css') // when using webpack

import Vue2Filters from 'vue2-filters'
import uniq from "lodash/uniq";
import sortedLastIndex from "lodash/sortedlastindex";

// HOOPER SLIDE
import { Hooper, Slide, Pagination as HooperPagination } from 'hooper'
import 'hooper/dist/hooper.css'

// Slick Slide
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

/// Rating Star
import StarRating from 'vue-star-rating'

import Datepicker from "~/components/TouchDatePicker.vue"
import TimePicker from "~/components/TimePicker.vue"
import PickDate from "~/components/PickDate.vue"
import VueTimepicker from 'vue2-timepicker/src'

import sharenetwork from '~/components/sharenetwork.vue'

import { mapGetters } from "vuex"
const imageDomain = 'https://vue-it-bigger.rusiczki.net/'

const media = [
  {
    thumb: 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRx1TQ3PfnhWmLUWcxrGj3atDCZVTVBKetMOWVVQ4ipIStW03pY',
    sources: [
      {
        src: 'https://www.w3schools.com/html/mov_bbb.mp4',
        type: 'video/mp4',
      },
    ],
    type: 'video',
    caption: 'Monsters Inc.',
    width: 800,
    height: 600,
  },
  {
    thumb: imageDomain + '01-zell-am-see-thumbnail.jpg',
    src: imageDomain + '01-zell-am-see.jpg',
    caption: 'Zell am See, Austria',
  },
  {
    thumb: imageDomain + '02-balea-lake-chalet-thumbnail.jpg',
    src: imageDomain + '02-balea-lake-chalet.jpg',
    caption: 'Balea Lake Chalet, Romania',
  },
  {
    thumb: imageDomain + '03-maybug-thumbnail.jpg',
    src: imageDomain + '03-maybug.jpg',
    caption: 'Maybug',
  },
  {
    thumb: imageDomain + '04-rc-car-thumbnail.jpg',
    src: imageDomain + '04-rc-car.jpg',
    caption: 'An RC Car',
  },
  {
    thumb: imageDomain + '05-tourists-thumbnail.jpg',
    src: imageDomain + '05-tourists.jpg',
    caption: 'Two tourists on a mountain',
  },
  {
    thumb: imageDomain + '06-dog-thumbnail.jpg',
    src: imageDomain + '06-dog.jpg',
    caption: 'Dog',
  },
  {
    thumb: imageDomain + '07-beer-thumbnail.jpg',
    src: imageDomain + '07-beer.jpg',
    caption: 'Mmm, Beer! - This should be a short description, as it is after all, beer, but let\'s make it long so that we can test how the footer looks',
  },
  {
    thumb: imageDomain + '08-roosters-crest-thumbnail.jpg',
    src: imageDomain + '08-roosters-crest.jpg',
    caption: 'The Rooster\'s Crest',
  },
]
export default {
  components: {
    LightBox,
    Footer,
    scheduleVisit,
    ScheduleStay,
    HouseDetails,
    Hooper,
    HooperPagination,
    Slide,
    VueSlickCarousel,
    StarRating,
    Datepicker, 
    TimePicker,
    PickDate,
    VueTimepicker,
    sharenetwork
  },
  mixins: [Vue2Filters.mixin],
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('home') }
  },
  data () {
    return {
      form: new Form({
        id: '',
        user_id: '',
        house_id: '',
        house_code: null,
        description: '',
        rating: null,
        approved: '',
        mode: ''
      }),
      seePhoto: false,
      src: '/images/announce/1.jpg',
      mustVerifyEmail: false,
      house: {},
      reviews: {},
      media,
      readMore: false,
      photos: [],
      house_details: true,
      visitComp: false,
      information: false,
      settings: {
        dots: true,
        infinite: true,
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true
      },
      review: false,
      stars: {},
      userData: {},
      schedul: new Form({
        price: 250,
        date: '',
        time: '',
        receipt: '',
        request_type: 'Schedule Visit'
      }),
      filepreview: '',
      fileName: '',
      shareMedia: false
    }
  },
  computed: mapGetters({
    user: 'auth/user',
    authenticated: 'auth/check'
  }),
  mounted () {
    this.loadHouses()
    this.loadHousesPhotos()
    this.loadReviews()
    this.loadReview()
    this.loadStars()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadStars()
      this.loadReviews()
      this.loadReview()
    })
  },
  methods: {
    // CAMPO VISITAS
    descontinuing () { this.information = false; this.house_details = true },
    continuing () { this.information = false; this.visitComp = true },
    removeComponent () {
      this.information = true
      this.visitComp = false
    },
    agendVisit () {
      this.house_details = false
      this.information = true
    },
    loadUser () {
      axios.get('/api/get-user').then(({ data }) => { this.userData = data })
    },
    // SCHEDULE VISIT
    fileSelected (e) {
      this.schedul.receipt = e.target.files[0]
      if (this.schedul.receipt) {
        if (/\.(jpe?g|png|gif|pdf)$/i.test(this.schedul.receipt.name)) {
          if (this.schedul.receipt.size > 4096 * 4096) {
            e.preventDefault()
            alert('File too big (> 16MB)')
            // eslint-disable-next-line no-useless-return
            return
          } else {
            const reader = new FileReader()
            reader.readAsDataURL(this.schedul.receipt)
            reader.onload = (e) => {
              this.filepreview = e.target.result
              this.fileName = this.schedul.receipt.name
            }
          }
        } else {
          alert('incompatible format')
          this.$refs.inputFile.values = null
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('schedule_form_msg_photo_type'))
        }
      }
    },
    schedule () {
      const formData = new FormData()
      formData.append('user_id', this.user.id)
      formData.append('username', this.user.name)
      formData.append('phone', this.user.phone)
      formData.append('email', this.user.email)
      formData.append('address', this.user.address)
      formData.append('house_code', this.house.house_code)
      formData.append('owner', this.house.user_id)
      formData.append('house_city', this.house.city)
      formData.append('house_county', this.house.county)
      formData.append('house_district', this.house.district)
      formData.append('house_street', this.house.street)
      formData.append('price', this.schedul.price)
      formData.append('date', this.schedul.date)
      formData.append('time', this.schedul.time)
      formData.append('receipt', this.schedul.receipt)
      formData.append('request_type', this.schedul.request_type)

      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else if (this.user.phone === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_phone'))
      } else if (this.user.name === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_name'))
      } else if (this.schedul.date === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_date'))
      } else if (this.schedul.time === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_time'))
      } else if (this.schedul.receipt === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('schedule_form_mgs_recept'))
      } else {
        this.schedul.busy = true
        axios
          .post('/api/send-request-to-visit', formData)
          .then(() => {
            this.schedul.reset()
            this.schedul.clear()
            this.fileName = ''; this.filepreview = ''
            this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
            this.$toastr.s(this.$t('schedule_form_suscceful_toastr'))
            // this.$router.push({ name: "my-panel.properties" });
          })
          .catch(() => {})
      }
    },
    // END CAMPO VISITAS
    stayComponent () {
      this.stayComp = false
      this.visitComp = false
    },
    visitComponent (houseCode) {
      console.log(houseCode)
      this.stayComp = false
      this.visitComp = false
    },
    getStay () {
      this.stayComp = true
    },
    getLink (houseCode) {
      console.log(houseCode)
      this.visitComp = true
    },
    favourite (houseCode) {
      axios.post('/api/favourite/' + houseCode)
        .then(() => {
          this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
          this.$toastr.s(
            this.$t('view_favourite_message_suscceful')
          )
        })
        .catch(() => {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(
            this.$t('view_favourite_message_error')
          )
        })
    },
    updateReview () {
      this.form.put('/api/review/' + this.form.house_code)
        .then(() => {
          // eslint-disable-next-line no-undef
          Fire.$emit('after-created')
          this.review = false
          // this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(
            this.$t('view_rating_message_suscceful_toastr')
          )
          console.log('Done')
        })
        .catch(() => {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(
            this.$t('view_rating_message_error_toastr')
          )
        })
    },
    storeReview () {
      // this.formData.product_id=this.product.id;
      this.form.busy = true
      this.form.post('/api/review')
        .then(() => {
          // eslint-disable-next-line no-undef
          Fire.$emit('after-created') // serve para atualizar a pagina dos usuarios
          this.review = false
          this.$toastr.s(this.$t('view_rating_message_suscceful_toastr'))
          this.form.reset()
          this.form.clear()
          // location.reload();
          console.log('Done')
        })
        .catch(error => {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('view_rating_message_error_toastr'))
          console.log(error)
        })
    },
    loadReviews () {
      axios.get('/api/review').then(({ data }) => (this.reviews = data))
    },
    loadReview () {
      axios.get(`/api/get-review/${this.$route.params.house_code}`).then(({ data }) => (this.form.fill(data)))
    },
    loadStars () {
      axios.get(`/api/get-star-rating/${this.$route.params.house_code}`).then(({ data }) => (this.stars = data))
    },
    activateReadMore () {
      this.readMoreActivated = true
    },
    openGallery (index) {
      this.$refs.lightbox.showImage(index)
    },
    loadHouses () {
      axios.get(`/api/view/${this.$route.params.house_code}`).then(({ data }) => (this.house = data))
    },
    loadHousesPhotos () {
      axios.get(`/api/get-photos/${this.$route.params.house_code}`).then(({ data }) => (this.photos = data))
    }
  }
}
</script>

<style lang="scss">
  .rounded-radius{
  border-radius: 2em!important;
  }
  .topCard{
    top: 0px;
  }
  .bg-main{
    background-color: #FF5859;
  }
  .padding{
    padding: 19px 1em!important;
  }
   /* .rounded-top{
       border-radius: 20px 0 0 25px !important;
   } */
</style>
