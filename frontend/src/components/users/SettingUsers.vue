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
      /*this.$http.get('user')
        .then(res => {
          this.users = res.body
        })
        .catch(err => {
          console.log("error");
          console.log(err);
        });*/
      this.users = [{
        "id": 1,
        "name": "adminbyc",
        "email": "adminbyc@gmail.com",
        "pointsAviable": 0,
        "ban": 0,
        "validEmail": 1,
        "admin": 1,
        "created_at": null,
        "updated_at": "2017-11-15 13:06:07"
      }, {
        "id": 2,
        "name": "ben.koelpin",
        "email": "ben.koelpin@gmail.com",
        "pointsAviable": 127,
        "ban": 1,
        "validEmail": 0,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 3,
        "name": "hackett.raphael",
        "email": "hackett.raphael@gmail.com",
        "pointsAviable": 102,
        "ban": 1,
        "validEmail": 1,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 4,
        "name": "noel.turner",
        "email": "noel.turner@gmail.com",
        "pointsAviable": 460,
        "ban": 0,
        "validEmail": 0,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 5,
        "name": "emelia.sanford",
        "email": "emelia.sanford@gmail.com",
        "pointsAviable": 126,
        "ban": 0,
        "validEmail": 1,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 6,
        "name": "bode.velma",
        "email": "bode.velma@gmail.com",
        "pointsAviable": 53,
        "ban": 1,
        "validEmail": 0,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 7,
        "name": "irma.casper",
        "email": "irma.casper@gmail.com",
        "pointsAviable": 259,
        "ban": 1,
        "validEmail": 0,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 8,
        "name": "elyse18",
        "email": "elyse18@gmail.com",
        "pointsAviable": 165,
        "ban": 0,
        "validEmail": 1,
        "admin": 0,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 9,
        "name": "wiegand.audrey",
        "email": "wiegand.audrey@gmail.com",
        "pointsAviable": 117,
        "ban": 0,
        "validEmail": 1,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 10,
        "name": "hyatt.dahlia",
        "email": "hyatt.dahlia@gmail.com",
        "pointsAviable": 282,
        "ban": 1,
        "validEmail": 0,
        "admin": 1,
        "created_at": null,
        "updated_at": null
      }, {
        "id": 11,
        "name": "test",
        "email": "no.reply.byc@gmail.com",
        "pointsAviable": 10,
        "ban": 0,
        "validEmail": 1,
        "admin": 0,
        "created_at": "2017-10-27 15:33:49",
        "updated_at": "2017-10-27 15:34:17"
      }]

    },
  }
</script>
