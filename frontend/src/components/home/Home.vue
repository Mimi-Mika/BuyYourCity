<template>
  <v-container>
    <gmap-map
      :center="center"
      :zoom="15"
      style="width: 100%; height: 100%; position: absolute; left:0; top:0"
    >
      <gmap-marker
        :position="center"
        :clickable="false"
        :draggable="false"
        icon="https://maps.google.com/mapfiles/kml/pal4/icon25.png"
      ></gmap-marker>
      <gmap-marker
        v-for="marker in markers"
        :key="marker.id"
        :position="marker.position"
        :clickable="true"
        :draggable="true"
        @click="center=marker.position"
      ></gmap-marker>
      <gmap-marker
        v-for="marker in ownMarkers"
        :key="marker.id"
        :position="marker.position"
        :clickable="true"
        :draggable="true"
        @click="center=marker.position"
      ></gmap-marker>
    </gmap-map>
  </v-container>
</template>

<script>
  import Vuex from 'vuex'
  export default {
    name: 'home',
      data(){
        return {
          center: {lat: 0.0, lng: 0.0},
          markers: [],
          places: [],
          ownMarkers: [],
          ownPlaces: [],
          getMap: this.$root.mapping,
          description: '',
          latLng: {},
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
        setPlace(place){
          this.latLng = {
            lat: place.geometry.location.lat(),
            lng: place.geometry.location.lng(),
          }
        },
        centerGeoPos(){
          navigator.geolocation.getCurrentPosition(function (position) {
            let pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            this.center.lat = pos.lat;
            this.center.lng = pos.lng;
            this.geocodeLatLng(new google.maps.Geocoder, pos, google.maps.InfoWindow);
          }.bind(this));
        },
        geocodeLatLng(geocoder, map, infowindow){
          geocoder.geocode({'location':this.center}, function(results, status){
            console.log(results, status);
          });
        },
        filterPlaces(){
          this.countReturn++
          if(this.countReturn == 2){
            let that = this
            that.places = that._.differenceBy(that.places, that.ownPlaces, 'id');

            //{position: {lat: res.latitude, lng: res.longitude}}
            //rempli la liste des markers
            // icon marker différent si possédé par l'utilisateur

            that._.forEach(that.places, function(place, key) {
              that.markers.push({position: {lat: place.latitude, lng: place.longitude}})
            });
            that._.forEach(that.ownPlaces, function(place, key) {
              that.ownMarkers.push({position: {lat: place.latitude, lng: place.longitude}})
            });
            console.log(that.markers)
            console.log(that.ownMarkers)
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
            console.log("error");
            console.log(err);
          });
        let userId = this.$auth.user().id
        this.$http.get('user/places/'+userId)
          .then(res => {
            this.ownPlaces = res.body
            this.filterPlaces()

          })
          .catch(err => {
            console.log("error");
            console.log(err);
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
    },
  }
</script>
