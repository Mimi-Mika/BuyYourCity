import Vue from 'vue'
import Router from 'vue-router'
import Frame from '@/components/Frame'
import Home from '@/components/home/Home'
import Information from '@/components/account/Information'
import Places from '@/components/account/Places'
import Account from '@/components/account/Account'
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
      name: 'Mes lieux',
      component: Places
    },
    {
      path: 'ranking',
      name: 'Classement',
      component: Ranking
    },
    {
      path: 'settingUsers',
      name: 'Gestion des utilisateurs',
      component: SettingUsers
    },
    {
      path: 'settingPlaces',
      name: 'Gestion des lieux',
      component: SettingPlaces
    },
    {
      path: 'statistical',
      name: 'Statistique',
      component: Statistical
    },
    {
     path: 'account',
     name: 'Mon compte',
     component: Account
    }]
  },
    // Default path, avoid 404
    {
      path: '*',
      redirect: '/home'
    }]
})

