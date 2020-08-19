import './bootstrap';

import Vue from 'vue';
import VueMeta from 'vue-meta';
import { InertiaApp } from '@inertiajs/inertia-vue'

Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(InertiaApp)
Vue.use(VueMeta);

let app = document.getElementById('app')

new Vue({
  metaInfo: {
    titleTemplate: (title) => title ? `${title} - URL Shortener` : 'URL Shortener'
  },
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => import(`@/Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(app)
