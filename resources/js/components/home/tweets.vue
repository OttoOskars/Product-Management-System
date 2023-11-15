<template>
    <div class="content-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <div class="title">Home</div>
            <div class="title2" v-if="user">
                <div class="user-img" @click.stop="toggleProfilePopup"><img :src="'/storage/' + user.ProfilePicture"></div>
                <div class="logo">
                    <ion-icon name="logo-yahoo"></ion-icon>
                </div>
            </div>
            <div class="post-type">
                <button @click="switchToTweets" class="post-type-btn" :class ="{ 'active-post-type': postType == 'tweets' }">For you<div class="active-line" :class ="{ 'active': postType == 'tweets' }"></div></button>
                <button @click="switchToFollowing" class="post-type-btn" :class ="{ 'active-post-type': postType == 'following_tweets' }">Following<div class="active-line" :class ="{ 'active': postType == 'following_tweets' }"></div></button>
            </div>
        </div>
        <div class="post-container">
            <div class="create-tweet-or-comment">
                <div class="left-side">
                    <img v-if="user" @click="openProfile(user.UserTag)" :src="'/storage/' + user.ProfilePicture">
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="tweet-input-container">
                            <textarea v-model="tweet_text_input" id="tweet-input" class="tweet-input" rows="1" placeholder="What's happening?!" @input="autoSize('tweetInput')" ref="tweetInput" maxlength="255"></textarea>
                        </div>
                    </div>
                    <div class="tweet-image-preview">
                        <img :src="previewImage" v-if="previewImage">
                    </div>
                    <div class="bottom">
                        <div class="buttons">
                            <button class="tweet-btn"><input type="file" accept="image/png, image/gif, image/jpeg, video/mp4,video/x-m4v,video/*" id="tweet-img-input" @change="onImageChange" hidden><label for="tweet-img-input" class="tweet-img-label"><ion-icon name="images-outline" class="create-tweet-icon"></ion-icon></label></button>
                            <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                            <button class="tweet-btn" @click.stop="TogglePopup('MentionTrigger', 'tweet')"><ion-icon name="at-sharp" class="create-tweet-icon"></ion-icon></button>
                        </div>
                        <button class="post-button" @click="createTweet" :disabled="buttonDisabled">Post</button>
                    </div>
                </div>
            </div>
            <div class="post" v-for="tweet in currentPosts" :key="tweet.TweetID" @click="openTweet(tweet.TweetID)">
                <div class="isretweet" v-if="tweet.isRetweet">
                    <p class="tweet-text"><span>{{ user.UserTag }}</span> Reposted</p>
                </div>
                <div class="inner-post">
                    <div class="left-side">
                        <img @click.stop="openProfile(tweet.user.UserTag)" :src="'/storage/' + tweet.user.ProfilePicture">
                        <div class="horizontal-comment-line" v-if="postType === 'replies'"></div>
                    </div>
                    <div class="right-side">
                        <div class="top2">
                            <div class="person-image">
                                <img @click.stop="openProfile(tweet.user.UserTag)" :src="'/storage/' + tweet.user.ProfilePicture">
                                <div class="horizontal-comment-line" v-if="postType === 'replies'"></div>
                            </div>
                            <div class="info-content">
                                <div class="userinfo">
                                    <p class="username">{{tweet.user.Name}}</p>
                                    <p class="usertag">{{tweet.user.UserTag}}</p>
                                    <p class="time-posted">{{ tweet.created_ago }}</p>
                                </div>
                                <div class="content-text">
                                    <p v-if="tweet.TweetText" v-html="formatMentionText(tweet.TweetText)" @click.stop="handleMentionClick"></p>
                                </div>
                            </div>
                        </div>
                        <div class="post-top">
                            <div class="userinfo">
                                <p class="username">{{tweet.user.Name}}</p>
                                <p class="usertag">{{tweet.user.UserTag}}</p>
                                <p class="time-posted">{{ tweet.created_ago }}</p>
                            </div>
                            <div class="content-text">
                                <p v-if="tweet.TweetText" v-html="formatMentionText(tweet.TweetText)" @click.stop="handleMentionClick"></p>
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
            </div>
            <div class="no-posts" v-if="currentPosts.length === 0">Empty...🌵</div>
        </div>
    </div>
    <Popup v-if="popupTriggers.CommentTrigger" :TogglePopup="() => TogglePopup('CommentTrigger')">
        <div class="create-tweet-or-comment-popup">
            <div class="top">
                <div class="left-side-popup">
                    <img  @click="openProfile(user.UserTag)" :src="'/storage/' + user.ProfilePicture">
                </div>
                <div class="right-side-popup">
                    <div class="userinfo-popup">
                        <p class="username">{{ user.Name }}</p>
                        <p class="usertag">{{ user.UserTag }}</p>
                    </div>
                    <div class="tweet-input-container">
                        <textarea v-model="comment_text_input" id="tweet-input-comment" class="tweet-input" rows="1" placeholder="Post your reply" @input="autoSize('commentInput')" ref="commentInput" maxlength="255"></textarea>
                    </div>
                </div>
            </div>

            <div class="bottom">
                <div class="buttons">
                    <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                    <button class="tweet-btn" @click.stop="TogglePopup('MentionTrigger', 'comment')"><ion-icon name="at-sharp" class="create-tweet-icon"></ion-icon></button>
                </div>
                <button class="popup-button" @click="createComment(tweetIdInPopup, comment_text_input)" :disabled="buttonDisabled">Comment</button><!-- Izdomā kā comment poga nodos tweetID. -->
            </div>
        </div>
    </Popup>
    <Popup v-if="popupTriggers.MentionTrigger" :TogglePopup="() => TogglePopup('MentionTrigger')">
        <div class="mention-popup">
            <p class="title">Mention</p>
            <div class="search-input-container">
                <input 
                    type="text"
                    id="mention-input"
                    class="search-input" 
                    maxlength="30" 
                    placeholder="Search"
                    :class="{ 'focused': isInputFocused }"
                    @input="handleMentionInput"
                    @focus="inputFocus"
                    @blur="inputBlur"
                    v-model="mentionSearch"
                >
                <ion-icon name="search-outline" class="search-icon"></ion-icon>
                <button class="close-icon-btn" :class="{ 'focused': isInputFocused }">
                    <ion-icon name="close-circle-sharp" class="close-icon"></ion-icon>
                </button>
            </div>
            <div class="user-suggestions">
                <div class="user" v-for="user in filteredUsers" :key="user.UserID" @click="insertMention(user, mentionInputType)">
                    <div class="user-img">
                        <img @click="openProfile(user.UserTag)" :src="'/storage/' + user.ProfilePicture">
                    </div>
                    <div class="user-info">
                        <p class="username">{{ user.Name }}</p>
                        <p class="usertag">{{ user.UserTag }}</p>
                    </div>
                </div>
                <div class="no-users" v-if="filteredUsers.length === 0">
                    <p>No users found 🌵</p>   
                </div>
            </div>
        </div>
    </Popup>
    <div class="profile-popup" v-if="isPopupVisible">
        <div class="popup-content">
            <button class="logout-btn" @click="logoutUser">Logout</button>
            <button class="profile-btn" @click="openProfile(user.UserTag)">Profile</button>
        </div>
    </div>
