<template>
  <v-container>
    <gmap-map :center="center" :zoom="zoom" style="width: 100%; height: 100%; position: absolute; left:0; top:0">
      <gmap-circle :center="center" :radius="50" :options="mapCenterOptions"> </gmap-circle>
      <gmap-circle ref="myCircle" :center="center" :radius="30000" :options="mapCenterOptionsPlace"> </gmap-circle>
      <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
        <v-card v-if="infoContent.place != null">
          <v-card-media class="white--text" height="200px" :src="imagePlace + infoContent.place.id + '/image'" v-if="imagePlace != null"></v-card-media>
          <v-card-title primary-title>
            <span class="headline">{{infoContent.place.name}}</span>
          </v-card-title>
          <v-card-text>
            Longitude : {{infoContent.place.longitude}}, Latitude : {{infoContent.place.latitude}} <br>
            Valeur du lieu : <b>{{infoContent.place.pointsCost}} points</b><br>

            <span v-if="infoContent.purchased && infoContent.user != null">
              <br>
              <b>Information du propriétaire</b><br>
                Nom du propriétaire : {{infoContent.user.name}} <br>
                Nombre de points du propriétaire : {{infoContent.user.pointsAvailable}}
            </span>
          </v-card-text>
          <v-card-actions>
            <v-btn flat color="blue" dark slot="activator" @click="dialogSale = true" v-if="infoContent.own">Vendre le lieu</v-btn>
            <v-btn flat color="blue" dark slot="activator"
                   @click="dialogBuy = true"
                   v-if="infoContent.available && getDistance({lat:infoContent.place.latitude, lng:infoContent.place.longitude}) <= 50">
              Acheter le lieu</v-btn>
          </v-card-actions>
        </v-card>
      </gmap-info-window>
      <gmap-marker :position="center" :clickable="false" :draggable="false" icon="https://maps.google.com/mapfiles/kml/pal4/icon25.png"></gmap-marker>
      <gmap-marker v-for="(marker, i) in markersAvailable"
                  :key="marker.id"
                  :position="marker.position"
                  :clickable="true"
                  :draggable="false"
                  icon="http://maps.google.com/mapfiles/ms/micons/green-dot.png"
                  @click="toggleInfoWindow(marker,i)"
      ></gmap-marker>
      <gmap-marker v-for="(marker, i) in ownMarkers"
                  :key="marker.id"
                  :position="marker.position"
                  :clickable="true"
                  :draggable="false"
                  icon="http://maps.google.com/mapfiles/ms/micons/ltblue-dot.png"
                  @click="toggleInfoWindow(marker,i)"
      ></gmap-marker>
      <gmap-marker v-for="(marker, i) in markerPurchased"
                   :key="marker.id"
                   :position="marker.position"
                   :clickable="true"
                   :draggable="false"
                   icon="http://maps.google.com/mapfiles/ms/micons/red-dot.png"
                   @click="toggleInfoWindow(marker,i)"
      ></gmap-marker>
    </gmap-map>


    <v-snackbar :timeout="6000" top="top" right="right" v-model="messageSnackbar" :color="snackbarData.color">
      <v-icon>{{snackbarData.icon}}</v-icon> &nbsp;
      {{snackbarData.message}}
      <v-btn flat color="white" @click.native="messageSnackbar = false">Close</v-btn>
    </v-snackbar>
    <v-dialog v-model="dialogSale" persistent v-if="infoContent.place != null">
      <dialog-sale-place :place="infoContent.place" @closeSalePlaceDialog="closeSalePlaceDialog" @refreshAll="refreshAll" @displaySnackbar="displaySnackbar" ></dialog-sale-place>
    </v-dialog>
    <v-dialog v-model="dialogBuy" persistent v-if="infoContent.place != null">
      <dialog-buy-place :place="infoContent.place" @closeBuyPlaceDialog="closeBuyPlaceDialog" @refreshAll="refreshAll" @displaySnackbar="displaySnackbar" ></dialog-buy-place>
    </v-dialog>
  </v-container>
