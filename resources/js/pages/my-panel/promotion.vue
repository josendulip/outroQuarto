<template>
  <div class="container">
    <div class="text-right my-4">
      <router-link :to="{ name: 'my-panel.promote' }" class="ui left labeled blue icon button">
        <i class="left arrow icon"></i>
        {{ $t("mypanel_back") }}
      </router-link>
      </div>   

    <!-- PREVISUALIZACAO DO IMOVEL -->
    <div class="row justify-content-center align-items-center">
      <div class="col-md-4 my-4">
        <sui-card class="rounded-radius w-100">
            <sui-image :src="getProfilePhoto()" fluid class="w-100">
            <a is="sui-label" color="black" icon="image" slot="label" ribbon>
              {{ $t('mypanel_verification_5') }}
            </a>  
          </sui-image>  
          <sui-card-content>
            <sui-card-header
              >{{
                  house.price | currency("AKZ", 2, { spaceBetweenAmountAndSymbol: true })
                }}
                akz/{{ house.payment_METHOD }}</sui-card-header
            >
            <sui-card-meta
                >{{ $t("announce_public_at") }}
                {{ house.created_at | OnlyDate }}</sui-card-meta
              >
              <sui-card-description class="text-lowercase">
                  {{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
                {{ house.living_room }} {{ $t("announce_form_living_room") }},
                {{ house.bathroom }}
                {{ $t("announce_form_bathroom") }} .</sui-card-description
              >
          </sui-card-content>
          <sui-card-content extra>
            <sui-icon name="home" />
            <span
              v-if="house.state === 'true'"
              class="text-success text-lowercase"
            >
              {{ $t("view_house_details_stateUp") }}</span
            ><span v-if="house.state === 'false'" class="text-danger text-lowercase">
              {{ $t("view_house_details_stateDown") }}</span
            >
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
      <transition name="fade" mode="out-in">
      <div class="col-md-4 my-4">
        <!-- INFOMATION ABOUT VERIFICATION -->
        <sui-card class="rounded-radius py-3 shadow main-red w-100" v-show="infor">
          <sui-card-content class="mb-2">
          <div class="text-white">            
            <p>O que é verificação? </p>
            <p>A verificação entende-se o processo interno de levantamento de dados da suposta casa a ser anunciado na plataforma. </p>
            <p>Uma forma que encontramos para valorizar a casa de modos a ter mais visualização e muito mais. </p>
            <p>Uma forma que encontramos para valorizar a casa de modos a ter mais visualização e muito mais. </p>
            <p>Uma forma que encontramos para valorizar a casa de modos a ter mais visualização e muito mais. </p>
            <p>Uma forma que encontramos para valorizar a casa de modos a ter mais visualização e muito mais. </p>
            <p>Uma forma que encontramos para valorizar a casa de modos a ter mais visualização e muito mais. </p>
            <p>Uma forma que encontramos para valorizar a casa de modos a ter mais visualização e muito mais. </p>
          </div>
          <div class="divider row"></div>
            <sui-container>
              <div class="field float-right">
                <sui-button @click="continuing">{{
                  $t("mypanel_verification_6")
                }}</sui-button>
              </div>
            </sui-container>
          </sui-card-content>
        </sui-card>

        <!-- FORMULARIO PARA REQUEST PEDIDO  -->
        <sui-card class="rounded-radius shadow main-red w-100" v-show="form_request">
          <div is="sui-button-group" basic  size="small" >
            <sui-button positive :content="$t('mypanel_verif_Promotion')" fluid />
          </div>
          <sui-card-content>
            <form
              @submit.prevent="promoteRequest()"
              method="POST"
              enctype="multipart/form-data"
              @keydown="form.onKeydown($event)"
            >
              <alert-success :form="form" :message="$t('info_updated')" />
              <!-- FIXED AMOUNT -->
              <sui-container text-align="justified" class="my-2">
                <sui-form>
                  <sui-form-field>
                    <label class="ml-3">{{ $t("mypanel_verification_1") }}</label>
                    <input
                      readonly
                      v-model="promo.fixed_amount_per_day"
                      :class="{ 'is-invalid': promo.errors.has('fixed_amount_per_day') }"
                      class="rounded-pill"
                      :placeholder="$t('mypanel_verification_1')"
                    />
                    <has-error :form="promo" field="fixed_amount_per_day" class="text-white" />
                  </sui-form-field>
                </sui-form>

              </sui-container>
              <!-- TOTAL DAYS REQUEST -->
              <sui-container text-align="justified" class="my-2">
                <sui-form>
                  <sui-form-field>
                    <label class="ml-3">{{ $t("mypanel_verification_2") }}</label>
                    <input
                    type="number"
                      v-model="promo.total_days"
                      :class="{ 'is-invalid': promo.errors.has('total_days') }"
                      class="rounded-pill"
                      :placeholder="$t('mypanel_verification_2')"
                    />
                    <has-error :form="promo" field="total_days" class="text-white" />
                  </sui-form-field>
                </sui-form>
              </sui-container>
              <sui-container text-align="justified" class="my-2">
                <sui-form>
                  <sui-form-field>
                    <label class="ml-3">{{ $t("mypanel_verification_3") }}</label>
                    <input
                    readonly
                      v-model="total_amount"
                      class="rounded-pill"
                      :placeholder="$t('mypanel_verification_3')"
                    />
                  </sui-form-field>
                </sui-form>
              </sui-container>

              <!-- ACCOUNT, IBAN, SEND FILE -->
              <sui-container class="mb-2 text-black">
                <sui-tab :menu="{ text: true }">
                  <sui-tab-pane  icon="users" title="Account" :attached="false">
                    Account Nº.
                  </sui-tab-pane>
                  <sui-tab-pane  icon="linkify" title="IBAN" :attached="false">
                    IBAN
                  </sui-tab-pane>
                  <sui-tab-pane  icon="file alternate outline" title="Send attach" :attached="false">
                    <span v-if="fileName.split('.')[1] === 'pdf'">{{fileName}}</span>
                      <sui-image v-else
                          :src="filepreview" 
                          class="img-thumbnail w-100 h-100" fluid
                          v-show="filepreview"
                        />
                        {{  }}
                    <div class="input-group">
                      <!-- <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" id="receipt_promo">{{ $t('mypanel_verif_change_file') }}</button>
                      </div> -->
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" 
                          @change="fileSelected" id="receipt_promo" aria-describedby="receipt_promo">
                        <label class="custom-file-label" for="receipt_promo">{{ $t('mypanel_verif_upload_file') }}</label>
                      </div>
                    </div>
                  </sui-tab-pane>
                </sui-tab>
              </sui-container>
              <div class="divider row"></div>
              <sui-container>
                <div class="field float-right">
                  <sui-button @click.prevent="backToInfo" icon="arrow left">{{
                    $t("mypanel_verification_7")
                  }}</sui-button>
                  <sui-button type="submit" :loading="promo.busy"  :disabled="promo.busy">{{
                    $t("mypanel_verification_4")
                  }}</sui-button>
                </div>
              </sui-container>
            </form>
          </sui-card-content>
        </sui-card>
      </div>
      </transition>
    </div>
  
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
import Form from "vform";
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import toggleButton from "../../components/ToggleButton";
import Datepicker from "../../components/TouchDatePicker.vue";
import TimePicker from "../../components/TimePicker.vue";
import PickDate from "../../components/PickDate.vue";


export default {
  middleware: "auth",
  components: {'toggle-button': toggleButton, TimePicker, PickDate, Datepicker},

  metaInfo() {
    return { title: this.$t("home") };
  },
  data: () => ({
      form: new Form({
      user_id: "",
      house_code: "",
      city: "",
      county: "",
      district: "",
      street: "",
      type: "",
      payment_METHOD: "",
      price: "",
      room: "",
      living_room: "",
      kitchen: "",
      bathroom: "",
      seal: false,
      furniture: false,
      state: false,
      description: "",
      profile: "",
      phone: "",
      email: "",
    }), 
    promo: new Form({
      user_id: "",
      house_code: "",
      username: "",
      phone:"",
      email:"",
      house_city: "",
      house_county: "",
      house_district: "",
      house_street: "",
      fixed_amount_per_day: 200,
      total_days: "",
      receipt_promo: "",
      request_type: "promo",
    }),
    addPhotos: false,
    pictures: [],
    photos: [],
    photospreview: "",
    cities: cities,
    verify: false,
    infor: true,
    form_request: false,
    verificate:true,
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
    house: {},
    readMore: false,
    image: "",
    imagepreview: "",
    filepreview: "",
    fileName: "",
    // You can store all your files here
    attachments: [],
    // Each file will need to be sent as FormData element
    data: new FormData(),
    errors: {
    },
    percentCompleted: 0,
  }),
  methods: {
    backToInfo(){this.infor = true; this.form_request = false;},
    continuing(){this.infor = false; this.form_request = true;},
    //PROMOTE HOUSE
    fileSelected(e) {
      
      this.promo.receipt_promo = e.target.files[0];
        if( this.promo.receipt_promo ){
        if ( /\.(jpe?g|png|gif|pdf)$/i.test( this.promo.receipt_promo.name ) ) {
             if (this.promo.receipt_promo.size > 4096 * 4096) {
                e.preventDefault();
                alert('File too big > 16MB)');
                return;
              }else{
                let reader = new FileReader();
                reader.readAsDataURL(this.promo.receipt_promo);
                reader.onload = (e) => {
                  this.filepreview = e.target.result;
                  this.fileName=this.promo.receipt_promo.name;
                }
            };
        }else{
          alert('incompatible format');
          this.$refs.inputFile.values=null;
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('schedule_form_msg_photo_type'));

        }
      }
    },
    promoteRequest() {
      let formData = new FormData();
      formData.append("receipt_promo", this.promo.receipt_promo);
      formData.append("user_id", this.form.user_id);
      formData.append("house_code", this.form.house_code);
      formData.append("username", this.form.username);
      formData.append("phone", this.form.phone);
      formData.append("email", this.form.email);
      formData.append("house_city", this.form.city);
      formData.append("house_county", this.form.county);
      formData.append("house_district", this.form.district);
      formData.append("house_street", this.form.street);
      formData.append("fixed_amount_per_day", this.promo.fixed_amount_per_day);
      formData.append("total_days", this.promo.total_days);
      formData.append("total_amount", this.total_amount);
      formData.append("request_type", this.promo.request_type);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else if (this.form.phone == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_phone'));
      } else if (this.form.house_street == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_address'));
      }else if (this.promo.total_days == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_days'));
      }else if (this.promo.receipt_promo == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_recept'));
      }else {
          this.promo.busy = true
        axios
          .post("/api/request-promo", formData)
          .then(() => {
            this.$toastr.defaultStyle = { "background-color": "#21ba45" };
            this.$toastr.s(this.$t("property_message_suscceful_toastr"));
            this.promo.reset();
            this.promo.clear();
            this.$router.push({ name: "my-panel.promote" });
          })
          .catch(() => {});
      }
    },
    
    
    getProfilePhoto() {
      let photo = "../images/property/thumbnail/no-image.png";
      if (this.form.profile) {
        photo = "../" + this.form.profile;
      }
      return photo;
    },

    viewHouse(house_code) {
      this.$router.push("../view/" + house_code);
    },
    loadHouses() {
      axios
        .get(`/api/edit-my-house/${this.$route.params.house_code}`)
        .then(({ data }) => {
          this.house = data;
          this.form.state = !!parseInt(this.form.state)
          this.form.fill(data);
        });
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
    total_amount: function(){
        return this.promo.fixed_amount_per_day * this.promo.total_days;
    }
  },
  mounted() {
    this.loadHouses();
    Fire.$on('AfterCreated', ()=>{
      this.loadHouses();
    });
  },
};
</script>
<style lang="scss">
.main-red {
  background-color: #ff3d47 !important;
  color: #f5f5f5 !important;
}
.rounded-radius {
  border-radius: 2em !important;
}
.ui.card>.image>img, .ui.cards>.card>.image>img {
    /* display: block;
    width: 100%;
    height: auto;
    border-radius: inherit; */
  border-top-left-radius: 2em !important;
  border-top-right-radius: 2em !important;
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
