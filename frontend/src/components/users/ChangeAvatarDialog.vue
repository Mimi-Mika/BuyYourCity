<template>
    <v-card class="grey lighten-3">
      <v-card-title primary-title>
        <span class="headline">Changer votre avatar</span>
      </v-card-title>
      <v-card-text>
          <!--<div infinite-wrapper>-->
            <v-layout row wrap>
                <v-flex
                  text-xs-center
                  xs3
                  v-for="avatar in avatars"
                  :key="avatar._id"
                >
                  <v-card flat class="blue-grey-2 cursor-pointer" v-on:click.native="changeAvatar(avatar.name)">
                    <img
                      v-lazy="avatar.src"
                      height="150px"
                    />
                  </v-card>
                </v-flex>
            </v-layout>
            <!--<infinite-loading @infinite="infiniteHandler"></infinite-loading>-->
          <!--</div>-->
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click="closeAvatarDialog">Annuler</v-btn>
      </v-card-actions>
    </v-card>
</template>

<script type="text/javascript">
  import InfiniteLoading from 'vue-infinite-loading'
  // import Vuex from 'vuex'
  export default {
    name: 'changeAvatarDialog',
    props: ['user'],
    data () {
      return {
        listHeight: null,
      }
    },
    methods:{
      infiniteHandler($state) {
        let urlParam="?skip="+this.avatars.length
        this.$http.get('avatar'+urlParam)
          .then(res => {
            if(res.body.avatars.length>0){
              this.$store.dispatch('addAvatars', res.body.avatars)
              $state.loaded()
            }
            else
              $state.complete()
          })
      },
      changeAvatar: function(name){

        this.$http.put('user/'+this.user.id, this.user)
          .then(res => {
            this.$auth.user().avatar = name
            this.closeAvatarDialog()
          })
      },
      closeAvatarDialog: function () {
        this.$emit('closeAvatarDialog')
      },
      // setHeight: function () {
      //   this.listHeight = (this.heightAvailable - this.$refs.listTitle.clientHeight) - 16*4 + 'px'
      // },
    },
    // computed: {
    //   ...Vuex.mapGetters(['avatars']),
    //   ...Vuex.mapGetters(['heightAvailable']),
    // },
    // watch: {
    //   // immediate: true
    //   heightAvailable: function () {
    //     this.setHeight()
    //   }
    // },
    // mounted () {
    //   this.setHeight()
    // },
  }
</script>
