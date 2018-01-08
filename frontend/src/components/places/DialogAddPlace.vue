<template>
  <v-card>
    <v-card-title>Ajouter un lieu</v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Nom du lieu" v-model="namePlace" required></v-text-field>
        <v-text-field label="Latitude" v-model="lat" required></v-text-field>
        <v-text-field label="Longitude" v-model="long" required></v-text-field>
        <v-text-field label="Valeur du lieu (en points)" v-model="pointsCost" required></v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeAddPlaceDialog">Annuler</v-btn>
      <v-btn color="green darken-1" flat @click="addPlace">Valider</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogAddPlace',
    data() {
      return {
        lat: null,
        long: null,
        namePlace: null,
        pointsCost: null,
        // image
        imagePlace : null,
        image: [],
      }
    },methods:{
      closeAddPlaceDialog: function () {
        this.$emit('closeAddPlaceDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      addPlace: function(){
        // Add image
        // let uploadImage = {
        //   //image: this.$refs.uploader,
        //   type: "place"
        // }
        //
        // this.$http.post('image/upload', uploadImage)
        //   .then(res => {
        //     this.image = res.body
        //   })
        //   .catch(err => {
        //     let dataSnack = {
        //       type : "error",
        //       message : "Impossible d'ajouter l'image, réessayez plus tard."
        //     }
        //     this.displaySnackbar(dataSnack);
        //   })
        // Add place
        let place = {
          latitude: this.lat,
          longitude: this.long,
          name: this.namePlace,
          pointsCost: this.pointsCost,
          pointsGiven: this.pointsCost * 0.75,
          // image_id: this.image.id
        }
        this.$http.post('place', place)
          .then(res => {
            let dataSnack = {
              type : "success",
              message : "Le lieu a bien été ajouté."
            }
            this.displaySnackbar(dataSnack);
            this.closeAddPlaceDialog();
          })
          .catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible d'ajouter un lieu, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      }
    }
  }
</script>
