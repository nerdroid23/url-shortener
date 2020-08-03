import './bootstrap';
import Vue from 'vue';
import Main from './Main';
import VueMeta from 'vue-meta';
import route from 'ziggy';
import { Ziggy } from './ziggy';

Vue.component('app-component', Main);
Vue.use(VueMeta);
Vue.mixin({
  methods: {
    route: (name, params, absolute) => route(name, params, absolute, Ziggy),
  },
});

new Vue({
  el: '#app',
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - URL Shortener` : 'URL Shortener'
  },
});
