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
      <!--<v-tooltip bottom v-if="isHome">
        <v-btn icon slot="activator">
        <v-icon>location_on</v-icon>
      </v-btn>
        <span>Localisation activé</span>
      </v-tooltip>
      <v-tooltip bottom v-if="isHome">
        <v-btn icon slot="activator">
          <v-icon>location_off</v-icon>
        </v-btn>
        <span>Localisation désactivé</span>
      </v-tooltip>-->
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
            <v-list-tile @click="logOut">
              <v-list-tile-title>Déconnexion <v-icon>exit_to_app</v-icon></v-list-tile-title>
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

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue lors du chargement des lieux !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
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
      logOut: function () {
        this.$http.post('logout', this.token)
          .then(res => {
            this.$auth.logout({
              makeRequest: false,
              redirect: '/login'
            })
          })
          .catch(err => {
            this.snackbarKO = true;
          })
      },
      centerPos: function(){
        this.$store.dispatch('centerPress')
      }
    },
    data () {
      return {
        user: this.$auth.user(),
        snackbarKO: false,
        clipped: false,
        drawer: true,
        miniVariant: false,
        slider: 56,
        tile: false,
        imageUser: 'http://www.api.buyyourcity.ovh/user/' + this.$auth.user().id + '/image?moment='+ this.$moment()
      }
    },
    computed:{
      ...Vuex.mapGetters(['geoLocEnable']),
      title(){
        if(this.$route.name === "Accueil") {
          return this.$route.name + " - " + this.user.pointsAvailable + " points"
        } else {
          return this.$route.name
        }
      },
      isHome(){
        return this.$route.name === "Accueil"
      },
      avatarSize () {
        return `${this.slider}px`
      },
      avatar(){
        return this.user.image_id
      }
    },
    watch: {
      avatar: function (value) {
        this.imageUser = 'http://www.api.buyyourcity.ovh/user/' + this.user.id + '/image?moment='+ this.$moment()
      },
    },
  }
</script>
