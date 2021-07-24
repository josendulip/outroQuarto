<template>
  <div class="d-inline">
    <ShareNetwork
      network="facebook"
      :url="currentRouter"
      :title="houseDetails.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })"
      :description="strippedContent"
      :quote="strippedContent"
      :hashtags="hashtags"
    >
      <button class="mini ui facebook button">
        <i class="facebook icon" /> Facebook
      </button>
    </ShareNetwork>
    <ShareNetwork
      network="twitter"
      :url="currentRouter"
      :title="houseDetails.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })"
      :description="strippedContent"
      :hashtags="hashtags"
    >
      <button class="mini ui twitter button">
        <i class="twitter icon" /> Twitter
      </button>
    </ShareNetwork>
    <ShareNetwork
      network="vk"
      :url="currentRouter"
      :title="houseDetails.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })"
      :description="strippedContent"
      :hashtags="hashtags"
    >
      <button class="mini ui vk button">
        <i class="vk icon" /> VK
      </button>
    </ShareNetwork>
    <ShareNetwork
      network="whatsapp"
      :url="currentRouter"
      :title="houseDetails.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })"
      :description="strippedContent"
      :hashtags="hashtags"
    >
      <button class="mini ui whatsapp button" style="background-color: #25d366!important; color: white">
        <i class="whatsapp icon" /> WhatsApp
      </button>
    </ShareNetwork>
    <ShareNetwork
      network="telegram"
      :url="currentRouter"
      :title="houseDetails.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })"
      :description="strippedContent"
      :hashtags="hashtags"
    >
      <button class="mini ui telegram button" style="background-color: #0088cc; color: white">
        <i class="telegram icon" /> Telegram
      </button>
    </ShareNetwork>
    <ShareNetwork
      network="linkedin"
      :url="currentRouter"
      :title="houseDetails.price | currency('AKZ', 2, { spaceBetweenAmountAndSymbol: true })"
      :description="strippedContent"
      :hashtags="hashtags"
    >
      <button class="mini ui linkedin button">
        <i class="linkedin icon" /> LinkedIn
      </button>
    </ShareNetwork>
  </div>
