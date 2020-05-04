import router from './router/index'
import store from './store/index'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import {getToken} from './utils/auth.js'
NProgress.configure({showSpinner: false})

const whiteList = [
    '/login'
]

router.beforeEach((to, from, next) => {
    NProgress.start()
    if (getToken()) {
        if (whiteList.indexOf(to.path) !== -1) {
            next({path: '/users'})
            NProgress.done()
        } else {
            if (!store.state.user.user) {
                store.dispatch('getUserInfo').then(res => {
                    next()
                    NProgress.done()
                }).catch((err) => {
                    console.log(err)
                    NProgress.done()
                    store.dispatch('logout').then(() => {
                        next({path: '/login'})
                    })
                })
            } else {
                next()
                NProgress.done()
            }
        }
    } else {
        if (whiteList.indexOf(to.path) !== -1) {
            next()
            NProgress.done()
        } else {
            next(`/login?redirect=${to.path}`)
            NProgress.done()
        }
    }
})
