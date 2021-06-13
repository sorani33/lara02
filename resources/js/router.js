import Router from 'vue-router'
import Home from './views/home.vue'
import About from './views/about.vue'
import Tutorial from './views/tutorial.vue'
import Practice from './views/practice.vue'


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
    {
      path: '/tutorial',
      name: 'tutorial',
      component: Tutorial
    },
    {
      path: '/practice',
      name: 'practice',
      component: Practice
    },
  ]
});