import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import VueTheMask from 'vue-the-mask'

import Toasted from 'vue-toasted'

Vue.config.productionTip = false
Vue.use(VueTheMask)
Vue.use(Toasted)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
