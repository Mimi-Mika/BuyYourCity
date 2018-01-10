// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.

import Vue from 'vue'
import Vuetify from 'vuetify'
import './stylus/main.styl'
import VueResource from 'vue-resource'
import App from './App'
import router from './router'
import Vuelidate from 'vuelidate'
import * as VueGoogleMaps from 'vue2-google-maps'
import _ from 'lodash'
import VueLodash from 'vue-lodash/dist/vue-lodash.min'
import store from './store'
import VueChart from 'vue-chart-js'
import vueMoment from 'vue-moment'

Vue.use(Vuetify)
Vue.use(VueChart)
Vue.use(VueResource)
Vue.use(Vuelidate)
Vue.use(VueLodash, _)
Vue.use(vueMoment);
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBunJos5d9DBmZY-qJ6SZUAYEmlyFr9t-Y',
    libraries: 'places'
  }
})
Vue.config.productionTip = false
Vue.router = router
Vue.http.options.root = 'http://www.api.buyyourcity.ovh'
Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/vue-resource.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  rolesVar: 'type',
  tokenName: 'token',
  tokenStore: ['localStorage', 'cookie'],
  authRedirect: {path: '/login'},
  forbiddenRedirect: {path: '/403'},
  loginData: {url: 'login'},
  refreshData: {enabled: false, url: 'user/refresh', interval: 0},
  fetchData: {enabled: true, url: 'user/refresh'},
  parseUserData: function _parseUserData (data) {
    return data || {}
  }
})


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})

