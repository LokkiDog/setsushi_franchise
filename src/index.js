import './assets/js/common'

import './assets/css/main.css'
import './assets/scss/main.scss'
 
// import 'vue'
// import 'bootstrap/dist/css/bootstrap.min.css'
// import Vue from'vue'
// window.Vue = require('vue/dist/vue.js')
window.Vue = require('vue')
import store from './store'

// Plugins
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

// Vue components (for use in html)
Vue.component('example-component', require('./components/Example.vue').default)
Vue.component('modal-component', require('./components/Modal.vue').default)

// UI
Vue.component('notify-component', require('./components/UI/Notify.vue').default)

// controls
Vue.component('login-button', require('./components/UI/controls/buttons/Login.vue').default)

const app = new Vue({ 
  // data() {
  //   return {
  //     modalView: false,
  //     exampleComponent: false
  //   }
  // },
  store,
  el: '#app'
})