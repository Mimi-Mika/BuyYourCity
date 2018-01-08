<template>
  <v-container fluid>
    <v-flex xs12 sm6 md4>
      <v-card>
        <v-card-title primary-title>
          <div class="headline">Nombre de lieux possédés</div>
        </v-card-title>
        <v-card-text>
        <vue-chart type="doughnut" :data="chartDataNbPlace"></vue-chart>
        </v-card-text>
      </v-card>

      <v-card>
        <v-card-title primary-title>
          <div class="headline">Nombre d'achat / vente</div>
        </v-card-title>
        <v-card-text>
          <vue-chart type="doughnut" :data="chartDataNbSellBuy"></vue-chart>
        </v-card-text>
      </v-card>


    </v-flex>
    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Impossible d'afficher les données des statistiques, réessayer plus tard.
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
        placesFree: [],
        placesPurchased: [],
        nbPlaceFree : 0,
        nbSellPlaceMonth: 0,
        nbBuyPlaceMonth: 0,
        chartDataNbPlace: {
          labels: ['Lieux libres', 'Lieux occupés'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: [this.placesFree.size(), this.placesPurchased.size()]
            }
          ]
        },
        chartDataNbSellBuy: {
          labels: ['Achat', 'Vente'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: [this.getNbBuyPlaceMonth(), this.getNbSellPlaceMonth()]
            }
          ]
        },
      }
    },
    beforeMount(){
      this.$http.get('/place/available')
        .then(res => {
          this.placesFree = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
        });
      this.$http.get('/place/purchased')
        .then(res => {
          this.placesPurchased = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
        });
    },
    methods: {
      getNbSellPlaceMonth: function(){
        this.$http.get('/history/sell/month')
          .then(res => {
            this.nbSellPlaceMonth = res.body
          })
          .catch(err => {
            this.snackbarKO = true;
          })
      },
      getNbBuyPlaceMonth: function(){
        this.$http.get('/history/buy/month')
          .then(res => {
            this.nbBuyPlaceMonth = res.body
          })
          .catch(err => {
            this.snackbarKO = true;
          })
      }
    },
  }
</script>
