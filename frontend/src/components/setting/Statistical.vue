<template>
  <v-container fluid>
    <v-flex xs12 sm6 md4>
      <v-card>
        <v-card-title primary-title>
          <div class="headline">Nombre de lieux possédés</div>
        </v-card-title>
        <v-card-text>
        <vue-chart type="doughnut" :data="chartData"></vue-chart>
        </v-card-text>
      </v-card>
    </v-flex>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Une erreur interne est survenue !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>


<script>
  import VueChart from 'vue-chart-js'

  export default {
    name: 'statistical',
    components: {
      VueChart
    },
    data () {
      return {
        snackbarKO: false,
        places: [],
        nbPlaceFree : 0,
        nbPlaceOccupied : 0
      }
    },
    beforeMount(){
      this.$http.get('place')
        .then(res => {
          this.places = res.body
        })
        .catch(err => {
          snackbarKO = true;
          console.log("error");
          console.log(err);
        });
    },
    methods: {
      getNbPlaceFree(places){

      }
    },
    data: () => ({
      chartData: {
        labels: ['Lieux libres', 'Lieux occupés'],
        datasets: [
          {
            label: 'Component 1',
            backgroundColor: ["#3e95cd", "#8e5ea2"],
            data: [this.getNbPlaceFree(this.places), this.nbPlaceOccupied]
          }
        ]
      }
    }),
  }
</script>
