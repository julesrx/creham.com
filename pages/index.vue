<script setup lang="ts">
const config = useAppConfig();
const navLinks = await useNavLinks();
</script>

<template>
  <Head>
    <Title>{{ config.short_description }}</Title>
  </Head>

  <header class="home">
    <div class="title">
      <NuxtLink to="/" title="Accueil">
        <NuxtImg class="logo" src="/img/creham.gif" alt="Creham" height="136" />
      </NuxtLink>

      <h2 class="slogan">une équipe pluridisciplinaire</h2>
    </div>

    <p class="sub-title">Urbanisme, paysage, sociologie et développement local</p>
    <NuxtImg src="/img/home.jpg" alt="Accueil" class="deco" />
    <p class="sub-title text-grey">
      Etude, conseil, assistance à maîtrise d'ouvrage et maîtrise d'oeuvre
    </p>
  </header>

  <nav class="home">
    <div class="home-container">
      <NuxtImg src="/img/virgule.png" alt="Virgule" class="virgule" />

      <ul>
        <li v-for="link in navLinks">
          <NuxtLink :to="link._path" :title="link.title">{{ link.title }}</NuxtLink>
        </li>
      </ul>

      <NuxtLink
        v-if="config.featured.show"
        :to="config.featured.link"
        target="_blank"
        class="featured"
        v-html="config.featured.html"
      >
      </NuxtLink>
    </div>
  </nav>

  <footer>
    <Nav />

    <NuxtLink to="/mentions-legales" title="Mentions légales" class="mentions">
      Mentions légales
    </NuxtLink>
  </footer>
</template>
