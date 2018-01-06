<template>
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
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarOK" color="success">
      <v-icon>check_circle</v-icon> &nbsp;
      Votre compte a bien été supprimé !
      <v-btn flat color="white" @click.native="snackbarOK = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogDeleteUser',
    props: ['user'],
    data() {
      return {
        snackbarOK : false,
        imageUser : 'http://www.api.buyyourcity.ovh/user/'+this.user.id+'/image',
      }
    },
    methods:{
      closeRemoveUserDialog: function () {
        this.$emit('closeRemoveUserDialog')
      },
      removeUser: function () {

        this.closeRemoveUserDialog()
        //this.snackbarOK = true;
      }
    }
  }
</script>
