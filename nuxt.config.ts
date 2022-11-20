export default defineNuxtConfig({
  modules: ['@nuxt/content', '@nuxt/image-edge'],
  css: ['@fontsource/cabin', '/assets/css/main.scss'],
  content: { documentDriven: true },
  typescript: { typeCheck: true, strict: true }
});
