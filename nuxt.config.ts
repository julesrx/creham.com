export default defineNuxtConfig({
  modules: ['@nuxt/content', '@nuxt/image-edge'],
  content: { documentDriven: true },
  css: ['@fontsource/cabin', '@/assets/css/main.scss']
});