</template>

<script>
  import Vuex from 'vuex'
  import DialogSalePlace from '../places/DialogSalePlace'
  import DialogBuyPlace from '../places/DialogBuyPlace'

  export default {
    name: 'home',
    components: {
      DialogSalePlace,
      DialogBuyPlace
    },
    data(){
      return {
        dialogSale : false,
        dialogBuy :false,
        snackbarData:{
          color : null,
          icon : null,
          message : null
        },
        messageSnackbar: false,
        center: {lat: 0.0, lng: 0.0},
        zoom: 15,
        description: '',
        countReturn:0,
        mapCenterOptions: {
          strokeColor: '#00bcd4',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#00bcd4'
        },
        mapCenterOptionsPlace: {
          strokeColor: '#bdbdbd',
          strokeOpacity: 0.4,
          strokeWeight: 2,
          fillColor: '#ffffff'
        },
        placesPurchased: [],
        placesAvailable: [],
        ownPlaces: [],
        markerPurchased:[],
        ownMarkers: [],
        markersAvailable: [],
        infoContent : {
          own : false,
          available : false,
          purchased : false,
          place : null,
          user : null
        },
        infoOptions: {
          pixelOffset: {
            width: 0,
            height: -35
          }
        },
        imagePlace: 'http://www.api.buyyourcity.ovh/place/',
        infoWindowPos: {
          lat: 0,
          lng: 0
        },
        infoWinOpen: false,
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
      closeSalePlaceDialog: function(){
        this.dialogSale = false
      },
      closeBuyPlaceDialog: function(){
        this.dialogBuy = false
      },
      refreshAll: function(){
        this.placesPurchased = []
        this.placesAvailable = []
        this.ownPlaces = []
        this.markerPurchased = []
        this.ownMarkers = []
        this.markersAvailable = []
        this.infoWinOpen = false
        this.getPlaceAvailable()
        this.getPlacePurchased()
        this.getOwnPlace()
      },
      displaySnackbar: function(dataSnack){
        if(dataSnack.type === "error"){
          this.snackbarData.icon = "warning"
          this.snackbarData.message = dataSnack.message
          this.snackbarData.color = "error"
        }
        else {
          //refresh places if success
          this.$emit('getPlaces')
          this.snackbarData.icon = "check_circle"
          this.snackbarData.message = dataSnack.message
          this.snackbarData.color = "success"
        }
        this.messageSnackbar = true
      },
      centerGeoPos(){
        navigator.geolocation.getCurrentPosition(function (position) {
          this.center.lat = position.coords.latitude;
          this.center.lng = position.coords.longitude;
          this.zoom = 15;
        }.bind(this))

        navigator.geolocation.watchPosition(
          position => {
            let newLat = parseFloat(position.coords.latitude)
            let newLng = parseFloat(position.coords.longitude)
            this.center.lat = newLat
            this.center.lng = newLng
            this.refreshAll()
          },
          err =>{
            this.snackbarData.icon = "warning"
            this.snackbarData.message = "Impossible de de recharger la position actuelle."
            this.snackbarData.color = "error"
            this.messageSnackbar = true
          },
          {enableHighAccuracy:true, maximumAge:5000,
            timeout:5000});
      },
      filterPlaces(){
        this.countReturn++
        if(this.countReturn == 2){
          this.countReturn = 0
          let that = this
          that.placesPurchased = that._.differenceBy(that.placesPurchased, that.ownPlaces, 'id');
          that._.forEach(that.placesPurchased, function(place) {
            let position = {lat: place.latitude, lng: place.longitude}
            let distance = that.getDistance(position)
            if (distance <= 30000) {
              that.markerPurchased.push({position, place, purchased: true})
              if (distance <= 50)
                that.addPointToOwner(place)
            }
          });
        }
      },
      addPointToOwner(place){
        this.$http.get('user/' + place.user_id)
          .then(res => {
            let user = res.body
            user.pointsAvailable ++
            this.$http.put('user/' + user.id, user)
              .then(res => {
                this.snackbarData.icon = "info"
                this.snackbarData.message = "Vous venez de passer dans le lieu de " + user.name +", celui-ci gagne 1 point"
                this.snackbarData.color = "info"
                this.messageSnackbar = true
              })
              .catch(err => {
                this.snackbarData.icon = "warning"
                this.snackbarData.message = "Impossible de modifier les données de l'utilisateur, réessayez plus tard."
                this.snackbarData.color = "error"
                this.messageSnackbar = true
              })
          })
          .catch(err => {
            this.snackbarData.icon = "warning"
            this.snackbarData.message = "Impossible de charger le propriétraire du lieu, réessayez plus tard !"
            this.snackbarData.color = "error"
            this.messageSnackbar = true
          });

      },
      getDistance(pos) {
        //return distance between pos and center in m
        let latLngA = new google.maps.LatLng(this.center.lat,this.center.lng);
        let latLngB = new google.maps.LatLng(pos.lat, pos.lng);
        let distance = google.maps.geometry.spherical.computeDistanceBetween(latLngA, latLngB)
        return distance
      },
      getPlaceAvailable(){
        let that = this
        this.$http.get('place/available')
          .then(res => {
            this.placesAvailable = res.body
            this._.forEach(that.placesAvailable, function(place) {
              let position = {lat: place.latitude, lng: place.longitude}
              if(place.pointsCost <= that.$auth.user().pointsAvailable && that.getDistance(position) <= 30000)
                that.markersAvailable.push({position, place, available:true})
            });
          })
          .catch(err => {
            this.snackbarData.icon = "warning"
            this.snackbarData.message = "Impossible de charger les lieux disponible, réessayez plus tard !"
            this.snackbarData.color = "error"
            this.messageSnackbar = true
          });
      },
      getPlacePurchased(){
        this.$http.get('place/purchased')
          .then(res => {
            this.placesPurchased = res.body
            this.filterPlaces()
          })
          .catch(err => {
            this.snackbarData.icon = "warning"
            this.snackbarData.message = "Impossible de charger les lieux occupés, réessayez plus tard !"
            this.snackbarData.color = "error"
            this.messageSnackbar = true
          });
      },
      getOwnPlace(){
        let that = this
        let userId = this.$auth.user().id
        this.$http.get('user/'+userId+'/places')
          .then(res => {
            this.ownPlaces = res.body
            this._.forEach(that.ownPlaces, function(place) {
              that.ownMarkers.push({position: {lat: place.latitude, lng: place.longitude}, place, own:true})
            });
            this.filterPlaces()
          })
          .catch(err => {
            this.snackbarData.icon = "warning"
            this.snackbarData.message = "Impossible de charger les lieux de l'utilisateur, réessayez plus tard !"
            this.snackbarData.color = "error"
            this.messageSnackbar = true
          });
      },
      toggleInfoWindow: function(marker, idx) {
        this.infoWindowPos = marker.position;
        this.infoContent.place = marker.place;
        this.infoContent.own = marker.own;
        this.infoContent.available = marker.available;
        this.infoContent.purchased = marker.purchased;
        if(this.infoContent.purchased){
          this.$http.get('user/' + marker.place.user_id)
            .then(res => {
              this.infoContent.user = res.body
            })
            .catch(err => {
              this.snackbarData.icon = "warning"
              this.snackbarData.message = "Impossible de charger le propriétraire du lieu, réessayez plus tard !"
              this.snackbarData.color = "error"
              this.messageSnackbar = true
            });
        }
        //check if its the same marker that was selected if yes toggle
        if (this.currentMidx == idx) {
          this.infoWinOpen = !this.infoWinOpen;
        }
        //if different marker set infowindow to open and reset current marker index
        else {
          this.infoWinOpen = true;
          this.currentMidx = idx;
        }
      }
    },
    beforeMount(){
      this.refreshAll()
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
      }
    },
  }
</script>
