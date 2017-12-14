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
        <v-text-field label="Name" :counter="60" required v-model="name"></v-text-field>
        <v-text-field label="E-mail" v-model="email" required></v-text-field>
        <v-text-field label="Mot de passe" min="6" hint="6 caratères minimum" v-model="password"
                      :append-icon="e1 ? 'visibility' : 'visibility_off'"
                      :append-icon-cb="() => (e1 = !e1)"
                      :type="e1 ? 'password' : 'text'"
                      counter required></v-text-field>
        <v-text-field label="Confirmer le mot de passe" v-model="password_confirm" required></v-text-field>
        <v-text-field label="Date de création du compte" v-bind:value="user.created_at" disabled></v-text-field>

        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click.native="closeEditUserDialog()">Refuser</v-btn>
        <v-btn color="warning darken-1" flat  @click="clear">Effacer</v-btn>
        <v-btn color="blue darken-1" flat @click="submit" :disabled="!valid">Envoyer</v-btn>
      </v-form>


    </v-card-text>
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
        password : this.user.password
      }
    },
    methods: {
      submit () {
        if (this.$refs.form.validate()) {

        }
      },
      clear () {
        this.$refs.form.reset()
      }
    }
  }
</script>
