<template>
  <v-container>
    <gmap-map :center="center" :zoom="zoom" style="width: 100%; height: 100%; position: absolute; left:0; top:0">
      <gmap-marker :position="center" :clickable="false" :draggable="false" icon="https://maps.google.com/mapfiles/kml/pal4/icon25.png"></gmap-marker>
      <gmap-marker
        v-for="marker in markers"
        :key="marker.id"
        :position="marker.position"
        :clickable="true"
        :draggable="true"
        icon="http://maps.google.com/mapfiles/ms/micons/green-dot.png"
        @click="center=marker.position"
      ></gmap-marker>
      <gmap-marker
        v-for="marker in ownMarkers"
        :key="marker.id"
        :position="marker.position"
        :clickable="true"
        :draggable="true"
        icon="http://maps.google.com/mapfiles/ms/micons/ltblue-dot.png"
        @click="center=marker.position"
      ></gmap-marker>
    </gmap-map>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue lors du chargement des lieux !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
  import Vuex from 'vuex'
  export default {
    name: 'home',
      data(){
        return {
          snackbarKO: false,
          center: {lat: 0.0, lng: 0.0},
          markers: [],
          zoom: 15,
          places: [],
          ownMarkers: [],
          ownPlaces: [],
          description: '',
          place: null,
          countReturn:0
        }
      },
      mounted(){
        if (navigator.geolocation) {
          this.centerGeoPos()
        }
      },
      methods: {
        setDescription(description){
          this.description = description
        },
        centerGeoPos(){
          navigator.geolocation.getCurrentPosition(function (position) {
            let pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            this.center.lat = pos.lat;
            this.center.lng = pos.lng;
            this.zoom = 15;
          }.bind(this));
        },
        filterPlaces(){
          this.countReturn++
          if(this.countReturn == 2){
            let that = this
            that.places = that._.differenceBy(that.places, that.ownPlaces, 'id');
            that._.forEach(that.places, function(place) {
              that.markers.push({position: {lat: place.latitude, lng: place.longitude}})
            });
            that._.forEach(that.ownPlaces, function(place) {
              that.ownMarkers.push({position: {lat: place.latitude, lng: place.longitude}})
            });
          }
        }
      },
      beforeMount(){
        this.$http.get('place')
          .then(res => {
            this.places = res.body
            this.filterPlaces()
          })
          .catch(err => {
            this.snackbarKO = true;
          });
        let userId = this.$auth.user().id
        this.$http.get('user/'+userId+'/places')
          .then(res => {
            this.ownPlaces = res.body
            this.filterPlaces()
          })
          .catch(err => {
            this.snackbarKO = true;
          });
      },
    computed:{
      ...Vuex.mapGetters(['geoLocEnable']),
      ...Vuex.mapGetters(['centerPress']),
    },
    watch: {
      centerPress: function (value) {
        if(value){
          this.centerGeoPos()
          this.$store.dispatch('finishCenter')
        }
      },
      '$route'(to, from) {
        // Call resizePreserveCenter() on all maps
        Vue.$gmapDefaultResizeBus.$emit('resize')
      }
    },
  }
</script>
