<script setup lang="ts">
const config = useAppConfig();
const { page } = useContent();

const url = computed(() => {
  if (!page.value || !page.value._path) return config.url;
  return config.url + page.value._path;
});
</script>

<template>
  <Html lang="fr" />

  <Head>
    <Meta charset="UTF-8" />
    <Meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <Meta name="title" :content="config.title" />
    <Meta name="description" :content="config.description" />
    <Meta name="theme-color" :content="'#' + config.color" />

    <!-- Twitter -->
    <Meta name="twitter:card" content="summary" />
    <Meta name="twitter:title" :content="config.title" />
    <Meta name="twitter:description" :content="config.description" />
    <Meta name="twitter:image" :content="config.url + '/img/thumbnail.png'" />

    <!-- Open Graph / Facebook -->
    <Meta property="og:title" :content="config.title" />
    <Meta property="og:type" content="website" />
    <Meta property="og:image" :content="config.url + '/img/thumbnail.png'" />
    <Meta property="og:url" :content="url" />
    <Meta property="og:description" :content="config.description" />
    <Meta property="og:locale" content="fr_FR" />
    <Meta property="og:email" :content="config.email" />

    <Link rel="canonical" :href="config.url" />
    <Link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <Link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
  </Head>

  <main id="container">
    <NuxtPage />
  </main>
</template>
