<template>
    <div class="home">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="tweets">
            <Tweets></Tweets>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Tweets from './tweets.vue';
import Search from './search.vue';
import Popup from '../Popup.vue';
export default {
  name: 'Home',
  components: {
    NavBar,
    Tweets,
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
.home{
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
.tweets{
    min-height:100%;
    width:5/12*100%;
    box-sizing: border-box;
}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .search{
        width:400px;
    }
    .tweets{
        flex-grow:1;
    }
}
@media (max-width: 1000px) {
    .navbar{
        width:100px;
    }
    .search{
        display:none;
    }
    .tweets{
        flex-grow:1;
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
    .tweets{
        width:100%
    }
}
</style>