<template>
  <div class="container">
    <div class="text-right my-4">
      <router-link :to="{ name: 'my-panel' }" class="ui left labeled blue icon button">
        <i class="left arrow icon"></i>
        {{ $t("mypanel_back") }}
      </router-link>
      </div>   
    
    <div class="row">
      <div class="col-md-5 mb-4">
        <sui-card class="rounded-radius w-100">
          <sui-image :src="'../' + house.profile" />
          <sui-card-content>
            <sui-card-header
              >{{ house.price }} akz/{{ house.payment_METHOD }}</sui-card-header
            >
            <sui-card-meta
              >{{ $t("announce_public_at") }}
              {{ house.created_at | OnlyDate }}</sui-card-meta
            >
            <sui-card-description class="text-capilize"
              >{{ $t("annou_form_state") }} -
              <span
                v-if="house.state === 'available'"
                class="text-success text-lowercase"
              >
                {{ $t("view_house_details_stateUp") }}</span
              ><span v-if="house.state === 'occupied'" class="text-danger text-lowercase">
                {{ $t("view_house_details_stateDown") }}</span
              >
              --
              <sui-icon name="home" />
              {{ $t("home_form_type") }}:
              <span
                v-if="house.period == 'long period'"
                class="font-weight-bold text-lowercase"
                >{{ $t("home_form_type_long") }}</span
              >
              <span v-else class="font-weight-bold text-lowercase">{{
                $t("home_form_type_short")
              }}</span></sui-card-description
            >
          </sui-card-content>
          <sui-card-content>
            <ul class="list-group">
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                {{ $t("announce_form_city") }}
                <span class="badge bg-light">{{ house.city }}</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                {{ $t("announce_form_county") }}
                <span class="badge bg-light">{{ house.county }}</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                {{ $t("announce_form_district") }}
                <span class="badge bg-light">{{ house.district }}</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center"
              >
                {{ $t("announce_form_street") }}
                <span class="badge bg-light">{{ house.street }}</span>
              </li>
            </ul>

            <table class="table table-light table-striped">
              <thead>
                <tr>
                  <th scope="col">{{ $t("announce_form_room") }}</th>
                  <th scope="col">{{ $t("announce_form_living_room") }}</th>
                  <th scope="col">{{ $t("announce_form_kitchen") }}</th>
                  <th scope="col">{{ $t("announce_form_bathroom") }}</th>
                  <th scope="col">{{ $t("announce_form_garden") }}</th>
                  <th scope="col">{{ $t("announce_form_furniture") }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ house.room }}</td>
                  <td>{{ house.living_room }}</td>
                  <td>{{ house.kitchen }}</td>
                  <td>{{ house.bathroom }}</td>
                  <td>{{ house.garden }}</td>
                  <td>{{ house.furniture }}</td>
                </tr>
              </tbody>
            </table>
          </sui-card-content>
          <sui-card-content extra>
            <div class="text-muted" v-html="house.description"></div>
          </sui-card-content>
          <sui-card-content class="px-1">
            <sui-image-group size="tiny" class="d-inline mr-1" v-for="(picture, index) in pictures"
                        :key="index">
            <sui-image wrapped :src="picture.thumb">
              <sui-label slot="corner" corner="right"
                ><sui-icon name="cancel" @click="deleteImage(picture.id)" class="pointme" 
              /></sui-label>
            </sui-image>
            </sui-image-group>
            <!-- <form
              @submit.prevent="photoUpload"
              method="POST"
              enctype="multipart/form-data"
            >
              <label
                for="photos"
                class="ui icon button btn-file fluid"
                 v-if="photospreview === ''"
              >
              <input
                type="file"
                id="photos"
                name="photos"
                ref="photo"
                style="display: none"
                class="w-100"
                multiple
                @change="photoSelected"
              />
              <sui-icon name="spinner" loading /> {{ $t('mypanel_add_photos') }}
              </label>
              <input
                type="hidden"
                v-model="form.house_code"
              />
              <sui-button fluid 
                v-if="photospreview !=''"
                color="green"
                type="submit"
                :loading="form.busy"> {{ $t('collaborate_form_btn') }}</sui-button>
            </form> -->

          <div class="form-group">
                <div is="sui-divider" horizontal v-if="attachments != ''">
                <h4 is="sui-header">
                  <i class="image icon"></i>
                  {{ $t('mypanel_add_photos_added') }}
                </h4>
              </div>

                <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments" :key="index"> 
                    <img :src="attachment.name" alt="">
                    <a is="sui-label" class="my-1">
                      {{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}
                      <sui-icon name="delete" @click="removeAttachment(attachment)" />
                    </a>
                </div>
            
            
                <label
                for="attachments"
                class="ui icon button btn-file fluid"
                v-if="attachments == ''"
                >
                <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                style="display: none">
                <sui-icon name="spinner" loading /> {{ $t('mypanel_add_photos') }}
                </label>
                
                
              <label
                for="attachments"
                class="ui icon button btn-file fluid"
                 v-if="attachments != ''"
              >{{ $t('mypanel_add_photos_plus') }}
              <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                style="display: none"></label>
              <sui-button fluid 
                v-if="attachments !=''"
                color="green"
                type="submit"
                :loading="form.busy"  @click="submit"> {{ $t('collaborate_form_btn') }}</sui-button>
          </div>

          </sui-card-content>
          <div class="text-center text-muted px-3 border-top">
            <a
              class="view"
              href="javascript:voide(0)"
              @click.prevent="viewHouse(house.house_code)"
              ><i class="eye icon"></i
            ></a>
          </div>
        </sui-card>
      </div>
      <div class="col-lg-7">
        <sui-card class="rounded-radius py-3 shadow main-red w-100 bg-light">
          <sui-card-content>
            <card v-if="mustVerifyEmail" :title="$t('register')">
              <div class="alert alert-success" role="alert">say somenthig</div>
            </card>
            <form
              @submit.prevent="updateHouse()"
              method="POST"
              enctype="multipart/form-data"
              @keydown="form.onKeydown($event)"
            >
              <alert-success :form="form" :message="$t('info_updated')" />
              <sui-container text-align="justified">
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
                        <!--  <input  v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" class="rounded-pill" v-mask="'##,###,###.##'" /> -->
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
                        <label class="ml-3">{{ $t("announce_form_living_room") }}</label>
                        <select
                          class="ui dropdown rounded-pill"
                          v-model="form.living_room"
                          :class="{ 'is-invalid': form.errors.has('living_room') }"
                        >
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3+">3+</option>
                        </select>
                        <has-error :form="form" field="living_room" class="text-white" />
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
              <hr />
              <sui-container>
                <div class="d-flex justify-content-lg-between">
                  <label for="description" class="">
                    <span class="font-weight-bold">{{ $t("annou_form_description") }}</span>
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
                <div class="ui form">
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
                  <!--<label class="">{{ $t('uploaded_archives') }}</label>!-->
                  <sui-image-group size="tiny">
                    <sui-image :src="getProfilePhoto()" class="img-thumbnail shadow-lg"  v-if="!imagepreview"/>
                    <span v-show="imagepreview">
                        <sui-image :src="imagepreview" class="img-thumbnail shadow-lg" />
                      </span>
                  </sui-image-group>
                </div>
              </sui-container>
              <div class="divider row"></div>
              <sui-container>
                <div class="field float-right">
                  <sui-button type="submit" :loading="form.busy">{{
                    $t("announce_form_btn")
                  }}</sui-button>
                </div>
              </sui-container>
            </form>
            <form
              @submit.prevent="profileImgUpload"
              method="POST"
              enctype="multipart/form-data"
            >
              <label
                v-if="imagepreview === ''"
                for="profile"
                class="ui icon button btn-file"
              >
              <input
                type="file"
                id="profile"
                name="profile"
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
                color="orange"
                type="submit"
                :loading="form.busy"
                >{{ $t("announce_form_btn_saveimg") }}</sui-button
              >
              <label
                v-if="imagepreview != ''"
                for="profile"
                class="ui icon button btn-file"
              ><i class="exchange icon"></i>
                {{ $t("announce_form_change_images") }}</label
              >
              <input
                type="hidden"
                v-model="form.house_code"
              />
            </form>
          </sui-card-content>
          <div class="card" v-show="fields">
            <div class="font-weight-bold text-danger text-center">
              {{ $t("announce_form_fill_all") }}
            </div>
          </div>
        </sui-card>
      </div>
    </div>
  </div>
</template>
<script>

import Footer from "../components/Footer";
import Form from "vform";
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

import LightBox from "vue-it-bigger";
import("vue-it-bigger/dist/vue-it-bigger.min.css"); // when using webpack

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
export default {
  middleware: "auth",
  components: {
    LightBox,
    Footer,
    
  },

  metaInfo() {
    return { title: this.$t("home") };
  },
  data: () => ({
    form: new Form({
      house_code: "",
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
    pictures: [],
    photos: [],
    photospreview: "",
    cities: cities,
    state: false,
    src: "../images/announce/thumbnail/no-image.png",
    mustVerifyEmail: false,

    editor: ClassicEditor,
    editorData: "<p>Mais detalhes sobre emprego </p>.",
    editorConfig: {
      // Run the editor with the German UI.
      language: "pt",
      //toolbar: [ 'bold', 'italic', '|', 'link' ] // Vai aparevcer somente esses caras
    },
    //fields: false,
    state: false,
    house: {},
    readMore: false,
    image: "",
    imagepreview: "",


    // You can store all your files here
    attachments: [],
    // Each file will need to be sent as FormData element
    data: new FormData(),
    errors: {
    },
    percentCompleted: 0,
  }),
  methods: {
    viewHouse(house_code) {
      this.$router.push("../view/" + house_code);
    },
    activateReadMore() {
      this.readMoreActivated = true;
    },
    openGallery(index) {
      this.$refs.lightbox.showImage(index);
    },
    imageSelected(e) {
      this.form.profile = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.form.profile);
      reader.onload = (e) => {
        this.imagepreview = e.target.result;
      };
    }, 
    photoSelected(e) {
     /*  this.photos = e.target.files;
      let fileread = new FileReader();
      fileread.readAsDataURL(this.photos);
      fileread.onload = (e) => {
        this.photospreview = e.target.result;
      }; */
      let files = this.$refs.photo.photos;

      if (!files.length) {
        return false;
      }

      for (let i = 0; i < files.length; i++) {
        this.photospreview = this.photos.push(files[i]);
      }
    },
    photoUpload() {
      let formData = new FormData();
      //formData.append("photos", this.photos);
      formData.append("house_code", this.form.house_code);
      for( var i = 0; i < this.$refs.photo.length; i++ ){
        let photo = this.$refs.photo.photos[i];
        console.log(photo);
        formData.append('photos[' + i + ']', photo);
      }

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else {
        axios
          .post("../api/upload-house-photos", formData)
          .then(() => {
            Fire.$emit('AfterCreated');
            //this.$router.push({ name: "my-panel" });
          })
          .catch(() => {});
      }
    },   
    getProfilePhoto() {
      let photo = "../images/announce/thumbnail/no-image.png";
      if (this.form.profile) {
        photo = "../" + this.form.profile;
      }
      return photo;
    },
    profileImgUpload() {
      let formData = new FormData();
      formData.append("profile", this.form.profile);
      formData.append("house_code", this.form.house_code);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else {
        axios
          .post("../api/change-profile-house-picture", formData)
          .then(() => {
            Fire.$emit('AfterCreated');
            //this.$router.push({ name: "my-panel" });
          })
          .catch(() => {});
      }
    },
    async updateHouse() {
      // Must verify email fist.
      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else {
        // announce the house.
        const { data } = await this.form.post(
          "/api/update-house/" + this.form.house_code
        );
        // Log in the user.
        //const { data: { token } } = await this.form.post('/api/login')

        /* // Save the token.
                this.$store.dispatch('auth/saveToken', { token })

                // Update the user.
                await this.$store.dispatch('auth/updateUser', { user: data })
                */
        // Redirect home.
        Fire.$emit('AfterCreated');
        //this.$router.push({ name: "my-panel" });
      }
    },
    loadHouses() {
      axios
        .get(`/api/edit-my-house/${this.$route.params.house_code}`)
        .then(({ data }) => {
          this.house = data;
          this.form.fill(data);
        });
    },



    getAttachmentSize() {
                
        this.upload_size = 0; // Reset to beginningƒ
        this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
        
        this.upload_size = Number((this.upload_size).toFixed(1));
        this.$forceUpdate();
    },
    prepareFields() {        
        this.data.append("house_code", this.form.house_code);
        if (this.attachments.length > 0) {
            for (var i = 0; i < this.attachments.length; i++) {
                let attachment = this.attachments[i];
                this.data.append('attachments[]', attachment);
            }
        }
    },
    removeAttachment(attachment) {
        
        this.attachments.splice(this.attachments.indexOf(attachment), 1);
        
        this.getAttachmentSize();
        Fire.$emit('AfterCreated');
    },
    // This function will be called every time you add a file
    uploadFieldChange(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        for (var i = files.length - 1; i >= 0; i--) {
            this.attachments.push(files[i]);
        }
        Fire.$emit('AfterCreated');
        // Reset the form to avoid copying these files multiple times into this.attachments
        document.getElementById("attachments").value = [];
        
    },
    submit() {
        this.prepareFields();
        var config = {
            headers: { 'Content-Type': 'multipart/form-data' } ,
            onUploadProgress: function(progressEvent) {
                this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                this.$forceUpdate();
            }.bind(this)
        };
        // Make HTTP request to store announcement
        axios.post("../api/upload-house-photos", this.data, config)
        .then(function (response) {
            Fire.$emit('AfterCreated');
            console.log(response);
            if (response.data.success) {
                console.log('Successfull Upload');
                //toastr.success('Files Uploaded!', 'Success');
                this.resetData();
            } else {
                console.log('Unsuccessful Upload');
                this.errors = response.data.errors;
            }
        }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
        .catch(function (error) {
            console.log(error);
        });
    },
    // We want to clear the FormData object on every upload so we can re-calculate new files again.
    // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
    resetData() {
        this.data = new FormData(); // Reset it completely
        this.attachments = [];
    },
    start() {
        console.log('Starting File Management Component');
    },
    deleteImage(id){
      axios.post('../api/delete-image/' + id).then(() => {
        Fire.$emit('AfterCreated');
        console.log('delected');      
      })
       .catch( () => {
            console.log('Error');
        });
    },
    loadHousesPhotos(){
        axios.get(`/api/get-photos/${this.$route.params.house_code}`).then(({ data }) => (this.pictures = data));              
    },


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
  mounted() {
    this.loadHouses();
    this.loadHousesPhotos();
    Fire.$on('AfterCreated', ()=>{
      this.loadHouses();
      this.loadHousesPhotos();
    });
    this.start();
  },
};
</script>
<style lang="scss">
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
.pointme{
  cursor: pointer!important;
}
.pointme:hover{
  color: #dc3545;
}
.divider {
    overflow: visible;
    background: #ffff;
}
</style>
