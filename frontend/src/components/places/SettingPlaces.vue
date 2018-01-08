<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <place v-for="place in places" :key="place.id" :place="place"></place>
      <v-alert outline color="info" icon="info" :value="true" v-if="places.length === 0">
        Aucun lieu de trouvé !
      </v-alert>
      <v-fab-transition>
        <v-btn color="light-blue" dark fab fixed bottom right @click="dialogAdd = true">
          <v-icon>add</v-icon>
          <v-icon>close</v-icon>
        </v-btn>
      </v-fab-transition>

      <v-snackbar :timeout="6000" top="top" right="right" v-model="messageSnackbar" :color="snackbarData.color">
        <v-icon>{{snackbarData.icon}}</v-icon> &nbsp;
        {{snackbarData.message}}
        <v-btn flat color="white" @click.native="messageSnackbar = false">Close</v-btn>
      </v-snackbar>

      <v-dialog v-model="dialogAdd" persistent>
        <dialog-add-place @closeAddPlaceDialog="closeAddPlaceDialog" @displaySnackbar="displaySnackbar"></dialog-add-place>
      </v-dialog>
    </v-layout>
  </v-container>
</template>


<script>
  import Place from './Place'
  import DialogAddPlace from './DialogAddPlace'

  export default {
    name: 'settingPlaces',
    components: {
      Place,
      DialogAddPlace
    },
    data () {
      return {
        places: [],
        dialogAdd : false,
        messageSnackbar: false,
        snackbarData:{
          color : null,
          icon : null,
          message : null
        }
      }
    },
    beforeMount(){
      this.$http.get('place')
        .then(res => {
          this.places = res.body
        })
        .catch(err => {
          this.snackbarData.icon = "warning"
          this.snackbarData.message = "Un problème est survenu lors du chargement de la page, réessayer plus tard."
          this.snackbarData.color = "error"
          this.messageSnackbar = true
        });
    },
    methods: {
      closeAddPlaceDialog: function(){
        this.dialogAdd = false
      },
      displaySnackbar: function(dataSnack){
        if(dataSnack.type === "error"){
          this.snackbarData.icon = "warning"
          this.snackbarData.message = dataSnack.message
          this.snackbarData.color = "error"
        }
        else {
          this.snackbarData.icon = "check_circle"
          this.snackbarData.message = dataSnack.message
          this.snackbarData.color = "success"
        }
        this.messageSnackbar = true
      }
    }
  }
</script>
