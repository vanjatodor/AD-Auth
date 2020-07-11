import Vue from "vue";
import Router from "vue-router";
import login from "./views/login.vue"
import index from './views/index.vue'
import dashboard from './views/dashboard.vue'

Vue.use(Router);

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'index',
      component: index,
      meta: { requiresAuth: true }

    },
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard,

    },
  ]
})

router.beforeEach((to, from, next) => {
      const loggedIn = localStorage.getItem('user')
      if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next('dashboard')
      }
      next()
    })

export default router
