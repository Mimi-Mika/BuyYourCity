<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <place v-for="place in places" :key="place.id" :place="place"></place>
      <v-alert outline color="info" icon="info" :value="true" v-if="places === null">
        Aucun lieu de trouvé !
      </v-alert>
      <v-fab-transition>
        <v-btn
          color="light-blue"
          dark
          fab
          fixed
          bottom
          right
          @click=""
        >
          <v-icon>add</v-icon>
          <v-icon>close</v-icon>
        </v-btn>
      </v-fab-transition>

      <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
        <v-icon>warning</v-icon> &nbsp;
        Une erreur interne est survenue !
        <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
      </v-snackbar>
    </v-layout>
  </v-container>
</template>


<script>
  import Place from './Place'

  export default {
    name: 'settingPlaces',
    components: {
      Place
    },
    data () {
      return {
        places: [],
        snackbarKO: false
      }
    },
    beforeMount(){
      this.$http.get('place')
        .then(res => {
          this.places = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
          console.log("error");
          console.log(err);
        });
    }
  }
</script>
