<template>
    <div class="home">
        <NavBar></NavBar>
        <Tweets></Tweets>
        <Search></Search>
    </div>
</template>
<script>
import NavBar from './nav-bar.vue';
import Tweets from './tweets.vue';
import Search from './search.vue';
import Popup from './Popup.vue';
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
    background-color: bisque;
    display:flex;
    flex-direction: row;
    width:100%;
    min-height: 100vh;
}
</style>