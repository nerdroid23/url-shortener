import './bootstrap';
import Vue from 'vue';
import Main from './Main';
import VueMeta from 'vue-meta';


Vue.component('app-component', Main);

Vue.use(VueMeta);

new Vue({
  el: '#app',
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - URL Shortener` : 'URL Shortener'
  },
});
