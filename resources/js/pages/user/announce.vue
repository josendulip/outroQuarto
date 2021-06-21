<template>
  <div class="">
    <div class="container my-5">
      <div class="row d-flex align-items-center">
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
              <form @submit.prevent="announce" @keydown="form.onKeydown($event)">
                  <div class="form-row">
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="name" class=""><span class="text-danger">*</span> {{ $t('name') }}</label>
                                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                              <has-error :form="form" field="name" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="identity" class=""><span class="text-danger">*</span> Email</label>
                              <input v-model="form.identity" :class="{ 'is-invalid': form.errors.has('identity') }" class="form-control" type="identity" name="email">
                              <has-error :form="form" field="identity" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="phone" class=""><span class="text-danger">*</span> {{ $t('phone') }}</label>
                              <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" type="phone" name="phone">
                              <has-error :form="form" field="phone" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="address" class=""><span class="text-danger">*</span> {{ $t('address') }}</label>
                              <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="text" name="address">
                              <has-error :form="form" field="address" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="city" class=""><span class="text-danger">*</span> {{ $t('city') }}</label>
                              <input v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" type="city" name="city">
                              <has-error :form="form" field="city" />
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="position-relative form-group">
                              <label for="country" class=""><span class="text-danger">*</span> {{ $t('country') }}</label>
                              <input v-model="form.country" :class="{ 'is-invalid': form.errors.has('country') }" class="form-control" type="text" name="country">
                              <has-error :form="form" field="country"/>
                          </div>
                      </div>                      
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="role" class=""><span class="text-danger">*</span>
                            {{ $t("placeholder_userType") }}</label>
                          <select
                            class="custom-select"
                            name="role"
                            v-model="form.role"
                            :class="{ 'is-invalid': form.errors.has('role') }"
                          >
                            <option value="" disabled> <span v-if="form.role == 'user'"></span> {{ $t('placeholder_user') }}</option>
                            <option value="user">{{ $t('placeholder_user') }}</option>
                            <option value="owner">{{ $t('placeholder_owner') }}</option>
                          </select>
                          <has-error :form="form" field="role" />
                        </div>
                      </div>            
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="activity" class=""><span class="text-danger">*</span>
                            {{ $t("placeholder_Useractivity") }}</label>
                          <select
                            class="custom-select"
                            name="activity"
                            v-model="form.activity"
                            :class="{ 'is-invalid': form.errors.has('activity') }"
                          >
                            <option value="real estate agency">{{ $t('placeholder_realState') }}</option>
                            <option value="Intermediate">{{ $t('placeholder_intermediate') }}</option>
                            <option value="Private">{{ $t('placeholder_private') }}</option>
                          </select>
                          <has-error :form="form" field="activity" />
                        </div>
                      </div>  
                        <div class="divider row"></div>    
                      <div class="col-md-6 offset-6"> 
                        <div class="ml-auto">
                            <v-button :loading="form.busy" class="btn-shadow btn-hover-shine btn btn-danger btn-block">
                                {{ $t('announce_form_btn') }}
                            </v-button>
                        </div>
                      </div>
                  </div>
              </form>
              <div>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius autem natus accusamus exercitationem sequi labore hic adipisci quos dolore tempore, dolorum at, maxime voluptatibus alias quis quidem voluptate dolores. Qui!
              </div>
          </div>          
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Navigator from "~/components/Navigator";
import Footer from "~/components/Footer";
import Form from "vform";
export default {
  /* middleware: 'auth', */
  name: "userbundleRenderer.renderToStreamannounce",
  components: {
    Navigator,
    Footer,
  },
  data: () => ({
    form: new Form({
      name: "",
      email: "",
      role: "",
      identity: "",
      phone: "",
      address: "",
      city: "",
      country: "",
    }),
    src: "/images/announce/1.jpg",
    mustVerifyEmail: false,
    status: "",
  }),
  computed: mapGetters({
        authenticated: 'auth/check',
        user: 'auth/user'
    }),
  metaInfo() {
    return {
      title: this.$t("announce"),
      /* options: [ {text: this.$t('Male')}] */
    };
  },

  methods: {
    async announce() {
      // Must verify email fist.
      if (this.$store["auth/user"]) {
        this.mustVerifyEmail = true;
      } else {
        // announce the house.
        const { data } = await this.form.post("/api/become-an-advertiser");
        this.status = data.status;
        
        // Log out the user.
        await this.$store.dispatch("auth/logout");

        // Redirect to login.
        this.$router.push({ name: "login" });
        // Log in the user.
        //const { data: { token } } = await this.form.post('/api/login')

        /* // Save the token.
                this.$store.dispatch('auth/saveToken', { token })

                // Update the user.
                await this.$store.dispatch('auth/updateUser', { user: data })
                */
        // Redirect home.
        //this.$router.push({ name: "my-panel.welcome" });
      }
    },
  },
  created () {
    // Fill the form with user data.
        this.form.keys().forEach(key => {
        this.form[key] = this.user[key]
    })
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
