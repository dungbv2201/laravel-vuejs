import vue from 'vue'
import vuex from 'vuex'

import user from './modules/user.js'

vue.use(vuex)
const store = new vuex.Store({
    modules: {user}
})

export default store
