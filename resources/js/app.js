import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify' // path to vuetify export
import router from "./router.js"
import store from './vuex/store'

Vue.config.productionTip = false

new Vue ({
	vuetify,
	router,
	store,
	render: h => h(App)
}).$mount("#app");
