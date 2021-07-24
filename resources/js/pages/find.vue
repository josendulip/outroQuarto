<template>
  <div>
    <Navout />
    <!-- Header -->
    <hooper v-if="photos.length != 0" :infiniteScroll="true" :itemsToShow="3" :progress="true" :autoPlay="true" :playSpeed="2000">
      <slide v-for="(image, index) in photos" :key="index">
        <img :src="image.src" class="img-fluid d-block" :alt="image.caption" style="height: 350px; width:700px; object-fit:cover;" @click="openGallery(index)">
      </slide>
      <hooper-pagination slot="hooper-addons" mode="fraction" />
    </hooper>
    <div v-else class="jumbotron jumbotron-fluid" :style="{ background: 'url(/' + house.profile + ')', 'background-size': 'cover', 'background-position': 'center center', 'background-repeat': 'no-repeat',}">
      <div class="container" style="background: rgba(0, 0, 0, 0.5)">
        <div class="row">
          <div class="col-md-8 p-3">
            <p class="d-flex justify-content-between align-items-center h1 text-white text-uppercase">
              <span>{{ $t("view_house_details_desc") }}</span>
              <sui-menu compact>
                <a is="sui-menu-item" v-if="house.state == 'available'">
                  <sui-icon name="home" />
                  <span>{{ $t("view_house_details_stateUp") }}</span>
                  <sui-label color="green" floating> ON </sui-label>
                </a>
                <a is="sui-menu-item" v-if="house.state == 'occupied'">
                  <sui-icon name="home" />
                  <span>{{ $t("view_house_details_stateDown") }}</span>
                  <sui-label color="red" floating> OFF </sui-label>
                </a>
              </sui-menu>
            </p>

            <p class="lead text-white">
              // eslint-disable-next-line vue/no-v-html
              <span v-if="!readMore" v-html="house.description.slice(0, 150)" />
              <span v-if="readMore" v-html="house.description" />
              <a class="" href="#" @click.prevent="readMore = !readMore">
                <span v-if="!readMore" class="text-truncate">{{
                  $t("view_house_details_readM")
                }}</span>
                <span v-if="readMore">{{ $t("view_house_details_readL") }}</span>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 my-4">
          <div class="mb-3">
            <button class="btn btn-lg text-white bg-main mr-2" @click.prevent="seePhoto = !seePhoto">
              <i class="image icon" /> {{ $t("view_photos_btn") }}
            </button>
            <button class="btn btn-lg text-white bg-main mr-2">
              <i class="map outline icon" /> {{ $t("view_maps_btn") }}
            </button>
            <router-link :to="{ name: 'login' }" class="btn btn-lg text-white bg-main">
              <i class="heart icon" />{{ $t("view_favourite_btn") }}
            </router-link>

            <!-- <label  class="ui red basic button" for="houseCode"
                @click="review =! review"> ({{ stars }})<i class="star outline icon"></i>Avaliação
                </label> -->
            <label for="houseCode" @click="review = !review">
              <div class="ui labeled button" tabindex="0">
                <div class="ui basic red button">
                  <i class="star outline icon" />{{ $t("view_ratings_btn") }}
                </div>
                <a class="ui basic left pointing red label">
                  ({{ stars | number("0.0") }})
                </a>
              </div>
            </label>
            <sui-button basic color="red">
              <i class="share alternate icon" /> {{ $t("view_share_btn") }}
            </sui-button>
          </div>
          <transition name="fade" mode="out-in">
            <ul v-if="seePhoto" style="margin: 0; padding: 0">
              <li
                v-for="(image, index) in photos"
                :key="index"
                style="display: inline-block; margin: 0 5px 5px 0"
              >
                <img :src="image.src" style="height: 100px; cursor: pointer" @click="openGallery(index)">
              </li>
              <li v-if="photos.length <= 0">
                <h4 class="text-danger">
                  {{ $t("view_house_no_photos") }}!
                </h4>
              </li>
            </ul>
          </transition>
          <hr>
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"><i class="map marker alternate icon" /> {{ house.city }}, {{ house.county }}</a>
            </li>
            <li class="nav-item">
              <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="expand icon" />  {{ $t("annou_form_land") }}</a>
              <a v-else class="nav-link" href="#"><i class="home icon" /> {{ house.type }}</a>
            </li>
            <li class="nav-item">
              <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="text height icon" /> {{ house.width }} {{ $t("announce_form_widthW") }}</a>
              <a v-else class="nav-link" href="#"><i class="tv icon" /> {{ house.living_room }} {{ $t("announce_form_living_room") }}</a>
            </li>
            <li class="nav-item">
              <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="text width icon" /> {{ house.length }} {{ $t("announce_form_lengthL") }}</a>
              <a v-else class="nav-link" href="#"><i class="bed icon" /> {{ house.room }} {{ $t("announce_form_room") }}</a>
            </li>
            <li class="nav-item">
              <a v-if="house.type == 'Land'" class="nav-link" href="#"><i class="square full icon" /> {{ house.area }} {{ $t("announce_form_areaA") }}</a>
              <a v-else class="nav-link" href="#"><i class="bath icon" /> {{ house.bathroom }} {{ $t("announce_form_bathroom") }}</a>
            </li>
            <li class="nav-item">
              <a v-if="house.type != 'Land'" class="nav-link" href="#"><i class="box icon" /> {{ $t("announce_form_furniture") }} (<em>{{ house.furniture }}</em>)</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="object group outline icon" /> {{ $t("announce_form_garden") }} (<em>{{ house.garden }}</em>)</a>
            </li>
          </ul>
        </div>
        <div class="col-md-4 mt-lg-n5">
          <!-- House Information -->
          <sui-card
            v-if="house_details"
            class="rounded-radius shadow topCard p-4 w-100 position-absolute"
          >
            <sui-card-content>
              <sui-card-header
                class="d-flex justify-content-between align-items-center h1 py-3"
              >
                {{ $t("announce_form_price") }}
                <div>
                  <a is="sui-label" v-if="house.state == 'available'" color="green" tag>
                    <span>{{ $t("view_house_details_stateUp") }}</span>
                  </a>
                  <a is="sui-label" v-if="house.state == 'occupied'" color="grey" tag>
                    <span>{{ $t("view_house_details_stateDown") }}</span>
                  </a>
                </div>
              </sui-card-header>

              <sui-card-description>
                <p class="d-block h4">
                  {{ house.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true}) }}
                </p>
              </sui-card-description>
              <sui-divider section />
              <sui-card-header>{{ $t("view_house_details_contrat") }} </sui-card-header>
              <sui-card-description>
                <span class="d-block">
                  {{ $t("announce_form_vititfee") }} {{ house.tax_visit | currency("KZ", 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
                </span>
                <span v-if="house.payment_METHOD == 'Installment'" class="d-block">
                  {{ $t("view_house_details_pay") }} <span class="text-lowercase font-weight-bold">{{ $t('annou_form_payment_installment') }}</span>
                </span>
                <span class="d-block">
                  {{ $t("announce_form_vititfee") }} {{ house.tax_visit | currency("KZ", 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
                </span>
              </sui-card-description>
              <sui-divider section />
              <sui-card-header> {{ $t("view_house_details_owner") }} </sui-card-header>
              <sui-card-description>
                <span class="d-block">
                  <span v-if="house.username">{{ $t("view_house_details_name") }} {{ house.username }}</span>
                  <del v-else>{{ $t("view_house_details_empty") }}</del>
                </span>
                <span class="d-block">
                  <span v-if="house.email" @:mouseover="mouseoverEmail" @:mouseleave="mouseleaveEmail">
                    Email:
                    <router-link :to="{ name: 'login' }" class="text-danger">
                      {{ OnOverMouseEmail }}
                    </router-link>
                  </span>
                  <del v-else class="">{{ $t("view_house_details_empty") }}</del>
                </span>
                <span class="d-block">
                  <span v-if="house.phone" @:mouseover="mouseover" @:mouseleave="mouseleave">
                    Tel.:
                    <router-link :to="{ name: 'login' }">{{ OnOverMouse }} </router-link>
                  </span>
                  <del v-else> Tel.: {{ $t("view_house_details_empty") }}</del>
                </span>
              </sui-card-description>
              <sui-card-content extra class="mt-5">
                <sui-container text-align="center">
                  <router-link
                    :to="{ name: 'login' }"
                    class="btn btn-lg text-white bg-main"
                  >
                    {{ $t("view_house_schedule_visit") }}
                  </router-link>
                </sui-container>
              </sui-card-content>
            </sui-card-content>
          </sui-card>
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
import Form from 'vform'
import axios from 'axios'
import Navout from '~/components/Navout'

import LightBox from 'vue-it-bigger' // when using webpack
// HOOPER SLIDE
import { Hooper, Slide, Pagination as HooperPagination } from 'hooper'
import 'hooper/dist/hooper.css'

import Vue2Filters from 'vue2-filters'
import('vue-it-bigger/dist/vue-it-bigger.min.css')

const imageDomain = 'https://vue-it-bigger.rusiczki.net/'

const media = [
  {
    thumb:
      'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRx1TQ3PfnhWmLUWcxrGj3atDCZVTVBKetMOWVVQ4ipIStW03pY',
    sources: [
      {
        src: 'https://www.w3schools.com/html/mov_bbb.mp4',
        type: 'video/mp4'
      }
    ],
    type: 'video',
    caption: 'Monsters Inc.',
    width: 800,
    height: 600
  },
  {
    thumb: imageDomain + '01-zell-am-see-thumbnail.jpg',
    src: imageDomain + '01-zell-am-see.jpg',
    caption: 'Zell am See, Austria'
  },
  {
    thumb: imageDomain + '02-balea-lake-chalet-thumbnail.jpg',
    src: imageDomain + '02-balea-lake-chalet.jpg',
    caption: 'Balea Lake Chalet, Romania'
  },
  {
    thumb: imageDomain + '03-maybug-thumbnail.jpg',
    src: imageDomain + '03-maybug.jpg',
    caption: 'Maybug'
  },
  {
    thumb: imageDomain + '04-rc-car-thumbnail.jpg',
    src: imageDomain + '04-rc-car.jpg',
    caption: 'An RC Car'
  },
  {
    thumb: imageDomain + '05-tourists-thumbnail.jpg',
    src: imageDomain + '05-tourists.jpg',
    caption: 'Two tourists on a mountain'
  },
  {
    thumb: imageDomain + '06-dog-thumbnail.jpg',
    src: imageDomain + '06-dog.jpg',
    caption: 'Dog'
  },
  {
    thumb: imageDomain + '07-beer-thumbnail.jpg',
    src: imageDomain + '07-beer.jpg',
    caption:
      'Mmm, Beer! - This should be a short description, as it is after all, beer, but lets make it long so that we can test how the footer looks'
  },
  {
    thumb: imageDomain + '08-roosters-crest-thumbnail.jpg',
    src: imageDomain + '08-roosters-crest.jpg',
    caption: 'The Roosters Crest'
  }
]

export default {
  components: {
    Navout,
    LightBox,
    Hooper,
    HooperPagination,
    Slide
  },
  mixins: [Vue2Filters.mixin],
  layout: 'basic',
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('head_form_find_house') }
  },
  data: () => ({
    form: new Form({
      city: '',
      type: '',
      room: '',
      price: ''
    }),
    src: 'images/announce/1.jpg',
    mustVerifyEmail: false,
    house: {},
    stars: {},
    media,
    readMore: false,
    seePhoto: false,
    review: false,
    photos: [],
    house_details: true,
    visitComp: false,
    stayComp: false,
    OnOverMouse: 'Hiden!',
    OnOverMouseEmail: 'Hiden!'
  }),
  mounted () {
    this.loadHouses()
    this.loadHousesPhotos()
  },
  methods: {
    mouseoverEmail: function () {
      this.OnOverMouseEmail = 'go to login, to see it! '
    },
    mouseleaveEmail: function () {
      this.OnOverMouseEmail = 'Hiden!'
    },
    mouseover: function () {
      this.OnOverMouse = 'go to login, to see it! '
    },
    mouseleave: function () {
      this.OnOverMouse = 'Hiden!'
    },
    stayComponent () {
      this.stayComp = false
      this.visitComp = false
    },
    visitComponent (houseCode) {
      console.log(houseCode)
      this.stayComp = false
      this.visitComp = false
    },
    getStay (houseCode) {
      this.stayComp = true
    },
    getLink (houseCode) {
      console.log(houseCode)
      this.visitComp = true
    },
    activateReadMore () {
      this.readMoreActivated = true
    },
    openGallery (index) {
      this.$refs.lightbox.showImage(index)
    },
    loadHouses () {
      axios
        .get(`/api/find/${this.$route.params.houseKey}`)
        .then(({ data }) => (this.house = data))
    },
    loadHousesPhotos () {
      axios
        .get(`/api/find-photos/${this.$route.params.houseKey}`)
        .then(({ data }) => (this.photos = data))
    },
    loadStars () {
      axios
        .get(`/api/get-total-stars/${this.$route.params.houseKey}`)
        .then(({ data }) => (this.stars = data))
    }
  }
}
</script>

<style lang="scss">
.rounded-radius {
  border-radius: 2em !important;
}
.topCard {
  top: 0px;
}
.bg-main {
  background-color: #ff5859;
}
/* .rounded-top{
       border-radius: 20px 0 0 25px !important;
   } */
</style>
