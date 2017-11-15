import Vue from 'vue'
import Router from 'vue-router'
import Frame from '@/components/Frame'
import Home from '@/components/home/Home'
import Information from '@/components/account/Information'
import Places from '@/components/account/Places'
import Ranking from '@/components/account/Ranking'
import SettingPlaces from '@/components/setting/SettingPlaces'
import SettingUsers from '@/components/setting/SettingUsers'
import Statistical from '@/components/setting/Statistical'

Vue.use(Router)

export default new Router({
  routes: [{
    path: '/',
    redirect: '/home',
    name: 'Frame',
    component: Frame,
    children: [{
      path: 'home',
      name: 'Accueil',
      component: Home
    },
    {
      path: 'info',
      name: 'Mes informations',
      component: Information
    },
    {
      path: 'places',
      name: 'Places',
      component: Places
    },
    {
      path: 'ranking',
      name: 'Ranking',
      component: Ranking
    },
    {
      path: 'settingUsers',
      name: 'SettingUsers',
      component: SettingUsers
    },
    {
      path: 'settingPlaces',
      name: 'SettingPlaces',
      component: SettingPlaces
    },
    {
      path: 'statistical',
      name: 'Statistical',
      component: Statistical
    }]
  },
    // Default path, avoid 404
    {
      path: '*',
      redirect: '/home'
    }]
})

