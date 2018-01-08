<template>
    <v-card class="grey lighten-3">
      <v-card-title primary-title>
        <span class="headline">Changer votre avatar</span>
      </v-card-title>
      <v-card-text>
        <v-layout row wrap>
          <v-flex text-xs-center xs3 v-for="image in images" :key="image.id">
            <v-card flat class="blue-grey-2 cursor-pointer" v-on:click.native="changeAvatar(image.name)">
              <img :src="'http://api.buyyourcity.ovh/image/' + image.id + '/data'" height="150px" />
            </v-card>
          </v-flex>
        </v-layout>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click="closeAvatarDialog">Annuler</v-btn>
      </v-card-actions>
    </v-card>
</template>

<script type="text/javascript">
  export default {
    name: 'changeAvatarDialog',
    props: ['user'],
    data () {
      return {
        listHeight: null,
        images: [],
        imageSelect: null
      }
    },
    methods:{
      getAvatar: function(){
        this.$http.get('image/user')
          .then(res => {
            this.images = res.body
          })
      },
      changeAvatar: function(name){
        this.$http.put('user/'+this.user.id, this.user)
          .then(res => {

            this.user.image_id = this.imageSelect.id
            this.closeAvatarDialog()
          })
      },
      closeAvatarDialog: function () {
        this.$emit('closeAvatarDialog')
      },
    },
    beforeMount(){
      this.getAvatar()
    }
  }
</script>
