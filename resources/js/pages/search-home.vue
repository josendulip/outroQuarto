<template>
    <div class="container-fluid m-0 pl-0 pr-0" >
        <nav class="navbar navbar-expand navbar-light bg-main">
            <div class="container-fluid">
                <router-link class="navbar-brand" to="/">
                    <i class="home icon"></i>
                </router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#search-place"
                    aria-controls="search-place" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="search-place">

                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-3">
                        <div class="input-group">
                            <input class="form-control form-control-navbar" type="search" :placeholder="$t('search_for')" aria-label="Search" v-model="searches" @keyup="searchinger"  aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-light" @click.prevent="searchinger">
                                    <i class="search icon"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                
                    <ul class="navbar-nav">
                        <!-- CITIES -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $t('search_province') }}    
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <label class="dropdown-item cities"  v-for="(city, index) in Object.keys(cities)" :key="index">
                                    <input
                                    type="radio"
                                    class="custom-control-input" :value="city"  v-model="province"/>
                                    <span class="city"><i class="angle double right icon"></i>{{city}}</span> 
                                </label>                             
                                <div class="dropdown-divider" v-if="counties"></div>
                                <a class="dropdown-item" href="javascript:(0)"  v-if="counties" @click.prevent="uncheckCC()"><i class="check square outline icon"></i> {{ $t('search_uncheck') }}</a>
                            </div>
                        </li>
                        <!-- COUNTIES -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $t('announce_form_county') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <label class="dropdown-item cities" v-for="(county, index) in counties" :key="index">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input" v-model="form.county" :value="county"/>
                                    <span class="city"><i class="angle double right icon"></i>{{county}}</span> 
                                </label>  -->
                                <div class="dropdown-item" v-for="(county, index) in counties" :key="index">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        @change="toggleCountyFilter(county)"
                                        :checked="countyFilter.includes(county)"
                                        />
                                        <div class="custom-control-label">{{ county }}</div>
                                    </label>
                                </div>
                                <a class="dropdown-item" v-if="!counties">{{ $t('search_choose_first_city') }}</a>
                                <div class="dropdown-divider" v-if="counties"></div>
                                <a class="dropdown-item" href="javascript:(0)"  v-if="counties" @click.prevent="UncheckAllCount()"><i class="check square outline icon"></i> {{ $t('search_uncheck') }}</a>
                            </div>
                        </li>
                        <!-- PRICES -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $t('home_form_payment') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                
                                
                                <div class="pricing-slider center-content">
                                <label class="form-slider">
                                    <span>How many users do you have?</span>
                                    <input
                                    type="range"
                                    ref="slider"
                                    v-model="priceInputValue"
                                    @input="handleSliderValuePosition($event.target)"
                                    >
                                </label>
                                <div ref="sliderValue" class="pricing-slider-value">{{ getPricingData(priceInput) }}</div>
                                </div>
                                <div class="pricing-item-price">
                                    <span class="pricing-item-price-currency">
                                        {{ getPricingData(this.priceOutput.plan1, 0) }}
                                    </span>
                                    <span class="pricing-item-price-amount">
                                        {{ getPricingData(this.priceOutput.plan1, 1) }}
                                    </span>
                                    {{ getPricingData(this.priceOutput.plan1, 2) }}
                                </div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ROOM -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $t('announce_form_room') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="javascript:void(0)">
                                <label class="custom-control">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    value="1"
                                    v-model="roomFilter"
                                    />
                                    <div class="custom-control-label">1</div>
                                </label>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <label class="custom-control">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    value="2"
                                    v-model="roomFilter"
                                    />
                                    <div class="custom-control-label">2</div>
                                </label>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <label class="custom-control">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    value="3"
                                    v-model="roomFilter"
                                    />
                                    <div class="custom-control-label">3</div>
                                </label>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <label class="custom-control">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    value="4"
                                    v-model="roomFilter"
                                    />
                                    <div class="custom-control-label">4</div>
                                </label>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <label class="custom-control">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    value="5"
                                    v-model="roomFilter"
                                    />
                                    <div class="custom-control-label">5</div>
                                </label>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)">
                                <label class="custom-control">
                                    <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    value="6"
                                    v-model="roomFilter"
                                    />
                                    <div class="custom-control-label">6</div>
                                </label>
                            </a>
                            <div class="dropdown-divider" v-if="roomFilter"></div>
                                <a class="dropdown-item" href="javascript:(0)"  v-show="roomFilter" @click.prevent="UncheckAllRoom()"><i class="check square outline icon"></i> {{ $t('search_uncheck') }}</a> 
                            </div>
                        </li>
                        <!-- PERIOD -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $t('home_form_type')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <label class="dropdown-item cities">
                                    <input
                                    type="radio"
                                    class="custom-control-input"
                                    value="short" v-model="shortAndLongPeriod"
                                    />
                                    <span class="city"><i class="angle double right icon"></i> {{ $t('home_form_type_short')}}</span> 
                                </label>
                                <label class="dropdown-item cities">
                                    <input
                                    type="radio"
                                    class="custom-control-input"
                                    value="long" v-model="shortAndLongPeriod"
                                    />
                                    <span class="city"><i class="angle double right icon"></i> {{ $t('home_form_type_long')}}</span> 
                                </label>
                                <div class="dropdown-divider" v-if="shortAndLongPeriod"></div>
                                <a class="dropdown-item" href="javascript:(0)"  v-if="shortAndLongPeriod" @click.prevent="UncheckAllPeriod()"><i class="check square outline icon"></i> {{ $t('search_uncheck') }}</a>
                            </div>
                        </li>
                        <!-- STATE -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $t('view_house_availability')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <label class="dropdown-item cities">
                                    <input
                                    type="radio"
                                    class="custom-control-input"
                                    value="occupied" v-model="FreeStateOrBusy"
                                    />
                                    <span class="city"><i class="angle double right icon"></i>{{ $t('view_house_details_stateUp')}}</span> 
                                </label>
                                <label class="dropdown-item cities">
                                    <input
                                    type="radio"
                                    class="custom-control-input"
                                    value="available" v-model="FreeStateOrBusy"
                                    />
                                    <span class="city"><i class="angle double right icon"></i>{{ $t('view_house_details_stateDown')}}</span> 
                                </label>
                                <div class="dropdown-divider" v-if="FreeStateOrBusy"></div>
                                <a class="dropdown-item" href="javascript:(0)"  v-if="FreeStateOrBusy" @click.prevent="UncheckAllState()"><i class="check square outline icon"></i> {{ $t('search_uncheck') }}</a>
                            </div>
                        </li>
                        <!-- HOUSE TYPE -->
                        <li class="nav-item dropdown">
                                            
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$t('announce_form_type')}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="outhouse"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_outhouse') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Apartamento"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_apart') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Vivenda"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_house') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Albergue"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_albergue') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="guesthouse"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_Hospedaria') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Hotel"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_hotel') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Hostel"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_hostel') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Motel"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_motel') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Lodge"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_pousada') }}</div>
                                    </label>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <label class="custom-control">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        value="Pension"
                                        v-model="houseTypeFilter"
                                        />
                                        <div class="custom-control-label">{{ $t('annou_form_type_pension') }}</div>
                                    </label>
                                </a>
                                
                                <div class="dropdown-divider" v-if="houseTypeFilter"></div>
                                <a class="dropdown-item" href="javascript:(0)"  v-if="houseTypeFilter" @click.prevent="UncheckAllType()"><i class="check square outline icon"></i> {{ $t('search_uncheck') }}</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-3">
                <span v-if="province" class="font-weight-bold">
                    <strong><i class="caret right icon"></i>{{province}}</strong>
                    <small><i class="close icon text-muted" @click="uncheckCC"></i></small>
                </span>
                <span v-if="countyFilter != ''">:
                    <span v-for="county in countyFilter" :key="county" class="d-inline text-muted"><em>{{county}}, </em></span> 
                </span>
            </div>
            <div class="col-2">
                <span v-if="roomFilter != ''">
                    <strong><i class="caret right icon"></i>{{ $t('announce_form_room') }} <small>(Qtd)</small> </strong>
                    <span v-for="room in roomFilter" :key="room" class="d-inline text-muted"><em>{{room}}, </em></span> 
                    <small><i class="close icon text-muted" @click="UncheckAllRoom"></i></small>
                </span>
            </div>
            <div class="col-2">
                <span v-if="shortAndLongPeriod != ''">
                    <strong><i class="caret right icon"></i>{{ $t('search_house_period') }}: </strong>
                    <em>{{shortAndLongPeriod}}, </em> 
                    <small><i class="close icon text-muted" @click="UncheckAllPeriod"></i></small>
                </span>
            </div>
            <div class="col-2">
                <span v-if="FreeStateOrBusy != ''">
                    <strong><i class="caret right icon"></i>{{ $t('search_house_state') }}: </strong>
                    <em>{{FreeStateOrBusy}}, </em> 
                    <small><i class="close icon text-muted" @click="UncheckAllState"></i></small>
                </span>
            </div>
            <div class="col-3">
                <span v-if="houseTypeFilter != ''">
                    <strong><i class="caret right icon"></i>{{ $t('announce_form_type') }}:</strong>
                    <span v-for="house_type in houseTypeFilter" :key="house_type" class="d-inline text-muted"><em>{{house_type}}, </em></span> 
                    <small><i class="close icon text-muted" @click="UncheckAllType"></i></small>
                </span>
            </div>
        </div>


        <div class="container my-5">            
            <div class="row">
                <div class="col-md-3 mb-4" v-for="(house, index) in FeedOfHouse" :key="index">
                    <sui-card class="content-house rounded-radius">
                        <sui-image :src="house.profile" class="rounded-top"/>
                        <p class="title-house">{{ house.created_at | OnlyDate }}</p>
                        <div class="overlay-house"></div>
                        <div class="button-house"><a href="javascript:void(0)" @click.prevent="findHouse(house.house_code)"> {{ $t('myPanel_card_footer_view') }} </a></div>
                        <sui-card-content>
                            <sui-card-header>{{ house.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })}}/{{ house.payment_METHOD }}</sui-card-header>
                            <sui-card-meta>{{ $t('announce_public_at') }} {{ house.created_at | OnlyDate }}</sui-card-meta>
                            <sui-card-description class="text-lowercase"
                            >{{ house.type }}, {{ house.room }} {{ $t('announce_form_room') }}, {{ house.living_room }} {{ $t('announce_form_living_room') }}, {{ house.bathroom }} {{ $t('announce_form_bathroom') }} .</sui-card-description
                            >                            
                        </sui-card-content>
                        <sui-card-content extra>
                            <sui-icon name="home" />
                            {{ $t('home_form_type') }}: <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t('home_form_type_long') }}</span> <span v-else class="font-weight-bold text-lowercase">{{ $t('home_form_type_short') }}</span> 
                        </sui-card-content>
                    </sui-card>
                </div>
            </div>
            
            <div class="row">
                <pagination :data="houses" @pagination-change-page="getResults"></pagination>
            </div>
        </div>        
    </div>
