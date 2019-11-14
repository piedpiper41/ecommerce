require('./bootstrap');
window.Vue = require('vue');

import App from './App'
import store from './store/index'
import router from './router/index'
import VueMeta from 'vue-meta'
// bootstrap //
Vue.use(require('bootstrap-vue'));
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// bootstrap //

// store clear
router.afterEach((to, from) => {
  store.commit('AddActive_el',false)
  store.commit('page_error',false);
});
// store clear

import Fragment from 'vue-fragment';
Vue.use(Fragment.Plugin);
Vue.use(VueMeta);
Vue.config.productionTip = false
Vue.component('spinner',require('vue-simple-spinner'));
/* eslint-disable no-new */
var app = new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
