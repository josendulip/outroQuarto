<template>
  <div class="container-fluid m-0 pl-0 pr-0">
    <Navout />

    <nav class="navbar navbar-expand navbar-light shadow-none  my-3">
      <div class="container">
        <ul class="navbar-nav mr-auto my-2 my-lg-0 hidden-xs-down hidden-sm-down">
          <li class="nav-item d-md-none">
            <a href="javascript:void(0)" data-toggle="canvas" data-target="#bs-canvas-left" aria-expanded="false" aria-controls="bs-canvas-left" class="nav-link"><i class="bars icon" />
            </a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link text-uppercase"><i class="mix icon" /> {{ $t("search_filter") }}</a>
          </li>
          <!-- CITIES -->
          <li class="nav-item dropdown">
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
          <li class="nav-item dropdown">
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
          <li class="nav-item dropdown">
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
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $t('home_form_payment') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div class="pricing-slider center-content">
                <label class="form-slider">
                  <span>How many users do you have?</span>
                  <input ref="slider" v-model="priceInputValue" type="range" @input="handleSliderValuePosition($event.target)">
                </label>
                <div ref="sliderValue" class="pricing-slider-value">
                  {{ getPricingData(priceInput) }}
                </div>
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
              <div class="dropdown-divider" />
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <!-- ROOM -->
          <li class="nav-item dropdown">
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
    <div class="container my-5">
      <div class="row">
        <div v-for="(house, index) in FeedOfHouse" :key="index" class="col-md-3 mb-4">
          <sui-card class="content-house rounded-radius">
            <sui-image :src="house.profile" class="rounded-top image-house" />
            <p class="title-house">
              {{ house.created_at | OnlyDate }}
            </p>
            <div class="overlay-house" />
            <div class="button-house">
              <a href="javascript:void(0)" @click.prevent="findHouse(house.house_code)">
                {{ $t("myPanel_card_footer_view") }}
              </a>
            </div>
            <sui-card-content>
              <sui-card-header>{{ house.price | currency("AKZ", 2, { spaceBetweenAmountAndSymbol: true }) }} / {{ house.payment_METHOD }}</sui-card-header>
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
              {{ $t("home_form_type") }}:
              <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
              <span v-else class="font-weight-bold text-lowercase">
                {{ $t("home_form_type_short") }}
              </span>
            </sui-card-content>
          </sui-card>
        </div>
      </div>


      <h5>List of Products</h5>
      <!-- <div v-for="casa in casas" :key="casa.id">{{casa.price}}</div> -->
      <h3>Filter</h3>

      <select v-model="category">
        <option valeu="Accessories">Accessories</option>
        <option valeu="Laptop">Laptop</option>
        <option valeu="Stationary">Stationary</option>
      </select>

      <input type="text" v-model="name" placeholder="Filter By Name">
      <input type="text" v-model="range" placeholder="Filter By Range">

      <label for="vol">Price (between 0 and 1000000000):</label>
      <input type="range" v-model="range" min="0" max="1000000000" step="100">
      
      <ul>
        <li v-for="casa in filterProducts" :key="casa.id">
          <!-- casa Name : {{ casa.house_code }} -  -->Price : {{ casa.price }} <!-- ({{casa.street}}) -->
        </li>
      </ul>
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
      name: "Benguela",
      key: 1,
    },
    {
      name: "Baia Farta",
      key: 2,
    },
    {
      name: "Catumbela",
      key: 3,
    },
    {
      name: "Lobito",
      key: 4,
    },
    {
      name: "Ganda",
      key: 5,
    },
    {
      name: "Bocoio ",
      key: 6,
    },

    {
      name: "Balombo",
      key: 7,
    },
    {
      name: "Chongoroi",
      key: 8,
    },

    {
      name: "Caimbambo",
      key: 9,
    },
    {
      name: "Cubal",
      key: 9,
    },
  ],
  Bengo: [
    {
      name: "Caxito",
      key: 1,
    },
    {
      name: "Dande",
      key: 2,
    },
    {
      name: "Bula",
      key: 3,
    },
    {
      name: "Atumba",
      key: 4,
    },
    {
      name: "Dembos",
      key: 5,
    },
    {
      name: "Nambuangongo",
      key: 6,
    },
    {
      name: "Pango Aluquém",
      key: 7,
    },
  ],
  Bié: [
    {
      name: "Cuito",
      key: 1,
    },
    {
      name: "Andulo",
      key: 2,
    },
    {
      name: "Chitembo",
      key: 3,
    },
    {
      name: "Camacupa",
      key: 4,
    },
    {
      name: "Chinguar",
      key: 5,
    },
    {
      name: "Catabola",
      key: 6,
    },
    {
      name: "Cunhinga",
      key: 7,
    },
    {
      name: "Cuemba",
      key: 8,
    },
    {
      name: "Nharêa",
      key: 9,
    },
  ],
  Cabinda: [
    {
      name: "Cabinda",
      key: 1,
    },

    {
      name: "Cacongo",
      key: 2,
    },
    {
      name: "Belize",
      key: 2,
    },
    {
      name: "Buco Zau",
      key: 2,
    },
  ],
  "Cuando Cubango": [
    {
      name: "Menongue",
      key: 1,
    },
    {
      name: "Mavinga",
      key: 2,
    },
    {
      name: "Dirico",
      key: 3,
    },
    {
      name: "Cuito Cuanavale",
      key: 4,
    },
    {
      name: "Cuchi",
      key: 5,
    },
    {
      name: "Rivungo",
      key: 6,
    },
    {
      name: "Calai",
      key: 7,
    },
    {
      name: "Changar",
      key: 8,
    },
    {
      name: "Nancova",
      key: 9,
    },
  ],
  "Cuanza Norte": [
    {
      name: "Ndalatando",
      key: 1,
    },
    {
      name: "Cazengo",
      key: 2,
    },
    {
      name: "Golungo Alto",
      key: 3,
    },
    {
      name: "Cambambe",
      key: 4,
    },
    {
      name: "Samba Cajú",
      key: 5,
    },
    {
      name: "Ambaca",
      key: 6,
    },
    {
      name: "Lucala",
      key: 7,
    },
    {
      name: "Banga",
      key: 8,
    },
    {
      name: "Bolongongo",
      key: 9,
    },
    {
      name: "Quiculungo",
      key: 10,
    },
    {
      name: "Ngonguembo",
      key: 11,
    },
  ],
  "Cuanza Sul": [
    {
      name: "Sumbe",
      key: 1,
    },
    {
      name: "Libolo",
      key: 2,
    },
    {
      name: "Amboim",
      key: 3,
    },
    {
      name: "Quibala",
      key: 4,
    },
    {
      name: "Seles",
      key: 5,
    },
    {
      name: "Cela",
      key: 6,
    },
    {
      name: "Mussende",
      key: 7,
    },
    {
      name: "Quilenda",
      key: 8,
    },
    {
      name: "Ebo",
      key: 9,
    },
    {
      name: "Conda",
      key: 10,
    },
  ],
  Cunene: [
    {
      name: "Ombadja",
      key: 1,
    },
    {
      name: "Cuanhama",
      key: 2,
    },
    {
      name: "Curoca",
      key: 3,
    },
    {
      name: "Cahama",
      key: 4,
    },
    {
      name: "Cuvelai",
      key: 5,
    },
    {
      name: "Namacunde",
      key: 6,
    },
  ],
  Huambo: [
    {
      name: "Huambo",
      key: 1,
    },
    {
      name: "Cáala",
      key: 2,
    },
    {
      name: "Tchikala Tcholohanga",
      key: 3,
    },
    {
      name: "Bailundo",
      key: 4,
    },
    {
      name: "Ecunha",
      key: 5,
    },
    {
      name: "Ukuma",
      key: 6,
    },
    {
      name: "Longonjo",
      key: 7,
    },
    {
      name: "Mungo",
      key: 8,
    },
    {
      name: "Londouimbale",
      key: 9,
    },
    {
      name: "Tchinjenje",
      key: 10,
    },
  ],

  Huila: [
    {
      name: "Lubango",
      key: 1,
    },
    {
      name: "Cacula",
      key: 2,
    },
    {
      name: "Chibia",
      key: 3,
    },
    {
      name: "Caconda",
      key: 4,
    },
    {
      name: "Caluquembe",
      key: 5,
    },
    {
      name: "Quilengues",
      key: 5,
    },
    {
      name: "Cuvango",
      key: 6,
    },
    {
      name: "Quipungo",
      key: 7,
    },
    {
      name: "Matala",
      key: 8,
    },
    {
      name: "Chicomba",
      key: 9,
    },
    {
      name: "Jamba",
      key: 10,
    },
    {
      name: "Chipindo",
      key: 11,
    },
    {
      name: "Gambos",
      key: 12,
    },
    {
      name: "Chipindo",
      key: 13,
    },
    {
      name: "Humpata",
      key: 14,
    },
  ],
  Luanda: [
    {
      name: "Belas",
      key: 1,
    },
    {
      name: "Cacuaco",
      key: 2,
    },
    {
      name: "Cazenga",
      key: 3,
    },
    {
      name: "Icolo e Bengo ",
      key: 4,
    },
    {
      name: "Luanda",
      key: 5,
    },
    {
      name: "Kilamba Kiaxi",
      key: 6,
    },
    {
      name: "Quissama",
      key: 7,
    },
    {
      name: "Talatona",
      key: 8,
    },
    {
      name: "Viana",
      key: 9,
    },
  ],
  "Lunda Norte": [
    {
      name: "Cuilo",
      key: 1,
    },
    {
      name: "Caungula",
      key: 2,
    },
    {
      name: "Chitato",
      key: 3,
    },
    {
      name: "Lubalo",
      key: 4,
    },
    {
      name: "Capenda Camulemba",
      key: 5,
    },
    {
      name: "Cuango",
      key: 6,
    },
    {
      name: "Lucapa",
      key: 7,
    },
    {
      name: "Cambulo",
      key: 8,
    },
    {
      name: "Xá Muteba",
      key: 9,
    },
    {
      name: "Lóvua",
      key: 10,
    },
  ],
  "Lunda Sul": [
    {
      name: "Saurimo",
      key: 1,
    },
    {
      name: "Muconda",
      key: 2,
    },
    {
      name: "Cocolo",
      key: 3,
    },
    {
      name: "Dala",
      key: 4,
    },
  ],
  Malanje: [
    {
      name: "Malanje",
      key: 1,
    },
    {
      name: "Calandula",
      key: 2,
    },
    {
      name: "Cacuso",
      key: 3,
    },
    {
      name: "Massango",
      key: 4,
    },
    {
      name: "Marimba",
      key: 5,
    },
    {
      name: "Quiela",
      key: 6,
    },
    {
      name: "Quirima",
      key: 7,
    },
    {
      name: "Cangandala",
      key: 8,
    },
    {
      name: "Cahombo",
      key: 9,
    },
    {
      name: "Kunda dya Baze",
      key: 10,
    },
    {
      name: "Cambundi Catembo",
      key: 11,
    },
    {
      name: "Mucari",
      key: 12,
    },
    {
      name: "Kiwaba Nzoji",
      key: 13,
    },
    {
      name: "Luquembo",
      key: 14,
    },
  ],
  Moxico: [
    {
      name: "Moxico",
      key: 1,
    },
    {
      name: "Luchazes",
      key: 2,
    },
    {
      name: "Alto Zambeze",
      key: 3,
    },
    {
      name: "Bundas",
      key: 4,
    },
    {
      name: "Luacano",
      key: 5,
    },
    {
      name: "Cameia",
      key: 6,
    },
    {
      name: "Camanongue",
      key: 7,
    },
    {
      name: "Luau",
      key: 8,
    },
    {
      name: "Léua",
      key: 9,
    },
  ],
  Namibe: [
    {
      name: "Namibe",
      key: 1,
    },
    {
      name: "Tombwa",
      key: 2,
    },
    {
      name: "Virei",
      key: 3,
    },
    {
      name: "Bibala",
      key: 4,
    },
    {
      name: "Camucoio",
      key: 2,
    },
  ],
  Uíge: [
    {
      name: "Uíge",
      key: 1,
    },
    {
      name: "Dange - Quitexe",
      key: 2,
    },
    {
      name: "Bungo",
      key: 3,
    },
    {
      name: "Ambuíla",
      key: 4,
    },
    {
      name: "Negage",
      key: 5,
    },
    {
      name: "Púri",
      key: 6,
    },
    {
      name: "Maquela do Zombo",
      key: 7,
    },
    {
      name: "Damba",
      key: 8,
    },
    {
      name: "Pombo",
      key: 9,
    },
    {
      name: "Bembe",
      key: 10,
    },
    {
      name: "Milunga",
      key: 11,
    },
    {
      name: "Songo",
      key: 12,
    },
    {
      name: "Quimbele",
      key: 13,
    },
    {
      name: "Alto Cauale",
      key: 14,
    },

    {
      name: "Mucaba",
      key: 15,
    },
    {
      name: "Buengas",
      key: 16,
    },
  ],
  Zaire: [
    {
      name: "Mbanza Congo",
      key: 1,
    },
    {
      name: "Soyo",
      key: 2,
    },
    {
      name: "Nzeto",
      key: 3,
    },
    {
      name: "Tomboco",
      key: 4,
    },
    {
      name: "Cuimba",
      key: 5,
    },
    {
      name: "Nóqui",
      key: 6,
    },
  ],
}
export default {
  components: {
    Navout
  },
  layout: 'basic',
  middleware: 'guest',
  mixins: [Vue2Filters.mixin],

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
    src: 'images/announce/1.jpg',
    selectedValue: null,
    cities: cities,
    casas: {},
    province: '',
    countyFilter: [],
    houseTypeFilter: [],
    filters: [],
    roomFilter: [],
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
    priceInputValue: 0, // initial input value
    priceInput: {
      // slider values
      0: "1,000",
      1: "1,250",
      2: "1,500",
      3: "2,000",
      4: "2,500",
      5: "3,500",
      6: "6,000",
      7: "15,000",
      8: "50,000",
      9: "50,000+",
    },
    priceOutput: {
      // output values
      plan1: {
        0: ['', "Free", ""],
        1: ["$", "13", "/m"],
        2: ["$", "17", "/m"],
        3: ["$", "21", "/m"],
        4: ["$", "25", "/m"],
        5: ["$", "42", "/m"],
        6: ["$", "58", "/m"],
        7: ["$", "117", "/m"],
        8: ["$", "208", "/m"],
        9: ["", "Contact Us", ""],
      },
    },
    category: '',
    name: '',
    range: '1000000000',
    products: [
      { name: "Keyboard", price: 4046755, category: "Accessories" },
      { name: "Mouse", price: 2007895, category: "Accessories" },
      { name: "Monitor", price: 399, category: "Accessories" },
      { name: "Dell XPS", price: 59932, category: "Laptop" },
      { name: "MacBook Pro", price: 8999056, category: "Laptop" },
      { name: "Pencil Box", price: 60, category: "Stationary" },
      { name: "Pen", price: 100890, category: "Stationary" },
      { name: "USB Cable", price: 70078, category: "Accessories" },
      { name: "Eraser", price: 2098, category: "Stationary" },
      { name: "Highlighter", price: 5, category: "Stationary" },
    ]
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
          ? this.houses.data.filter((house) =>
              this.countyFilter.some((filter) => house.county.match(filter))
            )
          : this.houses.data
      } else if (this.province.length) {
        return this.province.length
          ? this.houses.data.filter((house) => house.city.match(this.province))
          : this.houses.data
      } else if (this.filters.length) {
        return this.filters.length
          ? this.houses.data.filter((house) =>
              this.filters.some((filter) => house.period.match(filter))
            )
          : this.houses.data
      } else if (this.execution.length) {
        return this.execution.length
          ? this.houses.data.filter((example) =>
              this.execution.some((filter) => example.state.match(filter))
            )
          : this.houses.data
      } else if (this.FreeStateOrBusy.length) {
        return this.FreeStateOrBusy.length
          ? this.houses.data.filter((house) => house.state.match(this.FreeStateOrBusy))
          : this.houses.data
      } else if (this.houseTypeFilter.length) {
        return this.houseTypeFilter.length
          ? this.houses.data.filter((house) =>
              this.houseTypeFilter.some((filter) => house.type.match(filter))
            )
          : this.houses
      } else {
        if (this.houses.data) return this.orderBy(this.houses.data, 'created_at', -1);
      }
    },
    FeedOfHouse () {
      if (this.recent) {
        this.hasMainFeed = false
        if (this.matchedhouse) return this.orderBy(this.matchedhouse, 'created_at', -1)
      } else {
        if (this.matchedhouse) return this.orderBy(this.matchedhouse, 'created_at');
      }
      //return this.matchedhouse.sort(/* something here */);
    },
    /* filterProducts: function () {
      return this.filterProductsByRange(
        this.filterProductsByName(this.filterProductsByCategory(this.casas))
      )
    } */
    filterProducts: function () {
      // return this.filterProductsByRange(this.casas)
      return this.casas.filter((casa) => casa.price > 0 && casa.price < this.range ? casa : '')
    }
  },
  created () {
    this.loadHouses()
    this.getHouses()
  },
  mounted () {
   /*  this.$refs.slider.setAttribute("min", 0);
    this.$refs.slider.setAttribute("max", Object.keys(this.priceInput).length - 1);
    this.thumbSize = parseInt(
      window.getComputedStyle(this.$refs.sliderValue).getPropertyValue("--thumb-size"),
      10
    );
    this.handleSliderValuePosition(this.$refs.slider); */
  },
  methods: {
    /* filterProductsByCategory: function (houses) {
      return houses.filter((house) => !house.city.indexOf(this.city))
    },

    filterProductsByName: function (houses) {
      return houses.filter((house) => !house.county.indexOf(this.county))
    }, */

    filterProductsByRange: function (houses) {
      return houses.filter((product) =>
        product.price > 0 && product.price < this.range ? product : ''
      )
    },
    handleSliderValuePosition (input) {
      const multiplier = input.value / input.max
      const thumbOffset = this.thumbSize * multiplier
      const priceInputOffset = (this.thumbSize - this.$refs.sliderValue.clientWidth) / 2
      this.$refs.sliderValue.style.left =
        input.clientWidth * multiplier - thumbOffset + priceInputOffset + 'px'
    },
    getPricingData (obj, pos) {
      return pos !== undefined
        ? obj[this.priceInputValue][pos]
        : obj[this.priceInputValue]
    },
    // Retirei do computed to methoo
    orderByItem () {
      if (this.recent) {
        this.hasMainFeed = false
        if (this.houses.data) return this.orderBy(this.houses.data, 'created_at', -1)
      } else {
        if (this.houses.data) return this.orderBy(this.houses.data, 'created_at')
      }
    },
    ExecFilters () {
      if (this.houses.data) {
        return this.houses.data

          .map(({ state }) => state)
          .filter((value, index, self) => self.indexOf(value) === index)
      }
    },
    periodFilters () {
      if (this.houses.data) {
        return this.houses.data
          .map(({ period }) => period)
          .filter((value, index, self) => self.indexOf(value) === index)
      }
    },
    roomFilters () {
      if (this.houses.data) {
        // return uniq(this.jobs.data.map(({ experience }) => experience))
        return this.houses.data
          .map(({ room }) => room)
          .filter((value, index, self) => self.indexOf(value) === index)
      }
    },
    stateFilters () {
      if (this.houses.data) {
        // return uniq(this.jobs.data.map(({ experience }) => experience))
        return this.houses.data
          .map(({ state }) => state)
          .filter((value, index, self) => self.indexOf(value) === index)
      }
    },
    // end from compute to method

    UncheckAllType: function () {
      this.houseTypeFilter = []
    },
    UncheckAllCount: function () {
      this.countyFilter = ''
    },
    UncheckAllRoom: function () {
      this.roomFilter = []
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
    toggleExecFilter: function (newExec) {
      this.execution = !this.execution.includes(newExec)
        ? [...this.execution, newExec]
        : this.execution.filter((filter) => filter !== newExec)
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
    },
    getHouses () {
      axios.get('api/searched-houses').then(({ data }) => (this.casas = data))
    },
    showCheckboxes () {
      if (!this.expanded) {
        this.checkboxes = true
        this.expanded = true
      } else {
        this.checkboxes = false
        this.expanded = false
      }
    }
    /* filterProductsByCategory: function (products) {
      return products.filter((product) => !product.category.indexOf(this.category))
    },

    filterProductsByName: function (products) {
      return products.filter((product) => !product.name.indexOf(this.name))
    },

    filterProductsByRange: function (products) {
      return products.filter((product) =>
        product.price > 0 && product.price < this.range ? product : ''
      )
    } */
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
</style>
