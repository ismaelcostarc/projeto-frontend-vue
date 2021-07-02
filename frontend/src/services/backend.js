import axios from 'axios'

export const https = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL + 'api/'
})
