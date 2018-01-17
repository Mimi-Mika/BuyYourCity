<template>
  <v-flex>
    <v-card>
      <v-card-media
        class="white--text"
        height="200px"
        :src="imageUser"
      ></v-card-media>
      <v-card-title primary-title>
        <span class="headline">{{user.name}}</span>
      </v-card-title>
      <v-card-text>
        <span class="title">Souhaitez-vous vraiment supprimer votre compte ?</span><br>
        Vous perdrez entièrement votre progression !
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click="closeRemoveUserDialog">Annuler</v-btn>
        <v-btn color="green darken-1" flat @click="removeUser">Confirmer</v-btn>
      </v-card-actions>
    </v-card>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue lors de la suppression de votre compte !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-flex>
</template>

<script>
  export default {
    name: 'dialogDeleteUser',
    props: ['user'],
    data() {
      return {
        snackbarKO: false,
        imageUser : 'https://www.api.buyyourcity.ovh/user/'+this.user.id+'/image',
      }
    },
    methods:{
      closeRemoveUserDialog: function () {
        this.$emit('closeRemoveUserDialog')
      },
      removeUser: function () {
        this.$http.delete('user/' + this.user.id, this.user)
          .then(res => {
            this.closeRemoveUserDialog()
            this.logOut()
          })
          .catch(err => {
            this.snackbarKO = true
          })
      },
      logOut: function () {
        this.$auth.logout({
          makeRequest: false,
          redirect: '/login'
        })
      },

    }
  }
</script>
