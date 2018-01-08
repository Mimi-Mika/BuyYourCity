<template>
  <v-card>
    <v-card-title>Modifier un lieu</v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Nom du lieu" v-model="namePlace" required></v-text-field>
        <v-text-field label="Latitude" v-model="latitude" required></v-text-field>
        <v-text-field label="Longitude" v-model="longitude" required></v-text-field>
        <v-text-field label="Valeur du lieu (en points)" v-model="pointsCost" required></v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeEditPlaceDialog">Annuler</v-btn>
      <v-btn color="green darken-1" flat @click="updatePlace">Valider</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogEditPlace',
    props: ['place'],
    data() {
      return {
        latitude: this.place.latitude,
        longitude: this.place.longitude,
        namePlace: this.place.name,
        pointsCost: this.place.pointsCost
        // image
        //imagePlace : []
      }
    },methods:{
      closeEditPlaceDialog: function () {
        this.$emit('closeEditPlaceDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      updatePlace: function(){
        this.place.name = this.namePlace;
        this.place.latitude = this.latitude;
        this.place.longitude = this.longitude;
        this.place.pointsCost = this.pointsCost;
        this.$http.put('place/' + this.place.id, this.place)
          .then(res => {
            let dataSnack = {
              type : "success",
              message : "Le lieu a bien été modifié."
            }
            this.displaySnackbar(dataSnack);
            this.closeEditPlaceDialog();
          })
          .catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible de mettre à jours les données, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      }
    },
    // beforeMount(){
    //   this.$http.get('image/' + this.place.image_id)
    //     .then(res => {
    //       this.imagePlace = res.body
    //     })
    //     .catch(err => {
    //       let dataSnack = {
    //         type : "error",
    //         message : "Impossible de charger l'image du lieu"
    //       }
    //       this.displaySnackbar(dataSnack);
    //     });
    // }
  }
</script>
