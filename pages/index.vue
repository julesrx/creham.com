<template>
  <header class="home">
    <div class="title">
      <NuxtLink to="/" title="Accueil">
        <img class="logo" src="~/assets/img/creham.gif" alt="Creham" />
      </NuxtLink>

      <h2 class="slogan">une équipe pluridisciplinaire</h2>
    </div>

    <p class="sub-title">Urbanisme, paysage, sociologie et développement local</p>
    <img src="~/assets/img/home.jpg" alt="Accueil" class="deco" />
    <p class="sub-title text-grey">
      Etude, conseil, assistance à maîtrise d'ouvrage et maîtrise d'oeuvre
    </p>
  </header>

  <nav class="home">
    <div class="home-container">
      <img src="~/assets/img/virgule.png" alt="Virgule" class="virgule" />

      <!-- <ul>
        {% assign ps = site.pages | sort: 'order' %} {% for p in ps %} {% if p.navigation %}
        <li>
          <a href="{{- p.permalink -}}" title="{{- p.title -}}">{{ p.title }}</a>
        </li>
        {% endif %} {% endfor %}
      </ul> -->

      <!-- <a href="{{- site.featured_link -}}" target="_blank" class="featured" rel="noopener">
        {{- site.featured_html -}}
      </a> -->
    </div>
  </nav>

  <footer>
    {% include link-nav.html %}

    <a href="mentions-legales" title="Mentions légales" class="mentions">Mentions légales</a>
  </footer>
</template>
