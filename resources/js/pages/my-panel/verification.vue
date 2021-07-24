<template>
  <div class="container">
    <div class="text-right my-4">
      <router-link :to="{ name: 'my-panel.verificate' }" class="ui left labeled blue icon button">
        <i class="left arrow icon" /> {{ $t("mypanel_back") }}
      </router-link>
    </div>

    <!-- PREVISUALIZACAO DO IMOVEL -->
    <div class="row justify-content-center align-items-center">
      <div class="col-md-4 my-4">
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title") }}
        </h3>
        <sui-card class="content-house rounded-radius w-100 card-house">
          <sui-image :src="getProfilePhoto()" class="img-fluid d-block">
            <a is="sui-label" slot="label" color="black" icon="image" ribbon>
              {{ $t('mypanel_verification_5') }}
            </a>
          </sui-image>
          <sui-card-content>
            <sui-card-header> {{ form.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}/{{ form.payment_METHOD }}</sui-card-header>
            <sui-card-meta> {{ $t("announce_public_at") }} {{ form.created_at | OnlyDate }}</sui-card-meta>
            <sui-card-description class="text-lowercase">
              <span v-if="form.type">{{ form.type }}</span>
              <span v-if="form.living_room">, {{ form.living_room }} {{ $t("announce_form_living_room") }}</span>
              <span v-if="form.kitchen">, {{ form.kitchen }} {{ $t('announce_form_kitchen') }}</span>
              <span v-if="form.room">, {{ form.room }} {{ $t("announce_form_room") }}</span>
              <span v-if="form.bathroom">, {{ form.bathroom }} {{ $t("announce_form_bathroom") }}</span>
            </sui-card-description>
          </sui-card-content>
          <sui-card-content extra>
            <span v-if="house.add_images =='has'">
              <sui-icon name="images outline" /> {{ $t('property_has_') }}
            </span>
            <span v-if="house.add_images == 'hasnot'" class="text-danger">
              <sui-icon name="unlink" /> {{ $t('property_has_not') }}
            </span>
          </sui-card-content>
          <div class="text-center text-muted p-3 border-top">
            <sui-icon name="pencil" color="red" inverted bordered :title="$t('myPanel_card_footer_edit')" @click.prevent="editHouse(house.house_code)" />
            <!-- {{$t("myPanel_card_footer_edit")}} -->
            <sui-icon name="eye" color="red" inverted bordered :title="$t('myPanel_card_footer_view')" @click.prevent="viewHouse(house.house_code)" />
            <!-- {{ $t("myPanel_card_footer_view") }} -->
            <sui-icon name="clipboard list" color="red" inverted bordered :title="$t('property_verify')" @click="verification(house.house_code)" />
            <sui-icon name="bullhorn" color="red" inverted bordered :title="$t('mypanel_promotion_btn')" @click="promoteHouse(house.house_code)" />
            <sui-icon name="trash alternate" color="red" inverted bordered :title="$t('myPanel_card_footer_delete')" @click="deleteHouse(house.id)" />
          </div>
        </sui-card>
      </div>
      <div v-if="vefy.status === 'pending'" class="col-md-4 my-4">
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title3") }}
        </h3>
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title3_1") }}
        </h3>
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title4") }}
        </h3>
      </div>
      <!-- FORMULARIO PARA REQUEST PEDIDO  -->
      <div v-else-if="vefy.status === 'approved'" class="col-md-4 my-4">
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title1") }}
        </h3>
        <transition name="fade" mode="out-in">
          <sui-card class="rounded-radius shadow main-red w-100">
            <div is="sui-button-group" basic size="small">
              <sui-button v-if="!form_request" :content="$t('mypanel_verif_verification_status')" fluid />
              <sui-button v-else :content="$t('mypanel_verif_verification_congrat')" fluid class="text-warning" />
            </div>
            <sui-image :src="getProfilePhoto()" class="img-fluid d-block myProfileImage" />
            <sui-card-content>
              <form method="POST" enctype="multipart/form-data" @submit.prevent="verifyRequest()" @keydown="form.onKeydown($event)">
                <alert-success :form="form" :message="$t('info_updated')" />
                <!-- FIXED AMOUNT -->
                <sui-container text-align="justified" class="my-2 text-white">
                  <sui-form>
                    <sui-form-field>
                      <label>{{ $t("mypanel_verification_amount") }} : <strong>{{ vefy.price | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}</strong> </label>
                      <input v-model="vefy.price" type="hidden">
                      <has-error :form="vefy" field="price" class="text-white" />
                    </sui-form-field>
                  </sui-form>
                </sui-container>
                <!-- DATE AND TIME -->
                <sui-container>
                  <sui-form equal-width>
                    <sui-form-field>
                      <sui-form-fields>
                        <sui-form-field>
                          <label>{{ $t("schedule_form_date") }}: <strong>{{ vefy.date }}</strong> </label>
                          <!-- <datepicker id="event_date" v-model="vefy.date" :language="'pt-br'" :placeholder="$t('schedule_form_date')" :min="'2020-01-01'" :max="'2030-12-31'" :data-vv-as="'Please enter your visit date'" name="event_date" class="rounded-pill" /> -->
                          <!-- <PickDate v-model="form.date"></PickDate> -->
                          <input v-model="vefy.date" type="hidden">
                          <has-error :form="vefy" field="date" />
                        </sui-form-field>

                        <sui-form-field>
                          <label>{{ $t("schedule_form_time") }}: <strong>{{ vefy.time }}</strong> </label>
                          <input v-model="vefy.time" type="hidden">
                          <!-- <TimePicker
                          v-model="vefy.time"
                          :class="{ 'is-invalid': vefy.errors.has('time') }"
                          :required="true"
                          :disabled="false"
                          :placeholder="$t('schedule_form_time')"
                          ></TimePicker>
                          <has-error :form="vefy" field="time" /> -->
                          <!-- <vue-timepicker v-model="vefy.time" format="H:mm:ss" input-width="100%" input-class="rounded-radius py-2" :placeholder="$t('schedule_form_time')" drop-direction="down" :minute-interval="10" :second-interval="10" close-on-complete /> -->
                          <has-error :form="vefy" field="time" />
                        </sui-form-field>
                      </sui-form-fields>
                    </sui-form-field>
                  </sui-form>
                  <div class="bg-secondary">
                    {{ $t('mypanel_verificaApprovment') }}
                  </div>
                </sui-container>
                <!-- ACCOUNT, IBAN, SEND FILE -->
                <sui-container class="mb-2 text-black">
                  <sui-tab :menu="{ text: true }">
                    <sui-tab-pane icon="users" title="Account" :attached="false">
                      Account Nº.
                    </sui-tab-pane>
                    <sui-tab-pane icon="linkify" title="IBAN" :attached="false">
                      IBAN
                    </sui-tab-pane>
                    <sui-tab-pane icon="file alternate outline" title="Send attach" :attached="false">
                      <span v-if="fileName.split('.')[1] === 'pdf'">
                        {{ fileName }}
                      </span>
                      <sui-image v-else v-show="filepreview" :src="filepreview" class="img-thumbnail w-100 h-100" fluid />
                      <div class="input-group">
                        <!-- <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="receipt">{{ $t('mypanel_verif_change_file') }}</button>
                        </div> -->
                        <div class="custom-file">
                          <input id="receipt" type="file" class="custom-file-input" aria-describedby="receipt" @change="fileSelVefy">
                          <label class="custom-file-label" for="receipt">{{ $t('mypanel_verif_upload_file') }}</label>
                        </div>
                      </div>
                      <has-error :form="vefy" field="receipt" />
                    </sui-tab-pane>
                  </sui-tab>
                </sui-container>
                <div class="divider row" />
                <sui-container>
                  <div class="field float-right">
                    <sui-button icon="info" data-toggle="modal" data-target="#more-info" :title="$t('mypanel_vefy_know_more')" @click.prevent="">
                      {{ $t("mypanel_verification_7") }}
                    </sui-button>
                    <sui-button type="submit" :loading="vefy.busy" :disabled="vefy.busy">
                      {{ $t("mypanel_verificaSend") }}
                    </sui-button>
                  </div>
                </sui-container>
              </form>
            </sui-card-content>
          </sui-card>
        </transition>
      </div>
      <div v-else-if="vefy.status === 'reserved'" class="col-md-4 my-4">
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title2") }}
        </h3>
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title2_1") }}
        </h3>
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title4") }}
        </h3>
      </div>
      <div v-else class="col-md-4 my-4">
        <h3 class="text-center text-uppercase">
          {{ $t("mypanel_verification_title1") }}
        </h3>
        <!-- INFOMATION ABOUT VERIFICATION -->
        <!-- <sui-card v-show="infor" class="rounded-radius py-3 shadow main-red w-100">
          <sui-card-content class="mb-2">
            <div class="text-white">
              <h5>{{ $t("mypanel_vefy_title1") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph1") }} </p>
              <h5>{{ $t("mypanel_vefy_title2") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph2") }} </p>
              <h5>{{ $t("mypanel_vefy_title3") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph3") }} </p>
              <h5>{{ $t("mypanel_vefy_title4") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph4") }} </p>
              <h5>{{ $t("mypanel_vefy_title5") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph5") }} </p>

              <h5>{{ $t("mypanel_vefy_paragraph6") }} </h5>
            </div>
            <div class="divider row" />
            <sui-container>
              <div class="field float-right">
                <sui-button @click="continuing">
                  {{ $t("mypanel_verification_6") }}
                </sui-button>
              </div>
            </sui-container>
          </sui-card-content>
        </sui-card> -->

        <!-- REQUEST VERIFICATION -->
        <sui-card class="content-house rounded-radius w-100 card-house">
          <sui-image :src="getProfilePhoto()" class="img-fluid d-block" />
          <sui-card-content>
            <sui-card-header> {{ form.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}/{{ form.payment_METHOD }}</sui-card-header>
            <sui-card-meta> {{ $t("announce_public_at") }} {{ form.created_at | OnlyDate }}</sui-card-meta>
            <sui-card-description class="text-lowercase">
              <span v-if="form.type">{{ form.type }}</span>
              <span v-if="form.living_room">, {{ form.living_room }} {{ $t("announce_form_living_room") }}</span>
              <span v-if="form.kitchen">, {{ form.kitchen }} {{ $t('announce_form_kitchen') }}</span>
              <span v-if="form.room">, {{ form.room }} {{ $t("announce_form_room") }}</span>
              <span v-if="form.bathroom">, {{ form.bathroom }} {{ $t("announce_form_bathroom") }}</span>
            </sui-card-description>
          </sui-card-content>
          <sui-card-content extra>
            <sui-icon name="info circle" data-toggle="modal" data-target="#more-info" :title="$t('mypanel_vefy_know_more')" class="pointme" />
            <span data-toggle="modal" data-target="#more-info" :title="$t('mypanel_vefy_know_more')" class="pointme">{{ $t('mypanel_vefy_know_more') }}</span>
          </sui-card-content>
          <div class="text-center text-muted p-3 border-top">
            <form method="POST" enctype="multipart/form-data" @submit.prevent="SendRequest()" @keydown="form.onKeydown($event)">
              <input v-model="form.user_id" type="hidden">
              <input v-model="form.house_code" type="hidden">
              <input v-model="form.username" type="hidden">
              <input v-model="form.phone" type="hidden">
              <input v-model="form.email" type="hidden">
              <input v-model="form.city" type="hidden">
              <input v-model="form.county" type="hidden">
              <input v-model="form.district" type="hidden">
              <input v-model="form.street" type="hidden">
              <input v-model="form.description" type="hidden">
              <sui-button type="submit" size="tiny">
                {{ $t("mypanel_verification_4") }}
              </sui-button>
            </form>
          </div>
        </sui-card>
      </div>
    </div>
    <!-- MORE EXPLANATION MODAL -->
    <div id="more-info" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="info" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="info" class="modal-title text-center">
              {{ $t('modal_title') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <h5>{{ $t("mypanel_vefy_title1") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph1") }} </p>
              <h5>{{ $t("mypanel_vefy_title2") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph2") }} </p>
              <h5>{{ $t("mypanel_vefy_title3") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph3") }} </p>
              <h5>{{ $t("mypanel_vefy_title4") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph4") }} </p>
              <h5>{{ $t("mypanel_vefy_title5") }} </h5>
              <p>{{ $t("mypanel_vefy_paragraph5") }} </p>

              <h5>{{ $t("mypanel_vefy_paragraph6") }} </h5>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
              {{ $t('modal_btn_close') }}
            </button>
            <button type="button" class="btn btn-primary btn-sm">
              {{ $t('modal_btn_ok') }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import Form from 'vform'
import axios from 'axios'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import toggleButton from '../../components/ToggleButton'
import Datepicker from '../../components/TouchDatePicker.vue'
import TimePicker from '../../components/TimePicker.vue'
import PickDate from '../../components/PickDate.vue'
// Manually point to the `/src` folder
import VueTimepicker from 'vue2-timepicker/src'

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
  // eslint-disable-next-line vue/no-unused-components
  components: { 'toggle-button': toggleButton, TimePicker, PickDate, Datepicker, VueTimepicker },
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },
  data: () => ({
    house: {},
    form: new Form({
      user_id: '',
      house_code: '',
      username: '',
      city: '',
      county: '',
      district: '',
      street: '',
      type: '',
      payment_METHOD: '',
      price: '',
      room: '',
      living_room: '',
      kitchen: '',
      bathroom: '',
      seal: false,
      furniture: false,
      state: false,
      description: '',
      profile: '',
      phone: '',
      email: ''
    }),
    vefy: new Form({
      id: '',
      user_id: '',
      house_code: '',
      username: '',
      phone: '',
      email: '',
      house_city: '',
      house_county: '',
      house_district: '',
      house_street: '',
      price: null,
      date: '',
      time: '',
      receipt: '',
      request_type: '',
      status: '',
      description: null
    }),
    fileName: '',
    photospreview: '',
    cities: cities,
    form_request: false,
    image: '',
    imagepreview: '',
    filepreview: '',
    src: '../images/announce/thumbnail/no-image.png',
    mustVerifyEmail: false,
    editor: ClassicEditor,
    editorData: '<p>Mais detalhes sobre emprego </p>.',
    editorConfig: {
      // Run the editor with the German UI.
      language: 'pt'
      // toolbar: [ 'bold', 'italic', '|', 'link' ] // Vai aparevcer somente esses caras
    },
    data: new FormData(),
    errors: {
    },
    percentCompleted: 0
  }),
  computed: {
    counties () {
      if (!this.form.city) {
        return
      }
      return this.cities[this.form.city].map((city) => {
        return city.name
      })
    },
    total_amount: function () {
      return this.promo.fixed_amount_per_day * this.promo.total_days
    }
  },
  mounted () {
    this.loadHouses()
    this.loadVerify()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadVerify()
      this.loadHouses()
    })
  },
  methods: {
    promoteHouse (houseCode) {
      this.$router.push('/promotion/' + houseCode)
    },
    verification (houseCode) {
      this.$router.push('/verification/' + houseCode)
    },
    addImages (houseCode) {
      this.$router.push('/add-images/' + houseCode)
    },

    deleteHouse (id) {
      // eslint-disable-next-line no-undef
      Swal.fire({
        title: this.$t('question_before_delete'),
        text: this.$t('explantation_before_delete'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('button_delete')
      }).then((result) => {
        if (result.value) { // se o resultado for verdadeiro
          // mandar o request to server
          axios.post('api/delete-house/' + id)
            .then(() => {
              // eslint-disable-next-line no-undef
              Fire.$emit('after-created')
              // eslint-disable-next-line no-undef
              Swal.fire(
                this.$t('deleted'),
                this.$t('msg_deleted_success'),
                'success'
              )
            }).catch(() => {
              // eslint-disable-next-line no-undef
              Swal.fire(this.$t('msg_deleted_error'), 'error')
            })
        }
      })
    },
    backToInfo () { this.infor = true; this.form_request = false },
    continuing () { this.infor = false; this.form_request = true },

    // REQUEST FOR VERIFICARION HOUSE
    SendRequest () {
      this.form.post('/api/request-verification')
        .then(() => {
          // eslint-disable-next-line no-undef
          Fire.$emit('after-created')
          this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
          this.$toastr.s(this.$t('mypanel_vefy_mgs_toast'))
          this.vefy.reset()
          this.vefy.clear()
          // this.$router.push({ name: 'my-panel.verificate' })
        })
        .catch(() => {
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('mypanel_vefy_mgs_toas_error'))
        })
    },
    fileSelVefy (e) {
      this.vefy.receipt = e.target.files[0]
      if (this.vefy.receipt) {
        if (/\.(jpe?g|png|gif|pdf)$/i.test(this.vefy.receipt.name)) {
          if (this.vefy.receipt.size > 4096 * 4096) {
            e.preventDefault()
            alert('File too big (> 16MB)')
            // eslint-disable-next-line no-useless-return
            return
          } else {
            const reader = new FileReader()
            reader.readAsDataURL(this.vefy.receipt)
            reader.onload = (e) => {
              this.filepreview = e.target.result
              this.fileName = this.vefy.receipt.name
            }
          }
        } else {
          alert('incompatible format')
          this.$refs.inputFile.values = null
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('schedule_form_msg_photo_type'))
        }
      }
    },
    verifyRequest () {
      const formData = new FormData()
      formData.append('receipt', this.vefy.receipt)
      formData.append('user_id', this.form.user_id)
      formData.append('house_code', this.form.house_code)
      formData.append('username', this.form.username)
      formData.append('phone', this.form.phone)
      formData.append('email', this.form.email)
      formData.append('house_city', this.form.city)
      formData.append('house_county', this.form.county)
      formData.append('house_district', this.form.district)
      formData.append('house_street', this.form.street)
      formData.append('price', this.vefy.price)
      formData.append('date', this.vefy.date)
      formData.append('time', this.vefy.time)
      formData.append('request_type', this.vefy.request_type)
      formData.append('status', 'reserved')

      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else if (this.form.phone === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_phone'))
      } else if (this.form.house_street === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_address'))
      } else if (this.vefy.date === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_date'))
      } else if (this.vefy.time === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_time'))
      } else if (this.vefy.receipt <= '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('mypanel_vefy_mgs_recept'))
      } else {
        this.vefy.busy = true
        axios
          .post('/api/update-request-verification', formData)
          .then(() => {
            this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
            this.$toastr.s(this.$t('mypanel_vefy_mgs_toast'))
            this.vefy.reset()
            this.vefy.clear()
            // eslint-disable-next-line no-undef
            Fire.$emit('after-created')
            this.vefy.busy = false
            this.form_request = true
            this.vefy.receipt = ''
            // this.$router.push({ name: 'my-panel.verificate' })
          })
          .catch(() => {
            this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
            this.$toastr.s(this.$t('mypanel_vefy_mgs_toas_error'))
          })
      }
    },
    getProfilePhoto () {
      let photo = '../images/property/thumbnail/no-image.png'
      if (this.form.profile) {
        photo = '../' + this.form.profile
      }
      return photo
    },

    viewHouse (houseCode) {
      this.$router.push('../view/' + houseCode)
    },
    loadHouses () {
      axios
        .get(`/api/edit-my-house/${this.$route.params.house_code}`)
        .then(({ data }) => {
          this.house = data
          // this.form.state = !!parseInt(this.form.state)
          this.form.fill(data)
        })
    },
    loadVerify () {
      axios
        .get(`/api/house-verification/${this.$route.params.house_code}`)
        .then(({ data }) => {
          this.vefy.fill(data)
        })
    }

  }
}
</script>
<style lang="scss">
.main-red {
  background-color: #ff3d47 !important;
  color: #f5f5f5 !important;
}
.rounded-radius {
  border-radius: 2em !important;
}
.card-house{
  .ui.card>.image>img, .ui.cards>.card>.image>img {
      /* display: block;
      width: 100%;
      height: auto;
      border-radius: inherit; */
      height: 250px;
      object-fit: cover;
      border-top-left-radius: 2em !important;
      border-top-right-radius: 2em !important;
  }
}
.myProfileImage{
    height: 150px;
    object-fit: cover;
  /* position: absolute;
  width: 500px;
        height: 300px;
        left: 0; */
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
