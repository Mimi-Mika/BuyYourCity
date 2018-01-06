<template>
  <v-card>
    <v-card-title primary-title>
      <span class="headline">Gestion des bannissements</span>
    </v-card-title>
    <v-card-text>
      <span class="title" v-if="!user.ban">Souhaitez-vous vraiment débannir l'utilisateur <strong>{{user.name}}</strong> ?</span>
      <span class="title" v-else>Souhaitez-vous vraiment bannir l'utilisateur <strong>{{user.name}}</strong> ?</span>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeBanUserDialog">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click="updateBan">Accepter</v-btn>
    </v-card-actions>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogBanUser',
    props: ['user'],
    data() {
      return {
        snackbarKO: false
      }
    },
    methods:{
      closeBanUserDialog: function () {
        this.$emit('closeBanUserDialog')
      },
      snackbarOK: function () {
        this.$emit('OK')
      },
      updateBan: function(){
        this.user.ban = !this.user.ban;
        this.$http.put('user/' + this.user.id, this.user)
          .then(res => {
            this.closeBanUserDialog();
            this.snackbarOK();
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
