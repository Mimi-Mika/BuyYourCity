<template>
  <v-card>
    <v-card-title primary-title>
      <span class="headline">Gestion des droits administrateurs</span>
    </v-card-title>
    <v-card-text>
      <span class="title" v-if="!user.admin">Souhaitez-vous vraiment donner les droits administrateur à <strong>{{user.name}}</strong> ?</span>
      <span class="title" v-else>Souhaitez-vous vraiment supprimer les droits administrateur à <strong>{{user.name}}</strong> ?</span>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeAdminUserDialog">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click="updateAdmin">Accepter</v-btn>
    </v-card-actions>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarOK" color="success">
      <v-icon>check_circle</v-icon> &nbsp;
      Le changement a bien été pris en compte.
      <v-btn flat color="white" @click.native="snackbarOK = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogAdminUser',
    props: ['user'],
    data () {
      return {
        snackbarKO: false,
        snackbarOK: false
      }
    },
    methods:{
      closeAdminUserDialog: function () {
        this.$emit('closeAdminUserDialog')
      },
      updateAdmin: function(){
        this.user.admin = !this.user.admin;
        this.$http.put('user/' + this.user.id, this.user)
          .then(res => {
            this.closeAdminUserDialog()
            this.snackbarOK = true;
          })
          .catch(err => {
            this.snackbarKO = true;
            console.log("error");
            console.log(err);
          })
      }
    }
  }
</script>
