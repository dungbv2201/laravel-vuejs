import request from '../utils/request';


export function loginApi(data) {
    return request({
        url: 'login',
        method: 'post',
        data
    })
}

export function getUserInfo() {
    return request({
        url: `info`,
        method: 'get'
    })
}

export function getListUsers(page) {
    return request({
        url: `/users?page=${page}`,
        method: 'get'
    })
}

export function logoutApi() {
    return request({
        url: `logout`,
        method: 'post'
    })
}

export function deleteUserApi(data) {
    return request({
        url: `users/delete`,
        method: 'delete',
        data
    })
}
