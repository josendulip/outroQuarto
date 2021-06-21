<template>
    <div>   
        <div v-if="photos.length <=0" class="jumbotron jumbotron-fluid" :style="{'background': 'url(/'+house.profile+')', 'background-size': 'cover', 'background-position':'center center', 'background-repeat':'no-repeat'}">
            <div class="container" style="background: rgba(0,0,0, 0.5)">

                
                
                <div class="row">
                <div class="col-md-8 p-3">
                <p class="d-flex justify-content-between align-items-center h1 text-white text-uppercase">
                    <span>{{ $t('view_house_details_desc') }}</span> 
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
        <hooper  v-if="photos.length != 0" :infiniteScroll="true" :itemsToShow="3" :progress="true" :autoPlay="true" :playSpeed="2000">
            <slide  v-for="(image, index) in photos" :key="index">               
                <img :src="image.src" class="d-block w-100" :alt="image.caption" @click="openGallery(index)">
            </slide>
            <hooper-pagination slot="hooper-addons" mode="fraction"></hooper-pagination>
        </hooper>
                
        <!-- <VueSlickCarousel v-bind="settings">
            <div><h1><img  :src="image.src"  :alt="house.caption"  v-for="(image, index) in photos"
                    :key="index"></h1></div>
        </VueSlickCarousel> -->
        <!-- <div id="carouselExampleCaptions" class="carousel slide mt-md-4" data-ride="carousel">
                    
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img  :src="'/'+house.profile" class="d-block" :alt="house.profile" style="height:300px!important; width:100%!important">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ house.created_at | MultipleLocaleSupport }}</h5>
                    <p>{{ $t('announce_form_type') }} >> {{ house.type }}.</p>
                </div>
                </div>
                <div class="carousel-item" v-for="(image, index) in photos"
                    :key="index">
                <img :src="image.src" class="d-block" :alt="image.caption" style="height:300px!important; width:100%!important" @click="openGallery(index)">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ image.created_at | MultipleLocaleSupport }}</h5>
                    <p>{{ $t('announce_form_type') }} > {{ house.type }}.</p>
                </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> -->
        <div class="container ">
            <div class="row">
                <div class="col-md-8 my-4">                
                    <div class="mb-3">
                        <button class="btn btn-lg text-white bg-main mr-2" @click.prevent="seePhoto =! seePhoto"><i class="image icon"></i> {{ $t('view_photos_btn') }}</button>
                        <button class="btn btn-lg text-white bg-main mr-2"><i class="map outline icon"></i> {{ $t('view_maps_btn') }}</button>
                        <sui-button basic color="red" @click="favourite($route.params.house_code)"><i class="heart icon"></i>{{ $t('view_favourite_btn') }}</sui-button>
                        
                        <!-- <label  class="ui red basic button" for="houseCode"
                        @click="review =! review"> ({{ stars }})<i class="star outline icon"></i>Avaliação
                        </label> -->
                        <label  for="houseCode" @click="review =! review">
                        <div class="ui labeled button" tabindex="0">
                            <div class="ui basic red button">
                                <i class="star icon" v-if="form.user_id === user.id"></i> 
                                <i class="star outline icon" v-else></i>{{ $t('view_ratings_btn') }}
                            </div>
                            <a class="ui basic left pointing red label">
                                ({{ stars | number('0.0') }})
                            </a>
                        </div>
                        </label>
                        <sui-button basic color="red"><i class="share alternate icon"></i> {{ $t('view_share_btn') }}</sui-button>
                    </div>
                    <transition name="fade" mode="out-in">
                    <div class="review" v-if="review">
                        <h4 class="belongsTo" v-if="user.id === house.user_id">{{$t('view_rating_message_error')}}</h4>
                        <span class="belongsTo" v-else>
                        <form @submit.prevent="form.mode == 'true' ? updateReview() : storeReview()" @keydown="form.onKeydown($event)" class="border border-danger p-3">
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
                                    <input type="radio" id="houseCode" :value="$route.params.house_code" v-model="form.house_code">
                                </div>
                                <sui-button basic color="blue"  v-show="form.mode == 'true'" :disabled="form.busy">{{ $t('view_rating_btn') }}</sui-button>
                                <sui-button basic color="red" v-show="form.mode !== 'true'" :disabled="form.busy">{{ $t('view_rating_btn') }}</sui-button>
                            </div>
                            <div class="form-group">
                                 <label for="description">{{ $t('view_your_opinion') }}</label>
                                <textarea v-model="form.description" class="form-control" id="description" rows="2"></textarea>
                            </div>
                        </form>
                        </span>
                    </div>
                    </transition>
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
                    <hr>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><i class="map marker alternate icon"></i> {{ house.city }}, {{ house.county }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="home icon"></i> {{ house.type }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="tv icon"></i> {{ house.living_room }} {{ $t("announce_form_living_room") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bed icon"></i> {{ house.room }} {{ $t("announce_form_room") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bath icon"></i> {{ house.bathroom }} {{ $t("announce_form_bathroom") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="box icon"></i> {{ $t("announce_form_furniture") }} (<em>{{ house.furniture }}</em>)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="object group outline icon"></i> {{ $t("announce_form_garden") }} (<em>{{ house.garden }}</em>)</a>
                        </li>
                    </ul>
                    
                    <h5>{{ $t('view_house_details_desc') }}</h5>
                    <p class="lead" v-html="house.description"></p>
                    <hr>
                    <sui-comment-group minimal v-for="review in reviews" :key="review.id">
                        <span v-if="review.house_code === house.house_code">
                        <span v-if="review.description">
                        <sui-comment>
                        <sui-comment-avatar  src="/images/profile/user-default.png" />
                        <sui-comment-content>
                            <a is="sui-comment-author">{{review.user_name}}</a>
                            <sui-comment-metadata>
                            <div>{{ review.created_at | ExtensoFormato}}</div>
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
                    <HouseDetails v-bind:house_details="house"  @emit-schedule="getLink()" @emit-schedule-stay="getStay()"></HouseDetails>
                    <scheduleVisit v-bind:house_details="house" v-if="visitComp" @emit-remove="visitComponent()"></scheduleVisit>
                    <ScheduleStay v-bind:house_details="house" :user="user" v-if="stayComp" @emit-remove="stayComponent()"></ScheduleStay>
                    <!-- <sui-card class="rounded-radius topCard p-4 w-100 position-absolute">
                        <sui-card-content >
                            <sui-card-header class="py-3">{{ house.price }} akz/{{ house.payment_METHOD }}</sui-card-header>
                            
                            <sui-card-description>
                                <span class="d-block">
                                {{ house.city }}, {{ house.courty }}, {{ house.street }}.
                                </span>
                                <span class="d-block">
                                {{ house.type }}, {{ house.room }} {{ $t('announce_form_room') }}, {{ house.living_room }} {{ $t('announce_form_living_room') }}, {{ house.bathroom }} {{ $t('announce_form_bathroom') }} .
                                </span>
                                 
                            </sui-card-description>

                            <sui-card-header class="py-3">{{ $t('view_house_details_contrat')  }}  </sui-card-header>
                            <sui-card-description>
                                <span class="d-block">
                                {{ $t('view_house_details_type')  }} {{ house.period }}
                                </span>
                                <span class="d-block">
                                {{ $t('view_house_details_pay')  }} {{ house.payment_METHOD }}
                                </span>                
                            </sui-card-description>

                            <sui-card-header class="py-3">{{ $t('view_house_details_owner')  }}   </sui-card-header>
                            <sui-card-description>
                                <span class="d-block">
                                {{ $t('view_house_details_phone')  }} <span v-if="house.phone">{{ house.phone }}</span> <del v-else>{{ $t('view_house_details_empty')  }}</del>
                                </span>
                                <span class="d-block">
                                {{ $t('view_house_details_email')  }} <span v-if="house.email">{{ house.email }}</span> <del v-else class="">{{ $t('view_house_details_empty')  }}</del>
                                </span>                
                            </sui-card-description>
                            <sui-card-content extra class="mt-5">
                            <sui-container text-align="center">
                                
                                <button class="btn btn-lg text-white bg-main" @click.prevent="schedule">{{ $t('view_house_schedule') }}</button>
                                
                            </sui-container>
                            </sui-card-content>

                        </sui-card-content>
                    </sui-card> -->
                </div>
                <!-- <div class="col-md-4"> -->
                    <!-- <sui-card class="rounded-radius topCard p-4 w-100 position-absolute">
                        <sui-card-content >
                            <sui-card-header class="py-3">{{ house.price }} akz/{{ house.payment_METHOD }}</sui-card-header>
                            
                            <sui-card-description>
                                <span class="d-block">
                                {{ house.city }}, {{ house.courty }}, {{ house.street }}.
                                </span>
                                <span class="d-block">
                                {{ house.type }}, {{ house.room }} {{ $t('announce_form_room') }}, {{ house.living_room }} {{ $t('announce_form_living_room') }}, {{ house.bathroom }} {{ $t('announce_form_bathroom') }} .
                                </span>
                                 
                            </sui-card-description>

                            <sui-card-header class="py-3">{{ $t('view_house_details_contrat')  }}  </sui-card-header>
                            <sui-card-description>
                                <span class="d-block">
                                {{ $t('view_house_details_type')  }} {{ house.period }}
                                </span>
                                <span class="d-block">
                                {{ $t('view_house_details_pay')  }} {{ house.payment_METHOD }}
                                </span>                
                            </sui-card-description>

                            <sui-card-header class="py-3">{{ $t('view_house_details_owner')  }}   </sui-card-header>
                            <sui-card-description>
                                <span class="d-block">
                                {{ $t('view_house_details_phone')  }} <span v-if="house.email">{{ house.email }}</span> <del v-else>{{ $t('view_house_details_empty')  }}</del>
                                </span>
                                <span class="d-block">
                                {{ $t('view_house_details_email')  }} <span v-if="house.phone">{{ house.phone }}</span> <del v-else class="">{{ $t('view_house_details_empty')  }}</del>
                                </span>                
                            </sui-card-description>

                        </sui-card-content>
                    </sui-card> -->
                <!-- </div> -->
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

//HOOPER SLIDE
import { Hooper, Slide, Pagination as HooperPagination } from 'hooper';
import 'hooper/dist/hooper.css';

//Slick Slide
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

///Rating Star 
import StarRating from 'vue-star-rating'

import { mapGetters } from "vuex";
export default {
    middleware: 'auth',
    mixins: [Vue2Filters.mixin],
    components:{
        LightBox,
        Footer,
        scheduleVisit,
        ScheduleStay,
        HouseDetails,
        Hooper,
        HooperPagination,
        Slide,
        VueSlickCarousel,
        StarRating
    },
    metaInfo () {
        return { title: this.$t('home') }
    },
    data (){
        return {
        form: new Form({
            id: '',
            user_id: '',
            house_id: '',
            house_code: null,
            description: '',
            rating:null,
            approved: '',
            mode: '',
        }),
        seePhoto: false,
        src: '/images/announce/1.jpg',
        mustVerifyEmail: false,
        house: {},
        reviews: {},
        media,
        readMore: false,
        photos: [],
        visitComp: false,
        stayComp:false,
        settings:
        {
            "dots": true,
            "infinite": true,
            "centerMode": true,
            "centerPadding": "20px",
            "slidesToShow": 1,
            "slidesToScroll": 1,
            "variableWidth": true
        },
        review: false,
        stars: {},
        }
    },
    methods: {
        stayComponent(){            
            this.stayComp = false
            this.visitComp = false
        },
        visitComponent(house_code){
            console.log(house_code)
            this.stayComp = false
            this.visitComp = false
        },
        getStay(){
            this.stayComp = true
        },
        getLink(house_code){
            console.log(house_code)
            this.visitComp = true
        },
        favourite(house_code){
            axios.post('/api/favourite/' +house_code)
            .then(()=>{
                this.$toastr.defaultStyle = {"background-color": "#21ba45"};
                this.$toastr.s(
                    this.$t('view_favourite_message_suscceful') 
                );
            })
            .catch(()=>{
                this.$toastr.defaultStyle = {"background-color": "#FF5859"};
                this.$toastr.s(
                    this.$t('view_favourite_message_error') 
                );
            });
        },
        updateReview(){ 
            this.form.put('/api/review/'+this.form.house_code)
            .then(()=>{
                Fire.$emit('AfterCreated');
                this.review = false
                //this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(
                    this.$t('view_rating_message_suscceful_toastr') 
                );
                console.log('Done')
            })
            .catch(()=>{
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(
                    this.$t('view_rating_message_error_toastr') 
                );
            });
        },
        storeReview(){
            //this.formData.product_id=this.product.id;            
            this.form.busy = true
            this.form.post('/api/review')
            .then(()=>{
            Fire.$emit('AfterCreated'); // serve para atualizar a pagina dos usuarios 
            this.review = false
            this.$toastr.s(
                this.$t('view_rating_message_suscceful_toastr') 
            );
            this.form.reset()
            this.form.clear()
                //location.reload();
                console.log('Done');
            })
            .catch(error=>{
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(
                    this.$t('view_rating_message_error_toastr') 
                );
                console.log(error);
            })
        },
        loadReviews(){
            axios.get('/api/review').then(({ data }) => (this.reviews =data));   
        },        
        loadReview(){
            axios.get(`/api/get-review/${this.$route.params.house_code}`).then(({ data }) => (this.form.fill(data)));   
        },
        loadStars(){
            axios.get(`/api/get-star-rating/${this.$route.params.house_code}`).then(({ data }) => (this.stars = data));   
        },
        
        /* async loadHouses() {
            try {
                let code= this.$route.params.house_code
                const response = await  axios.get('../api/get-houses/' + code)
                //const result = await response.json()
                return this.house = response.data
                console.log(this.house)     
                }
            catch (error){
                console.log(error)
            }          
        }, */
        activateReadMore(){
            this.readMoreActivated = true;
        },
        openGallery(index) {
            this.$refs.lightbox.showImage(index)
        },
        loadHouses(){
            axios.get(`/api/view/${this.$route.params.house_code}`).then(({ data }) => (this.house = data));              
        },
        loadHousesPhotos(){
            axios.get(`/api/get-photos/${this.$route.params.house_code}`).then(({ data }) => (this.photos = data));              
        },
    },
    computed: mapGetters({
        user: "auth/user",
        authenticated: "auth/check",
    }),
    mounted () {
        this.loadHouses();
        this.loadHousesPhotos();
        this.loadReviews();
        this.loadReview();
        this.loadStars();
        Fire.$on('AfterCreated', ()=>{ 
            this.loadStars();
            this.loadReviews();
            this.loadReview();
        });
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