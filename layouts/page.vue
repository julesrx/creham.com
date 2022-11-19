<script setup lang="ts">
const config = useAppConfig();
const content = useContent();

const { data: navLinks } = await useAsyncData('page-nav', () =>
  fetchContentNavigation(queryContent('/').where({ navigation: true }).sort({ order: 1 }))
);
</script>

<template>
  <header class="page">
    <NuxtLink to="/">
      <img src="~/assets/img/creham.gif" :alt="config.title" class="logo" />
    </NuxtLink>

    <p class="sub-title slider-text">
      <span>urbanist<span class="e">e</span></span>
      <span>archit<span class="e">e</span>cte</span>
      <span>paysagist<span class="e">e</span></span>
      <span>psychosociologu<span class="e">e</span></span>
      <span>socio<span class="e">é</span>conomiste</span>
      <span>g<span class="e">é</span>ographe</span>
    </p>

    <!-- <div id="slider">
      <div class="mask">
        {% assign sliders = site.static_files | where: "slider", true %}
        {% for slider in sliders %}
          <img src="{{- slider.path -}}" alt="{{- file.basename -}}" class="slider-img">
        {% endfor %}
      </div>
    </div> -->
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
        <img src="~/assets/img/icons/print.png" alt="Imprimer" class="icon" />
        <span>Imprimer la page</span>
      </span>
      <hr />

      <div class="clearfix">
        <img src="~/assets/img/virgule.png" alt="Virgule" class="virgule" />
      </div>

      <!-- TODO: fix, not getting content.page.image -->
      <img
        v-if="content.page.image"
        :src="'~/assets/img/' + content.page.image"
        class="page-image"
      />
    </div>
  </article>

  <footer>
    <a href="mentions-legales" title="Mentions légales" class="mentions mr-0">Mentions légales</a>
  </footer>
</template>
