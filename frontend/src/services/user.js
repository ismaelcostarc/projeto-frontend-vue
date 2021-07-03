import { https } from './backend.js'

export default {
    login(cpf, password) {
        return https.post('login', {
            cpf: cpf,
            password: password,
            //O perfil de cliente é 1 e o de atendente é 2
            profile: 1
        })
    },
    logout(token) {
        return https.post('/logout', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
    },
}