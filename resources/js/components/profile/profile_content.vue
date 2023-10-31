<template>
    <div class="profile-container">
        <div class="top">
            <div class="title"><button class="back-icon" @click="goBack"><ion-icon name="arrow-back-outline"></ion-icon></button><span style="margin-left: 10px;" v-if="userinfo">{{ userinfo.Name }}</span></div>
            <div class="tweet-count">{{ tweet_count }} posts</div>
            <div class="image">
                <img :src="mainProfileBackgroundImage">
            </div>
            <div class="user-img">
                <img :src="mainProfileImgSrc">
            </div>
            <div class="edit-button">
                <button class="edit-profile" @click="() => TogglePopup('SignInTrigger')">Edit profile</button>
            </div>
        </div>
        <div class="profile-info" v-if="userinfo">
            <div class="user-info">
                <div class="name">{{ userinfo.Name }}</div>
                <div class="user">{{ userinfo.UserTag }}</div>
                <div class="description" style="word-wrap: break-word; max-width: 65ch;">{{ displayBio ? mainProfileBio : profileChanges.bio }}</div>
                <div class="joined"><ion-icon name="calendar-outline"></ion-icon><span style="margin-left: 10px;">Joined {{ getFormattedJoinDate(user.created_at) }}</span></div>
            </div>
            <div class="follow">
                <div class="amount">{{ userinfo.following_count }}</div>
                <div class="following">Following</div>
                <div class="amount">{{ userinfo.follower_count }}</div>
                <div class="following">Followers</div>
            </div>
        </div>
        <div class="post-type">
            <button @click="switchToTweets" class="post-type-btn" :class ="{ 'active-post-type': postType == 'tweets' }">Posts<div class="active-line" :class ="{ 'active': postType == 'tweets' }"></div></button>
            <button @click="switchToReplies" class="post-type-btn" :class ="{ 'active-post-type': postType == 'replies' }">Replies<div class="active-line" :class ="{ 'active': postType == 'replies' }"></div></button>
            <button @click="switchToLikes" class="post-type-btn" :class ="{ 'active-post-type': postType == 'likes' }">Likes<div class="active-line" :class ="{ 'active': postType == 'likes' }"></div></button>
        </div>
        <div class="topics" >
            <div class="topics-2">Topics to follow</div>
            <div class="topics-3">Tweets about the Topics you follow show up in your home timeline</div>
        </div>
        <div class="post" v-for="tweet in tweets" :key="tweet.TweetID"  @click="openTweet(tweet.TweetID)">
                <div class="left-side">
                    <img  @click.stop="openProfile(tweet.user.UserTag)">
                </div>
                <div class="right-side">
                    <div class="retweeted" v-if="tweet.isRetweet">
                        <p class="tweet-text"><span>{{ userinfo.UserTag }}</span> Reposted</p>
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
                    </div>
                </div>
            </div>
    </div>
    <Popup v-if="popupTriggers.SignInTrigger" :TogglePopup="() => TogglePopup('SignInTrigger')">
        <div class="Sign-Pop-Up">
            <div class="head">
                <h1 class="title">Edit profile</h1>
                <div class="save-button">
                    <button class="save" @click="saveChanges">Save</button>
                </div>
            </div>
            <div class="body">
                <div class="image-2">
                    <input type="file" ref="backgroundInput" style="display: none" @change="handleFileChange2" accept="image/*">
                    <img @click="openBackgroundChooser" :src="popupImgSrc2">
                </div>
                <div class="user-img-2">
                    <input type="file" ref="fileInput" style="display: none" @change="handleFileChange" accept="image/*">
                    <img @click="openFileChooser" :src="popupImgSrc">
                </div>
                <div class="edit-name">
                    <div class="edit-name-2">
                        Name
                    </div>
                    <div class="edit-name-3">
                        <textarea class="edit-name-4" :placeholder="mainProfileName" maxlength="45" v-model="profileChanges.name"></textarea>
                    </div>
                </div>
                <div class="line"></div>
                <div class="edit-bio">
                    <div class="edit-bio-2">
                        Bio
                    </div>
                    <div class="edit-bio-3">
                        <textarea class="edit-bio-4" :placeholder="mainProfileBio" maxlength="255" v-model="profileChanges.bio"></textarea>
                    </div>
                </div>
                <div class="line"></div>
            </div>
        </div>
    </Popup>
