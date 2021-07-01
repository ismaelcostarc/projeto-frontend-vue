import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import CPFChecking from '../views/CPFChecking.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/cpf-checking',
    name: 'CPFChecking',
    component: CPFChecking
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
