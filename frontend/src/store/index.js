import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    newCustomer: {
      cpf: ""
    }
  },
  mutations: {
    setCPF(state, newCPF) {
      state.newCustomer.cpf = newCPF;
    }
  },
  actions: {
  },
  modules: {
  }
})
