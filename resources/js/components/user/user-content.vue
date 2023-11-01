<template>
    <div class="tweets-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="profile-top">
                <p class="title" v-if="profileuser">{{ profileuser.Name }}</p>
                <p class="tweet_count">{{ tweet_count }} posts</p>
            </div>
        </div>
        <div class="profile-info">
            <div class="banner">
                <img>
                <div class="profile-picture">
                    <img>
                </div>
            </div>
            <div class="edit-button-div">
                <button class="edit-profile" @click="() => TogglePopup('EditTrigger')">Edit profile</button>
            </div>
            <div class="profile-details" v-if="profileuser">
                <div class="user-info">
                    <div class="name">{{ profileuser.Name }}</div>
                    <div class="username">{{ profileuser.UserTag }}</div>
                </div>
                <div class="description">{{ profileuser.Description }}</div>
                <div class="join-date"><ion-icon name="calendar-outline" class="callendar-icon"></ion-icon>{{ profileuser.create_date }}</div>
                <div class="follow-info">
                    <p><span class="bold">{{ profileuser.following_count }}</span>Following</p>
                    <p><span class="bold">{{ profileuser.follower_count }}</span>Followers</p>
                </div>
            </div>
        </div>
        <div class="post-type">
            <button @click="switchToTweets" class="post-type-btn" :class ="{ 'active-post-type': postType == 'tweets' }">Posts<div class="active-line" :class ="{ 'active': postType == 'tweets' }"></div></button>
            <button @click="switchToReplies" class="post-type-btn" :class ="{ 'active-post-type': postType == 'replies' }">Replies<div class="active-line" :class ="{ 'active': postType == 'replies' }"></div></button>
            <button @click="switchToLikes" class="post-type-btn" :class ="{ 'active-post-type': postType == 'likes' }">Likes<div class="active-line" :class ="{ 'active': postType == 'likes' }"></div></button>
        </div>
        <div class="post-container" v-if="profileuser">
            <div class="post" v-for="tweet in tweets" :key="tweet.TweetID"  @click="openTweet(tweet.TweetID)">
                <div class="left-side">
                    <img  @click.stop="openProfile(tweet.user.UserTag)">
                </div>
                <div class="right-side">
                    <div class="retweeted" v-if="tweet.isRetweet">
                        <p class="tweet-text"><span>{{ profileuser.UserTag }}</span> Reposted</p>
                    </div>
                    <!-- ############################################# -->
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
                            <p class="post-btn-nr" :class="{ 'bookmarked': tweet.isBookmarked }"></p>
                        </button>
                    </div>
                </div>
            </div>
            <div class="no-posts">{{ profileuser.UserTag }} currently has no more {{ postType }}</div>
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
        <Popup v-if="popupTriggers.EditTrigger" :TogglePopup="() => TogglePopup('EditTrigger')">
            <div class="edit-popup">
                <p class="title">Edit profile</p>
                <button class="save-btn">Save</button>
                <div class="content">
                    <div class="banner">
                        <img>
                        <div class="banner-input">
                            <button class="image-btn">
                                <input type="file" id="banner-img-input" @change="onImageChange" hidden>
                                <label for="banner-img-input" class="image-label">
                                    <ion-icon name="images-outline" class="image-icon"></ion-icon>
                                </label>
                            </button>
                        </div>
                        <div class="profile-picture">
                            <img>
                            <div class="pfp-input">
                                <button class="image-btn">
                                    <input type="file" id="pfp-img-input" @change="onImageChange" hidden>
                                    <label for="pfp-img-input" class="image-label">
                                        <ion-icon name="images-outline" class="image-icon"></ion-icon>
                                    </label>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="edit-name">
                        <div class="input-wrap">
                            <input type="text" id="name-input" class="Edit-Input" autocomplete="off" maxlength="30" required>
                            <label for="name-input">Name</label>
                        </div>
                        <div v-if ="NameError" class="warning-1">{{ NameError }}</div>
                    </div>
                    <div class="edit-description">
                        <div class="input-wrap">
                            <textarea id="desc-input" class="Edit-Input" rows="1" @input="autoSize" ref="DescInput" maxlength="255" required></textarea>
                            <label for="desc-input">Description</label>
                        </div>
                        <div v-if ="NameError" class="warning-1">{{ NameError }}</div>
                    </div>
                </div>
            </div>
        </Popup>
    </div>
