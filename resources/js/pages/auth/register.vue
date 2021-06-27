<template>
    <div class="h-100 row">
        <div class="app-container app-theme-white body-tabs-shadow">
            <div class="app-container">
                <div class="h-100">
                    <div class="h-100 no-gutters row">
                        <div class="h-100 d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-7">
                            <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9 px-5">
                                <div class="app-logo my-5">
                                <router-link to="/" class="navbar-brand">
                                    <img src="images/logo/200x48.png" :alt="appName" class="img-fluid">                                    
                                </router-link>
                                <!--<ul class="navbar-nav">
                                <locale-dropdown />
                                </ul>!--></div>
                                <p class="mb-0 text-muted my-3" style="font-family: Arial, Helvetica, sans-serif; font-size:1.5em">
                                    <span class="d-block"> {{ $t('register_welcome') }}</span>
                                    <span> {{ $t('register_head_phrase1') }} <span class="text-success">{{ $t('register_head_phrase2') }} </span> {{ $t('register_head_phrase3') }}</span>
                                </p>
                                <div class="divider row"></div>
                                <card v-if="mustVerifyEmail" :title="$t('register')">
                                    <div class="alert alert-success" role="alert">
                                    {{ $t('verify_email_address') }}
                                    </div>
                                </card>
                                <div v-else :title="$t('register')">
                                    <form @submit.prevent="register" @keydown="form.onKeydown($event)">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="email" class=""><span class="text-danger">*</span> Email</label>
                                                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                                                    <has-error :form="form" field="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="name" class=""><span class="text-danger">*</span> {{ $t('name') }}</label>
                                                     <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                                                    <has-error :form="form" field="name" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="password" class=""><span class="text-danger">*</span> {{ $t('password') }}</label>
                                                    <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                                                    <has-error :form="form" field="password" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="confirm_password" class=""><span class="text-danger">*</span> {{ $t('confirm_password') }}</label>
                                                    <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
                                                    <has-error :form="form" field="password_confirmation" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 position-relative form-check">
                                            <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                            <label for="exampleCheck" class="form-check-label">{{ $t('register_terms') }} <a href="javascript:void(0);">{{ $t('register_link_phrase') }}</a>.</label>
                                        </div>
                                        <div class="divider row"></div>
                                        <div class="mt-4 d-flex align-items-center">
                                            <h5 class="mb-0">{{ $t('register_has_acount') }} <router-link :to="{ name: 'login' }" active-class="active" class="text-primary">{{ $t('goTo__login_link') }} </router-link></h5>
                                            <div class="ml-auto">
                                                <v-button :loading="form.busy" class="badge-pill btn-shadow btn-hover-shine btn btn-primary px-5">
                                                    {{ $t('register') }}
                                                </v-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="d-lg-flex d-xs-none col-lg-5">
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center" style="background: url('images/register_login/4.jpg') no-repeat center center; background-size: cover;">
                                <div class="text-white mx-auto px-5">
                                    <h3 class="h2">{{ $t('text_register_title') }}</h3>
                                    <p class="lead"> {{ $t('text_register') }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!--
        <div class="col-lg-8 m-auto">
        <card v-if="mustVerifyEmail" :title="$t('register')">
            <div class="alert alert-success" role="alert">
            {{ $t('verify_email_address') }}
            </div>
        </card>
        <card v-else :title="$t('register')">
            <form @submit.prevent="register" @keydown="form.onKeydown($event)">
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
                <div class="col-md-7">
                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                <has-error :form="form" field="name" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
                <div class="col-md-7">
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                <has-error :form="form" field="email" />
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
                <div class="col-md-7">
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                <has-error :form="form" field="password" />
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
                <div class="col-md-7">
                <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
                <has-error :form="form" field="password_confirmation" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-7 offset-md-3 d-flex">
                
                <v-button :loading="form.busy">
                    {{ $t('register') }}
                </v-button>


                <login-with-github />
                </div>
            </div>
            </form>
        </card>
        </div>
        !-->
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'
import NavOnly from '~/components/NavOnly'
import LocaleDropdown from '../../components/LocaleDropdown'

export default {
    components: {
        LoginWithGithub,
        NavOnly,
        LocaleDropdown
    },

    layout: 'basic',
    middleware: 'guest',

    metaInfo () {
        return { title: this.$t('register') }
    },

    data: () => ({
        form: new Form({
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }),
        mustVerifyEmail: false,
        appName: window.config.appName,
    }),

    methods: {
        async register () {
            // Register the user.
            const { data } = await this.form.post('/api/register')

            // Must verify email fist.
            if (data.status) {
                this.mustVerifyEmail = true
            } else {
                // Log in the user.
                const { data: { token } } = await this.form.post('/api/login')

                // Save the token.
                this.$store.dispatch('auth/saveToken', { token })

                // Update the user.
                await this.$store.dispatch('auth/updateUser', { user: data })

                // Redirect home.
                this.$router.push({ name: 'home' })
            }
        }
    }
}
</script>

<style lang="scss">    
    .app-container {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        margin: 0;
        width: 100%;
    }
    .divider {
        margin-top: 1rem;
        margin-bottom: 1rem;
        height: 1px;
        overflow: hidden;
        background: #e9ecef;
    }
</style>