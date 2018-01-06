<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <place v-for="place in places" :key="place.id" :place="place"></place>
    </v-layout>
    <v-alert outline color="info" icon="info" :value="true" v-if="places === null">
      Aucun lieu de trouvé !
    </v-alert>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
  import Place from './Place'
  export default {
    name: 'placesUser',
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
      let userId = this.$auth.user().id
      this.$http.get('user/'+userId+'/places')
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
