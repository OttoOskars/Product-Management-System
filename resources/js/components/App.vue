<template>
    <router-view />
</template>

<script>
import router from '../router';
import store from '../store';
export default {
    name: 'App',
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