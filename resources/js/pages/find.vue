<template>
    <div>  
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <router-link class="navbar-brand" to="/">
          <img src="/images/logo/200x48.png" alt="logo" class="img-fluid" />
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent-7"
          aria-controls="navbarSupportedContent-7"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'services' }" class="nav-link">{{
                $t("services")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'collaborate' }" class="nav-link">{{
                $t("collaborate")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'advertiser' }" class="nav-link">{{
                $t("owner_house")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link">
                {{ $t("login") }}
              </router-link>
            </li>
            <!--  <li class="nav-item">
              <sui-dropdown :text="$t('account')" item class="simple nav-link">
                <sui-dropdown-menu>
                  <template v-if="authenticated">
                    <router-link :to="{ name: 'home' }" is="sui-dropdown-item">
                      {{ $t("home") }}
                    </router-link>
                  </template>

                  <template v-else>
                    <a href="javascript:void(0)" @click="signIn" is="sui-dropdown-item">
                      {{ $t("login") }}
                    </a>
                    <a href="javascrip:void(0)" @click="signUp" is="sui-dropdown-item">
                      {{ $t("register") }}
                    </a>
                  </template>
                </sui-dropdown-menu>
              </sui-dropdown>
            </li> -->

            <ul class="navbar-nav">
              <locale-dropdown />
              <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
            </ul>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->        
        <hooper  v-if="photos.length != 0" :infiniteScroll="true" :itemsToShow="3" :progress="true" :autoPlay="true" :playSpeed="2000">
            <slide  v-for="(image, index) in photos" :key="index">               
                <img :src="image.src" class="d-block w-100" :alt="image.caption" @click="openGallery(index)">
            </slide>
            <hooper-pagination slot="hooper-addons" mode="fraction"></hooper-pagination>
        </hooper>  
        <div v-else class="jumbotron jumbotron-fluid" :style="{'background': 'url(/'+house.profile+')', 'background-size': 'cover', 'background-position':'center center', 'background-repeat':'no-repeat'}">
            <div class="container" style="background: rgba(0,0,0, 0.5)">
                <div class="row">
                <div class="col-md-8 p-3">
                <p class="d-flex justify-content-between align-items-center h1 text-white text-uppercase">
                    <span>{{ $t('view_house_details_desc') }}</span> 
                    <sui-menu compact>
                        <a is="sui-menu-item" v-if="house.state == 'available'">
                            <sui-icon name="home" /> <span>{{ $t('view_house_details_stateUp') }}</span>
                            <sui-label color="green" floating>
                                ON
                            </sui-label>
                        </a>
                        <a is="sui-menu-item" v-if="house.state == 'occupied'">
                            <sui-icon name="home" />  <span>{{ $t('view_house_details_stateDown') }}</span>
                            <sui-label color="red" floating>
                                OFF
                            </sui-label>
                        </a>
                    </sui-menu>
                </p>

                <p class="lead text-white"><span class="" v-if="!readMore" v-html="house.description.slice(0, 150)"></span>
                <span v-if="readMore" v-html="house.description"></span>
                <a class="" @click.prevent="readMore = ! readMore" href="#">
                    <span  v-if="!readMore" class=" text-truncate">{{ $t('view_house_details_readM') }}</span> <span  v-if="readMore">{{ $t('view_house_details_readL') }}</span> 
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
                        <button class="btn btn-lg text-white bg-main mr-2" @click.prevent="seePhoto =! seePhoto"><i class="image icon"></i> {{ $t('view_photos_btn') }}</button>
                        <button class="btn btn-lg text-white bg-main mr-2"><i class="map outline icon"></i> {{ $t('view_maps_btn') }}</button>
                        <router-link :to="{ 'name': 'login' }" class="btn btn-lg text-white bg-main"><i class="heart icon"></i>{{ $t('view_favourite_btn') }}</router-link>
                        
                        <!-- <label  class="ui red basic button" for="houseCode"
                        @click="review =! review"> ({{ stars }})<i class="star outline icon"></i>Avaliação
                        </label> -->
                        <label  for="houseCode" @click="review =! review">
                        <div class="ui labeled button" tabindex="0">
                            <div class="ui basic red button">
                                <i class="star outline icon"></i>{{ $t('view_ratings_btn') }}
                            </div>
                            <a class="ui basic left pointing red label">
                                ({{ stars | number('0.0') }})
                            </a> 
                        </div>
                        </label>
                        <sui-button basic color="red"><i class="share alternate icon"></i> {{ $t('view_share_btn') }}</sui-button>
                    </div>
                    <transition name="fade" mode="out-in">
                    <ul
                    style="margin: 0; padding: 0"
                    v-if="seePhoto"
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
                </div>
                <div class="col-md-4 mt-lg-n5">
                    
                    <!-- House Information -->
                    <sui-card class="rounded-radius shadow topCard p-4 w-100 position-absolute" v-if="house_details">
                    <sui-card-content>
                        <sui-card-header class="d-flex justify-content-between align-items-center h1 py-3">
                        {{ $t('announce_form_price')}}
                        <div>
                            <a is="sui-label" color="green" tag v-if="house.state == 'available'">
                                <span>{{ $t('view_house_details_stateUp') }}</span>
                            </a>
                            <a is="sui-label" color="grey" tag v-if="house.state == 'occupied'">
                                <span>{{ $t('view_house_details_stateDown') }}</span>
                            </a>
                        </div>
                        </sui-card-header>

                        <sui-card-description>
                        <p class="d-block h4">{{ house.price  | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })}}/{{
                            house.payment_METHOD
                        }}
                        </p>
                        </sui-card-description>
                        <sui-divider section />
                        <sui-card-header
                        >{{ $t("view_house_details_contrat") }}
                        </sui-card-header>
                        <sui-card-description>
                        <span class="d-block">
                            {{ $t("view_house_details_type") }} {{ house.period }}
                        </span>
                        <span class="d-block">
                            {{ $t("view_house_details_pay") }} {{ house.payment_METHOD }}
                        </span>
                        </sui-card-description>
                        <sui-divider section />
                        <sui-card-header
                        >{{ $t("view_house_details_owner") }}
                        </sui-card-header>
                        <sui-card-description>
                            <span class="d-block">
                            <span v-if="house.username">{{ $t('view_house_details_name') }} {{ house.username }}</span>
                            <del v-else>{{ $t("view_house_details_empty") }}</del>
                            </span>
                            <span class="d-block">
                            <span v-if="house.email" v-on:mouseover="mouseoverEmail" v-on:mouseleave="mouseleaveEmail"> Email: <router-link :to="{'name': 'login'}"  class="text-danger"> {{OnOverMouseEmail}} </router-link> </span>
                            <del v-else class="">{{ $t("view_house_details_empty") }}</del>
                            </span>
                            <span class="d-block">
                            <span v-if="house.phone" v-on:mouseover="mouseover" v-on:mouseleave="mouseleave"> Tel.: <router-link :to="{'name': 'login'}">{{OnOverMouse}} </router-link> </span>
                            <del v-else> Tel.:  {{ $t("view_house_details_empty") }}</del>
                            </span>
                        </sui-card-description>
                        <sui-card-content extra class="mt-5">
                        <sui-container text-align="center">
                            <router-link :to="{ 'name': 'login' }" class="btn btn-lg text-white bg-main">
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


