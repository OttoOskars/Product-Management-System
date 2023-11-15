<template>
    <div class="tweet">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="content">
            <Tweets></Tweets>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Tweets from './tweet_content.vue';
import Search from '../home/search.vue';
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
.tweet{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;
    box-sizing: border-box;
}
</style>