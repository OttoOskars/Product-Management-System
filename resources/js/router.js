// router.js
import { createRouter, createWebHashHistory } from 'vue-router';
import store from './store.js';

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: '/',
      component: () => import('./components/login.vue'),
      meta: { requiresAuth: false }, // Public route
    },
    {
      path: '/test',
      component: () => import('./components/test.vue'),
      meta: { requiresAuth: false }, // Public route
    },
    {
      path: '/home2',
      component: () => import('./components/home/home.vue'),
      meta: { requiresAuth: true }, // Public route
    },
    {
      path: '/explore',
      component: () => import('./components/explore/explore.vue'),
      meta: { requiresAuth: true }, // Public route
    },
    {
      path: '/trends',
      component: () => import('./components/trends/trends.vue'),
      meta: { requiresAuth: true }, // Public route
    },
    {
      path: '/people',
      component: () => import('./components/who-to-follow/people.vue'),
      meta: { requiresAuth: true }, // Public route
    },
    {
      path: '/home',
      component: () => import('./components/homepage.vue'),
      meta: { requiresAuth: true }, // Protected route
    },

    {
     path: '/notifications',
     component: () => import('./components/notifications/notifications.vue'),
     meta: { requiresAuth: true }, // Public route
    },

    {
      path: '/tweet/:tweetID',
      component: () => import('./components/tweet/tweet.vue'),
      name: 'tweet',
      meta: { requiresAuth: true }, // Protected route (if required)
    },
/*     {
      path: '/profile/:UserTag',
      component: () => import('./components/profile/profile.vue'),
      name: 'profile',
      meta: { requiresAuth: false }, // Protected route (if required)
      beforeRouteUpdate(to, from, next) {
        // This hook will be called when the route parameters change
        location.reload(); // This triggers a hard page refresh
      },
    }, */
    {
      path: '/profile/:UserTag',
      component: () => import('./components/user/user.vue'),
      name: 'profile',
      meta: { requiresAuth: true }, // Protected route (if required)
      beforeRouteUpdate(to, from, next) {
        // This hook will be called when the route parameters change
        location.reload(); // This triggers a hard page refresh
      },
    },
    {
      path: '/bookmarks',
      component: () => import('./components/bookmarks/bookmarks.vue'),
      meta: { requiresAuth: true }, // Public route
    },
    {
        path: '/messages',
        component: () => import('./components/messages/messages.vue'),
        meta: { requiresAuth: true }, // Public route
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
