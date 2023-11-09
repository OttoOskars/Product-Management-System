// router.js
import { createRouter, createWebHashHistory } from 'vue-router';
import store from './store.js';

const checkAuth = () => {
  const token = localStorage.getItem('user_token');
  return Boolean(token);
};

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: '/',
      component: () => import('./components/login.vue'),
      meta: { requiresAuth: false },
      beforeEnter: (to, from, next) => {
        if (checkAuth()) {
          next('/home');
        } else {
          next();
        }
      },
    },
    {
      path: '/home',
      component: () => import('./components/home/home.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/explore',
      component: () => import('./components/explore/explore.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/trends',
      component: () => import('./components/trends/trends.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/people',
      component: () => import('./components/who-to-follow/people.vue'),
      meta: { requiresAuth: true },
    },

    {
     path: '/notifications',
     component: () => import('./components/notifications/notifications.vue'),
     meta: { requiresAuth: true },
    },

    {
      path: '/tweet/:tweetID',
      component: () => import('./components/tweet/tweet.vue'),
      name: 'tweet',
      meta: { requiresAuth: true },
    },
    {
      path: '/profile/:UserTag',
      component: () => import('./components/user/user.vue'),
      name: 'profile',
      meta: { requiresAuth: true },
    },
    {
      path: '/bookmarks',
      component: () => import('./components/bookmarks/bookmarks.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/messages',
      component: () => import('./components/messages/messages.vue'),
      meta: { requiresAuth: true },
    },
    {
      path: '/:UserTag/following',
      component: () => import('./components/following/following.vue'),
      name: 'following',
      meta: { requiresAuth: true },
    },
    {
      path: '/:UserTag/followers',
      component: () => import('./components/followers/followers.vue'),
      name: 'followers',
      meta: { requiresAuth: true },
    },
  ],
});

// Navigation guard
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    if (checkAuth()) {
      next();
    } else {
      next('/');
    }
  } else {
    next();
  }
});

export default router;
