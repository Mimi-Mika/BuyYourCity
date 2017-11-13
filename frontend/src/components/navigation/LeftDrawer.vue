<template>
  <v-list>
    <v-list-tile>
      <v-list-tile-action>
        <v-btn icon v-on:click.native.stop="goHome">
          <v-icon>bubble_chart</v-icon>
        </v-btn>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Home</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
    <v-list-tile>
      <v-list-tile-action>
        <v-btn icon v-on:click.native.stop="goHome2">
          <v-icon>add</v-icon>
        </v-btn>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Home 2</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
  </v-list>
</template>
<script>
  export default {
    name:'LeftDrawer',
    methods:{
      goHome : function(){

        this.$router.push({
          path: '/home'
        })
      },
      goHome2 : function(){
        this.$router.push({
          path: '/home2etcequetuveux'
        })
      }
    }
  }
</script>
