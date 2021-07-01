import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

import Toasted from 'vue-toasted';
Vue.use(Toasted)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
