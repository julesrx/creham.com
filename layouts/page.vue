<script setup lang="ts">
const config = useAppConfig();
const { page } = useContent();
const navLinks = await useNavLinks();
</script>

<template>
  <header class="page">
    <NuxtLink to="/">
      <img src="/img/creham.gif" :alt="config.title" class="logo" />
    </NuxtLink>

    <Slider />
  </header>

  <nav class="page">
    <div class="links">
      <NuxtLink v-for="link in navLinks" :to="link._path" activeClass="couleur" :title="link.title">
        {{ link.title }}
      </NuxtLink>
    </div>
  </nav>

  <article class="content">
    <div :class="['info', 'page-' + page._path.replace('/', '')]">
      <slot />
    </div>

    <div class="print">
      <span class="print-button" onclick="window.print()">
        <img src="/img/icons/print.png" alt="Imprimer" class="icon" />
        <span>Imprimer la page</span>
      </span>
      <hr />

      <div class="clearfix">
        <img src="/img/virgule.png" alt="Virgule" class="virgule" />
      </div>

      <img v-if="page.image" :src="'/img/pages/' + page.image" class="page-image" />
    </div>
  </article>

  <footer>
    <NuxtLink to="/mentions-legales" title="Mentions légales" class="mentions mr-0">
      Mentions légales
    </NuxtLink>
  </footer>
</template>
