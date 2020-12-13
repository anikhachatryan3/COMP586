import Vue from 'vue'
import Vuex from 'vuex'
import VueSession from 'vue-session'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

Vue.use(Vuex)
Vue.use(VueSession)

new Vue({
  render: h => h(App),
  store: store,
  router: router,
}).$mount('#app')
