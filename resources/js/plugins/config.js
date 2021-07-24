import Vue from 'vue';

import SuiVue from 'semantic-ui-vue';

Vue.use(SuiVue);



//INPUT MASKS

// As a plugin v-mask
import VueMask from 'v-mask'
Vue.use(VueMask);


//Gate for each user
/* import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user); */

//Mask Input
/* const VueInputMask = require('vue-inputmask').default

Vue.use(VueInputMask) */


// DATATIME WITH MOMENT.JS

//Ultizamos o momento para aplicar na data criada https://momentjs.com/
import * as moment from 'moment';
import 'moment/locale/pt-br';
Vue.filter('myDate', function (createdDate) {
    return moment(createdDate).format('MMMM Do YYYY');
})
Vue.filter('MultipleLocaleSupport', function (createdDate) {
    return moment(createdDate).format('LLL');
})
Vue.filter('LL', function (createdDate) {
    return moment(createdDate).format('LL') 
})
Vue.filter('dddd', function (createdDate) {
    return moment(createdDate).format('dddd') 
}) 
Vue.filter('MonthDate', function (createdDate) {
    return moment(createdDate).format('MMMM, YYYY')
});
Vue.filter('SomeHoursAgo', function (createdDate) {
    return moment(createdDate).startOf('day').fromNow()
});

Vue.filter('ExtensoFormato', function (createdDate) {
    return moment(createdDate).format('ll')
})
Vue.filter('OnlyYear', function (createdDate) {
    return moment(createdDate).format('YYYY')
});
Vue.filter('OnlyDate', function (createdDate) {
    return moment(createdDate).format('l')
});
Vue.filter('MyTime', function (createdTime) {
    return moment(createdTime).format('LT')
});


//Pagination component

Vue.component('pagination', require('laravel-vue-pagination'));


///EDITOR TEST

// Import translations for the German language.
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );

//FILTER

//https://github.com/freearhey/vue2-filters
import Vue2Filters from 'vue2-filters'

Vue.use(Vue2Filters)

//https://www.npmjs.com/package/lodash.uniq
var uniq = require('lodash.uniq');
Vue.use(uniq);

var sortedLastIndex = require('lodash.sortedLastIndex');
Vue.use(sortedLastIndex);

// Pagination component

Vue.component('pagination', require('laravel-vue-pagination'))

// Global Variavel
const Fire = new Vue() // tambem pode ser assim window.Five = new Vue();
window.Fire = Fire

// Permission
/* import { abilitiesPlugin } from '@casl/vue';
import ability from './services/ability';

Vue.use(abilitiesPlugin, ability); */

// The computed property "fields" is already defined as a prop
/* import VeeValidate from 'vee-validate'
Vue.use(VeeValidate); */
// Esta me dar conflitos

/*  global.jQuery = require('jquery');
    var $ = global.jQuery;
    window.$ = $;

  // plugins:js
  require ("./admin-layout/vendors/base/vendor.bundle.base.js");
  // endinject
  // Plugin js for this page
  require ("./admin-layout/vendors/chart.js/Chart.min.js");
  require ("./admin-layout/vendors/datatables/jquery.dataTables.js");
  //require ("./admin-layout/vendors/datatables-bs4/dataTables.bootstrap4.js");
  // End plugin js for this page
  // inject:js
  require ("./admin-layout/js/off-canvas.js");
  require ("./admin-layout/js/hoverable-collapse.js");
  require ("./admin-layout/js/template.js");
  // endinject
  // Custom js for this page
  require ("./admin-layout/js/dashboard.js");
  require ("./admin-layout/js/data-table.js");
  require ("./admin-layout/js/jquery.dataTables.js");
  //require ("./admin-layout/js/dataTables.bootstrap4.js");
  // End custom js for this page */

  // import plugin
import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr, {
  /* OverWrite Plugin Options if you need */
  defaultTimeout: 4000,
  defaultProgressBar: true,
  defaultProgressBarValue: 0,
  defaultPosition: "toast-bottom-right",
  defaultCloseOnHover: false,
  defaultClassNames: ["animated", "zoomInUp"],
});




import Swal from 'sweetalert2'; //Settings SweerAlert

//SweetAlert
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast

// Print Component
import VueHtmlToPaper from 'vue-html-to-paper-master';

const options = {
  name: 'Invoice - OUTROQUARTO',
  specs: [
    'fullscreen=yes',
    'titlebar=yes',
    'scrollbars=yes'
  ],
  styles: [
    'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css',
    '//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css',
    '/dist/css/app.css'
  ],
  timeout: 1000, // default timeout before the print window appears
  autoClose: true, // if false, the window will not close after printing
  windowTitle: 'Invoice - OUTROQUARTO', // override the window title
}

Vue.use(VueHtmlToPaper, options)

// or, using the defaults with no stylesheet
Vue.use(VueHtmlToPaper)

import Print from 'vue-print-nb-master'
// Global instruction
Vue.use(Print)


import VueSocialSharing from 'vue-social-sharing-master'

Vue.use(VueSocialSharing)

///PARA RETIRAR AS TAGS HTML
Vue.filter('stripHTML', function (value) {
    const div = document.createElement('div')
    div.innerHTML = value
    const text = div.textContent || div.innerText || ''
    return text
});
