<template>
    <div class="container">
        <div class="button_div" v-if="isLoggedIn">
            <router-link to="/">
                <button class="home_button" @click="logout">Logout</button>
            </router-link>
        </div>
        <div class="button_div" v-else>
            <router-link to="/home">Home</router-link>
            <router-link to="example">Example</router-link>
            <router-link to="/">Login/Register</router-link>
        </div>
        <router-vie></router-vie>
    </div>
</template>
<script>
import { RouterLink } from 'vue-router';
export default{
    name: 'Login',
    data() {
        return {
            isLoggedIn: false
        }
    },
    created() {
        if (window.Laravel.isLoggedIn){
            this.isLoggedIn=true
        }
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
    }
}
</script>