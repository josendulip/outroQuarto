<template>
  <div class="container">
    <div class="text-right my-4 hidden-xs-down hidden-sm-down">
      <router-link :to="{ name: 'my-panel.properties' }" class="ui left labeled blue icon button">
        <i class="left arrow icon" />
        {{ $t("mypanel_back") }}
      </router-link>
    </div>
    <div class="row mt-4 hidden-xs-down hidden-sm-down">
      <div class="col-md-3">
        <sui-card class="content-house rounded-radius w-100">
          <sui-image v-if="!imagepreview" :src="getProfilePhoto()" class="myProfileImage" />
          <sui-image v-else :src="imagepreview" class="myProfileImage" />
          <p class="title-house">
            <span v-if="house.add_images =='has'">
              <i class="images outline icon" /> <small>{{ $t('property_has_yes') }}</small>
            </span>
            <span v-if="house.add_images == 'hasnot'">
              <i class="unlink icon" /> <small>{{ $t('property_has_no') }}</small>
            </span>
          </p>
          <div class="overlay-house" />
          <div class="button-house">
            <div is="sui-button-group">
              <sui-button icon="pencil" @click.prevent="editHouse(house.house_code)" />
              <!-- {{$t("myPanel_card_footer_edit")}} -->
              <sui-button icon="eye icon" @click.prevent="viewHouse(house.house_code)" />
              <!-- {{ $t("myPanel_card_footer_view") }} -->
              <sui-button icon="minus circle" @click="deleteHouse(house.id)" />
            </div>
            <button class="btn btn-warning mb-0 button-down text-white" @click="addImages(house.house_code)">
              {{ $t('property_add_img') }}
            </button>
          </div>
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
        </sui-card>
      </div>
      <div class="col-md-9">
        <alert-success :form="form" :message="$t('info_updated')" />
        <form method="POST" enctype="multipart/form-data" @submit.prevent="updateHouse()" @keydown="form.onKeydown($event)">
          <!-- <toggle-button v-model="form.state" class="mt-2" :width="90" :value="form.state" color="#ff3d47" :labels="{checked: $t('view_house_details_stateUp'), unchecked: $t('annou_form_state')}" />
          <toggle-button v-model="form.seal" class="mt-2" :width="90" :value="form.seal" color="#ff3d47" :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_garden')}" />
          <toggle-button v-model="form.furniture" class="mt-2" :width="90" :value="form.furniture" color="#ff3d47" :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_furniture')}" /> -->
          <sui-table compact celled definition>
            <sui-table-header full-width>
              <sui-table-row>
                <sui-table-header-cell>
                  <sui-label ribbon data-toggle="modal" data-target="#more-info" :title="$t('announce_form_more-info')" class="pointme">
                    {{ $t('announce_form_vititfee') }}
                  </sui-label>
                </sui-table-header-cell>
                <sui-table-header-cell>
                  <router-link :to="{'name': 'my-panel.verification'}" class="mini fluid ui button">
                    {{ $t('property_verify') }}
                  </router-link>
                </sui-table-header-cell>
                <sui-table-header-cell>
                  <router-link :to="{'name': 'my-panel.promotion'}" class="mini fluid ui button">
                    {{ $t('mypanel_promotion_btn') }}
                  </router-link>
                </sui-table-header-cell>
                <sui-table-header-cell>
                  <router-link :to="{'name': 'my-panel.add.images'}" class="mini fluid ui button">
                    {{ $t('mypanel_add_photos') }}
                  </router-link>
                </sui-table-header-cell>
                <sui-table-header-cell class="text-center text-primary">
                  {{ form.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }}
                </sui-table-header-cell>
              </sui-table-row>
            </sui-table-header>
            <sui-table-body>
              <sui-table-row>
                <sui-table-cell collapsing>
                  <sui-checkbox v-model="form.state" toggle :value="form.state" :title="$t('annou_form_state')" />
                  <!-- <toggle-button v-model="form.state" class="mt-2" :width="90" :value="form.state.toString()" color="#ff3d47" :labels="{checked: $t('view_house_details_stateUp'), unchecked: $t('annou_form_state')}" /> -->
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
                  <sui-checkbox v-model="form.seal" toggle :value="form.seal" :title="$t('announce_form_garden')" />
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
                  <sui-checkbox v-model="form.furniture" toggle :value="form.furniture" :title="$t('announce_form_furniture')" />
                </sui-table-cell>
                <sui-table-cell>
                  <div v-if="form.type == 'Land'" class="ui form">
                    <div class="field">
                      <input v-model="form.width" :class="{ 'is-invalid': form.errors.has('width') }" :placeholder="$t('announce_form_width')" type="number" min="1">
                      <has-error :form="form" field="width" />
                    </div>
                  </div>
                  <div v-else class="ui form">
                    <div class="field">
                      <input v-model="form.living_room" :class="{ 'is-invalid': form.errors.has('living_room') }" :placeholder="$t('announce_form_living_room_q')" type="number" min="1">
                      <has-error :form="form" field="living_room" />
                    </div>
                  </div>
                </sui-table-cell>
                <sui-table-cell>
                  <div v-if="form.type == 'Land'" class="ui form">
                    <div class="field">
                      <input v-model="form.length" :class="{ 'is-invalid': form.errors.has('length') }" :placeholder="$t('announce_form_length')" type="number" min="1">
                      <has-error :form="form" field="length" />
                    </div>
                  </div>
                  <div v-else class="ui form">
                    <div class="field">
                      <input v-model="form.kitchen" :class="{ 'is-invalid': form.errors.has('kitchen') }" :placeholder="$t('announce_form_kitchen_q')" type="number" min="1">
                      <has-error :form="form" field="kitchen" />
                    </div>
                  </div>
                </sui-table-cell>
                <sui-table-cell>
                  <div v-if="form.type == 'Land'" class="ui form">
                    <div class="field">
                      <input v-model="areas" :class="{ 'is-invalid': form.errors.has('area') }" :placeholder="$t('announce_form_area')" type="number" min="1" readonly>
                      <has-error :form="form" field="area" />
                    </div>
                  </div>
                  <div v-else class="ui form">
                    <div class="field">
                      <input v-model="form.room" :class="{ 'is-invalid': form.errors.has('room') }" :placeholder="$t('announce_form_roomQTD')" type="number" min="1">
                      <has-error :form="form" field="room" />
                    </div>
                  </div>
                </sui-table-cell>
                <sui-table-cell>
                  <div v-if="form.type == 'Land'" class="myInput">
                    <span>{{ form.width }} m * {{ form.length }} m  = {{ areas }} m2</span>
                  </div>
                  <div v-else class="ui form">
                    <div class="field">
                      <input v-model="form.bathroom" :class="{ 'is-invalid': form.errors.has('bathroom') }" :placeholder="$t('announce_form_bathroom_q')" type="number" min="1">
                      <has-error :form="form" field="bathroom" />
                    </div>
                  </div>
                </sui-table-cell>
              </sui-table-row>
              <!-- Photo and Description -->
              <sui-table-row>
                <sui-table-cell>
                  <form method="POST" enctype="multipart/form-data" @submit.prevent="profileImgUpload">
                    <div class="px-1">
                      <label v-if="imagepreview === ''" for="attachmentName" class="btn btn-secondary btn-sm btn-block" :title="$t('property_profileImg')">
                        <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected"> {{ $t("property_profileImgAdd") }}
                      </label>
                      <label v-if="imagepreview != ''" for="attachmentName" class="btn btn-sm btn-success btn-block">
                        <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">{{ $t("announce_form_change_images") }}
                      </label>
                      <sui-button v-if="imagepreview != ''" icon="image" color="red" type="submit" :loading="form.busy">
                        {{ $t("announce_form_btn_saveimg") }}
                      </sui-button>
                    </div>
                  </form>
                </sui-table-cell>
                <sui-table-cell colspan="4">
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
                </sui-table-cell>
              </sui-table-row>
            </sui-table-body>
            <sui-table-footer full-width>
              <sui-table-row>
                <sui-table-header-cell class="text-center">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#more-info" :title="$t('announce_form_more-info')">
                    <i class="info circle icon m-0" />
                  </button>
                </sui-table-header-cell>
                <sui-table-header-cell colspan="4">
                  <sui-button floated="right" size="small" primary labeled>
                    <sui-icon name="save" /> {{ $t('mypanel_add_photos_save') }}
                  </sui-button>
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
                          {{ form.tax_visit | currency('AKZ', 2, { symbolOnLeft: false, spaceBetweenAmountAndSymbol: true }) }}
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
    <!-- RESPONSIVE FORMAT -->
    <transition name="fade" mode="out-in">
      <form method="POST" enctype="multipart/form-data" class="d-md-none" @submit.prevent="profileImgUpload">
        <alert-success :form="form" :message="$t('info_updated')" />
        <!-- Photo -->
        <div class="d-flex justify-content-center">
          <sui-table-header-cell class="p-0 m-0">
            <div style="width: 117px; height: 100px; object-fit: cover;">
              <sui-image v-if="!imagepreview" :src="getProfilePhoto()" class="img-thumbnail w-100 h-100" />
              <sui-image v-else :src="imagepreview" class="img-thumbnail w-100 h-100" />
            </div>
            <div class="px-1">
              <label v-if="imagepreview === ''" for="attachmentName" class="btn btn-secondary btn-sm btn-block" :title="$t('property_profileImg')">
                <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">
                <sui-icon name="image" /> {{ $t("property_profileImgAdd") }}
              </label>
              <label v-if="imagepreview != ''" for="attachmentName" class="btn btn-success btn-sm btn-block">
                <input id="attachmentName" ref="inputFile" type="file" name="attachmentName" style="display: none" accept="image/png, image/jpeg" @change="imageSelected">
                <i class="exchange icon" /> {{ $t("announce_form_change_images") }}
              </label>
              <sui-button v-if="imagepreview != ''" icon="image" color="red" type="submit" :loading="form.busy" class="px-4">
                {{ $t("announce_form_btn") }}
              </sui-button>
            </div>
          </sui-table-header-cell>
        </div>
      </form>
    </transition>
    <transition name="fade" mode="out-in">
      <form method="POST" enctype="multipart/form-data" class="d-md-none" @submit.prevent="updateHouse()" @keydown="form.onKeydown($event)">
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
            <!-- <span v-if="form.price"> {{ form.price | currency("AOA", 2, { spaceBetweenAmountAndSymbol: true }) }} </span> -->
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
            <div v-if="form.type == 'Land'" class="ui form">
              <div class="field">
                <input v-model="form.width" :class="{ 'is-invalid': form.errors.has('width') }" :placeholder="$t('announce_form_width')" type="number" min="1">
                <has-error :form="form" field="width" />
              </div>
            </div>
            <div v-else class="ui form">
              <div class="field">
                <input v-model="form.living_room" :class="{ 'is-invalid': form.errors.has('living_room') }" :placeholder="$t('announce_form_living_room_q')" type="number" min="1">
                <has-error :form="form" field="living_room" />
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div v-if="form.type == 'Land'" class="ui form">
              <div class="field">
                <input v-model="form.length" :class="{ 'is-invalid': form.errors.has('length') }" :placeholder="$t('announce_form_length')" type="number" min="1">
                <has-error :form="form" field="length" />
              </div>
            </div>
            <div v-else class="ui form">
              <div v-if="form.type == 'Land'" class="ui form">
                <div class="field">
                  <input v-model="areas" :class="{ 'is-invalid': form.errors.has('area') }" :placeholder="$t('announce_form_area')" type="number" min="1" readonly>
                  <has-error :form="form" field="area" />
                </div>
              </div>
              <div v-else class="field">
                <input v-model="form.kitchen" :class="{ 'is-invalid': form.errors.has('kitchen') }" :placeholder="$t('announce_form_kitchen_q')" type="number" min="1">
                <has-error :form="form" field="kitchen" />
              </div>
            </div>
          </div>
          <div class="col-md-3 mb-2">
            <div v-if="form.type == 'Land'" class="myInput">
              <span>{{ form.width }} m * {{ form.length }} m  = {{ areas }} m2</span>
            </div>
            <div v-else class="ui form">
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
      </form>
    </transition>
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
  components: { 'toggle-button': toggleButton, TimePicker, PickDate, Datepicker },
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },
  data: () => ({
    form: new Form({
      user_id: '',
      house_code: '',
      city: '',
      county: '',
      district: '',
      street: '',
      type: '',
      payment_METHOD: '',
      contrat_type: '',
      price: '',
      tax_visit: '',
      room: '',
      living_room: '',
      kitchen: '',
      bathroom: '',
      seal: false,
      furniture: false,
      state: false,
      width: 0,
      length: 0,
      area: 0,
      description: '',
      profile: '',
      phone: '',
      email: ''
    }),
    campus: false,
    pictures: [],
    photos: [],
    cities: cities,
    mustVerifyEmail: false,

    editor: ClassicEditor,
    editorData: '<p>Mais detalhes sobre emprego </p>.',
    editorConfig: {
      // Run the editor with the German UI.
      language: 'pt'
      // toolbar: [ 'bold', 'italic', '|', 'link' ] // Vai aparevcer somente esses caras
    },
    // fields: false,
    house: {},
    image: '',
    imagepreview: '',
    filepreview: '',
    fileName: '',
    // You can store all your files here
    attachments: [],
    // Each file will need to be sent as FormData element
    data: new FormData(),
    errors: {
    }
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
    areas: function () {
      return this.form.width * this.form.length
    },
    modifiedDate: function () {
      return document.write(this.form.state.toString())
    }
  },
  mounted () {
    this.loadHouses()
    // eslint-disable-next-line no-undef
    Fire.$on('after-created', () => {
      this.loadHouses()
    })
  },
  methods: {
    addImages (houseCode) {
      this.$router.push('/add-images/' + houseCode)
    },
    viewHouse (houseCode) {
      this.$router.push('../view/' + houseCode)
    },
    imageSelected (e) {
      this.form.profile = e.target.files[0]
      /* if(!file.type.match(e.target.files[0]['type']!= 'image/jpeg' || e.target.files[0]['type']!= 'image/jpg' || e.target.files[0]['type']!= 'image/png')){
          alert('incompatible format');
          this.$refs.inputFile.values=null;
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
            this.$toastr.s(this.$t('property_msg_photo_type'));
        return
      } */
      if (this.form.profile) {
        /*
            Ensure the file is an image file.
        */
        if (/\.(jpe?g|png|gif)$/i.test(this.form.profile.name)) {
          if (this.form.profile.size > 2048 * 2048) {
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
          console.log('Change format file')
        }
      }
    },
    photoSelected (e) {
      const files = this.$refs.photo.photos

      if (!files.length) {
        return false
      }

      for (let i = 0; i < files.length; i++) {
        this.photospreview = this.photos.push(files[i])
      }
    },
    profileImgUpload () {
      const formData = new FormData()
      formData.append('profile', this.form.profile)
      formData.append('house_code', this.form.house_code)

      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else {
        axios
          .post('../api/change-profile-house-picture', formData)
          .then(() => {
            // eslint-disable-next-line no-undef
            Fire.$emit('after-created')
            this.$toastr.s(this.$t('property_message_suscceful_toastr_imgs'))
            this.imagepreview = ''
          })
          .catch(() => {
            this.$toastr.defaultStyle = { 'background-color': '#FF5859' }
            this.$toastr.s(this.$t('view_favourite_message_error'))
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
    async updateHouse () {
      if (this.$store['auth/user']) {
        this.mustVerifyEmail = true
      } else {
        // eslint-disable-next-line no-unused-vars
        const { data } = await this.form.post(
          '/api/update-house/' + this.form.house_code
        )
        // eslint-disable-next-line no-undef
        Fire.$emit('after-created')
        // this.$router.push({ name: "my-panel" });
      }
    },
    loadHouses () {
      axios
        .get(`/api/edit-my-house/${this.$route.params.house_code}`)
        .then(({ data }) => {
          this.house = data
          this.form.state = !!parseInt(this.form.state)
          this.form.fill(data)
        })
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
.ui.card>.image>img, .ui.cards>.card>.image>img {
    /* display: block;
    width: 100%;
    height: auto;
    border-radius: inherit; */
  border-top-left-radius: 2em !important;
  border-top-right-radius: 2em !important;
}
.myProfileImage{
    object-fit: cover;
    width: 100%;
    min-height: 200px;
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
.myInput{
    font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;
    margin: 0;
    outline: 0;
    -webkit-appearance: none;
    // tap-highlight-color: rgba(255,255,255,0);
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
