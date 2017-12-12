<template>
<div>
  <v-card class="blue-grey-3 elevation-0 pa-2">
    <v-form v-on:submit.prevent="signIn()" lazy-validation>
      <v-card-text class="pb-0 pt-0">
        <v-container fluid class="pb-0">
          <v-layout row class="pb-3">
            <v-flex xs12>
              <v-alert color="error" icon="warning" v-model="alertSignInDisplay">
                {{alertSignIn}}
              </v-alert>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
                name="name"
                type="text"
                label="Nom d'utilisateur"
                color="teal"
                prepend-icon="account_circle"
                v-model="signInCredentials.name"
                min="3"
                max="20"
                required
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
                name="email"
                type="email"
                label="Email"
                color="teal"
                prepend-icon="mail"
                v-model="signInCredentials.email"
                required
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
                name="password"
                type="password"
                label="Password"
                color="teal"
                prepend-icon="lock"
                v-model="signInCredentials.password"
                hint="At least 8 characters, one lower and one upper case"
                min="8"
                required
              ></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
                name="password_confirmation"
                type="password"
                label="Confirm password"
                color="teal"
                prepend-icon="lock"
                v-model="signInCredentials.password_confirmation"
                min="8"
                required
              ></v-text-field>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-container fluid>
          <v-layout row>
            <v-flex xs12 sm8 offset-sm2 md6 offset-md3 lg4 offset-lg4>
              <v-btn color="light-blue" dark block type="submit">
                S'enregistrer
              </v-btn>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-actions>
    </v-form>
  </v-card>
</div>
</template>

<script>
export default {
  name: 'signin',
  data () {
    return {
      dialog: false,
      signInCredentials: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      alertSignIn: '',
      alertSignInDisplay: false,
    }
  },
  methods: {
    signIn: function () {
      this.alertSignIn = ''
      this.alertSignInDisplay = false

      this.$http.post('register', this.signInCredentials)
      .then(response => {
        console.log(response.body)
        this.data = response.body
        this.$emit('redirectToConnect') // Redirect to connect and show an alert for email
        /*if (this.data.success) {
          this.$auth.token(null, this.data.token)
          this.$auth.user(this.data.user)



          this.signInCredentials.pseudo = null // Clear data
          this.signInCredentials.email = null
          this.signInCredentials.password = null
          this.signInCredentials.confirmPassword = null
        } else if (this.data.error.code) {
          this.alertSignIn = this.data.error.msg
          this.alertSignInDisplay = true
        } else {
          this.alertSignIn = this.$t('message.login.server_unavailable')
          this.alertSignInDisplay = true
        }*/
      },
      error => {
        if (error) {
          this.alertSignIn = "Erreur pendant l'enregistrement"
          this.alertSignInDisplay = true
        }
      })
    }
  }
}
</script>
