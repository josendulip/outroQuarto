<template>
  <div class="h-100 row">
    <div class="app-container app-theme-white body-tabs-shadow">
      <div class="app-container">
        <div class="h-100">
          <div class="h-100 no-gutters row">
            <div
              class="h-100 d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-7"
            >
              <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                <div class="app-logo my-5">
                  <router-link to="/" class="navbar-brand">
                    <img src="/images/logo/200x48.png" :alt="appName" class="img-fluid" />
                  </router-link>
                  <ul class="navbar-nav">
                    <locale-dropdown />
                  </ul>
                </div>
                <p
                  class="mb-0 text-muted my-3"
                  style="font-family: Arial, Helvetica, sans-serif; font-size: 1.5em"
                >
                  <span class="d-block"> {{ $t("register_welcome") }}</span>
                  <span>
                    {{ $t("register_head_phrase1") }}
                    <span class="text-success">{{ $t("register_head_phrase2") }} </span>
                    {{ $t("register_head_phrase3") }}</span
                  >
                </p>
                <div class="divider row"></div>
                <card v-if="mustVerifyEmail" :title="$t('register')">
                  <div class="alert alert-success" role="alert">
                    {{ $t("verify_email_address") }}
                  </div>
                </card>
                <div v-else :title="$t('register')">
                  <form @submit.prevent="register" @keydown="form.onKeydown($event)">
                    <div class="form-row">
                      <div class="col-md-12">
                        <div class="position-relative form-group">
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
                          <has-error :form="form" field="name"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="email" class=""><span class="text-danger">*</span> Email</label>
                          <input v-model="form.email"
                            :class="{ 'is-invalid': form.errors.has('email') }"
                            class="form-control"
                            type="email"
                            name="email"
                          />
                          <has-error :form="form" field="email"/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative form-group">
                          <label for="activity" class=""><span class="text-danger">*</span>
                            {{ $t("placeholder_activity") }}</label>
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
                      <div class="col-md-6">
                        <div class="position-relative form-group">
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
                      </div>
                      <div class="col-md-6">
                        <div class="position-relative form-group">
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
                        <a href="javascript:void(0);">{{ $t("register_link_phrase") }}</a
                        >.</label
                      >
                    </div>
                    <div class="divider row"></div>
                    <div class="mt-4 d-flex align-items-center">
                      <h5 class="mb-0">
                        {{ $t("register_has_acount") }}
                        <router-link
                          :to="{ name: 'login' }"
                          active-class="active"
                          class="text-primary"
                          >{{ $t("goTo__login_link") }}
                        </router-link>
                      </h5>
                      <div class="ml-auto">
                        <v-button
                          :loading="form.busy"
                          class="badge-pill btn-shadow btn-hover-shine btn bg-main"
                        >
                          {{ $t("register") }}
                        </v-button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="d-lg-flex d-xs-none col-lg-5">
              <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-main">
                
                <div class="mx-auto px-5">
                  <h3 class="text-white mb-3 text-center">"{{ $t('announce_form_quote') }}"</h3>
                  <h5 class="text-right text-muted"><em>= {{ $t('announce_form_author') }} =</em> </h5>
                  <sui-list>
                    <a is="sui-list-item" class="d-flex align-items-center text-white ">
                      <sui-icon name="home main-color" size="huge" />
                      <sui-list-content>
                        <sui-list-header>{{ $t("announce_list1_1") }}</sui-list-header>
                        <sui-list-description
                          >{{ $t("announce_list1_2") }}
                        </sui-list-description>
                      </sui-list-content>
                    </a>
                    <a is="sui-list-item" class="d-flex align-items-center text-white ">
                      <sui-icon name="sign-in alternate main-color" size="huge" />
                      <sui-list-content>
                        <sui-list-header>{{ $t("announce_list2_1") }}</sui-list-header>
                        <sui-list-description
                          >{{ $t("announce_list2_2") }}
                        </sui-list-description>
                      </sui-list-content>
                    </a>
                    <a is="sui-list-item" class="d-flex align-items-center text-white ">
                      <sui-icon name="phone volume main-color" size="huge" />
                      <sui-list-content>
                        <sui-list-header>{{ $t("announce_list3_1") }}</sui-list-header>
                        <sui-list-description
                          >{{ $t("announce_list3_2") }}
                        </sui-list-description>
                      </sui-list-content>
                    </a>
                  </sui-list>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import LoginWithGithub from "~/components/LoginWithGithub";
import NavOnly from "~/components/NavOnly";
import LocaleDropdown from "~/components/LocaleDropdown";

export default {
  components: {
    LoginWithGithub,
    NavOnly,
    LocaleDropdown,
  },
    layout: 'basic',
  middleware: "guest",

  data: () => ({
    form: new Form({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      activity: "",
    }),
    mustVerifyEmail: false,
    appName: window.config.appName,
  }),  
  methods: {
    async register() {
      // Register the user.
      const { data } = await this.form.post("/api/create-user-activity");

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
      } else {
        // Log in the user.
        const {
          data: { token },
        } = await this.form.post("/api/login");

        // Save the token.
        this.$store.dispatch("auth/saveToken", { token });

        // Update the user.
        await this.$store.dispatch("auth/updateUser", { user: data });

        // Redirect home.
        this.$router.push({ name: "home" });
      }
    },
  },
};
</script>

<style lang="scss">
.divider {
  margin-top: 1rem;
  margin-bottom: 1rem;
  height: 1px;
  overflow: hidden;
  background: #e9ecef;
}
</style>
