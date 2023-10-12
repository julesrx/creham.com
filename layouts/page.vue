<script setup lang="ts">
const config = useAppConfig();

const navLinks = await useNavLinks();

const page = await useCurrentPage();
const path = computed(() => page.value?._path ?? '');
const image = computed<string | undefined>(() => page.value?.image);
</script>

<template>
  <header class="page">
    <NuxtLink to="/">
      <NuxtImg src="/img/creham.gif" :alt="config.title" class="logo" height="110" />
    </NuxtLink>

    <Slider />
  </header>

  <nav class="page">
    <div class="links">
      <NuxtLink v-for="link in navLinks" :to="link._path" activeClass="couleur" :title="link.title">
        {{ link.title }}
      </NuxtLink>
    </div>

    <Nav />
  </nav>

  <article class="content">
    <div :class="['info', 'page-' + path.replace('/', '')]">
      <slot />
    </div>

    <div class="print">
      <span class="print-button" onclick="window.print()">
        <NuxtImg src="/img/icons/print.png" alt="Imprimer" class="icon" />
        <span>Imprimer la page</span>
      </span>
      <hr />

      <div class="clearfix">
        <NuxtImg src="/img/virgule.png" alt="Virgule" class="virgule" />
      </div>

      <NuxtImg v-if="image" :src="'/img/pages/' + image" class="page-image" />
    </div>
  </article>

  <footer>
    <NuxtLink to="/mentions-legales" title="Mentions légales" class="mentions mr-0">
      Mentions légales
    </NuxtLink>
  </footer>
</template>
