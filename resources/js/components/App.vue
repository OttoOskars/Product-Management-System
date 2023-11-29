<template>
    <div class="app">
        <div class="navbar" v-if = "this.$route.name != 'login'">
            <NavBar></NavBar>
        </div>
        <div class="content">
            <router-view />
        </div>
    </div>
</template>
<script>
import NavBar from './nav-bar.vue';
import router from '../router';
import store from '../store';
export default {
    name: 'App',
    components: {
        NavBar
    },
    data: () => ({
    }),
    setup() {
    },
    created() {
    },
    methods: {
        logout(e){
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                .then(response => {
                    if (response.data.success){
                        window.location.href = '/'
                    } else {
                        console.log(response);
                    }
                })
                .catch(function (error){
                    console.log(error);
                })
            })
        }
    },
};
</script>

<style lang="scss" scoped>
.app {
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display: flex;
    flex-direction: row;
    box-sizing: border-box;
}
</style>