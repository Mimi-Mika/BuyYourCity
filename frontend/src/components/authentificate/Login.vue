<template>
<div>
  <v-card class="blue-grey-3 elevation-0 pa-2">
    <v-form v-on:submit.prevent="logIn()">
      <v-card-text class="pb-0 pt-0">
        <v-container fluid class="pb-0">
          <v-layout row class="pb-3">
            <v-flex xs12>
              <v-alert color="error" icon="warning" v-model="alertLogIn.length > 0">
                {{ alertLogIn }}
              </v-alert>
              <v-alert color="info" icon="info" v-model="alertPasswordChange">
                Pour finaliser l'enregistrement, veuillez consulter vos emails.
              </v-alert>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
              name="email" type="email" color="teal" prepend-icon="mail"
              label="Email" v-model="logInCredentials.email"
              :error-messages="emailErrors" @blur="$v.logInCredentials.email.$touch()"
              required>
            </v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
              name="password" type="password" color="teal" prepend-icon="lock"
              label="Password" v-model="logInCredentials.password"
              :error-messages="passwordErrors" @blur="$v.logInCredentials.password.$touch()" @input="$v.logInCredentials.password.$touch()"
              required></v-text-field>
            </v-flex>
          </v-layout>
          <v-layout row wrap class="pa-2">
            <v-flex>
              <v-switch :label="rememberMe" v-model="rememberMe" label="Se souvenir de moi" color="teal"></v-switch>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-container fluid>
          <v-layout row>
            <v-flex xs12 sm8 offset-sm2 md6 offset-md3 lg4 offset-lg4>
              <v-btn color="light-blue" dark block type="submit">
                Se connecter
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

import { validationMixin } from 'vuelidate'
import { required, minLength, email } from 'vuelidate/lib/validators'

export default {
  name: 'login',
  props: ['alertPasswordChange'],
  data() {
    return {
      logInCredentials: {
        email: null,
        password: null
      },
      rememberMe: false,
      fetchUser: false,
      alertLogIn: "",
      errorLogIn: null,
      forgotDialog: false
    }
  },
  methods: {
    logIn: function() {
      this.$v.$touch() // Check inputs in the form
      this.alertLogIn = ""

      let redirect = this.$auth.redirect()
      this.$auth.login({
        body: this.logInCredentials,
        rememberMe: this.rememberMe,
        redirect: {
          name: redirect ? redirect.from.path : 'Accueil'
        },
        fetchUser: this.fetchUser,
        success(res) {
          this.$auth.token(null, "ugihjfkldjh")
          this.$auth.user(res.body.data)
        },
        error(res) {
          this.alertLogIn = "Email ou mot de passe invalide"
        }
      })
    }
  },
  // VUELIDATE
  mixins: [validationMixin],
  validations: {
    logInCredentials : {
      email : { required, email },
      password : { required, minLength: minLength(6) }
    }
  },
  computed: {
    emailErrors () {
        const errors = []
        if (!this.$v.logInCredentials.email.$dirty) return errors
        !this.$v.logInCredentials.email.email && errors.push("Email invalide")
        !this.$v.logInCredentials.email.required && errors.push("Email obligatoire")
        return errors
      },
    passwordErrors () {
        const errors = []
        if (!this.$v.logInCredentials.password.$dirty) return errors
        !this.$v.logInCredentials.password.minLength && errors.push("Mot de passe ")
        !this.$v.logInCredentials.password.required && errors.push("Mot de passe obligatoire")
        return errors
      }
  }
}
</script>
