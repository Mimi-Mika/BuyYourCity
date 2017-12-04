<template>
  <v-container fluid>
    <v-layout row wrap>
      <v-flex xs12>
        <v-card>
          <v-card-media
            class="white--text"
            height="200px"
            src="/static/info_account.png">
            <v-container fill-height fluid>
              <v-layout fill-height>
                <v-flex xs12 align-end flexbox>
                  <span class="headline">Mes informations</span>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-media>
          <v-card-title>
            <div>
              <v-flex>
                <v-text-field
                  name="input-3"
                  label="Pseudo"
                  value=""
                  disabled
                ></v-text-field>
                <v-text-field
                  name="input-3"
                  label="E-mail"
                  value=""
                  disabled
                ></v-text-field>
                <p>Compte créé le : </p>
              </v-flex>
            </div>
          </v-card-title>
          <v-divider></v-divider>
          <v-card-actions>
            <v-btn flat icon color="">
              <v-icon>mode_edit</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>


<script>
  export default {
    name: 'info'
  }
</script>
