<template>
  <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ $t('mypanel_assestment_link') }}</th>
          <th>{{ $t('mypanel_assestment_assessment') }}</th>
          <th>{{ $t('mypanel_assestment_number') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="house in myHouses" :key="house.id">
          <td class="py-1">
            <a href="javascript:void(0)" @click.prevent="viewHouse(house.house_code)"> <i class="home icon" />{{ house.house_code }}</a>
          </td>
          <td>
            <StarRating
              v-model="house.rating"
              :increment="0.5"
              :star-size="20"
              :border-width="4"
              border-color="#d8d8d8"
              :rounded-corners="true"
              :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"
              :inline="true"
            />
          </td>
          <td><strong>{{ house.rating }}/5</strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
// Rating Star
import StarRating from 'vue-star-rating'
import Form from 'vform'
import axios from 'axios'

export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'user.assessments',
  components: {
    StarRating
  },
  data: () => ({
    myHouses: {},
    form: new Form({
      id: '',
      user_id: '',
      house_id: '',
      house_code: null,
      description: '',
      rating: null,
      approved: '',
      mode: ''
    })
  }),
  mounted () {
    this.loadReview()
  },
  methods: {
    viewHouse (houseCode) {
      this.$router.push('/view/' + houseCode)
    },
    loadReview () {
      axios.get('/api/review').then(({ data }) => (this.myHouses = data))
    }
  }
}
</script>
