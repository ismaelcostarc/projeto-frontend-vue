import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

//No estado os valores são armazenados no formato em que estão sendo utilizados na aplicação,
//eles serão formatados somente antes de serem enviados para a API
export default new Vuex.Store({
  state: {
    authenticatedUser: {
      token: '',
      profile: 0
    },
    newCustomer: {
      cpf: "",
      password: "",
      name: "",
      email: "",
      birthday: "",
      phone: "",
      cep: null,
      state: null,
      city: null
    },
  },
  mutations: {
    setToken(state, newToken) {
      state.authenticatedUser.token = newToken;
    },
    setProfile(state, profile) {
      state.authenticatedUser.profile = profile;
    },
    setCPF(state, newCPF) {
      state.newCustomer.cpf = newCPF;
    },
    setPassword(state, newPassword) {
      state.newCustomer.password = newPassword;
    },
    setName(state, newName) {
      state.newCustomer.name = newName;
    },
    setEmail(state, newEmail) {
      state.newCustomer.email = newEmail;
    },
    setBirthday(state, newBirthday) {
      state.newCustomer.birthday = newBirthday;
    },
    setPhone(state, newPhone) {
      state.newCustomer.phone = newPhone;
    },
    setCEP(state, newCEP) {
      state.newCustomer.cep = newCEP;
    },
    setState(state, newState) {
      state.newCustomer.state = newState;
    },
    setCity(state, newCity) {
      state.newCustomer.city = newCity;
    },
  },
  actions: {
  },
  modules: {
  }
})
