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
        <v-flex no-wrap>
          <v-chip outline color="primary" v-if="user.admin">Administrateur</v-chip>
          <v-chip outline color="red" v-if="user.ban">Utilisateur banni</v-chip>
        </v-flex>
        <v-flex
          class="grey--text"
          ellipsis
          v-if="user.updated_at != null"
        >
          Modifié le {{user.updated_at}}
        </v-flex>
      </v-layout>
      <v-card>
        <v-divider></v-divider>
        <v-card-text>
          <u>Adresse email :</u> {{user.email}}
            <i v-if="user.validEmail" class="grey--text">(Adresse email validé)</i>
          <br>
          <u>Points disponibles :</u> {{user.pointsAviable}}<br>
          Créé le {{user.created_at}}<br>
        </v-card-text>
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
