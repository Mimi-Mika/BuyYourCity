<template>
  <v-card>
    <v-card-media
      class="white--text"
      height="200px"
      :src="imageUser"
    ></v-card-media>
    <v-card-title primary-title>
      <span class="headline">{{user.name}}</span>
    </v-card-title>
    <v-card-text>
      <span class="title">Souhaitez-vous vraiment supprimer votre compte ?</span><br>
      Vous perdrez entièrement votre progression !
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click.native="closeRemoveUserDialog()">Refuser</v-btn>
      <v-btn color="green darken-1" flat @click.native="dialogRemove = false" @Click="">Accepter</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogDeleteUser',
    props: ['user'],
    data() {
      return {
        imageUser : 'http://www.api.buyyourcity.ovh/user/'+this.user.id+'/image',
      }
    },
    methods:{
      closeRemoveUserDialog: function () {
        this.$emit('closeRemoveUserDialog')
      }
    }
  }
</script>
