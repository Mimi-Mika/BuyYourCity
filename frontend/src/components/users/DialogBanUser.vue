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
  </v-card>
</template>

<script>
  export default {
    name: 'dialogBanUser',
    props: ['user'],
    methods:{
      closeBanUserDialog: function () {
        this.$emit('closeBanUserDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      updateBan: function(){
        this.user.ban = !this.user.ban;
        this.$http.put('user/' + this.user.id, this.user)
          .then(res => {
            this.closeBanUserDialog();
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
