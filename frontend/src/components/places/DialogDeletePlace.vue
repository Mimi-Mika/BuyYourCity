<template>
  <v-card>
    <v-card-media
      class="white--text"
      height="200px"
      :src="imagePlace"
    ></v-card-media>
    <v-card-title primary-title>
      <span class="headline">{{place.name}}</span>
    </v-card-title>
    <v-card-text>
      <span class="title">Souhaitez-vous vraiment supprimer ce lieu ?</span><br>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeRemovePlaceDialog">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click="deletePlace">Accepter</v-btn>
    </v-card-actions>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogDeletePlace',
    props: ['place'],
    data() {
      return {
        snackbarKO: false,
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
      }
    },
    methods:{
      closeRemovePlaceDialog: function () {
        this.$emit('closeRemovePlaceDialog')
      },
      deletePlace: function(){
        this.$http.delete('place/' + this.place.id)
          .then(res => {
            this.closeBanUserDialog();
            //this.snackbarOK();
          })
          .catch(err => {
            this.snackbarKO = true;
            console.log("error");
            console.log(err);
          })
      }
    }
  }
</script>
