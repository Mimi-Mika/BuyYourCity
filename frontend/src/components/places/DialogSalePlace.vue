<template>
  <v-card>
    <v-card-media class="white--text" height="200px" :src="imagePlace" v-if="this.place.image_id != null"></v-card-media>
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
  </v-card>
</template>

<script>
  export default {
    name: 'dialogSalePlace',
    props: ['place'],
    data() {
      return {
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
        nbSalePoints : this.place.pointsCost * 0.75 // 75% of the initial purchase price of the site.
      }
    },methods:{
      closeSalePlaceDialog : function () {
        this.$emit('closeSalePlaceDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      salePlace : function(){
        this.$http.post('place/' + this.place.id + '/sell', this.token)
          .then(res => {
            let dataSnack = {
              type : "success",
              message : "Le lieu a bien été vendu. Vous récupérez : " + this.nbSalePoints + " points."
            }
            this.displaySnackbar(dataSnack);
            this.closeSalePlaceDialog()
          })
          .catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible de vendre le lieu, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      }
    }
  }
</script>
