<template>
  <v-card>
    <v-card-media class="white--text" height="200px" :src="imagePlace" v-if="this.place.image_id != null"></v-card-media>
    <v-card-title primary-title>
      <span class="headline">Modifier un lieu</span>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Nom du lieu" v-model="namePlace" required :rules="namePlaceRules"></v-text-field>
        <v-text-field label="Latitude" v-model="latitude" required :rules="latitudeRules"></v-text-field>
        <v-text-field label="Longitude" v-model="longitude" required :rules="longitudeRules"></v-text-field>
        <v-text-field label="Valeur du lieu (en points)" v-model="pointsCost" required :rules="pointsCostRules"></v-text-field>
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" v-on:vdropzone-success="getImageId"></vue-dropzone>
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
  import vue2Dropzone from 'vue2-dropzone'
  import 'vue2-dropzone/dist/vue2Dropzone.css'

  export default {
    name: 'dialogEditPlace',
    components: {
      vueDropzone: vue2Dropzone
    },
    props: ['place'],
    data() {
      return {
        latitude: this.place.latitude,
        longitude: this.place.longitude,
        namePlace: this.place.name,
        pointsCost: this.place.pointsCost,
        namePlaceRules: [
          (v) => !!v || 'Le nom du lieu est obligatoire.'
        ],
        latitudeRules: [
          (v) => !!v || 'La latitude est obligatoire.',
          (v) => /^[0-9]+[.[0-9]+]?$/.test(v) || 'Latitude invalide. Double attendu'
        ],
        longitudeRules: [
          (v) => !!v || 'La longitude est obligatoire.',
          (v) => /^[0-9]+[.[0-9]+]?$/.test(v) || 'Longitude invalide. Double attendu'
        ],
        pointsCostRules: [
          (v) => !!v || 'Le nombre de points est obligatoire.',
          (v) => /^[0-9]*$/.test(v) || 'Nombre de points invalide. Entier attendu'
        ],
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
        dropzoneOptions: {
          url: 'http://api.buyyourcity.ovh/image/upload',
          maxFilesize: 0.5,
          paramName : "image",
          acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
          maxFiles: 1,
          maxfilesexceeded: function(file) {
            this.removeAllFiles();
            this.addFile(file);
          },
          dictDefaultMessage: "<i class=\"material-icons\">file_upload</i><Br> Pour changer l'image du lieu, merci de placer votre image ici !",
        }
      }
    },methods:{
      closeEditPlaceDialog: function () {
        this.$emit('closeEditPlaceDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      getImageId: function(file, response){
        this.imageId = response.id
      },
      updatePlace: function(){
        this.place.name = this.namePlace;
        this.place.latitude = this.latitude;
        this.place.longitude = this.longitude;
        this.place.pointsCost = this.pointsCost;
        this.place.pointsGiven = Math.round(this.pointsCost * 0.75);
        this.place.image_id = this.imageId;
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
    }
  }
</script>
