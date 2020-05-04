import Vue from 'vue'
import App from "./App";
import router from "./router/index";
import store from './store/index'
import './permission'
const main = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
