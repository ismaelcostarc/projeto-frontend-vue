
import { https } from './backend.js'

export default {
    index(token) {
        return https.get('schedulings', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
    },
    create(token, scheduling) {
        return https.post('schedulings')
    },
    delete(token, id) {
        return https.delete(`schedulings/${id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
    }
}
