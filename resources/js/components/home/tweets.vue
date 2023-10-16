<template>
    <div class="tweets-container">
        <div class="top-bar">
            <div class="title">Home</div>
            <div class="post-type">
                <button>For you</button>
                <button>Following</button>
            </div>
        </div>
        <div class="post-container">
            <div class="create-tweet">
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="tweet-input-container">
<<<<<<< HEAD:resources/js/components/tweets.vue
                            <textarea class="tweet-input" rows="3"></textarea>
=======
                            <textarea id="tweet-input" class="tweet-input" rows="1" placeholder="What's happening?!" @input="autoSize" ref="tweetInput" maxlength="255"></textarea>
>>>>>>> 639033aec9fbea71a1688ed11c8d29fdd93a4566:resources/js/components/home/tweets.vue
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="buttons">
                            <button class="tweet-btn">Tweet</button>
                            <button class="tweet-btn">Tweet</button>
                            <button class="tweet-btn">Tweet</button>
                        </div>
                        <button class="post-button">POST</button>
                    </div>
                </div>
            </div>
            <div class="post"> 
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="userinfo">
                            <p class="username">username</p>
                            <p class="usertag">@usertag</p>
                        </div>
                        <div class="content-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus animi omnis quisquam quam voluptates saepe. Exercitationem?</p>
                        </div>
                    </div>
                    <div class="content-img">
                        <img>
                    </div>
                    <div class="bottom"><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon></div>
                </div>
            </div>
            <div class="post">
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="userinfo">
                            <p class="username">username</p>
                            <p class="usertag">@usertag</p>
                        </div>
                        <div class="content-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus animi omnis quisquam quam voluptates saepe. Exercitationem?</p>
                        </div>
                    </div>
                    <div class="content-img">
                        <img>
                    </div>
                    <div class="bottom"><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon></div>
                </div>
            </div>
            <!-- More posts -->
        </div>
    </div>
</template>
<script>
export default{
    name: 'Tweets',
<<<<<<< HEAD:resources/js/components/tweets.vue
=======
    data(){
        return {
            tweets: 5,
            following_tweets: 1,
            postType: 'tweets',
        }
    },
    computed: {
        currentPosts() {
            return this.postType === 'tweets' ? this.tweets : this.following_tweets;
        },
    },
    methods: {
        switchToTweets() {
            this.postType = 'tweets';
        },
        switchToFollowing() {
            this.postType = 'following_tweets';
        },
        autoSize() {
            const textarea = this.$refs.tweetInput;
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        },
    },   
>>>>>>> 639033aec9fbea71a1688ed11c8d29fdd93a4566:resources/js/components/home/tweets.vue
}
</script>
<style lang="scss" scoped>
.tweets-container{
    width:100%;
    height:auto;
}

.top-bar{
    width:100%;
    height:125px;
    display:flex;
    flex-direction:column;
    background-color:rgba($color: #000000, $alpha: 0.8);
    position:fixed;
    top:0;
    width:5/12*100%;
    z-index:99;
    backdrop-filter: blur(5px);
    border-bottom:solid 1px #2F3336;

    .title{
        width:100%;
        box-sizing: border-box;
        height:50%;
        display:flex;
        justify-content: flex-start;
        align-items: center;
        color:white;
        padding:10px;

    }
    .post-type{
        width:100%;
        height:50%;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
        button{
            width:50%;
            height:100%;
            align-items: center;
            justify-content: center;
            color:white;
            padding:10px;


            border:none;
            background:none;
        }
    }
}

.post-container{
    padding-top:125px;
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


.create-tweet{
    width:100%;
    min-height:fit-content;
    display:flex;
    flex-direction:row;
    box-sizing: border-box;
    gap:10px;
    padding:10px;
    border-bottom: 1px solid #2F3336;

    .right-side{
        width:90%;
        height:100%;
        display:flex;
        gap:10px;
        flex-direction:column;
        .top{
            width:100%;
            height:80%;
            display:flex;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            padding:0px;
            .tweet-input-container{
                width:100%;
                height:100%;
                display:flex;
                align-items: center;
                justify-content: center;
                .tweet-input{
                    width:100%;
                    height:100%;
                    background-color: #000000;
                    color:#ffffff;
                    resize: none;
                    transition: height 0.2s;
                    border-left:none;
                    border-right:none;
                    border-top:none;
                    border-color:#2F3336;
                }
            }
        }
        .bottom{
            width:100%;
            height:40px;
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            .buttons{
                display:flex;
                flex-direction: row;
                gap:20px;

                .tweet-btn{
                    height:100%;
                    width:auto;
                }
            }
            .post-button{
                width:75px;
                height:100%;
            }
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
    padding:10px;
    border-bottom: 1px solid #2F3336;
    .right-side{
        width:90%;
        height:100%;
        display:flex;
        gap:10px;
        flex-direction:column;

        .top{
            width:100%;
            height:auto;
            display:flex;
            flex-direction:column;
            .userinfo{
                width:100%;
                height:10px;
                display:flex;
                flex-direction:row;
                justify-content: flex-start;
                align-items: center;
                color:white;
                padding-top:2px;
                .username{
                    margin:0;
                    font-weight: bold;
                    font-size: 14px;
                    color:white;
                }
                .usertag{
                    padding-left:5px;
                    margin:0;
                    font-size: 14px;
                    color:#6A6F74;
                }
            }

            .content-text{
                width:100%;
                height:auto;
                text-align: left;
                color:white;
                padding:0px;
            }

        }
        .content-img{
            width:auto;
            height:auto;
            display:flex;
            justify-content: flex-start;
            align-items: center;
            box-sizing: border-box;
            img{
                border-radius:25px;
                width:300px;
                height:300px;
                border:solid 1px #2F3336;
                background-color: white;
            }
        }
        .bottom{
            width:100%;
            height:30px;
            display:flex;
            flex-direction: row;
            justify-content: space-evenly;
            color:#ffffff;
        }

    }

}

// @media (max-width: 1200px) {
//     .tweets-container {
//         flex-direction: column;
//         width: 100%;
//         height: auto;
//     }
    
//     .post-container {
//         padding-top: 70px; /* Reduce the padding to make space for the navbar */
//     }

//     .post-container .post {
//         border-bottom: 1px solid #2F3336; /* Restore the border at the bottom of each post */
//     }

//     .create-tweet .right-side .top .tweet-input-container .tweet-input {
//         height: 3rem; /* Set a fixed height for the tweet input to keep it responsive */
//     }

//     .create-tweet .right-side .bottom .buttons .tweet-btn {
//         height: 40px; /* Set a fixed height for the tweet buttons */
//     }

//     .post .right-side .content-img img {
//         width: 300px; /* Restore the fixed width for content images */
//         height: 300px;
//     }

//     .post .right-side .bottom {
//         justify-content: space-evenly; /* Restore the spacing between icons */
//     }
// }
</style>