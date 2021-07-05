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
  },
  create(customer) {
    return https.post('/customers', customer);
  },
  update(token, customer) {
    return https.patch('/customers',
      customer,
      {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
    )
  },
  delete(token) {
    return https.delete('/customers',
      {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
    )
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
