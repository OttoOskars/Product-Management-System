<template>
    <div class="tweet-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <button class="back-btn" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="title">Tweet</div>
        </div>
        <div class="post-container">
            <div class="post" v-if="tweet && tweet.user"> 
                <div class="left-side">
                    <img @click.stop="openProfile(tweet.user.UserID)" :src="'/storage/' + tweet.user.ProfilePicture">
                </div>
                <div class="right-side">
                    <div class="top2">
                        <div class="person-image">
                            <img @click.stop="openProfile(tweet.user.UserID)" :src="'/storage/' + tweet.user.ProfilePicture">
                        </div>
                        <div class="info-content">
                            <div class="userinfo">
                                <p class="username">{{ tweet.user.Name }}</p>
                                <p class="usertag">{{ tweet.user.UserTag }}</p>
                                <p class="time-posted">{{ tweet.created_ago }}</p>
                            </div>
                            <div class="content-text">
                                <p v-if="tweet.TweetText">{{ tweet.TweetText }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="post-top">
                        <div class="userinfo">
                            <p class="username">{{ tweet.user ? tweet.user.Name : 'Unknown User' }}</p>
                            <p class="usertag">{{ tweet.user ? tweet.user.UserTag : 'Unknown User' }}</p>
                            <p class="time-posted">{{tweet.created_ago}}</p>
                        </div>
                        <div class="content-text">
                            <p v-if="tweet.TweetText">{{tweet.TweetText}}</p>
                        </div>
                    </div>
                    <div class="content-img">
                        <img v-if="tweet.TweetImage" :src="'/storage/' + tweet.TweetImage"/>
                    </div>
                    <div class="bottom">
                        <button class="post-btn-container heart-btn" @click.stop="toggleLike(tweet.TweetID)" :disabled="buttonDisabled">
                            <div class="icon-container"><ion-icon :name="tweet.isLiked ? 'heart' : 'heart-outline'" class="post-icon" :class ="{ 'liked': tweet.isLiked }"></ion-icon></div>
                            <p class="post-btn-nr" :class ="{ 'liked': tweet.isLiked }">{{ tweet.like_count }}</p>
                        </button>
                        <button class="post-btn-container comment-btn" @click.stop="() => TogglePopup('CommentTrigger')" :disabled="buttonDisabled">
                            <div class="icon-container"><ion-icon name="chatbox-outline" class="post-icon"></ion-icon></div>
                            <p class="post-btn-nr">{{ tweet.comment_count }}</p>
                        </button>
                        <button class="post-btn-container retweet-btn" @click.stop="toggleRetweet(tweet.TweetID)" :disabled="buttonDisabled">
                            <div class="icon-container"><ion-icon :name="tweet.isRetweeted ? 'arrow-redo' : 'arrow-redo-outline'" class="post-icon" :class ="{ 'retweeted': tweet.isRetweeted }"></ion-icon></div>
                            <p class="post-btn-nr" :class ="{ 'retweeted': tweet.isRetweeted }">{{ tweet.retweet_count }}</p>
                        </button>
                        <button class="post-btn-container bookmark-btn" @click.stop="toggleBookmark(tweet.TweetID)">
                            <div class="icon-container">
                                <ion-icon :name="tweet.isBookmarked ? 'bookmark' : 'bookmark-outline'" class="post-icon" :class="{ 'bookmarked': tweet.isBookmarked }"></ion-icon>
                            </div>
                            <p class="post-btn-nr" :class="{ 'bookmarked': tweet.isBookmarked }"></p>
                        </button>
                    </div>
                </div>
            </div>
            <div class="create-tweet" v-if="user">
                <div class="left-side">
                    <img  @click="openProfile(user.UserID)" :src="'/storage/' + user.ProfilePicture">
                </div>
                <div class="right-side">
                    <div class="replyinginfo">                   
                        <p class="replying-to">Replying to </p>
                        <p class="profiletag" v-if="tweet && tweet.user">{{ tweet.user.UserTag }}</p>
                    </div>
                    <div class="top">
                        <div class="tweet-input-container">
                            <textarea v-model="main_comment_text_input" id="tweet-input" class="tweet-input" rows="1" placeholder="Post your reply" @input="autoSize" ref="tweetInput" maxlength="255"></textarea>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="buttons">
                            <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                            <button class="tweet-btn"><ion-icon name="attach-outline" class="create-tweet-icon"></ion-icon></button>
                        </div>
                        <button class="post-button" @click="createComment(tweet.TweetID, main_comment_text_input)" :disabled="buttonDisabled">Reply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-container">
            <div class="comment" v-for="comment in comments" :key="comment.CommentID">
                <div class="left">
                    <img @click.stop="openProfile(comment.user.UserID)" :src="'/storage/' + comment.user.ProfilePicture">
                    <div class="content">
                        <div class="userinfo">
                            <p class="username">{{ comment.user.Name }}</p>
                            <p class="usertag">{{ comment.user.UserTag }}</p>
                            <p class="time-posted">{{ comment.created_ago }}</p>
                        </div>
                        <div class="content-text">
                            <p>{{ comment.CommentText }}</p>
                        </div>
                    </div>
                </div>
                <button class="delete-btn" @click="deleteComment(comment.TweetID, comment.CommentID)" v-if="comment.user && comment.user.UserID === user.UserID">
                        <ion-icon name="trash-bin-outline" class="delete-icon"></ion-icon>
                </button>
            </div>
        </div>
    </div>
    <Popup v-if="popupTriggers.CommentTrigger" :TogglePopup="() => TogglePopup('CommentTrigger')">
        <div class="create-popup">
            <div class="top">
                <div class="left-side-popup">
                    <img  @click="openProfile(user.UserID)" :src="'/storage/' + user.ProfilePicture">
                </div>
                <div class="right-side-popup">
                    <div class="userinfo-popup">
                        <p class="username">{{ user.Name }}</p>
                        <p class="usertag">{{ user.UserTag }}</p>
                    </div>
                    <div class="tweet-input-container">
                        <textarea v-model="popup_comment_text_input" id="tweet-input-comment" class="tweet-input" rows="1" placeholder="Post your reply" @input="autoSize" ref="tweetInput" maxlength="255"></textarea>
                    </div>
                </div>
            </div>

            <div class="bottom">
                <div class="buttons">
                    <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                    <button class="tweet-btn"><ion-icon name="attach-outline" class="create-tweet-icon"></ion-icon></button>
                </div>
                <button class="popup-button" @click="createComment(tweet.TweetID, popup_comment_text_input)" :disabled="buttonDisabled">Comment</button><!-- Izdomā kā comment poga nodos tweetID. -->
            </div>
        </div>
    </Popup>
</template>
<script>
import { ref } from 'vue';
import Popup from '../Popup.vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { mapState } from 'vuex';
export default {
    name: 'Tweet',
    components: {
        Popup,
    },
    data() {
        return {
            tweet: null,
            comments: [],
            main_comment_text_input: '',
            popup_comment_text_input: '',
            buttonDisabled: false,
        };
    },
    created() {
    },
    setup() {
        const store = useStore();
        const router = useRouter();
        const popupTriggers = ref({
            CommentTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger]
            if (!popupTriggers.value[trigger]) {
            }
		}
        return {
            popupTriggers,
            TogglePopup
        }
    },
    computed: {
        ...mapState(['user']),
    },
    methods: {
        fetchCommentsByTweet(tweetID) {
            fetch(`api/comments/${tweetID}`)
            .then((response) => response.json())
            .then((data) => {
                this.comments = data.comments;
            })
            .catch((error) => {
                console.error('Error fetching comments:', error);
            });
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
                const response = await this.$axios.post('/api/create-comments', {
                    tweetId: tweetID,
                    commentText: commentText,
                });
                const newComment = response.data.comment;
                const userResponse = await this.$axios.get(`/api/get-user/${newComment.UserID}`);
                newComment.user = userResponse.data.user;
                this.comments.push(newComment);
                this.main_comment_text_input = '';
                this.popup_comment_text_input = '';
                this.tweet.comment_count++;
                this.popupTriggers.CommentTrigger = false;
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 2000);
            } catch (error) {
                console.error('Error creating comment:', error);
                this.buttonDisabled = false;
            }
        },
        deleteComment(tweetID, commentID) {
            if (confirm('Are you sure you want to delete this comment?')) {
                this.performDeleteComment(tweetID, commentID);
            }
        },
        async performDeleteComment(tweetID, commentID) {
            if (!commentID) {
                console.error('Comment ID not provided');
                return;
            }
            try {
                await this.$axios.delete(`/api/delete-comments/${commentID}`);
                this.comments = this.comments.filter((comment) => comment.CommentID !== commentID);
                this.tweet.comment_count--;
                this.fetchCommentsByTweet(tweetID);
                console.log(`Comment with ID ${commentID} deleted successfully.`);
            } catch (error) {
                console.error('Error deleting comment:', error);
            }
        },
        openProfile(userID) {
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
        goBack() {
            this.$router.go(-1);
        },
        toggleLike(tweetID) {
            const tweet = this.tweet;
            if (this.buttonDisabled) {
                return;
            }
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
                // Send an API request to like the tweet by sending the tweetId
                const response = await this.$axios.post(`/api/tweets/like`, { tweetId: tweetID });

                console.log('Like Response:', response);

                if (response.status === 201) {
                    // Update the tweet's like status and count
                    const tweet = this.tweet;
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
                const response = await this.$axios.delete(`/api/tweets/unlike/${tweetId}`);

                console.log('Unlike Response:', response);

                if (response.status === 200) {
                    const tweet = this.tweet;
                    if (tweet) {
                        tweet.isLiked = false;
                        tweet.like_count -= 1;
                    }
                }
            } catch (error) {
                console.error('Error unliking the tweet:', error);
            }
        },
        toggleRetweet(tweetID) {
            const tweet = this.tweet
            if (this.buttonDisabled) {
                return;
            }
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
                const response = await this.$axios.post(`/api/tweets/retweet`, { tweetId: tweetID });

                console.log('Retweet Response:', response);

                if (response.status === 201) {
                    const tweet = this.tweet
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
                const response = await this.$axios.delete(`/api/tweets/unretweet/${tweetId}`);

                console.log('Unretweet Response:', response);

                if (response.status === 200) {
                    const tweet = this.tweet
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
            const tweet = this.tweet;
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
                    const tweet = this.tweet;
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
                    const tweet = this.tweet;
                    if (tweet) {
                        tweet.isBookmarked = false;
                        // tweet.like_count -= 1;
                    }
                }
            } catch (error) {
                console.error('Error unbookmarking the tweet:', error);
            }
        },
    },
    async mounted() {
        this.tweet = this.$route.params.tweet;
        await this.$store.dispatch('initializeApp');
        this.$axios.get('/api/tweetdata/' + this.$route.params.tweetID)
        .then(response => {
            this.tweet = response.data.tweet;
        })
        .catch(error => {
            console.error(error);
        });
        this.fetchCommentsByTweet(this.$route.params.tweetID);
    }
};
</script>

