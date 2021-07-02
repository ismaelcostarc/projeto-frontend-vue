import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginCustomer from '../views/LoginCustomer.vue';
import CPFChecking from '../views/CPFChecking.vue';
import SignUpStep1 from '../views/SignUpStep1.vue';
import SignUpStep2 from '../views/SignUpStep2.vue';
import CustomersHome from '../views/CustomersHome.vue';
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
  },
  {
    path: '/sign-up-step-2',
    name: 'SignUpStep2',
    component: SignUpStep2,
    meta: {
      requiresAuth: false,
    },
  },
  {
    path: '/customers/home',
    name: 'CustomersHome',
    component: CustomersHome,
    meta: {
      requiresAuth: true,
    },
  },
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
