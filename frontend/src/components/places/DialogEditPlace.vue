<template>
  <v-card>
    <v-card-text>
      <v-form>
        <v-text-field
          label="Nom du lieu"
          v-model="namePlace"
          required
        ></v-text-field>
        <v-text-field
          label="Latitude"
          v-model="latitude"
          required
        ></v-text-field>
        <v-text-field
          label="Longitude"
          v-model="longitude"
          required
        ></v-text-field>
        <v-text-field
          label="Image du lieu"
          v-model="imagePlace"
          prepend-icon="attach_file"
        ></v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeEditPlaceDialog">Annuler</v-btn>
      <v-btn color="green darken-1" flat @click="updatePlace">Valider</v-btn>
    </v-card-actions>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue lors de la vente de votre lieu !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogEditPlace',
    props: ['place'],
    data() {
      return {
        snackbarKO: false,
        latitude: this.place.latitude,
        longitude: this.place.longitude,
        namePlace: this.place.name,
        imagePlace : this.image.name,
        image: []
      }
    },methods:{
      closeEditPlaceDialog: function () {
        this.$emit('closeEditPlaceDialog')
      },
      snackbarOK: function() {
        this.$emit('snackbarOK')
      },
      updatePlace: function(){
        this.place.name = this.namePlace;
        this.place.latitude = this.latitude;
        this.place.longitude = this.longitude;
        this.$http.put('place/' + this.place.id, this.place)
          .then(res => {
            this.snackbarOK();
            this.closeEditPlaceDialog();
          })
          .catch(err => {
            this.snackbarKO = true;
            console.log("error");
            console.log(err);
          })
      }
    },
    beforeMount(){
      this.$http.get('image/' + this.place.image_id)
        .then(res => {
          this.image = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
          console.log("error");
          console.log(err);
        });
    }
  }
</script>
