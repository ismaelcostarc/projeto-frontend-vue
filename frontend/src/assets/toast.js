import Vue from 'vue'
import Toasted from 'vue-toasted'
Vue.use(Toasted)

const optionsError = {
  position: 'top-center',
  closeOnSwipe: true,
  singleton: true,
  duration: 2000,
  className: 'toast-error',
  action: [
    {
      icon: 'close',
      class: 'toast-icon',
      onClick: (e, toastObject) => {
        toastObject.goAway(0)
      }

    }
  ]
}

const optionsSuccess = {
  position: 'top-center',
  closeOnSwipe: true,
  singleton: true,
  duration: 2000,
  className: 'toast-success',
  action: [
    {
      icon: 'close',
      class: 'toast-icon',
      onClick: (e, toastObject) => {
        toastObject.goAway(0)
      }

    }
  ]
}

Vue.toasted.register('toastError', payload => payload, optionsError)
Vue.toasted.register('toastSuccess', payload => payload, optionsSuccess)
