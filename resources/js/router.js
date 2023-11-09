// router.js
import { createRouter, createWebHashHistory } from 'vue-router';
import store from './store.js';

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: '/',
      component: () => import('./components/login.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/home',
      component: () => import('./components/home/home.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/explore',
      component: () => import('./components/explore/explore.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/trends',
      component: () => import('./components/trends/trends.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/people',
      component: () => import('./components/who-to-follow/people.vue'),
      meta: { requiresAuth: false },
    },

    {
     path: '/notifications',
     component: () => import('./components/notifications/notifications.vue'),
     meta: { requiresAuth: false },
    },

    {
      path: '/tweet/:tweetID',
      component: () => import('./components/tweet/tweet.vue'),
      name: 'tweet',
      meta: { requiresAuth: false },
    },
    {
      path: '/profile/:UserTag',
      component: () => import('./components/user/user.vue'),
      name: 'profile',
      meta: { requiresAuth: false },
    },
    {
      path: '/bookmarks',
      component: () => import('./components/bookmarks/bookmarks.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/messages',
      component: () => import('./components/messages/messages.vue'),
      meta: { requiresAuth: false },
    },
    {
      path: '/:UserTag/following',
      component: () => import('./components/following/following.vue'),
      name: 'following',
      meta: { requiresAuth: false },
    },
    {
      path: '/:UserTag/followers',
      component: () => import('./components/followers/followers.vue'),
      name: 'followers',
      meta: { requiresAuth: false },
    },
  ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user) {
      next('/');
    } else {
      next();
    }
});

export default router;
