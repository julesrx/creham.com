export default defineNuxtConfig({
  modules: ['@nuxt/content', '@nuxt/image'],
  css: ['@fontsource-variable/cabin/index.css', '/assets/css/main.scss'],
  content: { documentDriven: true },
  typescript: { typeCheck: true, strict: true },
  nitro: { prerender: { routes: ['/sitemap.xml'] } }
});
