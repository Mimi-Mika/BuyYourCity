<template>
  <v-container fluid>
    <h2 >News</h2>
    <p><b>5</b> new games added :
      <v-chip class="grey darken-2 white--text">
        <v-avatar>
          <img src="https://unsplash.it/200" alt="OW">
        </v-avatar>
        Dark Souls
      </v-chip>

      <v-chip class="grey darken-2 white--text">
        <v-avatar>
          <img src="https://unsplash.it/201" alt="OW">
        </v-avatar>
        Clash Of Clans
      </v-chip>

      <v-chip class="grey darken-2 white--text">
        <v-avatar>
          <img src="https://unsplash.it/202" alt="OW">
        </v-avatar>
        Euro Truck Simulator
      </v-chip>

      <v-chip class="grey darken-2 white--text">
        <v-avatar>
          <img src="https://unsplash.it/203" alt="OW">
        </v-avatar>
        Kalfon Simulator
      </v-chip>

      <v-chip class="grey darken-2 white--text">
        <v-avatar>
          <img src="https://unsplash.it/204" alt="OW">
        </v-avatar>
        Swag Swag 4
      </v-chip>

    </p>



    <v-divider></v-divider>
    <v-container fluid>
      <v-layout row wrap>
        <v-flex xs12 md2>
          <v-list>
            <v-list-tile avatar>
              <v-list-tile-avatar>
                <img src="https://vignette3.wikia.nocookie.net/overwatch/images/d/d9/Overwatch_Logo.png/revision/latest?cb=20160519093518&path-prefix=fr" />
              </v-list-tile-avatar>
              <v-list-tile-title>
                Overwatch
              </v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-flex>
        <v-flex xs12 md10>

          Général
          <ul>
            <li>Correction d’un problème qui empêchait les statistiques « Maximum en une partie » d’être mises à jour.</li>
            <li>Correction d’un problème relatif à l’interface utilisateur, qui pouvait indiquer qu’un joueur adverse avait été touché après lui être rentré dedans.</li>
            <li>Correction d’un problème qui pouvait permettre aux projectiles capables de transpercer les boucliers (comme la Frappe de feu de Reinhardt) de traverser d’autres surfaces.</li>
            <li>Correction d’un problème qui entraînait des coupures de son pour certains joueurs durant les parties.</li>
          </ul>
          Partie compétitive
          <ul>

            <li>Correction d’un problème qui appliquait des pénalités de désertion aux joueurs pendant les parties hors saison, même après l’apparition du message signalant qu’il était possible de quitter la partie sans pénalité.</li>
          </ul>
          Parties personnalisées et navigateur de parties
          <ul>
            <li>Correction d’un problème qui empêchait de rejoindre des parties personnalisées en tant que joueur lorsque le nombre de spectateurs était fixé à 12.</li>
            <li>Correction d’un problème qui supprimait le modificateur « Soins prodigués » pour Mei, Faucheur et Chopper dans les paramètres des parties personnalisées.</li>
          </ul>
          Héros
          <ul>
            <li>Correction d’un problème qui rendait D.Va visible à l’intérieur du cockpit du MÉCA avant l’exécution de l’animation Appel du méca.</li>
            <li>Correction d’un problème qui pouvait entraîner une classification erronée des éliminations de Chacal causées par Mauvais perdant dans le journal d’action.</li>
            <li>Correction d’un problème qui déclenchait l’annonce de la capacité ultime de Chacal même lorsqu’il ne pouvait pas l’utiliser.</li>
            <li>Correction d’un problème qui permettait au Traquelard de Chopper de s’accrocher au Surchargeur d’Orisa.</li>
            <li>Correction d’un problème à cause duquel Sombra pouvait subir des dégâts après l’activation de son Transducteur.</li>
          </ul>
        </v-flex>
      </v-layout>
    </v-container>
  </v-container>
</template>

<script>
  export default {
    name: 'home2'
  }
</script>
