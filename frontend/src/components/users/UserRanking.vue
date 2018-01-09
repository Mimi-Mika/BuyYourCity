<template>
  <v-container>
    <v-data-table
      v-bind:headers="headers"
      v-bind:items="items"
      hide-actions
      class="elevation-5"
      must-sort="sorted descending"
    >
      <template slot="items" slot-scope="props">
        <tr v-if="userId === props.item.id" class="blue lighten-4">
          <td><strong><v-chip outline color="primary"disabled>{{ props.index+1 }}</v-chip></strong></td>
          <td><strong>{{ props.item.name }}</strong></td>
          <td><strong>{{ props.item.pointsAviable }}</strong></td>
          <!--<td><strong>{{ progress }}</strong></td>-->
        </tr>
        <tr v-else>
          <td><v-chip outline color="primary"disabled>{{ props.index+1 }}</v-chip></td>
          <td>{{ props.item.name }}</td>
          <td>{{ props.item.pointsAviable }}</td>
          <!--<td>{{ progress }}</td>-->
        </tr>
      </template>
      <template slot="no-data">
        <v-alert :value="true" color="error" icon="warning">
          Désolé, aucune données n'a été trouvé !
          <v-icon>sentiment_very_dissatisfied</v-icon>
        </v-alert>
      </template>
    </v-data-table>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="snackbarKO" color="error">
      <v-icon>warning</v-icon> &nbsp;
      Impossible de charger le classement, réessayez plus tard !
      <v-btn flat color="white" @click.native="snackbarKO = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
  export default {
    name: 'ranking',
    data () {
      return {
        items: [],
        ranking: 0,
        progress:'',
        snackbarKO: false,
        userId: '',
        search: '',
        pagination: {},
        headers: [
          {
            text: '',
            align: 'left',
            sortable: false,
            value: 'order',
            color: ''
          },
          {
            text: 'Nom d\'utilisateur',
            align: 'left',
            sortable: false,
            value: 'name'
          },
          {
            text: 'Nombre de points',
            align: 'left',
            sortable: false,
            value: 'pointsAviable',
          }/*,
          {
            text: 'Progression',
            align: 'left',
            sortable: false,
            value: 'progress'
          },*/
        ]
      }
    },
    beforeMount(){
      this.userId = this.$auth.user().id
      this.$http.get('user/ranking')
        .then(res => {
          this.items = res.body
        })
        .catch(err => {
          this.snackbarKO = true;
        });
    }
  }
</script>
