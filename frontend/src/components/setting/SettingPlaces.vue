<template>
  <v-container fluid>
    <v-layout row wrap>
      <v-flex>
        <place v-for="place in places" :key="place.id" :place="place"></place>
      </v-flex>
    </v-layout>
  </v-container>
</template>


<script>
  import Place from '../places/Place'

  export default {
    name: 'settingPlaces',
    components: {
      Place
    },
    data () {
      return {
       places: []
      }
    },

    beforeMount(){
      /*this.$http.get('place')
        .then(res => {
          this.places = res.body
        })
        .catch(err => {
          console.log("error");
          console.log(err);
        });*/
      this.places = [{"id":1,"name":"Wisconsin Faheyport","latitude":24.313903,"longitude":-30.095252,"pointsGiven":5,"pointsCost":50,"pictPath":"storage\/app\/public\/images\/5973b22939cbbce1684765bfe5df1ae3.jpg","user_id":7,"created_at":null,"updated_at":null}
        ,{"id":2,"name":"Missouri North Devynview","latitude":14.675109,"longitude":-80.145587,"pointsGiven":6,"pointsCost":60,"pictPath":"storage\/app\/public\/images\/7aeed535db612e7cb5cc80e1997bef8d.jpg","user_id":10,"created_at":null,"updated_at":null},{"id":3,"name":"North Dakota Maximoville","latitude":-77.72193,"longitude":-39.434302,"pointsGiven":1,"pointsCost":10,"pictPath":"storage\/app\/public\/images\/e62d50418b1917c47d2594dd0ff5107c.jpg","user_id":1,"created_at":null,"updated_at":null},{"id":4,"name":"Massachusetts Lake Briahaven","latitude":89.242502,"longitude":-16.270479,"pointsGiven":4,"pointsCost":40,"pictPath":"storage\/app\/public\/images\/22d0d2ffd720e62169bc74aa564acc67.jpg","user_id":1,"created_at":null,"updated_at":null},{"id":5,"name":"Texas West Rodfurt","latitude":84.64009,"longitude":-21.839199,"pointsGiven":10,"pointsCost":100,"pictPath":"storage\/app\/public\/images\/f580da48d2ad2324115dc78155c1fd69.jpg","user_id":7,"created_at":null,"updated_at":null},{"id":6,"name":"Maryland East Savannah","latitude":29.042438,"longitude":-73.044311,"pointsGiven":5,"pointsCost":50,"pictPath":"storage\/app\/public\/images\/5cef94ad8a609d652d3aba7eb65270bd.jpg","user_id":2,"created_at":null,"updated_at":null},{"id":7,"name":"Iowa Smithammouth","latitude":1.905338,"longitude":86.856154,"pointsGiven":4,"pointsCost":40,"pictPath":"storage\/app\/public\/images\/a651411f39b96d90cb60db00f2459123.jpg","user_id":7,"created_at":null,"updated_at":null},{"id":8,"name":"Ohio Lake Salmaville","latitude":-76.428409,"longitude":76.988915,"pointsGiven":9,"pointsCost":90,"pictPath":"storage\/app\/public\/images\/9c3fc78112a0f539f204ca25e43b234f.jpg","user_id":9,"created_at":null,"updated_at":null},{"id":9,"name":"Kansas Kossville","latitude":37.576877,"longitude":14.550681,"pointsGiven":8,"pointsCost":80,"pictPath":"storage\/app\/public\/images\/0751f5e207d6861e1954f2695bf3aa60.jpg","user_id":2,"created_at":null,"updated_at":null},{"id":10,"name":"Idaho North Marianatown","latitude":-19.199665,"longitude":-21.156552,"pointsGiven":2,"pointsCost":20,"pictPath":"storage\/app\/public\/images\/3df1ef83bb308f297ef6c0d0def04c47.jpg","user_id":4,"created_at":null,"updated_at":null}]

    },

  }

</script>
