<template>
  <v-card>
    <v-card-media class="white--text" height="200px" :src="imagePlace" v-if="this.place.image_id != null"></v-card-media>
    <v-card-title primary-title>
      <span class="headline">{{place.name}}</span>
    </v-card-title>
    <v-card-text>
      <span>Souhaitez-vous vraiment acheter ce lieu ?</span><br>
      <span class="grey--text">
        Vous avez : <strong>{{user.pointsAvailable}} points</strong><br>
        Le lieu vous coûtera : <strong>{{place.pointsCost}} points</strong><br>
        Il vous restera : <strong>{{points}} points</strong><br>
      </span>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click="closeBuyPlaceDialog">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click="buyPlace" @Click="">Accepter</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogBuyPlace',
    props: ['place'],
    data() {
      return {
        user : this.$auth.user(),
        imagePlace : 'http://www.api.buyyourcity.ovh/place/'+this.place.id+'/image',
        points : this.$auth.user().pointsAvailable - this.place.pointsCost
      }
    },methods:{
      closeBuyPlaceDialog : function () {
        this.$emit('closeBuyPlaceDialog')
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      buyPlace : function(){
        this.$http.post('place/' + this.place.id + '/buy', this.token)
          .then(res => {
            let dataSnack = {
              type : "success",
              message : "Vous avez bien acheté le lieu. Il vous reste : " + this.points + " points."
            }
            this.displaySnackbar(dataSnack);
            this.closeBuyPlaceDialog()
          })
          .catch(err => {
            let dataSnack = {
              type : "error",
              message : "Impossible d'acheter le lieu, réessayez plus tard."
            }
            this.displaySnackbar(dataSnack);
          })
      }
    }
  }
</script>
