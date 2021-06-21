<template>
  <div class="container-fluid m-0 pl-0 pr-0">
    <!--<sui-menu fixed>
         <sui-container>
         <a href="#" is="sui-menu-item" class="header">
            <img src="images/logo/200x48.png" class="logo w-100" />
         </a>



         <sui-menu-menu position="right">
         <a is="sui-menu-item" href="#">{{ $t('services') }}</a>
         <a is="sui-menu-item" href="#">{{ $t('collaborate') }}</a>
         <a is="sui-menu-item" href="#">{{ $t('owner') }}</a>

         <sui-dropdown :text="$t('account')" item class="simple">
            <sui-dropdown-menu>
               <template v-if="authenticated">
               <router-link :to="{ name: 'home' }" is="sui-dropdown-item">
                  {{ $t('home') }}
               </router-link>
               </template>
               <template v-else>
               <router-link :to="{ name: 'login' }" is="sui-dropdown-item">
                  {{ $t('login') }}
               </router-link>
               <router-link :to="{ name: 'register' }" is="sui-dropdown-item">
                  {{ $t('register') }}
               </router-link>
               </template>

            </sui-dropdown-menu>
         </sui-dropdown>

         <locale-dropdown  is="sui-menu-item"/>

         </sui-menu-menu>
         </sui-container>
      </sui-menu>
    !-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <router-link class="navbar-brand" to="/">
          <img src="images/logo/200x48.png" alt="logo" class="img-fluid" />
        </router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent-7"
          aria-controls="navbarSupportedContent-7"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <router-link :to="{ name: 'services' }" class="nav-link">{{
                $t("services")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'collaborate' }" class="nav-link">{{
                $t("collaborate")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'advertiser' }" class="nav-link">{{
                $t("owner_house")
              }}</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link">
                {{ $t("login") }}
              </router-link>
            </li>
            <!--  <li class="nav-item">
              <sui-dropdown :text="$t('account')" item class="simple nav-link">
                <sui-dropdown-menu>
                  <template v-if="authenticated">
                    <router-link :to="{ name: 'home' }" is="sui-dropdown-item">
                      {{ $t("home") }}
                    </router-link>
                  </template>

                  <template v-else>
                    <a href="javascript:void(0)" @click="signIn" is="sui-dropdown-item">
                      {{ $t("login") }}
                    </a>
                    <a href="javascrip:void(0)" @click="signUp" is="sui-dropdown-item">
                      {{ $t("register") }}
                    </a>
                  </template>
                </sui-dropdown-menu>
              </sui-dropdown>
            </li> -->

            <ul class="navbar-nav">
              <locale-dropdown />
              <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> -->
            </ul>
          </ul>
        </div>
      </div>
    </nav>
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
            <div class="col-md-8 mb-5 mt-md-0 mt-5 text-center text-md-left">
              <h1 class="display-4 text-danger font-weight-bold">
                {{ $t("head_title") }}
              </h1>
              <hr class="hr-light" />
              <h6 class="mb-3 text-white">{{ $t("head_description") }}</h6>
              <router-link :to="{ 'name': 'register' }" class="btn btn-danger badge-pill px-5">{{ $t('welcome_reg') }}</router-link>
            </div>
            <div class="col-md-4">
              <!--
                    <div class="mb-2">
                        <div class="btn-group btn-block " role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger badge-pill" v-if="!searchCard" @click="search">Buscar</button>
                            <button type="button" class="btn btn-danger badge-pill" v-if="!loginCard" @click="signIn">Entrar</button>
                            <button type="button" class="btn btn-danger badge-pill" v-if="!registerCard" @click="signUp"> Cria conta</button>
                        </div>
                    </div>
                    !-->
              <!--Form-->
              <div class="card rounded-radius">
                <div class="card-body">
                  <!--Body-->

                  <!--Login-->
                  <div class="" v-if="loginCard">
                    <!--Header-->
                    <div class="text-center">
                      <h3 class="dark-grey-text">
                        <span class="d-block">{{ $t("login_head1_phrase") }} </span>
                        <span>{{ $t("login_head2_phrase") }}</span>
                      </h3>

                      <hr />
                    </div>
                    <div class="">
                      <form @submit.prevent="login" @keydown="form.onKeydown($event)">
                        <!-- Email -->
                        <div class="form-group mt-4">
                          <input
                            v-model="form.email"
                            :class="{ 'is-invalid': form.errors.has('email') }"
                            class="form-control badge-pill"
                            type="email"
                            name="email"
                            :placeholder="$t('email')"
                          />
                          <has-error :form="form" field="email" />
                        </div>

                        <!-- Password -->
                        <div class="form-group mt-4">
                          <input
                            v-model="form.password"
                            :class="{ 'is-invalid': form.errors.has('password') }"
                            class="form-control badge-pill"
                            type="password"
                            name="password"
                            :placeholder="$t('password')"
                          />
                          <has-error :form="form" field="password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group">
                          <div class="">
                            <checkbox v-model="remember" name="remember">
                              {{ $t("remember_me") }}
                            </checkbox>

                            <router-link
                              :to="{ name: 'password.request' }"
                              class="small ml-auto my-auto"
                            >
                              {{ $t("forgot_password") }}
                            </router-link>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-7 offset-md-3 d-flex">
                            <!-- Submit Button -->
                            <v-button
                              :loading="form.busy"
                              class="btn-secondary btn-block rounded"
                            >
                              <i class="fa fa-sign-in" aria-hidden="true"></i>
                              {{ $t("login") }}
                            </v-button>
                            <!-- GitHub Login Button 
                                    <login-with-github /> -->
                          </div>
                        </div>
                        <hr />
                        <div class="text-center">
                          <a href="javascript:void(0)" @click.prevent="search"
                            ><i class="undo icon"></i> voltar
                            <span class="description">search page</span></a
                          >
                        </div>
                      </form>
                    </div>
                  </div>

                  <!--Register-->
                  <div class="" v-if="registerCard">
                    <h3 class="text-center text-muted">
                      <span class="d-block"> {{ $t("register_welcome") }}</span>
                      <small class="">
                        {{ $t("register_head_phrase1") }}
                        <span class="text-success"
                          >{{ $t("register_head_phrase2") }}
                        </span>
                        {{ $t("register_head_phrase3") }}
                      </small>
                    </h3>
                    <div class="divider row"></div>
                    <card v-if="mustVerifyEmail" :title="$t('register')">
                      <div class="alert alert-success" role="alert">
                        {{ $t("verify_email_address") }}
                      </div>
                    </card>
                    <div v-else :title="$t('register')">
                      <form @submit.prevent="register" @keydown="form.onKeydown($event)">
                        <div
                          class="row d-flex justify-content-center align-items-center py-3"
                        >
                          <div class="col-md-6">
                            <label for="email" class=""
                              ><span class="text-danger">*</span> Email</label
                            >
                            <input
                              v-model="form.email"
                              :class="{ 'is-invalid': form.errors.has('email') }"
                              class="form-control"
                              type="email"
                              name="email"
                            />
                            <has-error :form="form" field="email" />
                          </div>
                          <div class="col-md-6">
                            <label for="name" class=""
                              ><span class="text-danger">*</span> {{ $t("name") }}</label
                            >
                            <input
                              v-model="form.name"
                              :class="{ 'is-invalid': form.errors.has('name') }"
                              class="form-control"
                              type="text"
                              name="name"
                            />
                            <has-error :form="form" field="name" />
                          </div>
                          <div class="col-md-6">
                            <label for="password" class=""
                              ><span class="text-danger">*</span>
                              {{ $t("password") }}</label
                            >
                            <input
                              v-model="form.password"
                              :class="{ 'is-invalid': form.errors.has('password') }"
                              class="form-control"
                              type="password"
                              name="password"
                            />
                            <has-error :form="form" field="password" />
                          </div>
                          <div class="col-md-6">
                            <label for="confirm_password" class=""
                              ><span class="text-danger">*</span>
                              {{ $t("confirm_password") }}</label
                            >
                            <input
                              v-model="form.password_confirmation"
                              :class="{
                                'is-invalid': form.errors.has('password_confirmation'),
                              }"
                              class="form-control"
                              type="password"
                              name="password_confirmation"
                            />
                            <has-error :form="form" field="password_confirmation" />
                          </div>
                        </div>
                        <div class="mt-3 position-relative form-check">
                          <input
                            name="check"
                            id="exampleCheck"
                            type="checkbox"
                            class="form-check-input"
                          />
                          <label for="exampleCheck" class="form-check-label"
                            >{{ $t("register_terms") }}
                            <a href="javascript:void(0);">{{
                              $t("register_link_phrase")
                            }}</a
                            >.</label
                          >
                        </div>
                        <div class="divider row"></div>
                        <div class="mt-4 d-flex align-items-center">
                          <h5 class="mb-0">
                            {{ $t("register_has_acount") }}
                            <a
                              @click.prevent="signIn"
                              href="javascript:void(0)"
                              active-class="active"
                              class="text-primary"
                              >{{ $t("goTo__login_link") }}
                            </a>
                          </h5>
                          <div class="ml-auto">
                            <v-button
                              :loading="form.busy"
                              class="shadow btn-hover-shine btn btn-primary"
                            >
                              {{ $t("register") }}
                            </v-button>
                          </div>
                        </div>
                        <hr />
                        <div class="text-center">
                          <a href="javascript:void(0)" @click.prevent="search"
                            ><i class="undo icon"></i> voltar
                            <span class="description">search page</span></a
                          >
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="" v-if="searchCard">
                    <!--Header-->
                    <div class="text-center">
                      <h3 class="dark-grey-text">
                        <strong>{{ $t("head_form_title") }}</strong>
                      </h3>
                    </div>
                    <hr />

                    <!--Body-->
                    <form
                      @submit.prevent="searching"
                      @keydown="form.onKeydown($searching)"
                    >
                      <div
                        class="row d-flex justify-content-center align-items-center py-3"
                      >
                        <!--City & Type of rent-->
                        <sui-container>
                          <sui-form equal-width>
                              <sui-form-field>
                                <sui-form-field>
                                  <label>{{ $t("home_form_city") }}</label>
                                  <select
                                    class="ui dropdown"
                                    v-model="form.city"
                                    :class="{ 'is-invalid': form.errors.has('city') }"
                                  >
                                    <option value="Benguela">Benguela</option>
                                    <option value="Bengo">Bengo</option>
                                    <option value="Bié">Bié</option>
                                    <option value="Cabinda">Cabinda</option>
                                    <option value="Cuanza Norte">Cuanza Norte</option>
                                    <option value="Cuanza Sul">Cuanza Sul</option>
                                    <option value="Cunene">Cunene</option>
                                    <option value="Huambo">Huambo</option>
                                    <option value="Huila">Huila</option>
                                    <option value="Luanda">Luanda</option>
                                    <option value="Lunda Norte">Lunda Norte</option>
                                    <option value="Lunda Sul">Lunda Sul</option>
                                    <option value="Malanje">Malanje</option>
                                    <option value="Moxico">Moxico</option>
                                    <option value="Namibe">Namibe</option>
                                    <option value="Uíge">Uíge</option>
                                    <option value="Zaire">Zaire</option>
                                  </select>
                                  <has-error
                                    :form="form"
                                    field="city"
                                    class="text-white"
                                  />
                                </sui-form-field>
                              </sui-form-field>
                          </sui-form>
                        </sui-container>
                        <!--Room & Price-->
                        <sui-container>
                          <sui-form equal-width>
                            <sui-form-field>
                              <sui-form-fields>
                                <sui-form-field>
                                  <label>{{ $t("home_form_room") }}</label>
                                  <select
                                    class="ui dropdown"
                                    v-model="form.room"
                                    :class="{ 'is-invalid': form.errors.has('room') }"
                                  >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5+">5+</option>
                                  </select>
                                  <has-error
                                    :form="form"
                                    field="type"
                                    class="text-white"
                                  />
                                </sui-form-field>
                                <sui-form-field>
                                  <label>{{
                                    $t("home_form_payment")
                                  }}</label>
                                  <select
                                    class="ui dropdown"
                                    v-model="form.price"
                                    :class="{ 'is-invalid': form.errors.has('price') }"
                                  >
                                    <option value="10,000.00">AKZ 1000.00 +</option>
                                    <option value="10,000.00">AKZ 5,000.00 +</option>
                                    <option value="10,000.00">AKZ 10,000.00 +</option>
                                    <option value="10,000.00">AKZ 20,000.00 +</option>
                                    <option value="30,000.00">AKZ 40,000.00 +</option>
                                    <option value="50,000.00">AKZ 60,000.00 +</option>
                                    <option value="80,000.00">AKZ 80,000.00 +</option>
                                    <option value="100,000.00">AKZ 100,000.00 +</option>
                                    <option value="130,000.00">AKZ 120,000.00 +</option>
                                    <option value="10,000.00">AKZ 140,000.00 +</option>
                                  </select>
                                  <has-error
                                    :form="form"
                                    field="payment"
                                    class="text-white"
                                  />
                                </sui-form-field>
                              </sui-form-fields>
                            </sui-form-field>
                          </sui-form>
                        </sui-container>

                        <!-- <div class="col-7 mt-4 d-flex">
                                            <button type="button" class="btn btn-secondary btn-block px-0 rounded" > <i class="search icon"></i> ENCOTRAR IMOVEL</button>
                                        </div> -->
                        <v-button :loading="form.busy" class="btn btn-danger">
                          <i class="search icon"></i> ENCOTRAR IMOVEL
                        </v-button>
                      </div>
                    </form>
                    <div class="text-center">
                      <hr />
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
      <p class="h2 text-center py-5">{{ $t('welcome_whysuggest') }}</p>

      <div class="row mb-5">
        <div class="col-md-3">
          <div class="card rounded-radius bg-main">
            <div class="card-body text-white">
              <div class="row d-flex align-items-center">
                <div class="col-4"><h1 class="numero1">1</h1></div>
                <div class="col-6"><p class="h3 text-center">Busca</p></div>
              </div>
              <div class="card-text p-4">
                <p>
                  Enconntrar melhores opções de imóveis para alugar no nosso site, com
                  poucos cliques e agendar a sua visita de forma facilitada
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card rounded-radius shadow-lg">
            <div class="card-body">
              <div class="row d-flex align-items-center">
                <div class="col-4"><h1 class="numero1_1">2</h1></div>

                <div class="col-6"><h3 class="t">Visita</h3></div>
              </div>
              <div class="card-text p-4">
                <p>
                  Conhecer as casas e fazer a sua própria avaliação na presença do
                  proprietário ou solicitar que colaboradores façam por ti
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card rounded-radius bg-main text-white">
            <div class="card-body">
              <div class="row d-flex align-items-center">
                <div class="col-4"><h1 class="numero1">3</h1></div>
                <div class="col-6"><p class="h3 text-center">Proposta</p></div>
              </div>
              <div class="card-text p-4">
                <p>
                  Envia a sua oferta online, por email, mensagm de texto ou ligar para
                  número. Receber um contacto redigido e verificado
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card rounded-radius shadow-lg">
            <div class="card-body">
              <div class="row d-flex align-items-center">
                <div class="col-4"><h1 class="numero1_1">4</h1></div>
                <div class="col-6"><p class="h3">Serviços</p></div>
              </div>
              <div class="card-text p-4">
                <p>
                  Solicitar serviços que facilitam e tornam o processo de procura e
                  mudança de residência mais simples, rápida, agradável
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <Complement></Complement> -->
    </div>
     <div class="container-fluid p-5 text-center" style="background-color: #ced4da">
        <div class="text-center"> 
            <p class="display-4">{{ $t('welcome_suggest') }}</p>
            
              <router-link :to="{ name: 'collaborate' }" class="btn btn-danger">{{
                $t("collaborate")
              }}</router-link>
        </div>  
     </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <sui-card class=" rounded-radius py-5 shadow main-red text-white">
                            <sui-card-content>
                                <sui-container text-align="justified">
                                    <p class="h3">{{ $t('collaborate_head1') }}</p>  
                                    <p>{{ $t('collaborate_phrase1') }}</p> 
                                </sui-container>           
                            </sui-card-content>
                        </sui-card>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <sui-card class=" rounded-radius py-5 shadow">
                            <sui-card-content>
                                <sui-container text-align="justified">
                                    <p class="h3">{{ $t('collaborate_head2') }}</p>  
                                    <p>{{ $t('collaborate_phrase2') }}</p>    
                                </sui-container>           
                            </sui-card-content>
                        </sui-card>
                    </div>
                    <div class="col-lg-6">
                        <sui-card class=" rounded-radius py-5 shadow">
                            <sui-card-content>
                                <sui-container text-align="justified">
                                    <p class="h3">{{ $t('collaborate_head3') }}</p>  
                                    <p>{{ $t('collaborate_phrase3') }}</p>   
                                </sui-container>           
                            </sui-card-content>
                        </sui-card>
                    </div>
                    <div class="col-lg-6">
                        <sui-card class="rounded-radius py-5 shadow main-red text-white">
                            <sui-card-content>
                                <sui-container text-align="justified">
                                    <p class="h3">{{ $t('collaborate_head4') }}</p>  
                                    <p>{{ $t('collaborate_phrase4') }}</p>    
                                </sui-container>           
                            </sui-card-content>
                        </sui-card>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="images/vendor/announce.jpg" alt="" class="img-fluid rounded-radius"> 
            </div>
        </div>
    </div>
    <!--
      <div class="text-center">
         <div class="title mb-4">
         {{ title }}
         </div>

         <div class="links">
         <a href="https://github.com/cretueusebiu/laravel-vue-spa">github.com/cretueusebiu/laravel-vue-spa</a>
         </div>
      </div>!-->

    <Footer></Footer>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Complement from "../components/Complement";
