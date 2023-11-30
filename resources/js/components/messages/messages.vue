<template>
    <div class="messages">
<!--         <div class="navbar">
            <NavBar></NavBar>
        </div> -->
        <div class="content">
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
</style>
