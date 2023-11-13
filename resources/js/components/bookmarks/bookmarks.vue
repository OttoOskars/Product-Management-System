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
</style>
