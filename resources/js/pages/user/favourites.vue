<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3 mb-4" v-for="(house, index) in favourites" :key="index">
                <sui-card class="content-house rounded-radius">
                    <sui-image :src="'/' +house.profile" class="image-house rounded-top" />
                    <p class="title-house"><!-- {{ house.created_at | OnlyDate }} --></p>
                    <div class="overlay-house"></div>
                    <div class="button-house">
                        <a href="javascript:void(0)" @click.prevent="viewHouse(house.house_code)">
                            {{ $t("myPanel_card_footer_view") }}
                        </a>
                    </div>
                    <sui-card-content>
                    <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }}</sui-card-header>
                    <sui-card-meta>{{ $t("announce_public_at") }}{{ house.created_at | OnlyDate }}</sui-card-meta>
                    <sui-card-description class="text-lowercase"
                        >{{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                        {{ house.living_room }} {{ $t("announce_form_living_room") }},
                        {{ house.bathroom }}
                        {{ $t("announce_form_bathroom") }}.</sui-card-description>
                    </sui-card-content>
                    
                    <sui-card-content extra>
                    <sui-icon name="home" />
                    {{ $t("home_form_type") }}:
                    <span
                        v-if="house.period == 'long period'"
                        class="font-weight-bold text-lowercase"
                        >{{ $t("home_form_type_long") }}</span
                    >
                    <span v-else class="font-weight-bold text-lowercase">{{
                        $t("home_form_type_short")
                    }}</span>
                    </sui-card-content>
                </sui-card>


                <!-- OLD ONE 
                    <sui-card class="content-house rounded-radius">
                    <sui-image :src="house.profile" class="image-house rounded-top"/>
                    <p class="title-house">{{ house.created_at | OnlyDate }}</p>
                    <div class="overlay-house"></div>
                    <div class="button-house"><a href="javascript:void(0)"  @click.prevent="viewHouse(house.house_code)"> {{ $t('myPanel_card_footer_view') }} </a></div>
                    <sui-card-content>
                        <sui-card-header>{{ house.price  | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })}} akz/{{ house.payment_METHOD }}</sui-card-header>
                        <sui-card-meta>{{ $t('announce_public_at') }} {{ house.created_at | OnlyDate }}</sui-card-meta>
                        <sui-card-description class="text-lowercase"
                        >{{ house.type }}, {{ house.room }} {{ $t('announce_form_room') }}, {{ house.living_room }} {{ $t('announce_form_living_room') }}, {{ house.bathroom }} {{ $t('announce_form_bathroom') }} .</sui-card-description
                        >                            
                    </sui-card-content>
                    <sui-card-content extra>
                        <sui-icon name="home" />
                        {{ $t('home_form_type') }}: <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t('home_form_type_long') }}</span> <span v-else class="font-weight-bold text-lowercase">{{ $t('home_form_type_short') }}</span> 
                    </sui-card-content>
                </sui-card> -->
            </div>
            <div class="col-md-8">
            <div class="d-flex justify-content-center" v-if="favourites.length <= 0">                 
                <transition name="fade">
                <sui-message
                    v-if="visible"
                    header="Welcome back!"
                    content="This is a special notification which you can dismiss."
                    dismissable
                    @dismiss="handleDismiss"
                />
                </transition>
                <p v-if="!visible">
                Message will come back in 2s
                </p>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name:"user.favourites",
    data(){
        return{
            favourites: {},
            visible: true 
        }
    }, 
    methods:{
        viewHouse(house_code)
        {
            this.$router.push('/view/' + house_code)
            axios.post('/api/create-history/' + house_code).then(() => {
                console.log("added to history")
            })
        },
        //IF THERE IS NOTHING 
        handleDismiss() {
            this.visible = false;
            setTimeout(() => {
                this.visible = true;
            }, 2000);
        },
        async loadHouses() {
            try {
                const response = await fetch('/api/favourites-houses')
                const result = await response.json()
                this.favourites = result
            }catch (error){
                console.log(error)
            }             
        },
    },
    mounted(){
        this.loadHouses();
    }
}
</script>

<style lang="scss">
.style {
  background-size: cover !important;
  background-position: center left !important;
  background-repeat: no-repeat !important;
  background-color: black;
}
.image-house{
    object-fit: cover;
    width: 100%;
    height: 200px;
}
.ui.card > :first-child,
.ui.cards > .card > :first-child {
  border-radius: 1.9rem 1.9rem 0 0 !important;
  border-top: none !important;
}
</style>