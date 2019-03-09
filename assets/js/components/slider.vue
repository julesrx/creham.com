<template>
  <div class="slider">
    <img
      v-for="slider in sliders"
      :key="slider.id"
      :src="'/assets/img/slider/' + slider.img + '.jpg'"
      :alt="slider.alt"
      :style="slider.id !== current ? 'display: none' : ''"
    >
  </div>
</template>

<script>
export default {
  props: ["sliders"],
  data() {
    return {
      current: this.sliders[0].id
    };
  },
  created() {
    setInterval(() => {
      if (this.current == this.sliders[this.sliders.length - 1].id) {
        this.current = this.sliders[0].id;
      } else {
        let index = this.sliders.indexOf(
          this.sliders.find(s => {
            return s.id == this.current;
          })
        );
        this.current = this.sliders[index + 1].id;
      }
    }, 2500);
  }
};
</script>

<style lang="scss" scoped>
img {
  color: #000;
}
</style>
