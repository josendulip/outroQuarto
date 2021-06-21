<template>
    <div class="main-layout app-container">
        <!--<navbar />!-->
        <Navigator/>
        <div class="app-container">
            <router-view />
        </div>
    </div>
</template>

<script>

/* import Navbar from '~/components/Navbar' */
import Navigator from '../components/Navigator'
import adminLayout from '../components/admin-layout'
import { mapGetters } from "vuex";

export default {
    name: 'MainLayout',

    components: {
        //Navbar,
        Navigator,
        adminLayout
    },
    
  computed: mapGetters({
    user: "auth/user",
    authenticated: "auth/check",
  }),
}
</script>
<style lang="scss">
    .app-container {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        margin: 0;
    }
    .rgba-black-light{
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>