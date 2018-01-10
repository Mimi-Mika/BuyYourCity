<template>
  <v-container>
    <v-layout row wrap class="elevation-5">
      <user v-for="user in users" :key="user.id" :user="user"></user>
    </v-layout>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
  import User from './User'

  export default {
    name: 'settingUsers',
    components: {
      User
    },
    data() {
      return {
        snackbarKO : false,
        users: []
      }
    },
    beforeMount() {
      this.$http.get('user')
        .then(res => {
          this.users = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
          console.log("error");
          console.log(err);
        });
    },
  }
</script>
