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
    name: 'settingPlaces',
    components: {
      Place
    },
    data () {
      return {
       places: []
      }
    },

    beforeMount(){
      this.$http.get('place')
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
