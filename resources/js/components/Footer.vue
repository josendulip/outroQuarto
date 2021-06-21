<template>
    <div>
        <footer class="footer">
            <div class="container bottom_border">
                <div class="row">
                    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">{{ $t('menu1_footer') }}</h5>
                        <!--headin5_amrc-->
                        <p class="mb10">{{ $t('history_footer') }}</p>
                        <p><i class="fa fa-location-arrow"></i> {{ $t('address_footer') }} </p>
                        <p><i class="fa fa-phone"></i>  {{ $t('phone_footer') }}  </p>
                        <p><i class="fa fa fa-envelope"></i> {{ $t('email_footer') }}   </p>
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">{{ $t('menu1_footer') }}</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                        <li><a href="#">{{ $t('mission_footer') }}</a></li>
                        <li><a href="#">{{ $t('vision_footer') }}</a></li>
                        <li><a href="#">{{ $t('career_footer') }}</a></li>
                        <li><a href="#">{{ $t('privacy_footer') }}</a></li>
                        <li><a href="#">{{ $t('terms_footer') }}</a></li>
                        <li><a href="#">Image Cropping</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-6 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">{{ $t('menu2_footer') }}</h5>
                        <!--headin5_amrc-->
                        <ul class="footer_ul_amrc">
                        <li><a href="#">{{ $t('ads_footer') }}</a></li>
                        <li><a href="#">{{ $t('collaborate_footer') }}</a></li>
                        <li><a href="#">{{ $t('solicitation_footer') }}</a></li>
                        <li><a href="#">{{ $t('privacy_footer') }}</a></li>
                        <li><a href="#">{{ $t('terms_footer') }}</a></li>
                        <li><a href="#">Image Cropping</a></li>
                        </ul>
                        <!--footer_ul_amrc ends here-->
                    </div>


                    <div class=" col-sm-4 col-md  col-12 col">
                        <h5 class="headin5_amrc col_white_amrc pt2">{{ $t('menu3_footer') }}</h5>
                        <!--headin5_amrc ends here-->

                        <ul class="footer_ul2_amrc">
                        <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.outroquarto.com/</a></p></li>
                        <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.outroquarto.com/</a></p></li>
                        <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.outroquarto.com/</a></p></li>
                        </ul>
                        <!--footer_ul2_amrc ends here-->
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
                <p class="text-center">Copyright @2020 | Designed With by <a href="#">Outro Quarto</a></p>

                <ul class="social_footer_ul">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <!--social_footer_ul ends here-->
            </div>

        </footer>
    </div>
</template>
<script>
    export default {
        name: 'footer_name'
    }
</script>

<style lang="scss">
    /* .footer{ 
        position:absolute; 
        bottom:0; 
        width:100%; 
        height:100px; 
    } */


    /*footer*/
    .col_white_amrc { color:#FFF;}
    footer {width:100%; background-color:#263238; min-height:250px; padding:10px 0px 25px 0px ;}
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