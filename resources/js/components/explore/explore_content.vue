<template>
    <div class="tweets-container">
        <div class="top-bar"> 
            <input 
                type="text"
                id="search-input"
                class="search-input" 
                maxlength="30" 
                placeholder="Search"
                :class="{ 'focused': isInputFocused }"
                @focus="inputFocus"
                @blur="inputBlur"
                v-model="search"
                >
            <ion-icon name="search-outline" class="search-icon"></ion-icon>
        </div>

        <div class="post-container">
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
                <div class="show-more-container">
                    <button class="show-more-btn">Show more</button>
                </div>
            </div>
            <div class="post" v-for="i in tweets" :key="i"> 
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="userinfo">
                            <p class="username">username</p>
                            <p class="usertag">@usertag</p>
                            <p class="time-posted">2h</p>
                        </div>
                        <div class="content-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus animi omnis quisquam quam voluptates saepe. Exercitationem?</p>
                        </div>
                    </div>
                    <div class="content-img">
                        <img>
                    </div>
                    <div class="bottom">
                        <button class="post-btn-container heart-btn">
                            <div class="icon-container"><ion-icon name="heart-outline" class="post-icon"></ion-icon></div>
                            <p class="post-btn-nr">123</p>
                        </button>
                        <button class="post-btn-container comment-btn">
                            <div class="icon-container"><ion-icon name="chatbox-outline" class="post-icon"></ion-icon></div>
                            <p class="post-btn-nr">432</p>
                        </button>
                        <button class="post-btn-container retweet-btn">
                            <div class="icon-container"><ion-icon name="arrow-redo-outline" class="post-icon"></ion-icon></div>
                            <p class="post-btn-nr">53</p>
                        </button>
                    </div>
                </div>
            </div>
            <!-- More posts -->
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
export default{
    name: 'Tweets',
    data(){
        return {
            isInputFocused: false,
            tweets: 5,
            trends: 6,
        }
    },
    setup () {
        const search = ref('');
        const clearSearch = () => {
            search.value = '';
        }
        return {
            search,
            clearSearch
        }
    },
    computed: {
    },
    methods: {
        inputFocus() {
            this.isInputFocused = true;
        },
        inputBlur() {
            this.isInputFocused = false;
        },
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
    padding:0 20px;
    .search-input {
        width: 100%;
        height: 80%;
        border-radius: 50px;
        padding-left:60px;
        border:  1px solid transparent;
        background-color: #202327;
        position: relative;
        color:white;
        font-size: medium;
        &.focused {
            outline:none;
            background-color: black; /* Change input background when focused */
            border-color: #1D9BF0; /* Change input border when focused */
            box-shadow: 0 0 5px #1D9BF0;
        }
    }

    .search-input:focus + .search-icon{
        color: #1D9BF0;
    }



    .search-input::-webkit-input-placeholder {
        color: #71767B;
    }

    .search-icon {
        position: absolute;
        left: 40px;
        top: 50%;
        transform: translate(0, -50%);
        color: #71767B;
        font-size: 24px;
    }
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

.show-more-container{
    width:100%;
    height:auto;
    .show-more-btn{
        width:100%;
        height:60px;
        border:none;
        display:flex;
        align-items: center;
        padding-left:20px;
        background: none;
        font-size:17px;
        color:#1D9BF0;
        cursor: pointer;
        transition:all 0.3s;
    }
    .show-more-btn:hover{
        background-color: #080808;
    }
}

.post-container{
    padding-top:50px;
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;

    .left-side{
        width:50px;
        height:100%;
        display:flex;
        flex-direction:column;
        img{
            width:50px;
            height:50px;
            border-radius: 50%;
            background-color: white;

        }
    }
}

.post{
    width:100%;
    min-height:auto;
    display:flex;
    flex-direction:row;
    gap:10px;
    box-sizing: border-box;
    padding:15px 10px 5px 15px;
    border-bottom: 1px solid #2F3336;
    cursor:pointer;
    .right-side{
        width:90%;
        height:100%;
        display:flex;
        flex-direction:column;
        box-sizing: border-box;
        gap:5px;

        .top{
            width:100%;
            height:auto;
            display:flex;
            flex-direction:column;
            padding-left:5px;
            .userinfo{
                width:100%;
                height:10px;
                display:flex;
                flex-direction:row;
                justify-content: flex-start;
                align-items: center;
                gap:7px;
                color:white;
                padding-top:2px;
                .username{
                    margin:0;
                    font-weight: bold;
                    font-size: 17px;
                    color:white;
                }
                .usertag{
                    margin:0;
                    font-size: 17px;
                    color:#6A6F74;
                }
                .time-posted{
                    margin:0;
                    font-size: 17px;
                    color:#6A6F74;
                }
            }

            .content-text{
                width:100%;
                height:auto;
                text-align: left;
                color:white;
                padding:0px;
                font-size:17px;
            }

        }
        .content-img{
            padding-left:5px;
            width:auto;
            height:auto;
            display:flex;
            justify-content: flex-start;
            align-items: center;
            box-sizing: border-box;
            img{
                border-radius:15px;
                width:100%;
                height:300px;
                border:solid 1px #2F3336;
                background-color: white;
            }
        }
        .bottom{
            width:100%;
            height:40px;
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            color:#ffffff;
            .post-btn-container{
                display:flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                width:auto;
                height:100%;
                background: none;
                border-radius:50px;
                border:none;
                text-align: left;
                transition: all 0.3s;
                cursor:pointer;
                .post-btn-nr{
                    color:#6A6F74;
                    font-size:14px;
                    padding-top:1px;
                }
            }
            .comment-btn:hover{
                .icon-container{
                    background-color: rgba($color: #1D9BF0, $alpha: 0.2);
                    .post-icon{
                        color:#1D9BF0;
                    }
                }
                .post-btn-nr{
                    color:#1D9BF0;
                }
            }
            .heart-btn:hover{
                .icon-container{
                    background-color: rgba($color: #F31C80, $alpha: 0.2);
                    .post-icon{
                        color:#F31C80;
                    }
                }
                .post-btn-nr{
                    color:#F31C80;
                }
            }
            .retweet-btn:hover{
                .icon-container{
                    background-color: rgba($color: #00BA7C, $alpha: 0.2);
                    .post-icon{
                        color:#00BA7C;
                    }
                }
                .post-btn-nr{
                    color:#00BA7C;
                }
            }
            .icon-container{
                height:40px;
                width:40px;
                background:none;
                border-radius:50%;
                border:none;
                display:flex;
                justify-content: center;
                align-items: center;
                cursor:pointer;
                .post-icon{
                    font-size:20px;
                    color:#71767B;
                    --ionicon-stroke-width: 40px;
                }
                
            }
        }
    }
}
.post:hover{
    background-color: #080808;
}
</style>