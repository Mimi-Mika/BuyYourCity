<template>
    <v-card class="grey lighten-3">
      <v-card-title primary-title>
        <span class="headline">Changer votre avatar</span>
      </v-card-title>
      <v-card-text>
        <v-container fluid grid-list-lg>
        <v-layout row wrap>
          <v-flex xs12 sm6 md4 v-for="image in images" :key="image.id">
            <v-card  flat class="blue-grey-2 cursor-pointer" v-on:click.native="changeAvatar(image.id)">
              <v-card-media :src="'http://api.buyyourcity.ovh/image/' + image.id + '/data'" height="200px"></v-card-media>
            </v-card>
          </v-flex>
        </v-layout>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click="closeAvatarDialog">Annuler</v-btn>
      </v-card-actions>
      <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
        <v-icon>warning</v-icon> &nbsp;
        Une erreur interne est survenue lors de l'affichage !
        <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
      </v-snackbar>
    </v-card>


</template>

<script type="text/javascript">
  export default {
    name: 'changeAvatarDialog',
    props: ['user'],
    data () {
      return {
        images: [],
        snackbarKO: false,
        snackbarData:{
          color : null,
          icon : null,
          message : null
        }
      }
    },
    methods:{
      getAvatar: function(){
        this.$http.get('image/user')
          .then(res => {
            this.images = res.body
          }).catch(err => {
          this.snackbarKO = true;
        })
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      changeAvatar: function(idImage){
        this.user.image_id = idImage
        this.$http.put('user/'+this.user.id, this.user)
          .then(res => {
            let dataSnack = {
              type : "success",
              message : "L'avatar a bien été changé. Vous récupérez : " + this.nbSalePoints + " points."
            }
            this.$auth.user().image_id = idImage
            this.displaySnackbar(dataSnack);
            this.closeAvatarDialog()
          }).catch(err => {
          let dataSnack = {
            type : "error",
            message : "Impossible changer l'avatar, réessayez plus tard."
          }
          this.displaySnackbar(dataSnack);
        })
      },
      closeAvatarDialog: function () {
        this.$emit('closeAvatarDialog')
      },
    },
    beforeMount(){
      this.getAvatar()
    }
  }
</script>
