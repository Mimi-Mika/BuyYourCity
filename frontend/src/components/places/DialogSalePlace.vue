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
      <v-btn color="red darken-1" flat @click.native="closeRemovePlaceDialog()">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click.native="dialogRemove = false" @Click="">Accepter</v-btn>
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
    }
  }
</script>
