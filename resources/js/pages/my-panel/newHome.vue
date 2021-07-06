<template>
  <div class="container">
    <div class="row mb-3 justify-content-between align-items-center px-3">
      <h3 class="text-muted">
        {{ $t("myPanel_title_two") }}
      </h3>
      <span class=" hidden-xs-down hidden-sm-down">
        <router-link :to="{ name: 'my-panel.properties' }">
          <sui-button icon="left arrow ">{{ $t('mypanel_back') }}</sui-button>
        </router-link>
      </span>
    </div>
    <div class="div">
      <form enctype="multipart/form-data" method="POST" @submit.prevent="propertyImgUpload" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="$t('info_updated')" />
        <sui-table compact celled definition class="hidden-xs-down hidden-sm-down">
          <!-- <sui-table-header full-width>
            <sui-table-row>
                <sui-table-header-cell />
                <sui-table-header-cell>Name</sui-table-header-cell>
                <sui-table-header-cell>Registration Date</sui-table-header-cell>
                <sui-table-header-cell>E-mail address</sui-table-header-cell>
                <sui-table-header-cell>Premium Plan</sui-table-header-cell>
            </sui-table-row>
          </sui-table-header> -->
          <sui-table-body>
            <!-- City, County, District and Street -->
            <sui-table-row>
              <sui-table-cell collapsing>
                <toggle-button v-model="form.state" class="mt-2" :width="90" :value="form.state" color="#ff3d47" :labels="{checked: $t('view_house_details_stateUp'), unchecked: $t('annou_form_state')}" />
              </sui-table-cell>
              <sui-table-cell>
                <select v-model="form.city" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('city') }">
                  <option value="">
                    {{ $t("announce_form_city") }}
                  </option>
                  <option v-for="(city, index) in Object.keys(cities)" :key="index" :value="city">
                    {{ city }}
                  </option>
                </select>
                <has-error :form="form" field="city" class="text-white" />
              </sui-table-cell>
              <sui-table-cell>
                <select v-model="form.county" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('county') }">
                  <option value="">
                    {{ $t("announce_form_county") }}
                  </option>
                  <option v-for="(county, index) in counties" :key="index" :value="county">
                    {{ county }}
                  </option>
                </select>
                <has-error :form="form" field="county" class="text-white" />
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.district" :class="{ 'is-invalid': form.errors.has('district') }" class="" :placeholder="$t('announce_form_district')">
                    <has-error :form="form" field="district" class="text-white" />
                  </div>
                </div>
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.street" :class="{ 'is-invalid': form.errors.has('street') }" :placeholder="$t('announce_form_street')">
                  </div>
                </div>
              </sui-table-cell>
            </sui-table-row>
            <!-- Payment Methos, House Type, Price and Contrat -->
            <sui-table-row>
              <sui-table-cell class="collapsing">
                <toggle-button v-model="form.seal" class="mt-2" :width="90" :value="form.seal" color="#ff3d47" :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_garden')}" />
              </sui-table-cell>
              <sui-table-cell>
                <select v-model="form.contrat_type" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('contrat_type') }">
                  <option value="">
                    {{ $t("announce_form_contract") }}
                  </option>
                  <option value="Rent" v-text="$t('announce_form_contractOpt_1')" />
                  <option value="Sale" v-text="$t('announce_form_contractOpt_2')" />
                </select>
              </sui-table-cell>
              <sui-table-cell>
                <select v-model="form.type" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('type') }">
                  <option value="" disabled>
                    {{ $t("announce_form_type") }}
                  </option>
                  <option value="outhouse" v-text="$t('annou_form_type_outhouse')" />
                  <option value="Apartamento">
                    {{ $t("annou_form_type_apart") }}
                  </option>
                  <option value="Vivenda">
                    {{ $t("annou_form_type_house") }}
                  </option>
                  <option v-if="form.contrat_type == 'Sale'" value="Land">
                    {{ $t('annou_form_land') }}
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
                <has-error :form="form" field="type" />
              </sui-table-cell>
              <sui-table-cell>
                <select v-model="form.payment_METHOD" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('payment_METHOD') }">
                  <option value="">
                    {{ $t("announce_form_payment") }}
                  </option>
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
                  <option v-if="form.contrat_type == 'Sale'" value="Installment">
                    {{ $t("annou_form_payment_installment") }}
                  </option>
                  <option v-if="form.contrat_type == 'Sale'" value="Installment">
                    {{ $t("annou_form_payment_complete") }}
                  </option>
                </select>
                <has-error :form="form" field="payment_METHOD" />
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" :placeholder="$t('announce_form_price')" type="number" min="1">
                    <has-error :form="form" field="price" />
                  </div>
                </div>
              </sui-table-cell>
            </sui-table-row>
            <!-- Living room, Kitchen, Bathroom and Room -->
            <sui-table-row>
              <sui-table-cell collapsing>
                <toggle-button v-model="form.furniture" class="mt-2" :width="90" :value="form.furniture" color="#ff3d47" :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_furniture')}" />
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.living_room" :class="{ 'is-invalid': form.errors.has('living_room') }" :placeholder="$t('announce_form_living_room_q')" type="number" min="1">
                    <has-error :form="form" field="living_room" />
                  </div>
                </div>
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.kitchen" :class="{ 'is-invalid': form.errors.has('kitchen') }" :placeholder="$t('announce_form_kitchen_q')" type="number" min="1">
                    <has-error :form="form" field="kitchen" />
                  </div>
                </div>
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.room" :class="{ 'is-invalid': form.errors.has('room') }" :placeholder="$t('announce_form_roomQTD')" type="number" min="1">
                    <has-error :form="form" field="room" />
                  </div>
                </div>
              </sui-table-cell>
              <sui-table-cell>
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.bathroom" :class="{ 'is-invalid': form.errors.has('bathroom') }" :placeholder="$t('announce_form_bathroom_q')" type="number" min="1">
                    <has-error :form="form" field="bathroom" />
                  </div>
                </div>
              </sui-table-cell>
            </sui-table-row>
          </sui-table-body>
          <!-- Photo and Description -->
          <sui-table-footer full-width>
            <sui-table-row>
              <sui-table-header-cell class="p-0 m-0">
                <div style="width: 117px; height: 100px; object-fit: cover;">
                  <span v-show="imagepreview"> <sui-image :src="imagepreview" class="img-thumbnail w-100 h-100" /></span>
                  <sui-image v-show="!imagepreview" src="/images/property/thumbnail/no-image.png" class="img-thumbnail w-100 h-100" fluid />
                </div>
                <div class="px-1">
                  <label v-if="imagepreview === ''" for="attachmentName" class="btn btn-secondary btn-sm btn-block" :title="$t('property_profileImg')">
                    <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">
                    <sui-icon name="image" /> {{ $t("property_profileImgAdd") }}
                  </label>
                  <!-- <sui-button
                      v-if="imagepreview != ''"
                      color="green"
                      type="submit"
                      :loading="form.busy"
                      >{{ $t("announce_form_btn_images") }}</sui-button
                    > -->
                  <label v-if="imagepreview != ''" for="attachmentName" class="btn btn-sm btn-success btn-block">
                    <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">
                    <i class="exchange icon" /> {{ $t("announce_form_change_images") }}
                  </label>
                </div>
              </sui-table-header-cell>
              <sui-table-header-cell colspan="4">
                <div class="ui form">
                  <div class="required field text-dark">
                    <ckeditor v-model="form.description" :editor="editor" :config="editorConfig" aria-describedby="description" />
                  </div>
                </div>
                <div v-show="campus">
                  <div class="font-weight-bold text-danger text-center">
                    {{ $t("announce_form_fill_all") }}
                  </div>
                </div>
              </sui-table-header-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>
                <sui-label ribbon data-toggle="modal" data-target="#more-info" :title="$t('announce_form_more-info')" class="pointme">
                  {{ $t('announce_form_vititfee') }}
                </sui-label>
              </sui-table-cell>
              <sui-table-header-cell colspan="4">
                <sui-button floated="right" size="small" primary labeled :loading="form.busy" :disabled="form.busy">
                  <sui-icon name="save" /> {{ $t("announce_form_btn") }}
                </sui-button>
                <!-- <sui-button type="submit" size="small" class="main-red px-5 badge-pill my-4 hidden-xs-down hidden-sm-down" labeled :loading="form.busy" :disabled="form.busy">
                  <sui-icon name="save" /> {{ $t("announce_form_btn") }}
                </sui-button> -->
                <sui-button animated data-toggle="modal" data-target="#more-about" @click.prevent="">
                  <sui-button-content visible>
                    {{ form.tax_visit | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}
                  </sui-button-content>
                  <sui-button-content hidden>
                    {{ $t('announce_form_about_tax') }}
                  </sui-button-content>
                </sui-button>
                <sui-button size="small" disabled>
                  {{ form.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}
                </sui-button>
              </sui-table-header-cell>
            </sui-table-row>
          </sui-table-footer>
        </sui-table>
        <!-- RESPONSIVE FORMAT -->
        <transition name="fade" mode="out-in">
          <span class="d-md-none">
            <!-- Photo -->
            <div class="d-flex justify-content-center">
              <sui-table-header-cell class="p-0 m-0">
                <div style="width: 117px; height: 100px; object-fit: cover;">
                  <span v-show="imagepreview"> <sui-image :src="imagepreview" class="img-thumbnail w-100 h-100" /></span>
                  <sui-image v-show="!imagepreview" src="/images/property/thumbnail/no-image.png" class="img-thumbnail w-100 h-100" fluid />
                </div>
                <div class="px-1">
                  <label v-if="imagepreview === ''" for="attachmentName" class="btn btn-secondary btn-sm btn-block" :title="$t('property_profileImg')">
                    <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">
                    <sui-icon name="image" /> {{ $t("property_profileImgAdd") }}
                  </label>
                  <label v-if="imagepreview != ''" for="attachmentName" class="btn btn-sm btn-success btn-block">
                    <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">
                    <i class="exchange icon" /> {{ $t("announce_form_change_images") }}
                  </label>
                </div>
              </sui-table-header-cell>
            </div>
            <!-- State, Seal and Furniture -->
            <div class="row">
              <div class="col-4">
                <toggle-button v-model="form.state" class="mt-2" :width="100" :value="form.state" color="#ff3d47" :labels="{checked: $t('view_house_details_stateUp'), unchecked: $t('annou_form_state')}" />
              </div>
              <div class="col-4">
                <toggle-button v-model="form.seal" class="mt-2" :width="100" :value="form.seal" color="#ff3d47" :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_garden')}" />
              </div>
              <div class="col-4">
                <toggle-button v-model="form.furniture" class="mt-2" :width="100" :value="form.furniture" color="#ff3d47" :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_furniture')}" />
              </div>
            </div>
            <!-- City, County, District and Street -->
            <div class="row">
              <div class="col-md-3 mb-2">
                <select v-model="form.city" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('city') }">
                  <option value="">
                    {{ $t("announce_form_city") }}
                  </option>
                  <option v-for="(city, index) in Object.keys(cities)" :key="index" :value="city">
                    {{ city }}
                  </option>
                </select>
                <has-error :form="form" field="city" class="text-white" />
              </div>
              <div class="col-md-3 mb-2">
                <select v-model="form.county" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('county') }">
                  <option value="">
                    {{ $t("announce_form_county") }}
                  </option>
                  <option v-for="(county, index) in counties" :key="index" :value="county">
                    {{ county }}
                  </option>
                </select>
                <has-error :form="form" field="county" class="text-white" />
              </div>
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.district" :class="{ 'is-invalid': form.errors.has('district') }" class="" :placeholder="$t('announce_form_district')">
                    <has-error :form="form" field="district" class="text-white" />
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.street" :class="{ 'is-invalid': form.errors.has('street') }" :placeholder="$t('announce_form_street')">
                  </div>
                </div>
              </div>
            </div>
            <!-- Payment Methos, House Type, Price and Contrat -->
            <div class="row">
              <div class="col-md-3 mb-2">
                <select v-model="form.contrat_type" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('contrat_type') }">
                  <option value="">
                    {{ $t("announce_form_contract") }}
                  </option>
                  <option value="Rent" v-text="$t('announce_form_contractOpt_1')" />
                  <option value="Sale" v-text="$t('announce_form_contractOpt_2')" />
                </select>
              </div>
              <div class="col-md-3 mb-2">
                <select v-model="form.type" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('type') }">
                  <option value="" disabled>
                    {{ $t("announce_form_type") }}
                  </option>
                  <option value="outhouse" v-text="$t('annou_form_type_outhouse')" />
                  <option value="Apartamento">
                    {{ $t("annou_form_type_apart") }}
                  </option>
                  <option value="Vivenda">
                    {{ $t("annou_form_type_house") }}
                  </option>
                  <option v-if="form.contrat_type == 'Sale'" value="Land">
                    {{ $t('annou_form_land') }}
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
                <has-error :form="form" field="type" />
              </div>
              <div class="col-md-3 mb-2">
                <select v-model="form.payment_METHOD" class="ui dropdown w-100" :class="{ 'is-invalid': form.errors.has('payment_METHOD') }">
                  <option value="">
                    {{ $t("announce_form_payment") }}
                  </option>
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
                  <option v-if="form.contrat_type == 'Sale'" value="Installment">
                    {{ $t("annou_form_payment_installment") }}
                  </option>
                  <option v-if="form.contrat_type == 'Sale'" value="Installment">
                    {{ $t("annou_form_payment_complete") }}
                  </option>
                </select>
                <has-error :form="form" field="payment_METHOD" />
              </div>
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" :placeholder="$t('announce_form_price')" type="number" min="1">
                    <has-error :form="form" field="price" />
                  </div>
                </div>
              </div>
            </div>
            <!-- Living room, Kitchen, Bathroom and Room -->
            <div class="row">
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.living_room" :class="{ 'is-invalid': form.errors.has('living_room') }" :placeholder="$t('announce_form_living_room_q')" type="number" min="1">
                    <has-error :form="form" field="living_room" />
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.kitchen" :class="{ 'is-invalid': form.errors.has('kitchen') }" :placeholder="$t('announce_form_kitchen_q')" type="number" min="1">
                    <has-error :form="form" field="kitchen" />
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.room" :class="{ 'is-invalid': form.errors.has('room') }" :placeholder="$t('announce_form_roomQTD')" type="number" min="1">
                    <has-error :form="form" field="room" />
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-2">
                <div class="ui form">
                  <div class="field">
                    <input v-model="form.bathroom" :class="{ 'is-invalid': form.errors.has('bathroom') }" :placeholder="$t('announce_form_bathroom_q')" type="number" min="1">
                    <has-error :form="form" field="bathroom" />
                  </div>
                </div>
              </div>
            </div>
            <!-- Description -->
            <div class="row">
              <div class="col-12">
                <div class="ui form">
                  <div class="required field text-dark">
                    <ckeditor v-model="form.description" :editor="editor" :config="editorConfig" aria-describedby="description" />
                  </div>
                </div>
                <div v-show="campus">
                  <div class="font-weight-bold text-danger text-center">
                    {{ $t("announce_form_fill_all") }}
                  </div>
                </div>
              </div>
            </div>
          </span>
        </transition>
        <div class="text-center my-2">
          <sui-button size="small" disabled fluid class="d-md-none">
            {{ form.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}
          </sui-button>
          <sui-button animated="vertical" fluid data-toggle="modal" data-target="#more-info" class="d-md-none my-3" @click.prevent="">
            <sui-button-content hidden>
              {{ form.tax_visit | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}
            </sui-button-content>
            <sui-button-content visible>
              <sui-icon name="shop" /> {{ $t('announce_form_taxation') }}
            </sui-button-content>
          </sui-button>
          <sui-button type="submit" size="small" fluid class="main-red px-5 badge-pill mb-5 d-md-none" labeled :loading="form.busy" :disabled="form.busy">
            <sui-icon name="save" /> {{ $t("announce_form_btn") }}
          </sui-button>
          <router-link :to="{ name: 'my-panel.properties' }" class="d-md-none">
            <sui-button icon="left arrow " fluid>
              {{ $t('mypanel_back') }}
            </sui-button>
          </router-link>
        </div>
        <!-- Modal -->
        <div id="more-info" class="modal fade" tabindex="-1" aria-labelledby="more-infoLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="more-infoLabel" class="modal-title">
                  {{ $t('announce_form_moreService') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row align-items-center">
                  <div class="col-md-4">
                    {{ $t('announce_form_vititfe') }}
                  </div>
                  <div class="col-md-4">
                    <div class="ui form">
                      <div class="field">
                        <input v-model="form.tax_visit" :class="{ 'is-invalid': form.errors.has('tax_visit') }" :placeholder="$t('announce_form_taxation')" type="number" min="1">
                        <has-error :form="form" field="tax_visit" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="ui form">
                      <div class="field myInput">
                        {{ form.tax_visit | currency('KZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer d-flex justify-content-lg-between align-items-center">
                <sui-label circular color="grey" class="text-center pointme" data-toggle="modal" data-target="#more-about" :title="$t('announce_form_about_taxs')">
                  <sui-icon name="info" class="m-0" />
                </sui-label>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                  {{ $t('schedulStatus_cancel_btn') }}
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- MORE EXPLANATION MODAL -->
        <div id="more-about" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 id="staticBackdropLabel" class="modal-title text-center">
                  {{ $t('modal_title') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                  <div>{{ $t('modal_info_title') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph') }}</div>
                  <br>
                  <div>{{ $t('modal_info_title_1') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_1') }}</div>
                  <br>
                  <div>{{ $t('modal_info_title_2') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_2') }}</div>
                  <br>
                  <div>{{ $t('modal_info_title_3') }}</div>
                  <div>{{ $t('modal_info_paragph_3') }}</div>
                  <br>
                  <div>{{ $t('modal_info_title_4') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_4') }}</div>
                  <br>
                  <div>{{ $t('modal_info_title_5') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_5') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_5_1') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_5_2') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_5_3') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_5_4') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_6') }}</div>
                  <br>
                  <div>{{ $t('modal_info_paragph_7') }}</div>
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
      </form>
    </div>
  </div>
</template>

<script>

import Form from 'vform'
import axios from 'axios'
import toggleButton from '../../components/ToggleButton'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

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
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'my-panel.new.home',
  components: { 'toggle-button': toggleButton },
  middleware: 'auth',
  data: () => ({
    form: new Form({
      city: '',
      county: '',
      district: '',
      street: '',
      type: '',
      payment_METHOD: '',
      contrat_type: '',
      price: '',
      tax_visit: 200,
      room: '',
      living_room: '',
      kitchen: '',
      bathroom: '',
      seal: false,
      furniture: false,
      state: true,
      description: '<h3>Hi!</h3><p>Write your content here...</p>',
      profile: ''
    }),
    src: 'images/announce/1.jpg',
    mustVerifyEmail: false,

    editor: ClassicEditor,
    editorData: '<p>Mais detalhes sobre emprego </p>.',
    editorConfig: {
      // Run the editor with the German UI.
      language: 'pt'
      // toolbar: [ 'bold', 'italic', '|', 'link' ] // Vai aparevcer somente esses caras
    },
    campus: false,
    state: false,
    cities: cities,
    image: '',
    imagepreview: '',
    contracts: [
      {
        text: 'announce_form_contractOpt_1',
        value: 'rent'
      },
      {
        text: 'announce_form_contractOpt_2',
        value: 'sale'
      }
    ]
  }),
  /* computed: mapGetters({
        //authenticated: 'auth/check',
        //user: 'auth/user'
    }), */
  metaInfo () {
    return {
      title: this.$t('announce')
      /* options: [ {text: this.$t('Male')}] */
    }
  },

  computed: {
    counties () {
      if (!this.form.city) {
        return
      }
      return this.cities[this.form.city].map((city) => {
        return city.name
      })
    }
  },
  methods: {
    imageSelected (e) {
      this.form.profile = e.target.files[0]

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
      if (this.form.profile) {
        /*
            Ensure the file is an image file.
        */
        if (/\.(jpe?g|png|gif)$/i.test(this.form.profile.name)) {
          console.log('Change this format image')
          /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
          if (this.form.profile.size > 4048 * 2048) {
            e.preventDefault()
            alert('File too big (> 8MB)')
            // eslint-disable-next-line no-useless-return
            return
          } else {
            const reader = new FileReader()
            reader.readAsDataURL(this.form.profile)
            reader.onload = (e) => {
              this.imagepreview = e.target.result
            }
          }
        } else {
          alert('incompatible format')
          this.$refs.inputFile.values = null
          this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
          this.$toastr.s(this.$t('property_msg_photo_type'))
        }
      }
    },
    propertyImgUpload () {
      const formData = new FormData()
      formData.append('profile', this.form.profile)
      formData.append('city', this.form.city)
      formData.append('county', this.form.county)
      formData.append('district', this.form.district)
      formData.append('street', this.form.street)
      // formData.append('period', this.form.period);
      formData.append('type', this.form.type)
      formData.append('payment_METHOD', this.form.payment_METHOD)
      formData.append('contrat_type', this.form.contrat_type)
      formData.append('price', this.form.price)
      formData.append('tax_visit', this.form.tax_visit)
      formData.append('room', this.form.room)
      formData.append('living_room', this.form.living_room)
      formData.append('kitchen', this.form.kitchen)
      formData.append('bathroom', this.form.bathroom)
      formData.append('seal', this.form.seal)
      formData.append('furniture', this.form.furniture)
      formData.append('state', this.form.state)
      formData.append('description', this.form.description)

      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else if (
        this.form.profile === ''
      ) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(
          this.$t('property_msg_photo')
        )
      } else if (
        this.form.city === '' ||
        this.form.county === '' // || this.form.period == ''
      ) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(
          this.$t('property_msg_city_county_room')
        )
        this.campus = true
      } else if (
        this.form.district === '' ||
        this.form.street === '' // || this.form.period == ''
      ) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(
          this.$t('property_msg_district_street')
        )
        this.campus = true
      } else if (
        this.form.type === '' ||
        this.form.payment_METHOD === '' ||
        this.form.contrat_type === '' ||
        this.form.price === ''
      ) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(
          this.$t('property_msg_type_payment_METHOD_price')
        )
        this.campus = true
      } else if (!this.form.state) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('property_msg_state'))
        // this.$t('property_msg_3');
        // this.campus = true;
      } else if (this.form.profile === '') {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(this.$t('property_msg_photo'))
      } else if (this.form.profile.size > 2048 * 2048) {
        this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
        this.$toastr.s(
          this.$t('property_msg_photo_size')
        )
      } else {
        this.form.busy = true
        axios
          .post('api/save-property', formData)
          .then(() => {
            this.$toastr.defaultStyle = { 'background-color': '#21ba45' }
            this.$toastr.s(this.$t('property_message_suscceful_toastr'))
            this.form.reset()
            this.form.clear()
            this.$router.push({ name: 'my-panel.properties' })
          })
          .catch(() => {})
      }
    }
    /* async announce () {
      // Must verify email fist.
      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else {
        // announce the house.
        const { data } = await this.form.post('/api/announce')
        // Log in the user.
        // const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
                this.$store.dispatch('auth/saveToken', { token })

                // Update the user.
                await this.$store.dispatch('auth/updateUser', { user: data })
        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    } */
  }
}
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
.pointme{
  cursor: pointer!important;
}
.pointme:hover{
  color: #dc3545;
}
.myInput{
    font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
    margin: 0;
    outline: 0;
    -webkit-appearance: none;
    tap-highlight-color: rgba(255,255,255,0);
    line-height: 1.21428571em;
    padding: .67857143em 1em;
    font-size: 1em;
    background: #fff;
    border: 1px solid rgba(34,36,38,.15);
    color: rgba(0,0,0,.87);
    border-radius: .28571429rem;
    box-shadow: 0 0 0 0 transparent inset;
    transition: color .1s ease,border-color .1s ease;
}
</style>
