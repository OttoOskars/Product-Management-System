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
    min-height:100%;
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

</style>