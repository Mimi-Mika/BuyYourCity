<template>
  <v-expansion-panel>
    <v-expansion-panel-content hide-actions  class="elevation-5">
      <v-layout align-center row spacer slot="header">
        <v-flex xs1>
          <v-avatar :tile="tile" :size="avatarSize" class="grey lighten-4">
            <img :src="imageUser" alt="avatar">
          </v-avatar>
        </v-flex>
        <v-flex xs3>
          <strong>{{user.name}}</strong>
        </v-flex>
        <v-flex class="grey--text" ellipsis>{{user.pointsAvailable}} points</v-flex>
        <v-flex no-wrap>
          <v-chip outline color="primary" v-if="user.admin" disabled>Administrateur</v-chip>
          <v-chip outline color="red" v-if="user.ban" disabled>Utilisateur banni</v-chip>
        </v-flex>
        <v-list-tile-action>
          <v-icon>keyboard_arrow_down</v-icon>
        </v-list-tile-action>
      </v-layout>
      <details-user-card :user="user"></details-user-card>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>
  import DetailsUserCard from './DetailsUserCard'

  export default {
    name: 'users',
    props: ['user'],
    components :{
      DetailsUserCard
    },
    data() {
      return {
        dialog : false,
        slider: 56,
        tile: false,
        imageUser: 'https://www.api.buyyourcity.ovh/user/' + this.user.id + '/image',
      }
    },
    computed:{
      avatarSize () {
        return `${this.slider}px`
      }
    }
  }
</script>
