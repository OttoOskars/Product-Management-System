<template>
    <div class="notifications">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="notifications-info">
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

.search{
    min-height:100%;
    width:4/12*100%;
}
.navbar{
    width: 3/12*100%;

}
.notifications-info{
    height:100%;
    width:5/12*100%;

}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .notifications-info{
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
    .notifications-info{
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
    .notifications-info{
        width:100%
    }
    .search{
        display:none;
    }
}

</style>