</template>

<script>

const cities = {
    Benguela: [
        {
            name:'Benguela',
            key: 1
        },
        {
            name:'Baia Farta',
            key: 2
        },
        {
            name:'Catumbela',
            key: 3
        },
        {
            name:'Lobito',
            key: 4
        },
        {
            name:'Ganda',
            key: 5
        },
        {
            name:'Bocoio ',
            key: 6
        },
     
        {
            name:'Balombo',
            key: 7
        },
        {
            name:'Chongoroi',
            key: 8
        },

        {
            name:'Caimbambo',
            key: 9
        },
        {
            name:'Cubal',
            key: 9
        },

    ],
    Bengo: [
        {
            name:'Caxito',
            key: 1
        },
        {
            name:'Dande',
            key: 2
        },
        {
            name:'Bula',
            key: 3
        },
        {
            name:'Atumba',
            key: 4
        },
        {
            name:'Dembos',
            key: 5
        },
        {
            name:'Nambuangongo',
            key: 6
        },
        {
            name:'Pango Aluquém',
            key: 7
        },
          

    ],
    Bié: [
        {
            name:'Cuito',
            key: 1
        },
        {
            name:'Andulo',
            key: 2
        },
        {
            name:'Chitembo',
            key: 3
        },
        {
            name:'Camacupa',
            key: 4
        },
        {
            name:'Chinguar',
            key: 5
        },
        {
            name:'Catabola',
            key: 6
        },
        {
            name:'Cunhinga',
            key: 7
        },
        {
            name:'Cuemba',
            key: 8
        },
        {
            name:'Nharêa',
            key: 9
        },

    ],
    Cabinda: [
        {
            name:'Cabinda',
            key: 1
        },
        
        {
            name:'Cacongo',
            key: 2
        },
        {
            name:'Belize',
            key: 2
        },
         {
            name:'Buco Zau',
            key: 2
        },

    ],
    'Cuando Cubango': [
        {
            name:'Menongue',
            key: 1
        },
        {
            name:'Mavinga',
            key: 2
        },
        {
            name:'Dirico',
            key: 3
        },
          {
            name:'Cuito Cuanavale',
            key: 4
        },
        {
            name:'Cuchi',
            key: 5
        },
        {
            name:'Rivungo',
            key: 6
        },
        {
            name:'Calai',
            key: 7
        },
        {
            name:'Changar',
            key: 8
        },
        {
            name:'Nancova',
            key: 9
        },
    ],
    'Cuanza Norte': [
        {
            name:'Ndalatando',
            key: 1
        },
        {
            name:'Cazengo',
            key: 2
        },
        {
            name:'Golungo Alto',
            key: 3
        },
        {
            name:'Cambambe',
            key: 4
        },
        {
            name:'Samba Cajú',
            key: 5
        },
        {
            name:'Ambaca',
            key: 6
        },
        {
            name:'Lucala',
            key: 7
        },
        {
            name:'Banga',
            key: 8
        },
        {
            name:'Bolongongo',
            key: 9
        },
        {
            name:'Quiculungo',
            key: 10
        },
        {
            name:'Ngonguembo',
            key: 11
        }

    ],
    'Cuanza Sul': [
        {
            name:'Sumbe',
            key: 1
        },
        {
            name:'Libolo',
            key: 2
        },
        {
            name:'Amboim',
            key: 3
        },
        {
            name:'Quibala',
            key: 4
        },
        {
            name:'Seles',
            key: 5
        },
        {
            name:'Cela',
            key: 6
        },
        {
            name:'Mussende',
            key: 7
        },
        {
            name:'Quilenda',
            key: 8
        },
        {
            name:'Ebo',
            key: 9
        },
        {
            name:'Conda',
            key: 10
        },
    ],
    Cunene: [
        {
            name:'Ombadja',
            key: 1
        },
        {
            name:'Cuanhama',
            key: 2
        },
        {
            name:'Curoca',
            key: 3
        },
        {
            name:'Cahama',
            key: 4
        },
        {
            name:'Cuvelai',
            key: 5
        },
        {
            name:'Namacunde',
            key: 6
        },
    ],
    Huambo: [
        {
            name:'Huambo',
            key: 1
        },
        {
            name:'Cáala',
            key: 2
        },
        {
            name:'Tchikala Tcholohanga',
            key: 3
        },
        {
            name:'Bailundo',
            key: 4
        },
        {
            name:'Ecunha',
            key: 5
        },
        {
            name:'Ukuma',
            key: 6
        },
        {
            name:'Longonjo',
            key: 7
        },
        {
            name:'Mungo',
            key: 8
        },
        {
            name:'Londouimbale',
            key: 9
        },
        {
            name:'Tchinjenje',
            key: 10
        }


    ],

    Huila: [
        {
            name:'Lubango',
            key: 1
        },
            {
            name:'Cacula',
            key: 2
        },
        {
            name:'Chibia',
            key: 3
        },
        {
            name:'Caconda',
            key: 4
        },
        {
            name:'Caluquembe',
            key: 5
        },
            {
            name:'Quilengues',
            key: 5
        },
        {
            name:'Cuvango',
            key: 6
        },
        {
            name:'Quipungo',
            key: 7
        },
         {
            name:'Matala',
            key: 8
        },
        {
            name:'Chicomba',
            key: 9
        },
           {
            name:'Jamba',
            key: 10
        },
        {
            name:'Chipindo',
            key: 11
        },
        {
            name:'Gambos',
            key: 12
        },
        {
            name:'Chipindo',
            key: 13
        },
        {
            name:'Humpata',
            key: 14
        },    
    
    ],
    Luanda: [
        {
            name:'Belas',
            key: 1
        },
        {
            name:'Cacuaco',
            key: 2
        },
        {
            name:'Cazenga',
            key: 3
        },
        {
            name:'Icolo e Bengo ',
            key: 4
        },
        {
            name:'Luanda',
            key: 5
        },
        {
            name:'Kilamba Kiaxi',
            key: 6
        },
        {
            name:'Quissama',
            key: 7
        },
        {
            name:'Talatona',
            key: 8
        },
        {
            name:'Viana',
            key: 9
        },
    ],
    'Lunda Norte': [
        {
            name:'Cuilo',
            key: 1
        },
          {
            name:'Caungula',
            key: 2
        },
        {
            name:'Chitato',
            key: 3
        },
        {
            name:'Lubalo',
            key: 4
        },
          {
            name:'Capenda Camulemba',
            key: 5
        },
        {
            name:'Cuango',
            key: 6
        },
        {
            name:'Lucapa',
            key: 7
        },
        {
            name:'Cambulo',
            key: 8
        },
        {
            name:'Xá Muteba',
            key: 9
        },
        {
            name:'Lóvua',
            key: 10
        },
    ],
    'Lunda Sul': [
        {
            name:'Saurimo',
            key: 1
        },
        {
            name:'Muconda',
            key: 2
        },
        {
            name:'Cocolo',key: 3
        },
        {
            name:'Dala',
            key: 4
        },
    ],
    Malanje: [
        {
            name:'Malanje',
            key: 1
        },
        {
            name:'Calandula',
            key: 2
        },
        {
            name:'Cacuso',
            key: 3
        },
        {
            name:'Massango',
            key: 4
        },
        {
            name:'Marimba',
            key: 5
        },
        {
            name:'Quiela',
            key: 6
        },
        {
            name:'Quirima',
            key: 7
        },
        {
            name:'Cangandala',
            key: 8
        },
        {
            name:'Cahombo',
            key: 9
        },
        {
            name:'Kunda dya Baze',
            key: 10
        },
        {
            name:'Cambundi Catembo',
            key: 11
        },
        {
            name:'Mucari',
            key: 12
        },
        {
            name:'Kiwaba Nzoji',
            key: 13
        },
        {
            name:'Luquembo',
            key: 14
        },
    ],
    Moxico: [
        {
            name:'Moxico',
            key: 1
        },
        {
            name:'Luchazes',
            key: 2
        },
        {
            name:'Alto Zambeze',
            key: 3
        },
        {
            name:'Bundas',
            key: 4
        },
        {
            name:'Luacano',
            key: 5
        },
        {
            name:'Cameia',
            key: 6
        },
        {
            name:'Camanongue',
            key: 7
        },
        {
            name:'Luau',
            key: 8
        },
        {
            name:'Léua',
            key: 9
        },
    ],
    Namibe: [
        {
            name:'Namibe',
            key: 1
        },
        {
            name:'Tombwa',
            key: 2
        },
        {
            name:'Virei',
            key: 3
        },
        {
            name:'Bibala',
            key: 4
        },
        {
            name:'Camucoio',
            key: 2
        }
    ],
    Uíge: [
        {
            name:'Uíge',
            key: 1
        },
        {
            name:'Dange - Quitexe',
            key: 2
        },
        {
            name:'Bungo',
            key: 3
        },
        {
            name:'Ambuíla',
            key: 4
        },
        {
            name:'Negage',
            key: 5
        },
        {
            name:'Púri',
            key: 6
        },
        {
            name:'Maquela do Zombo',
            key: 7
        },
        {
            name:'Damba',
            key: 8
        },
        {
            name:'Pombo',
            key: 9
        },
        {
            name:'Bembe',
            key: 10
        },
        {
            name:'Milunga',
            key: 11
        },
        {
            name:'Songo',
            key: 12
        },
        {
            name:'Quimbele',
            key: 13
        },
        {
            name:'Alto Cauale',
            key: 14
        },
          
        {
            name:'Mucaba',
            key: 15
        },
        {
            name:'Buengas',
            key: 16
        },
    ],
    Zaire: [
        {
            name:'Mbanza Congo',
            key: 1
        },
        {
            name:'Soyo',
            key: 2
        },
        {
            name:'Nzeto',
            key: 3
        },
        {
            name:'Tomboco',
            key: 4
        },
        {
            name:'Cuimba',
            key: 5
        },
        {
            name:'Nóqui',
            key: 6
        },
    ]
}

