import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);
const routes = [
  {
    path: '/',
    name: 'dashboard',
    component: () => import(/* webpackChunkName: "index" */ './pages/Index'),
    meta: {
      middleware: 'auth'
    }
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ './pages/Login'),
    meta: {
      middleware: 'guest'
    }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import(/* webpackChunkName: "register" */ './pages/Register'),
    meta: {
      middleware: 'guest'
    }
  },
];

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'border-indigo-500 text-gray-900 focus:outline-none focus:border-indigo-700',
  routes
})

router.beforeEach((to, from, next) => {
  const middleware = to.meta.middleware;

  if (!window.loggedIn && middleware === 'auth') {
    next({ name: 'login' });
    return;
  }

  if (window.loggedIn && middleware === 'guest') {
    next({ name: 'dashboard' });
    return;
  }

  next();
});

export default router;
