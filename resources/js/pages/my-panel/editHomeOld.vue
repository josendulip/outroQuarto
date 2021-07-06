<template>
  <div class="container">
    <div class="text-right my-4">
      <router-link :to="{ name: 'my-panel.properties' }" class="ui left labeled blue icon button">
        <i class="left arrow icon"></i>
        {{ $t("mypanel_back") }}
      </router-link>
      </div>   
      
    <div class="div">
        <alert-success :form="form" :message="$t('info_updated')" />
        <form
          @submit.prevent="updateHouse()"
          method="POST"
          enctype="multipart/form-data"
          @keydown="form.onKeydown($event)"
        >
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
                        color="#ff3d47"
                        :labels="{checked: $t('view_house_details_stateUp'), unchecked: $t('annou_form_state')}" v-model="form.state!=0?true:false"/>
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
                    :value="form.seal!=0?true:false"
                    color="#ff3d47"
                    :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_garden')}"
                    v-model="form.seal!=0?true:false"/>
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
                </sui-table-cell>
                <sui-table-cell>
                    <select
                    class="ui dropdown w-100"
                    v-model="form.payment_METHOD"
                    :class="{ 'is-invalid': form.errors.has('payment_METHOD') }"
                    >
                    <option value="">{{ $t("announce_form_payment") }}</option>
                   <!--  <option value="Daily">
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
                        :value="form.furniture!=0?true:false"
                        color="#ff3d47"
                        :labels="{checked: $t('annou_form_garden_yes'), unchecked: $t('announce_form_furniture')}" v-model="form.furniture!=0?true:false"/>
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
                  <sui-button  type="submit" fluid class="main-red" labeled :loading="form.busy" :disabled="form.busy">
                      <sui-icon name="save" /> {{ $t("announce_form_btn") }}
                  </sui-button>
                </sui-table-cell>
            </sui-table-row>
            <sui-table-row>
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
        </sui-table> 
        </form>
    </div>

    <!-- TABLE UPLOAD IMAGE -->
    <div class="mt-4">
      <form
        @submit.prevent="profileImgUpload"
        method="POST"
        enctype="multipart/form-data"
      >
      <sui-table compact celled definition>
        <sui-table-footer full-width>
        <sui-table-row>
          
            <sui-table-header-cell class="p-0 m-0">
                <div style="width: 117px; height: 60px;">
                  <span v-show="!imagepreview">
                    <sui-image :src="getProfilePhoto()" class="img-thumbnail w-100 h-100" />
                  </span>
                  <sui-image
                    :src="imagepreview"
                    class="img-thumbnail w-100 h-100" fluid
                    v-show="imagepreview"
                  />
                </div>
            </sui-table-header-cell>
            <sui-table-header-cell colspan="4">
            
              <div  class="d-flex justify-content-between align-items-center">
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
                  @change="imageSelected"
                        ref="inputFile"
                         accept="image/x-png,image/jpeg"
                />
                      <sui-icon name="spinner" loading /> {{ $t("property_profileImg") }}
                </label>
                <label
                  v-if="imagepreview != ''"
                  for="profile"
                  class="ui icon button btn-file"
                ><i class="exchange icon"></i>
                  {{ $t("announce_form_change_images") }}
                <input
                  type="file"
                  id="profile"
                  name="profile"
                  style="display: none"
                  @change="imageSelected"
                        ref="inputFile"
                         accept="image/x-png,image/jpeg"
                /></label
                >
                <input
                  type="hidden"
                  v-model="form.house_code"
                /> 
                <sui-button
                  icon="image"
                  v-if="imagepreview != ''"
                  color="red"
                  type="submit"
                  :loading="form.busy"
                  >{{ $t("announce_form_btn_saveimg") }}</sui-button
                >
                <label class="ui button basic" @click.prevent="addPhotos =! addPhotos"> <i class="image icon"></i>{{ $t('mypanel_add_photos') }} </label>         
              </div>
            </sui-table-header-cell>
        </sui-table-row>  
        </sui-table-footer>
      </sui-table>
      </form> 
    </div> 

    <!-- PREVISUALIZACAO DO IMOVEL -->
    <div class="row justify-content-center align-items-center">
      <div class="col-md-4 my-4">
        <sui-card class="rounded-radius w-100">
            <sui-image
              :src="imagepreview"
              class="w-100 h-50 img-fluid rounded-radius-top"
              v-show="imagepreview"
            >
            <a is="sui-label" color="black" icon="image" slot="label" ribbon @click.prevent="verify =! verify">
              {{ $t('mypanel_verification_5') }}
            </a>
            </sui-image>

            <sui-image :src="getProfilePhoto()" fluid v-show="!imagepreview" class="w-100">
            <a is="sui-label" color="black" icon="image" slot="label" ribbon  @click.prevent="verify =! verify">
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
              <sui-card-description class="text-lowercase"
                >{{ house.type }}, {{ house.room }} {{ $t("announce_form_room") }},
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
      <div class="col-md-4 my-4" v-show="addPhotos">
        
        <sui-card class="rounded-radius w-100 text-center main-red" >
          <sui-card-content class="px-1">
            <sui-image-group size="tiny" class="d-inline mr-1" v-for="(picture, index) in pictures" :key="index">
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
                 accept="image/x-png,image/jpeg"
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
            
                <span v-if="pictures.length <= 19">
                  <label
                  for="attachments"
                  class="ui icon button btn-file fluid"
                  v-if="attachments == ''"
                  >
                  <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                  style="display: none"  accept="image/x-png,image/jpeg">
                  <sui-icon name="spinner" loading /> {{ $t('mypanel_add_photos') }}
                  </label>
                </span>
                <span v-else>
                        <label  class="ui icon button btn-file fluid">
                           {{$t("property_allimages")}}
                        </label>
                    </span>
                
              <label
                for="attachments"
                class="ui icon button btn-file fluid"
                 v-if="attachments != ''"
              >{{ $t('mypanel_add_photos_plus') }}
              <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                style="display: none"  accept="image/x-png,image/jpeg"></label>
              <sui-button fluid 
                v-if="attachments !=''"
                color="green"
                type="submit"
                :loading="form.busy"  @click="submit"> {{ $t('mypanel_add_photos_save') }}</sui-button>
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
      </transition>
      <transition name="fade" mode="out-in">
      <div class="col-md-4 my-4" v-show="verify">
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
            <sui-button @click.prevent="verifyHouse()" >{{ $t('mypanel_verif_verification') }}</sui-button>
            <sui-button-or :text="$t('mypanel_verif_or')" />
            <sui-button @click.prevent="promoHouse()" positive>{{ $t('mypanel_verif_Promotion') }}</sui-button>
          </div>
          <sui-card-content  v-if="verificate">
            <form
              @submit.prevent="verifyRequest()"
              method="POST"
              enctype="multipart/form-data"
              @keydown="form.onKeydown($event)"
            >
              <alert-success :form="form" :message="$t('info_updated')" />
              <!-- FIXED AMOUNT -->
              <sui-container text-align="justified" class="my-2">
                <sui-form>
                  <sui-form-field>
                    <label class="ml-3">{{ $t("mypanel_verification_amount") }}</label>
                    <input
                      readonly
                      v-model="vefy.price"
                      :class="{ 'is-invalid': vefy.errors.has('price') }"
                      class="rounded-pill"
                      :placeholder="$t('mypanel_verification_1')"
                    />
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
                        <label class="ml-3">{{ $t("schedule_form_date") }}</label>
                        <datepicker
                          v-bind:language="'pt-br'"
                          v-bind:placeholder="$t('schedule_form_date')"
                        
                          v-bind:min="'2020-01-01'"
                          v-bind:max="'2030-12-31'"
                          v-bind:data-vv-as="'Please enter your visit date'"
                          v-model="vefy.date"
                        
                          name="event_date"
                          id="event_date"
                          class="rounded-pill"
                        ></datepicker>
                        <!-- <PickDate v-model="form.date"></PickDate> -->
                        <has-error :form="vefy" field="date" />
                      </sui-form-field>

                      <sui-form-field>
                        <label class="ml-3">{{ $t("schedule_form_time") }}</label>
                        <TimePicker
                          v-model="vefy.time"
                          :class="{ 'is-invalid': vefy.errors.has('time') }"
                          :required="true"
                          :disabled="false"
                          :placeholder="$t('schedule_form_time')"
                        ></TimePicker>
                        <has-error :form="vefy" field="time" />
                      </sui-form-field>
                    </sui-form-fields>
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
                        <button class="btn btn-outline-secondary" type="button" id="receipt">{{ $t('mypanel_verif_change_file') }}</button>
                      </div> -->
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" 
                          @change="fileSelVefy" id="receipt" aria-describedby="receipt"  accept="image/x-png,image/jpeg">
                        <label class="custom-file-label" for="receipt">{{ $t('mypanel_verif_upload_file') }}</label>
                      </div>
                    </div>
                    <has-error :form="vefy" field="receipt" />
                  </sui-tab-pane>
                </sui-tab>
              </sui-container>
              <div class="divider row"></div>
              <sui-container>
                <div class="field float-right">
                  <sui-button @click.prevent="backToInfo" icon="arrow left">{{
                    $t("mypanel_verification_7")
                  }}</sui-button>
                  <sui-button type="submit" :loading="vefy.busy"  :disabled="vefy.busy">{{
                    $t("mypanel_verification_4")
                  }}</sui-button>
                </div>
              </sui-container>
            </form>
          </sui-card-content>
          <sui-card-content v-if="promote">
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
                          @change="fileSelected" id="receipt_promo" aria-describedby="receipt_promo"  accept="image/x-png,image/jpeg">
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

