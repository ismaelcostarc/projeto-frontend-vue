
import { https } from './backend.js'

export default {
    index(token) {
        return https.get('schedulings', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
    },

}
