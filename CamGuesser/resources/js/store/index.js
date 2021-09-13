import Vue from 'vue'
import Vuex from 'vuex'

import currentPlayer from "./modules/currentPlayer";
Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        currentPlayer
    }
})
