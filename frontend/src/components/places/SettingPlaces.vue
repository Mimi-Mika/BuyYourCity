<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
        <place v-for="place in places" :key="place.id" :place="place"></place>
      <v-fab-transition>
        <v-btn
          color="light-blue"
          dark
          fab
          fixed
          bottom
          right
          v-model="fab"
          @click=""
        >
          <v-icon>add</v-icon>
          <v-icon>close</v-icon>
        </v-btn>
      </v-fab-transition>
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
