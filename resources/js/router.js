import Router from 'vue-router'
import Home from './views/home.vue'
import About from './views/about.vue'


export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
  ]
});