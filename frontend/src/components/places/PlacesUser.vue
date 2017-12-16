<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <place v-for="place in places" :key="place.id" :place="place"></place>
    </v-layout>
  </v-container>
</template>


<script>
  import Place from './Place' // TODO http://api.buyyourcity.ovh/user/places/1 à changer
  export default {
    name: 'placesUser',
    components: {
      Place
    },
    data () {
      return {
        places: []
      }
    },

    beforeMount(){
      let userId = this.$auth.user().id
      this.$http.get('user/places/'+userId)
        .then(res => {
          this.places = res.body
        })
        .catch(err => {
          console.log("error");
          console.log(err);
        });
    },
  }
</script>
