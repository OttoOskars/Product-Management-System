<template>
    <div class="bookmarks-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="bookmarks-top" v-if="user">
                <p class="title">Bookmarks</p>
                <p class="user-tag">{{ user.UserTag }}</p>
            </div>
        </div>
        <div class="post-container">
            <div v-for="tweet in tweets" :key="tweet.TweetID">
                <div class="post" @click="openTweet(tweet.TweetID)">
                    <div class="left-side">
                        <img @click.stop="openProfile(tweet.user.UserTag)">
                    </div>
                    <div class="right-side">
                        <div class="top2">
                            <div class="person-image">
                                <img @click.stop="openProfile(tweet.user.UserTag)">
                            </div>
                            <div class="info-content">
                                <div class="userinfo">
                                    <p class="username">{{tweet.user.Name}}</p>
                                    <p class="usertag">{{tweet.user.UserTag}}</p>
                                    <p class="time-posted">{{ tweet.created_ago }}</p>
                                </div>
                                <div class="content-text">
                                    <p v-if="tweet.TweetText">{{ tweet.TweetText }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- ############################################# -->
                        <div class="post-top">
                            <div class="userinfo">
                                <p class="username">{{tweet.user.Name}}</p>
                                <p class="usertag">{{tweet.user.UserTag}}</p>
                                <p class="time-posted">{{ tweet.created_ago }}</p>
                            </div>
                            <div class="content-text">
                                <p v-if="tweet.TweetText">{{ tweet.TweetText }}</p>
                            </div>
                        </div>
                        <div class="content-img">
                            <img v-if="tweet.TweetImage" :src="'/storage/' + tweet.TweetImage"/>
                        </div>
                        <div class="bottom">
                            <button class="post-btn-container heart-btn" @click.stop="toggleLike(tweet.TweetID)">
                                <div class="icon-container"><ion-icon :name="tweet.isLiked ? 'heart' : 'heart-outline'" class="post-icon" :class ="{ 'liked': tweet.isLiked }"></ion-icon></div>
                                <p class="post-btn-nr" :class ="{ 'liked': tweet.isLiked }">{{ tweet.like_count }}</p>
                            </button>
                            <button class="post-btn-container comment-btn" @click.stop="tweetIdInPopup = tweet.TweetID; TogglePopup('CommentTrigger')">
                                <div class="icon-container"><ion-icon name="chatbox-outline" class="post-icon"></ion-icon></div>
                                <p class="post-btn-nr">{{ tweet.comment_count }}</p>
                            </button>
                            <button class="post-btn-container retweet-btn" @click.stop="toggleRetweet(tweet.TweetID)">
                                <div class="icon-container"><ion-icon :name="tweet.isRetweeted ? 'arrow-redo' : 'arrow-redo-outline'" class="post-icon" :class ="{ 'retweeted': tweet.isRetweeted }"></ion-icon></div>
                                <p class="post-btn-nr" :class ="{ 'retweeted': tweet.isRetweeted }">{{ tweet.retweet_count }}</p>
                            </button>
                            <button class="post-btn-container bookmark-btn" @click.stop="toggleBookmark(tweet.TweetID)">
                                <div class="icon-container">
                                    <ion-icon :name="tweet.isBookmarked ? 'bookmark' : 'bookmark-outline'" class="post-icon" :class="{ 'bookmarked': tweet.isBookmarked }"></ion-icon>
                                </div>
                                <p class="post-btn-nr" :class="{ 'bookmarked': tweet.isBookmarked }">{{ tweet.isBookmarked ? 'Bookmarked' : 'Bookmark' }}</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Popup v-if="popupTriggers.CommentTrigger" :TogglePopup="() => TogglePopup('CommentTrigger')">
            <div class="comment-popup">
                <div class="top">
                    <div class="left-side-popup">
                        <img  @click="openProfile(user.UserTag)">
                    </div>
                    <div class="right-side-popup">
                        <div class="userinfo-popup">
                            <p class="username">{{ user.Name }}</p>
                            <p class="usertag">{{ user.UserTag }}</p>
                        </div>
                        <div class="tweet-input-container">
                            <textarea v-model="comment_text_input" id="tweet-input-comment" class="tweet-input" rows="1" placeholder="Post your reply" @input="autoSize" ref="tweetInput" maxlength="255"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bottom">
                    <div class="buttons">
                        <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                        <button class="tweet-btn"><ion-icon name="attach-outline" class="create-tweet-icon"></ion-icon></button>
                    </div>
                    <button class="popup-button" @click="createComment(tweetIdInPopup, comment_text_input)" :disabled="buttonDisabled">Comment</button><!-- Izdomā kā comment poga nodos tweetID. -->
                </div>
            </div>
        </Popup>
    </div>
</template>
<script>
import { ref } from 'vue';
import Popup from '../Popup.vue';
import { mapState } from 'vuex';
import { useStore } from 'vuex';
import axios from 'axios';
import { useRouter } from 'vue-router';
export default{
    name: 'Search',
    components: {
        Popup,
    },
    data() {
        return {
            tweets: [],
            comment_text_input: '',
            comments: [],
            commentsByTweet: {},
            previewImage: null,
            tweetImage: null,
            isPopupVisible: false,
            buttonDisabled:false,
            tweetIdInPopup: null,
        };
    },
    setup(){
        const router = useRouter();
        const store = useStore();

        if (store.state.isLoggedIn) {
            router.push('/bookmarks');
        }
        const logoutUser = async () => {
            try {
                await store.dispatch('logout');
                router.push('/');
            } catch (error) {
                console.error(error);
            }
        };

        const popupTriggers = ref({
            CommentTrigger: false,
            ProfileTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger];
            if (!popupTriggers.value[trigger]) {
            }
        };
        return {
            popupTriggers,
            TogglePopup,
            logoutUser,
        }
    },
    computed:{
         ...mapState(['isLoggedIn', 'user']),
    },

    methods: {
        goBack() {
            this.$router.go(-1);
        },
        // redirectTo(where) {
        //     this.$router.push(where);
        // },

        // openTweet(id) {
        //     console.log(id);
        // },
        goBack() {
            this.$router.go(-1);
        },
        getTweets(type) {
        axios
            .get(`/api/tweets/${type}`)
            .then((response) => {
                this[type + '_tweets'] = response.data.tweets;
                if (type === 'bookmark') {
                    this.tweets = response.data.tweets;
                }
            })
            .catch((error) => {
            console.error(error);
            });
        },
        openProfile(tag){
            const NoSymbolTag = tag.replace(/^@/, '');
            this.$router.push({ name: 'profile', params: { UserTag : NoSymbolTag } });
            console.log(tag);
        },

        openTweet(id) {
            this.$router.push({ name: 'tweet', params: { tweetID: id } });
            console.log(id);
        },

        toggleLike(tweetID) {
            if (this.buttonDisabled) {
                return;
            }
            const tweet = this.tweets.find((t) => t.TweetID === tweetID);
            if (!tweet) {
                return;
            }
            if (tweet.isLiked) {
                this.buttonDisabled = true;
                this.unlikeTweet(tweet.TweetID);
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 1500);
            } else {
                this.buttonDisabled = true;
                this.likeTweet(tweet.TweetID);
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 1500);
            }
        },

        async likeTweet(tweetID) {
            try {
                const response = await axios.post(`/api/tweets/like`, { tweetId: tweetID });
                console.log('Like Response:', response);
                if (response.status === 201) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetID);
                    if (tweet) {
                        tweet.isLiked = true;
                        tweet.like_count += 1;
                    }
                }
            } catch (error) {
                console.error('Error liking the tweet:', error);
            }
        },

        async unlikeTweet(tweetId) {
            try {
                const response = await axios.delete(`/api/tweets/unlike/${tweetId}`);
                console.log('Unlike Response:', response);
                if (response.status === 200) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetId);
                    if (tweet) {
                        tweet.isLiked = false;
                        tweet.like_count -= 1;
                    }
                }
            } catch (error) {
                console.error('Error unliking the tweet:', error);
            }
        },

        async createComment(tweetID, commentText) {
            if (this.buttonDisabled) {
                return;
            }
            if (commentText.trim() === '') {
                return;
            }
            try {
                this.buttonDisabled = true;
                const response = await axios.post('/api/create-comments', {
                    tweetId: tweetID,
                    commentText: commentText,
                });
                const newComment = response.data.comment;
                const userResponse = await axios.get(`/api/get-user/${newComment.UserID}`);
                newComment.user = userResponse.data.user;
                this.comments.push(newComment);
                this.main_comment_text_input = '';
                this.popup_comment_text_input = '';
                if (response.status === 201) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetID);
                    if (tweet) {
                        tweet.comment_count += 1;
                    }
                }
                this.popupTriggers.CommentTrigger = false;
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 2000);
            } catch (error) {
                console.error('Error creating comment:', error);
                this.buttonDisabled = false;
            }
        },

        toggleRetweet(tweetID) {
            if (this.buttonDisabled) {
                return;
            }
            const tweet = this.tweets.find((t) => t.TweetID === tweetID);
            if (!tweet) {
                return;
            }
            if (tweet && tweet.user.UserTag === this.user.UserTag) {
                return;
            }
            
            if (tweet.isRetweeted) {
                this.buttonDisabled = true;
                this.unretweetTweet(tweet.TweetID);
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 1500);
            } else {
                this.buttonDisabled = true;
                this.retweetTweet(tweet.TweetID);
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 1500);
            }
        },

        async retweetTweet(tweetID) {
            try {
                const response = await axios.post(`/api/tweets/retweet`, { tweetId: tweetID });

                console.log('Retweet Response:', response);

                if (response.status === 201) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetID);
                    if (tweet) {
                        tweet.isRetweeted = true;
                        tweet.retweet_count += 1;
                    }
                }
            } catch (error) {
                console.error('Error retweeting the tweet:', error);
            }
        },

        async unretweetTweet(tweetId) {
            try {
                const response = await axios.delete(`/api/tweets/unretweet/${tweetId}`);

                console.log('Unretweet Response:', response);

                if (response.status === 200) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetId);
                    if (tweet) {
                        tweet.isRetweeted = false;
                        tweet.retweet_count -= 1;
                    }
                }
            } catch (error) {
                console.error('Error unretweetin the tweet:', error);
            }
        },
        toggleBookmark(tweetID) {
            if (this.buttonDisabled) {
                return;
            }
            const tweet = this.tweets.find((t) => t.TweetID === tweetID);
            if (!tweet) {
                return;
            }
            if (tweet.isBookmarked) {
                this.buttonDisabled = true;
                this.removeBookmark(tweet.TweetID);
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 1500);
            } else {
                this.buttonDisabled = true;
                this.createBookmark(tweet.TweetID);
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 1500);
            }
        },
        async createBookmark(tweetID) {
            try {
                const response = await this.$axios.post(`/api/tweets/bookmark`, { tweetId: tweetID });
                console.log('Bookmark Response:', response);
                if (response.status === 201) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetID);
                    if (tweet) {
                        tweet.isBookmarked = true;
                        // tweet.like_count += 1;
                    }
                }
            } catch (error) {
                console.error('Error bookmarking the tweet:', error);
            }
        },

        async removeBookmark(tweetId) {
            try {
                const response = await this.$axios.delete(`/api/tweets/unbookmark/${tweetId}`);
                console.log('Unbookmark Response:', response);
                if (response.status === 200) {
                    const tweet = this.tweets.find((t) => t.TweetID === tweetId);
                    if (tweet) {
                        tweet.isBookmarked = false;
                    }
                    this.tweets = this.tweets.filter((tweet) => tweet.TweetID !== tweetId);
                }
            } catch (error) {
                console.error('Error unbookmarking the tweet:', error);
            }
        },
    },

    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.getTweets('bookmark');
    },
}

