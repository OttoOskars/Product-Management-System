<template>
    <div class="followers">
<!--         <div class="navbar">
            <NavBar></NavBar>
        </div> -->
        <div class="content">
            <Followers></Followers>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Followers from './followers_content.vue';
import Search from '../home/search.vue';
export default {
  name: 'following',
  components: {
    NavBar,
    Followers,
    Search,
  },
  data() {
    return {
        
    }
  }
}
</script>
<style lang="scss" scoped>
.followers{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;
}
</style>