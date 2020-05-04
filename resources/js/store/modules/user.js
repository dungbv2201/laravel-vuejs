import {loginApi, getUserInfo, logoutApi} from '../../api/user.api'
import {getToken, setToken, removeToken} from '../../utils/auth'

const user = {
    state: {
        token: getToken(),
        user: null,
        count: 0
    },
    mutations: {
        SET_TOKEN: (state, token) => {
            state.token = token
        },
        SET_USER: (state, user) => {
            state.user = user
        },
        SET_COUNT: (state) => {
            state.count++
        }
    },
    actions: {
        login({commit}, userInfo) {
            return new Promise((resolve, reject) => {
                loginApi(userInfo).then(response => {
                    commit('SET_TOKEN', response.token)
                    setToken(response.token)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        getUserInfo({commit}, userInfo) {
            return new Promise((resolve, reject) => {
                getUserInfo(userInfo).then(response => {
                    console.log('haha')
                    console.log(response)
                    commit('SET_USER', response)
                    commit('SET_COUNT')
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        logout({commit}) {
            return new Promise((resolve, reject) => {
                logoutApi().then(response => {
                    removeToken()
                    commit('SET_USER', null)
                    commit('SET_TOKEN', null)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        }
    }
}

export default user
