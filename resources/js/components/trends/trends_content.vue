<template>
    <div class="tweets-container">
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="title">Trends</div>
        </div>

        <div class="trend-container">
            <p class="title">Trends for you</p>
            <div class="trend" v-for="i in trends" :key="i">
                <div class="trend-info">
                    <p class="trend-rank">Trending in Latvia</p>
                    <p class="trend-name">Skolā bumba</p>
                    <p class="trend-posts">1232 posts</p>
                </div>
                <div class="more-icon">
                    <ion-icon name="ellipsis-horizontal"></ion-icon>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
export default{
    name: 'Tweets',
    data(){
        return {
            trends: 12,
        }
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        }
    },   
}
</script>
<style lang="scss" scoped>
.tweets-container{
    width:100%;
    height:auto;
    color:white;
}

.top-bar{
    height:60px;
    background-color:rgba($color: #000000, $alpha: 0.8);
    position:fixed;
    top:0;
    width:5/12*100%;
    z-index:99;
    box-sizing: border-box;
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    padding:0 10px;
}

.title{
    width:100%;
    height:28px;
    display:flex;
    align-items: center;
    justify-content: flex-start;
    box-sizing: border-box;
    padding-left:20px;
    font-weight: bold;
    font-size: 22px;
}
.trend-container{
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    border-bottom: 1px solid #2F3336;
    padding-top:60px;
    .trend{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
        align-items: center;
        box-sizing: border-box;
        padding:10px 20px;
        .more-icon{
            display:flex;
            align-items: center;
            justify-content: center;
            width:40px;
            height:40px;
            border-radius: 50%;
            background-color: black;
            color:#6A6F74;
            cursor:pointer;
            transition: all 0.3s;
        }
        .more-icon:hover{
            background-color: rgba($color: #1D9BF0, $alpha: 0.1);
            color:#1D9BF0;
        }
    }
    .trend-info{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:column;
        gap:6px;
        box-sizing: border-box;
        cursor:pointer;
        .trend-rank{
            color: #6e767d;
            font-size: 13px;
            margin:0;
        }
        .trend-name{
            color:white;
            font-weight: bold;
            font-size: 16px;
            margin:0;
        }
        .trend-posts{
            color: #6e767d;
            font-size: 13px;
            margin:0;
        }
    }
    .trend:hover{
        background-color: #080808;
    }
}

.back-icon{
    display:flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    width:40px;
    height:40px;
    border-radius: 50%;
    border:none;
    font-size:22px;
    background-color: black;
    color:white;
    cursor:pointer;
    transition: all 0.3s;
}
.back-icon:hover{
    background-color: rgba($color: #1a1a1a, $alpha: 1);
}
</style>