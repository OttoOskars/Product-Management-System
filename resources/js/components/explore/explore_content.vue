<template>
    <div class="content-container">
        <div class="black-line"></div>
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
            <div class="post" v-for="i in tweets" :key="i" @click="openTweet(i)"> 
                <div class="left-side">
                    <img @click.stop="openProfile(i)">
                </div>
                <div class="right-side">
                    <!-- ############################################# -->
                    <div class="top2">
                        <div class="person-image">
                            <img @click.stop="openProfile(i)">
                        </div>
                        <div class="info-content">
                            <div class="userinfo">
                                <p class="username">username</p>
                                <p class="usertag">@usertag</p>
                                <p class="time-posted">2h</p>
                            </div>
                            <div class="content-text">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus animi omnis quisquam quam voluptates saepe. Exercitationem?</p>
                            </div>
                        </div>
                    </div>
                    <!-- ############################################# -->
                    <div class="post-top">
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
                        <button class="post-btn-container comment-btn" @click="() => TogglePopup('CommentTrigger')">
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
    <Popup v-if="popupTriggers.CommentTrigger" :TogglePopup="() => TogglePopup('CommentTrigger')">
        <div class="create-tweet-or-comment-popup">
            <div class="top">
                <div class="left-side-popup">
                    <img  @click.stop="openProfile(i)">
                </div>
                <div class="right-side-popup">
                    <div class="userinfo-popup">
                        <p class="username">username</p>
                        <p class="usertag">@usertag</p>
                    </div>
                    <div class="tweet-input-container">
                        <textarea id="tweet-input" class="tweet-input" rows="1" placeholder="What's happening?!" @input="autoSize" ref="tweetInput" maxlength="255"></textarea>
                    </div>
                </div>
            </div>

            <div class="bottom">
                <div class="buttons">
                    <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                    <button class="tweet-btn"><ion-icon name="attach-outline" class="create-tweet-icon"></ion-icon></button>
                </div>
                <button class="popup-button" >Comment</button>
            </div>
        </div>
    </Popup>
