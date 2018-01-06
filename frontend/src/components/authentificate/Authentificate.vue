<template>
  <v-container fluid class="blue-grey-1">
    <v-layout row align-center>
      <v-flex xs12 sm8 offset-sm2 md6 offset-md3 lg4 offset-lg4>
        <img src="/static/logo2.png" alt="logo buy your city" width="100%" :class="marginSize">
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12 sm8 offset-sm2 md6 offset-md3 lg4 offset-lg4>
        <v-card class="elevation-2">
          <v-tabs dark grow v-model="activeTab">
            <v-tabs-bar class="light-blue">
              <v-tabs-slider class="amber darken-2"></v-tabs-slider>
              <v-tabs-item href="#login">
                Connexion
              </v-tabs-item>

              <v-tabs-item href="#signin">
                S'enregistrer
              </v-tabs-item>
            </v-tabs-bar>
            <v-tabs-items>
              <v-tabs-content id="login">
                <login :alertCheckMail="alertPasswordChange"></login>
              </v-tabs-content>
              <v-tabs-content id="signin">
                <signin @redirectToConnect="redirectToConnect"></signin>
              </v-tabs-content>
            </v-tabs-items>
          </v-tabs>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import Login from './login'
  import Signin from './Signin'

  export default {
    name: 'authentication',
    components: {
      Login,
      Signin
    },
    data () {
      return {
        error: null,
        marginSize: null,
        activeTab: 'login',
        alertPasswordChange: false
      }
    },
    methods: {
      logoMarginResize: function () {
        let windowHeight = window.innerHeight

        if (windowHeight < 730) {
          this.marginSize = 'mb-4 mt-2'
        } else if (windowHeight >= 730 && windowHeight < 850) {
          this.marginSize = 'mb-4 mt-2 pb-4 pt-2'
        } else if (windowHeight >= 850 && windowHeight < 970) {
          this.marginSize = 'mb-4 mt-3 pb-4 pt-3'
        } else if (windowHeight >= 970 && windowHeight < 1024) {
          this.marginSize = 'mb-5 mt-4 pb-5 pt-4'
        } else {
          this.marginSize = 'mb-5 mt-5 pb-5 pt-5'
        }
      },
      redirectToConnect: function () {
        this.activeTab = 'login'
        this.alertPasswordChange = true
      }
    },
    mounted () {
      this.logoMarginResize()
    }
  }
</script>
