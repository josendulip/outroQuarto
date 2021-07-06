<template>
  <div style="background: url('/images/vendor/2.jpg') no-repeat center center; background-size: cover;">
    <footer class="footer">
      <div class="container bottom_border">
        <div class="row">
          <div class=" col-sm-4 col-md col-sm-4  col-12 col">
            <h5 class="headin5_amrc col_white_amrc pt2">
              <img class="mr-3 rounded-circle" src="/images/logo/200x48W.png" alt="OutroQuarto">
            </h5>
            <p class="mb10">
              {{ $t('history_footer') }}
            </p>
            <p><i class="fa fa-location-arrow" /> {{ $t('address_footer') }} Luanda - Angola</p>
            <p><i class="fa fa-phone" />  {{ $t('phone_footer') }} +244 (936) 09-02-38</p>
            <p><i class="fa fa fa-envelope" /> {{ $t('email_footer') }} info@outroquarto.com </p>
          </div>
          <div class=" col-sm-4 col-md  col-6 col">
            <h5 class="headin5_amrc col_white_amrc pt2">
              {{ $t('menu1_footer') }}
            </h5>
            <ul class="footer_ul_amrc">
              <li>
                <router-link :to="{'name': 'about'}">
                  {{ $t('mission_footer') }}
                </router-link>
              </li>
              <li>
                <router-link :to="{'name': 'about'}">
                  {{ $t('vision_footer') }}
                </router-link>
              </li>
              <li>
                <router-link :to="{'name': 'about'}">
                  {{ $t('career_footer') }}
                </router-link>
              </li>
              <li>
                <router-link :to="{'name':'policy'}">
                  {{ $t('privacy_footer') }}
                </router-link>
              </li>
              <li>
                <router-link :to="{'name':'term-condition'}">
                  {{ $t('terms_footer') }}
                </router-link>
              </li>
              <li><a href="#">Image Cropping</a></li>
            </ul>
          </div>
          <div class=" col-sm-4 col-md  col-6 col">
            <h5 class="headin5_amrc col_white_amrc pt2">
              {{ $t('menu2_footer') }}
            </h5>
            <ul class="footer_ul_amrc">
              <li>
                <router-link :to="{ name: 'advertiser' }">
                  {{ $t('ads_footer') }}
                </router-link>
              </li>
              <li>
                <router-link :to="{ name: 'collaborate' }">
                  {{ $t("collaborate_footer") }}
                </router-link>
              </li>
              <li>
                <router-link :to="{ name: 'advertiser' }">
                  {{ $t("solicitation_footer") }}
                </router-link>
              </li>
              <li>
                <router-link :to="{'name':'policy'}">
                  {{ $t('privacy_footer') }}
                </router-link>
              </li>
              <li>
                <router-link :to="{'name':'term-condition'}">
                  {{ $t('terms_footer') }}
                </router-link>
              </li>
              <li><a href="#">Image Cropping</a></li>
            </ul>
          </div>

          <div class=" col-sm-4 col-md  col-12 col">
            <h5 class="headin5_amrc col_white_amrc pt2">
              {{ $t('menu3_footer') }}
            </h5>

            <ul class="footer_ul2_amrc">
              <li><a href="https://www.facebook.com/outroquarto/" target="_blank"><i class="mdi mdi-facebook-box fleft padding-right" /> </a><p>{{ $t('facebook_footer') }} <a href="https://www.facebook.com/outroquarto/" target="_blank">www.facebook.com/outroquarto/</a></p></li>
              <li><a href="#"><i class="mdi mdi-twitter-box fleft padding-right" /> </a><p>{{ $t('twitter_footer') }} <a href="#"> www.outroquarto.com/</a></p></li>
              <li><a href="https://www.instagram.com/outroquarto/" target="_blank"><i class="mdi mdi-instagram fleft padding-right" /> </a><p>{{ $t('instagram_footer') }}<a href="https://www.instagram.com/outroquarto/" target="_blank">www.instagram.com/outroquarto/</a></p></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="container">
        <ul class="foote_bottom_ul_amrc">
          <li><a href="#">Home</a></li>
          <li><a href="#">{{ $t('menu1_footer') }}</a></li>
          <li><a href="#">{{ $t('services') }}</a></li>
          <li><a href="#">{{ $t('cooperate') }}</a></li>
          <li><a href="#">{{ $t('announce') }}</a></li>
          <li><a href="#">{{ $t('menu4_footer') }}</a></li>
        </ul>
        <!--foote_bottom_ul_amrc ends here-->
        <p class="text-center">
          Copyright @2020 | Designed With by <strong> <em>OutroQuarto</em></strong>
        </p>
      </div>
    </footer>
  </div>
</template>
<script>
export default {
  // eslint-disable-next-line vue/component-definition-name-casing
  name: 'footer_name'
}
</script>

<style lang="scss">
    .footer{ width:100%; background-color:rgba(14, 18, 20, 0.925); min-height:250px; padding:10px 0px 25px 0px ; }
    /*footer*/
    .col_white_amrc { color:#FF5859;}
    /* footer {width:100%; background-color:#263238; min-height:250px; padding:10px 0px 25px 0px ;} */
    .pt2 { padding-top:40px ; margin-bottom:20px ;}
    footer p { font-size:13px; color:#CCC; padding-bottom:0px; margin-bottom:8px;}
    .mb10 { padding-bottom:15px ;}
    .footer_ul_amrc { margin:0px ; list-style-type:none ; font-size:14px; padding:0px 0px 10px 0px ; }
    .footer_ul_amrc li {padding:0px 0px 5px 0px;}
    .footer_ul_amrc li a{ color:#CCC;}
    .footer_ul_amrc li a:hover{ color:#fff; text-decoration:none;}
    .fleft { float:left;}
    .padding-right { padding-right:10px; }

    .footer_ul2_amrc {margin:0px; list-style-type:none; padding:0px;}
    .footer_ul2_amrc li p { display:table; }
    .footer_ul2_amrc li a:hover { text-decoration:none;}
    .footer_ul2_amrc li i { margin-top:5px;}

    .bottom_border { border-bottom:1px solid #323f45; padding-bottom:20px;}
    .foote_bottom_ul_amrc {
        list-style-type:none;
        padding:0px;
        display:table;
        margin-top: 10px;
        margin-right: auto;
        margin-bottom: 10px;
        margin-left: auto;
    }
    .foote_bottom_ul_amrc li { display:inline;}
    .foote_bottom_ul_amrc li a { color:#999; margin:0 12px;}

    .social_footer_ul { display:table; margin:15px auto 0 auto; list-style-type:none;  }
    .social_footer_ul li { padding-left:20px; padding-top:10px; float:left; }
    .social_footer_ul li a { color:#CCC; border:1px solid #CCC; padding:8px;border-radius:50%;}
    .social_footer_ul li i {  width:20px; height:20px; text-align:center;}
</style>
