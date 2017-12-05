import Vue from 'vue'
import Router from 'vue-router'
import Frame from '@/components/Frame'
import Home from '@/components/home/Home'
import Ranking from '@/components/account/Ranking'
import SettingPlaces from '@/components/places/SettingPlaces'
import PlacesUser from '@/components/places/PlacesUser'
import Statistical from '@/components/setting/Statistical'
import SettingUsers from '@/components/users/SettingUsers'
import UserAccount from '@/components/users/UserAccount'
import UserInformation from '@/components/users/UserInformation'

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
      component: UserInformation
    },
    {
      path: 'placesUser',
      name: 'Mes lieux',
      component: PlacesUser
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
     component: UserAccount
    }]
  },
  // Default path, avoid 404
  {
    path: '*',
    redirect: '/home'
  }]
})

