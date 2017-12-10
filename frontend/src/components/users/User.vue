<template>
  <v-expansion-panel>
    <v-expansion-panel-content hide-actions>
      <v-layout align-center row spacer slot="header">
        <v-flex xs1>
          <v-avatar size="36px" slot="activator">
            <img src="/static/icoUser.png" alt="">
          </v-avatar>
        </v-flex>
        <v-flex xs3>
          <strong>{{user.name}}</strong>
        </v-flex>
        <v-flex no-wrap width="230">
          <v-chip outline color="primary" v-if="user.admin" disabled>Administrateur</v-chip>
          <v-chip outline color="red" v-if="user.ban" disabled>Utilisateur banni</v-chip>
        </v-flex>
        <v-flex class="grey--text" ellipsis>{{user.pointsAviable}}</v-flex>
      </v-layout>
      <v-card class="grey lighten-3">
        <card-media scr="/static/icoUser.png">
          <v-layout column class="media">
            <v-card-title>
              <v-spacer></v-spacer>
              <v-btn dark icon >
                <v-icon>more_vert</v-icon>
              </v-btn>
            </v-card-title>
            <v-spacer></v-spacer>
            <v-card-title class="white--text pl-5-pt-5">
              <div class="display-1 pl-5-pt-5">{{user.name}}</div>
            </v-card-title>
          </v-layout>
        </card-media>
        <v-list two-line class="grey lighten-3">
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">mail</v-icon>
                </v-btn>
                <span>Adresse mail de l'utilisateur</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{user.email}}</v-list-tile-title>
              <v-list-tile-sub-title><i v-if="user.validEmail">(Adresse email validé)</i></v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset></v-divider>
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">plus_one</v-icon>
                </v-btn>
                <span>Points de l'utilisateur</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{user.pointsAviable}}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset></v-divider>
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">person</v-icon>
                </v-btn>
                <span>Type d'utilisateur</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title color="red" v-if="user.admin">Administrateur</v-list-tile-title>
              <v-list-tile-title color="red" v-else>Utilisateur</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset></v-divider>
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">close</v-icon>
                </v-btn>
                <span>Information sur l'utilisateur</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title color="red" v-if="user.ban">Banni</v-list-tile-title>
              <v-list-tile-title color="red" v-else>Non banni</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset></v-divider>
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">person_add</v-icon>
                </v-btn>
                <span>Date de création du compte</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{user.created_at}}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset></v-divider>
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">edit</v-icon>
                </v-btn>
                <span>Date de la dernière modification du compte</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{user.updated_at}}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>
  export default {
    name: 'users',
    props: ['user'],
    data() {
      return {
        dialog : false
      }
    },
    beforeMount(){
      console.log(this.user.id)
    },
  }
</script>
