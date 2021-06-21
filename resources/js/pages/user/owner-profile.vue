<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <sui-card>
                    <sui-card-content>
                    <sui-image
                        v-if="!user.photo"
                        src="/images/profile/empty.jpg"
                        class="center mb-3"
                        style="width: 100px; height:100px; object-fit: cover;"
                    />
                    <sui-image
                    v-else
                        :src="user.photo"
                        class="center mb-3"
                        style="width: 100px; height:100px; object-fit: cover;"
                    />
                    
                    <sui-card-header>{{ user.name }}</sui-card-header>
                    <sui-card-meta><span class="text-capitalize" v-if="user.role == 'user'"> {{$t('unnouncent_user')}}</span> <span v-if="user.role == 'owner'">{{$t('anouncent_user')}}</span> </sui-card-meta>
                    </sui-card-content>
                    <sui-card-content extra>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="user === 'User not found'">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>{{ user }}!</strong> You should check if this user really exist.
                        </div>
                        <span v-else class="text-left">
                            <!-- Name-->
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="">{{ $t('view_house_details_name') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <label for="">{{user.name}}</label>
                                </div>
                            </div>

                            <!-- Email-->
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="">{{ $t('view_house_details_email') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <label for="">{{ user.email}}</label>
                                </div>
                            </div>

                            <!-- phone-->
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="">{{ $t('view_house_details_phone') }}</label>
                                </div>
                                <div class="col-md-9">
                                    <label for="">{{ user.phone}}</label>
                                </div>
                            </div>

                            <!-- address-->
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="">{{ $t('schedule_form_address') }}</label>
                                </div>
                                <div class="col-md-9    ">
                                    <label for=""> {{ user.address }}, {{ user.city }} - {{ user.country}}</label>
                                </div>
                            </div>
                        </span>
                        <hr>
                        <sui-container text-align="right" class="mt-3">
                            <router-link :to="{name: 'user.schedules'}" class="ui button basic tiny secondary">{{ $t('userpanel_back_to_schedule') }}</router-link>
                        </sui-container>
                    </sui-card-content>
                </sui-card>
            </div>
            <div class="col-md-9">
                <div class="row scrollDown p-4" id="style-3" >
                    <div class="col-md-4 mb-4" v-for="property in properties" :key="property.id">
                    <sui-card class="content-house rounded-radius">
                        <sui-image :src="'/' + property.profile" class="myProfileImage" />
                        <p class="title-house"> 
                        <span v-if="property.add_images =='has'"><i class="images outline icon"></i> <small>{{ $t('property_has_yes') }}</small></span>
                        <span v-if="property.add_images == 'hasnot'"><i class="unlink icon"></i> <small>{{ $t('property_has_no') }}</small></span>              
                        </p>
                        <div class="overlay-house"></div>
                        <div class="button-house">
                            <!-- {{$t("myPanel_card_footer_edit")}} -->
                            <sui-button @click.prevent="viewHouse(property.house_code)" icon="eye icon"/>
                            <!-- {{ $t("myPanel_card_footer_view") }} -->
                        </div>
                        <sui-card-content>
                        <sui-card-header
                            >{{
                            property.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true })
                            }}
                            /{{ property.payment_METHOD }}</sui-card-header
                        >
                        <sui-card-meta
                            >{{ $t("announce_public_at") }}
                            {{ property.created_at | OnlyDate }}</sui-card-meta
                        >
                        <sui-card-description class="text-lowercase"
                            >{{ property.type }}, {{ property.room }} {{ $t("announce_form_room") }},
                            {{ property.living_room }} {{ $t("announce_form_living_room") }},
                            {{ property.bathroom }}
                            {{ $t("announce_form_bathroom") }}.</sui-card-description
                        >
                        </sui-card-content>
                        <sui-card-content extra>
                        <span v-if="property.add_images =='has'">
                        <sui-icon name="images outline" /> {{ $t('property_has_') }}
                        </span>
                        <span v-if="property.add_images == 'hasnot'"  class="text-danger">
                        <sui-icon name="unlink" /> {{ $t('property_has_not') }}
                        </span>
                        </sui-card-content>
                    </sui-card>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
import axios from "axios";
export default {
    data:() => ({
        user: {},
        properties: {},
    }),
    methods:{
        getUser(){
            axios.get("/api/get-user-info/" + this.$route.params.slug).then(({data})=>{this.user = data})
        },
        getOwnerProperties(){
            axios.get("/api/get-owner-property/" + this.$route.params.slug).then(({data})=>{this.properties = data})
        },
        viewHouse(house_code) { 
            this.$router.push("/view/" + house_code);
            axios.post('/api/create-history/' + house_code).then(() => {
                console.log("added to history")
            })
        },
    },
    created() {
        this.getUser();
        this.getOwnerProperties();
    },
}
</script>
<style lang="scss">

    .scrollDown{
        width: 100%;
        height: 425px;
        background: #F5F5F5;
        overflow-y: scroll;
        margin-bottom: 25px;
    }
    #style-3::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar
    {
        width: 6px;
        background-color: #F5F5F5;
    }

    #style-3::-webkit-scrollbar-thumb
    {
        background-color: #000000;
    }
    
</style>