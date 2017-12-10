<template>
  <div>
    <v-layout column align-center>
      <img src="/static/logo-2.png" alt="BuyYourCity"/>
    </v-layout>
    <v-divider></v-divider>
    <v-list>
        <v-list-tile @click="goHome">
          <v-list-tile-action>
            <v-icon>home</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Accueil</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

      <v-list-group>
        <v-list-tile slot="item" itemid="account">
          <v-list-tile-action>
            <v-icon>account_circle</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Mon compte</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>keyboard_arrow_down</v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile itemref="account" @click="goInfo">
          <v-list-tile-content>
            <v-list-tile-title>Mes informations</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>info</v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile itemref="account" @click="goPlaces">
          <v-list-tile-content>
            <v-list-tile-title>Mes lieux</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>map</v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile itemref="account" @click="goRanking">
          <v-list-tile-content>
            <v-list-tile-title>Classement</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>trending_up</v-icon>
          </v-list-tile-action>
        </v-list-tile>
      </v-list-group>

      <v-list-group>
        <v-list-tile slot="item" itemid="setting">
          <v-list-tile-action>
            <v-icon>settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Administration</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>keyboard_arrow_down</v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile itemref="setting" @click="goSettingUsers">
          <v-list-tile-content>
            <v-list-tile-title>Gestions des utilisateurs</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>supervisor_account</v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile itemref="setting" @click="goSettingPlaces">
          <v-list-tile-content>
            <v-list-tile-title>Gestions des lieux</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>map</v-icon>
          </v-list-tile-action>
        </v-list-tile>
        <v-list-tile itemref="setting" @click="goStatistical">
          <v-list-tile-content>
            <v-list-tile-title>Statistiques</v-list-tile-title>
          </v-list-tile-content>
          <v-list-tile-action>
            <v-icon>trending_up</v-icon>
          </v-list-tile-action>
        </v-list-tile>
      </v-list-group>
    </v-list>
  </div>
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
      goInfo : function(){
        this.$router.push({
          path: '/info'
        })
      },
      goPlaces : function(){
        this.$router.push({
          path: '/placesUser'
        })
      },
      goRanking : function(){
        this.$router.push({
          path: '/ranking'
        })
      },
      goSettingPlaces : function(){
        this.$router.push({
          path: '/settingPlaces'
        })
      },
      goSettingUsers : function(){
        this.$router.push({
          path: '/settingUsers'
        })
      },
      goStatistical : function(){
        this.$router.push({
          path: '/statistical'
        })
      },
    }
  }
</script>
