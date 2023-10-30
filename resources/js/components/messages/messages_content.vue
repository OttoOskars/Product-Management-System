<template>
    <div class="messages-container">
        <div class="messages-main">
            <div class="title">Messages</div>
            <div class="main-text">Welcome to your inbox!</div>
            <div class="under-text">Drop a line, share posts and more with private conversations between you and others on X. </div>
            <button class="write-button">Write a message</button>
        </div>

        <div class="messages-right">
            <div class="right-text">Select a message</div>
            <div class="right-under-text">Choose from your existing conversations, start a new one, or just keep swimming.</div>
            <button class="right-write-button">New message</button>

        </div>
    </div>

</template>

<script>
import { ref } from 'vue';
export default{
    name: 'Search',
    data() {
        return {
            isInputFocused: false,
            people: 3,
        };
    },
    setup () {
    },

    methods: {
        redirectTo(where) {
            this.$router.push(where);
        },

        openTweet(id) {
            console.log(id);
        },
    },

}
</script>

<style lang="scss" scoped>

.messages-container{
    height: 100%;
    display: grid;
    grid-template-columns: 65% 100%;
}


    .title{
        color:white;
        padding:10px;
        padding-left:20px;
        font-size: 23px;
        font-weight:bold;
    }

.messages-main{
    padding-top:0px;
    height: 100vh;
    padding-bottom:80px;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    border-right: 1px solid #2F3336;
    border-left: 1px solid #2F3336;

    .main-text{
    color: white;
    text-align:left;
    font-size: 32px;
    font-weight: bold;
    display: flex;
    margin-top: 10%;
    margin-left:6%;
    margin-right:15%;
    }

    .under-text{
        color:gray;
        display: flex;
        font-size: 15px;
        text-align: left;
        padding-left: 6%;
        margin-top: 15px;
    }

   .write-button{
    display: block;
    width: 170px;
    align-items: center;
    background:#1d9bf0;
    color: white;
    text-align: center;
    margin-top: 35px;
    margin-left: 6%;
    border-radius: 50px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    height: 50px;
    }
}

.messages-right{
    height: 100vh;
    flex-direction:column;
    box-sizing: border-box;
    border-right: 1px solid #2F3336;
    justify-content: center;


    .right-text{
    color: white;
    text-align: left;
    font-size: 32px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    margin-top: 40%;
    align-items: center;
    }

    .right-under-text{
        color:gray;
        display: flex;
        font-size: 15px;
        text-align: left;
        padding-right: 20%;
        padding-left: 29.4%;
        margin-top: 15px;
        justify-content: center;

    }

   .right-write-button{
    display: block;
    width: 170px;
    background:#1d9bf0;
    color: white;
    text-align: center;
    margin-top: 35px;
    margin-left: 29.5%;
    border-radius: 50px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    height: 50px;
    }
}
</style>

