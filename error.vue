<script setup lang="ts">
const handleError = () => clearError({ redirect: '/' });
</script>

<template>
  <div class="not-found">
    <h1>404</h1>

    <p><strong>Cette page n'existe pas :(</strong></p>
    <p>La page ou ressource que vous avez demandé est introuvable.</p>
    <p class="couleur">
      <NuxtLink to="/" @click.prevent="handleError">retour à l'accueil</NuxtLink>
    </p>
  </div>
</template>
