<template>
  <v-container class="blue-grey-2">
    <v-card flat class="blue-grey-2">
      <v-card-title ref="listTitle">
        <span class="section-title grey-text-1">Changer votre avatar</span>
        <v-spacer></v-spacer>
        <v-btn flat color="teal" v-on:click.native="closeAvatarDialog()">Annuler</v-btn>
      </v-card-title>
      <v-card-text>
        <div v-bar :style="{ height: listHeight }" >
          <div infinite-wrapper>
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
            <infinite-loading @infinite="infiniteHandler"></infinite-loading>
          </div>
        </div>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script type="text/javascript">
  import InfiniteLoading from 'vue-infinite-loading'
  import Vuex from 'vuex'
  export default {
    name: 'changeAvatarDialog',
    components: {
      InfiniteLoading
    },
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
        let patch = [
          { op:"replace", path: "/avatar", value: name },
        ]
        this.$http.patch('user/'+this.$auth.user()._id, patch)
          .then(res => {
            this.$auth.user().avatar = name
            this.closeAvatarDialog()
          })
      },
      closeAvatarDialog: function () {
        this.$emit('closeAvatarDialog')
      },
      setHeight: function () {
        this.listHeight = (this.heightAvailable - this.$refs.listTitle.clientHeight) - 16*4 + 'px'
      },
    },
    computed: {
      ...Vuex.mapGetters(['avatars']),
      ...Vuex.mapGetters(['heightAvailable']),
    },
    watch: {
      // immediate: true
      heightAvailable: function () {
        this.setHeight()
      }
    },
    mounted () {
      this.setHeight()
    },
  }
</script>
