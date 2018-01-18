<template>
  <v-card>
    <v-card-media class="white--text" height="200px" :src="imagePlace"></v-card-media>
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
  </v-card>
</template>

<script>
  export default {
    name: 'dialogDeletePlace',
    props: ['place'],
    data() {
      return {
        imagePlace : 'https://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
      }
    },
    methods:{
      closeRemovePlaceDialog: function () {
        this.$emit('closeRemovePlaceDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      deletePlace: function(){
        this.$http.delete('place/' + this.place.id)
          .then(res => {
            let dataSnack = {
              type : "success",
              message : "Le lieu a bien été supprimé."
            }
            this.displaySnackbar(dataSnack);
            this.closeRemovePlaceDialog();
          })
          .catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible de supprimer le lieu, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      }
    }
  }
</script>
