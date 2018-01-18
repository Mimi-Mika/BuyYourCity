<template>
  <v-flex xs12 sm6 offset-sm3>
    <v-card class="grey lighten-3 elevation-5">
      <v-card-title>
        <v-flex class="text-xs-center">
          <a slot="activator" @click="dialogAvatar = true" v-if="isSettings">
            <img :src="imageUser" alt="avatar" width="150px"/><br>
            <v-icon color="blue">image</v-icon> Changer d'avatar
          </a>
        </v-flex>
      </v-card-title>
      <v-card-text>
        <div class="display-1" align="center">{{user.name}}</div>
        <br><v-divider></v-divider><v-divider></v-divider><v-divider></v-divider><br>
        <v-list two-line class="grey lighten-3">
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip bottom>
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
              <v-tooltip bottom>
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
              <v-tooltip bottom>
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
              <v-tooltip bottom>
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
              <v-tooltip bottom>
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
              <v-tooltip bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">person_add</v-icon>
                </v-btn>
                <span>Date de création du compte</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title v-if="user.created_at != null">{{$moment(user.created_at).format('DD/MM/YYYY à HH:mm:ss')}}</v-list-tile-title>
              <v-list-tile-title v-else></v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset></v-divider>
          <v-list-tile>
            <v-list-tile-action>
              <v-tooltip bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">edit</v-icon>
                </v-btn>
                <span>Date de la dernière modification du compte</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title v-if="user.updated_at != null">{{$moment(user.updated_at).format('DD/MM/YYYY à HH:mm:ss')}}</v-list-tile-title>
              <v-list-tile-title v-else></v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider inset v-if="isSettings"></v-divider>
          <v-list-tile v-if="isSettings">
            <v-list-tile-action>
              <v-tooltip bottom>
                <v-btn icon slot="activator">
                  <v-icon color="blue">lock</v-icon>
                </v-btn>
                <span>Mot de passe</span>
              </v-tooltip>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title><a slot="activator" @click="dialogPassword = true">Changer de mot de passe</a></v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card-text>
      <v-card-actions v-if="isSettings">
        <v-btn flat color="red" slot="activator" @click="dialogRemove = true">Supprimer mon compte</v-btn>
        <v-btn flat color="blue" slot="activator" @click="dialogEdit = true">Modifier mon compte</v-btn>
      </v-card-actions>
      <v-card-actions v-else>
        <v-btn flat color="red" slot="activator" @click="dialogBan = true" v-if="!user.ban">Bannir</v-btn>
        <v-btn flat color="red" slot="activator" @click="dialogBan = true" v-else>Débannir</v-btn>
        <v-btn flat color="blue" slot="activator" @click="dialogAdmin = true" v-if="!user.admin">Rendre administrateur</v-btn>
        <v-btn flat color="blue" slot="activator" @click="dialogAdmin = true" v-else>Enlever les droits administrateur</v-btn>
      </v-card-actions>
    </v-card>

    <v-snackbar :timeout="6000" top="top" right="right" v-model="messageSnackbar" :color="snackbarData.color">
      <v-icon>{{snackbarData.icon}}</v-icon> &nbsp;
      {{snackbarData.message}}
      <v-btn flat color="white" @click.native="messageSnackbar = false">Close</v-btn>
    </v-snackbar>

    <v-dialog lazy v-model="dialogEdit" persistent>
      <dialog-edit-user :user="user" @closeEditUserDialog="closeEditUserDialog" @displaySnackbar="displaySnackbar" ></dialog-edit-user>
    </v-dialog>
    <v-dialog lazy v-model="dialogRemove" persistent>
      <dialog-delete-user :user="user" @closeRemoveUserDialog="closeRemoveUserDialog" @displaySnackbar="displaySnackbar" ></dialog-delete-user>
    </v-dialog>
    <v-dialog lazy v-model="dialogPassword" persistent>
      <dialog-password-user :user="user" @closePasswordUserDialog="closePasswordUserDialog" @displaySnackbar="displaySnackbar" ></dialog-password-user>
    </v-dialog>
    <v-dialog lazy v-model="dialogAdmin" persistent>
      <dialog-admin-user :user="user" @closeAdminUserDialog="closeAdminUserDialog" @displaySnackbar="displaySnackbar" ></dialog-admin-user>
    </v-dialog>
    <v-dialog lazy v-model="dialogBan" persistent>
      <dialog-ban-user :user="user" @closeBanUserDialog="closeBanUserDialog" @displaySnackbar="displaySnackbar" ></dialog-ban-user>
    </v-dialog>
    <v-dialog lazy v-model="dialogAvatar" persistent>
      <change-avatar-dialog :user="user" @closeAvatarDialog="closeAvatarDialog" @displaySnackbar="displaySnackbar" ></change-avatar-dialog>
    </v-dialog>
  </v-flex>
