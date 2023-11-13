<template>
    <div class="navbar-container">
        <div class="buttons">
            <div class="logo">
                <ion-icon name="logo-yahoo"></ion-icon>
            </div>

            <button class="Home" :class="{ 'active': activeRoute === '/home' }" @click="$router.push('/home')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="home-outline"></ion-icon>
                    <span class="button-text">Home</span>
                </div>
            </button>

            <button class="Explore" :class="{ 'active': activeRoute === '/explore' }" @click="$router.push('/explore')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="search-outline"></ion-icon>
                    <span class="button-text">Explore</span>
                </div>
            </button>

            <button class="Notifications" :class="{ 'active': activeRoute === '/notifications' }" @click="$router.push('/notifications')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="notifications-outline"></ion-icon>
                    <span class="button-text">Notifications</span>
                </div>
            </button>

            <button class="Messages" :class="{ 'active': activeRoute === '/messages' }" @click="$router.push('/messages')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="mail-outline"></ion-icon>
                    <span class="button-text">Messages</span>
                </div>
            </button>

            <button class="Bookmarks" :class="{ 'active': activeRoute === '/bookmarks' }" @click="$router.push('/bookmarks')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="bookmark-outline"></ion-icon>
                    <span class="button-text">Bookmarks</span>
                </div>
            </button>

            <button class="Profile" :class="{ 'active': activeRoute.includes('/profile') }" @click="openProfile(user.UserTag)">
                <div class="button-content">
                    <ion-icon class="button-icon" name="person-outline"></ion-icon>
                    <span class="button-text">Profile</span>
                </div>
            </button>

            <button class="More" :class="{ 'active': activeRoute === '/more' }" @click="$router.push('/more')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="ellipsis-horizontal-circle"></ion-icon>
                    <span class="button-text">More</span>
                </div>
            </button>

            <button class="Tweet" @click="() => TogglePopup('TweetTrigger')">
                <div class="button-content">
                    <ion-icon class="button-icon" name="logo-twitter"></ion-icon>
                    <span class="button-text">Tweet</span>
                </div>
            </button>

        </div>
        <div class="profile" @click.stop="toggleProfilePopup">
            <div class="user-img" v-if="user">
                <img :src="'/storage/' + user.ProfilePicture">
            </div>
            <div class="user-info" v-if="user">
                <p class="username">{{ user.Name }}</p>
                <p class="usertag">{{ user.UserTag }}</p>
            </div>
            <div class="more-icon">
                <ion-icon name="ellipsis-horizontal"></ion-icon>
            </div>
            <div class="profile-popup" v-if="isPopupVisible">
                <div class="popup-content">
                    <button class="logout-btn" @click="logoutUser">Logout</button>
                    <button class="profile-btn" @click="openProfile(user.UserTag)">Profile</button>
                </div>
            </div>
        </div>
    </div>
    <Popup v-if="popupTriggers.TweetTrigger" :TogglePopup="() => TogglePopup('TweetTrigger')">
        <div class="create-tweet-or-comment-popup" v-if="user">
            <div class="top">
                <div class="left-side-popup">
                    <img  @click.stop="openProfile(user.UserTag)" :src="'/storage/' + user.ProfilePicture">
                </div>
                <div class="right-side-popup">
                    <div class="userinfo-popup">
                        <p class="username">{{ user.Name }}</p>
                        <p class="usertag">{{ user.UserTag }}</p>
                    </div>
                    <div class="tweet-input-container">
                        <textarea v-model="tweet_text_inputnav" id="tweet-input" class="tweet-input" rows="1" placeholder="What's happening?!" @input="autoSize" ref="tweetInputnav" maxlength="255"></textarea>
                    </div>
                    <div class="tweet-image-preview">
                        <img :src="previewImagenav" v-if="previewImagenav">
                    </div>
                </div>
            </div>

            <div class="bottom">
                <div class="buttons">
                    <button class="tweet-btn"><input type="file" accept="image/png, image/gif, image/jpeg, video/mp4,video/x-m4v,video/*" id="tweet-img-input-tweetnav" @change="onImageChangenav" hidden><label for="tweet-img-input-tweetnav" class="tweet-img-label"><ion-icon name="images-outline" class="create-tweet-icon"></ion-icon></label></button>
                    <button class="tweet-btn"><ion-icon name="happy-outline" class="create-tweet-icon"></ion-icon></button>
                    <button class="tweet-btn"><ion-icon name="attach-outline" class="create-tweet-icon"></ion-icon></button>
                </div>
                <button class="popup-button"  @click="createTweetnav" :disabled="buttonDisabled">Post</button>
            </div>
        </div>
    </Popup>
