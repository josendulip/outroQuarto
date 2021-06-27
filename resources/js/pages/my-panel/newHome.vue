<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">{{ $t("myPanel_title_two") }}</h3>
      <span>
      <router-link :to="{ name: 'my-panel.properties' }">
      <sui-button icon="left arrow ">{{ $t('mypanel_back') }}</sui-button>
      </router-link>
      </span>
    </div>
    <div class="div">
        <form
        @submit.prevent="propertyImgUpload"
        method="POST"
        enctype="multipart/form-data"
        @keydown="form.onKeydown($event)"
        >
        <alert-success :form="form" :message="$t('info_updated')" />
        <sui-table compact celled definition>
            <sui-table-header full-width>
            <sui-table-row>
                <sui-table-header-cell />
                <sui-table-header-cell>Name</sui-table-header-cell>
                <sui-table-header-cell>Registration Date</sui-table-header-cell>
                <sui-table-header-cell>E-mail address</sui-table-header-cell>
                <sui-table-header-cell>Premium Plan</sui-table-header-cell>
            </sui-table-row>
            </sui-table-header>
            <sui-table-body>
                <!-- City, County, District and Street -->
            <sui-table-row>
                <sui-table-cell collapsing>
                    <toggle-button
                        class="mt-2"
                        :width="90"
                        :value="form.state"
                        color="#ff3d47"
                        :labels="{checked: $t('view_house_details_stateUp'), unchecked: $t('annou_form_state')}"
                        v-model="form.state"/>
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.city"
                    :class="{ 'is-invalid': form.errors.has('city') }"
                    >
                    <option value="">{{ $t("announce_form_city") }}</option>
                    <option
                        :value="city"
                        v-for="(city, index) in Object.keys(cities)"
                        :key="index"
                    >
                        {{ city }}
                    </option>
                    </select>
                    <has-error :form="form" field="city" class="text-white" />
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.county"
                    :class="{ 'is-invalid': form.errors.has('county') }"
                    >
                    <option value="">{{$t("announce_form_county")}}</option>
                    <option
                        :value="county"
                        v-for="(county, index) in counties"
                        :key="index"
                    >
                        {{ county }}
                    </option>
                    </select>
                    <has-error :form="form" field="county" class="text-white" />
                </sui-table-cell>
                <sui-table-cell>
                    <div class="ui form">
                        <div class="field">
                            <input
                                v-model="form.district"
                                :class="{ 'is-invalid': form.errors.has('district') }"
                                class=""
                                :placeholder="$t('announce_form_district')"
                                />
                            <has-error :form="form" field="district" class="text-white" />
                        </div>
                    </div>
                </sui-table-cell>    
                <sui-table-cell>
                    <div class="ui form">
                        <div class="field">
                          <input
                            v-model="form.street"
                            :class="{ 'is-invalid': form.errors.has('street') }"
                            :placeholder="$t('announce_form_street')"
                          />
                        </div>
                    </div>
                </sui-table-cell>
            </sui-table-row>
                <!-- City, County, District and Street -->
            <sui-table-row>
                <sui-table-cell class="collapsing">
                <toggle-button
                    class="mt-2"
                    :width="90"
                    :value="form.seal"
                    color="#ff3d47"
                    :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_garden')}"
                    v-model="form.seal"/>
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.type"
                    :class="{ 'is-invalid': form.errors.has('type') }"
                    >
                    <option value="" disabled>{{ $t("announce_form_type") }}</option>
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
                   <!--  <option value="Albergue">
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
                    </option> -->
                    </select>
                    <has-error :form="form" field="type" class="text-white" />
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.payment_METHOD"
                    :class="{ 'is-invalid': form.errors.has('payment_METHOD') }"
                    >
                    <option value="">{{ $t("announce_form_payment") }}</option>
                    <!-- <option value="Daily">
                        {{ $t("annou_form_payment_daily") }}
                    </option>
                    <option value="Weekly">
                        {{ $t("annou_form_payment_weekly") }}
                    </option> -->
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
                </sui-table-cell>
                <sui-table-cell>
                    <div class="ui form">
                    <div class="field">
                        <input
                        v-model="form.price"
                        :class="{ 'is-invalid': form.errors.has('price') }"
                        :placeholder="$t('announce_form_price')"
                        type="number"
                        />
                        <has-error :form="form" field="price" class="text-white" />
                    </div>
                    </div>
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.room"
                    :class="{ 'is-invalid': form.errors.has('room') }"
                    >
                    <option value="" disabled>{{ $t("announce_form_room") }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="8">8</option>
                    <option value="8">8</option>
                    <option value="10+">10+</option>
                    </select>
                    <has-error :form="form" field="room" class="text-white" />
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row>
                <sui-table-cell collapsing>
                    <toggle-button
                        class="mt-2"
                        :width="90"
                        :value="form.furniture"
                        color="#ff3d47"
                        :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_furniture')}"
                        v-model="form.furniture"/>
                </sui-table-cell>
                <sui-table-cell>  
                    <select
                    class="ui dropdown w-100"
                    v-model="form.living_room"
                    :class="{ 'is-invalid': form.errors.has('living_room') }"
                    >                  
                    <option value="" disabled>{{
                    $t("announce_form_living_room")
                    }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6+">6+</option>
                    </select>
                    <has-error :form="form" field="living_room" />
                </sui-table-cell>
                <sui-table-cell>                    
                    <select
                    class="ui dropdown w-100"
                    v-model="form.kitchen"
                    :class="{ 'is-invalid': form.errors.has('kitchen') }"
                    >
                    <option value="" disabled>{{ $t("announce_form_kitchen") }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5+">5+</option>
                    </select>
                    <has-error :form="form" field="kitchen" />
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.bathroom"
                    :class="{ 'is-invalid': form.errors.has('bathroom') }"
                    >
                    <option value="" disabled>{{ $t("announce_form_bathroom") }}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5+">5+</option>
                    </select>
                    <has-error :form="form" field="bathroom"/>
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="texter"
                    >
                    <option value="" disabled>{{ $t("annou_form_description") }}</option>
                    <option value="yes">{{ $t("annou_form_garden_yes") }}</option>
                    <option value="not">{{ $t("annou_form_garden_not") }}</option>
                    </select>
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row v-show="texter == 'yes'">
                <sui-table-cell colspan="5">
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
                </sui-table-cell>
            </sui-table-row>
            </sui-table-body>
            <sui-table-footer full-width>
            <sui-table-row>
                <sui-table-header-cell class="p-0 m-0">
                    <div style="width: 117px; height: 60px;">
                      <span v-show="imagepreview">
                        <sui-image :src="imagepreview" class="img-thumbnail w-100 h-100" />
                      </span>
                      <sui-image
                        src="/images/property/thumbnail/no-image.png"
                        class="img-thumbnail w-100 h-100" fluid
                        v-show="!imagepreview"
                      />
                    </div>
                </sui-table-header-cell>
                <sui-table-header-cell colspan="4">
                
                  <div  class="d-flex justify-content-between align-items-center">
                    <label
                        size="small"
                      v-if="imagepreview === ''"
                      for="attachmentName"
                      class="ui icon button btn-file"
                    >
                      <input
                        type="file"
                        id="attachmentName"
                        name="attachmentName"
                        style="display: none"
                        @change="imageSelected"
                        accept="image/png, image/jpeg" 
                        ref="inputFile"
                      />
                      <sui-icon name="image" /> {{ $t("property_profileImg") }}
                    </label>
                    <!-- <sui-button
                      icon="image"
                      v-if="imagepreview != ''"
                      color="green"
                      type="submit"
                      :loading="form.busy"
                      >{{ $t("announce_form_btn_images") }}</sui-button
                    > -->
                    
                    <div class="" v-show="campus">
                    <div class="font-weight-bold text-danger text-center">
                        {{ $t("announce_form_fill_all") }}
                    </div>
                    </div>
                    <label
                        size="small"
                      v-if="imagepreview != ''"
                      for="attachmentName"
                      class="ui icon button btn-file"
                    >
                      <input
                        type="file"
                        id="attachmentName"
                        name="attachmentName"
                        style="display: none"
                        @change="imageSelected"                        
                        accept="image/png, image/jpeg" 
                        ref="inputFile"
                      /><i class="exchange icon"></i>
                      {{ $t("announce_form_change_images") }}</label
                    >
                    <sui-button  type="submit" size="small" class="main-red" labeled :loading="form.busy" :disabled="form.busy">
                        <sui-icon name="save" /> {{ $t("announce_form_btn") }}
                    </sui-button>
                  </div>
                </sui-table-header-cell>
            </sui-table-row>
            </sui-table-footer>
        </sui-table>
        </form>      
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
import toggleButton from "../../components/ToggleButton";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  middleware: 'auth',
  name: "my-panel.new.home",
  components: {'toggle-button': toggleButton},
  data: () => ({
    form: new Form({
      city: "",
      county: "",
      district: "",
      street: "",
      //period: "",
      type: "",
      payment_METHOD: "",
      price: "",
      room: "",
      living_room: "",
      kitchen: "",
      bathroom: "",
      seal: false,
      furniture: false,
      state: true,
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

      /* if(e.target.files[0]['type']!= 'image/jpeg'){
          alert('incompatible format');
          this.$refs.inputFile.values=null;
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
            this.$toastr.s(this.$t('property_msg_photo_type'));
        return
        }
      if (!this.form.profile) {
        e.preventDefault();
        alert('No file chosen');
        return;
      }
      
      if (this.form.profile.size > 2048 * 2048) {
        e.preventDefault();
        alert('File too big (> 8MB)');
        return;
      } */
        if( this.form.profile ){
        /*
            Ensure the file is an image file.
        */
        if ( /\.(jpe?g|png|gif)$/i.test( this.form.profile.name ) ) {
            
            console.log("here");
            /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
             if (this.form.profile.size > 4048 * 2048) {
                e.preventDefault();
                alert('File too big (> 8MB)');
                return;
              }else{
                let reader = new FileReader();
                reader.readAsDataURL(this.form.profile);
                reader.onload = (e) => {
                  this.imagepreview = e.target.result;
                }
            };
        }else{
          alert('incompatible format');
          this.$refs.inputFile.values=null;
          this.$toastr.defaultStyle = { "background-color": "#FF5859" };
          this.$toastr.s(this.$t('property_msg_photo_type'));

        }
      }
    },
    propertyImgUpload() {
      let formData = new FormData();
      formData.append("profile", this.form.profile);
      formData.append("city", this.form.city);
      formData.append("county", this.form.county);
      formData.append("district", this.form.district);
      formData.append("street", this.form.street);
      //formData.append("period", this.form.period);
      formData.append("type", this.form.type);
      formData.append("payment_METHOD", this.form.payment_METHOD);
      formData.append("price", this.form.price);
      formData.append("room", this.form.room);
      formData.append("living_room", this.form.living_room);
      formData.append("kitchen", this.form.kitchen);
      formData.append("bathroom", this.form.bathroom);
      formData.append("seal", this.form.seal);
      formData.append("furniture", this.form.furniture);
      formData.append("state", this.form.state);
      formData.append("description", this.form.description);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else if (
        this.form.profile == ""
      ) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_photo')
        );
      }else if (
        this.form.city == "" ||
        this.form.county == "" //|| this.form.period == ""
      ) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_city_county_room')
        );
      } else if (
        this.form.district == "" ||
        this.form.street == "" //|| this.form.period == ""
      ) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_district_street')
        );
      } else if (
        this.form.kitchen == "" ||
        this.form.room == "" //|| this.form.period == ""
      ) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_kitchen_room')
        );
      }else if (
        this.form.type == "" ||
        this.form.payment_METHOD == "" ||
        this.form.price == ""
      ) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_type_payment_METHOD_price')
        );
        this.campus = true;
      } else if (this.form.living_room == "" || this.form.bathroom == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_living_bath_room') 
        );
        this.campus = true;
      } else if (!this.form.state) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_state') 
        );
        //this.$t('property_msg_3');
        //this.campus = true;
      }/* else if (!this.form.seal) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_seal') 
        );
      }else if (!this.form.furniture) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_furniture') 
        );
      } */
      else if (this.form.profile == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_photo')
        );
      } /* else if(e.target.files[0]['type']!= 'image/jpeg'){
           this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_photo_type')
        );
        } */
        else if (this.form.profile.size > 2048 * 2048) {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_photo_size')
        );
      }else {
          this.form.busy = true
        axios
          .post("api/save-property", formData)
          .then(() => {
            this.$toastr.defaultStyle = { "background-color": "#21ba45" };
            this.$toastr.s(this.$t("property_message_suscceful_toastr"));
            this.form.reset();
            this.form.clear();
            this.$router.push({ name: "my-panel.properties" });
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
  color: #f5f5f5 !important;
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
select {
  color: #a9a9a9;
}
option {
  color: #000;
}
option:first-child {
  color: #ccc;
}
select.ng-dirty {
  color: #a9a9a9;
}
</style>
