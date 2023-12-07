<template>
    <div class="explore">
<!--         <div class="navbar">
            <NavBar></NavBar>
        </div> -->
        <div class="content">
            <Explore></Explore>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Explore from './explore_content.vue';
import Search from './explore_search.vue';
import Popup from '../Popup.vue';
export default {
  name: 'explore',
  components: {
    NavBar,
    Explore,
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
.explore{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;

}
</style>