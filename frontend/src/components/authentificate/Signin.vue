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
                :rules="[rules.name]"
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
                :rules="[rules.email]"
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
                hint="Le mot de passe doit posséder au moins 8 caratères."
                min="8"
                :rules="[rules.password]"
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
                :rules="[rules.password_confirmation]"
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

  <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
    <v-icon>warning</v-icon> &nbsp;
    Impossible de créer un compte, réessayer plus tard.
    <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
  </v-snackbar>
</div>
</template>

<script>
  export default {
    name: 'signin',
    data () {
      return {
        dialog: false,
        snackbarKO: false,
        signInCredentials: {
          name: null,
          email: null,
          password: null,
          password_confirmation: null
        },
        alertSignIn: '',
        alertSignInDisplay: false,
        errorSignIn: null,
        rules: {
          // required: (value) => value == null || !!value || this.$t('message.login.required'),
          name: (value) => {
            const pattern = /^([a-zA-Z0-9]|(-|_)){3,20}$/
            if (value == null || !pattern.test(value)) {
              this.errorSignIn = true
            } else {
              this.errorSignIn = false
            }
            return value == null || pattern.test(value) ||'Nom utilisateur invalide'
          },
          email: (value) => {
            const pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

            if (value == null || !pattern.test(value)) {
              this.errorSignIn = true
            } else {
              this.errorSignIn = false
            }
            return value == null || pattern.test(value) || 'Adresse mail invalide'
          },
          password: (value) => {
            const pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/

            if (value == null || !pattern.test(value)) {
              this.errorSignIn = true
            } else {
              this.errorSignIn = false
            }
            return value == null || pattern.test(value) || 'Mot de passe invalide'
          },
          password_confirmation: (value) => {
            return value == null || value === this.signInCredentials.password || 'Les mots de passe saisie ne sont pas identique'
          }
        }
      }
    },
    methods: {
      signIn: function () {
        if (this.errorSignIn) {
          return
        }
        this.alertSignIn = ''
        this.alertSignInDisplay = false
        this.$http.post('register', this.signInCredentials)
        .then(response => {
          this.data = response.body
          this.$emit('redirectToConnect') // Redirect to connect and show an alert for email
        },
        error => {
          if (error) {
            this.alertSignIn = "Erreur pendant l'enregistrement"
            this.alertSignInDisplay = true
          }
        }).catch(err => {
          this.snackbarKO = true;
        })
      }
    }
  }
</script>
