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
      <span>Souhaitez-vous vraiment vendre ce lieu ?</span><br>
      <span class="grey--text">
        Le lieu vous a coûté : <strong>{{place.pointsCost}} points</strong><br>
        Vous recuperez : <strong>{{nbSalePoints}} points</strong> à la vente
      </span>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeSalePlaceDialog">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click="salePlace" @Click="">Accepter</v-btn>
    </v-card-actions>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue lors de la vente de votre lieu !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarOK" color="success">
      <v-icon>check_circle</v-icon> &nbsp;
      Votre lieu a bien été vendu.
      Vous recuperez : <strong>{{nbSalePoints}} points</strong> !
      <v-btn flat color="white" @click.native="snackbarOK = false">Close</v-btn>
    </v-snackbar>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogSalePlace',
    props: ['place'],
    data() {
      return {
        snackbarKO: false,
        snackbarOK: false,
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
        nbSalePoints : this.place.pointsCost * 0.75 // 75% of the initial purchase price of the site.
      }
    },methods:{
      closeSalePlaceDialog : function () {
        this.$emit('closeSalePlaceDialog')
      },
      salePlace : function(){
        this.$http.post('place/' + this.place.id + '/sell', this.token)
          .then(res => {
            this.closeAdminUserDialog()
            this.snackbarOK = true;
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
