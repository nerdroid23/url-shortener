import './bootstrap';
import Vue from 'vue';
import Main from './Main';


Vue.component('app-component', Main);

new Vue({
  el: '#app',
});
