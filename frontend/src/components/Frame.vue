<template>
  <div>
    <!-- Menu sur la gauche -->
    <v-navigation-drawer
      persistent
      :mini-variant="miniVariant"
      :clipped="clipped"
      v-model="drawer"
      enable-resize-watcher
      app
    >
      <left-drawer></left-drawer>
    </v-navigation-drawer>

    <!-- Barre de menu en haut au milieu -->
    <v-toolbar fixed app :clipped-left="clipped">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-btn icon @click.stop="miniVariant = !miniVariant">
        <v-icon v-html="miniVariant ? 'chevron_right' : 'chevron_left'"></v-icon>
      </v-btn>
      <v-btn icon @click.stop="clipped = !clipped">
        <v-icon>web</v-icon>
      </v-btn>
      <v-toolbar-title v-text="title"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon >
        <v-icon>person</v-icon>
      </v-btn>
    </v-toolbar>

    <!-- Reste de l'application -->
    <main>
      <v-content>
        <router-view></router-view>
      </v-content>
    </main>
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
        miniVariant: false,
        title: 'Boubinette.js'
      }
    }
  }
</script>
