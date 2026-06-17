import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

const patchJQuery = () => {
    // 1. Corregir camelCase
    if (!$.camelCase) {
        $.camelCase = (string) => string.replace(/-([a-z])/g, (all, letter) => letter.toUpperCase());
    }

    // 2. Corregir isFunction
    if (!$.isFunction) {
        $.isFunction = (obj) => typeof obj === 'function';
    }

    // 3. Corregir type (El error actual)
    if (!$.type) {
        $.type = (obj) => {
            if (obj == null) return String(obj);
            return typeof obj === "object" || typeof obj === "function"
                ? Object.prototype.toString.call(obj).slice(8, -1).toLowerCase()
                : typeof obj;
        };
    }

    // 4. Corregir trim (A veces necesario en otros plugins)
    if (!$.trim) {
        $.trim = (text) => (text == null ? "" : String.prototype.trim.call(text));
    }
};

patchJQuery();
import 'bootstrap/dist/js/bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css'
import "owl.carousel/dist/assets/owl.carousel.css"; 
import "owl.carousel/dist/assets/owl.theme.default.css";
import '@/assets/styles/css/bootstrap.min.css'

// 4. CUARTO: Importar las librerías que dependen de jQuery
import 'waypoints/lib/jquery.waypoints.js';
import '@/assets/lib/animate/animate.min.css'
import '@/assets/lib/lightbox/css/lightbox.min.css'
import '@/assets/lib/lightbox/js/lightbox.min.js'
import '@/assets/lib/owlcarousel/assets/owl.carousel.min.css'
import '@/assets/lib/owlcarousel/owl.carousel.min.js'
import '@/assets/lib/wow/wow.min.js'
import '@/assets/lib/easing/easing.min.js'
import '@/assets/plugins/chart.min.js'
import '@/assets/lib/counterup/counterup.min.js'
import '@/assets/plugins/feather.min.js'

// 5. QUINTO: Inicializar Vue
createApp(App).use(store).use(router).mount('#app')

