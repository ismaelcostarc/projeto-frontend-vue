import { https } from './backend.js'

export default {
  check(cpf) {
    return https.get(`?cpf=${cpf}`)
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
