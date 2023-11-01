<template>
    <div class="bookmarks">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="content">
            <Content></Content>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Content from './bookmarks_content.vue';
import Popup from '../Popup.vue';
import Search from '../home/search.vue';
export default {
  name: 'bookmarks',
  components: {
    NavBar,
    Content,
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
    .content{
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
    .content{
        width:100%
    }
}
</style>
