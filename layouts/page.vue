<script setup lang="ts">
const config = useAppConfig();
const content = useContent();

const sliders = [
  '1-urbaniste.jpg',
  '2-architecte.jpg',
  '3-paysagiste.jpg',
  '4-psychosociologue.jpg',
  '5-socioeconomiste.jpg',
  '6-geographe.jpg'
];

const getImageBaseName = (src: string) => src.replace(/\d-/, '').replace('.jpg', '');

const { data: navLinks } = await useAsyncData('page-nav', () =>
  fetchContentNavigation(queryContent('/').where({ navigation: true }).sort({ order: 1 }))
);
</script>

<template>
  <header class="page">
    <NuxtLink to="/">
      <nuxt-img src="/img/creham.gif" :alt="config.title" class="logo" />
    </NuxtLink>

    <p class="sub-title slider-text">
      <span>urbanist<span class="e">e</span></span>
      <span>archit<span class="e">e</span>cte</span>
      <span>paysagist<span class="e">e</span></span>
      <span>psychosociologu<span class="e">e</span></span>
      <span>socio<span class="e">é</span>conomiste</span>
      <span>g<span class="e">é</span>ographe</span>
    </p>

    <div id="slider">
      <div id="mask">
        <nuxt-img
          v-for="s in sliders"
          :src="'/img/slider/' + s"
          :alt="getImageBaseName(s)"
          class="slider-img"
        />
      </div>
    </div>
  </header>

  <nav class="page">
    <div class="links">
      <NuxtLink v-for="link in navLinks" :to="link._path" activeClass="couleur" :title="link.title">
        {{ link.title }}
      </NuxtLink>
    </div>
  </nav>

  <article class="content">
    <div class="info page-{{- page.permalink -}}">
      <slot />
    </div>

    <div class="print">
      <span class="print-button" onclick="window.print()">
        <nuxt-img src="/img/icons/print.png" alt="Imprimer" class="icon" />
        <span>Imprimer la page</span>
      </span>
      <hr />

      <div class="clearfix">
        <nuxt-img src="/img/virgule.png" alt="Virgule" class="virgule" />
      </div>

      <!-- TODO: fix, not getting content.page.image -->
      <nuxt-img v-if="content.page.image" :src="'/img/' + content.page.image" class="page-image" />
    </div>
  </article>

  <footer>
    <a href="mentions-legales" title="Mentions légales" class="mentions mr-0">Mentions légales</a>
  </footer>
</template>
