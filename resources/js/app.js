import './bootstrap';

import Vue from 'vue';
import VueMeta from 'vue-meta';
import router from './router';

import route from 'ziggy';
import { Ziggy } from './ziggy';

import Main from './Main';

Vue.use(VueMeta);

Vue.mixin({
  methods: {
    route: (name, params, absolute) => route(name, params, absolute, Ziggy),
  },
});

Vue.component('app-component', Main);

new Vue({
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - URL Shortener` : 'URL Shortener'
  },
  router
}).$mount('#app');
