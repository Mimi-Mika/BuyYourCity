*<template>
  <v-flex xs12 sm6 md4>
    <v-card>
      <v-card-media
        class="white--text"
        height="200px"
        src="/static/doc-images/cards/docks.jpg"
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
        <div>{{place.longitude}}, {{place.latitude}}</div>
      </v-card-title>
      <v-card-actions>
          <v-dialog v-model="dialog" persistent>
            <v-btn flat color="blue" dark slot="activator">Vendre le lieu</v-btn>
            <v-card>
              <v-card-media
                class="white--text"
                height="200px"
                src="/static/doc-images/cards/docks.jpg"
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
                <v-btn color="green darken-1" flat @click.native="dialog = false">Refuser</v-btn>
                <v-btn color="green darken-1" flat @click.native="dialog = false">Accepter</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
      </v-card-actions>
    </v-card>
    </v-flex>
</template>

<script>
  export default {
    name: 'places',
    props: ['place'],
    data() {
      return {
        dialog : false
      }
    },
    beforeMount(){
     console.log(this.place.id)
    },
  }
</script>
