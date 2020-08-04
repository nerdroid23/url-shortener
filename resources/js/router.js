import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);
const routes = [
  { path: '/', component: () => import(/* webpackChunkName: "index" */ './pages/Index') },
  { path: '/login', name: 'login', component: () => import(/* webpackChunkName: "login" */ './pages/Login') },
  { path: '/register', name: 'register', component: () => import(/* webpackChunkName: "register" */ './pages/Register') },
];

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'border-indigo-500 text-gray-900 focus:outline-none focus:border-indigo-700',
  routes
})

export default router;
