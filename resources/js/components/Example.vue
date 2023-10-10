<template>
    <div>
      <h1 style="color: white">Welcome, {{ loggedInUser.name }}</h1>
      <p style="color: white">Email: {{ loggedInUser.email }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        loggedInUser: {},
      };
    },
    mounted() {
      // Assuming you have a user ID available after login (replace with your actual user ID)
      const userId = 1; // Replace with the actual user ID
      axios.get(`/api/users/${userId}`) // Replace with your API endpoint
        .then((response) => {
          this.loggedInUser = response.data.user; // Assuming your API returns user data under "user" key
        })
        .catch((error) => {
          console.error('Error fetching user data:', error);
        });
    },
  };
  </script>