<template>
    <!-- <div>
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
    </div> -->
    <router-view />
</template>

<script>
export default {
  name: 'App',
  data: () => ({
    showCreateAccount: false,
    isLoggedIn: false
  }),
  methods: {
    goToExample(){
        this.$router.push('/test');
    },
    created() {
        if (window.Laravel.isLoggedIn){
            this.isLoggedIn=true
        }
    },
    
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