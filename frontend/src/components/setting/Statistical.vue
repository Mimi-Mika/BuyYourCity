<template>
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex xs12 sm6 md4>
        <v-card color="grey darken-2" class="white--text elevation-5">
          <v-container fluid grid-list-lg>
            <v-layout row>
              <v-flex xs7>
                <div class="white--text">
                  <v-icon color="white">place</v-icon>
                  Nombre total de lieu
                </div>
              </v-flex>
              <v-flex xs3>
                <span class="display-2" align="right">{{nbPlaceTot}}</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
      </v-flex>
      <v-flex xs12 sm6 md4>
        <v-card color="grey darken-2" class="white--text elevation-5">
          <v-container fluid grid-list-lg>
            <v-layout row>
              <v-flex xs7>
                <div>
                  <v-icon color="white">people</v-icon>
                  Nombre total d'utilisateur
                </div>
              </v-flex>
              <v-flex xs5>
                <span class="display-2" align="right">{{nbUserTot}}</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
      </v-flex>
      <!--<v-flex xs12 sm6 md4>
        <v-card color="grey darken-2" class="white&#45;&#45;text elevation-5">
          <v-container fluid grid-list-lg>
            <v-layout row>
              <v-flex xs7>
                <div>
                  <v-icon color="white">people</v-icon>
                  Nombre total d'utilisateur
                </div>
              </v-flex>
              <v-flex xs5>
                <span class="display-2" align="right">8</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card>
      </v-flex>-->
    </v-layout>

    <v-layout row wrap>
      <v-flex xs12 sm6 md4>
        <v-card class="elevation-5">
          <v-card-title primary-title>
            <div class="headline" height="104px">
              <v-icon color="grey darken-2">person_pin_circle</v-icon>
              Nombre de lieux possédés
            </div>
          </v-card-title>
          <v-card-text>
          <vue-chart type="doughnut" :data="chartDataNbPlace"></vue-chart>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 sm6 md4>
        <v-card class="elevation-5">
          <v-card-title primary-title>
            <div class="headline" height="104px">
              <v-icon color="grey darken-2">account_circle</v-icon>
              Nombre d'utilisateur Banni
            </div>
          </v-card-title>
          <v-card-text>
            <vue-chart type="doughnut" :data="chartDataNbUserBan"></vue-chart>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 sm6 md4>
        <v-card class="elevation-5">
          <v-card-title primary-title>
            <div class="headline" height="104px">
              <v-icon color="grey darken-2">account_circle</v-icon>
              Nombre d'utilisateur administrateur
            </div>
          </v-card-title>
          <v-card-text>
            <vue-chart type="doughnut" :data="chartDataNbUserAdmin"></vue-chart>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>

    <v-layout row wrap>
      <v-flex xs12 sm6 md4>
        <v-card class="elevation-5">
          <v-card-title primary-title>
            <div class="headline" height="104px">
              <v-icon color="grey darken-2">monetization_on</v-icon>
              Nombre d'achat / vente de l'année
            </div>
          </v-card-title>
          <v-card-text>
            <vue-chart type="doughnut" :data="chartDataNbSellBuyYear"></vue-chart>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 sm6 md4>
        <v-card class="elevation-5">
          <v-card-title primary-title>
            <div class="headline" height="104px">
              <v-icon color="grey darken-2">monetization_on</v-icon>
              Nombre d'achat / vente du mois
            </div>
          </v-card-title>
          <v-card-text>
            <vue-chart type="doughnut" :data="chartDataNbSellBuyMonth"></vue-chart>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 sm6 md4>
        <v-card class="elevation-5">
          <v-card-title primary-title>
            <div class="headline" height="104px">
              <v-icon color="grey darken-2">monetization_on</v-icon>
              Nombre d'achat / vente de la semaine
            </div>
          </v-card-title>
          <v-card-text>
            <vue-chart type="doughnut" :data="chartDataNbSellBuyWeek"></vue-chart>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
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
        nbPlaceFree : null,
        nbUserTotNotAdmin: null,
        nbPlaceTot : null,
        nbUserTotAdmin: null,
        nbUserTotPlaying: null,
        nbUserTot: null,
        nbUserTotBan: null,
        nbSellPlaceYear: null,
        nbBuyPlaceYear: null,
        nbSellPlaceMonth: null,
        nbBuyPlaceMonth: null,
        nbSellPlaceWeek: null,
        nbBuyPlaceWeek: null,
        chartDataNbPlace: {
          labels: ['Lieux libres', 'Lieux occupés'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: []
            }
          ]
        },
        chartDataNbSellBuyYear: {
          labels: ['Achat', 'Vente'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: []
            }
          ]
        },
        chartDataNbSellBuyMonth: {
          labels: ['Achat', 'Vente'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: []
            }
          ]
        },
        chartDataNbSellBuyWeek: {
          labels: ['Achat', 'Vente'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: []
            }
          ]
        },
        chartDataNbUserBan: {
          labels: ['Utilisateurs banni', 'Utilisateurs non banni'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: []
            }
          ]
        },
        chartDataNbUserAdmin: {
          labels: ['Utilisateurs administrateur', 'Utilisateurs non administrateur'],
          datasets: [
            {
              label: 'Component 1',
              backgroundColor: ["#3e95cd", "#8e5ea2"],
              data: []
            }
          ]
        }
      }
    },
    beforeMount(){
      this.$http.get('place/count/available')
        .then(res => {
          this.placesFree = res.body
          this.chartDataNbPlace.datasets[0].data[0] = this.placesFree.length
        })
        .catch(err => {
          this.snackbarKO = true;
        });
      this.$http.get('place/count/purchased')
        .then(res => {
          this.placesPurchased = res.body
          this.chartDataNbPlace.datasets[0].data[1] = this.placesPurchased.length
        })
        .catch(err => {
          this.snackbarKO = true;
        });
      this.$http.get('history/sell/year')
        .then(res => {
          this.nbSellPlaceYear = res.body
          this.chartDataNbSellBuyYear.datasets[0].data[0] = this.nbSellPlaceYear
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('history/buy/year')
        .then(res => {
          this.nbBuyPlaceYear = res.body
          this.chartDataNbSellBuyYear.datasets[0].data[1] = this.nbBuyPlaceYear
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('history/sell/month')
        .then(res => {
          this.nbSellPlaceMonth = res.body
          this.chartDataNbSellBuyMonth.datasets[0].data[0] = this.nbSellPlaceMonth
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('history/buy/month')
        .then(res => {
          this.nbBuyPlaceMonth = res.body
          this.chartDataNbSellBuyMonth.datasets[0].data[1] = this.nbBuyPlaceMonth
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('history/sell/week')
        .then(res => {
          this.nbSellPlaceWeek = res.body
          this.chartDataNbSellBuyWeek.datasets[0].data[0] = this.nbSellPlaceWeek
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('history/buy/week')
        .then(res => {
          this.nbBuyPlaceWeek = res.body
          this.chartDataNbSellBuyWeek.datasets[0].data[1] = this.nbBuyPlaceWeek
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('place/count/total')
        .then(res => {
          this.nbPlaceTot = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('user/count/total')
        .then(res => {
          this.nbUserTot = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('user/count/ban')
        .then(res => {
          this.nbUserTotBan = res.body
          this.chartDataNbUserBan.datasets[0].data[0] = this.nbUserTotBan
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('user/count/playing')
        .then(res => {
          this.nbUserTotPlaying = res.body
          this.chartDataNbUserBan.datasets[0].data[1] = this.nbUserTotPlaying
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('user/count/admin')
        .then(res => {
          this.nbUserTotAdmin = res.body
          this.chartDataNbUserAdmin.datasets[0].data[0] = this.nbUserTotAdmin
        })
        .catch(err => {
          this.snackbarKO = true;
        })
      this.$http.get('user/count/notadmin')
        .then(res => {
          this.nbUserTotNotAdmin = res.body
          this.chartDataNbUserAdmin.datasets[0].data[1] = this.nbUserTotNotAdmin
        })
        .catch(err => {
          this.snackbarKO = true;
        })
    }
  }
</script>
