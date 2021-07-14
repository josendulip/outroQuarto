<template>
        <div class="container">
            <div class="row">
                <div class="card profile" style="width: 30rem;">
                    <div class="card-body"> 
                        <form
                            @submit.prevent="UploadPhoto"
                            method="POST"
                            enctype="multipart/form-data"
                        >  
                            <label 
                                v-if="imagepreview != ''"
                                for="photo"
                                class="ui tiny label btn-file mt-2"
                                >
                                <input
                                type="file"
                                id="photo"
                                name="photo"
                                style="display: none"
                                @change="photoSelected"
                                ref="inputFile"
                            />
                             {{ $t("profileImg_btn") }}
                            </label><br />
                            <img :src="getProfilePhoto()" class="" v-show="!imagepreview"/>
                            <img :src="imagepreview" v-show="imagepreview"  class="image"/>
                            <br/>
                            <label 
                                v-if="imagepreview === ''"
                                for="photo"
                                class="ui tiny label btn-file mt-2"
                                >
                                <input
                                type="file"
                                id="photo"
                                name="photo"
                                style="display: none"
                                @change="photoSelected"
                                ref="inputFile"
                            />
                             {{ $t("profileImg_btn") }}
                            </label>
                            <input
                            type="hidden"
                            v-model="form.id"
                            /> 
                            <sui-button
                            icon="image"
                            size="mini"
                            v-if="imagepreview != ''"
                            color="red"
                            type="submit"
                            :loading="form.busy"
                            >{{ $t("profileSave_btn") }}</sui-button
                            > 
                         </form> 
                        <h5 class="card-title pt-2 my-0">{{ form.name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ form.city }}, {{form.country}}</h6>
                        <hr>
                        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                            <alert-success :form="form" :message="$t('info_updated')" />
                            <!-- Email & Name-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                                    <has-error :form="form" field="name" />
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                                    <has-error :form="form" field="email" :placeholder="$t('email')"/>
                                </div>
                            </div>

                            <!-- Bith & Identity-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <PickDate v-model="form.birth" :placeholder="$t('birth')" name="birth" :class="{ 'is-invalid': form.errors.has('birth') }"></PickDate>
                                    <!-- <datepicker
                                    v-bind:language="'pt-br'"
                                    v-bind:placeholder="$t('schedule_form_date')"
                                    
                                    v-bind:min="'1956-01-01'"
                                    v-bind:max="'2030-12-31'"
                                    v-bind:data-vv-as="'Please enter your visit date'"
                                    v-model="form.date"
                                    
                                    name="event_date"
                                    id="event_date"
                                    class=""
                                  ></datepicker> -->
                                    <!-- <input v-model="form.birth" :class="{ 'is-invalid': form.errors.has('birth') }" class="form-control" type="text" name="birth"> -->
                                    <has-error :form="form" field="birth" :placeholder="$t('birth')"/>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.identity" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="identity" :placeholder="$t('identity')">
                                    <has-error :form="form" field="identity" />
                                </div>
                            </div>

                            <!-- phone & city-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" type="text" name="phone" :placeholder="$t('phone')">
                                    <has-error :form="form" field="phone"/>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" type="text" name="city" :placeholder="$t('city')">
                                    <has-error :form="form" field="city" />
                                </div>
                            </div>

                            <!-- address-->
                            <div class="form-group">
                                <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
                                <has-error :form="form" field="address" :placeholder="$t('address')" />
                            </div>

                            <!-- birth & city-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.country" :class="{'is-invalid': form.errors.has('country') }" class="form-control" type="text" name="country" :placeholder="$t('country')">
                                    <has-error :form="form" field="country" />
                                </div>
                                <div class="col-md-6">
                                    <router-link  :to="{ name: 'my-panel.password' }" class="btn btn-outline-secondary btn-block">
                                    {{ $t('your_password') }}
                                    </router-link>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="form-group row">
                              <div class="col-md-6">
                                <input v-model="form.iban" :class="{'is-invalid': form.errors.has('iban') }" class="form-control" type="text" name="iban" :placeholder="$t('type_iban')">
                                <has-error :form="form" field="iban" />
                              </div>
                                <div class="col-md-6 ml-md-auto">
                                <v-button :loading="form.busy" type="danger" class="btn-block">
                                    {{ $t('update') }}
                                </v-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'
import axios from "axios";
import PickDate from "../../components/PickDate.vue";
import datepicker from "../../components/TouchDatePicker.vue";

export default {
  scrollToTop: false,
  name: "my-panel.profile",
  components: { PickDate, datepicker },
  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
        id:'',
      name: '',
      email: '',
      password: '',
      identity: '',
      birth: '',
      phone: '',
      address: '',
      city: '',
      country: '',
      photo: '',
      iban: '',
    }),
    imagepreview: "",
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: { 
    getProfilePhoto() {
      let photo = "/images/profile/user-default.png";
      if (this.form.photo) {
        photo = this.form.photo;
      }
      return photo;
    },
    photoSelected(e) {
      this.form.photo = e.target.files[0];
      if( this.form.photo ){
        if ( /\.(jpe?g|png|gif)$/i.test(this.form.photo.name)) {
             if (this.form.photo.size > 2048 * 2048) {
                e.preventDefault();
                alert('File too big (> 8MB)');
                return;
              }else{
                let reader = new FileReader();
                reader.readAsDataURL(this.form.photo);
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
    UploadPhoto() {
      let formData = new FormData();
      formData.append("photo", this.form.photo);
      formData.append("id", this.form.id);

      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else {
        axios
          .post("/api/upload-photo", formData)
          .then(() => {
            Fire.$emit('AfterCreated');
            //this.$router.push({ name: "my-panel" });
            this.imagepreview ="";  
            this.$toastr.defaultStyle = {"background-color": "#21ba45"};
            this.$toastr.s(this.$t('profile_message_suscceful'));          
          })
          .catch((error) => {
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
            this.$toastr.s(this.$t('profile_message_error_toastr'));
            console.log(error);
          });
      }
    }, 
    async update () {
      const { data } = await this.form.patch('/api/profile-info')
      this.$store.dispatch('auth/updateUser', { user: data })
      this.$toastr.defaultStyle = {"background-color": "#21ba45"};
      this.$toastr.s(this.$t('info_updated')); 
    },
  },
  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
    Fire.$on('AfterCreated', ()=>{ 
      this.form.keys().forEach(key => {
        this.form[key] = this.user[key]
      })
    });
  },

}
</script>

<style lang="scss">
    .main-red{
        background-color:#FF3D47!important;
    } 

    .rounded-radius{
        border-radius: 2em!important;
    }
    .profile{
        margin:auto;
        box-shadow: 0px 12px 20px 0px #cccccceb;
    }

    .profile img{
        border-radius:100%;
        border:2px solid lightgray;
        width:50%;
    }
    .profile img.image{
        border:2px solid lightgray;
        border-radius:100%;
        object-fit: cover;
        width: 200px;
        height: 200px;
    }
    .profile .card-body{
        text-align:center;
    }
    .card .card-title {
        color: #4a4a4a;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        font-size: 1rem;
        font-weight: bold;
    }
</style>