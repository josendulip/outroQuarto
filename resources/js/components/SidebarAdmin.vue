<template>
  <div>
    <!-- Nav Links -->
    <nav class="navMenu" :style="[userStyles.navMenu, menuDirection, menuWidth]">
        <div class="iconImage">          
            <img src="/images/logo/200x48W.png" alt="Logo" class="image">
            <a href="javscript:void(0)" class="closebtn" @click.prevent="closeMenu"><i class="window close icon"></i></a>
        </div>
        <hr>
      <template v-if="links.length">
            <div class="container">
                <div class="d-flex justify-content-lg-start align-items-center avatar-div">
                  <router-link  :to="{ name: 'admin.profile' }" class="p-0 m-0">
                    <img src="/images/profile/user-default.png" alt="Avatar" class="avatar" v-if="!avatar">
                    <img :src="avatar" alt="Avatar" class="avatar"   v-else >
                  </router-link>
                    <div class="mx-2">
                        <router-link  :to="{ name: 'admin.profile' }" class="p-0 m-0">
                          <h4 v-text="username" class="text-uppercase text-white my-0 py-0"></h4>
                        </router-link>
                        <p class="p-0 m-0 font-weight-bold text-capitalize" v-if="city != ''">{{ city }}, {{ country }}</p>
                        <p class="p-0 m-0 font-weight-bold" v-else>Luanda, Angola</p>
                        <span class="badge badge-pill badge-light" v-text="status"></span>
                    </div>
                </div>
            </div>
                <hr>
            <div class="container">
                <h3 class="text-white"><router-link :to="{  name: 'admin.dashboard' }">{{$t('myadmin')}}</router-link></h3>
                <router-link v-for="link in links" :key="link.id" :to="link.url" :style="link.styles"><i :class="link.icon"></i> {{ link.text }}</router-link>
                

          </div>
      </template>
      <slot v-else />
    </nav>
    <!-- Hamburger Menu -->
    <nav class="navIcon" :style="[userStyles.navIcon, iconDirection]">
         <sui-button icon="bars"  @click.prevent="toggleMenu" data-test-ref="navMenuLink"/>
         
            
      
    </nav>
  </div>
</template>

<script>

import styles from '../../sass/_variables.scss'
import utilities from '../utilities'

export default {
  name: 'sidebar',
  props: {
    width: {
      type: Number,
      required: false,
      default: 300
    },
    format: {
      type: String,
      required: false,
      default: 'overlay',
      validator: (value) => ['push', 'full', 'overlay'].indexOf(value) > -1
    },
    direction: {
      type: String,
      required: false,
      default: 'left',
      validator: (value) => ['left', 'right'].indexOf(value) > -1
    },
    opacity: {
      type: Number,
      required: false,
      default: 0
    },
    links: {
      type: Array,
      required: false,
      default: () => ([])
    },
    customStyles: {
      type: Object,
      required: false,
      deep: true,
      default: () => ({})
    },
    avatar: {
      type: String,
      required: false,
      default: '/images/profile/user-default.png',
    },
    username:{
        type: String,
      required: false,
      default: 'Username',
    },
    status:{
        type: String,
      required: false,
      default: 'Active',
    },
    city: {
      type: String,
      required: false,
      default: 'Luanda',
    },
    country: {
      type: String,
      required: false,
      default: 'Angola',
    },
  },
  data () {
    const defaultStyles = {
      'navMenu': {},
      'navIcon': {}
    }
    return {
      styles: styles,
      menuWidth: {
        'width': 300
      },
      userStyles: Object.assign({}, defaultStyles, this.customStyles)
    }
  },
  watch: {
    customStyles () {
      this.userStyles = Object.assign({}, this.userStyles, this.customStyles)
    }
  }, 
  computed: {
    mapGetters(){
      user: 'auth/user'
    },
    menuDirection () {
      return this.direction === 'right'
        ? { 'right': 0 }
        : { 'left': 0 }
    },
    iconDirection () {
      return { 'float': this.direction }
    },
    app () {
      //return document.getElementById('app') //era esse que estava la
      return document.getElementById('admin') 
    },
    navBar () {
      //return document.getElementById('app') //era esse que estava la
      return document.getElementById('my-navBar') 
    }, 
  },
  mounted () {
    if (!this.app) {
      console.warn(`[Sidebar] The format was set to '${this.format}', but there is no element with an id 'app'. Add id='admin' to the element to move.`)
    }
  },
  methods: {
    openMenu () {
      const width = `${this.width}px`
      const marginDirection = `margin-${this.direction}`
      this.menuWidth = {
        'width': this.format === 'full' ? '100%' : width
      }
      if (this.app && this.format === 'push') {
        this.app.style[marginDirection] = width
        this.app.style.transition = `${marginDirection} .5s`
      }
      if (this.opacity) {
        document.body.style.background = utilities.hexToRGB(styles['background-color'], this.opacity)
      }
    },
    closeMenu () {
      this.menuWidth = { 'width': 0 }
      if (this.app) {
        this.app.style.marginLeft = '0'
        this.app.style.marginRight = '0'
      }
      if (this.opacity) {
        document.body.style.background = styles['background-color']
      }
    },
    toggleMenu () {
      if (this.menuWidth.width === 0) {
        this.openMenu()
      } else {
        this.closeMenu()
      }
    }
  }
}
</script>

<style lang="scss" scoped></style>