</template>
<script>
import { ref } from 'vue';
import Popup from './Popup.vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { mapState } from 'vuex';
export default{
    name: 'NavBar',
    components: {
        Popup,
    },
    computed:{
        ...mapState(['user']),
    },
    data(){
        return {
            tweets: [],
            isPopupVisible: false,
            buttonDisabled: false,
            activeRoute: '',
        }
    },
    setup(){
        const tweet_text_input = ref('');
        const tweet_text_inputnav = ref('');
        const tweetImagenav = ref(null);
        const previewImagenav = ref(null);
        const router = useRouter();
        const store = useStore();

        const popupTriggers = ref({
            TweetTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger]
            tweet_text_inputnav.value='';
            tweet_text_input.value = '';
            tweetImagenav.value=null;
            previewImagenav.value=null;
            if (!popupTriggers.value[trigger]) {
            }
		}
        const logoutUser = async () => {
            try {
                await store.dispatch('logout');
                router.push('/');
            } catch (error) {
                console.error(error);
            }
        };
        return {
            popupTriggers,
            TogglePopup,
            logoutUser,
            tweet_text_inputnav,
            tweet_text_input,
            tweetImagenav,
            previewImagenav,
        }
    },
    methods: {
        toggleProfilePopup() {
            this.isPopupVisible = !this.isPopupVisible;
            setTimeout(() => { this.isPopupVisible = false; }, 10000);
        },

        autoSize() {
            const maxRows = 5;
            const textarea = this.$refs.tweetInputnav;
            textarea.style.height = 'auto';
            const customLineHeight = 1; // Match the line-height value from your CSS
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
            this.isPopupVisible = false;
        },
        onImageChangenav(event) {
            this.tweetImagenav = event.target.files[0];
            if (this.tweetImagenav) {
                // Create a URL for the selected image and set it as the preview
                this.previewImagenav = URL.createObjectURL(this.tweetImagenav);
            } else {
                this.previewImagenav = null;
            }
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
        async createTweetnav() {
            if (this.buttonDisabled) {
                return;
            }
            const formData = new FormData();
            formData.append('tweetText', this.tweet_text_inputnav);
            if (this.tweetImagenav) {
                formData.append('tweetImage', this.tweetImagenav);
            }
            try {
                this.buttonDisabled = true;

                const response = await this.$axios.post('/api/tweets', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                this.tweet_text_inputnav = '';
                this.tweetImagenav = null;
                this.previewImagenav = null;
                this.popupTriggers.TweetTrigger = false;
                const textarea = this.$refs.tweetInput;
                textarea.style.height = 'auto';
                this.getTweets('all');
                setTimeout(() => {
                    this.buttonDisabled = false;
                }, 2000);
            } catch (error) {
                console.error(error);
                this.buttonDisabled = false;
            }
        },
    },
    mounted() {
        this.activeRoute = this.$route.path;
        this.$router.afterEach((to) => {
            this.activeRoute = to.path;
        });
    },
}
</script>
<style lang="scss" scoped>
.active {
    // font-weight: bold;
    .button-content{
        color: #1D9BF0;
    }
}
.navbar-container{
    width: 3/12*100%;
    height: 100vh;
    display:flex;
    flex-direction: column;
    justify-content: space-between;
    position:fixed;
    box-sizing: border-box;
    padding-left:100px;
    z-index:10;
    border-right:solid 1px #2F3336;
    background:black;
    color:white;
}
.buttons{
    width:90%;
    display: flex;
    flex-direction: column;
    gap:10px;
    box-sizing: border-box;
    .logo{
        width: 100%;
        height:50px;
        display:flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        background-color:black;
        cursor: pointer;
    }
    button{
        width: max-content;
        height:50px;
        padding:0 30px 0 15px;
        display:flex;
        align-items: center;
        color:white;
        background-color:black;
        border:none;
        border-radius: 50px;
        transition: all 0.3s;
        cursor: pointer;
        &:hover{
            background-color: #1d1d1d;
        }
        .button-content {
            display: flex;
            gap:15px;
            align-items: center;
            justify-content: space-between;
            .button-icon{
                font-size:24px;
                --ionicon-stroke-width: 40px;
            }
            .button-text{
                font-size:18px;
            }
        }
    }
    .Tweet{
        width: 100%;
        background-color:#1d9bf0;
        &:hover{
            background-color: #1a7fc3;
        }
    }
}
.profile{
    width:100%;
    display: flex;
    flex-direction: row;
    align-items: center;
    cursor: pointer;
    box-sizing: border-box;
    padding: 10px;
    margin-bottom:10px;
    font-size: 16px;
    border-radius: 50px;
    background:none;
    position:relative;
    transition: all 0.3s;
    .user-img{
        width: auto;
        height:100%;
        display:flex;
        align-items: center;
        justify-content: center;
        img{
            width:50px;
            height:50px;
            border-radius:50%;
            background-color: rgb(255, 255, 255);
        }
    }
    .user-info{
        width: 60%;
        height:100%;
        display:flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
        gap:10px;
        padding-left:10px;
        .username{
            max-width:100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            font-weight: bold;
            font-size: 14px;
            margin:0;
        }
        .usertag{
            max-width:100%;
            overflow: hidden;
            white-space: nowrap;
            color: #6A6F74;
            font-size: 14px;
            margin:0;
        }
    }
    .more-icon{
        width: 20%;
        height:100%;
        display:flex;
        align-items: center;
        justify-content: center;
    }
    &:hover{
        background-color: #1d1d1d;
    }
}
.profile-popup{
    width:100%;
    height:100px;
    position:absolute;
    top:-100px;
    left:0px;
    z-index:99;

    .popup-content{
        height:100%;
        width:100%;
        border-radius:25px;
        border:1px solid #2F3336;
        background-color: #000000;
        box-shadow: 0 0 5px #1D9BF0;
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
            font-size:16px;
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
@media (max-width: 1250px) {
    .navbar-container {
        position: fixed;
        bottom: 0;
        width: 100px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: black;
        z-index: 99;
    }
    .buttons {
        width:auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex-wrap: nowrap;
    }
    .buttons button {
        width: 50px;
        height: 50px;
        border-radius:50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    .buttons span {
        display: none;
    }
    .profile{
        width: 50px;
        height: 50px;
        border-radius:50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px;
        .user-info{
            display:none;
        }
        .more-icon{
            display:none;
        }
    }
    .profile-popup{
    width:250px;
    height:100px;
    position:absolute;
    top:-100px;
    left:10px;

    .popup-content{
        button{
            width:100%;
            height:50%;
            font-size:16px;
        }
    }
}
}
@media (max-width: 500px) {
    .navbar-container {
        position: fixed;
        bottom: 0;
        width: 100%;
        height:50px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        box-sizing: border-box;
        padding: 5px !important;
        background-color: black;
        z-index: 10;
        border-top: 1px solid #2F3336;
        border-right:none;
    }
    .buttons {
        width:100%;
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
    }
    .Home, .Explore, .Notifications, .Messages, .Bookmarks{
        display:flex;
        align-items: center;
        justify-content: center;
        height:40px !important;
        width:40px !important;
        border-radius: 50% !important;
    }
    .Profile, .logo, .More, .profile{
        display:none !important;
    }
    .Tweet{
        width:45px !important;
        height:45px !important;
        position:fixed;
        right:12px;
        bottom:55px;
        border-radius:50% !important;
    }
}

</style>
