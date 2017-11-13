import Vue from 'vue'
import Router from 'vue-router'
import Frame from '@/components/Frame'
import Home from '@/components/ex1/Home'
import Home2 from '@/components/ex2/Home2'

Vue.use(Router)

export default new Router({
  routes: [{
    path: '/',
    redirect: '/home',
    name: 'Frame',
    component: Frame,
    children: [{
      path: 'home',
      name: 'Home',
      component: Home
    },
    {
      path: 'home2etcequetuveux',
      name: 'home2',
      component: Home2
    }]
  },
    // Default path, avoid 404
    {
      path: '*',
      redirect: '/home'
    }]
})

