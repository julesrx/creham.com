<script setup lang="ts">
const config = useAppConfig();
</script>

<template>
  <u><a :href="'mailto:' + config.email">Nous envoyer un message</a></u>
</template>
