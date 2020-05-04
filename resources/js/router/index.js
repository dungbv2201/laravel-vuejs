import Vue from 'vue'
import Router from 'vue-router'
import Layout from "../components/Layout";
import Login from "../views/Login";

Vue.use(Router)

export const routes = [
    {
        path: '/users',
        component: Layout,
        children: [
            {
                path: '/',
                component: () => import('../views/users/Index'),
                name: 'user-list'
            }
        ]
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '*',
        component: Login,
    }
]
export default new Router({
    mode: 'history', // require service support
    base: '/',
    routes: routes
})
