<template>
    <div class="notifications">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="content">
            <Notifications></Notifications>
        </div>
        <div class="search">
            <Search></Search>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Notifications from './notifications_content.vue';
import Popup from '../Popup.vue';
import Search from '../home/search.vue';
export default {
  name: 'notifications',
  components: {
    NavBar,
    Notifications,
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
.notifications{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;
}

</style>
