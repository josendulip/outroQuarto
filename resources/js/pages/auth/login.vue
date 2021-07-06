<template>
  <div class="h-100 no-gutters row">
    <div class="d-none d-lg-block col-lg-4">
      <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-2" data-slide-to="0" class="active" />
          <li data-target="#carousel-example-2" data-slide-to="1" />
          <li data-target="#carousel-example-2" data-slide-to="2" />
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <div class="view">
              <img class="d-block w-100" src="/images/register_login/1.jpg" alt="First slide">
              <div class="mask rgba-black-light" />
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">
                {{ $t('login_slider_1') }}
              </h3>
            </div>
          </div>
          <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
              <img class="d-block w-100" src="/images/register_login/2.jpg" alt="Second slide">
              <div class="mask rgba-black-strong" />
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">
                {{ $t('login_slider_2') }}
              </h3>
            </div>
          </div>
          <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
              <img class="d-block w-100" src="/images/register_login/3.jpg" alt="Third slide">
              <div class="mask rgba-black-slight" />
            </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">
                {{ $t('login_slider_3') }}
              </h3>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true" />
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true" />
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div
      class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8"
    >
      <div class="mx-auto col-12">
        <NavOnly class="shadow-none" />
        <div class="mx-auto col-sm-12 col-md-10 col-lg-9">
          <div class="my-lg-5 my-sm-3 py-lg-5">
            <div class="app-logo my-5">
              <router-link to="/" class="navbar-brand">
                <img src="images/logo/200x48.png" :alt="appName" class="img-fluid">
              </router-link>
            </div>
            <p
              class="mb-0 text-muted my-3"
              style="font-family: Arial, Helvetica, sans-serif; font-size: 1.5em"
            >
              <span class="d-block">{{ $t("login_head1_phrase") }} </span>
              <span>{{ $t("login_head2_phrase") }}</span>
            </p>
            <h6 class="my-4">
              {{ $t("login_phrase_account") }}
              <router-link :to="{ name: 'register' }" class="text-primary" active-class="active">
                {{ $t("goTo_register_link") }}
              </router-link>
            </h6>
            <div class="divider row" />
            <form @submit.prevent="login" @keydown="form.onKeydown($event)">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="position-relative form-group">
                    <label for="email">{{ $t("email") }}</label>
                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                    <has-error :form="form" field="email" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="position-relative form-group">
                    <label for="password">{{ $t("password") }}</label>
                    <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                    <has-error :form="form" field="password" />
                  </div>
                </div>
              </div>
              <div class="position-relative form-check">
                <checkbox v-model="remember" name="remember">
                  {{ $t("remember_me") }}
                </checkbox>
                <!--<label for="remember" class="form-check-label">Keep me logged in</label>!-->
              </div>
              <div class="divider row" />
              <div class="d-flex align-items-center">
                <div class="ml-auto">
                  <router-link
                    :to="{ name: 'password.request' }"
                    class="small ml-auto mr-2 my-auto text-uppercase"
                  >
                    {{ $t("forgot_password") }}
                  </router-link>

                  <!-- Submit Button -->
                  <v-button :loading="form.busy" class="btn-danger">
                    {{ $t("login") }}
                  </v-button>

                  <!-- GitHub Login Button -->
                  <login-with-github />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import LoginWithGithub from '~/components/LoginWithGithub'
import NavOnly from '~/components/NavOnly'

export default {
  components: {
    LoginWithGithub,
    NavOnly
  },

  layout: 'basic',
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false,
    appName: window.config.appName
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.

      // setTimeout(() => {
      await this.redirect()
      // }, 100)
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        // location.reload();
        // setTimeout(() => {
        this.$router.push({ name: 'home' })
        // }, 100)
      }
    }
  }
}
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
