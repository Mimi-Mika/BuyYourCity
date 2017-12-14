<template>
  <v-container>
    <v-layout row wrap>
      <user v-for="user in users" :key="user.id" :user="user"></user>
    </v-layout>
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
        users: []
      }
    },
    beforeMount() {
      this.$http.get('user')
        .then(res => {
          this.users = res.body
        })
        .catch(err => {
          console.log("error");
          console.log(err);
        });
    },
  }
</script>
