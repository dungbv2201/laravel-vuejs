import Vue from 'vue'
import Router from 'vue-router'
import Layout from "../components/Layout";
import Login from "../views/Login";

Vue.use(Router)

export const constantRouterMap = [
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
    }
]
export default new Router({
    mode: 'history', // require service support
    base: '/',
    routes: constantRouterMap
})
export const asyncRouterMap = [
    /** When your routing table is too long, you can split it into small modules**/
    {
        path: '/hello',
        component: Layout,
        children:
            [
                {
                    path: '',
                    component: () => import('../views/users/Index'),
                    name: 'TopPage',
                }
            ]
    },
]
