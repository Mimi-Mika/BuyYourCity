<template>
  <v-flex xs12 sm6 md4>
    <v-card>
      <v-card-media
        class="white--text"
        height="200px"
        v-bind:src="place.pictPath"
      >
        <v-container fill-height fluid>
          <v-layout fill-height>
            <v-flex xs12 align-end flexbox>
              <span class="headline">{{place.name}}</span>
            </v-flex>
          </v-layout>
        </v-container>
      </v-card-media>
      <v-card-title primary-title>
        <div>
          <strong>Longitude :</strong> {{place.longitude}}<br>
          <strong>Latitude :</strong> {{place.latitude}}
        </div>
      </v-card-title>
      <v-card-actions v-if="isSetings">
        <v-btn flat color="blue" dark slot="activator" @click="dialogEdit = true">Modifier le lieu</v-btn>
        <v-btn flat color="red" dark slot="activator" @click="dialogRemove = true">Supprimer le lieu</v-btn>
      </v-card-actions>
      <v-card-actions v-else>
        <v-btn flat color="red" dark slot="activator" @click="dialogEdit = true">Vendre le lieu</v-btn>
      </v-card-actions>
    </v-card>
    <v-dialog v-model="dialogEdit" persistent>

      <v-card>
        <v-card-media
          class="white--text"
          height="200px"
          v-bind:src="place.pictPath"
        >
          <v-container fill-height fluid>
            <v-layout fill-height>
              <v-flex xs12 align-end flexbox>
                <span class="headline">Titre du lieu</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-media>
        <v-card-text>

        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" flat @click.native="dialogEdit = false">Annuler</v-btn>
          <v-btn color="green darken-1" flat @click.native="dialogEdit = false">Valider</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogRemove" persistent>

      <v-card>
        <v-card-media
          class="white--text"
          height="200px"
          v-bind:src="place.pictPath"
        >
          <v-container fill-height fluid>
            <v-layout fill-height>
              <v-flex xs12 align-end flexbox>
                <span class="headline">Titre du lieu</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-media>
        <v-card-text>
          <span class="title">Souhaitez-vous vraiment vendre ce lieu ?</span><br>
          En vendant ce lieu vous récupérerez :<br>
          <strong>nombre de points</strong>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" flat @click.native="dialogRemove = false">Refuser</v-btn>
          <v-btn color="green darken-1" flat @click.native="dialogRemove = false">Accepter</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-flex>
</template>

<script>
  export default {
    name: 'places',
    props: ['place'],
    data() {
      return {
        dialogEdit : false,
        dialogRemove : false
      }
    },
    beforeMount(){
     console.log(this.place.id)
    },
    computed:{
      title(){
        return this.$route.name
      },
      isSetings(){
        return this.title === "Gestion des lieux"
      }
    }
  }
</script>
