import Router from 'vue-router'
import Home from './views/home.vue'
import About from './views/about.vue'
import Tutorial from './views/tutorial.vue'
import Practice from './views/practice.vue'
import Timeattack5 from './views/timeattack5.vue'
import Result from './views/result.vue'
import Mypage from './views/mypage.vue'
import Report from './views/report.vue'


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
      path: '/practice/:id',
      name: 'practice',
      component: Practice
    },
    {
      path: '/timeattack5/:id',
      name: 'timeattack5',
      component: Timeattack5
    },
    {
      path: '/result',
      name: 'result',
      component: Result
    },
    {
      path: '/mypage',
      name: 'mypage',
      component: Mypage
    },
    {
      path: '/report',
      name: 'report',
      component: Report
    },
  ]
});