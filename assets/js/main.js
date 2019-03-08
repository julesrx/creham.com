'use strict';
// const fs = require('fs');

import Vue from 'vue';
import axios from 'axios';

import SliderComponent from './components/slider.vue';

Vue.prototype.$http = axios;

Vue.component('slider', SliderComponent);

const app = new Vue({
  el: '#container',
  delimiters: ['[[', ']]'],
  data() {
    return {
      sliders: [
        { id: '1', img: '1-urbaniste', alt: 'Urbaniste' },
        { id: '2', img: '2-architecte', alt: 'Architecte' },
        { id: '3', img: '3-paysagiste', alt: 'Paysagiste' },
        { id: '4', img: '4-psychosociologue', alt: 'Psychosociologue' },
        { id: '5', img: '5-socioeconomiste', alt: 'Socioéconomiste' },
        { id: '6', img: '6-geographe', alt: 'Géographe' },
      ]
    }
  },
  created() {
    // fs.readdir(__dirname + '/assets/img/slider', (err, items) => {
    //   console.log(items);

    //   for (var i = 0; i < items.length; i++) {
    //     console.log(items[i]);
    //   }
    // });
  },
  methods: {}
});
