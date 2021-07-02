import Vue from 'vue';
import VueRouter from 'vue-router';
import LoginCustomer from '../views/LoginCustomer.vue';
import CPFChecking from '../views/CPFChecking.vue';
import SignUpStep1 from '../views/SignUpStep1.vue';
import SignUpStep2 from '../views/SignUpStep2.vue';
import CustomersHome from '../views/CustomersHome.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'LoginCustomer',
    component: LoginCustomer
  },
  {
    path: '/cpf-checking',
    name: 'CPFChecking',
    component: CPFChecking
  },
  {
    path: '/sign-up-step-1',
    name: 'SignUpStep1',
    component: SignUpStep1
  },
  {
    path: '/sign-up-step-2',
    name: 'SignUpStep2',
    component: SignUpStep2
  },
  {
    path: '/customers/home',
    name: 'CustomersHome',
    component: CustomersHome
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
