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
  </v-card>
</template>

<script>
  export default {
    name: 'dialogAdminUser',
    props: ['user'],
    methods:{
      closeAdminUserDialog: function () {
        this.$emit('closeAdminUserDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      updateAdmin: function(){
        this.user.admin = !this.user.admin;
        this.$http.put('user/' + this.user.id, this.user)
          .then(res => {
            this.closeAdminUserDialog()
            let dataSnack = {
              type : "success",
              message : "La modification de l'utilisateur a bien été prise en compte."
            }
            this.displaySnackbar(dataSnack);
          })
          .catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible de modifier les données de l'utilisateur, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      }
    }
  }
</script>
