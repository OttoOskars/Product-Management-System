<template>
    <div class="bookmarks-container">
        <div class="top">
            <div class="title">Bookmarks</div>
            <div class="user-info" v-if="user">
                <p class="usertag">{{ user.UserTag }}</p>
            </div>
        </div>

    <div class="bookmarks-main">
        <div class="main-text">Save posts for later</div>
        <div class="under-text">Bookmark posts to easily find them again in the future.</div>
    </div>
    </div>

</template>
<script>
import { ref } from 'vue';
import { mapState } from 'vuex';
export default{
    name: 'Search',
    data() {
        return {
            isInputFocused: false,
            people: 3,
            trends: 5,
        };
    },
    computed:{
         ...mapState(['isLoggedIn', 'user']),
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

    .bookmarks-container{
    width: 100%;
    height: auto;
}

.top {
    width: 100%;
    height: 125px;
    display: flex;
    flex-direction: column;
    background-color:rgba($color: #000000, $alpha: 0.8);
    position:sticky;
    top:0;
    z-index:9;
    backdrop-filter: blur(5px);
    border-bottom:solid 1px #2F3336;

    .title{
        width:100%;
        box-sizing: border-box;
        height:50%;
        display:flex;
        align-items: center;
        justify-content: flex-start;
        color:white;
        padding:10px;
        padding-left:20px;
        font-size: 23px;
        font-weight:bold;
    }

    .usertag {
        width:100%;
        height:1%;
        display:flex;
        align-items: center;
        justify-content: flex-start;
        color:gray;
        padding-left:20px;
        font-size: 16px;
    }


}

.bookmarks-main{
    padding-top:0px;
    padding-bottom:80px;
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;

    .main-text{
    color: white;
    text-align: left;
    font-size: 37px;
    font-weight: bold;
    display: flex;
    margin-top: 10%;
    margin-left:15%;
    margin-right:15%;
    }

    .under-text{
        color:gray;
        display: flex;
        font-size: 15px;
        text-align: left;
        padding-left: 15%;
        margin-top: 15px;

    }

}

@media (max-width: 500px){
    .top-bar{
        height:90px;
        .title{
            width:100%;
            height:50%;
            color:white;
            padding:10px;
            padding-left:20px;
            font-size: 17px;
            font-weight:bold;
        }

}

    .bookmarks-main{
        .main-text{
            font-size: 25px;
            margin-top: 10%;
            margin-left:15%;
            margin-right:15%;
        }

        .under-text{
            color:gray;
            display: flex;
            font-size: 13px;
            text-align: left;
            padding-left: 15%;
            margin-top: 15px;

        }
    }
}

</style>


