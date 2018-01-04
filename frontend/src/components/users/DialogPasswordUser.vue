<template>
  <v-card>
    <v-card-title primary-title>
      <span class="headline">
        <v-icon color="blue">lock</v-icon>
        Changer de mot de passe
      </span>
    </v-card-title>
    <v-card-text>
      <v-form v-model="valid" ref="form" lazy-validation>
        <v-text-field label="Mot de passe" v-model="oldPassword" required></v-text-field>
        <v-text-field label="Mot de passe" v-model="password" required></v-text-field>
        <v-text-field label="Confirmation du mot de passe" v-model="confirmPassword" required></v-text-field>

        <v-spacer></v-spacer>
        <v-btn color="red darken-1" flat @click.native="closePasswordUserDialog()">Annuler</v-btn>
        <v-btn color="blue darken-1" flat @click="submit" :disabled="!valid">Valider</v-btn>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    name: 'dialogPasswordUser',
    props: ['user'],
    data() {
      return {
        imageUser : 'http://www.api.buyyourcity.ovh/user/' + this.user.id + '/image',
        valid : true,
        oldPassword : this.user.password,
        password : '',
        confirmPassword : ''
      }
    },
    methods: {
      submit () {
        if (this.$refs.form.validate()) {

        }
      },
      closePasswordUserDialog: function () {
        this.$emit('closePasswordUserDialog')
      }
    }
  }
</script>
