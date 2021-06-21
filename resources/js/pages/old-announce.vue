<template>
  <div class="">
    <div class="container my-5">
      <div class="row">
        <div class="col-lg-6">
          <sui-card class="rounded-radius py-5 shadow border border-light w-100">
            <sui-card-content>
              <sui-container text-align="justified">
                <p class="h2 mb-4 py-4">{{ $t("announce_head") }}</p>
              </sui-container>
              <sui-container text-align="justified">
                <sui-list>
                  <a is="sui-list-item" class="d-flex align-items-center">
                    <sui-icon name="home main-color" size="huge" />
                    <sui-list-content>
                      <sui-list-header>{{ $t("announce_list1_1") }}</sui-list-header>
                      <sui-list-description
                        >{{ $t("announce_list1_2") }}
                      </sui-list-description>
                    </sui-list-content>
                  </a>
                  <a is="sui-list-item" class="d-flex align-items-center">
                    <sui-icon name="sign-in alternate main-color" size="huge" />
                    <sui-list-content>
                      <sui-list-header>{{ $t("announce_list2_1") }}</sui-list-header>
                      <sui-list-description
                        >{{ $t("announce_list2_2") }}
                      </sui-list-description>
                    </sui-list-content>
                  </a>
                  <a is="sui-list-item" class="d-flex align-items-center">
                    <sui-icon name="phone volume main-color" size="huge" />
                    <sui-list-content>
                      <sui-list-header>{{ $t("announce_list3_1") }}</sui-list-header>
                      <sui-list-description
                        >{{ $t("announce_list3_2") }}
                      </sui-list-description>
                    </sui-list-content>
                  </a>
                </sui-list>
              </sui-container>
            </sui-card-content>
          </sui-card>
        </div>
        <div class="col-lg-6">          
          <card v-if="mustVerifyEmail" :title="$t('register')">
              <div class="alert alert-success" role="alert">
              {{ $t('verify_email_address') }}
              </div>
          </card>
          <div v-else :title="$t('register')">
              <form @submit.prevent="register" @keydown="form.onKeydown($event)">
                  <div class="form-row">
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="email" class=""><span class="text-danger">*</span> Email</label>
                              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                              <has-error :form="form" field="email" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="name" class=""><span class="text-danger">*</span> {{ $t('name') }}</label>
                                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                              <has-error :form="form" field="name" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="password" class=""><span class="text-danger">*</span> {{ $t('password') }}</label>
                              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                              <has-error :form="form" field="password" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="confirm_password" class=""><span class="text-danger">*</span> {{ $t('confirm_password') }}</label>
                              <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
                              <has-error :form="form" field="password_confirmation" />
                          </div>
                      </div>
                  </div>
                  <div class="mt-3 position-relative form-check">
                      <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                      <label for="exampleCheck" class="form-check-label">{{ $t('register_terms') }} <a href="javascript:void(0);">{{ $t('register_link_phrase') }}</a>.</label>
                  </div>
                  <div class="divider row"></div>
                  <div class="mt-4 d-flex align-items-center">
                      <h5 class="mb-0">{{ $t('register_has_acount') }} <router-link :to="{ name: 'login' }"  active-class="active" class="text-primary">{{ $t('goTo__login_link') }} </router-link></h5>
                      <div class="ml-auto">
                          <v-button :loading="form.busy" class="badge-pill btn-shadow btn-hover-shine btn btn-primary">
                              {{ $t('register') }}
                          </v-button>
                      </div>
                  </div>
              </form>
          </div>
          <!-- <sui-card class="rounded-radius py-3 shadow main-red text-white w-100">
            <sui-card-content>
              <card v-if="mustVerifyEmail" :title="$t('register')">
                <div class="alert alert-success" role="alert">say somenthig</div>
              </card>
              <form
                @submit.prevent="propertyImgUpload"
                method="POST"
                enctype="multipart/form-data"
                @keydown="form.onKeydown($event)"
              >
                <alert-success :form="form" :message="$t('info_updated')" />
                <sui-container text-align="justified">
                  <p class="h3">{{ $t("announce_form_title") }}</p>
                  <sui-form equal-width>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_city") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.city"
                            :class="{ 'is-invalid': form.errors.has('city') }"
                          >
                            <option
                              :value="city"
                              v-for="(city, index) in Object.keys(cities)"
                              :key="index"
                            >
                              {{ city }}
                            </option>
                          </select>
                          <has-error :form="form" field="city" class="text-white" />
                        </sui-form-field>
                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_county") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.county"
                            :class="{ 'is-invalid': form.errors.has('county') }"
                          >
                            <option
                              :value="county"
                              v-for="(county, index) in counties"
                              :key="index"
                            >
                              {{ county }}
                            </option>
                          </select>
                          <has-error :form="form" field="county" class="text-white" />
                        </sui-form-field>
                      </sui-form-fields>
                    </sui-form-field>
                  </sui-form>
                </sui-container>
                <sui-container>
                  <sui-form equal-width>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_district") }}</label>
                          <input
                            v-model="form.district"
                            :class="{ 'is-invalid': form.errors.has('district') }"
                            class="rounded-pill"
                          />
                          <has-error :form="form" field="district" class="text-white" />
                        </sui-form-field>

                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_street") }}</label>
                          <input
                            v-model="form.street"
                            :class="{ 'is-invalid': form.errors.has('street') }"
                            class="rounded-pill"
                          />
                        </sui-form-field>

                        <sui-form-field>
                          <label class="ml-3">{{ $t("home_form_type") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.period"
                            :class="{ 'is-invalid': form.errors.has('period') }"
                          >
                            <option value="long period">
                              {{ $t("home_form_type_long") }}
                            </option>
                            <option value="short period">
                              {{ $t("home_form_type_short") }}
                            </option>
                          </select>
                          <has-error :form="form" field="period" class="text-white" />
                        </sui-form-field>
                      </sui-form-fields>
                    </sui-form-field>
                  </sui-form>
                </sui-container>
                <sui-container>
                  <sui-form equal-width>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_type") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.type"
                            :class="{ 'is-invalid': form.errors.has('type') }"
                          >
                            <option
                              value="outhouse"
                              v-text="$t('annou_form_type_outhouse')"
                            ></option>
                            <option value="Apartamento">
                              {{ $t("annou_form_type_apart") }}
                            </option>
                            <option value="Vivenda">
                              {{ $t("annou_form_type_house") }}
                            </option>
                            <option value="Albergue">
                              {{ $t("annou_form_type_albergue") }}
                            </option>
                            <option value="Hospedaria">
                              {{ $t("annou_form_type_Hospedaria") }}
                            </option>
                            <option value="Hotel">
                              {{ $t("annou_form_type_hotel") }}
                            </option>
                            <option value="Hostel">
                              {{ $t("annou_form_type_hostel") }}
                            </option>
                            <option value="Motel">
                              {{ $t("annou_form_type_motel") }}
                            </option>
                            <option value="Pousada">
                              {{ $t("annou_form_type_pousada") }}
                            </option>
                            <option value="Pensão">
                              {{ $t("annou_form_type_pension") }}
                            </option>
                          </select>
                          <has-error :form="form" field="type" class="text-white" />
                        </sui-form-field>
                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_payment") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.payment_METHOD"
                            :class="{ 'is-invalid': form.errors.has('payment_METHOD') }"
                          >
                            <option value="Daily">
                              {{ $t("annou_form_payment_daily") }}
                            </option>
                            <option value="Weekly">
                              {{ $t("annou_form_payment_weekly") }}
                            </option>
                            <option value="Monthly">
                              {{ $t("annou_form_payment_monthly") }}
                            </option>
                            <option value="Quarterly">
                              {{ $t("annou_form_payment_quarterly") }}
                            </option>
                            <option value="Semiannual">
                              {{ $t("annou_form_payment_semi") }}
                            </option>
                            <option value="Annual">
                              {{ $t("annou_form_payment_year") }}
                            </option>
                          </select>
                          <has-error
                            :form="form"
                            field="payment_METHOD"
                            class="text-white"
                          />
                        </sui-form-field>
                        <sui-form-field>
                          <label class="ml-3">{{ $t("announce_form_price") }}</label>
                          <input
                            v-model="form.price"
                            :class="{ 'is-invalid': form.errors.has('price') }"
                            class="rounded-pill"
                            type="number"
                          />
                          <has-error :form="form" field="price" class="text-white" />
                        </sui-form-field>
                      </sui-form-fields>
                    </sui-form-field>
                  </sui-form>
                </sui-container>
                <sui-container>
                  <sui-form>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field width="six">
                          <label class="ml-3">{{ $t("announce_form_room") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.room"
                            :class="{ 'is-invalid': form.errors.has('room') }"
                          >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5+">5+</option>
                          </select>
                          <has-error :form="form" field="room" class="text-white" />
                        </sui-form-field>
                        <sui-form-field width="six">
                          <label class="ml-3">{{
                            $t("announce_form_living_room")
                          }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.living_room"
                            :class="{ 'is-invalid': form.errors.has('living_room') }"
                          >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3+">3+</option>
                          </select>
                          <has-error
                            :form="form"
                            field="living_room"
                            class="text-white"
                          />
                        </sui-form-field>
                        <sui-form-field width="six">
                          <label class="ml-3">{{ $t("announce_form_kitchen") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.kitchen"
                            :class="{ 'is-invalid': form.errors.has('kitchen') }"
                          >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3+">3+</option>
                          </select>
                          <has-error :form="form" field="kitchen" class="text-white" />
                        </sui-form-field>
                      </sui-form-fields>
                    </sui-form-field>
                  </sui-form>
                  <sui-form>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field width="six">
                          <label class="ml-3">{{ $t("announce_form_bathroom") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.bathroom"
                            :class="{ 'is-invalid': form.errors.has('bathroom') }"
                          >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4+">4+</option>
                          </select>
                          <has-error :form="form" field="bathroom" class="text-white" />
                        </sui-form-field>
                        <sui-form-field width="six">
                          <label class="ml-3">{{ $t("announce_form_garden") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.garden"
                            :class="{ 'is-invalid': form.errors.has('garden') }"
                          >
                            <option value="yes">{{ $t("annou_form_garden_yes") }}</option>
                            <option value="not">{{ $t("annou_form_garden_not") }}</option>
                          </select>
                          <has-error :form="form" field="garden" class="text-white" />
                        </sui-form-field>
                        <sui-form-field width="six">
                          <label class="ml-3">{{ $t("announce_form_furniture") }}</label>
                          <select
                            class="ui dropdown rounded-pill"
                            v-model="form.furniture"
                            :class="{ 'is-invalid': form.errors.has('furniture') }"
                          >
                            <option value="yes">{{ $t("annou_form_garden_yes") }}</option>
                            <option value="not">{{ $t("annou_form_garden_not") }}</option>
                          </select>
                          <has-error :form="form" field="furniture" class="text-white" />
                        </sui-form-field>
                      </sui-form-fields>
                    </sui-form-field>
                  </sui-form>
                </sui-container>
                <sui-container>
                  <div class="d-flex justify-content-lg-between">
                    <label for="description" class="">
                      <span class="texter" @click="texter = !texter"
                        >{{ $t("annou_form_description") }}</span
                      >
                    </label>
                    <label for="description" class="">
                      <i class="hand point up outline icon"></i>
                      <span
                        class="state"
                        @click="state = !state"
                        :class="{ 'is-invalid': form.errors.has('state') }"
                        >{{ $t("annou_form_state") }}
                        <input
                          type="radio"
                          value="available"
                          v-model="form.state"
                          :class="{ 'is-invalid': form.errors.has('state') }"
                          class="d-none"
                        />
                        <has-error :form="form" field="state" class="text-white" />
                      </span>
                    </label>
                    <label class="radio" v-show="state">
                      <input
                        type="radio"
                        value="available"
                        v-model="form.state"
                        :class="{ 'is-invalid': form.errors.has('state') }"
                      />
                      <span class="badge badge-light ml-2"
                        ><i class="caret right icon" v-if="form.state == 'available'"></i>
                        {{ $t("view_house_details_stateUp") }}
                      </span>
                      <has-error :form="form" field="state" class="text-white" />
                    </label>
                    <label class="radio" v-show="state">
                      <input
                        type="radio"
                        value="occupied"
                        v-model="form.state"
                        :class="{ 'is-invalid': form.errors.has('state') }"
                      />
                      <span class="badge badge-light ml-2"
                        ><i class="caret right icon" v-if="form.state == 'occupied'"></i>
                        {{ $t("view_house_details_stateDown") }}</span
                      >
                    </label>
                  </div>
                  <div class="ui form" v-show="texter">
                    <div class="required field text-dark">
                      <ckeditor
                        :editor="editor"
                        v-model="form.description"
                        :config="editorConfig"
                        aria-describedby="description"
                      ></ckeditor>
                    </div>
                  </div>
                </sui-container>
                <sui-container>
                  <div class="field my-3">
                    <sui-image-group size="tiny">
                      <span v-show="imagepreview">
                        <sui-image :src="imagepreview" class="img-thumbnail shadow-lg" />
                      </span>
                      <sui-image
                        src="./images/announce/thumbnail/no-image.png"
                        class="img-thumbnail shadow-lg"
                        v-show="!imagepreview"
                      />
                    </sui-image-group>
                  </div>
                </sui-container>
                <div class="divider row"></div>
                <sui-container>
                  <div class="field float-right">
                    <label
                      v-if="imagepreview === ''"
                      for="attachmentName"
                      class="ui icon button btn-file"
                    >
                      <input
                        type="file"
                        id="attachmentName"
                        name="attachmentName"
                        style="display: none"
                        class="w-100"
                        multiple
                        @change="imageSelected"
                      />
                      <sui-icon name="spinner" loading /> {{ $t("property_profileImg") }}
                    </label>
                    <sui-button
                      icon="image"
                      v-if="imagepreview != ''"
                      color="green"
                      type="submit"
                      :loading="form.busy"
                      >{{ $t("announce_form_btn_images") }}</sui-button
                    >
                    <label
                      v-if="imagepreview != ''"
                      for="attachmentName"
                      class="ui icon button btn-file"
                    >
                      <input
                        type="file"
                        id="attachmentName"
                        name="attachmentName"
                        style="display: none"
                        class="w-100"
                        multiple
                        @change="imageSelected"
                      /><i class="exchange icon"></i>
                      {{ $t("announce_form_change_images") }}</label
                    >
                    <sui-button type="submit" :loading="form.busy">{{
                      $t("announce_form_btn")
                    }}</sui-button>
                  </div>
                </sui-container>
              </form>
              
            </sui-card-content>
            <div class="card" v-show="campus">
              <div class="font-weight-bold text-danger text-center">
                {{ $t("announce_form_fill_all") }}
              </div>
            </div>
          </sui-card>  -->        
        </div>
      </div>
    </div>

    <card :title="$t('announce')">
      {{ $t("you_are_logged_in") }}
    </card>
    <Footer></Footer>
  </div>
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

import Navigator from "../components/Navigator";
import Footer from "../components/Footer";
import Form from "vform";
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  /* middleware: 'auth', */
  name: "announce",
  components: {
    Navigator,
    Footer,
  },
  data: () => ({
    form: new Form({
      city: "",
      county: "",
      district: "",
      street: "",
      period: "",
      type: "",
      payment_METHOD: "",
      price: "",
      room: "",
      living_room: "",
      kitchen: "",
      bathroom: "",
      garden: "",
      furniture: "",
      state: "",
      description: "<h3>Hi!</h3><p>Write your content here...</p>",
      profile: "",
    }),
    src: "images/announce/1.jpg",
    mustVerifyEmail: false,

    editor: ClassicEditor,
    editorData: "<p>Mais detalhes sobre emprego </p>.",
    editorConfig: {
      // Run the editor with the German UI.
      language: "pt",
      //toolbar: [ 'bold', 'italic', '|', 'link' ] // Vai aparevcer somente esses caras
    },
    campus: false,
    texter: false,
    state: false,
    cities: cities,
    image: "",
    imagepreview: "",
  }),
  /* computed: mapGetters({
        //authenticated: 'auth/check',
        //user: 'auth/user'
    }), */
  metaInfo() {
    return {
      title: this.$t("announce"),
      /* options: [ {text: this.$t('Male')}] */
    };
  },

  computed: {
    counties() {
      if (!this.form.city) {
        return;
      }
      return this.cities[this.form.city].map((city) => {
        return city.name;
      });
    },
  },
  methods: {
    imageSelected(e) {
      this.form.profile = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.form.profile);
      reader.onload = (e) => {
        this.imagepreview = e.target.result;
      };
    },
    propertyImgUpload() {
      let formData = new FormData();
      formData.append("profile", this.form.profile);
      formData.append("city", this.form.city);
      formData.append("county", this.form.county);
      formData.append("district", this.form.district);
      formData.append("street", this.form.street);
      formData.append("period", this.form.period);
      formData.append("type", this.form.type);
      formData.append("payment_METHOD", this.form.payment_METHOD);
      formData.append("price", this.form.price);
      formData.append("room", this.form.room);
      formData.append("living_room", this.form.living_room);
      formData.append("kitchen", this.form.kitchen);
      formData.append("bathroom", this.form.bathroom);
      formData.append("garden", this.form.garden);
      formData.append("furniture", this.form.furniture);
      formData.append("state", this.form.state);
      formData.append("description", this.form.description);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else if (
        this.form.city == "" ||
        this.form.county == "" ||
        this.form.period == ""
      ) {
        this.campus = true;
      } else if (
        this.form.type == "" ||
        this.form.payment_METHOD == "" ||
        this.form.price == ""
      ) {
        this.campus = true;
      } else if (this.form.living_room == "" || this.form.bathroom == "") {
        this.campus = true;
      } else if (!this.form.state) {
        this.campus = true;
      } else {
        axios
          .post("api/announce", formData)
          .then(() => {
            this.$router.push({ name: "my-panel" });
          })
          .catch(() => {});
      }
    },
    async announce() {
      // Must verify email fist.
      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else {
        // announce the house.
        const { data } = await this.form.post("/api/announce");
        // Log in the user.
        //const { data: { token } } = await this.form.post('/api/login')

        /* // Save the token.
                this.$store.dispatch('auth/saveToken', { token })

                // Update the user.
                await this.$store.dispatch('auth/updateUser', { user: data })
                */
        // Redirect home.
        this.$router.push({ name: "home" });
      }
    },
  },
};
</script>

<style lang="scss">
.main-red {
  background-color: #ff3d47 !important;
}
.main-color {
  color: #ff3d47 !important;
}
.alignCenter {
  align-content: center !important;
  justify-content: center !important;
}
.rounded-radius {
  border-radius: 2em !important;
}
.divider {
  margin-top: 1rem;
  margin-bottom: 1rem;
  height: 1px;
  overflow: hidden;
  background: #e9ecef;
}
.texter {
  cursor: pointer;
}
.texter:hover {
  color: #658eaf;
}
.state {
  cursor: pointer;
}
.state:hover {
  color: #ffee00;
}

label.radio {
  cursor: pointer;
}

label.radio input {
  position: absolute;
  top: 0;
  left: 0;
  visibility: hidden;
  pointer-events: none;
}

label.radio span {
  /* padding: 3px 9px; */
  /* border: 1px solid #dc3545; */
  display: inline-block;
  color: #dc3545;
  /* border-radius: 5px; */
  /* font-size: 11px; */
  text-transform: uppercase;
}

label.radio input:checked + span {
  border-color: #dc3545;
  background-color: #dc3545;
  color: #fff;
}
</style>