import Footer from '../components/Footer'
import Form from 'vform'
import axios from 'axios'
import Vue2Filters from 'vue2-filters'
import uniq from "lodash/uniq";
import sortedLastIndex from "lodash/sortedlastindex";
export default {
    components: {
        Footer,
    },
    middleware: 'auth',
    mixins: [Vue2Filters.mixin],

    metaInfo () {
        return { title: this.$t('home')}
    },
    data: () => ({
        title: window.config.appName,

        
        searches: '',
        SearchedResult:'',
        current: null,
        form: new Form({
            city:'',
            type: '',
            room: '',
            price: '',
            order: '',
        }),
        houses: {},
        src: 'images/announce/1.jpg',

        menuHeader: {
            icon: '',
            content: 'Header',
        },
        searchInMenu: {
            icon: 'search',
            iconPosition: 'left',
        },
        selectedValue: null,
        options: [
            {
                key: 'Important',
                text: 'Important',
                value: 'Important',
                label: { color: 'red', empty: true, circular: true },
            },
            {
                key: 'Announcement',
                text: 'Announcement',
                value: 'Announcement',
                label: { color: 'blue', empty: true, circular: true },
            },
            {
                key: 'Cannot Fix',
                text: 'Cannot Fix',
                value: 'Cannot Fix',
                label: { color: 'black', empty: true, circular: true },
            },
        ],
        current: null,
        skills: [
            { key: 'angular', text: 'Angular', value: 'angular' },
            { key: 'css', text: 'CSS', value: 'css' },
            { key: 'design', text: 'Graphic Design', value: 'design' },
            { key: 'ember', text: 'Ember', value: 'ember' },
            { key: 'html', text: 'HTML', value: 'html' },
            { key: 'ia', text: 'Information Architecture', value: 'ia' },
            { key: 'javascript', text: 'Javascript', value: 'javascript' },
            { key: 'mech', text: 'Mechanical Engineering', value: 'mech' },
            { key: 'meteor', text: 'Meteor', value: 'meteor' },
            { key: 'node', text: 'NodeJS', value: 'node' },
            { key: 'plumbing', text: 'Plumbing', value: 'plumbing' },
            { key: 'python', text: 'Python', value: 'python' },
            { key: 'rails', text: 'Rails', value: 'rails' },
            { key: 'react', text: 'React', value: 'react' },
            { key: 'repair', text: 'Kitchen Repair', value: 'repair' },
            { key: 'ruby', text: 'Ruby', value: 'ruby' },
            { key: 'ui', text: 'UI Design', value: 'ui' },
            { key: 'ux', text: 'User Experience', value: 'ux' },
        ],
        cities: cities,
        casas: {},
        examples: {
            data:[
            {
                name:"available",
                key: 1
            },
            {
                name:"occupied",
                key: 2
            }
        ]},
        province:'',
        countyFilter: [],
        houseTypeFilter:[],
        filters: [],
        roomFilter: [],
        stateFilter: [],
        execution: [],
        FreeStateOrBusy: '',
        shortAndLongPeriod: '',
        sortAsc: true,
        hasMainFeed: true,
        Whichlocal: "",
        recent: false,
        checkboxes: false,
        expanded: false,
        priceInputValue: "0",   // initial input value
        priceInput: {           // slider values
            0: "1,000",
            1: "1,250",
            2: "1,500",
            3: "2,000",
            4: "2,500",
            5: "3,500",
            6: "6,000",
            7: "15,000",
            8: "50,000",
            9: "50,000+"
        },
        priceOutput: {          // output values
        plan1: {
            0: ["", "Free", ""],
            1: ["$", "13", "/m"],
            2: ["$", "17", "/m"],
            3: ["$", "21", "/m"],
            4: ["$", "25", "/m"],
            5: ["$", "42", "/m"],
            6: ["$", "58", "/m"],
            7: ["$", "117", "/m"],
            8: ["$", "208", "/m"],
            9: ["", "Contact Us", ""]
        }
        }
    }),
    methods: {
        handleSliderValuePosition(input) {
            const multiplier = input.value / input.max;
            const thumbOffset = this.thumbSize * multiplier;
            const priceInputOffset =
                (this.thumbSize - this.$refs.sliderValue.clientWidth) / 2;
            this.$refs.sliderValue.style.left =
                input.clientWidth * multiplier - thumbOffset + priceInputOffset + "px";
        },
        getPricingData(obj, pos) {
            return pos !== undefined
                ? obj[this.priceInputValue][pos]
                : obj[this.priceInputValue];
        },
        UncheckAllType: function () {
            this.houseTypeFilter= []
        },
        UncheckAllCount: function(){
            this.countyFilter = '';
        },
        UncheckAllRoom: function(){
            this.roomFilter = [];
        },
        UncheckAllState: function() {
            this.FreeStateOrBusy = false;
        },
        UncheckAllPeriod: function () {
            this.shortAndLongPeriod = false
        },
        uncheckCC: function(){
            this.countyFilter = ''
            this.province = false
        },
        toggleExecFilter: function (newExec) {
            this.execution = !this.execution.includes(newExec)
            ? [...this.execution, newExec]
            : this.execution.filter((filter) => filter !== newExec);
        },
        toggleStateFilter: function (newState) {
        this.stateFilter = !this.stateFilter.includes(newState)
            ? [...this.stateFilter, newState]
            : this.stateFilter.filter((filter) => filter !== newState);
        },
        toggleCountyFilter: function (newCounty) {
        this.countyFilter = !this.countyFilter.includes(newCounty)
            ? [...this.countyFilter, newCounty]
            : this.countyFilter.filter((filter) => filter !== newCounty);
        },
        toggleFilter: function (newFilter) {
        this.filters = !this.filters.includes(newFilter)
            ? [...this.filters, newFilter]
            : this.filters.filter((filter) => filter !== newFilter);
        },
        findHouse(houseKey){this.$router.push('find/' + houseKey)},
        
        getResults(page = 1) {
            axios.get("api/searched-houses/?page=" + page).then((response) => {
                this.houses = response.data;
            });
        },
        searchinger(){
            let query = this.searches;
            
            axios.get('api/search-houser?q=' + query)
            .then((data) => {
                this.houses = data.data
                if (this.houses.length === '') {
                    this.SearchedResult = "Nao existes";
                    console.log(this.result);
                }     
            })
            .catch(()=>{
                    Swal.fire("Failed", "There was something wrong, while you where searching.", "error");
            }) 
        },
        async loadHouses() {
            try {
                const response = await fetch('api/searched-houser')
                const result = await response.json()
                this.houses = result
                //console.log(this.houses)
            }catch (error){
                console.log(error)
            }
             
        },
        showCheckboxes() {
            //var expanded = false;
            //var checkboxes = document.getElementById("checkboxes");
            if (!this.expanded) {
                this.checkboxes = true;
                this.expanded = true;
            } else {
                this.checkboxes = false;
                this.expanded = false;
            }
        }
    },
    
    computed: {
        counties () {
            if (!this.province) {
                return
            }
            return this.cities[this.province].map(city => {
                return city.name
            })
        },
        matchedhouse() {
            let result = this.houses.data;
            if (this.countyFilter.length) {
                return this.countyFilter.length
                ? this.houses.data.filter((house) =>
                    this.countyFilter.some((filter) => house.county.match(filter))
                    )
                : this.houses.data;
            } else if (this.province.length) {
                return this.province.length
                ? this.houses.data.filter((house) => house.city.match(this.province)
                    )
                : this.houses.data;
            }
            else if (this.filters.length) {
                return this.filters.length
                ? this.houses.data.filter((house) =>
                    this.filters.some((filter) => house.period.match(filter))
                    )
                : this.houses.data;
            } else if (this.stateFilter.length) {
                return this.stateFilter.length
                ? this.houses.data.filter((house) =>
                    this.stateFilter.some((filter) => house.state.match(filter))
                    )
                : this.houses;
            } else if (this.execution.length) {
                return this.execution.length
                ? this.houses.data.filter((example) =>
                    this.execution.some((filter) => example.state.match(filter))
                    )
                : this.houses.data;
            }else if (this.FreeStateOrBusy.length) {
                //this.FreeStateOrBusy = this.FreeStateOrBusy
                //const FreeStateOrBusy =Array.from(this.FreeStateOrBusy)
                return this.FreeStateOrBusy.length
                ? this.houses.data.filter((house) => house.state.match(this.FreeStateOrBusy)
                    )
                : this.houses.data;
            }else if (this.shortAndLongPeriod.length) {
                return this.shortAndLongPeriod.length
                ? this.houses.data.filter((house) => house.period.match(this.shortAndLongPeriod)
                    )
                : this.houses.data;
            } else if (this.houseTypeFilter.length) {
                return this.houseTypeFilter.length
                ? this.houses.data.filter((house) =>
                    this.houseTypeFilter.some((filter) => house.type.match(filter))
                    )
                : this.houses;
            } else {
                if (this.houses.data) return this.orderBy(this.houses.data, "created_at", -1);
            }
        },   
        orderByItem() {
            if (this.recent) {
                this.hasMainFeed = false;
                if (this.houses.data) return this.orderBy(this.houses.data, "created_at", -1);
            } else {
                if (this.houses.data) return this.orderBy(this.houses.data, "created_at");
            }
        },

        ExecFilters() {
            if (this.houses.data) {
                return this.houses.data
                
                .map(({ state }) => state)
                .filter((value, index, self) => self.indexOf(value) === index);
            }
        },
        periodFilters() {
            if (this.houses.data) {
                return this.houses.data
                
                .map(({ period }) => period)
                .filter((value, index, self) => self.indexOf(value) === index);
            }
        },  
        roomFilters() {
        if (this.houses.data)
            //return uniq(this.jobs.data.map(({ experience }) => experience))
            return this.houses.data
            .map(({ room }) => room)
            .filter((value, index, self) => self.indexOf(value) === index);
        },
        stateFilters() {
        if (this.houses.data)
            //return uniq(this.jobs.data.map(({ experience }) => experience))
            return this.houses.data
            .map(({ state }) => state)
            .filter((value, index, self) => self.indexOf(value) === index);
        },
        FeedOfHouse() {
        if (this.recent) {
            this.hasMainFeed = false;
            if (this.matchedhouse) return this.orderBy(this.matchedhouse, "created_at", -1);
        } else {
            if (this.matchedhouse) return this.orderBy(this.matchedhouse, "created_at");
        }
        //return this.matchedhouse.sort(/* something here */);
        },  
    },
    created(){
        this.loadHouses();
    },
    mounted() {
        this.$refs.slider.setAttribute("min", 0);
        this.$refs.slider.setAttribute(
            "max",
            Object.keys(this.priceInput).length - 1
        );
        this.thumbSize = parseInt(
        window
            .getComputedStyle(this.$refs.sliderValue)
            .getPropertyValue("--thumb-size"),
        10
        );
        this.handleSliderValuePosition(this.$refs.slider);
    }
}
</script>
<style lang="scss">
    
    .rounded-radius {
    border-radius: 2em !important;
    //cursor: pointer;
    }
    .ui.card > :first-child,
    .ui.cards > .card > :first-child {
    border-radius: 1.9rem 1.9rem 0 0 !important;
    border-top: none !important;
    }
    .checkbox-btn {
    position: relative;
    }

    .checkbox-btn input {
    position: absolute;
    z-index: -1;
    opacity: 0;
    }

    .checkbox-btn input:checked ~ .btn {
    border-color: #3167eb;
    background-color: #3167eb;
    color: #fff;
    }

    .btn-light {
    display: inline-block;
    font-weight: 600;
    color: #343a40;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: #eee;
    border: 1px solid #eee;
    padding: 0.45rem 0.85rem;
    font-size: 10px;
    line-height: 1.5;
    border-radius: 0.37rem;
    }



    /* .multiselect {
        width: 200px;
    } */

   /*  .selectBox {
    position: relative;
    } */

    .selectBox select {
    width: 100%;
    font-weight: bold;
    }

    .overSelect {
        position: relative;
    }

    #checkboxes {
        //display: none;
        position: absolute;
        left: 0;
        right: 0;
        top: 0px;
        background: rgb(255, 255, 255);
        border: 1px #dadada solid;
        color: brown;
        
    }

    #checkboxes label {
    display: block;
    }

    #checkboxes label:hover {
    background-color: #1e90ff;
    }

    

    label.radio {
        cursor: pointer
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.radio span {
        /* padding: 3px 9px; */
        /* border: 1px solid #dc3545; */
        display: inline-block;
        color: #dc3545;
        /* border-radius: 5px; */
        /* font-size: 11px; */
        text-transform: uppercase
    }

    label.radio input:checked+span {
        border-color: #dc3545;
        background-color: #dc3545;
        color: #fff
    }

    /* CITY AND COUTIES */
    label.cities {
        cursor: pointer
    }

    label.cities input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.cities i.icon {
        display: none;
    }
    label.cities:hover i.icon{
        display: inline-block;
        text-transform: uppercase
    }
    
    label.cities input:checked+span.city {
        color: #dc3545;
        
    }
    label.cities input:checked+span.city i.icon{
        display: inline-block;
        color: #dc3545;
        
    }
    input[type="range"] {
        -moz-appearance: none;
        -webkit-appearance: none;
        background: #eef1f6;
        border-radius: 3px;
        height: 6px;
        width: 100%;
        margin-top: 15px;
        margin-bottom: 15px;
        outline: none;
    }
    input[type="range"]::-webkit-slider-thumb {
        appearance: none;
        -webkit-appearance: none;
        background-color: #5f48ff;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2212%22%20height%3D%228%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M8%20.5v7L12%204zM0%204l4%203.5v-7z%22%20fill%3D%22%23FFFFFF%22%20fill-rule%3D%22nonzero%22%2F%3E%3C%2Fsvg%3E");
        background-position: center;
        background-repeat: no-repeat;
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        height: 36px;
        width: 36px;
    }
    input[type="range"]::-moz-range-thumb {
        background-color: #5f48ff;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2212%22%20height%3D%228%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M8%20.5v7L12%204zM0%204l4%203.5v-7z%22%20fill%3D%22%23FFFFFF%22%20fill-rule%3D%22nonzero%22%2F%3E%3C%2Fsvg%3E");
        background-position: center;
        background-repeat: no-repeat;
        border: 0;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        height: 36px;
        width: 36px;
    }
    input[type="range"]::-ms-thumb {
        background-color: #5f48ff;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2212%22%20height%3D%228%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M8%20.5v7L12%204zM0%204l4%203.5v-7z%22%20fill%3D%22%23FFFFFF%22%20fill-rule%3D%22nonzero%22%2F%3E%3C%2Fsvg%3E");
        background-position: center;
        background-repeat: no-repeat;
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        height: 36px;
        width: 36px;
    }
    input[type="range"]::-moz-focus-outer {
        border: 0;
    }

    .pricing-slider {
        max-width: 280px;
        margin: 0 auto;
    }

    .form-slider span {
        display: block;
        font-weight: 500;
        text-align: center;
        margin-bottom: 16px;
    }

    .pricing-slider {
        margin-bottom: 48px;
    }

    .pricing-slider {
        max-width: 280px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
    }
    .pricing-slider input {
        width: 100%;
    }
    .pricing-slider .pricing-slider-value {
        position: absolute;
        font-size: 14px;
        line-height: 22px;
        font-weight: 500;
        color: #909cb5;
        margin-top: 8px;
        --thumb-size: 36px;
    }
    .pricing-items {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-right: -12px;
        margin-left: -12px;
        margin-top: -12px;
    }
    .pricing-item {
        flex-basis: 280px;
        max-width: 280px;
        box-sizing: content-box;
        padding: 12px;
    }
    .pricing-item-inner {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        height: 100%;
        padding: 24px;
        box-shadow: 0 8px 16px rgba(46, 52, 88, 0.16);
    }
    .pricing-item-title {
        font-weight: 500;
    }
    .pricing-item-price {
        display: inline-flex;
        align-items: baseline;
        font-size: 20px;
    }
    .pricing-item-price-amount {
        font-size: 36px;
        line-height: 48px;
        font-weight: 500;
        color: #191e2a;
    }
    .pricing-item-features-list {
        list-style: none;
        padding: 0;
    }
    .pricing-item-features-list li {
        margin-bottom: 0;
        padding: 14px 0;
        position: relative;
        display: flex;
        align-items: center;
    }
    .pricing-item-features-list li::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        display: block;
        height: 1px;
        background: #e9ecf8;
    }
    .pricing-item-features-list li::after {
        content: "";
        display: block;
        width: 24px;
        height: 24px;
        margin-right: 12px;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%2011h14v2H5z%22%20fill%3D%22%239298B8%22%20fill-rule%3D%22nonzero%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        -webkit-box-ordinal-group: 0;
        order: -1;
    }
    .pricing-item-features-list li.is-checked::after {
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill-rule%3D%22nonzero%22%20fill%3D%22none%22%3E%3Ccircle%20fill%3D%22%2300C2A9%22%20cx%3D%2212%22%20cy%3D%2212%22%20r%3D%2212%22%2F%3E%3Cpath%20fill%3D%22%23fff%22%20d%3D%22M10.5%2012.267l-2.5-1.6-1%201.066L10.5%2016%2017%209.067%2016%208z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    }

    
    .bg-main{
        
        background-color: #FF5859;
    }

    


    .content-house {
        position: relative;
    }

    .overlay-house {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 2em!important;
        background: rgba(0, 0, 0, 0);
        transition: background 0.5s ease;
    }

    .content-house:hover .overlay-house {
        display: block;
        background: rgba(0, 0, 0, 0.473);
    }

    .content-house .image-house {
        position: absolute;
        /* width: 500px;
        height: 300px;
        left: 0; */
        }

    .title-house {
        position: absolute;
        /* width: 500px; */
        width: 100%;
        left: 0;
        top: 120px;
        font-weight: 700;
        font-size: 30px;
        text-align: center;
        text-transform: uppercase;
        color: white;
        z-index: 1;
        transition: top .5s ease;
        }

    .content-house:hover .title-house {
        top: 90px;
        }

    .button-house {
        position: absolute;
        /* width: 500px; */
        width: 100%;
        left:0;
        top: 180px;
        text-align: center;
        opacity: 0;
        transition: opacity .35s ease;
    }

    .button-house a {
        width: 200px;
        padding: 12px 48px;
        text-align: center;
        color: white;
        border: solid 2px white;
        z-index: 1;
    }

    .content-house:hover .button-house {
        opacity: 1;
    }
</style>