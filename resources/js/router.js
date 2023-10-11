// router.js
import { createRouter, createWebHashHistory } from 'vue-router';
import store from './store.js';

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: '/',
      component: () => import('./components/Login.vue'),
      meta: { requiresAuth: false }, // Public route
    },
    {
      path: '/home',
      component: () => import('./components/homepage.vue'),
      meta: { requiresAuth: true }, // Protected route
    },
    // ...other routes
  ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user) {
      // If the route requires authentication and the user is not logged in, redirect to the login page
      next('/');
    } else {
      next();
    }
});

export default router;