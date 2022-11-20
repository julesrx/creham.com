<script setup lang="ts">
type Slider = {
  index: number;
  position: number;
  moving: boolean;
  img: string;
};

const sliders = ref<Slider[]>([
  { index: 0, position: 0, moving: false, img: '1-urbaniste.jpg' },
  { index: 1, position: 1, moving: false, img: '2-architecte.jpg' },
  { index: 2, position: 2, moving: false, img: '3-paysagiste.jpg' },
  { index: 3, position: 3, moving: false, img: '4-psychosociologue.jpg' },
  { index: 4, position: 4, moving: false, img: '5-socioeconomiste.jpg' },
  { index: 5, position: 5, moving: false, img: '6-geographe.jpg' }
]);
const orderedSliders = computed(() => sliders.value.sort((a, b) => a.position - b.position));

const text = ref<HTMLParagraphElement>();

let interval: NodeJS.Timer;
let timeout: NodeJS.Timeout;

onMounted(() => {
  interval = setInterval(() => {
    const current = orderedSliders.value[0];
    const after = orderedSliders.value[1];

    current.moving = true;
    after.moving = true;

    timeout = setTimeout(() => {
      for (const s of sliders.value) {
        if (s.position === 0) s.position = sliders.value.length - 1;
        else s.position = s.position - 1;
      }

      current.moving = false;
      after.moving = false;

      const texts = text.value!.querySelectorAll('span:not(.e)');
      for (const t of texts) {
        t.classList.remove('couleur');
      }
    }, 600);
  }, 3000);
});

onUnmounted(() => {
  clearInterval(interval);
  clearTimeout(timeout);
});

const getImageBaseName = (src: string) => src.replace(/\d-/, '').replace('.jpg', '');
</script>

<template>
  <p class="sub-title slider-text" ref="text">
    <span class="couleur">urbanist<span class="e">e</span></span>
    <span>archit<span class="e">e</span>cte</span>
    <span>paysagist<span class="e">e</span></span>
    <span>psychosociologu<span class="e">e</span></span>
    <span>socio<span class="e">é</span>conomiste</span>
    <span>g<span class="e">é</span>ographe</span>
  </p>

  <div id="slider">
    <div id="mask">
      <nuxt-img
        v-for="s in orderedSliders"
        :key="s.img"
        :src="'/img/slider/' + s.img"
        :alt="getImageBaseName(s.img)"
        :class="{ 'slider-img': true, moving: s.moving }"
      />
    </div>
  </div>
</template>
