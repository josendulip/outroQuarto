<template>
    <div class="container text-center">
        <div class="row justify-content-center">
        <sui-card style="width: 50%;">
            <sui-card-content>
            <sui-image
                src="/images/profile/user-default.png" style="width: 70px;"
            />
            <sui-card-header class="my-2">{{ this.form.name }}</sui-card-header>
            <sui-card-meta>{{ this.form.role }}</sui-card-meta>
            <sui-card-description>
                {{ $t("myadmin_user_topMessage") }}
            </sui-card-description>
            </sui-card-content>
            <sui-card-content extra>
                 <form @submit.prevent="createUser()" @keydown="form.onKeydown($event)">
                            <alert-success :form="form" :message="$t('alert_created')" />
                            <!-- Email & Name-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                                    <has-error :form="form" field="name"  :placeholder="$t('name')" autocomplete="off"/>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.identity" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="identity" :placeholder="$t('identity')">
                                    <has-error :form="form" field="identity" autocomplete="off" />
                                </div>
                            </div>

                            <!-- Bith & Identity-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                                    <has-error :form="form" field="email" :placeholder="$t('placeholder_email')"/>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="text" name="password" :placeholder="$t('password')">
                                    <has-error :form="form" field="password"/>
                                </div>
                            </div>

                            <!-- phone & city-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <PickDate v-model="form.birth" :placeholder="$t('birth')" name="birth" :class="{ 'is-invalid': form.errors.has('birth') }"></PickDate>
                                    <has-error :form="form" field="birth" :placeholder="$t('birth')"/>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" type="text" name="phone" :placeholder="$t('placeholder_phone')">
                                    <has-error :form="form" field="phone"/>
                                </div>
                            </div>

                            <!-- address-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
                                    <has-error :form="form" field="address" :placeholder="$t('placeholder_address')"/>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" type="text" name="city" :placeholder="$t('city')">
                                    <has-error :form="form" field="city" />
                                </div>
                            </div>

                            <!-- birth & city-->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input v-model="form.country" :class="{'is-invalid': form.errors.has('country') }" class="form-control" type="text" name="country" :placeholder="$t('country')">
                                    <has-error :form="form" field="country" />
                                </div>
                                <div class="col-md-6">
                                    <sui-form-field :class="{'error': form.errors.has('role_user') }">
                                    <sui-dropdown
                                        :placeholder="$t('role_user')"
                                        selection
                                        class="w-100"
                                        :options="options"
                                        v-model="form.role"
                                    />
                                     </sui-form-field>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="form-group row">
                                <div class="col-md-6 ml-md-auto">
                                <v-button :loading="form.busy" type="danger" class="btn-block">
                                    {{ $t('save') }}
                                </v-button>
                                </div>
                            </div>
                        </form>
            </sui-card-content>
        </sui-card>
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
  name: "admin.new.user",
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
    }),
    imagepreview: "",
    options: [
        {
            text: 'User',
            value: 'user',
        },
        {
            text: 'Owner',
            value: 'owner',
        },
        {
            text: 'Employer',
            value: 'employer',
        },
        {
            text: 'admin',
            value: 'admin',
        },
    ],
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
    createUser(){
        this.form.post("/api/my-users").then(() => {
            Fire.$emit('AfterCreated');
            //this.$router.push({ name: "my-panel" });
            this.imagepreview ="";  
            this.$toastr.defaultStyle = {"background-color": "#21ba45"};
            this.$toastr.s(this.$t('myadmin_user_topMessage2'));   
        })
        .catch((error) => {
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
            this.$toastr.s(this.$t('myadmin_user_topMessage4'));
            console.log(error);
          });
    },
  },
  created () {
  },

}
</script>