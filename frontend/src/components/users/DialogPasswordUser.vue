<template>
  <v-card>
    <v-card-title primary-title>
      <span class="headline">
        <v-icon color="blue">lock</v-icon>
        Changer de mot de passe
      </span>
    </v-card-title>
    <v-card-text>
      <v-form v-model="valid" ref="form" lazy-validation>
        <v-text-field label="Mot de passe actuel" v-model="oldPassword" required></v-text-field>
        <v-text-field label="Nouveau mot de passe" v-model="newPassword" required></v-text-field>
        <v-text-field label="Confirmation du nouveau mot de passe" v-model="confirmNewPassword" required></v-text-field>

        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click.native="closePasswordUserDialog()">Annuler</v-btn>
        <v-btn color="blue darken-1" flat @click="changePassword" :disabled="!valid">Valider</v-btn>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogPasswordUser',
    props: ['user'],
    data() {
      return {
        imageUser : 'http://www.api.buyyourcity.ovh/user/' + this.user.id + '/image',
        valid : true,
        oldPassword : this.user.password,
        newPassword : '',
        confirmNewPassword : ''
      }
    },
    methods: {
      changePassword : function ()  {
        if(!this.alertPasswordChange) {
          let user = this.$auth.user
          this.$http.put('user/password',this.user)
            .then(res => {
              this.alertPasswordChange = true
              this.closePasswordUserDialog()
            }).catch(err => {

            })
        }
      },
      closePasswordUserDialog: function () {
        this.$emit('closePasswordUserDialog')
      }
    }
  }
</script>