<style lang="scss" scoped>
.tweet-container{
    width:100%;
    height:auto;
    position:relative;
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
    .title{
        width:100%;
        display:flex;
        align-items: center;
        justify-content: flex-start;
        box-sizing: border-box;
        padding-left:20px;
        font-weight: bold;
        font-size: 22px;
    }
    .back-btn{
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
}
.post-container{
    padding-top:0px;
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    .create-tweet{
        width:100%;
        min-height:fit-content;
        display:flex;
        flex-direction:row;
        box-sizing: border-box;
        gap:10px;
        padding:15px;
        border-bottom: 1px solid #2F3336;

        .right-side{
            width:90%;
            height:100%;
            display:flex;
            gap:10px;
            flex-direction:column;
            .replyinginfo{
                width:100%;
                height:auto;
                display:flex;
                flex-direction:row;
                justify-content: flex-start;
                align-items: center;
                gap:5px;
                color:white;
                padding-top:2px;
                padding-left:5px;
                .replying-to{
                    margin:0;
                    font-size: 17px;
                    color:#6A6F74;
                }
                .profiletag{
                    margin:0;
                    font-size: 17px;
                    color:#1d8dd7;
                }
            }
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
                        padding:5px 5px;
                        &::-webkit-scrollbar{
                            width:4px;
                        }
                        &::-webkit-scrollbar-thumb{
                            background-color: #2F3336;
                            border-radius: 5px;;
                            border:none;
                        }
                        &::-webkit-scrollbar-track{
                            background:none;
                            border:none;
                        }
                        &:focus{
                            outline:none;
                            border-bottom:1px solid #2F3336;
                            padding: 5px 5px 15px 5px;
                        }
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
                        padding:0;
                        cursor:pointer;
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
                .post-button{
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
                .post-button:hover{
                    background-color: #1d8dd7;
                }
                .post-button:disabled{
                    background-color: #0F4E78;
                    color:#808080;
                }
            }
        }
    }
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

.comment-container{
    padding-bottom:80px;
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
}
.comment{
    width:100%;
    min-height:auto;
    display:flex;
    flex-direction:row;
    gap:10px;
    box-sizing: border-box;
    padding:15px 10px 5px 15px;
    border-bottom: 1px solid #2F3336;
    justify-content: space-between;
    position: relative;
    cursor:pointer;
    .left{
        width:auto;
        height:100%;
        display:flex;
        flex-direction:row;
        gap:15px;
        box-sizing: border-box;
        img{
            width:50px;
            height:50px;
            border-radius: 50%;
            background-color: white;
        }
        .content{
            flex-grow: 1;
            height:100%;
            display:flex;
            flex-direction: column;
            box-sizing: border-box;
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
                height:auto;
                width:100%;
                text-align: left;
                color:white;
                padding:0px;
                font-size:17px;
                overflow-wrap: break-word;
            }
        }
    }
    .delete-btn{
        height:25px;
        width:25px;
        background:none;
        border-radius:50%;
        border:none;
        display:flex;
        justify-content: center;
        align-items: center;
        padding:0;
        cursor:pointer;
        position:absolute;
        right:5px;
        top:5px;
        .delete-icon{
            font-size:16px;
            color:#f11515;
            --ionicon-stroke-width: 30px;
            visibility: visible;
        }
        &:hover{
            background-color: rgba($color: #f11515, $alpha: 0.1);
        }
    }
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
                    &::-webkit-scrollbar{
                        width:4px;
                    }
                    &::-webkit-scrollbar-thumb{
                        background-color: #2F3336;
                        border-radius: 5px;;
                        border:none;
                    }
                    &::-webkit-scrollbar-track{
                        background:none;
                        border:none;
                    }
                    &:focus{
                        outline:none;
                    }
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

@media (max-width: 500px) {
.top-bar{
    width:100%;
    height:35px;
    .title{
        font-size:17px !important;
    }
} 
.post-container{
    .create-tweet{
        gap:5px;
        padding:10px;
        .right-side{
            width:100%;
            .top{
                .tweet-input-container{
                    .tweet-input{
                        font-size: 16px;
                        padding:5px;
                    }
                }
            }
            .bottom{
                height:30px;
                .buttons{
                    gap:5px;
                    .tweet-btn{
                        height:30px;
                        width:30px;
                        cursor:pointer;
                        .create-tweet-icon{
                            font-size:18px;
                            color:#1D9BF0;
                            --ionicon-stroke-width: 40px;
                        }
                    }
                    .tweet-btn:hover{
                        background-color: rgba($color: #1D9BF0, $alpha: 0.1);
                    }
                }
                .post-button{
                    padding:5px 15px;
                    font-size: 14px;
                }
            }
        }
    }
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
.comment{
    width:100%;
    min-height:auto;
    gap:5px !important;
    .left{
        width:auto;
        height:100%;
        gap:5px;
        img{
            width:40px;
            height:40px;
            border-radius: 50%;
            background-color: white;
        }
        .content{
            max-width: 80%;
            height:100%;
            .userinfo{
                width:100%;
                height:10px;
                gap:7px;
                padding-top:2px;
                .username{
                    font-size: 15px;
                }
                .usertag{
                    font-size: 15px;
                }
                .time-posted{
                    font-size: 15px;
                }
            }
            .content-text{
                font-size:15px;
            }
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