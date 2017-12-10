// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.

import Vue from 'vue'

import Vuetify from 'vuetify'
import './stylus/main.styl'
import VueResource from 'vue-resource'
import App from './App'
import router from './router'
// import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(Vuetify)
Vue.use(VueResource)
/*Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBvWE_sIwKbWkiuJQOf8gSk9qzpO96fhfY',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
  }
})*/
Vue.config.productionTip = false

Vue.http.options.root = 'http://www.api.buyyourcity.ovh'

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})

