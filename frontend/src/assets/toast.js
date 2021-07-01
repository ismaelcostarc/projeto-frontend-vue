import Vue from 'vue';
import Toasted from 'vue-toasted';
Vue.use(Toasted);

let options = {
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
                toastObject.goAway(0);
            }

        }
    ]
};

Vue.toasted.register('toastedError', payload => payload, options);