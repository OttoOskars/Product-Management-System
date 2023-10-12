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
import NavBar from './nav-bar_2.vue';
import Tweets from './tweets_2.vue';
import Search from './search_2.vue';
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

.navbar {
    width: 20%;
    height: 100vh;
}

.tweets {
  width: 60%;
  height: 100vh;
}

.search {
  width: 20%;
  height: 100vh;
}

@media (max-width: 767px) {
    .navbar {
      width: 0%;
      height: 0%;
    }

    .tweets {
      width: 65%
    }

    .search {
      width: 35%
    }
  }

</style>
