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
        users: [],
        direction: "top",
        fab: false,
        fling: false,
        hover: false,
        tabs: null,
        top: false,
        right: true,
        bottom: true,
        left: false,
        transition: 'slide-y-reverse-transition'
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
    watch: {
      top (val) {
        this.bottom = !val
      },
      right (val) {
        this.left = !val
      },
      bottom (val) {
        this.top = !val
      },
      left (val) {
        this.right = !val
      }
    }
  }
</script>
