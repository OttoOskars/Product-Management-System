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
    z-index:20;
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
            padding:15px;
            border-radius: 50%;
            background:none;
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
    background:none;
    color:white;
    cursor:pointer;
    transition: all 0.3s;
}
.back-icon:hover{
    background-color: rgba($color: #1a1a1a, $alpha: 1);
}
@media (max-width: 1250px) {
    .top-bar{
        width:7/12*100%;
    }
}
@media (max-width: 1100px) {
    .top-bar{
        width:7/12*100%;
    }
}
@media (max-width: 1000px) {
    .top-bar{
        width:11/12*100%;
    }
}

@media (min-width: 500px) {
    .user-img, .logo{
        display:none !important;
    }
}
@media (max-width: 500px) {
    .top-bar{
        height:35px;
        width:100%;
        .search-input {
            width: 100%;
            height: 80%;
            border-radius: 50px;
            padding-left:30px;
            border:  1px solid transparent;
            background-color: #202327;
            position: relative;
            color:white;
            font-size: 13px;
        }

        .search-icon {
            position: absolute;
            left: 30px;
            top: 50%;
            transform: translate(0, -50%);
            color: #71767B;
            font-size: 16px;
        }
    }

    .title{
        font-size:17px !important;
    }
    .title2{
        width:100%;
        box-sizing: border-box;
        height:70%;
    }
    .trend-container{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:column;
        box-sizing: border-box;
        border-bottom: 1px solid #2F3336;
        padding-top:30px;
        padding-bottom:100px;
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
                padding:10px;
                border-radius: 50%;
                background:none;
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
                font-size: 11px;
                margin:0;
            }
            .trend-name{
                color:white;
                font-weight: bold;
                font-size: 13px;
                margin:0;
            }
            .trend-posts{
                color: #6e767d;
                font-size: 11px;
                margin:0;
            }
        }
    }
}
</style>