</template>
<script>
export default {
  props: ['houseDetails'],
  data () {
    return {
      url: 'https://news.vuejs.org/issues/180',
      title: 'Say hi to Vite! A brand new, extremely fast development setup for Vue.',
      description: this.houseDetails.description,
      quote: this.houseDetails.city,
      hashtags: this.houseDetails.type,
      twitterUser: 'OutroQuarto',
      networks: [
        { network: 'baidu', name: 'Baidu', icon: 'fas fah fa-lg fa-paw', color: '#2529d8' },
        { network: 'buffer', name: 'Buffer', icon: 'fab fah fa-lg fa-buffer', color: '#323b43' },
        { network: 'email', name: 'Email', icon: 'far fah fa-lg fa-envelope', color: '#333333' },
        { network: 'evernote', name: 'Evernote', icon: 'fab fah fa-lg fa-evernote', color: '#2dbe60' },
        { network: 'facebook', name: 'Facebook', icon: 'fab fah fa-lg fa-facebook-f', color: '#1877f2' },
        { network: 'flipboard', name: 'Flipboard', icon: 'fab fah fa-lg fa-flipboard', color: '#e12828' },
        { network: 'hackernews', name: 'HackerNews', icon: 'fab fah fa-lg fa-hacker-news', color: '#ff4000' },
        { network: 'instapaper', name: 'Instapaper', icon: 'fas fah fa-lg fa-italic', color: '#428bca' },
        { network: 'line', name: 'Line', icon: 'fab fah fa-lg fa-line', color: '#00c300' },
        { network: 'linkedin', name: 'LinkedIn', icon: 'fab fah fa-lg fa-linkedin', color: '#007bb5' },
        { network: 'messenger', name: 'Messenger', icon: 'fab fah fa-lg fa-facebook-messenger', color: '#0084ff' },
        { network: 'odnoklassniki', name: 'Odnoklassniki', icon: 'fab fah fa-lg fa-odnoklassniki', color: '#ed812b' },
        { network: 'pinterest', name: 'Pinterest', icon: 'fab fah fa-lg fa-pinterest', color: '#bd081c' },
        { network: 'pocket', name: 'Pocket', icon: 'fab fah fa-lg fa-get-pocket', color: '#ef4056' },
        { network: 'quora', name: 'Quora', icon: 'fab fah fa-lg fa-quora', color: '#a82400' },
        { network: 'reddit', name: 'Reddit', icon: 'fab fah fa-lg fa-reddit-alien', color: '#ff4500' },
        { network: 'skype', name: 'Skype', icon: 'fab fah fa-lg fa-skype', color: '#00aff0' },
        { network: 'sms', name: 'SMS', icon: 'far fah fa-lg fa-comment-dots', color: '#333333' },
        { network: 'stumbleupon', name: 'StumbleUpon', icon: 'fab fah fa-lg fa-stumbleupon', color: '#eb4924' },
        { network: 'telegram', name: 'Telegram', icon: 'fab fah fa-lg fa-telegram-plane', color: '#0088cc' },
        { network: 'tumblr', name: 'Tumblr', icon: 'fab fah fa-lg fa-tumblr', color: '#35465c' },
        { network: 'twitter', name: 'Twitter', icon: 'fab fah fa-lg fa-twitter', color: '#1da1f2' },
        { network: 'viber', name: 'Viber', icon: 'fab fah fa-lg fa-viber', color: '#59267c' },
        { network: 'vk', name: 'Vk', icon: 'fab fah fa-lg fa-vk', color: '#4a76a8' },
        { network: 'weibo', name: 'Weibo', icon: 'fab fah fa-lg fa-weibo', color: '#e9152d' },
        { network: 'whatsapp', name: 'Whatsapp', icon: 'fab fah fa-lg fa-whatsapp', color: '#25d366' },
        { network: 'wordpress', name: 'Wordpress', icon: 'fab fah fa-lg fa-wordpress', color: '#21759b' },
        { network: 'xing', name: 'Xing', icon: 'fab fah fa-lg fa-xing', color: '#026466' },
        { network: 'yammer', name: 'Yammer', icon: 'fab fah fa-lg fa-yammer', color: '#0072c6' },
        { network: 'fakeblock', name: 'Custom Network', icon: 'fab fah fa-lg fa-vuejs', color: '#41b883' }
      ]
    }
  },
  computed: {
    currentRouteName () {
      return this.$router.history.current.path
    },
    currentRouter () {
      const urlCurrrent = window.location
      return urlCurrrent
    },
    strippedContent () {
      const regex = /(<([^>]+)>)/ig
      return this.houseDetails.description.replace(regex, '') + '\n' + this.$t('home_form_location') + ': ' + this.houseDetails.city + ', ' + this.houseDetails.county + '\n' + this.$t('announce_form_type') + ': ' + this.houseDetails.type + '\n' + this.$t('announce_form_contract') + ': ' + this.houseDetails.contrat_type/*  + '\n' + this.$t('announce_form_living_room') + ': ' + this.houseDetails.living_room + '\n' + this.$t('announce_form_kitchen') + ': ' + this.houseDetails.kitchen + '\n' + this.$t('announce_form_rooms') + ': ' + this.houseDetails.room + '\n' + this.$t('announce_form_bathroom') + ': ' + this.houseDetails.bathroom + '\n' + this.$t('announce_form_widthW') + ': ' + this.houseDetails.witdh + '\n' + this.$t('announce_form_lengthL') + ': ' + this.houseDetails.length + '\n' + this.$t('announce_form_areaA') + ': ' + this.houseDetails.area */
    }
  }
}
</script>
