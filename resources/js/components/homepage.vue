<template>
    <login @create-account="toggleShowAccount"></login>
    <account v-if="showCreateAccount" @close-page="toggleShowAccount"></account>
    
    </template>
    
<script>
import Login from './login.vue';
import Account from './create_account.vue';
export default {
    name: 'Home',
    components: {
        Login,
        Account
    },
    data: () => ({
    showCreateAccount: false,
    }),
    methods: {
    toggleShowAccount(){
        this.showCreateAccount = !this.showCreateAccount
    },
    },
};

</script>