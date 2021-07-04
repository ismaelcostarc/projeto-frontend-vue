import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginCustomer from '../views/LoginCustomer.vue';
import CPFChecking from '../views/CPFChecking.vue';
import SignUpStep1 from '../views/SignUpStep1.vue';
import SignUpStep2 from '../views/SignUpStep2.vue';
import SchedulingsList from '../views/SchedulingsList.vue';
import Schedule from '../views/Schedule.vue';
import Profile from '../views/Profile.vue';
import EditProfile from '../views/EditProfile.vue';
import PageNotFound from '../views/PageNotFound.vue';
import store from '../store/index.js';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'LoginCustomer',
    component: LoginCustomer,
    meta: {
      requiresAuth: false,
    },
    beforeEnter(to, from, next) {
      store.commit('setToken', '');
      store.commit('setProfile', 0);
      next();
    }
  },
  {
    path: '/cpf-checking',
    name: 'CPFChecking',
    component: CPFChecking,
    meta: {
      requiresAuth: false,
    },
  },
  {
    path: '/sign-up-step-1',
    name: 'SignUpStep1',
    component: SignUpStep1,
    meta: {
      requiresAuth: false,
    },
    beforeEnter(to, from, next) {
      if (from.name !== 'CPFChecking' && from.name !== 'SignUpStep2') {
        next({ name: 'LoginCustomer' });
      } else {
        next();
      }
    },
  },
  {
    path: '/sign-up-step-2',
    name: 'SignUpStep2',
    component: SignUpStep2,
    meta: {
      requiresAuth: false,
    },
    beforeEnter(to, from, next) {
      if (from.name !== 'SignUpStep1') {
        next({ name: 'LoginCustomer' });
      } else {
        next();
      }
    },
  },
  {
    path: '/schedulings/list',
    name: 'SchedulingsList',
    component: SchedulingsList,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/customer/profile',
    name: 'Profile',
    component: Profile,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/customer/profile/edit',
    name: 'EditProfile',
    component: EditProfile,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/schedule',
    name: 'Schedule',
    component: Schedule,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '*',
    name: 'PageNotFound',
    component: PageNotFound,
    meta: {
      requiresAuth: false,
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

function isAuthenticated() {
  if (!store.state.authenticatedUser.token)
    return false;
  return true;
}

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (isAuthenticated()) {
      next()
      return
    }
    next({ name: 'LoginCustomer' })
  }
  next()
})

export default router