</template>
<script>
import { ref, computed, watch } from 'vue';
import Popup from '../Popup.vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { mapState } from 'vuex';
export default{
    name: 'Tweets',
    components: {
        Popup,
    },
    data(){
        return {
            isInputFocused: false,
            users: [],
            tweets: [],
            following_tweets: [],
            postType: 'tweets',
            isPopupVisible: false,
            buttonDisabled:false,
            tweetIdInPopup: null,
        }
    },
    setup(){
        const mentionSearch = ref('');
        const comment_text_input = ref('');
        const tweet_text_input = ref('');
        const tweetImage = ref(null);
        const previewImage = ref(null);
        const router = useRouter();
        const store = useStore();
        const tweetInput = ref(null);
        const commentInput = ref(null);
        const mentionInputType = ref('tweet');
        const filteredUsers = ref([]);
        if (store.state.isLoggedIn) {
            router.push('/home');
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
            MentionTrigger: false,
        });
        const TogglePopup = (trigger, source) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger];
            if (trigger === 'MentionTrigger') {
                mentionSearch.value = '';
                filteredUsers.value = [];
                mentionInputType.value = source;
            }
        };
        return {
            popupTriggers,
            TogglePopup,
            logoutUser,
            comment_text_input,
            tweet_text_input,
            tweetImage,
            previewImage,
            mentionSearch,
            tweetInput,
            commentInput,
            mentionInputType,
            filteredUsers,
        }
    },
    computed: {
        ...mapState(['user']),
        currentPosts() {
            return this.postType === 'tweets' ? this.tweets : this.following_tweets;
        },
    },
    methods: {    
        inputFocus() {
            this.isInputFocused = true;
        },
        inputBlur() {
            this.isInputFocused = false;
        },
        formatMentionText(tweetText) {
            const mentionRegex = /@([a-zA-Z0-9_]+)/g;

            const parts = tweetText.split(mentionRegex);

            return parts.map((part, index) => {
                if (index % 2 === 1) {
                    const userTag = part;
                    const mentionedUser = this.users.find(user2 => {
                        return user2.UserTag === `@${userTag}`;
                    });

                    if (mentionedUser) {
                        return `<span class="mention-span" data-usertag="${mentionedUser.UserTag}">@${part}</span>`;
                    } else {
                        return part;
                    }
                } else {
                    return part;
                }
            }).join('');
        },
        handleMentionClick(event) {
            const target = event.target;
            if (target.classList.contains('mention-span')) {
                const userTag = target.getAttribute('data-usertag');
                this.openProfile(userTag);
            } else {
            }
        },
        insertMention(user, inputType) {
            const cursorPosition = inputType === 'tweet' ? this.tweetInput.value.selectionStart : this.commentInput.value.selectionStart;

            const textarea = inputType === 'tweet' ? this.tweetInput : this.commentInput;

            if (!textarea) {
                console.error("Textarea not found");
                return;
            }

            const mentionTag = `${user.UserTag}`;
            const cursorPos = textarea.selectionStart;
            const textBeforeCursor = textarea.value.substring(0, cursorPos);
            const textAfterCursor = textarea.value.substring(cursorPos);

            if (inputType === 'tweet') {
                this.tweet_text_input = textBeforeCursor + mentionTag + textAfterCursor;
            } else if (inputType === 'comment') {
                this.comment_text_input = textBeforeCursor + mentionTag + textAfterCursor;
            }

            this.TogglePopup('MentionTrigger');

            textarea.setSelectionRange(cursorPosition + mentionTag.length, cursorPosition + mentionTag.length);
        },
        clearSearch() {
            console.log('Clearing search...');
            this.mentionSearch = '';
        },
        handleMentionInput() {
            if (this.mentionSearch.length > 0) {
                this.filteredUsers = this.users.filter(user => {
                    const searchInputLower = this.mentionSearch.toLowerCase();
                    const userTagLower = user.UserTag.toLowerCase();
                    return userTagLower.includes(searchInputLower);
                });
            } else {
                this.filteredUsers = [];
            }
        },
        toggleProfilePopup() {
            this.isPopupVisible = !this.isPopupVisible;
            setTimeout(() => { this.isPopupVisible = false; }, 10000);
        },
        getTweets(type) {
        axios
            .get(`/api/tweets/${type}`)
            .then((response) => {
                this[type + '_tweets'] = response.data.tweets;
                if (type === 'all') {
                    this.tweets = response.data.tweets;
                }
            })
            .catch((error) => {
            console.error(error);
            });
        },
        onImageChange(event) {
            this.tweetImage = event.target.files[0];
            if (this.tweetImage) {
                this.previewImage = URL.createObjectURL(this.tweetImage);
            } else {
                this.previewImage = null;
            }
        },
        async createTweet() {
            if (this.buttonDisabled) {
                return;
            }
            const formData = new FormData();
            formData.append('tweetText', this.tweet_text_input);
            if (this.tweetImage) {
                formData.append('tweetImage', this.tweetImage);
            }
            try {
                this.buttonDisabled = true;

                const response = await this.$axios.post('/api/tweets', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                const newTweet = response.data.tweet;
                this.tweets.unshift(newTweet);
                this.tweet_text_input = '';
                this.comment_text_input = '';
                const textarea = this.tweetInput;
                const textarea2 = this.commentInput;
                if (textarea2){
                    textarea2.style.height = 'auto';
                }
                textarea.style.height = 'auto';
                this.tweetImage = null;
                this.previewImage = null;
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 2000);
            } catch (error) {
                console.error(error);
                this.buttonDisabled = false;
            }
        },
        deleteTweet(tweetId) {
            if (!tweetId) {
                console.log("Tweet ID not retrieved");
            return;
            }
            axios.delete(`/api/tweets/${tweetId}`)
            .then(response => {
                this.getTweets('all');
            })
            .catch(error => {
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
                await this.$axios.post('/api/create-comments', {
                    tweetId: tweetID,
                    commentText: commentText,
                });
                const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);

                tweet.comment_count++;
                this.popupTriggers.CommentTrigger = false;
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 2000);
            } catch (error) {
                console.error('Error creating comment:', error);
                this.buttonDisabled = false;
            }
        },
        switchToTweets() {
            this.postType = 'tweets';
        },
        switchToFollowing() {
            this.postType = 'following_tweets';
        },
        autoSize(ref) {
            const maxRows = 8;
            const textarea = this.$refs[ref];
            textarea.style.height = 'auto';
            const customLineHeight = 1;
            const maxHeight = maxRows * customLineHeight * parseFloat(getComputedStyle(textarea).fontSize);

            if (textarea.scrollHeight <= maxHeight) {
                textarea.style.height = textarea.scrollHeight + 'px';
            } else {
                textarea.style.height = maxHeight + 'px';
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
        toggleLike(tweetID) {
            if (this.buttonDisabled) {
                return;
            }
            const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
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
                    const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
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
                    const tweet = this.currentPosts.find((t) => t.TweetID === tweetId);
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
            const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
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
                    const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
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
                    const tweet = this.currentPosts.find((t) => t.TweetID === tweetId);
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
            const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
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
                    const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
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
                    const tweet = this.currentPosts.find((t) => t.TweetID === tweetId);
                    if (tweet) {
                        tweet.isBookmarked = false;
                        // tweet.like_count -= 1;
                    }
                }
            } catch (error) {
                console.error('Error unbookmarking the tweet:', error);
            }
        },
        getAllUsersMention() {
        axios
            .get('/api/all-users-mention')
            .then(response => {
                this.users = response.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.getTweets('all');
        this.getTweets('following');
        this.getAllUsersMention();
    },   
}
</script>
<style lang="scss" scoped>
.top-bar{
    height:120px;
    display:flex;
    flex-direction: column;
    position:sticky;
    top: 0;
    z-index:9;
    background-color: rgba($color: #000000, $alpha: 0.8);
    backdrop-filter: blur(5px);
    border-bottom:solid 1px #2F3336;
    .title{
        height:60px;
        width:100%;
        padding:10px 10px 10px 20px;
        display:flex;
        align-items: center;
        justify-content: flex-start;
        box-sizing: border-box;
        font-size:20px;
        font-weight:bold;
        margin:0;
    }
    .title2{
        width:100%;
        box-sizing: border-box;
        height:55px;
        .user-img{
            position:fixed;
            top:5px;
            left:10px;
            width: auto;
            height:auto;
            display:flex;
            align-items: center;
            justify-content: center;
            cursor:pointer;
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
    }
    .post-type{
        height:60px;
        width:100%;
        display:flex;
        flex-direction: row;
        justify-content: space-evenly;
        .post-type-btn{
            height:100%;
            width:100%;
            position:relative;
            border:none;
            background:none;
            transition:all 0.3s;
            color:#71767B;
            font-size: 16px;
            font-weight:600;
            &:hover{
                background-color: rgba($color: #202223, $alpha: 0.8);
            }
            .active-line{
                height:4px;
                width:75px;
                display:none;
                border-radius:5px;
                position:absolute;
                bottom:1px;
                left:50%;
                transform: translateX(-50%);
                background-color: #1D9BF0;
                &.active{
                    display:block;
                }
            }
        }
        .active-post-type{
            color:white;
            font-weight:700;
        }
    }
}
.profile-popup{
    width:250px;
    height:90px;
    position:absolute;
    top:50px;
    left:50%;
    transform: translateX(-50%);
    z-index:99;

    .popup-content{
        height:100%;
        width:100%;
        border-radius:25px;
        border:1px solid #2F3336;
        box-shadow: 0 0 5px #1D9BF0;
        background-color: #000000;
        transition: all 0.3s;
        display:flex;
        flex-direction: column;
        button{
            width:100%;
            height:50%;
            border:none;
            background: none;
            color:#ffffff;
            cursor:pointer;
            font-size:14px;
            transition: all 0.3s;
            &:hover{
                background-color: #1d1d1d;
            }
        }
        .logout-btn{
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
        }
        .profile-btn{
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
        }
    }
}
@media (min-width: 500px) {
    .profile-popup{
        display:none;
    }
    .title2{
        display:none !important;
    }
}
@media (max-width: 500px) {
.top-bar{
    width:100%;
    height:90px;
    .title{
        display:none !important;
    }
    .post-type{
        height:35px;
        .post-type-btn{
            font-size: 14px;
            .active-line{
                height:3px;
                width:50px;
            }
        }
    }
}
}
</style>