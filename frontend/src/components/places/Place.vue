<template>
  <v-flex xs12 sm6 md4>
    <v-card class="elevation-5">
      <v-card-media
        class="white--text"
        height="200px"
        :src="imagePlace"
      ></v-card-media>
      <v-card-title primary-title>
        <span class="headline">{{place.name}}</span>
      </v-card-title>
      <v-card-text>
        <div>
          <strong>Longitude :</strong> {{place.longitude}}<br>
          <strong>Latitude :</strong> {{place.latitude}}<br>
          <strong>Valeur du lieu :</strong> {{place.pointsCost}} points
        </div>
      </v-card-text>
      <v-card-actions v-if="isSettings">
        <v-btn flat color="blue" dark slot="activator" @click="dialogEdit = true">Modifier le lieu</v-btn>
        <v-btn flat color="red" dark slot="activator" @click="dialogRemove = true">Supprimer le lieu</v-btn>
      </v-card-actions>
      <v-card-actions v-else>
        <v-btn flat color="red" dark slot="activator" @click="dialogSale = true">Vendre le lieu</v-btn>
      </v-card-actions>
    </v-card>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="messageSnackbar" :color="snackbarData.color">
      <v-icon>{{snackbarData.icon}}</v-icon> &nbsp;
      {{snackbarData.message}}
      <v-btn flat color="white" @click.native="messageSnackbar = false">Close</v-btn>
    </v-snackbar>

    <v-dialog v-model="dialogSale" persistent>
      <dialog-sale-place :place="place" @closeSalePlaceDialog="closeSalePlaceDialog" @displaySnackbar="displaySnackbar" ></dialog-sale-place>
    </v-dialog>
    <v-dialog v-model="dialogRemove" persistent>
      <dialog-delete-place :place="place" @closeRemovePlaceDialog="closeRemovePlaceDialog" @displaySnackbar="displaySnackbar" ></dialog-delete-place>
    </v-dialog>
    <v-dialog v-model="dialogEdit" persistent>
      <dialog-edit-place :place="place" @closeEditPlaceDialog="closeEditPlaceDialog" @displaySnackbar="displaySnackbar" ></dialog-edit-place>
    </v-dialog>
  </v-flex>
</template>

<script>
  import DialogDeletePlace from './DialogDeletePlace'
  import DialogEditPlace from './DialogEditPlace'
  import DialogSalePlace from './DialogSalePlace'

  export default {
    name: 'places',
    props: ['place'],
    components: {
      DialogDeletePlace,
      DialogEditPlace,
      DialogSalePlace
    },
    data() {
      return {
        imagePlace : this.place.image_id ?'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image' : null,
        dialogEdit : false,
        dialogRemove : false,
        dialogSale : false,
        afterSalesPoints: 0,
        messageSnackbar: false,
        snackbarData:{
          color : null,
          icon : null,
          message : null
        }
      }
    },
    computed:{
      title(){
        return this.$route.name
      },
      isSettings(){
        return this.title === "Gestion des lieux"
      }
    },
    methods: {
      closeRemovePlaceDialog: function(){
        this.dialogRemove = false
      },
      closeEditPlaceDialog: function(){
        this.dialogEdit = false
      },
      closeSalePlaceDialog: function(){
        this.dialogSale = false
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
      }
    }
  }
</script>
