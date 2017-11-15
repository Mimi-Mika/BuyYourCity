<template>
  <div>
    <!-- Menu sur la gauche -->
    <v-navigation-drawer
      persistent
      :mini-variant="miniVariant"
      :clipped="clipped"
      v-model="drawer"
      dark
      class="grey darken-3"
      enable-resize-watcher
      app
    >
      <left-drawer></left-drawer>
    </v-navigation-drawer>

    <!-- Barre de menu en haut au milieu -->
    <v-toolbar fixed app :clipped-left="clipped" dark color="cyan">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title v-text="title"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip bottom>
        <v-btn icon slot="activator">
        <v-icon>location_on</v-icon>
      </v-btn>
        <span>Localisation activé</span>
      </v-tooltip>
      <v-tooltip bottom>
        <v-btn icon slot="activator">
          <v-icon>gps_fixed</v-icon>
        </v-btn>
        <span>Recentrer la carte</span>
      </v-tooltip>
    </v-toolbar>

    <!-- Reste de l'application -->
    <main>
      <v-content>
        <router-view></router-view>
      </v-content>
    </main>

    <!-- Pied de page -->
    <v-footer class="pa-3" dark color="cyan" fixed>
      <v-spacer></v-spacer>
      <div>© {{ new Date().getFullYear() }}</div>
    </v-footer>
  </div>
</template>
<script>
  import LeftDrawer from './navigation/LeftDrawer'
  export default {
    name: 'frame',
    components: {
      LeftDrawer
    },
    data () {
      return {
        clipped: false,
        drawer: true,
        miniVariant: false
      }
    },
    computed:{
      title(){
        return this.$route.name
      }
    }
  }
</script>
