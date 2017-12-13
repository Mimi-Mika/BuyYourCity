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
      <v-btn color="red darken-1" flat @click.native="closeRemovePlaceDialog()">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click.native="dialogRemove = false" @Click="">Accepter</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogDeletePlace',
    props: ['place'],
    data() {
      return {
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
      }
    },
    methods:{
      closeRemovePlaceDialog: function () {
        this.$emit('closeRemovePlaceDialog')
      }
    }
  }
</script>
