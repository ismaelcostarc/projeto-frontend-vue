import { https } from './backend.js'

export default {
  index(token) {
    return https.get('/attendents', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
  }
}
