<template>
<div class="notifications-container">
    <div class="black-line"></div>
    <div class="top-bar">
        <div class="title">Notifications</div>
        <div class="noti-type">
            <button @click="switchToAll" class="noti-type-btn" :class ="{ 'active-noti-type': notiType == 'all' }">All<div class="active-line" :class ="{ 'active': notiType == 'all' }"></div></button>
            <button @click="switchToVerified" class="noti-type-btn" :class ="{ 'active-noti-type': notiType == 'verified' }">Verified<div class="active-line" :class ="{ 'active': notiType == 'verified' }"></div></button>
            <button @click="switchToMentions" class="noti-type-btn" :class ="{ 'active-noti-type': notiType == 'mentions' }">Mentions<div class="active-line" :class ="{ 'active': notiType == 'mentions' }"></div></button>
        </div>
    </div>
    <div class="noti-main">
        <div class="main-text">Nothing to see here — yet</div>
        <div class="under-text">When someone mentions you, you'll find it here.</div>
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
            trends: 5,
            notiType: 'all',
        };
    },
    setup () {
    },
    computed: {
        currentPosts() {
            return this.notiType === 'all' ? this.all : this.verified || this.mentions;
        },
    },

    methods: {

        switchToAll() {
            this.notiType = 'all';
        },

        switchToVerified() {
            this.notiType = 'verified';
        },

        switchToMentions() {
            this.notiType = 'mentions';
        },
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

.notifications-container{
    width: 100%;
    height: auto;
}
.black-line{
    position:fixed;
    top:0;
    left:0;
    right:0;
    height:2px;
    z-index:8;
    background-color: black;
}
.top-bar{
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

    .noti-type{
        width:100%;
        height:50%;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
    }
}

.noti-type-btn{
    width:1/3*100%;
    height:100%;
    position:relative;
    align-items: center;
    justify-content: center;
    color:#71767B;
    padding:10px;
    border:none;
    background:none;
    transition:all 0.3s;
    font-size: 16px;
    font-weight:600;
}

.noti-type-btn:hover{
    color:white;
    font-size: 16px;
    font-weight: 700;
    background-color:rgba($color: #202223, $alpha: 0.8);
}

.active-noti-type{
    color:white;
    font-size: 16px;
    font-weight: 700;
}
.active-line {
    height:4px;
    width:75px;
    background-color: #1D9BF0;
    border-radius:5px;
    position:absolute;
    bottom:1px;
    display:none;
    left: 50%;
    transform: translateX(-50%);
}

.active-line.active{
    display:block;
}

.noti-main{
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

        .noti-type{
            width:100%;
            height:50%;
        }
    }
    .noti-type-btn{
        height:100%;
        padding:10px;
        font-size: 15px;
        font-weight:600;
    }
    .noti-main{
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
