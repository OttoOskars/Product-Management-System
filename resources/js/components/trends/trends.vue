<template>
    <div class="trends">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="explore_trends">
            <Trends></Trends>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Trends from './trends_content.vue';
import Search from './people_sidebar.vue';
import Popup from '../Popup.vue';
export default {
  name: 'explore',
  components: {
    NavBar,
    Trends,
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
.trends{
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
    min-height: 100%;
    width:4/12*100%;

}
.explore_trends{
    min-height:100%;
    width:5/12*100%;

}

</style>