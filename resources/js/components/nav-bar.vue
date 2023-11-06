<template>
    <div class="navbar-container"><!-- display-flex column space-between -->
        <div class="buttons"><!-- display-flex column gap 10px -->
            <!-- Each button in a div??? -->
            <!-- Each button width: 100% and height:??? -->
            <div class="logo">
                <div class="button-content">
                    <ion-icon name="logo-yahoo" style="font-size: 36px;"></ion-icon>
                </div>
            </div>

            <button class="Home" @click="$router.push('/home')">
                <div class="button-content">
                    <ion-icon name="home-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Home</span>
                </div>
            </button>

            <button class="Explore" @click="$router.push('/explore')">
                <div class="button-content">
                    <ion-icon name="search-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Explore</span>
                </div>
            </button>

            <button class="Notifications" @click="$router.push('/notifications')">
                <div class="button-content">
                    <ion-icon name="notifications-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Notifications</span>
                </div>
            </button>

            <button class="Messages" @click="$router.push('/messages')">
                <div class="button-content">
                    <ion-icon name="mail-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Messages</span>
                </div>
            </button>

            <button class="Bookmarks" @click="$router.push('/bookmarks')">
                <div class="button-content">
                    <ion-icon name="bookmark-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Bookmarks</span>
                </div>
            </button>

            <button class="Profile" @click="openProfile(user.UserTag)">
                <div class="button-content">
                    <ion-icon name="person-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Profile</span>
                </div>
            </button>

            <button class="More" @click="$router.push('/more')">
                <div class="button-content">
                    <ion-icon name="apps-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">More</span>
                </div>
            </button>

            <button class="Tweet" style="background-color: #1d9bf0; justify-content: center;" onmouseover="this.style.backgroundColor='#1a7fc3';" onmouseout="this.style.backgroundColor='#1d9bf0';" @click="() => TogglePopup('TweetTrigger')">
                <div class="button-content">
                    <ion-icon name="logo-twitter" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 10px;">Tweet</span>
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
        <div class="create-popup" v-if="user">
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
                    <button class="tweet-btn"><input type="file" id="tweet-img-input-tweetnav" @change="onImageChangenav" hidden><label for="tweet-img-input-tweetnav" class="tweet-img-label"><ion-icon name="images-outline" class="create-tweet-icon"></ion-icon></label></button>
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
            previewImagenav: null,
            tweets: [],
            tweet_text_inputnav: '',
            tweetImagenav: null,
            isPopupVisible: false,
            buttonDisabled: false,
        }
    },
    setup(){
        const router = useRouter();
        const store = useStore();

        const popupTriggers = ref({
            TweetTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger]
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
        }
    },
    methods: {
        toggleProfilePopup() {
            this.isPopupVisible = !this.isPopupVisible;
            setTimeout(() => { this.isPopupVisible = false; }, 10000);
        },

        autoSize() {
            const maxRows = 10;
            const textarea = this.$refs.tweetInputnav;
            textarea.style.height = 'auto';
            const customLineHeight = 1.5; // Match the line-height value from your CSS
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
}
</script>
<style lang="scss" scoped>
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
        .button-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo{
            width: 100%;
            height:50px;
            display:flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color:black;
            cursor: pointer;
        }
        button{
            width: 100%;
            height:50px;
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            border-radius: 50px;
            background-color:black;
            border:none;
            font-size: 20px;
            color:white;
            transition: all 0.3s;
        }
        button:hover{
            background-color: #1d1d1d;
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
                font-weight: bold;
                font-size: 14px;
                margin:0;
            }
            .usertag{
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
    }
    .profile:hover{
        background-color: #1d1d1d;
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
                .tweet-image-preview{
                    img{
                        max-width:100%;
                        max-height:100%;
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
            justify-content: center;
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
        .Home, .Explore, .Notifications, .Messages{
            display:flex;
            align-items: center;
            justify-content: center;
            height:40px !important;
            width:40px !important;
            border-radius: 50% !important;
        }
        .Profile, .logo, .Bookmarks, .More, .profile{
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
