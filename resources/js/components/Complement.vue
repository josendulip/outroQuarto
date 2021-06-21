<template>
   
   <div class="row">
      <div class="col-md-4">
         <sui-card class=" rounded-radius w-100">
            <sui-card-content>
               <sui-card-header>
                  <h2 is="sui-header" icon text-align="center">
                     <sui-label class="massive circular main-red ">
                        1
                     </sui-label>
                  </h2>
                  <sui-header-content  class="text-center">{{ $t('card1_head_complent') }} </sui-header-content>
               </sui-card-header>
            </sui-card-content>
            <sui-card-content>
            <sui-container text-align="justified">
               <p>{{ $t('card1_p1_complent') }}</p>
               <p>{{ $t('card1_p2_complent') }}</p>
               <p>{{ $t('card1_p3_complent') }} </p> 
               <p>{{ $t('card1_p4_complent') }}</p>
               <p>{{ $t('card1_p5_complent') }} </p>     
            </sui-container>           
            </sui-card-content>
         </sui-card>
      </div>
      <div class="col-md-4">
         <sui-card  class=" rounded-radius  w-100">
            <sui-card-content>
               <sui-card-header>
                  <h2 is="sui-header" icon text-align="center">
                     <sui-label class="massive circular main-red">
                        2
                     </sui-label>
                  </h2>
                  <sui-header-content  class="text-center">{{ $t('card2_head_complent') }} </sui-header-content>
               </sui-card-header>
            </sui-card-content>
            <sui-card-content>
            <sui-container text-align="justified">

               <p> {{ $t('card2_p1_complent') }}</p>
               <p>{{ $t('card2_p2_complent') }}</p>
               <p>{{ $t('card2_p3_complent') }} </p> 
               <p>{{ $t('card2_p4_complent') }} </p> 
               <p>{{ $t('card2_p5_complent') }} </p> 
               
                  
            </sui-container>           
            </sui-card-content>
         </sui-card>
      </div>
      <div class="col-md-4">
         <sui-card  class=" rounded-radius w-100">
            <sui-card-content>
               <sui-card-header>
                  <h2 is="sui-header" text-align="center">
                     <sui-label class="massive circular main-red">
                        3
                     </sui-label>
                  </h2>
                  <sui-header-content  class="text-center">{{ $t('card3_head_complent') }}</sui-header-content>
               </sui-card-header>
            </sui-card-content>
            <sui-card-content>
            <sui-container text-align="justified">
               <p>{{ $t('card3_p1_complent') }} </p>
               <p>{{ $t('card3_p2_complent') }} </p>
               <p>{{ $t('card3_p3_complent') }} </p>
               <p>{{ $t('card3_p4_complent') }} </p>
               <p>{{ $t('card3_p5_complent') }} </p>
               <p>{{ $t('card3_p6_complent') }} </p>
            </sui-container>           
            </sui-card-content>
         </sui-card>
      </div>
   </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
   name: "complement",
   data() {
      return {
         colors: [
         'red',
         'orange',
         'yellow',
         'olive',
         'green',
         'teal',
         'blue',
         'violet',
         'purple',
         'pink',
         'brown',
         'grey',
         'black',
         ],
      }
   },
}
</script>

<style lang="scss">
   .main-red{
      background-color:#FF3D47!important;
   }   
   .alignCenter{
      align-content: center!important;
      justify-content: center!important;
   }
   .rounded-radius{
   border-radius: 2em!important;
   }
</style>