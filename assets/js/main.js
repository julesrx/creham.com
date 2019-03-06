'use strict';

import Vue from 'vue';
import axios from 'axios';

Vue.prototype.$http = axios;

const app = new Vue({
  el: '#container',
  delimiters: ['[[', ']]'],
  data() {
    return {
      title: 'Creham'
    }
  }
});
