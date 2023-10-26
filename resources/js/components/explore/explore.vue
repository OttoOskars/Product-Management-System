<template>
    <div class="explore">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="explore_content">
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
.navbar{
    width: 3/12*100%;

}
.search{
    height: 100%;
    width:4/12*100%;

}
.explore_content{
    height:100%;
    width:5/12*100%;

}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .search{
        width:4/12*100%
    }
    .explore_content{
        flex-grow: 1;
    }
}
@media (max-width: 1000px) {
    .navbar{
        width:100px;
    }
    .search{
        display:none;
    }
    .explore_content{
        flex-grow: 1;
    }
}
@media (max-width: 500px) {
    .navbar{
        width:100%;
        position:fixed;
        bottom:0;
        z-index:99;
    }
    .search{
        display:none;
    }
    .explore_content{
        width:100%
    }
}

</style>