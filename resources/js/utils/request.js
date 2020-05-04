import axios from 'axios'

const service = axios.create({
    baseURL: '/api/',
    timeout: 30000 * 4 // request timeout
})

// request interceptor
// service.interceptors.request.use(
//     config => {
//         // Do something before request is sent
//         // if (store.getters.token) {
//         //     config.headers['Authorization'] = 'Bearer ' + getToken()
//         // }
//         return config
//     },
//     error => {
//         // Do something with request error
//         console.log(error) // for debug
//         Promise.reject(error)
//     }
// )


service.interceptors.response.use(
    response => response.data,
    error => {
        // if (error.response.status === 403) {
        //     store.commit('SET_ROLES', [])
        // } else if (error.response.status === 401) {
        //     store.commit('SET_TOKEN', '')
        //     store.commit('SET_ROLES', [])
        //     removeToken()
        // } else if (error.response.data && typeof error.response.data.errors === 'string') {
        //     store.commit('SET_ERROR_MESSAGE', error.response.data.errors)
        // }
        return Promise.reject(error.response.data)
    }
)

export default service