</template>

<script>
  import DialogDeleteUser from './DialogDeleteUser'
  import DialogEditUser from './DialogEditUser'
  import DialogPasswordUser from './DialogPasswordUser'
  import DialogAdminUser from './DialogAdminUser'
  import DialogBanUser from './DialogBanUser'
  import ChangeAvatarDialog from './ChangeAvatarDialog'

  export default {
    name: 'detailsUserCard',
    props: ['user'],
    components: {
      DialogDeleteUser,
      DialogEditUser,
      DialogPasswordUser,
      DialogAdminUser,
      DialogBanUser,
      ChangeAvatarDialog
    },
    data() {
      return {
        editOK: false,
        OK: false,
        places : [],
        imageUser: 'https://www.api.buyyourcity.ovh/user/' + this.user.id + '/image?moment='+ this.$moment(),
        nbPlacesUser : 0,
        dialogEdit : false,
        dialogRemove : false,
        dialogPassword : false,
        dialogAdmin : false,
        dialogBan : false,
        dialogAvatar: false,
        messageSnackbar: false,
        snackbarData:{
          color : null,
          icon : null,
          message : null
        }
      }
    },
    beforeMount(){
     this.getUserPlaces()
    },
    computed:{
      title(){
        return this.$route.name
      },
      isSettings(){
        return this.title === "Mes informations"
      },
      avatar(){
        return this.user.image_id
      }
    },
    methods: {
      closeRemoveUserDialog: function () {
        this.dialogRemove = false
      },
      closeEditUserDialog: function () {
        this.dialogEdit = false
      },
      closePasswordUserDialog: function () {
        this.dialogPassword = false
      },
      closeAdminUserDialog: function () {
        this.dialogAdmin = false
      },
      closeAvatarDialog: function (){
        this.dialogAvatar = false
      },
      closeBanUserDialog: function () {
        this.dialogBan = false
      },
      moment: function () {
        return this.$moment();
      },
      date: function (date) {
        return this.$moment(date).format('DD/MM/YYYY à HH:mm:ss');
      },
      getUserPlaces: function (){
        this.$http.get('user/'+this.user.id+'/places')
          .then(res => {
            this.places = res.body,
              this.nbPlacesUser = this.places.length
          })
          .catch(err => {
            this.snackbarData.icon = "warning"
            this.snackbarData.message = dataSnack.message
            this.snackbarData.color = "error"
            this.messageSnackbar = true
          });
      },
      displaySnackbar: function(dataSnack){
        if(dataSnack.type === "error"){
          this.snackbarData.icon = "warning"
          this.snackbarData.message = dataSnack.message
          this.snackbarData.color = "error"
        }
        else {
          this.snackbarData.icon = "check_circle"
          this.snackbarData.message = dataSnack.message
          this.snackbarData.color = "success"
          this.$emit('getUser')
        }
        this.messageSnackbar = true
      }
    },
    watch: {
      avatar: function (value) {
        this.imageUser = 'https://www.api.buyyourcity.ovh/user/' + this.user.id + '/image?moment='+ this.$moment()
      },
    },
    filters: {
      moment: function (date) {
        return $moment(date).format('DD/MM/YYYY à HH:mm:ss');
      }
    }
  }
</script>
