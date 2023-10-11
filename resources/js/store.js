// store/index.js
import { createStore } from 'vuex';
import axios from 'axios';


const store = createStore({
  state: {
    user: null, // This will store user information
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
      state.isLoggedIn = !!user;
    },
  },
  actions: {
    async login({ commit }, { Email, Password }) {
      console.log('Login action called');
      try {
        // Make an API request to your Laravel backend to authenticate the user
        const response = await axios.post('/api/login', {
          Email,
          Password,
        });
  
        if (response.data.success) {
          // Commit the user mutation to set the user in the store
          commit('setUser', response.data.user);
          return response.data; // Return the response data
        } else {
          throw new Error('Invalid password.');
        }
      } catch (error) {
        // Handle login error (e.g., show error message)
        throw error;
      }
    },

    async logout({ commit }) {
      try {
        // Make an API request to your Laravel backend to log the user out
        const response = await axios.post('/api/logout');

        if (response.data.success) {
          // Commit the user mutation to clear the user in the store
          commit('setUser', null);
        } else {
          throw new Error('An error occurred while logging out.');
        }
      } catch (error) {
        // Handle logout error (e.g., show error message)
        throw error;
      }
    },
  },
});

export default store;