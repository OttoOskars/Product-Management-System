<template>
    <div class="messages">
        <div class="navbar">
            <NavBar></NavBar>
        </div>
        <div class="messages-info">
            <Messages></Messages>
        </div>
    </div>
</template>
<script>
import NavBar from '../nav-bar.vue';
import Messages from './messages_content.vue';
import Popup from '../Popup.vue';
export default {
  name: 'messages',
  components: {
    NavBar,
    Messages,
    Popup,

  },
  data() {
    return {

    }
  }
}
</script>
<style lang="scss" scoped>
.messages{
    font-family: Arial, sans-serif;
    margin: 0 auto;
    display:flex;
    flex-direction: row;

}

.navbar{
    width: 3/12*100%;

}
.messages-info{
    height:100%;
    width:5/12*100%;

}

@media (max-width: 1250px) {
    .navbar{
        width:100px;
    }
    .messages-info{
        width:7/12*100%
    }
}
@media (max-width: 1000px) {
    .navbar{
        width:100px;
    }
    .messages-info{
        width:11/12*100%
    }

}
@media (max-width: 500px) {
    .navbar{
        width:100%;
        position:fixed;
        bottom:0;
        z-index:99;
    }
    .messages-info{
        width:100%
    }

}

</style>
