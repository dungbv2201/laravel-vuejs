import axios from 'axios'
import {getToken,removeToken} from "./auth";
import store from "../store";

const service = axios.create({
    baseURL: '/api/',
    timeout: 30000 * 4
})

service.interceptors.request.use(
    config => {
        console.log(store.getters.token)
        if (store.getters.token) {
            config.headers['Authorization'] = 'Bearer ' + getToken()
        }
        return config
    },
    error => {
        console.log(error) // for debug
        Promise.reject(error)
    }
)


service.interceptors.response.use(
    response => response.data,
    error => {
        if (error.response.status === 401) {
            store.commit('SET_TOKEN', null)
            store.commit('SET_USER', null)
            removeToken()
        }
        return Promise.reject(error.response.data)
    }
)

export default service