</template>
<script>
import { ref } from 'vue';
import Popup from '../Popup.vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { mapState } from 'vuex';
export default{
    name: 'profile',
    components: {
        Popup,
    },
    data(){
        return {
            tweet_count:0,
            tweets: [],
            likes: [],
            replies: [],
            comments: [],
            profileuser: null,
            postType: 'tweets',
            comment_text_input: '',
        }
    },
    computed:{
        ...mapState(['user']),
        currentPosts() {
            if (this.postType === 'tweets') {
                return this.tweets;
            } else if (this.postType === 'replies') {
                return this.replies;
            } else if (this.postType === 'likes') {
                return this.likes;
            }
            return [];
        },
    },
    setup(){
        const router = useRouter();
        const store = useStore();
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
            EditTrigger: false,
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
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        switchToTweets() {
            this.postType = 'tweets';
        },
        switchToReplies() {
            this.postType = 'replies';
        },
        switchToLikes() {
            this.postType = 'likes';
        },
        autoSize() {
            const maxRows = 15;
            const textarea = this.$refs.DescInput;
            textarea.style.height = 'auto';
            const customLineHeight = 1;
            const maxHeight = maxRows * customLineHeight * parseFloat(getComputedStyle(textarea).fontSize);

            if (textarea.scrollHeight <= maxHeight) {
                textarea.style.height = textarea.scrollHeight + 'px';
            } else {
                textarea.style.height = maxHeight + 'px';
            }
        },
        onImageChange(event) {
            this.BannerImage = event.target.files[0];
            if (this.BannerImage) {
                // Create a URL for the selected image and set it as the preview
                this.PrevBannerImage = URL.createObjectURL(this.tweetImagenav);
            } else {
                this.PrevBannerImage = null;
            }
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
                const response = await this.$axios.post(`/api/tweets/like`, { tweetId: tweetID });
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
                const response = await this.$axios.delete(`/api/tweets/unlike/${tweetId}`);
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
                const response = await this.$axios.post(`/api/tweets/retweet`, { tweetId: tweetID });

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
                const response = await this.$axios.delete(`/api/tweets/unretweet/${tweetId}`);

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
                        // tweet.like_count -= 1;
                    }
                }
            } catch (error) {
                console.error('Error unbookmarking the tweet:', error);
            }
        },
        getSpecificUserTweets(userTag) {
            this.$axios.get(`/api/user-tweets/${userTag}`) // Adjust the URL based on your Laravel routes
            .then((response) => {
                this.tweets = response.data.tweets;
                this.tweet_count = response.data.tweet_count;
            })
            .catch((error) => {
                console.error(error);
            });
        },
        getUserInfo(userTag){
            this.$axios.get('/api/get-user-tag/' + userTag)
            .then(response => {
                this.profileuser = response.data.user;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    watch:{
    },
    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.getUserInfo(this.$route.params.UserTag);
        this.getSpecificUserTweets(this.$route.params.UserTag);
    },
}
</script>
<style lang="scss" scoped>
.warning-1 {
    color: red;
    font-size: 12px;
}
.tweets-container{
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
    .profile-top{
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
        .tweet_count{
            width:100%;
            height:50%;
            margin:0;
            padding:0;
            font-size: 15px;
            color:#6A6F74;
        }
    }
}
.profile-info{
    width:100%;
    height:auto;
    display:flex;
    flex-direction: column;
    box-sizing: border-box;
    .banner{
        width:100%;
        height:200px;
        position: relative;
        img{
            height:100%;
            width:100%;
            border:none;
            background: gray;
        }
        .profile-picture{
            position: absolute;
            width:140px;
            height:140px;
            bottom: -70px;
            left: 20px;
            z-index:5;
            img{
                height:100%;
                width:100%;
                background: white;
                border-radius: 50%;
                border:4px solid black;
            }
        }
    }
    .edit-button-div{
        width:100%;
        height:70px + 8px;
        display:flex;
        justify-content: flex-end;
        align-items: center;
        padding: 0px 20px;
        box-sizing: border-box;
        .edit-profile{
            padding:10px 15px; 
            color:white;
            font-size: 17px;
            font-weight: bold;
            border:1px solid #6A6F74;
            border-radius: 50px;
            background-color: #000000;
        }
    }
    .profile-details{
        width:100%;
        height:auto;
        display:flex;
        flex-direction: column;
        box-sizing: border-box;
        padding:15px;
        gap:15px;
        .user-info{
            width:100%;
            height:auto;
            display:flex;
            flex-direction: column;
            align-items: flex-start;
            box-sizing: border-box;
            .name{
                font-weight: bold;
                font-size: 20px;
                margin:0;
                padding:0;
            }
            .username{
                color: #6A6F74;
                font-size: 16px;
                margin:0;
                padding:0;
            }
        }
        .description{
            font-size: 16px;
            margin:0;
            padding:0;
        }
        .join-date{
            color:#6A6F74;
            font-size: 16px;
            margin:0;
            padding:0;
            display:flex;
            flex-direction: row;
            align-items: center;
            .callendar-icon{
                font-size:16px;
                padding-right:5px;
            }
        }
        .follow-info{
            width:100%;
            height:auto;
            display:flex;
            flex-direction: row;
            align-items: center;
            gap:10px;
            p{
                color:#6A6F74;
                font-size: 16px;
                margin:0;
                padding:0;
                .bold{
                    color:white;
                    font-weight: bold;
                    padding-right:5px;
                }
            }
        }
    }
}
.post-type{
    width:100%;
    height:50px;
    display:flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-evenly;
    box-sizing: border-box;
    margin-top:10px;
    border-bottom:solid 1px #2F3336;
    .post-type-btn{
        height:100%;
        width:100%;
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
        &:hover{
            background-color:rgba($color: #202223, $alpha: 0.8);
        }
    }
    .active-post-type{
        color:white;
        font-weight: 700;
    }
    .active-line{
        height:4px;
        width:75px;
        background-color: #1D9BF0;
        border-radius:5px;
        position:absolute;
        bottom:1px;
        display:none;
        left: 50%;
        transform: translateX(-50%);
        &.active{
            display:block;
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
.edit-popup{
    width:500px;
    min-height:550px;
    display:flex;
    flex-direction:column;
    gap:10px;
    padding:50px 20px 10px 20px;
    box-sizing: border-box;
    .title{
        margin:0;
        padding:0;
        font-weight: bold;
        font-size: 22px;
    }
    .save-btn{
        position:absolute;
        top:10px;
        right:10px;
        width:auto;
        height:auto;
        display:flex;
        align-items: center;
        justify-content: center;
        color:#000000;
        border:none;
        background-color: white;
        border-radius: 50px;
        font-size: 14px;
        font-weight: bold;
        padding:8px 16px;
    }
    .content{
        width:100%;
        height:auto;
        display:flex;
        flex-direction: column;
        gap:10px;
        box-sizing: border-box;
        .banner{
            width:100%;
            height:160px;
            position: relative;
            box-sizing: border-box;
            img{
                height:100%;
                width:100%;
                border:none;
                background: white;
            }
            .banner-input{
                position:absolute;
                top:50%;
                left:50%;
                transform: translate(-50%, -50%);
            }
            .profile-picture{
                position: absolute;
                width:110px;
                height:110px;
                bottom: -60px;
                left: 20px;
                box-sizing: border-box;

                img{
                    height:100%;
                    width:100%;
                    background: white;
                    border-radius: 50%;
                    box-sizing: border-box;
                    border:4px solid black;
                }
                .pfp-input{
                    position:absolute;
                    top:50%;
                    left:50%;
                    transform: translate(-50%, -50%);
                }
            }
            .image-btn{
                width:40px;
                height:40px;
                border-radius:50%;
                border:none;
                background-color:rgba($color: #000000, $alpha: 0.5);
                margin: 0;
                padding: 0;
                &:hover{
                    background-color:rgba($color: #000000, $alpha: 0.6);
                }
                .image-label{
                    width:100%;
                    height:100%;
                    display:flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0;
                    padding: 0;
                    .image-icon{
                        color:white;
                        font-size: 18px;
                    }
                }
            }
        }
        .input-wrap{
            border: none;
            border-radius:6px;
            font-family: Arial, sans-serif;
            position:relative;
            width:auto;
            height: 60px;
            box-sizing: border-box;
            display:flex;
            .Edit-Input{
                font-family: Arial, sans-serif;
                box-sizing:border-box;
                border: 1px solid #434343;
                color:#ffffff;
                padding: 20px 13px 5px 13px;
                outline:none;
                background: none;
                position:relative;
                display:flex;
                width:100%;
                height:100%;
                border-radius:6px;
                font-size:18px;
                resize: none;
                overflow: hidden;
                transition: 0.3s all;
                &:disabled{
                    color:#808080;
                }
                &:focus{
                    border:1px solid #1da1f2;
                }
            }
            label{
                font-size:18px;
                color:#434343;
                padding:5px;
                position:absolute;
                top:15px;
                left:5px;
                pointer-events: none;
                transition: 0.3s all;
            }
            .Edit-Input:focus+label,
            .Edit-Input:disabled+label,
            .Edit-Input:valid+label{
                font-size:16px;
                top:5px;
                left:7px;
                padding:0 5px 0 5px;
            }
            .Edit-Input:focus+label{
                color:#1da1f2;
            }
        }
        .edit-name{
            padding-top:60px;
        }
    }

}

@media (min-width: 500px) {
}
@media (max-width: 500px) {
.top-bar{
    height:50px;
    .back-icon{
        width:40px;
        height:40px;
        font-size:20px;
    }
    .profile-top{
        padding: 5px 5px 0px 25px;
        .title{
            font-size: 18px;
        }
        .tweet_count{
            font-size: 14px;
        }
    }
}
.profile-info{
    .banner{
        height:130px;
        img{
            background: gray;
        }
        .profile-picture{
            width:90px;
            height:90px;
            bottom: -45px;
            left: 10px;
            img{
                border:2px solid black;
            }
        }
    }
    .edit-button-div{
        height:45px + 4px;
        padding: 0px 10px;
        .edit-profile{
            padding:5px 10px; 
            font-size: 14px;
        }
    }
    .profile-details{
        padding:10px;
        gap:10px;
        .user-info{
            .name{
                font-size: 16px;
            }
            .username{
                font-size: 14px;
            }
        }
        .description{
            font-size: 14px;
        }
        .join-date{
            font-size: 14px;
            .callendar-icon{
                font-size:14px;
                padding-right:4px;
            }
        }
        .follow-info{
            gap:8px;
            p{
                font-size: 14px;
                .bold{
                    padding-right:4px;
                }
            }
        }
    }
}
.post-type{
    height:35px;
    margin-top:5px;
    .post-type-btn{
        padding:5px;
        font-size: 14px;
        font-weight:600;
        &:hover{
            background-color:rgba($color: #202223, $alpha: 0.8);
        }
    }
    .active-line{
        height:2px;
        width:50px;
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
.edit-popup{
    width:100%;
    min-height:450px;
    gap:5px;
    padding:40px 10px 10px 10px;
    .title{
        margin:0;
        padding:0;
        font-weight: bold;
        font-size: 16px;
    }
    .save-btn{
        position:absolute;
        top:5px;
        right:5px;
        font-size: 12px;
        padding:7px 14px;
    }
    .content{
        width:100%;
        height:auto;
        gap:10px;
        .banner{
            width:100%;
            height:100px;
            .profile-picture{
                width:80px;
                height:80px;
                bottom: -45px;
                left: 15px;
                img{
                    border:3px solid black;
                }
            }
            .image-btn{
                width:35px;
                height:35px;
                .image-label{
                    .image-icon{
                        color:white;
                        font-size: 15px;
                    }
                }
            }
        }
        .input-wrap{
            border-radius:6px;
            height: 40px;
            .Edit-Input{
                padding: 13px 13px 1px 7px;
                width:100%;
                height:100%;
                font-size:13px;
            }
            label{
                font-size:13px;
                padding:5px;
                top:5px;
                left:2px;
            }
            .Edit-Input:focus+label,
            .Edit-Input:disabled+label,
            .Edit-Input:valid+label{
                font-size:12px;
                top:4px;
                left:2px;
                padding:0 5px 0 5px;
            }
        }
        .edit-name{
            padding-top:40px;
        }
    }

}
}
</style>