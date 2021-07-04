<template>
  <div class="container-fluid m-0 pl-0 pr-0">
    <Navout />

    <nav class="navbar navbar-expand navbar-light shadow-none  my-3 hidden-xs-down hidden-sm-down">
      <div class="container">
        <ul class="navbar-nav mr-auto my-2 my-lg-0">
          <li class="nav-item hidden-md-down">
            <a href="javascript:void(0)" class="nav-link text-uppercase"><i class="mix icon" /> {{ $t("search_filter") }}</a>
          </li>
          <!-- CITIES -->
          <li class="nav-item dropdown hidden-xs-down hidden-sm-down">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $t("search_province") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <label v-for="(city, index) in Object.keys(cities)" :key="index" class="dropdown-item cities">
                <input v-model="province" :value="city" type="radio" class="custom-control-input">
                <span class="city"><i class="angle double right icon" />{{ city }}</span>
              </label>
              <div v-if="counties" class="dropdown-divider" />
              <a v-if="counties" href="javascript:(0)" class="dropdown-item" @click.prevent="uncheckCC()">
                <i class="check square outline icon" />
                {{ $t("search_uncheck") }}
              </a>
            </div>
          </li>
          <!-- COUNTIES -->
          <li class="nav-item dropdown hidden-xs-down hidden-sm-down">
            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $t("announce_form_county") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div v-for="(county, index) in counties" :key="index" class="dropdown-item">
                <label class="custom-control">
                  <input type="checkbox" :checked="countyFilter.includes(county)" class="custom-control-input" @change="toggleCountyFilter(county)">
                  <div class="custom-control-label">{{ county }}</div>
                </label>
              </div>
              <a v-if="!counties" class="dropdown-item">{{ $t("search_choose_first_city") }}</a>
              <div v-if="counties" class="dropdown-divider" />
              <a v-if="counties" href="javascript:(0)" class="dropdown-item" @click.prevent="UncheckAllCount()"><i class="check square outline icon" /> {{ $t("search_uncheck") }}</a>
            </div>
          </li>
          <!-- HOUSE TYPE -->
          <li class="nav-item dropdown hidden-xs-down hidden-sm-down">
            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              {{ $t("announce_form_type") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="outhouse">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_outhouse") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Apartamento">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_apart") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Vivenda">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_house") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Albergue">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_albergue") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="guesthouse">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_Hospedaria") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Hotel">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_hotel") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Hostel">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_hostel") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Motel">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_motel") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Lodge">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_pousada") }}
                  </div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Pension">
                  <div class="custom-control-label">
                    {{ $t("annou_form_type_pension") }}
                  </div>
                </label>
              </a>

              <div v-if="houseTypeFilter" class="dropdown-divider" />
              <a v-if="houseTypeFilter" class="dropdown-item" href="javascript:(0)" @click.prevent="UncheckAllType()"><i class="check square outline icon" /> {{ $t("search_uncheck") }}</a>
            </div>
          </li>
          <!-- PRICES -->
          <li class="nav-item dropdown hidden-xs-down hidden-sm-down">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $t('home_form_payment') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div class="pricing-slider center-content">
                <label class="form-slider">
                  <span>{{ $t('Type_price_you_need_to_se') }}</span>
                  <input v-model="range" type="range" min="0" max="9999999999" step="2">
                </label>
                <div class="pricing-slider-value small px-2">
                  <small>{{ range | currency("AKZ", 2, { spaceBetweenAmountAndSymbol: true }) }}</small>
                </div>
              </div>
              <div class="pricing-item-price px-2">
                <input v-model="range" type="number" class="form-control" :run="!range ? range = 2 : true" :placeholder="$t('Type_price')">
              </div>
            </div>
          </li>
          <!-- ROOM -->
          <li class="nav-item dropdown hidden-xs-down hidden-sm-down">
            <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $t("announce_form_room") }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="roomFilter" type="checkbox" value="1" class="custom-control-input">
                  <div class="custom-control-label">1</div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="roomFilter" type="checkbox" value="2" class="custom-control-input">
                  <div class="custom-control-label">2</div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="roomFilter" type="checkbox" value="3" class="custom-control-input">
                  <div class="custom-control-label">3</div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="roomFilter" type="checkbox" value="4" class="custom-control-input">
                  <div class="custom-control-label">4</div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="roomFilter" type="checkbox" value="5" class="custom-control-input">
                  <div class="custom-control-label">5</div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <label class="custom-control">
                  <input v-model="roomFilter" type="checkbox" value="6" class="custom-control-input">
                  <div class="custom-control-label">6</div>
                </label>
              </a>
              <a class="dropdown-item" href="javascript:void(0)">
                <div class="form-group">
                  <input v-model="customRoom" type="number" class="form-control" :run="!customRoom ? customRoom = 1 : true" min="1" max="99">
                </div>
              </a>
              <div v-if="roomFilter" class="dropdown-divider" />
              <a v-show="roomFilter" href="javascript:(0)" class="dropdown-item" @click.prevent="UncheckAllRoom()"> <i class="check square outline icon" /> {{ $t("search_uncheck") }}</a>
            </div>
          </li>
        </ul>
        <div class="my-2 w-50 position-relative">
          <div class="input-group">
            <input id="job" v-model="searches" type="text" auto-complete="off" class="form-control badge-pill" :placeholder="$t('search_for')" aria-describedby="button-addon2" @keyup.prevent="searchinger">
            <div class="input-group-append">
              <button id="button-addon2" type="button" class="btn bg-main badge-pill px-5">
                <i class="search icon" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- Responsive Menu  -->
    <nav class="navbar navbar-expand navbar-light shadow-none my-3 d-md-none">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
          <input v-model="searches" type="text" auto-complete="off" class="form-control w-100 mr-2" :placeholder="$t('search_for')" @keyup.prevent="searchinger">
          <button class="btn btn-sm" type="button" :class="[showMenu ? 'bg-main' : 'bg-light']" @click="showMenu = ! showMenu">
            <i class="mdi mdi-menu" :class="{ 'text-white': showMenu }" />
          </button>
        </div>
      </div>
    </nav>
    <transition name="fade">
      <div v-if="showMenu" class="container shadow-none  my-3 d-md-none">
        <sui-accordion is="sui-menu" :active-index="1" vertical exclusive styled>
          <!-- CITIES -->
          <sui-accordion-title is="sui-menu-header" active>
            <sui-icon name="dropdown" />
            {{ $t("search_province") }}
          </sui-accordion-title>
          <sui-accordion-content active>
            <sui-form>
              <sui-form-field v-for="(city, index) in Object.keys(cities)" :key="index">
                <sui-checkbox v-model="province" radio :value="city" :label="city" class="city" />
              </sui-form-field>
              <sui-form-field v-if="counties">
                <div class="dropdown-divider" />
                <a v-if="counties" href="javascript:(0)" class="dropdown-item" @click.prevent="uncheckCC()">
                  <i class="check square outline icon" />
                  {{ $t("search_uncheck") }}
                </a>
              </sui-form-field>
            </sui-form>
          </sui-accordion-content>
          <!-- COUNTIES -->
          <sui-accordion-title is="sui-menu-header">
            <sui-icon name="dropdown" />
            {{ $t("announce_form_county") }}
          </sui-accordion-title>
          <sui-accordion-content>
            <sui-form>
              <sui-form-field v-for="(county, index) in counties" :key="index">
                <sui-checkbox :label="county" :checked="countyFilter.includes(county)" @change="toggleCountyFilter(county)" />
              </sui-form-field>
              <sui-form-field v-if="!counties">
                {{ $t("search_choose_first_city") }}
              </sui-form-field>
              <div v-if="counties" class="dropdown-divider" />
              <sui-form-field v-if="counties">
                <a href="javascript:(0)" class="dropdown-item" @click.prevent="UncheckAllCount()"><i class="check square outline icon" /> {{ $t("search_uncheck") }}</a>
              </sui-form-field>
            </sui-form>
          </sui-accordion-content>

          <!-- HOUSE TYPE -->
          <sui-accordion-title is="sui-menu-header">
            <sui-icon name="dropdown" />
            {{ $t("announce_form_type") }}
          </sui-accordion-title>
          <sui-accordion-content>
            <sui-form>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_outhouse')" value="outhouse" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_apart')" value="Apartamento" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_house')" value="Vivenda" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_albergue')" value="Albergue" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_Hospedaria')" value="guesthouse" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_hotel')" value="Hotel" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_hostel')" value="Hostel" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_motel')" value="Motel" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_pousada')" value="Lodge" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_type_pension')" value="Pension" />
              </sui-form-field>
              <sui-form-field v-if="houseTypeFilter">
                <div class="dropdown-divider" />
                <a class="dropdown-item" href="javascript:(0)" @click.prevent="UncheckAllType()"><i class="check square outline icon" /> {{ $t("search_uncheck") }}</a>
              </sui-form-field>
            </sui-form>
          </sui-accordion-content>
          <!-- PRICES -->
          <sui-accordion-title is="sui-menu-header">
            <sui-icon name="dropdown" />
            {{ $t('home_form_payment') }}
          </sui-accordion-title>
          <sui-accordion-content>
            <sui-form>
              <sui-form-field>
                <label class="form-slider">
                  <span>{{ $t('Type_price_you_need_to_se') }}</span>
                  <input v-model="range" type="range" min="0" max="9999999999" step="2">
                </label>
                <div class="pricing-slider-value small px-2">
                  <small>{{ range | currency("AKZ", 2, { spaceBetweenAmountAndSymbol: true }) }}</small>
                </div>
              </sui-form-field>
              <sui-form-field>
                <input v-model="range" type="number" class="form-control" :placeholder="$t('Type_price')">
              </sui-form-field>
            </sui-form>
          </sui-accordion-content>

          <sui-accordion-title is="sui-menu-header">
            <sui-icon name="dropdown" />
            {{ $t("announce_form_room") }}
          </sui-accordion-title>
          <sui-accordion-content>
            <sui-form>
              <sui-form-field>
                <sui-checkbox v-model="roomFilter" :label="'1 - ' + $t('announce_form_room')" value="1" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="roomFilter" :label="'2 - ' + $t('announce_form_rooms')" value="2" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="roomFilter" :label="'3 - ' + $t('announce_form_rooms')" value="3" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="roomFilter" :label="'4 - ' + $t('announce_form_rooms')" value="4" />
              </sui-form-field>
              <sui-form-field>
                <sui-checkbox v-model="roomFilter" :label="'5 - ' + $t('announce_form_rooms')" value="5" />
              </sui-form-field>
              <sui-form-field>
                <input v-model="customRoom" type="number" class="form-control" :run="!customRoom ? customRoom = 1 : true" min="1" max="99">
              </sui-form-field>
              <sui-form-field v-if="roomFilter">
                <a href="javascript:(0)" class="dropdown-item" @click.prevent="UncheckAllRoom()"> <i class="check square outline icon" /> {{ $t("search_uncheck") }}</a>
              </sui-form-field>
            </sui-form>
          </sui-accordion-content>
        </sui-accordion>
      </div>
    </transition>

    <div class="container mt-2">
      <!-- Order button -->
      <div class="row my-0 py-0">
        <div class="col-md-12 grid-margin">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
              <div class="mr-md-3">
                <h2>{{ $t("search_filter") }},</h2>
                <p class="mb-md-0">
                  {{ $t('search_search_precision') }}
                </p>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0" :class="{ 'bg-danger': recent }" @click="recent = !recent">
                <i class="mdi mdi-minus text-muted" />
              </button>
              <button type="button" class="btn btn-light bg-white btn-icon mt-2 mt-xl-0" :class="{ 'bg-danger': recent }" @click="recent = !recent">
                <i class="mdi mdi-plus text-muted" />
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Implemented filter -->
      <div class="row p-2 mb-2">
        <div class="mr-2">
          <a is="sui-label" v-if="province" size="tiny">
            {{ province }}
            <sui-icon name="delete" @click="uncheckCC" />
          </a>
          <!-- <span v-if="province" class="font-weight-bold">
            <small><a href="javascript:void(0)"><i class="close icon text-muted" @click="uncheckCC" /></a></small>
            <strong>{{ province }}</strong>
          </span> -->
          <span v-if="countyFilter != '' || province != false">
            <a is="sui-label" v-for="county in countyFilter" :key="county" size="tiny">
              {{ county }}
              <sui-icon name="delete" @click="uncheckCounty(county)" />
            </a>
          </span>
        </div>
        <div class="mr-2">
          <a is="sui-label" v-for="house_type in houseTypeFilter" :key="house_type" color="grey" size="tiny">
            {{ house_type }}
            <sui-icon name="delete" @click="uncheckTypesHouse(house_type)" />
          </a>
        </div>
        <div class="mr-2">
          <a is="sui-label" v-for="room in roomFilter" :key="room" color="grey" size="tiny">
            {{ room }} - {{ $t('announce_form_rooms') }}
            <sui-icon name="delete" @click="uncheckRoom(room)" />
          </a>
        </div>
        <!-- <div class="mr-2">
          <span v-if="customRoom != ''">
            <small><a href="javascript:void(0)"><i class="close icon text-muted" @click="UncheckCostRoom" /></a></small>
            <strong><i class="caret right icon" />{{ $t("announce_form_room") }}<small>(Qtd)</small></strong>
            <span class="d-inline text-muted"><em>{{ customRoom }}, </em></span>
          </span>
        </div> -->
        <hr>
      </div>
      <!-- Print houses -->
      <div class="row">
        <div v-for="(house, index) in FeedOfHouse" :key="index" class="col-md-3 col-sm-6 mb-4">
          <sui-card class="content-house rounded-radius w-100">
            <sui-image :src="house.profile" class="rounded-top image-house" />
            <!-- <p class="title-house">
              {{ house.created_at | OnlyDate }}
            </p> -->
            <div class="overlay-house" />
            <div class="button-house">
              <a href="javascript:void(0)" @click.prevent="findHouse(house.house_code)">
                {{ $t("myPanel_card_footer_view") }}
              </a>
            </div>
            <sui-card-content>
              <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} / {{ house.payment_METHOD }}</sui-card-header>
              <sui-card-meta>{{ $t("announce_public_at") }} {{ house.created_at | OnlyDate }}</sui-card-meta>
              <sui-card-description class="text-lowercase">
                {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                {{ house.living_room }} {{ $t("announce_form_living_room") }},
                {{ house.bathroom }}
                {{ $t("announce_form_bathroom") }} .
              </sui-card-description>
            </sui-card-content>
            <sui-card-content extra>
              <sui-icon name="home" />
              <!-- {{ $t("home_form_type") }}:
              <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
              <span v-else class="font-weight-bold text-lowercase">
                {{ $t("home_form_type_short") }}
              </span> -->
              {{ house.county }} - {{ house.city }}
            </sui-card-content>
          </sui-card>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="row">
        <pagination :data="houses" @pagination-change-page="getResults" />
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import Vue2Filters from 'vue2-filters'
import Navout from '~/components/Navout'

const cities = {
  Benguela: [
    {
      name: 'Benguela',
      key: 1
    },
    {
      name: 'Baia Farta',
      key: 2
    },
    {
      name: 'Catumbela',
      key: 3
    },
    {
      name: 'Lobito',
      key: 4
    },
    {
      name: 'Ganda',
      key: 5
    },
    {
      name: 'Bocoio',
      key: 6
    },

    {
      name: 'Balombo',
      key: 7
    },
    {
      name: 'Chongoroi',
      key: 8
    },

    {
      name: 'Caimbambo',
      key: 9
    },
    {
      name: 'Cubal',
      key: 10
    }
  ],
  Bengo: [
    {
      name: 'Caxito',
      key: 1
    },
    {
      name: 'Dande',
      key: 2
    },
    {
      name: 'Bula',
      key: 3
    },
    {
      name: 'Atumba',
      key: 4
    },
    {
      name: 'Dembos',
      key: 5
    },
    {
      name: 'Nambuangongo',
      key: 6
    },
    {
      name: 'Pango Aluquém',
      key: 7
    }
  ],
  Bié: [
    {
      name: 'Cuito',
      key: 1
    },
    {
      name: 'Andulo',
      key: 2
    },
    {
      name: 'Chitembo',
      key: 3
    },
    {
      name: 'Camacupa',
      key: 4
    },
    {
      name: 'Chinguar',
      key: 5
    },
    {
      name: 'Catabola',
      key: 6
    },
    {
      name: 'Cunhinga',
      key: 7
    },
    {
      name: 'Cuemba',
      key: 8
    },
    {
      name: 'Nharêa',
      key: 9
    }
  ],
  Cabinda: [
    {
      name: 'Cabinda',
      key: 1
    },

    {
      name: 'Cacongo',
      key: 2
    },
    {
      name: 'Belize',
      key: 2
    },
    {
      name: 'Buco Zau',
      key: 2
    }
  ],
  'Cuando Cubango': [
    {
      name: 'Menongue',
      key: 1
    },
    {
      name: 'Mavinga',
      key: 2
    },
    {
      name: 'Dirico',
      key: 3
    },
    {
      name: 'Cuito Cuanavale',
      key: 4
    },
    {
      name: 'Cuchi',
      key: 5
    },
    {
      name: 'Rivungo',
      key: 6
    },
    {
      name: 'Calai',
      key: 7
    },
    {
      name: 'Changar',
      key: 8
    },
    {
      name: 'Nancova',
      key: 9
    }
  ],
  'Cuanza Norte': [
    {
      name: 'Ndalatando',
      key: 1
    },
    {
      name: 'Cazengo',
      key: 2
    },
    {
      name: 'Golungo Alto',
      key: 3
    },
    {
      name: 'Cambambe',
      key: 4
    },
    {
      name: 'Samba Cajú',
      key: 5
    },
    {
      name: 'Ambaca',
      key: 6
    },
    {
      name: 'Lucala',
      key: 7
    },
    {
      name: 'Banga',
      key: 8
    },
    {
      name: 'Bolongongo',
      key: 9
    },
    {
      name: 'Quiculungo',
      key: 10
    },
    {
      name: 'Ngonguembo',
      key: 11
    }
  ],
  'Cuanza Sul': [
    {
      name: 'Sumbe',
      key: 1
    },
    {
      name: 'Libolo',
      key: 2
    },
    {
      name: 'Amboim',
      key: 3
    },
    {
      name: 'Quibala',
      key: 4
    },
    {
      name: 'Seles',
      key: 5
    },
    {
      name: 'Cela',
      key: 6
    },
    {
      name: 'Mussende',
      key: 7
    },
    {
      name: 'Quilenda',
      key: 8
    },
    {
      name: 'Ebo',
      key: 9
    },
    {
      name: 'Conda',
      key: 10
    }
  ],
  Cunene: [
    {
      name: 'Ombadja',
      key: 1
    },
    {
      name: 'Cuanhama',
      key: 2
    },
    {
      name: 'Curoca',
      key: 3
    },
    {
      name: 'Cahama',
      key: 4
    },
    {
      name: 'Cuvelai',
      key: 5
    },
    {
      name: 'Namacunde',
      key: 6
    }
  ],
  Huambo: [
    {
      name: 'Huambo',
      key: 1
    },
    {
      name: 'Cáala',
      key: 2
    },
    {
      name: 'Tchikala Tcholohanga',
      key: 3
    },
    {
      name: 'Bailundo',
      key: 4
    },
    {
      name: 'Ecunha',
      key: 5
    },
    {
      name: 'Ukuma',
      key: 6
    },
    {
      name: 'Longonjo',
      key: 7
    },
    {
      name: 'Mungo',
      key: 8
    },
    {
      name: 'Londouimbale',
      key: 9
    },
    {
      name: 'Tchinjenje',
      key: 10
    }
  ],

  Huila: [
    {
      name: 'Lubango',
      key: 1
    },
    {
      name: 'Cacula',
      key: 2
    },
    {
      name: 'Chibia',
      key: 3
    },
    {
      name: 'Caconda',
      key: 4
    },
    {
      name: 'Caluquembe',
      key: 5
    },
    {
      name: 'Quilengues',
      key: 5
    },
    {
      name: 'Cuvango',
      key: 6
    },
    {
      name: 'Quipungo',
      key: 7
    },
    {
      name: 'Matala',
      key: 8
    },
    {
      name: 'Chicomba',
      key: 9
    },
    {
      name: 'Jamba',
      key: 10
    },
    {
      name: 'Chipindo',
      key: 11
    },
    {
      name: 'Gambos',
      key: 12
    },
    {
      name: 'Chipindo',
      key: 13
    },
    {
      name: 'Humpata',
      key: 14
    }
  ],
  Luanda: [
    {
      name: 'Belas',
      key: 1
    },
    {
      name: 'Cacuaco',
      key: 2
    },
    {
      name: 'Cazenga',
      key: 3
    },
    {
      name: 'Icolo e Bengo ',
      key: 4
    },
    {
      name: 'Luanda',
      key: 5
    },
    {
      name: 'Kilamba Kiaxi',
      key: 6
    },
    {
      name: 'Quissama',
      key: 7
    },
    {
      name: 'Talatona',
      key: 8
    },
    {
      name: 'Viana',
      key: 9
    }
  ],
  'Lunda Norte': [
    {
      name: 'Cuilo',
      key: 1
    },
    {
      name: 'Caungula',
      key: 2
    },
    {
      name: 'Chitato',
      key: 3
    },
    {
      name: 'Lubalo',
      key: 4
    },
    {
      name: 'Capenda Camulemba',
      key: 5
    },
    {
      name: 'Cuango',
      key: 6
    },
    {
      name: 'Lucapa',
      key: 7
    },
    {
      name: 'Cambulo',
      key: 8
    },
    {
      name: 'Xá Muteba',
      key: 9
    },
    {
      name: 'Lóvua',
      key: 10
    }
  ],
  'Lunda Sul': [
    {
      name: 'Saurimo',
      key: 1
    },
    {
      name: 'Muconda',
      key: 2
    },
    {
      name: 'Cocolo',
      key: 3
    },
    {
      name: 'Dala',
      key: 4
    }
  ],
  Malanje: [
    {
      name: 'Malanje',
      key: 1
    },
    {
      name: 'Calandula',
      key: 2
    },
    {
      name: 'Cacuso',
      key: 3
    },
    {
      name: 'Massango',
      key: 4
    },
    {
      name: 'Marimba',
      key: 5
    },
    {
      name: 'Quiela',
      key: 6
    },
    {
      name: 'Quirima',
      key: 7
    },
    {
      name: 'Cangandala',
      key: 8
    },
    {
      name: 'Cahombo',
      key: 9
    },
    {
      name: 'Kunda dya Baze',
      key: 10
    },
    {
      name: 'Cambundi Catembo',
      key: 11
    },
    {
      name: 'Mucari',
      key: 12
    },
    {
      name: 'Kiwaba Nzoji',
      key: 13
    },
    {
      name: 'Luquembo',
      key: 14
    }
  ],
  Moxico: [
    {
      name: 'Moxico',
      key: 1
    },
    {
      name: 'Luchazes',
      key: 2
    },
    {
      name: 'Alto Zambeze',
      key: 3
    },
    {
      name: 'Bundas',
      key: 4
    },
    {
      name: 'Luacano',
      key: 5
    },
    {
      name: 'Cameia',
      key: 6
    },
    {
      name: 'Camanongue',
      key: 7
    },
    {
      name: 'Luau',
      key: 8
    },
    {
      name: 'Léua',
      key: 9
    }
  ],
  Namibe: [
    {
      name: 'Namibe',
      key: 1
    },
    {
      name: 'Tombwa',
      key: 2
    },
    {
      name: 'Virei',
      key: 3
    },
    {
      name: 'Bibala',
      key: 4
    },
    {
      name: 'Camucoio',
      key: 2
    }
  ],
  Uíge: [
    {
      name: 'Uíge',
      key: 1
    },
    {
      name: 'Dange - Quitexe',
      key: 2
    },
    {
      name: 'Bungo',
      key: 3
    },
    {
      name: 'Ambuíla',
      key: 4
    },
    {
      name: 'Negage',
      key: 5
    },
    {
      name: 'Púri',
      key: 6
    },
    {
      name: 'Maquela do Zombo',
      key: 7
    },
    {
      name: 'Damba',
      key: 8
    },
    {
      name: 'Pombo',
      key: 9
    },
    {
      name: 'Bembe',
      key: 10
    },
    {
      name: 'Milunga',
      key: 11
    },
    {
      name: 'Songo',
      key: 12
    },
    {
      name: 'Quimbele',
      key: 13
    },
    {
      name: 'Alto Cauale',
      key: 14
    },

    {
      name: 'Mucaba',
      key: 15
    },
    {
      name: 'Buengas',
      key: 16
    }
  ],
  Zaire: [
    {
      name: 'Mbanza Congo',
      key: 1
    },
    {
      name: 'Soyo',
      key: 2
    },
    {
      name: 'Nzeto',
      key: 3
    },
    {
      name: 'Tomboco',
      key: 4
    },
    {
      name: 'Cuimba',
      key: 5
    },
    {
      name: 'Nóqui',
      key: 6
    }
  ]
}
export default {
  components: {
    Navout
  },
  mixins: [Vue2Filters.mixin],
  layout: 'basic',
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('home') }
  },
  data: () => ({
    title: window.config.appName,

    searches: '',
    SearchedResult: '',
    current: null,
    form: new Form({
      city: '',
      type: '',
      room: '',
      price: '',
      order: ''
    }),
    houses: {},
    selectedValue: null,
    cities: cities,
    province: '',
    countyFilter: [],
    houseTypeFilter: [],
    filters: [],
    roomFilter: [],
    customRoom: 99,
    stateFilter: [],
    execution: [],
    FreeStateOrBusy: '',
    shortAndLongPeriod: '',
    sortAsc: true,
    hasMainFeed: true,
    Whichlocal: '',
    recent: false,
    checkboxes: false,
    expanded: false,
    range: 9999999999,
    showMenu: false
  }),

  computed: {
    counties () {
      if (!this.province) {
        return
      }
      return this.cities[this.province].map((city) => {
        return city.name
      })
    },
    mapGetters () {
      return { authenticated: 'auth/check' }
    },
    matchedhouse () {
      if (this.countyFilter.length) {
        return this.countyFilter.length
          ? this.filterHouseByRange(this.filterCustomRoom(this.houses.data.filter((house) => this.countyFilter.some((filter) => house.county.match(filter)))))
          : this.houses.data
      } else if (this.province.length) {
        return this.province.length
          ? this.filterHouseByRange(this.filterCustomRoom(this.houses.data.filter((house) => house.city.match(this.province))))
          : this.houses.data
      } else if (this.roomFilter.length) {
        return this.roomFilter.length ? this.filterHouseByRange(this.houses.data.filter((house) => this.roomFilter.some((filter) => house.room.match(filter)))) : this.houses.data
      } else if (this.houseTypeFilter.length) {
        return this.houseTypeFilter.length
          ? this.filterHouseByRange(this.filterCustomRoom(this.houses.data.filter((house) => this.houseTypeFilter.some((filter) => house.type.match(filter)))))
          : this.houses
      } else {
        // if (this.houses.data) //return this.orderBy(this.houses.data, 'created_at', -1);
        return this.houses.data ? this.filterHouseByRange(this.filterCustomRoom(this.houses.data)) : this.houses.data
      }
    },
    // eslint-disable-next-line vue/return-in-computed-property
    FeedOfHouse () {
      if (this.recent) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.hasMainFeed = false
        if (this.matchedhouse) return this.orderBy(this.matchedhouse, 'created_at', -1)
      } else {
        if (this.matchedhouse) return this.orderBy(this.matchedhouse, 'created_at')
      }
    }
  },
  created () {
    this.loadHouses()
  },
  methods: {
    filterCustomRoom: function (houses) {
      return houses.filter((house) => house.room > 0 && house.room <= this.customRoom ? house : 0)
    },
    filterHouseByRange: function (houses) {
      return houses.filter((house) => house.price > 0 && house.price <= this.range ? house : 0)
    },
    uncheckTypesHouse: function (houseType) {
      this.houseTypeFilter = this.houseTypeFilter.filter(name => name !== houseType)
    },

    uncheckRoom: function (room) {
      this.roomFilter = this.roomFilter.filter(name => name !== room)
    },

    uncheckCounty: function (checkedCounty) {
      this.countyFilter = this.countyFilter.filter(name => name !== checkedCounty)
    },
    UncheckAllType: function () {
      this.houseTypeFilter = []
    },
    UncheckAllCount: function () {
      this.countyFilter = []
    },
    UncheckAllRoom: function () {
      this.roomFilter = []
    },
    UncheckCostRoom: function () {
      this.customRoom = 1
    },
    UncheckAllState: function () {
      this.FreeStateOrBusy = false
    },
    UncheckAllPeriod: function () {
      this.shortAndLongPeriod = false
    },
    uncheckCC: function () {
      this.countyFilter = ''
      this.province = false
    },
    toggleStateFilter: function (newState) {
      this.stateFilter = !this.stateFilter.includes(newState)
        ? [...this.stateFilter, newState]
        : this.stateFilter.filter((filter) => filter !== newState)
    },
    toggleCountyFilter: function (newCounty) {
      this.countyFilter = !this.countyFilter.includes(newCounty)
        ? [...this.countyFilter, newCounty]
        : this.countyFilter.filter((filter) => filter !== newCounty)
    },
    toggleFilter: function (newFilter) {
      this.filters = !this.filters.includes(newFilter)
        ? [...this.filters, newFilter]
        : this.filters.filter((filter) => filter !== newFilter)
    },
    findHouse (houseKey) {
      this.$router.push('find/' + houseKey)
    },

    getResults (page = 1) {
      axios.get('api/searched-houses/?page=' + page).then((response) => {
        this.houses = response.data
      })
    },
    searchinger () {
      const query = this.searches

      axios
        .get('api/searchHouser?q=' + query)
        .then((data) => {
          this.houses = data.data
          if (this.houses.length === '') {
            this.SearchedResult = 'Nao existes'
            console.log(this.result)
          }
        })
        .catch(() => {
          // eslint-disable-next-line no-undef
          Swal.fire(
            'Failed',
            'There was something wrong, while you where searching.',
            'error'
          )
        })
    },
    async loadHouses () {
      try {
        const response = await fetch('api/searched-houses')
        const result = await response.json()
        this.houses = result
      } catch (error) {
        console.log(error)
      }
    }
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
.image-house {
  object-fit: cover;
  width: 100%;
  height: 200px;
}
.input-group-prepend .btn, .input-group-append .btn {
    z-index: -1;
}
.light-bg{
  background: #f3f3f3;
}
</style>
