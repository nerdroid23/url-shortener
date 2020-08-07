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
    component: () => import(/* webpackChunkName: "login" */ './pages/auth/Login'),
    meta: {
      middleware: 'guest'
    }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import(/* webpackChunkName: "register" */ './pages/auth/Register'),
    meta: {
      middleware: 'guest'
    }
  },
  {
    path: '/password/email',
    name: 'forgot-password',
    component: () => import(/* webpackChunkName: "forgot-password" */ './pages/auth/ForgotPassword'),
    meta: {
      middleware: 'guest'
    }
  },
  {
    path: '/password/reset',
    name: 'reset-password',
    component: () => import(/* webpackChunkName: "reset-password" */ './pages/auth/ResetPassword'),
    meta: {
      middleware: 'guest'
    }
  },
];

const router = new VueRouter({
  mode: 'history',
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
