import Vue from 'vue'
import Vuex from 'vuex'

import geo from './module/Geo'
Vue.use(Vuex)
export default new Vuex.Store({
  modules: {
    geo,
  },
  strict: false
})
