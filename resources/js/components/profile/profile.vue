<template>
    <div class="profile">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="profile-info">
            <Profile></Profile>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Profile from './profile_content.vue';
import Search from '../home/search.vue';
import Popup from '../Popup.vue';
export default {
  name: 'profile',
  components: {
    NavBar,
    Profile,
    Search,
    Popup,
  },
  data() {
    return {
        
    }
  }
}
</script>
<style lang="scss" scoped>
.profile{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;
}
.navbar{
    width: 3/12*100%;
}
.search{
    min-height:100%;
    width:4/12*100%;
}
.profile-info{
    min-height:100%;
    width:5/12*100%;
}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .profile-info{
        width:7/12*100%
    }
    .search{
        width:4/12*100%
    }
}

@media (max-width: 1000px) {
    .navbar{
        width:100px;
    }
    .profile-info{
        width:11/12*100%
    }
    .search{
        display:none;
    }
}

@media (max-width: 500px) {
    .navbar{
        width:100%;
        position:fixed;
        bottom:0;
        z-index:9999;
    }
    .profile-info{
        width:100%
    }
    .search{
        display:none;
    }
}

</style>