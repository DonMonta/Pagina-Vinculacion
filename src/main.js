import { createApp } from 'vue'
import Vue from 'vue';
import App from './App.vue'
import router from './router'
import store from './store'
import '@fortawesome/fontawesome-free/css/all.min.css'
import "owl.carousel/dist/assets/owl.carousel.css"; 
import "owl.carousel/dist/assets/owl.theme.default.css";

import '@/assets/styles/css/bootstrap.min.css'



import 'waypoints/lib/jquery.waypoints.js';
import '@/assets/lib/animate/animate.min.css'
import '@/assets/lib/lightbox/css/lightbox.min.css'
import '@/assets/lib/owlcarousel/assets/owl.carousel.min.css'
import '@/assets/lib/owlcarousel/owl.carousel.min.js'
import '@/assets/lib/wow/wow.min.js'
import '@/assets/lib/easing/easing.min.js'
import '@/assets/plugins/chart.min.js'
import '@/assets/lib/counterup/counterup.min.js'
import '@/assets/plugins/feather.min.js'
createApp(App).use(store).use(router).mount('#app')

import 'bootstrap/dist/js/bootstrap'


/*import $ from 'jquery';
window.$ = $;
window.jQuery = $;*/
