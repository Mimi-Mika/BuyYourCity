<template>
  <v-card>
    <v-card-media
      class="white--text"
      height="200px"
      :src="imageUser"
    ></v-card-media>
    <v-card-title primary-title>
      <span class="headline">Modifier mon profil</span>
    </v-card-title>
    <v-card-text>
      <v-form v-model="valid" ref="form" lazy-validation>
        <v-text-field label="Name" :counter="60" required v-model="name" :rules="nameRules"></v-text-field>
        <v-text-field label="E-mail" v-model="email" :rules="emailRules" required></v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="red darken-1" flat @click.native="closeEditUserDialog">Refuser</v-btn>
      <v-btn color="blue darken-1" flat @click="submit" :disabled="!valid">Envoyer</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogEditUser',
    props: ['user'],
    data() {
      return {
        imageUser : 'http://www.api.buyyourcity.ovh/user/' + this.user.id + '/image',
        valid : true,
        name : this.user.name,
        email : this.user.email,
        nameRules: [
          (v) => !!v || 'Nom utilisateur obligatoire'
        ],
        emailRules: [
          (v) => !!v || 'L\'adresse mail est obligatoire',
          (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'Adresse mail non valide'
        ]
      }
    },
    methods: {
      submit () {
        if (this.$refs.form.validate()) {
          this.user.name = this.name
          this.user.email = this.email
          this.$http.put('user/' + this.user.id, this.user)
            .then(res => {
              this.closeEditUserDialog()
              let dataSnack = {
                type : "success",
                message : "La modification de l'utilisateur a bien été prise en compte."
              }
              this.displaySnackbar(dataSnack);
            })
            .catch(err => {
              let dataSnack = {
                type : "error",
                message : "Impossible de modifier les données de l'utilisateur, réessayez plus tard."
              }
              this.displaySnackbar(dataSnack);
            })
        }
      },
      displaySnackbar: function(dataSnack) {
        this.$emit('displaySnackbar', dataSnack)
      },
      closeEditUserDialog: function () {
        this.$emit('closeEditUserDialog')
      }
    }
  }
</script>
