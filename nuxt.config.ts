export default defineNuxtConfig({
  modules: ['@nuxt/content'],
  css: ['@fontsource/cabin', '/assets/css/main.scss'],
  content: { documentDriven: true },
  typescript: { typeCheck: true, strict: true }
});
