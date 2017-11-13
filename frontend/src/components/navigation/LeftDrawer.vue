<template>
  <v-list>
    <v-list-tile @click="goHome">
      <v-list-tile-action>
        <v-icon>home</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Accueil</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

    <v-list-tile @click="goMyAccount">
      <v-list-tile-action>
          <v-icon>account_circle</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Mon compte</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

    <v-list-tile @click="goSetting">
      <v-list-tile-action>
        <v-icon>settings</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Administration</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
  </v-list>
</template>
<script>
  import VContent from "vuetify/src/components/VGrid/VContent";

  export default {
    components: {VContent},
    name:'LeftDrawer',
    methods:{
      goHome : function(){

        this.$router.push({
          path: '/home'
        })
      },
      goMyAccount : function(){
        this.$router.push({
          path: '/myAccount'
        })
      },
      goSetting : function(){
        this.$router.push({
          path: '/setting'
        })
      }
    }
  }
</script>
