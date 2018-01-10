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
        <v-text-field label="Mot de passe actuel" v-model="credential.old_password"
                      :rules="old_passwordRules" required min="8" name="old_password"></v-text-field>
        <v-text-field label="Nouveau mot de passe" v-model="credential.password"
                      :rules="passwordRules" required min="8" name="password"
                      hint="Le mot de passe doit posséder au moins 8 caratères."></v-text-field>
        <v-text-field label="Confirmation du nouveau mot de passe" v-model="credential.password_confirmation"
                      :rules="password_confirmationRules" required min="8" name="password_confirmation"></v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click.native="closePasswordUserDialog">Annuler</v-btn>
        <v-btn color="blue darken-1" flat @click="changePassword" :disabled="!valid">Valider</v-btn>

    </v-card-actions>
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
        credential: {
          old_password : '',
          password : '',
          password_confirmation : ''
        },
        old_passwordRules: [
          (v) => !!v || 'Ancien mot de passe obligatoire',
          (v) => v.length >= 8 || 'Le mot de passe doit être de 8 caratères minimum'
        ],
        passwordRules: [
          (v) => !!v || 'Nouveau mot de passe obligatoire',
          (v) => v.length >= 8 || 'Le mot de passe doit être de 8 caratères minimum'
        ],
        password_confirmationRules: [
          (v) => !!v || 'Comfirmation du mot de passe obligatoire',
          (v) => v.length >= 8 || 'Le mot de passe doit être de 8 caratères minimum'
        ]
      }
    },
    methods: {
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      changePassword : function ()  {
        if(this.credential.password != this.credential.password_confirmation){
          return
        }
        this.$http.put('user/password', this.credential, this.token)
          .then(res => {
            this.alertPasswordChange = true
            let dataSnack = {
              type : "success",
              message : "La modification du mot de passe a bien été prise en compte."
            }
            this.displaySnackbar(dataSnack);
            this.closePasswordUserDialog()
          }).catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible de modifier le mot de passe, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      },
      closePasswordUserDialog: function () {
        this.$emit('closePasswordUserDialog')
      }
    }
  }
</script>
