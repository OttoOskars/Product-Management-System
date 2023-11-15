<template>
    <div class="following">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="content">
            <Following></Following>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Following from './following_content.vue';
import Search from '../home/search.vue';
export default {
  name: 'following',
  components: {
    NavBar,
    Following,
    Search,
  },
  data() {
    return {
        
    }
  }
}
</script>
<style lang="scss" scoped>
.following{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;
}
</style>