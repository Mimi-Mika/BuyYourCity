<template>
  <v-card class="grey lighten-3">
    <card-media :scr="imageUser">
    </card-media>
    <v-card-title class="white--text pl-5-pt-5">
      <div class="display-1 pl-5-pt-5">{{user.name}}</div>
      <v-spacer></v-spacer>
      <v-menu  offset-y>
         <v-icon>more_vert</v-icon>
         <v-list>
           <v-list-tile @click="">
             <v-list-tile-title>Modifier</v-list-tile-title>
           </v-list-tile>
         </v-list>
         <v-list>
           <v-list-tile @click="">
             <v-list-tile-title>Supprimer</v-list-tile-title>
           </v-list-tile>
         </v-list>
       </v-menu>
    </v-card-title>
    <v-card-text>
      <v-list two-line class="grey lighten-3">
        <v-list-tile>
          <v-list-tile-action>
            <v-tooltip v-model="show" bottom>
              <v-btn icon slot="activator">
                <v-icon color="blue">mail</v-icon>
              </v-btn>
              <span>Type d'utilisateur</span>
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
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    name: 'detailsUserCard',
    props: ['user'],
    //imgUser: "/src/assets/icons/" + this.user.pictureName,
    data() {
      return {
        imageUser: 'http://www.api.buyyourcity.ovh/user/' + this.user.id + '/image',
      }
    },
    beforeMount(){
      console.log(this.user.id)
    }
  }
</script>
