<template>
  <v-flex xs12 sm6 offset-sm3>
    <v-card class="grey lighten-3">
      <v-card-title>
        <v-flex  class="text-xs-center">
          <v-avatar tile="true" :size="200" class="grey lighten-4" v-if="isSettings">
            <img :src="imageUser" alt="avatar"/>
          </v-avatar>
        </v-flex>
        <!--<v-menu offset-y>
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
         </v-menu>-->
      </v-card-title>
      <v-card-text>
        <div class="display-1" align="center">{{user.name}}</div>
        <br><v-divider></v-divider><v-divider></v-divider><v-divider></v-divider><br>
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
          <v-divider inset v-if="isSettings"></v-divider>
          <v-list-tile v-if="isSettings">
            <v-list-tile-action>
              <v-tooltip v-model="show" bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">pin_drop</v-icon>
                </v-btn>
                <span>Nombre de lieux possédés</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title color="red">{{nbPlacesUser}}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset v-if="!isSettings"></v-divider>
          <v-list-tile v-if="!isSettings">
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
          <v-divider inset  v-if="!isSettings"></v-divider>
          <v-list-tile v-if="!isSettings">
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
      <v-card-actions v-if="isSettings">
        <v-btn flat color="red" slot="activator" @click="dialogRemove = true">Supprimer mon compte</v-btn>
        <v-btn flat color="blue" slot="activator" @click="dialogEdit = true">Modifier mon compte</v-btn>
      </v-card-actions>
    </v-card>

    <v-dialog v-model="dialogEdit" persistent>
      <dialog-edit-user :user="user" @closeDeleteUserDialog="closeRemoveUserDialog"></dialog-edit-user>
    </v-dialog>
    <v-dialog v-model="dialogRemove" persistent>
      <dialog-delete-user :user="user" @closeEditUserDialog="closeEditUserDialog"></dialog-delete-user>
    </v-dialog>
  </v-flex>
</template>

<script>
  import DialogDeleteUser from './DialogDeleteUser'
  import DialogEditUser from './DialogEditUser'
  export default {
    name: 'detailsUserCard',
    props: ['user'],
    components: {
      DialogDeleteUser,
      DialogEditUser
    },
    data() {
      return {
        places : [],
        imageUser : 'http://www.api.buyyourcity.ovh/user/' + this.user.id + '/image',
        nbPlacesUser : 0,
        dialogEdit : false,
        dialogRemove : false,
      }
    },
    beforeMount(){
      this.$http.get('user/'+this.user.id+'/places')
        .then(res => {
          this.places = res.body,
          this.nbPlacesUser = this.places.length
        })
        .catch(err => {
          console.log("error");
          console.log(err);
        });

    },
    computed:{
      title(){
        return this.$route.name
      },
      isSettings(){
        return this.title === "Mes informations"
      },
      avatarSize () {
        return `${this.slider}px`
      }
    },
    methods: {
      closeRemoveUserDialog: function () {
        this.dialogRemove = false
      },
      closeEditUserDialog: function () {
        this.dialogEdit = false
      }
    }
  }
</script>
