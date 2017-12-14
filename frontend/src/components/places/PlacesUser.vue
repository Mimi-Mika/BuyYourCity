<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <place v-for="place in places" :key="place.id" :place="place"></place>
    </v-layout>
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
        places: []
      }
    },
    beforeMount(){
      let userId = this.$auth.user().id
      this.$http.get('user/'+userId+'/places')
        .then(res => {
          this.places = res.body
        })
        .catch(err => {
          console.log("error");
          console.log(err);
        });
    }
  }
</script>
