
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
        return https.post('schedulings',
            scheduling,
            {
                headers: {
                    Authorization: `Bearer ${token}`

                }
            })
    },
    delete(token, id) {
        return https.delete(`schedulings/${id}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
    },
    reschedule(token, id, newSchedule) {
        return https.patch(`schedulings/${id}`,
            newSchedule, {
                headers: {
                   Authorization: `Bearer ${token}`
                }
            }
        )
    }
}
