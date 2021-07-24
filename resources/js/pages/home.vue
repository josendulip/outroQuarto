<template>
  <div class="mb-5">
    <!-- Header -->
    <span v-show="mainSearchfield">
      <div class="view" style="background-image: url('/images/home/8-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center left;">
        <div class="rgba-indigo-strong d-flex justify-content-center align-items-center">
          <div class="container py-5">
            <div class="row py-lg-4 d-flex justify-content-center align-items-center">
              <div class="col-md-8 mb-5 mt-md-0 mt-5 text-center text-md-left">
                <h1 class="display-4 text-danger font-weight-bold">
                  {{ $t("head_title") }}
                </h1>
                <hr class="hr-light">
                <h6 class="mb-3 text-white">{{ $t("head_description") }}</h6>
                <!--  <router-link v-if="user.role == 'owner'" :to="{ 'name': 'my-panel.properties' }" class="btn btn-danger badge-pill px-5">{{ $t('announce') }}</router-link> -->
                <router-link :to="{ 'name': 'user.workwithus' }" class="btn btn-danger badge-pill px-5">{{ $t('collaborate') }}</router-link>
              </div>
              <div class="col-md-4 mb-4">
                <!--Form-->
                <div class="card rounded-radius">
                  <div class="card-body">
                    <!--Header-->
                    <div class="text-center">
                      <h3 class="dark-grey-text">
                        <strong>{{ $t("head_form_title") }}</strong>
                      </h3>
                      <hr>
                    </div>
                    <!--Body-->
                    <sui-container>
                      <sui-form>
                        <!--City & Type of rent-->
                        <sui-form-field>
                          <sui-form-field>
                            <label>{{ $t('head_form_state') }}</label>
                            <sui-dropdown
                              v-model="currentState"
                              :placeholder="$t('head_form_city')"
                              selection
                              :options="states"
                              :class="{ 'is-invalid': form.errors.has('city') }"
                            />
                          </sui-form-field>
                          <has-error :form="form" field="city" class="text-white" />
                        </sui-form-field>
                        <sui-form-field>
                          <sui-form-field>
                            <button class="btn btn-danger btn-block" @click.prevent="searching()">
                              <i class="search icon" /> {{ $t('head_form_find_house') }}
                            </button>
                          </sui-form-field>
                        </sui-form-field>
                      </sui-form>
                    </sui-container>
                    <div class="text-center mt-3">
                      <hr>
                      <fieldset class="form-check">
                        <label class="form-check-label text-capitalize">{{
                          $t("head_title")
                        }}</label>
                      </fieldset>
                    </div>
                  </div>
                </div>
                <!--/.Form-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </span>

    <div class="container my-2">
      <div class="row">
        <!-- Filter  Menu -->
        <div v-show="filtering" class="col-md-12 my-4">
          <nav class="navbar navbar-expand navbar-light bg-light shadow-none my-3 hidden-xs-down hidden-sm-down">
            <div class="container">
              <ul class="navbar-nav mr-auto my-2 my-lg-0">
                <a class="navbar-brand" href="javascript:void(0)" title="back to home" @click.prevent="backHome"><img src="/images/logo/logo-circle.png" alt="" class="img-fluid" style="max-width:30px;"></a>
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
                  <a id="navbarDropdown" href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <input v-model="houseTypeFilter" type="checkbox" class="custom-control-input" value="Land">
                        <div class="custom-control-label">
                          {{ $t("annou_form_land") }}
                        </div>
                      </label>
                    </a>
                    <!-- <a class="dropdown-item" href="javascript:void(0)">
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
                    </a> -->

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
                <!-- ORDER -->
                <li class="nav-item">
                  <a href="javavascript:void(0)" class="nav-link" :class="{'main-color': recent }" @click.prevent="recent = !recent">
                    <span v-if="!recent">{{ $t('search_more_old') }}</span>
                    <span v-else>{{ $t('search_more_recent') }}</span>
                  </a>
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
                      <sui-checkbox v-model="houseTypeFilter" :label="$t('annou_form_land')" value="Land" />
                    </sui-form-field>
                    <!-- <sui-form-field>
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
                    </sui-form-field> -->
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
          <!-- Implemented filter -->
          <div class="implement">
            <div class="mb-2">
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
            <div class="mb-2">
              <span v-if="houseTypeFilter != ''">
                <!-- <small><a href="javascript:void(0)"><i class="close icon text-muted" @click="UncheckAllType" /></a></small> -->
                <!-- <strong>{{ $t("announce_form_type") }}:</strong> -->
                <!-- <span v-for="house_type in houseTypeFilter" :key="house_type" class="d-inline text-muted"><em> {{ house_type }}, </em></span> -->
                <a is="sui-label" v-for="house_type in houseTypeFilter" :key="house_type" color="grey" size="tiny">
                  {{ house_type }}
                  <sui-icon name="delete" @click="uncheckTypesHouse(house_type)" />
                </a>
              </span>
            </div>
            <div class="mb-2">
              <span v-if="roomFilter != ''">
                <!-- <small><a href="javascript:void(0)"><i class="close icon text-muted" @click="UncheckAllRoom" /></a></small>
                <strong><i class="caret right icon" />{{ $t("announce_form_room") }}<small>(Qtd)</small></strong>
                <span v-for="room in roomFilter" :key="room" class="d-inline text-muted"><em>{{ room }}, </em></span> -->
                <a is="sui-label" v-for="room in roomFilter" :key="room" color="grey" size="tiny">
                  {{ room }} - {{ $t('announce_form_rooms') }}
                  <sui-icon name="delete" @click="uncheckRoom(room)" />
                </a>
              </span>
            </div>
            <!-- <div class="">
              <span v-if="customRoom != ''">
                <small><a href="javascript:void(0)"><i class="close icon text-muted" @click="UncheckCostRoom" /></a></small>
                <strong><i class="caret right icon" />{{ $t("announce_form_room") }}<small>(Qtd)</small></strong>
                <span class="d-inline text-muted"><em>{{ customRoom }}, </em></span>
              </span>
            </div> -->
            <hr>
          </div>
        </div>
        <div class="col-md-12">
          <!-- Filtered houses -->
          <div v-show="filtering" class="row my-4">
            <div v-for="(house, index) in FeedOfHouse" :key="index" class="col-md-3 mb-4">
              <sui-card class="content-house rounded-radius w-100">
                <sui-image :src="house.profile" class="image-house rounded-top" />
                <p class="title-house">
                  <!-- {{ house.created_at | OnlyDate }} -->
                </p>
                <div class="overlay-house" />
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }} </sui-card-header>
                  <sui-card-meta>
                    {{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}
                  </sui-card-meta>
                  <sui-card-description v-if="house.type == 'Land'">
                    {{ $t("annou_form_land") }}
                  </sui-card-description>
                  <sui-card-description v-else class="text-lowercase">
                    {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }}.
                  </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  <!-- {{ $t("home_form_type") }}:
                  <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span> -->
                  {{ house.county }} - {{ house.city }}
                </sui-card-content>
              </sui-card>
            </div>
          </div>
          <!-- Most recent houses -->
          <div class="row my-4">
            <div class="col-md-12">
              <h3 class="text-muted my-4">
                {{ $t('home_mostRecent') }}
              </h3>
            </div>
            <div v-for="(house, index) in recentHouses" :key="index" class="col-md-3 mb-4">
              <sui-card class="content-house rounded-radius w-100">
                <sui-image :src="house.profile" class="image-house rounded-top" />
                <p class="title-house">
                  <!-- {{ house.created_at | OnlyDate }} -->
                </p>
                <div class="overlay-house" />
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }} </sui-card-header>
                  <sui-card-meta>
                    {{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}
                  </sui-card-meta>
                  <sui-card-description v-if="house.type == 'Land'">
                    {{ $t("annou_form_land") }}
                  </sui-card-description>
                  <sui-card-description v-else class="text-lowercase">
                    {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }}.
                  </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  <!-- {{ $t("home_form_type") }}:
                  <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span> -->
                  {{ house.county }} - {{ house.city }}
                </sui-card-content>
              </sui-card>
            </div>
          </div>
          <!-- Most viewd houses -->
          <div class="row mb-4">
            <div class="col-md-12">
              <h3 class="text-muted mb-4">
                {{ $t('home_mostViewed') }}
              </h3>
            </div>
            <div v-for="(house, index) in moreVisiblehouses" :key="index" class="col-md-3 mb-4">
              <sui-card class="content-house rounded-radius w-100">
                <sui-image :src="house.profile" class="image-house rounded-top" />
                <p class="title-house">
                  <!-- {{ house.created_at | OnlyDate }} -->
                </p>
                <div class="overlay-house" />
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }} </sui-card-header>
                  <sui-card-meta>
                    {{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}
                  </sui-card-meta>
                  <sui-card-description v-if="house.type == 'Land'">
                    {{ $t("annou_form_land") }}
                  </sui-card-description>
                  <sui-card-description v-else class="text-lowercase">
                    {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }}.
                  </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  <!-- {{ $t("home_form_type") }}:
                  <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span> -->
                  {{ house.county }} - {{ house.city }}
                </sui-card-content>
              </sui-card>
            </div>
          </div>
          <!-- Top four houses -->
          <div class="row mb-4">
            <div class="col-md-12">
              <h3 class="text-muted mb-4">
                {{ $t('home_topFour') }}
              </h3>
            </div>
            <div v-for="(house, index) in topFourHouses" :key="index" class="col-md-3 mb-4">
              <sui-card class="content-house rounded-radius w-100">
                <sui-image :src="house.profile" class="image-house rounded-top" />
                <p class="title-house">
                  <!-- {{ house.created_at | OnlyDate }} -->
                </p>
                <div class="overlay-house" />
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }} </sui-card-header>
                  <sui-card-meta>
                    {{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}
                  </sui-card-meta>
                  <sui-card-description v-if="house.type == 'Land'">
                    {{ $t("annou_form_land") }}
                  </sui-card-description>
                  <sui-card-description v-else class="text-lowercase">
                    {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }}.
                  </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  <!-- {{ $t("home_form_type") }}:
                  <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span> -->
                  {{ house.county }} - {{ house.city }}
                </sui-card-content>
              </sui-card>
            </div>
          </div>
          <!-- Most recent Lands -->
          <div class="row mb-4">
            <div class="col-md-12">
              <h3 class="text-muted mb-4">
                {{ $t('home_mostLand') }}
              </h3>
            </div>
            <div v-for="(house, index) in recentLands" :key="index" class="col-md-3 mb-4">
              <sui-card class="content-house rounded-radius w-100">
                <sui-image :src="house.profile" class="image-house rounded-top" />
                <p class="title-house">
                  <!-- {{ house.created_at | OnlyDate }} -->
                </p>
                <div class="overlay-house" />
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }} </sui-card-header>
                  <sui-card-meta>
                    {{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}
                  </sui-card-meta>
                  <sui-card-description v-if="house.type == 'Land'">
                    {{ $t("annou_form_land") }}
                  </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  <!-- {{ $t("home_form_type") }}:
                  <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span> -->
                  {{ house.county }} - {{ house.city }}
                </sui-card-content>
              </sui-card>
            </div>
          </div>
          <!-- Most recent verified houses -->
          <div class="row mb-4">
            <div class="col-md-12">
              <h3 class="text-muted mb-4">
                {{ $t('home_mostVefy') }}
              </h3>
            </div>
            <div v-for="(house, index) in topVefyHouses" :key="index" class="col-md-3 mb-4">
              <sui-card class="content-house rounded-radius w-100">
                <!-- <sui-image :src="house.profile" class="image-house rounded-top" /> -->
                <sui-image :src="house.profile" class="image-house rounded-top">
                  <a is="sui-label" slot="label" color="black" icon="image" ribbon>
                    {{ $t('mypanel_verification_5') }}
                  </a>
                </sui-image>
                <p class="title-house">
                  <!-- {{ house.created_at | OnlyDate }} -->
                </p>
                <div class="overlay-house" />
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header>{{ house.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} /{{ house.payment_METHOD }} </sui-card-header>
                  <sui-card-meta>
                    {{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}
                  </sui-card-meta>
                  <sui-card-description v-if="house.type == 'Land'">
                    {{ $t("annou_form_land") }}
                  </sui-card-description>
                  <sui-card-description v-else class="text-lowercase">
                    {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }}.
                  </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>
                  <sui-icon name="home" />
                  <!-- {{ $t("home_form_type") }}:
                  <span v-if="house.period == 'long period'" class="font-weight-bold text-lowercase">{{ $t("home_form_type_long") }}</span>
                  <span v-else class="font-weight-bold text-lowercase">{{
                    $t("home_form_type_short")
                  }}</span> -->
                  {{ house.county }} - {{ house.city }}
                </sui-card-content>
              </sui-card>
            </div>
          </div>
        </div>
      </div>
      <div class="pagination">
        <pagination :data="houses" @pagination-change-page="getResults" />
      </div>
    </div>
    <Footer v-if="!filtering" />
  </div>
  <!-- Header -->
</template>

<script>
import Footer from '../components/Footer'
import Form from 'vform'
import axios from 'axios'
import Vue2Filters from 'vue2-filters'

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
    Footer
  },
  mixins: [Vue2Filters.mixin],
  middleware: 'auth',
  metaInfo () {
    return { title: this.$t('home') }
  },
  data: () => ({
    cardOneActive: false,
    houses: {},
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
    filtering: false,
    menuHeader: {
      icon: '',
      content: 'Header'
    },
    searchInMenu: {
      icon: 'search',
      iconPosition: 'left'
    },
    selectedValue: null,
    cities: cities,
    province: '',
    currentState: null,
    states: [
      { text: 'Benguela', value: 'Benguela' },
      { text: 'Bengo', value: 'Bengo' },
      { text: 'Bié', value: 'Bié' },
      { text: 'Cabinda', value: 'Cabinda' },
      { text: 'Cuando Cubango', value: 'Cuando Cubango' },
      { text: 'Cuanza Norte', value: 'Cuanza Norte' },
      { text: 'Cuanza Sul', value: 'Cuanza Sul' },
      { text: 'Cunene', value: 'Cunene' },
      { text: 'Huambo', value: 'Huambo' },
      { text: 'Huila', value: 'Huila' },
      { text: 'Luanda', value: 'Luanda' },
      { text: 'Lunda Norte', value: 'Lunda Norte' },
      { text: 'Lunda Sul', value: 'Lunda Sul' },
      { text: 'Malanje', value: 'Malanje' },
      { text: 'Moxico', value: 'Moxico' },
      { text: 'Namibe', value: 'Namibe' },
      { text: 'Uíge', value: 'Uíge' },
      { text: 'Zaire', value: 'Zaire' }
    ],
    customRoom: 99,
    range: 9999999999,
    countyFilter: [],
    checkedCounty: true,
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
    mainSearchfield: true,
    showMenu: false,
    images: [],
    mainImageSrc: null,
    recentHouses: {},
    moreVisiblehouses: {},
    topFourHouses: {},
    topVefyHouses: {},
    recentLands: {}
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
        if (this.matchedhouse) return this.orderBy(this.matchedhouse, 'created_at')
      } else {
        if (this.matchedhouse) return this.orderBy(this.matchedhouse, 'created_at', -1)
      }
    }
  },
  mounted () {
    this.loadHouses()
    this.loadRecentsHouses()
    this.loadMoreVisiblesHouses()
    this.loadTopFourHouses()
    this.loadRecentsLands()
    this.loadVefyHouses()
  },
  methods: {
    // SEARCH PLACE
    filterCustomRoom: function (houses) {
      return houses.filter((house) => house.room > 0 && house.room <= this.customRoom ? house : 0)
    },
    filterHouseByRange: function (houses) {
      return houses.filter((house) => house.price > 0 && house.price <= this.range ? house : 0)
    },
    UncheckAllType: function () {
      this.houseTypeFilter = []
    },
    uncheckTypesHouse: function (houseType) {
      this.houseTypeFilter = this.houseTypeFilter.filter(name => name !== houseType)
    },
    UncheckAllCount: function () {
      this.countyFilter = []
    },
    UncheckAllRoom: function () {
      this.roomFilter = []
    },
    uncheckRoom: function (room) {
      this.roomFilter = this.roomFilter.filter(name => name !== room)
    },
    UncheckAllState: function () {
      this.FreeStateOrBusy = false
    },
    UncheckAllPeriod: function () {
      this.shortAndLongPeriod = false
    },
    uncheckCC: function () {
      this.countyFilter = []
      this.province = false
    },
    uncheckCounty: function (checkedCounty) {
      this.countyFilter = this.countyFilter.filter(name => name !== checkedCounty)
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

    getResults (page = 1) {
      axios.get('api/home-houses/?page=' + page).then((response) => {
        this.houses = response.data
      })
    },
    searchinger () {
      const query = this.searches
      axios
        .get('api/search-houser?q=' + query)
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

    viewHouse (houseCode) {
      this.$router.push('view/' + houseCode)
      axios.post('/api/create-history/' + houseCode).then(() => { console.log('added to history') })
    },
    async loadHouses () {
      try {
        const response = await fetch('api/home-houses')
        const result = await response.json()
        this.houses = result
        /* console.log(this.houses) */
      } catch (error) {
        console.log(error)
      }
    },
    async loadRecentsHouses () {
      try {
        const response = await fetch('/api/home-recents-houses')
        const result = await response.json()
        this.recentHouses = result
        /* console.log(this.houses) */
      } catch (error) {
        console.log(error)
      }
    },
    async loadMoreVisiblesHouses () {
      try {
        const response = await fetch('api/home-more-visibles-houses')
        const result = await response.json()
        this.moreVisiblehouses = result
        /* console.log(this.houses) */
      } catch (error) {
        console.log(error)
      }
    },
    async loadTopFourHouses () {
      try {
        const response = await fetch('api/home-top-four-houses')
        const result = await response.json()
        this.topFourHouses = result
        /* console.log(this.houses) */
      } catch (error) {
        console.log(error)
      }
    },
    async loadRecentsLands () {
      try {
        const response = await fetch('api/home-recent-lands')
        const result = await response.json()
        this.recentLands = result
        /* console.log(this.houses) */
      } catch (error) {
        console.log(error)
      }
    },
    async loadVefyHouses () {
      try {
        const response = await fetch('api/home-top-four-verify-houses')
        const result = await response.json()
        this.topVefyHouses = result
        /* console.log(this.houses) */
      } catch (error) {
        console.log(error)
      }
    },
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    searching () {
      // await this.$router.push({ name: 'home' })
      // await location.reload();
      this.province = this.currentState
      this.mainSearchfield = false
      this.filtering = true
    },
    // back to home page
    backHome () {
      this.province = this.currentState
      this.mainSearchfield = true
      this.filtering = false
    }
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
.input-group-prepend .btn, .input-group-append .btn {
    z-index: 0;
}
.ui.card > :first-child,
.ui.cards > .card > :first-child {
  border-radius: 1.9rem 1.9rem 0 0 !important;
  border-top: none !important;
}
</style>
