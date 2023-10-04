<template>
    <div>
        <router-link to="/">
            <div>
                Go login
            </div>
        </router-link>
        <router-link to="/home">
            <div>
                Go Homepage
            </div>
        </router-link>
        <button @click="goToExample">Go Example</button>
    </div>
    <router-view />
</template>

<script>
export default {
  name: 'App',
  data: () => ({
    showCreateAccount: false,
  }),
  methods: {
    goToExample(){
        this.$router.push('/example');
    }
  },
};

</script>