import Form from "vform";
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import toggleButton from "../../components/ToggleButton";
import Datepicker from "../../components/TouchDatePicker.vue";
import TimePicker from "../../components/TimePicker.vue";
import PickDate from "../../components/PickDate.vue";


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
    vefy: new Form({
      user_id: "",
      house_code: "",
      username: "",
      phone:"",
      email:"",
      house_city: "",
      house_county: "",
      house_district: "",
      house_street: "",
      price: 400,
      date: "",
      time: "",
      receipt: "",
      request_type: "verification",
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
    promote:false,
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
    verifyHouse(){this.verificate = true; this.promote = false; this.promo.reset();this.promo.clear(); this.fileName = ""; this.filepreview = ""; this.vefy.busy = false},
    promoHouse(){this.verificate = false; this.promote = true; this.vefy.reset();this.vefy.clear(); this.fileName = ""; this.filepreview = ""; this.promo.busy = false},
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
          .post("/api/send-request-promo", formData)
          .then(() => {
            this.$toastr.defaultStyle = { "background-color": "#21ba45" };
            this.$toastr.s(this.$t("property_message_suscceful_toastr"));
            this.promo.reset();
            this.promo.clear();
            this.$router.push({ name: "my-panel.properties" });
          })
          .catch(() => {});
      }
    },

    //REQUEST FOR VERIFICARION HOUSE
    fileSelVefy(e) {
      
      this.vefy.receipt = e.target.files[0];
        if( this.vefy.receipt ){
        if ( /\.(jpe?g|png|gif|pdf)$/i.test( this.vefy.receipt.name ) ) {
             if (this.vefy.receipt.size > 4096 * 4096) {
                e.preventDefault();
                alert('File too big (> 16MB)');
                return;
              }else{
                let reader = new FileReader();
                reader.readAsDataURL(this.vefy.receipt);
                reader.onload = (e) => {
                  this.filepreview = e.target.result;
                  this.fileName=this.vefy.receipt.name;
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
    verifyRequest() {
      let formData = new FormData();
      formData.append("receipt", this.vefy.receipt);
      formData.append("user_id", this.form.user_id);
      formData.append("house_code", this.form.house_code);
      formData.append("username", this.form.username);
      formData.append("phone", this.form.phone);
      formData.append("email", this.form.email);
      formData.append("house_city", this.form.city);
      formData.append("house_county", this.form.county);
      formData.append("house_district", this.form.district);
      formData.append("house_street", this.form.street);
      formData.append("price", this.form.price);
      formData.append("date", this.vefy.date);
      formData.append("time", this.vefy.time);
      formData.append("request_type", this.vefy.request_type);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else if (this.form.phone == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_phone'));
      }else if (this.form.house_street == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_address'));
      }else if (this.vefy.date == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_date'));
      }else if (this.vefy.time == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_time'));
      }else if (this.vefy.receipt == "") {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(this.$t('mypanel_vefy_mgs_recept'));
      }else {
          this.vefy.busy = true
        axios
          .post("/api/send-request-verify", formData)
          .then(() => {
            this.$toastr.defaultStyle = { "background-color": "#21ba45" };
            this.$toastr.s(this.$t("property_message_suscceful_toastr"));
            this.vefy.reset();
            this.vefy.clear();
            this.$router.push({ name: "my-panel.properties" });
          })
          .catch(() => {});
      }
    },

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
      
     /*  if(!file.type.match(e.target.files[0]['type']!= 'image/jpeg' || e.target.files[0]['type']!= 'image/jpg' || e.target.files[0]['type']!= 'image/png')){
          alert('incompatible format');
          this.$refs.inputFile.values=null;
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
            this.$toastr.s(this.$t('property_msg_photo_type'));
        return
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
             if (this.form.profile.size > 2048 * 2048) {
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

      /* if (!this.form.profile) {
        e.preventDefault();
        alert('No file chosen');
        return;
      }
      
      if (this.form.profile.size > 2048 * 2048) {
        e.preventDefault();
        alert('File too big (> 8MB)');
        return;
      } */
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
      }
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
            if(this.pictures.length <= 19){
        axios
          .post("../api/upload-house-photos", formData)
          .then(() => {
            Fire.$emit('AfterCreated');
            
             this.$toastr.s(
                this.$t('property_message_suscceful_toastr_imgs'))
          })
          .catch(() => {
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(
                    this.$t('view_favourite_message_error') 
                );
          });
          }else{
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                    this.$toastr.s(
                        this.$t('view_favourite_message_error_add') 
                    );
            }
      }
    },   
    getProfilePhoto() {
      let photo = "../images/property/thumbnail/no-image.png";
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
             this.$toastr.s(
                this.$t('property_message_suscceful_toastr_imgs'))
          })
          .catch(() => {
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(
                    this.$t('view_favourite_message_error') 
                );
          });
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
          this.form.state = !!parseInt(this.form.state)
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
          /* if (files.size > 4096 * 4096) {
            e.preventDefault();
            alert('File too big > 16MB)');
            return;
          }else{ */
            for (var i = files.length - 1; i >= 0; i--) {
                this.attachments.push(files[i]);
            }
            Fire.$emit('AfterCreated');
            // Reset the form to avoid copying these files multiple times into this.attachments
            document.getElementById("attachments").value = [];
          //}
            
    },
    submit() {
        this.prepareFields();
        var config = {
            headers: { 'Content-Type': 'multipart/form-data' } ,
            onUploadProgress: function(progressEvent) {
                this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                this.$forceUpdate();
            }.bind(this)
        };
            if(this.pictures.length <= 19){
        // Make HTTP request to store announcement
        axios.post("../api/upload-house-photos", this.data, config)
        .then(function (response) {
            Fire.$emit('AfterCreated');
            console.log(response);
            if (response.data.success) {
                console.log('Successfull Upload');
                this.$toastr.s(
                this.$t('property_message_suscceful_toastr_imgs') 
            );
                this.resetData();
            } else {
                console.log('Unsuccessful Upload');
                this.errors = response.data.errors;
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                this.$toastr.s(
                    this.$t('view_favourite_message_error') 
                );
            }
        }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
        .catch(function (error) {
            console.log(error);
        });
            }else{
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                    this.$toastr.s(
                        this.$t('view_favourite_message_error_add') 
                    );
            }
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
        this.$toastr.defaultStyle = { "background-color": "#21ba45" };
        this.$toastr.s(this.$t("property_message_suscceful_deleted_toastr"));
        console.log('delected');      
      })
       .catch( () => {
        this.$toastr.defaultStyle = { "background-color": "#FF5859" };
        this.$toastr.s(
            this.$t('property_msg_photo')
        );
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
    total_amount: function(){
        return this.promo.fixed_amount_per_day * this.promo.total_days;
    }
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
