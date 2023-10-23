<template>
    <div class="trends">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="content">
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
    box-sizing: border-box;
}
.navbar{
    width: 3/12*100%;
    box-sizing: border-box;
}
.search{
    min-height: 100%;
    width:4/12*100%;
    box-sizing: border-box;
}
.content{
    min-height:100%;
    width:5/12*100%;
    box-sizing: border-box;
}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .search{
        width:4/12*100%
    }
    .content{
        width:7/12*100%
    }
}
@media (max-width: 1000px) {
    .navbar{
        width:100px;
    }
    .search{
        display:none;
    }
    .content{
        width:11/12*100%
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
    .content{
        width:100%
    }
}
</style>