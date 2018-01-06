<template>
  <v-container fluid>
    <v-layout row wrap>
      <details-user-card class="elevation-5" :user="user"></details-user-card>
    </v-layout>
  </v-container>
</template>


<script>
  import DetailsUserCard from './DetailsUserCard'
  export default {
    name: 'info',
    components: {
      DetailsUserCard
    },
    data(){
      return {
        user: this.$auth.user()
      }
    }
  }
</script>
