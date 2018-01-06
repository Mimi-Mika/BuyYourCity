<template>
  <div>
    <!-- Menu sur la gauche -->
    <v-navigation-drawer
      fixed
      dark
      class="grey darken-3"
      :mini-variant="miniVariant"
      :clipped="clipped"
      v-model="drawer"
      app
    >
      <left-drawer></left-drawer>
    </v-navigation-drawer>

    <!-- Barre de menu en haut au milieu -->
    <v-toolbar fixed app :clipped-left="clipped" dark color="cyan">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title v-text="title"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip bottom v-if="isHome">
        <v-btn icon slot="activator">
        <v-icon>location_on</v-icon>
      </v-btn>
        <span>Localisation activé</span>
      </v-tooltip>
      <v-tooltip bottom v-if="isHome && geoLocEnable">
        <v-btn icon slot="activator" @click="centerPos">
          <v-icon>gps_fixed</v-icon>
        </v-btn>
        <span>Recentrer la carte</span>
      </v-tooltip>

      <div class="text-xs-center">
        <v-menu offset-y>
          <v-chip flat slot="activator" color="transparent" text-color="white">
            <v-avatar :tile="tile" :size="avatarSize" class="grey lighten-4">
              <img :src="imageUser" alt="avatar">
            </v-avatar>
            <strong>{{user.name}}</strong>
          </v-chip>
          <v-list>
            <v-list-tile @click="goAccount">
              <v-list-tile-title>Mon compte</v-list-tile-title>
            </v-list-tile>
          </v-list>
          <v-list>
            <v-list-tile @click="logOut">
              <v-list-tile-title>Déconnexion</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
      </div>
    </v-toolbar>

    <!-- Reste de l'application -->
    <v-content>
      <router-view></router-view>
    </v-content>

    <!-- Pied de page -->
    <!--<v-footer app absolute color="cyan">-->
      <!--<v-spacer></v-spacer>-->
      <!--<div>© {{ new Date().getFullYear() }}</div>-->
    <!--</v-footer>-->
  </div>
</template>
<script>
  import Vuex from 'vuex'
  import LeftDrawer from './navigation/LeftDrawer'
  export default {
    name: 'frame',
    components: {
      LeftDrawer
    },
    methods: {
      goAccount: function () {
        this.$router.push({
          path: '/account'
        })
      },
      logOut: function () {
        this.$auth.logout({
          makeRequest: false,
          redirect: '/login'
        })
      },
      centerPos: function(){
        this.$store.dispatch('centerPress')
      }
    },
    data () {
      return {
        user: this.$auth.user(),
        clipped: false,
        drawer: true,
        miniVariant: false,
        slider: 56,
        tile: false,
        imageUser: 'http://www.api.buyyourcity.ovh/user/' + this.$auth.user().id + '/image'
      }
    },
    computed:{
      ...Vuex.mapGetters(['geoLocEnable']),
      title(){
        return this.$route.name
      },
      isHome(){
        return this.title === "Accueil"
      },
      avatarSize () {
        return `${this.slider}px`
      }
    }
  }
</script>
