import Vue from 'vue'
import Router from 'vue-router'
import Frame from '@/components/Frame'
import Home from '@/components/home/Home'
import SettingPlaces from '@/components/places/SettingPlaces'
import PlacesUser from '@/components/places/PlacesUser'
import Statistical from '@/components/setting/Statistical'
import SettingUsers from '@/components/users/SettingUsers'
import UserInformation from '@/components/users/UserInformation'
import UserRanking from '@/components/users/UserRanking'
import Authentication from '@/components/authentificate/Authentificate'

Vue.use(Router)

export default new Router({
  routes: [{
    path: '/',
    redirect: '/home',
    name: 'Frame',
    component: Frame,
    meta: {auth: true},
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
      component: UserRanking
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
    }]
  },
  {
    path: '/login',
    name: 'Authentication',
    component: Authentication,
    meta: {auth: false}
  },
  // Default path, avoid 404
  {
    path: '*',
    redirect: '/home'
  }]
})