</template>
<script>
import { ref } from 'vue';
import Popup from '../Popup.vue';
export default{
    name: 'Tweets',
    components: {
        Popup,
    },
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
        const popupTriggers = ref({
            CommentTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger]
            if (!popupTriggers.value[trigger]) {
                /* clear text area */
            }
		}
        return {
            search,
            clearSearch,
            popupTriggers,
            TogglePopup,
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
        autoSize() {
            const maxRows = 10;
            const textarea = this.$refs.tweetInput;
            textarea.style.height = 'auto';
            const customLineHeight = 1.5; // Match the line-height value from your CSS
            const maxHeight = maxRows * customLineHeight * parseFloat(getComputedStyle(textarea).fontSize);

            if (textarea.scrollHeight <= maxHeight) {
                textarea.style.height = textarea.scrollHeight + 'px';
            } else {
                textarea.style.height = maxHeight + 'px';
            }
        },
        openProfile(id){
            console.log(id);
        },
        openTweet(id) {
            console.log(id);
        },
    },   
}
</script>
<style lang="scss" scoped>
.top-bar{
    height:60px;
    width:100%;
    display:flex;
    align-items: center;
    background-color:rgba($color: #000000, $alpha: 0.8);
    backdrop-filter: blur(5px);
    position:sticky;
    top:0;
    z-index:9;
    padding:0 20px;
    box-sizing: border-box;
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
    margin:0;
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
    padding-top:0px;
    padding-bottom:45px;
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

        .post-top{
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

.top2{
    display:none;
}
.create-popup{
    width:500px;
    min-height: 300px;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    justify-content: space-between;
    padding:30px 0px 0px 0px;
    box-sizing: border-box;
    .top{
        width:100%;
        display:flex;
        flex-direction: row;
        box-sizing: border-box;
        gap:15px;
        padding:30px 35px 20px 20px;

        .left-side-popup{
            width:50px;
            height:100%;
            display:flex;
            flex-direction:column;
            box-sizing: border-box;
            img{
                width:50px;
                height:50px;
                border-radius: 50%;
                background-color: white;
            }
        }
        .right-side-popup{
            width:90%;
            height:100%;
            display:flex;
            flex-direction:column;
            box-sizing: border-box;
            .userinfo-popup{
                width:100%;
                height:20px;
                display:flex;
                flex-direction: row;
                gap:5px;
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
            }
            .tweet-input-container{
                width:100%;
                height:100%;
                display:flex;
                align-items: center;
                justify-content: center;
                padding-top: 10px;
                padding-right:10px;
                .tweet-input{
                    width:100%;
                    height:100%;
                    background-color: #000000;
                    color:#ffffff;
                    resize: none;
                    transition: height 0.2s;
                    font-family: Arial, sans-serif;
                    font-size: 22px;
                    border:none;
                    display:flex;
                    align-items: center;
                }
                .tweet-input:focus{
                    outline:none;
                }
            }
        }
    }

    .bottom{
        width:100%;
        height:60px;
        display:flex;
        flex-direction: row;
        justify-content: space-between;
        border-top:1px solid #2F3336;
        padding: 10px;
        box-sizing: border-box;
        .buttons{
            display:flex;
            flex-direction: row;
            align-items: center;
            gap:5px;
            .tweet-btn{
                height:40px;
                width:40px;
                background:none;
                border-radius:50%;
                border:none;
                display:flex;
                justify-content: center;
                align-items: center;
                cursor:pointer;
                .create-tweet-icon{
                    font-size:20px;
                    color:#1D9BF0;
                    --ionicon-stroke-width: 40px;
                }
            }
            .tweet-btn:hover{
                background-color: rgba($color: #1D9BF0, $alpha: 0.1);
            }
        }
        .popup-button{
            width:auto;
            padding:20px;
            height:auto;
            display:flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 50px;
            border:none;
            background-color: #1D9BF0;
            color:white;
            font-size: medium;
            font-weight: bold;
            transition: all 0.3s;
            cursor:pointer;
        }
        .comment-button:hover{
            background-color: #1d8dd7;
        }
        .comment-button:disabled{
            background-color: #0F4E78;
            color:#808080;
        }
    }
}
.post:hover{
    background-color: #080808;
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
    .user-img{
        position:fixed;
        top:5px;
        left:10px;
        width: auto;
        height:auto;
        display:flex;
        align-items: center;
        justify-content: center;
        img{
            width:40px;
            height:40px;

            border-radius:50%;
            background-color: rgb(255, 255, 255);
        }
    }
    .logo{
        display:flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        color:white;
        position:absolute;
        font-size:25px;
        top:5px;
        left:50%;
        transform: translate(-50%);
    }
    .post-type{
        width:100%;
        height:30%;
        display:flex;
        flex-direction:row;
        justify-content: space-between;

    }
    .post-type-btn{
        width:50%;
        height:100%;
        position:relative;
        align-items: center;
        justify-content: center;
        color:#71767B;
        padding:10px;
        border:none;
        background:none;
        transition:all 0.3s;
        font-size: 15px;
        font-weight:500;
    }
    .active-post-type{
        color:white;
        font-weight: 600;
    }

    .left-side, .post-top{
        display:none !important;
    }
    .right-side{
        width:100% !important;
    }
    .top2{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:row;
        .person-image{
            width: 50px;
            height: auto;
            display:flex;
            align-items: center;
            align-items: flex-start;
            img{
                width:40px;
                height:40px;

                border-radius:50%;
                background-color: rgb(255, 255, 255);
            }
        }
        .info-content{
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
                    font-size: 15px;
                    color:white;
                }
                .usertag{
                    margin:0;
                    font-size: 15px;
                    color:#6A6F74;
                }
                .time-posted{
                    margin:0;
                    font-size: 15px;
                    color:#6A6F74;
                }
            }

            .content-text{
                width:100%;
                height:auto;
                text-align: left;
                color:white;
                padding:0px;
                font-size:15px;
            }
        }


    }
    .post{
        width:100%;
        min-height:auto;
        display:flex;
        flex-direction:row;
        gap:5px!important;
        box-sizing: border-box;
        padding:15px 10px 5px 10px;
        border-bottom: 1px solid #2F3336;
    }
    .content-img{
        padding:0 !important;
    }
    .tweet-input{
        width:100%;
        height:100%;
        font-size: 18px !important;
    }
    .post-button{
        width:auto;
        padding: 5px 15px!important;
        height:auto;
        display:flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        border-radius: 50px;
        border:none;
        background-color: #1D9BF0;
        color:white;
        font-size: 12px!important;
        font-weight: bold;
        transition: all 0.3s;
        cursor:pointer;
    }
    .tweet-btn{
        height:30px!important;
        width:30px!important;
        background:none;
        border-radius:50%;
        border:none;
        display:flex;
        justify-content: center;
        align-items: center;
        cursor:pointer;
        .create-tweet-icon{
            font-size:20px;
            color:#1D9BF0;
            --ionicon-stroke-width: 40px;
        }
    }
    .bottom{
        width:100%;
        height:40px!important;
        .post-btn-container{
            width:auto;
            height:100%;
            border-radius:50%;
            transition: all 0.3s;
            cursor:pointer;
            .post-btn-nr{
                color:#6A6F74;
                font-size:10px !important;
                padding-top:1px;
            }
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
                border:solid 1px #2F3336;
                background-color: white;
            }
    }
    .post-container{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:column;
        box-sizing: border-box;
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
    .create-popup{
        width:100% !important;
        min-height: 250px;
        padding:30px 0px 0px 0px;
        box-sizing: border-box;
        .top{
            width:100%;
            gap:5px;
            padding:20px 15px 10px 10px;

            .left-side-popup{
                width:40px;
                box-sizing: border-box;
                img{
                    width:40px;
                    height:40px;
                }
            }
            .right-side-popup{
                gap:5px;
                .userinfo-popup{
                    gap:5px;
                    .username{
                        margin:0;
                        font-size: 13px;
                    }
                    .usertag{
                        margin:0;
                        font-size: 13px;

                    }
                }
                .tweet-input-container{
                    padding:0;
                    padding-right:10px;
                    .tweet-input{
                        font-size: 14px !important;
                    }
                }
            }
        }

        .bottom{
            width:100%;
            height:40px !important;
            display:flex;
            padding: 5px 10px;
            .popup-button{
                padding:12px;
                font-size: 11px;
            }
        }
    }
}
</style>