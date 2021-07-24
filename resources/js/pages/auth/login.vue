<template>
  <div class="h-100 row">
    <div class="app-container">
      <div class="h-100 row">
        <div class="hidden-xs-down col-md-3 col-lg-4" style="background: url('images/vendor/622523.jpg') no-repeat center center; background-size: cover">
          <article class="shadow-none">
            <!-- <aside>
              <img src="images/vendor/01.jpg" class="h-100" style="object-fit:cover" alt="">
            </aside> -->
            <section class="hidden-sm-down hidden-md-down">
              <h1 class="h1-time">
                {{ $t('login_slider_title') }}
              </h1>
              <div class="teaser">
                <figure>
                  <img alt="" src="images/vendor/3.jpg">
                  <figcaption>
                    <h3>Lubito</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/announce.jpg">
                  <figcaption>
                    <h3>Luena</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/03.jpg">
                  <figcaption>
                    <h3>Cabinda</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/2.jfif">
                  <figcaption>
                    <h3>Luanda</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/05.jpg">
                  <figcaption>
                    <h3>Bengo</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/06.jpg">
                  <figcaption>
                    <h3>Lundas</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/1.jfif">
                  <figcaption>
                    <h3>Namibe</h3>
                  </figcaption>
                </figure>
                <figure>
                  <img alt="" src="images/vendor/04.jpg">
                  <figcaption>
                    <h3>Lubango</h3>
                  </figcaption>
                </figure>
              </div>
              <p>
                {{ $t('history_footer') }}
              </p>
              <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <h3 class="h3-responsive text-white">
                      {{ $t('login_slider_1') }}
                    </h3>
                  </div>
                  <div class="carousel-item">
                    <h3 class="h3-responsive text-white">
                      {{ $t('login_slider_2') }}
                    </h3>
                  </div>
                  <div class="carousel-item">
                    <h3 class="h3-responsive text-white">
                      {{ $t('login_slider_3') }}
                    </h3>
                  </div>
                </div>
              </div>
            </section>
          </article>
        </div>
        <div class="h-100 col-md-9 col-lg-8">
          <!-- <NavOnly class="shadow-none" /> -->
          <div class="h-100 d-flex justify-content-center align-items-center">
            <div class="col-lg-8 my-lg-5 my-sm-3 py-lg-5">
              <div class="app-logo my-2">
                <router-link to="/" class="navbar-brand">
                  <img src="images/logo/200x48.png" :alt="appName" class="img-fluid ml-n2">
                </router-link>
                <ul class="navbar-nav">
                  <LocaleDropdown />
                </ul>
              </div>
              <p class="mb-0 text-muted my-3" style="font-family: Arial, Helvetica, sans-serif; font-size: 1.5em">
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
                    <div class="form-group">
                      <label for="email">{{ $t("email") }}</label>
                      <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                      <has-error :form="form" field="email" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">{{ $t("password") }}</label>
                      <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                      <has-error :form="form" field="password" />
                    </div>
                  </div>
                </div>
                <div class="form-check">
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
                    <!-- <login-with-github /> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import LocaleDropdown from '~/components/LocaleDropdown'

export default {
  components: {
    LocaleDropdown
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
.app-container {
    display: flex;
    min-height: 100vh;
    width: 100%;
    flex-direction: column;
    margin: 0 15px;
}
article {
  display: flex;
  height: 100%;
  position: relative;
  background: transparent;
  box-shadow: 0px 0px 50px -10px #9a7289;
}

aside {
  width: 30%;
  background-color: #ccc;
}
aside img {
  width: 100%;
  height: 100%;
  display: block;
}

section {
  width: 100%;
  overflow: hidden;
  padding: 2% 5% 0;
  position: relative;
}
section:before {
  position: absolute;
  right: 0;
  width: 5%;
  top: 0;
  height: 100%;
  background: red;
}

.h1-time {
  font-family: Montserrat, sans-serif;
  font-size: 6vw;
  margin: 0 0 2vw 0;
  color: rgb(36, 36, 36);
}

@keyframes move {
  0% {
    transform: translate3d(0px, 0px, 0px);
  }
  100% {
    transform: translate3d(-1250px, 0px, 0px);
  }
}
.teaser {
  display: flex;
  margin: 0 0 3vw 0;
  animation: move 20s forwards linear;
}
.teaser figure {
  overflow: hidden;
  margin: 0;
  width: 250px;
  min-width: 250px;
  padding: 0 30px 0 0;
  position: relative;
}
.teaser img {
  width: 220px;
  height: 180px;
  object-fit: cover;
}
.teaser figcaption {
  position: absolute;
  background-color: #fff;
  bottom: 0;
  font-size: 20px;
  color: #000;
  mix-blend-mode: screen;
}
.teaser figcaption h3 {
  margin: 0;
  padding: 3px 5px;
  width: 100%;
}
</style>
