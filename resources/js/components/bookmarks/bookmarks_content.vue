<template>
    <div class="content-container">
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
            <div class="post" v-for="tweet in tweets" :key="tweet.TweetID"  @click="openTweet(tweet.TweetID)">
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
                                    <p v-if="tweet.TweetText" v-html="formatMentionText(tweet.TweetText)" @click="handleMentionClick"></p>
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
                                <p v-if="tweet.TweetText" v-html="formatMentionText(tweet.TweetText)" @click="handleMentionClick"></p>
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
            <div class="no-posts" v-if="tweets.length === 0">Empty...🌵</div>
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
                        <button class="tweet-btn" @click.stop="TogglePopup('MentionTrigger')"><ion-icon name="at-sharp" class="create-tweet-icon"></ion-icon></button>
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
                    <div class="user" v-for="user in filteredUsers" :key="user.UserID" @click="insertMention(user)">
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
            users: [],
            tweets: [],
            comments: [],
            commentsByTweet: {},
            isPopupVisible: false,
            buttonDisabled:false,
            tweetIdInPopup: null,
            isInputFocused: false,
        };
    },
    setup(){
        const comment_text_input = ref('');
        const router = useRouter();
        const store = useStore();
        const commentInput = ref(null);
        const mentionSearch = ref('');
        const filteredUsers = ref([]);

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
            MentionTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger];
            if (trigger === 'MentionTrigger') {
                mentionSearch.value = '';
                filteredUsers.value = [];
            }
        };
        return {
            popupTriggers,
            TogglePopup,
            logoutUser,
            comment_text_input,
            commentInput,
            mentionSearch,
            filteredUsers,
        }
    },
    computed:{
         ...mapState(['isLoggedIn', 'user']),
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
                console.log('Other click event');
            }
        },
        insertMention(user) {
            console.log('Inserting Mention', user);

            const cursorPosition = this.commentInput.value.selectionStart;

            const textarea = this.commentInput;

            console.log('Cursor Position:', cursorPosition);
            console.log(textarea);

            if (!textarea) {
                console.error("Textarea not found");
                return;
            }

            const mentionTag = `${user.UserTag}`;
            const cursorPos = textarea.selectionStart;
            const textBeforeCursor = textarea.value.substring(0, cursorPos);
            const textAfterCursor = textarea.value.substring(cursorPos);

            console.log('Cursor Position:', cursorPos);
            console.log('Text Before Cursor:', textBeforeCursor);
            console.log('Text After Cursor:', textAfterCursor);

            this.comment_text_input = textBeforeCursor + mentionTag + textAfterCursor;

            this.TogglePopup('MentionTrigger');

            // Use setSelectionRange on the ref to manipulate the cursor position
            textarea.setSelectionRange(cursorPosition + mentionTag.length, cursorPosition + mentionTag.length);
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
        goBack() {
            this.$router.go(-1);
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
                const response = await this.$axios.post('/api/create-comments', {
                    tweetId: tweetID,
                    commentText: commentText,
                });
                const tweet = this.currentPosts.find((t) => t.TweetID === tweetID);
                const newComment = response.data.comment;
                this.comments.push(newComment);
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
        getUsersExceptYourself() {
        axios
            .get('/api/allusers')
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
        this.getTweets('bookmark');
        this.getUsersExceptYourself();
    },
}

</script>

<style lang="scss" scoped>
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
}

</style>


