<template>
  <div>
    <Navout />
    <div class="jumbotron jumbotron-fluid  p-0 m-0" style="background: url('/images/vendor/2.jpg') no-repeat center center; background-size: cover;">
      <div class="rgba-indigo-strong">
        <div class="container">
          <h1 class="display-4 main-color">
            {{ $t('outro4_footer') }}
          </h1>
          <p class="lead text-white">
            {{ $t('history_footer') }}
          </p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row my-5">
        <div class="col-md-4 mb-4">
          <div class="card card-y text-white card-has-bg click-col" style="background-image:url('/images/vendor/5.jpg');">
            <img class="card-img d-none" src="/images/vendor/5.jpg" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
            <div class="card-img-overlay d-flex flex-column">
              <div class="card-body">
                <small class="card-meta mb-2 text-dark font-weight-bold">{{ $t('about_mission_title') }}</small>
                <h4 class="card-title mt-0 ">
                  <a class="text-white">{{ $t('about_mission_title_min') }}</a>
                </h4>
                <small><i class="far fa-clock" /> October 15, 2020</small>
              </div>
              <div class="card-footer footer-card">
                <div class="media">
                  <img class="mr-3 rounded-circle" src="/images/logo/logo-circle.png" alt="OutroQuarto" style="max-width:50px">
                  <div class="media-body">
                    <h6 class="my-0 text-white d-block mt-2">
                      OutroQuarto
                    </h6>
                    <small>Lugar certo para encontrar a sua casa</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 p-sm-4">
          <h3>{{ $t('about_mission_title') }}</h3>
          <p class="myText">
            {{ $t('about_mission_paragraph') }}
          </p>
        </div>
      </div>
      <div class="row my-5">
        <div class="col-lg-6 mx-auto mb-4">
          <!-- CUSTOM BLOCKQUOTE -->
          <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded-radius">
            <div class="blockquote-custom-icon bg-main shadow-sm">
              <i class="mdi mdi-home text-white" />
            </div>
            <h1>{{ $t('about_vision_title') }}</h1>
            <p class="mb-0 mt-3 myText1">
              "{{ $t('about_vision_paragraph') }}"
            </p>
          </blockquote><!-- END -->
        </div>
        <div class="col-lg-6 mx-auto">
          <!-- CUSTOM BLOCKQUOTE -->
          <blockquote class="blockquote blockquote-custom bg-white p-5 shadow rounded-radius">
            <div class="blockquote-custom-icon bg-main shadow-sm">
              <i class="mdi mdi-home icon text-white" />
            </div>
            <h1>{{ $t('about_carear_title') }} </h1>
            <p class="mb-0 mt-2 myText1">
              "{{ $t('about_carear_paragraph') }}  <a href="#" class="text-info">carreira@outroquarto.com</a>."
            </p>
            <footer class="blockquote-footer pt-4 mt-3 border-top">
              {{ $t('about_carear_title') }} - OutroQuarto
              <cite title="Source Title text-info">carreira@outroquarto.com</cite>
            </footer>
          </blockquote><!-- END -->
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>

import Footer from '../components/Footer'
import Navout from '~/components/Navout'
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'about',
  components: {
    Navout,
    Footer
  },
  layout: 'basic',
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName,
    current: null
  })
}
</script>

<style lang="scss">
  @import url('https://fonts.googleapis.com/css2?family=Taviraj:wght@200&display=swap');
  .myText{font-family: 'Taviraj', serif; font-size: 20px;}
  .myText1{font-family: 'Taviraj', serif; font-size: 18px;}
  .blockquote-custom {
    position: relative;
    font-size: 1.1rem;
  }
  .rgba-indigo-strong {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 4rem 2rem;
  }
  .blockquote-custom-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: -25px;
    left: 50px;
  }
  .card-y{
    border: none;
    transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
    overflow:hidden;
    border-radius:20px;
    min-height:450px;
    box-shadow: 0 0 12px 0 rgba(0,0,0,0.2);

    @media (max-width: 768px) {
        min-height:350px;
    }
    @media (max-width: 420px) {
      min-height:300px;
    }

    &.card-has-bg{
      transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
      background-size:120%;
      background-repeat:no-repeat;
      background-position: center center;
      &:before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: inherit;
        -webkit-filter: grayscale(1);
      -moz-filter: grayscale(100%);
      -ms-filter: grayscale(100%);
      -o-filter: grayscale(100%);
      filter: grayscale(100%);}

      &:hover {
        transform: scale(0.98);
        box-shadow: 0 0 5px -2px rgba(0,0,0,0.3);
        background-size:130%;
        transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);

        .card-img-overlay {
          transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
          background: rgb(35,79,109);
        background: linear-gradient(0deg, rgba(4,69,114,0.5) 0%, rgba(4,69,114,1) 100%);
        }
      }
    }
    .footer-card{
      background: none;
      border-top: none;
      .media{
        img{
          border:solid 3px rgba(234,95,0,0.3);
        }
      }
    }
    .card-meta{color:orange}
    .card-body{transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);}
    &:hover {
      .card-body{
        margin-top:30px;
        transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
      }
      cursor: pointer;
      transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
    }
  .card-img-overlay {
    transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
    background: rgb(255, 88, 89);
    background: linear-gradient(0deg, rgba(255, 88, 89,0.3785889355742297) 0%, rgb(245, 64, 64) 100%);
  }
}
</style>