import Footer from '../components/Footer'
import Form from 'vform'
import axios from 'axios'
import LocaleDropdown from "../components/LocaleDropdown";

import LightBox from 'vue-it-bigger'
import('vue-it-bigger/dist/vue-it-bigger.min.css') // when using webpack
//HOOPER SLIDE
import { Hooper, Slide, Pagination as HooperPagination } from 'hooper';
import 'hooper/dist/hooper.css';


import Vue2Filters from 'vue2-filters'
import uniq from "lodash/uniq";
import sortedLastIndex from "lodash/sortedlastindex";

export default {
    middleware: 'guest',
    components:{
        LocaleDropdown,
        LightBox,
        Footer,
        Hooper,
        HooperPagination,
        Slide,
    },
    layout: 'basic',
    middleware: 'guest',
    mixins: [Vue2Filters.mixin],

    metaInfo () {
        return { title: this.$t('find') }
    },
    data: () => ({
        form: new Form({
            city: '',
            type: '',
            room: '',
            price: '',
        }),
        src: 'images/announce/1.jpg',
        mustVerifyEmail: false,
        house: {},
        stars:{},
        media,
        readMore: false,
        seePhoto: false,
        review: false,
        photos: [],
        house_details: true,
        visitComp: false,
        stayComp:false,
        OnOverMouse: "Hiden!",   
        OnOverMouseEmail: "Hiden!",  
    }),
    methods: {
        mouseoverEmail: function(){
        this.OnOverMouseEmail = 'go to login, to see it! '
        },    
        mouseleaveEmail: function(){
        this.OnOverMouseEmail = 'Hiden!'
        },
        mouseover: function(){
        this.OnOverMouse = 'go to login, to see it! '
        },    
        mouseleave: function(){
        this.OnOverMouse = 'Hiden!'
        },
        stayComponent(){            
            this.stayComp = false
            this.visitComp = false
        },
        visitComponent(house_code){
            console.log(house_code)
            this.stayComp = false
            this.visitComp = false
        },
        getStay(house_code){
            this.stayComp = true
        },
        getLink(house_code){
            console.log(house_code)
            this.visitComp = true
        },
        activateReadMore(){
            this.readMoreActivated = true;
        },
        openGallery(index) {
            this.$refs.lightbox.showImage(index)
        },
        loadHouses(){
            axios.get(`/api/find/${this.$route.params.houseKey}`).then(({ data }) => (this.house = data));              
        },        
        loadHousesPhotos(){
            axios.get(`/api/find-photos/${this.$route.params.houseKey}`).then(({ data }) => (this.photos = data));              
        },
        loadStars(){
            axios.get(`/api/get-total-stars/${this.$route.params.houseKey}`).then(({ data }) => (this.stars = data));   
        },
    },
    mounted () {
        this.loadHouses();
        this.loadHousesPhotos();
    },
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
   /* .rounded-top{
       border-radius: 20px 0 0 25px !important;
   } */
</style>