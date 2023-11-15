<template>
    <div class="home">
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
</style>