import Footer from "../components/Footer";
import LocaleDropdown from "../components/LocaleDropdown";

//LOGIN
import Form from "vform";
import Cookies from "js-cookie";
import LoginWithGithub from "~/components/LoginWithGithub";

export default {
  components: {
    LocaleDropdown,
    Complement,
    Footer,
    LoginWithGithub,
  },
  layout: "basic",
  middleware: "guest",

  metaInfo() {
    return { title: this.$t("home") };
  },

  data: () => ({
    title: window.config.appName,

    current: null,
    form: new Form({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",

      city: "",
      type: "",
      room: "",
      price: "",
    }),
    remember: false,
    appName: window.config.appName,
    mustVerifyEmail: false,
    loginCard: false,
    registerCard: false,
    searchCard: true,
    //search: {},
  }),

  computed: mapGetters({
    authenticated: "auth/check",
  }),
  methods: {
    async searching() {
      // Submit the form.
      //const { data } = await this.form.get('/api/search')

      // Save the token.
      /* this.$store.dispatch('auth/saveToken', {
                token: data.token,
                remember: this.remember
            })

            // Fetch the user.
            await this.$store.dispatch('auth/fetchUser') */

      // Redirect search.
      this.$router.push({ name: "search.house" });
    },
    /* signIn() {
      (this.loginCard = true), (this.registerCard = false), (this.searchCard = false);
    },
    signUp() {
      (this.loginCard = false), (this.registerCard = true), (this.searchCard = false);
    }, */
    search() {
      (this.loginCard = false), (this.registerCard = false), (this.searchCard = true);
    },
    //JA NAO EH NECESSARIO
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
  },
};
</script>

<style scoped>
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
</style>
