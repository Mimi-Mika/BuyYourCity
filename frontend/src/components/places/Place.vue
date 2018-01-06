<template>
  <v-flex xs12 sm6 md4>
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
        <div>
          <strong>Adresse :</strong> <br>
          <strong>Longitude :</strong> {{place.longitude}}<br>
          <strong>Latitude :</strong> {{place.latitude}}
        </div>
      </v-card-text>
      <v-card-actions v-if="isSettings">
        <v-btn flat color="blue" dark slot="activator" @click="dialogEdit = true">Modifier le lieu</v-btn>
        <v-btn flat color="red" dark slot="activator" @click="dialogRemove = true">Supprimer le lieu</v-btn>
      </v-card-actions>
      <v-card-actions v-else>
        <v-btn flat color="red" dark slot="activator" @click="dialogSale = true">Vendre le lieu</v-btn>
      </v-card-actions>


      <v-snackbar :timeout="6000" top="top" right="right" v-model="placeUpdateOK" color="success">
        <v-icon>check_circle</v-icon> &nbsp;
        Le lieu a bien été mit à jour !
        <v-btn flat color="white" @click.native="placeUpdateOK = false">Close</v-btn>
      </v-snackbar>

    </v-card>

    <v-dialog v-model="dialogSale" persistent>
      <dialog-sale-place :place="place" @closeSalePlaceDialog="closeSalePlaceDialog"></dialog-sale-place>
    </v-dialog>
    <v-dialog v-model="dialogRemove" persistent>
      <dialog-delete-place :place="place" @closeRemovePlaceDialog="closeRemovePlaceDialog"></dialog-delete-place>
    </v-dialog>
    <v-dialog v-model="dialogEdit" persistent>
      <dialog-edit-place :place="place" @closeEditPlaceDialog="closeEditPlaceDialog"></dialog-edit-place>
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
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
        dialogEdit : false,
        dialogRemove : false,
        dialogSale : false,
        afterSalesPoints: 0,
        placeUpdateOK: false
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
        this.placeUpdateOK = this.snackbarOK()
      },
      closeSalePlaceDialog: function(){
        this.dialogSale = false
      },
      snackbarOK: function(){
        this.placeUpdateOK = true
      }
    }
  }
</script>
