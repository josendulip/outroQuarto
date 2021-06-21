<template>
  <div class="mb-5">
    <!-- Header -->
    <span v-show="mainSearchfield">
      <!-- <div class="view style" :style="{ background: 'url(/' + mainImageSrc + ')' }"> -->
      <div class="view" style="background-image: url('/images/home/8-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center left;">
        <div class="rgba-indigo-strong d-flex justify-content-center align-items-center">
          <div class="container">
            <div class="row py-lg-4 d-flex justify-content-center align-items-center">
              <div class="col-md-8 mb-5 mt-md-0 mt-5 text-center text-md-left">
                <h1 class="display-4 text-danger font-weight-bold">
                  {{ $t("head_title") }}
                </h1>
                <hr class="hr-light" />
                <h6 class="mb-3 text-white">{{ $t("head_description") }}</h6>                
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
                      <hr />
                    </div>
                    <!--Body-->
                    <form
                      @submit.prevent="searching"
                      @keydown="form.onKeydown($searching)"
                    >
                      <div
                        class="row d-flex justify-content-center align-items-center py-3"
                      >
                        <!--City & Type of rent-->
                        <sui-container text-align="justified">
                          <sui-form equal-width>
                              <sui-form-field>
                                <sui-form-field>
                                  <label>{{ $t("home_form_city") }}</label>
                                  <select
                                    class="ui dropdown"
                                    v-model="province"
                                  >
                                    <option value="Benguela">Benguela</option>
                                    <option value="Bengo">Bengo</option>
                                    <option value="Bié">Bié</option>
                                    <option value="Cabinda">Cabinda</option>
                                    <option value="Cuanza Norte">Cuanza Norte</option>
                                    <option value="Cuanza Sul">Cuanza Sul</option>
                                    <option value="Cunene">Cunene</option>
                                    <option value="Huambo">Huambo</option>
                                    <option value="Huila">Huila</option>
                                    <option value="Luanda">Luanda</option>
                                    <option value="Lunda Norte">Lunda Norte</option>
                                    <option value="Lunda Sul">Lunda Sul</option>
                                    <option value="Malanje">Malanje</option>
                                    <option value="Moxico">Moxico</option>
                                    <option value="Namibe">Namibe</option>
                                    <option value="Uíge">Uíge</option>
                                    <option value="Zaire">Zaire</option>
                                  </select>
                                </sui-form-field>
                            </sui-form-field>
                          </sui-form>
                        </sui-container>
                        <!--Room & Price-->
                        <sui-container>
                          <sui-form equal-width>
                            <sui-form-field>
                              <sui-form-fields>
                                <sui-form-field>
                                  <label>{{ $t("home_form_room") }}</label>
                                  <select
                                    class="ui dropdown"
                                    v-model="form.room"
                                    :class="{ 'is-invalid': form.errors.has('room') }"
                                  >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5+">5+</option>
                                  </select>
                                  <has-error
                                    :form="form"
                                    field="type"
                                    class="text-white"
                                  />
                                </sui-form-field>
                                <sui-form-field>
                                  <label>{{
                                    $t("home_form_payment")
                                  }}</label>
                                  <select
                                    class="ui dropdown"
                                    v-model="form.price"
                                    :class="{ 'is-invalid': form.errors.has('price') }"
                                  >
                                    <option value="10,000.00">AKZ 1000.00 +</option>
                                    <option value="10,000.00">AKZ 5,000.00 +</option>
                                    <option value="10,000.00">AKZ 10,000.00 +</option>
                                    <option value="10,000.00">AKZ 20,000.00 +</option>
                                    <option value="30,000.00">AKZ 40,000.00 +</option>
                                    <option value="50,000.00">AKZ 60,000.00 +</option>
                                    <option value="80,000.00">AKZ 80,000.00 +</option>
                                    <option value="100,000.00">AKZ 100,000.00 +</option>
                                    <option value="130,000.00">AKZ 120,000.00 +</option>
                                    <option value="10,000.00">AKZ 140,000.00 +</option>
                                  </select>
                                  <has-error
                                    :form="form"
                                    field="payment"
                                    class="text-white"
                                  />
                                </sui-form-field>
                              </sui-form-fields>
                            </sui-form-field>
                          </sui-form>
                        </sui-container>

                        <v-button :loading="form.busy" class="btn btn-danger">
                          <i class="search icon"></i> ENCOTRAR IMOVEL</v-button
                        >
                      </div>
                    </form>
                    <div class="text-center mt-3">
                      <hr />
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
    <div class="row">
      <div class="col-3">
        <span v-if="province" class="font-weight-bold">
          <strong><i class="caret right icon"></i>{{ province }}</strong>
          <small
            ><i
              class="times circle outline icon text-muted hover-cursor"
              @click="uncheckCC"
            ></i
          ></small>
        </span>
        <span v-if="countyFilter != ''"
          >:
          <span v-for="county in countyFilter" :key="county" class="d-inline text-muted"
            ><em>{{ county }}, </em></span
          >
        </span>
      </div>
      <div class="col-2">
        <span v-if="roomFilter != ''">
          <strong
            ><i class="caret right icon"></i>{{ $t("announce_form_room") }}
            <small>(Qtd)</small>
          </strong>
          <span v-for="room in roomFilter" :key="room" class="d-inline text-muted"
            ><em>{{ room }}, </em></span
          >
          <small
            ><i
              class="times circle outline icon text-muted hover-cursor"
              @click="UncheckAllRoom"
            ></i
          ></small>
        </span>
      </div>
      <div class="col-2">
        <span v-if="shortAndLongPeriod != ''">
          <strong
            ><i class="caret right icon"></i>{{ $t("search_house_period") }}:
          </strong>
          <em>{{ shortAndLongPeriod }}, </em>
          <small
            ><i
              class="times circle outline icon text-muted hover-cursor"
              @click="UncheckAllPeriod"
            ></i
          ></small>
        </span>
      </div>
      <div class="col-2">
        <span v-if="FreeStateOrBusy != ''">
          <strong
            ><i class="caret right icon"></i>{{ $t("search_house_state") }}:
          </strong>
          <em>{{ FreeStateOrBusy }}, </em>
          <small
            ><i
              class="times circle outline icon text-muted hover-cursor"
              @click="UncheckAllState"
            ></i
          ></small>
        </span>
      </div>
      <div class="col-3">
        <span v-if="houseTypeFilter != ''">
          <strong><i class="caret right icon"></i>{{ $t("announce_form_type") }}:</strong>
          <span
            v-for="house_type in houseTypeFilter"
            :key="house_type"
            class="d-inline text-muted"
            ><em>{{ house_type }}, </em></span
          >
          <small
            ><i
              class="times circle outline icon text-muted hover-cursor"
              @click="UncheckAllType"
            ></i
          ></small>
        </span>
      </div>
    </div>

    <div class="container my-2">
      <div class="row">
        <!-- Filter  Menu -->
        <div class="col-md-12 my-4" v-show="filtering">
          <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-radius">
            <div class="container-fluid">
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#filterMenu"
                aria-controls="filterMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="filterMenu">
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                  <div class="input-group">
                    <input
                      class="form-control form-control-navbar"
                      type="search"
                      :placeholder="$t('search_for')"
                      aria-label="Search"
                      v-model="searches"
                      @keyup="searchinger"
                      aria-describedby="button-addon2"
                    />
                    <div class="input-group-append">
                      <button class="btn btn-light" @click.prevent="searchinger">
                        <i class="search icon"></i>
                      </button>
                    </div>
                  </div>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <!-- CITIES -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      >{{ $t("search_province") }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <label
                        class="dropdown-item cities"
                        v-for="(city, index) in Object.keys(cities)"
                        :key="index"
                      >
                        <input
                          type="radio"
                          class="custom-control-input"
                          :value="city"
                          v-model="province"
                        />
                        <span class="city"
                          ><i class="angle double right icon"></i>{{ city }}</span
                        >
                      </label>
                      <div class="dropdown-divider" v-if="counties"></div>
                      <a
                        class="dropdown-item"
                        href="javascript:(0)"
                        v-if="counties"
                        @click.prevent="uncheckCC()"
                        ><i class="check square outline icon"></i>
                        {{ $t("search_uncheck") }}</a
                      >
                    </div>
                  </li>
                  <!-- COUNTIES -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      {{ $t("announce_form_county") }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!-- <label class="dropdown-item cities" v-for="(county, index) in counties" :key="index">
                                        <input
                                        type="checkbox"
                                        class="custom-control-input" v-model="form.county" :value="county"/>
                                        <span class="city"><i class="angle double right icon"></i>{{county}}</span> 
                                    </label>  -->
                      <div
                        class="dropdown-item"
                        v-for="(county, index) in counties"
                        :key="index"
                      >
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
                      <a class="dropdown-item" v-if="!counties">{{
                        $t("search_choose_first_city")
                      }}</a>
                      <div class="dropdown-divider" v-if="counties"></div>
                      <a
                        class="dropdown-item"
                        href="javascript:(0)"
                        v-if="counties"
                        @click.prevent="UncheckAllCount()"
                        ><i class="check square outline icon"></i>
                        {{ $t("search_uncheck") }}</a
                      >
                    </div>
                  </li>
                  <!-- PRICES -->
                 <!--  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      {{ $t("home_form_payment") }}
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
                          />
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
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li> -->
                  <!-- ROOM -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      {{ $t("announce_form_room") }}
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
                      <a
                        class="dropdown-item"
                        href="javascript:(0)"
                        v-show="roomFilter"
                        @click.prevent="UncheckAllRoom()"
                        ><i class="check square outline icon"></i>
                        {{ $t("search_uncheck") }}</a
                      >
                    </div>
                  </li>
                  <!-- PERIOD -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      {{ $t("home_form_type") }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <label class="dropdown-item cities">
                        <input
                          type="radio"
                          class="custom-control-input"
                          value="short"
                          v-model="shortAndLongPeriod"
                        />
                        <span class="city"
                          ><i class="angle double right icon"></i>
                          {{ $t("home_form_type_short") }}</span
                        >
                      </label>
                      <label class="dropdown-item cities">
                        <input
                          type="radio"
                          class="custom-control-input"
                          value="long"
                          v-model="shortAndLongPeriod"
                        />
                        <span class="city"
                          ><i class="angle double right icon"></i>
                          {{ $t("home_form_type_long") }}</span
                        >
                      </label>
                      <div class="dropdown-divider" v-if="shortAndLongPeriod"></div>
                      <a
                        class="dropdown-item"
                        href="javascript:(0)"
                        v-if="shortAndLongPeriod"
                        @click.prevent="UncheckAllPeriod()"
                        ><i class="check square outline icon"></i>
                        {{ $t("search_uncheck") }}</a
                      >
                    </div>
                  </li>
                  <!-- STATE -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      {{ $t("view_house_availability") }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <label class="dropdown-item cities">
                        <input
                          type="radio"
                          class="custom-control-input"
                          value="available"
                          v-model="FreeStateOrBusy"
                        />
                        <span class="city"
                          ><i class="angle double right icon"></i
                          >{{ $t("view_house_details_stateUp") }}</span
                        >
                      </label>
                      <label class="dropdown-item cities">
                        <input
                          type="radio"
                          class="custom-control-input"
                          value="occupied"
                          v-model="FreeStateOrBusy"
                        />
                        <span class="city"
                          ><i class="angle double right icon"></i
                          >{{ $t("view_house_details_stateDown") }}</span
                        >
                      </label>
                      <div class="dropdown-divider" v-if="FreeStateOrBusy"></div>
                      <a
                        class="dropdown-item"
                        href="javascript:(0)"
                        v-if="FreeStateOrBusy"
                        @click.prevent="UncheckAllState()"
                        ><i class="check square outline icon"></i>
                        {{ $t("search_uncheck") }}</a
                      >
                    </div>
                  </li>
                  <!-- HOUSE TYPE -->
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      {{ $t("announce_form_type") }}
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_outhouse") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_apart") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_house") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_albergue") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_Hospedaria") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_hotel") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_hostel") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_motel") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_pousada") }}
                          </div>
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
                          <div class="custom-control-label">
                            {{ $t("annou_form_type_pension") }}
                          </div>
                        </label>
                      </a>

                      <div class="dropdown-divider" v-if="houseTypeFilter"></div>
                      <a
                        class="dropdown-item"
                        href="javascript:(0)"
                        v-if="houseTypeFilter"
                        @click.prevent="UncheckAllType()"
                        ><i class="check square outline icon"></i>
                        {{ $t("search_uncheck") }}</a
                      >
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
       
        <div class="col-md-12 my-5">
          <div class="row">
            <div class="col-md-3 mb-4" v-for="(house, index) in FeedOfHouse" :key="index">
              <sui-card class="content-house rounded-radius">
                <sui-image :src="house.profile" class="image-house rounded-top" />
                <p class="title-house"><!-- {{ house.created_at | OnlyDate }} --></p>
                <div class="overlay-house"></div>
                <div class="button-house">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="viewHouse(house.house_code)"
                  >
                    {{ $t("myPanel_card_footer_view") }}
                  </a>
                </div>
                <sui-card-content>
                  <sui-card-header
                    >{{
                      house.price
                        | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true })
                    }}
                    /{{ house.payment_METHOD }}</sui-card-header
                  >
                  <sui-card-meta
                    >{{ $t("announce_public_at") }}
                    {{ house.created_at | OnlyDate }}</sui-card-meta
                  >
                  <sui-card-description class="text-lowercase"
                    >{{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                    {{ house.living_room }} {{ $t("announce_form_living_room") }},
                    {{ house.bathroom }}
                    {{ $t("announce_form_bathroom") }} .</sui-card-description
                  >
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
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <pagination :data="houses" @pagination-change-page="getResults"></pagination>
      </div>
    </div>
    <Footer></Footer>
  </div>
  <!-- Header -->
</template>

<script>
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
};
import Footer from "../components/Footer";
import Form from "vform";

import axios from "axios";
import Vue2Filters from "vue2-filters";
import uniq from "lodash/uniq";
import sortedLastIndex from "lodash/sortedlastindex";

export default {
  middleware: "auth",
  mixins: [Vue2Filters.mixin],
  components: {
    Footer,
  },
  metaInfo() {
    return { title: this.$t("home") };
  },
  data: () => ({
    cardOneActive: false,
    houses: {},
    searches: "",
    SearchedResult: "",
    current: null,
    form: new Form({
      city: "",
      type: "",
      room: "",
      price: "",
      order: "",
    }),
    filtering: false,
    menuHeader: {
      icon: "",
      content: "Header",
    },
    searchInMenu: {
      icon: "search",
      iconPosition: "left",
    },
    selectedValue: null,
    options: [
      {
        key: "Important",
        text: "Important",
        value: "Important",
        label: { color: "red", empty: true, circular: true },
      },
      {
        key: "Announcement",
        text: "Announcement",
        value: "Announcement",
        label: { color: "blue", empty: true, circular: true },
      },
      {
        key: "Cannot Fix",
        text: "Cannot Fix",
        value: "Cannot Fix",
        label: { color: "black", empty: true, circular: true },
      },
    ],
    current: null,
    skills: [
      { key: "angular", text: "Angular", value: "angular" },
      { key: "css", text: "CSS", value: "css" },
      { key: "design", text: "Graphic Design", value: "design" },
      { key: "ember", text: "Ember", value: "ember" },
      { key: "html", text: "HTML", value: "html" },
      { key: "ia", text: "Information Architecture", value: "ia" },
      { key: "javascript", text: "Javascript", value: "javascript" },
      { key: "mech", text: "Mechanical Engineering", value: "mech" },
      { key: "meteor", text: "Meteor", value: "meteor" },
      { key: "node", text: "NodeJS", value: "node" },
      { key: "plumbing", text: "Plumbing", value: "plumbing" },
      { key: "python", text: "Python", value: "python" },
      { key: "rails", text: "Rails", value: "rails" },
      { key: "react", text: "React", value: "react" },
      { key: "repair", text: "Kitchen Repair", value: "repair" },
      { key: "ruby", text: "Ruby", value: "ruby" },
      { key: "ui", text: "UI Design", value: "ui" },
      { key: "ux", text: "User Experience", value: "ux" },
    ],
    cities: cities,
    examples: {
      data: [
        {
          name: "available",
          key: 1,
        },
        {
          name: "occupied",
          key: 2,
        },
      ],
    },
    province: "",
    countyFilter: [],
    houseTypeFilter: [],
    filters: [],
    roomFilter: [],
    stateFilter: [],
    execution: [],
    FreeStateOrBusy: "",
    shortAndLongPeriod: "",
    sortAsc: true,
    hasMainFeed: true,
    Whichlocal: "",
    recent: false,
    checkboxes: false,
    expanded: false,
    priceInputValue: "0", // initial input value
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
        0: ["", "Free", ""],
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
    mainSearchfield: true,

    images: [],
    mainImageSrc: null,
  }),
  methods: {
    //SEARCH PLACE
    handleSliderValuePosition(input) {
      const multiplier = input.value / input.max;
      const thumbOffset = this.thumbSize * multiplier;
      const priceInputOffset = (this.thumbSize - this.$refs.sliderValue.clientWidth) / 2;
      this.$refs.sliderValue.style.left =
        input.clientWidth * multiplier - thumbOffset + priceInputOffset + "px";
    },
    getPricingData(obj, pos) {
      return pos !== undefined
        ? obj[this.priceInputValue][pos]
        : obj[this.priceInputValue];
    },
    UncheckAllType: function () {
      this.houseTypeFilter = [];
    },
    UncheckAllCount: function () {
      this.countyFilter = "";
    },
    UncheckAllRoom: function () {
      this.roomFilter = [];
    },
    UncheckAllState: function () {
      this.FreeStateOrBusy = false;
    },
    UncheckAllPeriod: function () {
      this.shortAndLongPeriod = false;
    },
    uncheckCC: function () {
      this.countyFilter = "";
      this.province = false;
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

    getResults(page = 1) {
      axios.get("api/searched-houses/?page=" + page).then((response) => {
        this.houses = response.data;
      });
    },
    searchinger() {
      let query = this.searches;
      axios
        .get("api/search-houser?q=" + query)
        .then((data) => {
          this.houses = data.data;
          if (this.houses.length === "") {
            this.SearchedResult = "Nao existes";
            console.log(this.result);
          }
        })
        .catch(() => {
          Swal.fire(
            "Failed",
            "There was something wrong, while you where searching.",
            "error"
          );
        });
    },

    viewHouse(house_code) {
      this.$router.push("view/" + house_code); 
      axios.post('/api/create-history/' + house_code).then(() => {console.log("added to history")});
    },
    async loadHouses() {
      try {
        const response = await fetch("api/home-houses");
        const result = await response.json();
        this.houses = result;
        console.log(this.houses);
      } catch (error) {
        console.log(error);
      }
    },
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
    async searching() {
      //await this.$router.push({ name: 'home' })
      //await location.reload();
      this.mainSearchfield = false;
      this.filtering = true;
    },
  },
  computed: {
    counties() {
      if (!this.province) {
        return;
      }
      return this.cities[this.province].map((city) => {
        return city.name;
      });
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
          ? this.houses.data.filter((house) => house.city.match(this.province))
          : this.houses.data;
      } else if (this.filters.length) {
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
      } else if (this.FreeStateOrBusy.length) {
        //this.FreeStateOrBusy = this.FreeStateOrBusy
        //const FreeStateOrBusy =Array.from(this.FreeStateOrBusy)
        return this.FreeStateOrBusy.length
          ? this.houses.data.filter((house) => house.state.match(this.FreeStateOrBusy))
          : this.houses.data;
      } else if (this.shortAndLongPeriod.length) {
        return this.shortAndLongPeriod.length
          ? this.houses.data.filter((house) =>
              house.period.match(this.shortAndLongPeriod)
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
  mounted() {
    this.loadHouses();
  },
  /* created() {
    let self = this;
    this.images = [
      {
        id: "1",
        image: "images/home/4.jpg",
      },
      {
        id: "2",
        image: "images/home/5.jpg",
      },
      {
        id: "3",
        image: "images/home/6.jpg",
      },
      {
        id: "4",
        image: "images/home/7-1.jpg",
      },
      {
        id: "5",
        image: "images/home/8-1.jpg",
      },
      {
        id: "6",
        image: "images/home/9.jpg",
      },
    ];

    setInterval(function () {
      self.mainImageSrc =
        self.images[Math.floor(Math.random() * self.images.length)].image;
    }, 12000);
  }, */
};
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
