<template>
    <div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <sui-card :title="$t('settings')" class=" rounded-radius py-5">
                <sui-card-content>
                    <sui-container text-align="justified">
                        <ul class="nav flex-column nav-pills">
                            <li v-for="tab in tabs" :key="tab.route" class="nav-item">
                                <router-link :to="{ name: tab.route }" class="nav-link rounded-radius my-2" active-class="active">
                                    <fa :icon="tab.icon" fixed-width />
                                {{ tab.name }}
                                </router-link>
                            </li>
                        </ul>   
                    </sui-container>           
                </sui-card-content>
            </sui-card>
        </div>

        <div class="col-md-9">
            <transition name="fade" mode="out-in">
                <router-view />
            </transition>
        </div>
    </div>
    </div>
</template>

<script>
export default {
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        {
            icon: 'user',
            name: this.$t('profile'),
            route: 'settings.profile'
        },
        {
            icon: 'lock',
            name: this.$t('password'),
            route: 'settings.password'
        },
        {
            icon: 'info',
            name: this.$t('additional'),
            route: 'settings.additional'
        }
      ]
    }
  }
}
</script>

<style>
    .settings-card .card-body {
        padding: 0;
    }
    .main-red{
        background-color:#FF3D47!important;
    } 

    .rounded-radius{
        border-radius: 2em!important;
    }
    .main-red .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #FF3D47;
    }
</style>