</template>
<script>
import Popup from '../Popup.vue';
import { ref, onMounted } from 'vue';
import { mapState } from 'vuex';
export default {
    name: 'Profile',
    components: {
        Popup,
    },
    computed:{
        ...mapState(['user']),
    },
    data(){
        return {
            tweets: [],
            tweet_count: 0,
            userinfo: null,
            postType: 'tweets',
            profileChanges: {
                name: '',
                bio: '',
                profileImage: '',
                backgroundImage: '',
            },
        }
    },
    setup () {
        const mainProfileImgSrc = ref('');
        const mainProfileBackgroundImage = ref('');
        const popupImgSrc = ref('');
        const popupImgSrc2 = ref('');
        const mainProfileName = ref('');
        const mainProfileBio = ref('');
        const editProfileName = ref('');
        const editProfileBio = ref('');
        const displayChangesImmediately = ref(false);
        const popupTriggers = ref({
            SignInTrigger: false,
        });

        onMounted(async () => {
            mainProfileName.value = '';
            mainProfileBio.value = '';
        });

        const profileChanges = ref({
            name: '',
            bio: '',
            profileImage: '',
            backgroundImage: '',
        });

        const displayName = ref(false);
        const displayBio = ref(false);
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger];
            if (popupTriggers.value[trigger]) {
    
                editProfileName.value = mainProfileName.value;
                editProfileBio.value = mainProfileBio.value;

                displayChangesImmediately.value = false;
            }
        };

        const saveChanges = () => {
            if (profileChanges.value.profileImage) {
                mainProfileImgSrc.value = profileChanges.value.profileImage;
            }

            popupImgSrc.value = mainProfileImgSrc.value;

            if (profileChanges.value.backgroundImage) {
                mainProfileBackgroundImage.value = profileChanges.value.backgroundImage;
            }

            popupImgSrc2.value = mainProfileBackgroundImage.value;

            if (profileChanges.value.name) {
                mainProfileName.value = profileChanges.value.name;
            }
            if (profileChanges.value.bio) {
                mainProfileBio.value = profileChanges.value.bio;
            }

            if (displayChangesImmediately.value) {
                displayName.value = true;
                displayBio.value = true;
            }

            displayName.value = true;
            displayBio.value = true;

            TogglePopup('SignInTrigger');
        };

        return {
            Popup,
            TogglePopup,
            popupTriggers,
            mainProfileImgSrc,
            mainProfileBackgroundImage,
            popupImgSrc,
            popupImgSrc2,
            mainProfileName,
            mainProfileBio,
            profileChanges,
            displayName,
            displayBio,
            saveChanges,
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

        openFileChooser() {
            this.$refs.fileInput.click();
        },

        openBackgroundChooser () {
            this.$refs.backgroundInput.click();
        },

        handleFileChange(event) {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = () => {
                    this.popupImgSrc = reader.result;
                    this.profileChanges.profileImage = reader.result;
                };
                reader.readAsDataURL(selectedFile);
            } else {
                this.popupImgSrc = this.mainProfileImgSrc;
            }
        },

        handleFileChange2(event) {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = () => {
                    this.popupImgSrc2 = reader.result;
                    this.profileChanges.backgroundImage = reader.result;
                };
                reader.readAsDataURL(selectedFile);
            } else {
                this.popupImgSrc2 = this.mainProfileBackgroundImage;
            }
        },

        TogglePopup(trigger) {
            if (!this.popupTriggers[trigger]) {
                this.popupImgSrc = this.mainProfileImgSrc;
                this.popupImgSrc2 = this.mainProfileBackgroundImage;
                this.profileChanges = {
                    name: '',
                    bio: '',
                    profileImage: '',
                    backgroundImage: '',
                };
            }
            this.popupTriggers[trigger] = !this.popupTriggers[trigger];
        },

        getFormattedJoinDate(joinDate) {
            const options = { year: 'numeric', month: 'long' };
            return new Date(joinDate).toLocaleDateString(undefined, options);
        },
        getSpecificUserTweets(userTag) {
        this.$axios
            .get(`/api/user-tweets/${userTag}`) // Adjust the URL based on your Laravel routes
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
                this.userinfo = response.data.user;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    watch: {
        $route() {
            this.getSpecificUserTweets(this.$route.params.UserTag);
        }
    },
    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.getUserInfo(this.$route.params.UserTag);
        this.getSpecificUserTweets(this.$route.params.UserTag);
    }
}
</script>
<style lang="scss" scoped>
    .profile-container {
        width:100%;
        height:auto;
        color:white;
    }
    .top {
        height:300px;
        display:flex;
        flex-direction: column;
        top:0;
        width:100%;
        z-index:9;
        box-sizing: border-box;
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
            background-color: black;
            color:white;
            cursor:pointer;
            transition: all 0.3s;
            margin-left: 10px;
            margin-top: 10px;
        }
        .back-icon:hover{
            background-color: rgba($color: #1a1a1a, $alpha: 1);
        }
        .title{
            width:100%;
            height:40px;
            display:flex;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            margin-top: 10px;
            font-weight: bold;
            font-size: 22px;
        }
        .tweet-count {
            color:gray;
            width: 60px;
            height: 20px;
            margin-left: 60px;
        }
        .image {
            padding-left: 0px;
            height: 180px;
            width: 100%;
            z-index: 9;
            display: flex;
            img{
                width: 100%;
                height: 100%;
                background-color: white;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
        .user-img{
            position: absolute;
            margin-top: 170px;
            margin-left: 10px;
            width:auto;
            height:auto;
            display:flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            img{
                width:150px;
                height:150px;
                border-radius:50%;
                background-color: #ffffff;
            }
        }
        .edit-button {
            margin-top: 10px;
            margin-right: 10px;
            display: flex;
            justify-content: flex-end;
        }
        .edit-profile{
            height: 40px;
            width: 120px;
            padding:10px 20px; 
            border-radius: 50px;
            border:none;
            background-color: white;
            color:black;
            font-size:15px;
            font-weight: bold;
            transition:all 0.3s;
            cursor:pointer;
        }
        .edit-profile:hover{
            background-color: #D7DBDC;
        }
    }
    .profile-info {
        margin-top: 70px;
        margin-left: 10px;
        .user-info {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            .name {
                font-weight: bold;
                font-size: 22px;
            }
            .user {
                color: gray;
            }
            .description {
                margin-top: 10px;
            }
            .joined {
                margin-top: 10px;
                color: gray;
            }
        }
        .follow {
            margin-top: 10px;
            width:200px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            .amount {
                font-weight: bold;
            }
            .following {
                color: gray;
            }
        }
    }
    .post-type{
        width:100%;
        height:50px;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
        margin-top: 50px;
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
        font-size: 16px;
        font-weight:600;
    }
    .post-type-btn:hover{
        background-color:rgba($color: #202223, $alpha: 0.8);
    }
    .active-post-type{
        color:white;
        font-size: 16px;
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
    }
    .active-line.active{
        display:block;
    }
    .topics{
        display: flex;
        flex-direction: column;
        margin-top: 30px;
        margin-left: 10px;
        .topics-2 {
            font-weight: bold;
            font-size: 22px;
        }
        .topics-3 {
            color: gray;
            margin-top: 5px;
        }
    }
    .Sign-Pop-Up {
        width: 600px;
        height: 500px;
        color: white;
    }
    .head {
        margin-top: 50px;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        .save-button {
            margin-top: 20px;
            display: flex;
        }
        .save{
            padding:20px;
            height:40px;
            display:flex;
            align-items: center;
            border-radius: 50px;
            border:none;
            background-color: #1D9BF0;
            color:white;
            font-size: medium;
            font-weight: bold;
            transition: all 0.3s;
            cursor:pointer;
        }
        .save:hover{
            background-color: #1d8dd7;
        }
        .save:disabled{
            background-color: #0F4E78;
            color:#808080;
        }
    }
    .body {
        display: flex;
        flex-direction: column;
        .image-2 {
            height: 130px;
            z-index: 9;
            display: flex;
            img{
                background-color: white;
                width: 100%;
                height: 100%;
                background-repeat: no-repeat;
                background-size: cover;
                cursor: pointer;
            }
        }
        .user-img-2{
            position: absolute;
            margin-top: 80px;
            margin-left: 20px;
            width:auto;
            height:auto;
            display:flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            img{
                width:100px;
                height:100px;
                border-radius:50%;
                background-color: #ffffff;
                cursor: pointer;
            }
        }
        .edit-name{
            margin-top: 70px;
            margin-left: 30px;
            .edit-name-2{
                color: gray;
            }
            .edit-name-3{
                width: 95%;
            }
            .edit-name-4{
                width: 100%;
                height: 30px;
                font-family: Arial, sans-serif;
                font-size: 22px;
                resize: none;
                border: none;
                padding-left: 0px;
                padding-top: 5px;
                background-color: #000000;
                color:#ffffff;
                display:flex;
            }
            .edit-name-4:focus{
                outline: none;
            }
        }
        .edit-bio{
            margin-top: 20px;
            margin-left: 30px;
            .edit-bio-2{
                color: gray;
            }
            .edit-bio-3{
                width: 95%;
            }
            .edit-bio-4{
                width: 100%;
                height: 30px;
                font-family: Arial, sans-serif;
                font-size: 22px;
                resize: none;
                border: none;
                padding-left: 0px;
                padding-top: 5px;
                background-color: #000000;
                color:#ffffff;
                display:flex;
            }
            .edit-bio-4:focus{
                outline: none;
            }
        }
        .line{
            height: 2px;
            background-color: #4d4d4d;
            margin-left: 30px;
            width: 90%;
            display: flex;
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
                max-width:100%;
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
.post-icon{
    visibility: visible !important;
}
.top2{
    display:none;
}
.post:hover{
    background-color: #080808;
}

    @media (max-width: 850px) and (min-width: 501px) {
        .user-img, .name, .user, .description, .joined, .follow, .topics{
            margin-left: 20px !important;
        }
    }

    @media (max-width: 600px) {
        .Sign-Pop-Up{
            width: 500px;
        }
    }

    @media (max-width: 500px) {
        .Sign-Pop-Up{
            width: 400px;
        }
        .profile-container{
            padding-bottom: 35px;
        }
        .top {
            height:270px;
            .back-icon{
                width:35px;
                height:35px;
                font-size:20px;
            }
            .title{
                height:35px;
                font-size: 20px;
            }
            .tweet-count {
                font-size: 14px;
                margin-left: 55px;
            }
            .user-img{
                margin-top: 160px !important;
                img{
                    width: 120px !important;
                    height: 120px !important;
                }
            }
            .edit-profile{
                height: 35px !important;
                width: 100px !important;
                font-size:13px !important;
                padding: 10px 10px !important;
            }
        }
        .profile-info {
            margin-top: 60px;
            .user-info {
                .name {
                    font-size: 20px;
                }
                .user {
                    font-size: 14px;
                }
                .description {
                    font-size: 15px;
                }
                .joined {
                    font-size: 14px;
                }
            }
        }
        .follow {
            .amount {
                font-size: 15px;
            }
            .following {
                font-size: 14px;
            }
        }
        .post-type{
            height:45px;
            margin-top: 40px;
        }
        .post-type-btn{
            font-size: 14px;
        }
        .active-post-type{
            font-size: 14px;
        }
        .active-line{
            height:3px;
            width:70px;
        }
        .topics{
            margin-top: 40px;
            .topics-2 {
                font-size: 20px;
            }
            .topics-3 {
                font-size: 14px;
            }
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
    .left-side, .post-top{
        display:none !important;
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
    }
</style>