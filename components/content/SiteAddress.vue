<script setup lang="ts">
const config = useAppConfig();
</script>

<template>
  <span>{{ config.street }}, {{ config.zip }} {{ config.city }}</span>
</template>
