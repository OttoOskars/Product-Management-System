<template>
    <div class="bookmarks">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="bookmarks-info">
            <Bookmarks></Bookmarks>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Bookmarks from './bookmarks_content.vue';
import Popup from '../Popup.vue';
import Search from '../home/search.vue';
export default {
  name: 'bookmarks',
  components: {
    NavBar,
    Bookmarks,
    Popup,
    Search,
  },
  data() {
    return {

    }
  }
}
</script>
<style lang="scss" scoped>
.bookmarks{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;

}

.search{
    min-height:100%;
    width:4/12*100%;
}
.navbar{
    width: 3/12*100%;

}
.bookmarks-info{
    height:100%;
    width:5/12*100%;

}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .bookmarks-info{
        width:7/12*100%
    }
    .search{
        width:4/12*100%
    }
}
@media (max-width: 1000px) {
    .navbar{
        width:100px;
    }
    .bookmarks-info{
        width:11/12*100%
    }
    .search{
        display:none;
    }
}
@media (max-width: 500px) {
    .navbar{
        width:100%;
        position:fixed;
        bottom:0;
        z-index:99;
    }
    .bookmarks-info{
        width:100%
    }
    .search{
        display:none;
    }
}

</style>
