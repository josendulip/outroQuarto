<template>
  <div class="container-fluid m-0 pl-0 pr-0">
    <Navout />
    <!-- Header -->
    <div
      class="view"
      style="
        background-image: url('images/home/1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center left;
      "
    >
      <div class="rgba-indigo-strong d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row py-lg-5 d-flex justify-content-center align-items-center">
            <!--Grid column-->
            <div class="col-lg-8 col-md-7 mb-5 mt-md-0 mt-5 text-center text-md-left">
              <h1 class="display-4 text-danger font-weight-bold">
                {{ $t("head_title") }}
              </h1>
              <hr class="hr-light">
              <h6 class="mb-3 text-white">
                {{ $t("head_description") }}
              </h6>
              <router-link :to="{ 'name': 'register' }" class="btn btn-danger badge-pill px-5">
                {{ $t('welcome_reg') }}
              </router-link>
            </div>
            <div class="col-lg-4 col-md-5 mb-4">
              <div class="card rounded-radius">
                <div class="card-body">
                  <!--Body-->
                  <div class="">
                    <!--Header-->
                    <div class="text-center">
                      <h3 class="dark-grey-text">
                        <strong>{{ $t("head_form_title") }}</strong>
                      </h3>
                    </div>
                    <hr>
                    <!--City & Type of rent-->
                    <sui-container>
                      <sui-form>
                        <sui-form-field>
                          <sui-form-field>
                            <label>{{ $t('head_form_state') }}</label>
                            <sui-dropdown
                              v-model="currentState"
                              :placeholder="$t('head_form_city')"
                              selection
                              :options="states"
                              :class="{ 'is-invalid': form.errors.has('city') }"
                            />
                          </sui-form-field>
                          <has-error :form="form" field="city" class="text-white" />
                        </sui-form-field>
                        <sui-form-field>
                          <sui-form-field>
                            <button class="btn btn-danger btn-block" @click.prevent="searching()">
                              <i class="search icon" /> {{ $t('head_form_find_house') }}
                            </button>
                          </sui-form-field>
                        </sui-form-field>
                      </sui-form>
                    </sui-container>
                    <div class="text-center">
                      <hr>
                      <fieldset class="form-check">
                        <label class="form-check-label" for="checkbox1">{{ $t('welcome_q') }} <router-link :to="{ 'name': 'login' }" class="text-danger">{{ $t('welcome_log') }}</router-link> {{ $t('welcome_or') }} <router-link :to="{ 'name': 'register' }" class="text-danger">{{ $t('welcome_reg') }}</router-link>
                        </label>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
              <!--/.Form-->
            </div>
            <!--Grid column-->
          </div>
        </div>
      </div>
    </div>
    <!-- Header -->
    <div class="container">
      <p class="h2 text-center py-5">
        {{ $t('welcome_whysuggest') }}
      </p>

      <div class="row mb-5">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card rounded-radius bg-main">
            <div class="card-body text-white">
              <div class="row d-flex align-items-center">
                <div class="col-4">
                  <h1 class="numero1">
                    1
                  </h1>
                </div>
                <div class="col-8">
                  <h1>{{ $t('welcome_search') }}</h1>
                </div>
              </div>
              <div class="card-text p-4">
                <p>{{ $t('welcome_search_msg') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card rounded-radius shadow-lg">
            <div class="card-body">
              <div class="row d-flex align-items-center">
                <div class="col-4">
                  <h1 class="numero1_1">
                    2
                  </h1>
                </div>

                <div class="col-7">
                  <h1>{{ $t('welcome_visit') }}</h1>
                </div>
              </div>
              <div class="card-text p-4">
                <p>{{ $t('welcome_visit_msg') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card rounded-radius bg-main text-white">
            <div class="card-body">
              <div class="row d-flex align-items-center">
                <div class="col-4">
                  <h1 class="numero1">
                    3
                  </h1>
                </div>
                <div class="col-8">
                  <h1>{{ $t('welcome_propus') }}</h1>
                </div>
              </div>
              <div class="card-text p-4">
                <p>{{ $t('welcome_propus_msg') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
          <div class="card rounded-radius shadow-lg">
            <div class="card-body">
              <div class="row d-flex align-items-center">
                <div class="col-4">
                  <h1 class="numero1_1">
                    4
                  </h1>
                </div>
                <div class="col-8">
                  <h1>{{ $t('welcome_service') }}</h1>
                </div>
              </div>
              <div class="card-text p-4">
                <p>{{ $t('welcome_service_msg') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <Complement></Complement> -->
    </div>
    <div class="container-fluid p-5 text-center gr-1">
      <div class="text-center">
        <p class="display-4">
          {{ $t('welcome_suggest') }}
        </p>
        <router-link :to="{ name: 'collaborate' }" class="btn btn-danger">
          {{ $t("collaborate") }}
        </router-link>
      </div>
    </div>
    <div class="container-fluid backgroundImage">
      <div class="row">
        <div class="col-lg-5 d-flex justify-content-center align-items-center shadow card-transform  hidden-xs-down hidden-sm-down">
          <div class="text-white">
            <h4 class="display-3">
              {{ $t('collaborate_head2') }}
            </h4>
            <p class="h3">
              {{ $t('collaborate_phrase2') }}
            </p>
          </div>
        </div>
        <div class="col-lg-7 ml-0 pl-0 d-flex justify-content-center align-items-center">
          <div class="row align-middle d-md-none mb-5">
            <div class="col-md-6 col-lg-4 column">
              <div class="card myCard rounded-radius gr-1">
                <div class="txt">
                  <h1>
                    {{ $t('collaborate_head1') }} <br>
                    {{ $t('collaborate_head1-2') }}
                  </h1>
                  <p>{{ $t('collaborate_phrase1') }}</p>
                </div>
                <a href="/login">{{ $t('collaborate_form_more') }}</a>
                <div class="ico-card">
                  <i class="clone outline icon" />
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 column">
              <div class="card myCard rounded-radius gr-2">
                <div class="txt">
                  <h1>{{ $t('collaborate_head3') }} <br> {{ $t('collaborate_head3-1') }}</h1>
                  <p>{{ $t('collaborate_phrase3') }}</p>
                </div>
                <a href="/login">{{ $t('collaborate_form_more') }}</a>
                <div class="ico-card">
                  <i class="folder open outline icon" />
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 column">
              <div class="card myCard rounded-radius gr-3">
                <div class="txt">
                  <h1>{{ $t('collaborate_head4') }} <br> {{ $t('collaborate_head4-1') }}</h1>
                  <p>{{ $t('collaborate_phrase4') }}</p>
                </div>
                <a href="/login">{{ $t('collaborate_form_more') }}</a>
                <div class="ico-card">
                  <i class="folder outline icon" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row align-middle hidden-xs-down hidden-sm-down">
        <div class="col-md-6 col-lg-4 column">
          <div class="card myCard rounded-radius gr-1">
            <div class="txt">
              <h1>
                {{ $t('collaborate_head1') }} <br>
                {{ $t('collaborate_head1-2') }}
              </h1>
              <p>{{ $t('collaborate_phrase1') }}</p>
            </div>
            <a href="/login">{{ $t('collaborate_form_more') }}</a>
            <div class="ico-card">
              <i class="clone outline icon" />
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 column">
          <div class="card myCard rounded-radius gr-2">
            <div class="txt">
              <h1>{{ $t('collaborate_head3') }} <br> {{ $t('collaborate_head3-1') }}</h1>
              <p>{{ $t('collaborate_phrase3') }}</p>
            </div>
            <a href="/login">{{ $t('collaborate_form_more') }}</a>
            <div class="ico-card">
              <i class="folder open outline icon" />
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 column">
          <div class="card myCard rounded-radius gr-3">
            <div class="txt">
              <h1>{{ $t('collaborate_head4') }} <br> {{ $t('collaborate_head4-1') }}</h1>
              <p>{{ $t('collaborate_phrase4') }}</p>
            </div>
            <a href="/login">{{ $t('collaborate_form_more') }}</a>
            <div class="ico-card">
              <i class="folder outline icon" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Footer from '../components/Footer'
import Navout from '~/components/Navout'

// LOGIN
import Form from 'vform'
import axios from 'axios'

export default {
  components: {
    Navout,
    Footer
  },
  layout: 'basic',
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName,

    current: null,
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',

      city: '',
      type: '',
      room: '',
      price: ''
    }),
    remember: false,
    appName: window.config.appName,
    mustVerifyEmail: false,
    loginCard: false,
    registerCard: false,
    searchCard: true,
    currentState: null,
    states: [
      { text: 'Benguela', value: 'Benguela' },
      { text: 'Bengo', value: 'Bengo' },
      { text: 'Bié', value: 'Bié' },
      { text: 'Cabinda', value: 'Cabinda' },
      { text: 'Cuando Cubango', value: 'Cuando Cubango' },
      { text: 'Cuanza Norte', value: 'Cuanza Norte' },
      { text: 'Cuanza Sul', value: 'Cuanza Sul' },
      { text: 'Cunene', value: 'Cunene' },
      { text: 'Huambo', value: 'Huambo' },
      { text: 'Huila', value: 'Huila' },
      { text: 'Luanda', value: 'Luanda' },
      { text: 'Lunda Norte', value: 'Lunda Norte' },
      { text: 'Lunda Sul', value: 'Lunda Sul' },
      { text: 'Malanje', value: 'Malanje' },
      { text: 'Moxico', value: 'Moxico' },
      { text: 'Namibe', value: 'Namibe' },
      { text: 'Uíge', value: 'Uíge' },
      { text: 'Zaire', value: 'Zaire' }
    ]
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  }),
  methods: {
    async searching () {
      this.$router.push({ name: 'search.house' })
      // Submit the form.
      // const { data } = await this.form.get('/api/search')

      // Save the token.
      /* this.$store.dispatch('auth/saveToken', {
                token: data.token,
                remember: this.remember
            })

            // Fetch the user.
            await this.$store.dispatch('auth/fetchUser') */

      // Redirect search.
      //this.$router.push({ name: 'search.house' })
    },
    /* signIn() {
      (this.loginCard = true), (this.registerCard = false), (this.searchCard = false);
    },
    signUp() {
      (this.loginCard = false), (this.registerCard = true), (this.searchCard = false);
    }, */
    searchinger () {
      const query = this.searches

      axios
        .get('api/searchHouser?q=' + query)
        .then((data) => {
          this.houses = data.data
          if (this.houses.length === '') {
            this.SearchedResult = 'Nao existes'
            console.log(this.result)
          }
        })
        .catch(() => {
          // eslint-disable-next-line no-undef
          Swal.fire(
            'Failed',
            'There was something wrong, while you where searching.',
            'error'
          )
        })
    },
    search () {
      (this.loginCard = false), (this.registerCard = false), (this.searchCard = true);
    }
    // JA NAO EH NECESSARIO
    /* async login() {
      // Submit the form.
      const { data } = await this.form.post("/api/login");

      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember,
      });

      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");

      // Redirect home.
      this.redirect();
    },

    redirect() {
      const intendedUrl = Cookies.get("intended_url");

      if (intendedUrl) {
        Cookies.remove("intended_url");
        this.$router.push({ path: intendedUrl });
      } else {
        location.reload();
        this.$router.push({ name: "home" });
      }
    },

    async register() {
      // Register the user.
      const { data } = await this.form.post("/api/register");

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
      } else {
        location.reload();
        // Log in the user.
        const {
          data: { token },
        } = await this.form.post("/api/login");

        // Save the token.
        this.$store.dispatch("auth/saveToken", { token });

        // Update the user.
        await this.$store.dispatch("auth/updateUser", { user: data });

        // Redirect home.
        location.reload();
        this.$router.push({ name: "home" });
      }
    }, */
  }
}
</script>

<style lang="scss">
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}
.rgba-indigo-strong {
  background-color: rgba(0, 0, 0, 0.5);
}
.rounded-radius {
  border-radius: 2em;
}
.bg-main {
  background-color: #ff5859;
}

.min-width-auto {
  /* cursor: pointer;
    word-wrap: break-word;
    line-height: 1em;
    white-space: normal;
    outline: 0;
    transform: rotateZ(0); */
  min-width: auto !important;
  min-height: auto;
  /* background: #fff;
    display: inline-block;
    padding: .78571429em 2.1em .78571429em 1em;
    color: rgba(0,0,0,.87);
    box-shadow: none;
    border: 1px solid rgba(34,36,38,.15);
    border-radius: .28571429rem;
    transition: box-shadow .1s ease,width .1s ease; */
}

.numero1 {
  text-align: center;
  background-color: #ffffff;
  border-radius: 50%;
  height: 50px;
  width: 50px;
  font-size: 23px;
  color: #ff5859;
  padding: 10px;
}
.numero1_1 {
  text-align: center;
  background-color: #ff5859;
  border-radius: 50%;
  height: 50px;
  width: 50px;
  font-size: 23px;
  color: #ffffff;
  padding-top: 10px;
}
.card-transform{
  width: 100%;
  height: 559px;
  margin: 0 auto;
  border: none;
  -moz-border-radius: 0 100% 0 0;
  -webkit-border-radius: 0 100% 0 0;
  border-radius: 0 100% 0 0;
  background: #ff5859;
}
.backgroundImage{
  background: url('/images/vendor/1.jpg') no-repeat center center; background-size: cover;
    padding-right: 0;
    padding-left: 0;
}

@import url('https://fonts.googleapis.com/css?family=Oswald:300,400,500,700');

@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800');

$gr-1:linear-gradient(170deg, #c2c2c2 0%, #ddd7d7 100%);
$gr-2:linear-gradient(170deg, #ddd7d7 0%, #c2c2c2 100%);
$gr-3:linear-gradient(170deg, #c2c2c2 0%, #ddd7d7 100%);

.gr-1{background: $gr-1;}
.gr-2{background: $gr-2;}
.gr-3{background: $gr-3;}

*{transition: .5s;}

.h-100{height: 100vh !important;}
.align-middle{
  position: relative;
  top:50%;
  transform:translateY(-50%);
}

.column{
  margin-top:3rem;
  padding-left:3rem;
  &:hover{
    padding-left:0;
    .card .txt{
      margin-left:1rem;
      h1, p{
        color:rgba(255,255,255,1);
        opacity:1;
      }
    }
    a{
      color:rgba(255,255,255,1);
      &:after{
      width: 10%;
      }
    }
  }
}
  .myCard{
    min-height:170px;
    margin: 0;
    padding: 1.7rem 1.2rem;
    border: none;
    border-radius: 0;
    color:rgba(0,0,0,1);
    letter-spacing: .05rem;
    font-family: 'Oswald', sans-serif;
    box-shadow: 0 0 21px rgba(0,0,0,.27);
    .txt{
      margin-left:-3rem;
      z-index: 1;
      h1{
        font-size:1.5rem;
        font-weight: 300;
        text-transform: uppercase;
      }
      p{
        font-size:.7rem;
        font-family: 'Open Sans', sans-serif;
        letter-spacing: 0rem;
        margin-top:33px;
        opacity:0;
        color:rgba(255,255,255,1);
      }
    }
    a{
      z-index:3;
      font-size: .7rem;
      color:rgba(0,0,0,1);
      margin-left:1rem;
      position:relative;
      bottom: -.5rem;
      text-transform: uppercase;
      &:after {
        content:"";
        display: inline-block;
        height: 0.5em;
        width: 0;
        margin-right: -100%;
        margin-left: 10px;
        border-top: 1px solid rgba(255,255,255,1);
        transition: .5s;
      }
    }
    .ico-card{
      position:absolute;
      top: 0;
      left:0;
      bottom:0;
      right: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
    }
    i{
      position: relative;
      right: -50%;
      top:60%;
      font-size: 12rem;
      line-height: 0;
      opacity: .2;
      color:rgba(255,255,255,1);
      z-index: 0;
    }
  }
</style>
