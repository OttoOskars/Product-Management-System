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

}
.navbar{
    min-height:100%;
    width: 3/12*100%;

}
.search{
    min-height: 100%;
    width:4/12*100%;

}
.tweets{
    min-height:100%;
    width:5/12*100%;

}

</style>