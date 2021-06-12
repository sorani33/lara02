import Router from 'vue-router'
import Home from './views/home.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
  ]
});