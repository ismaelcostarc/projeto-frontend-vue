import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import { VueMaskFilter } from 'v-mask'
import VueMask from 'v-mask'

import Toasted from 'vue-toasted'

Vue.config.productionTip = false

Vue.filter('VMask', VueMaskFilter)
Vue.use(VueMask);
Vue.use(Toasted)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
