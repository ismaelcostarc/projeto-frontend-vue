
import { https } from './backend.js'

export default {
  check(cpf) {
    return https.get(`?cpf=${cpf}`)
  },
  login(cpf, password) {
    return https.post('login', {
      cpf: cpf,
      password: password,
      //O perfil de cliente é 1 e o de atendente é 2
      profile: 1
    })
  },
  index(token) {
    return https.get('/customers', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
  }
  /*
    list: (cpf) => {
      return https.get(`customers/searchcpf/${cpf}`)
    },
  
    create: (customer) => {
      return https.post('customer', customer, {
        headers: {
          'Content-Type': 'application/json'
        }
      })
    },
  
    createDependent: (customer) => {
      return https.post('customer', customer, {
        headers: {
          'Content-Type': 'application/json'
        }
      })
    }
    */
}
