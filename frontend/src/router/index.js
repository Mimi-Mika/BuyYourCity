import Vue from 'vue'
import Router from 'vue-router'
import Frame from '@/components/Frame'
import Home from '@/components/home/Home'
import MyAccount from '@/components/account/MyAccount'
import Setting from '@/components/setting/Setting'

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
      path: 'myAccount',
      name: 'MyAccount',
      component: MyAccount
    },
      {
        path: 'setting',
        name: 'Setting',
        component: Setting
      }]
  },
    // Default path, avoid 404
    {
      path: '*',
      redirect: '/home'
    }]
})

