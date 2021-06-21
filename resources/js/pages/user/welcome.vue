<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 welcome">
        <div class="display-4 mt-3 ">
          {{ $t('mypanel_welcome_message') }}
        </div>

        <p class="text-justify my-3 h6">
          {{ $t('mypanel_welcome_phrase_2') }}
        </p>
        <p class="text-justify my-3 h6">
          {{ $t('mypanel_welcome_phrase_3') }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'user.welcome',
  middleware: 'auth',
  data: () => ({
    myHouses: {}
  }),
  computed: mapGetters({
    user: 'auth/user',
    authenticated: 'auth/check',
  })
}
</script>