</script>

<style lang="scss" scoped>
.bookmarks-container{
    width:100%;
    height:auto;
    color:white;
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
    height:60px;
    width:100%;
    background-color:rgba($color: #000000, $alpha: 0.8);
    border-bottom:solid 1px #2F3336;
    position:sticky;
    top:0;
    z-index:9;
    box-sizing: border-box;
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    padding:0 10px;

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
        &:hover{
            background-color: rgba($color: #1a1a1a, $alpha: 1);
        }
    }
    .bookmarks-top{
        height:100%;
        width:auto;
        display:flex;
        flex-direction: column;
        padding:10px;
        padding: 10px 10px 0px 30px;
        box-sizing: border-box;
        .title{
            width:100%;
            height:50%;
            display:flex;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            font-weight: bold;
            font-size: 20px;
            margin:0;
            padding:0;
        }
        .user-tag{
            width:100%;
            height:50%;
            margin:0;
            padding:0;
            font-size: 15px;
            color:#6A6F74;
        }
    }
}
.post-container{
    padding-top:0px;
    padding-bottom:80px;
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
    .no-posts{
        width:100%;
        height:auto;
        display:flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        padding:20px;
        color:#6A6F74;
        font-weight: bold;
        font-size:18px;
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
                    word-wrap: break-word;
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
                    min-width:100%;
                    max-height:100%;
                    border:solid 1px #2F3336;
                    background:none;
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
                .bookmark-btn:hover{
                    .icon-container{
                        background-color: rgba($color: #ffe920, $alpha: 0.2);
                        .post-icon{
                            color:#ffe920;
                        }
                    }
                    .post-btn-nr{
                        color:#ffe920;
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
    .liked{
        color:#F31C80 !important;
    }
    .retweeted{
        color:#00BA7C !important;
    }
    .bookmarked{
        color:#ffe920 !important;
    }
    .post-icon{
        visibility: visible !important;
    }
    .top2{
        display:none;
    }
    .post:hover{
        background-color: #080808;
    }
}
.comment-popup{
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
                transition: all 0.3s;
                .tweet-img-label{
                    width:100%;
                    height:100%;
                    display:flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0;
                    padding: 0;
                }
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
        .popup-button:hover{
            background-color: #1d8dd7;
        }
        .popup-button:disabled{
            background-color: #0F4E78;
            color:#808080;
        }
    }
}
@media (max-width: 500px){
.top-bar{
    height:50px;
    .back-icon{
        width:40px;
        height:40px;
        font-size:20px;
    }
    .bookmarks-top{
        padding: 5px 5px 0px 25px;
        .title{
            font-size: 18px;
        }
        .user-tag{
            font-size: 14px;
        }
    }
}
.post-container{
    .left-side, .post-top{
            display:none !important;
        }
    .no-posts{
        padding:15px;
        font-size:13px;
    }
    .post{
        gap:5px!important;
        padding:15px 10px 5px 10px;
        cursor:pointer;
        .right-side{
            width:100% !important;
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
                            font-size: 14px;
                            color:white;
                        }
                        .usertag{
                            margin:0;
                            font-size: 14px;
                            color:#6A6F74;
                        }
                        .time-posted{
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
                        font-size:14px;
                    }
                }
            }
            .content-img{
                padding:0!important;
            }
            .bottom{
                height:30px!important;
                .post-btn-container{
                    width:auto;
                    height:100%;
                    border-radius:50%;
                    cursor:pointer;
                    .post-btn-nr{
                        color:#6A6F74;
                        font-size:10px !important;
                        padding-top:1px;
                    }
                }
                .icon-container{
                    height:30px;
                    width:30px;
                    background:none;
                    border-radius:50%;
                    border:none;
                    display:flex;
                    justify-content: center;
                    align-items: center;
                    cursor:pointer;
                    .post-icon{
                        font-size:18px;
                        color:#71767B;
                        --ionicon-stroke-width: 30px;
                    }
                    
                }
            }
        }
    }
}
.comment-popup{
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


