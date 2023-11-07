<template>
    <div class="following-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="profile-top">
                <p class="title" v-if="followuser">{{ followuser.Name }} follows</p>
                <p class="tweet_count">{{ followingList.length }} people</p>
            </div>
        </div>
        <div class="people-container">
            <div class="person" v-for="person in followingList" :key="person.UserID">
                <div class="user-info">
                    <img @click.stop="openProfile(person.UserTag)" :src="'/storage/' + person.ProfilePicture" alt="" class="person-img">
                    <div class="person-info">
                        <p class="username">{{ person.Name }}</p>
                        <p class="usertag">{{ person.UserTag }}</p>
                    </div>
                </div>
                <button  
                    class="follow-button" 
                    @click="toggleFollowUnfollow(person.UserID)"
                    v-if="!(person.UserID === user.UserID)"
                    :class="{
                        'followed-button': person.isFollowedByMe,
                        'unfollow-button': person.isFollowedByMe && isHovered[person.UserID]
                    }"
                    @mouseover="isHovered[person.UserID] = true"
                    @mouseout="isHovered[person.UserID] = false">
                    {{ followButtonLabel(person) }}
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { mapState } from 'vuex';
export default {
    name: 'Following',
    data(){
        return {
            followingList: [],
            followuser: null,
            isHovered:  [],
        }
    },
    computed:{
        ...mapState(['user']),
        followButtonLabel() {
            return (person) => {
                if (this.isHovered[person.UserID] && person.isFollowedByMe) {
                    return 'Unfollow';
                } else if (person.isFollowedByMe) {
                    return 'Following';
                } else {
                    return 'Follow';
                }
            };
        },
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        fetchFollowingList(tag) {
            axios.get('/api/following/' + tag)
                .then(response => {
                    this.followingList = response.data;
                })
                .catch(error => {
                    console.error('Error fetching following list:', error);
                });
        },
        openProfile(tag){
            const NoSymbolTag = tag.replace(/^@/, '');
            this.$router.push({ name: 'profile', params: { UserTag : NoSymbolTag } });
            console.log(tag);
        },
        toggleFollowUnfollow(userID) {
            const user = this.followingList.find((t) => t.UserID === userID);
            if (user.isFollowedByMe) {
                this.handleUnfollow(userID);
            } else {
                this.handleFollow(userID);
            }
        },
        async handleFollow(userID) {
            try {
                const response = await this.$axios.post(`/api/follow/${userID}`);
                console.log('Follow Response:', response);
                if (response.status === 200) {
                    const user = this.followingList.find((t) => t.UserID === userID);
                    user.isFollowedByMe = true;
                }
            } catch (error) {
                console.error('Error following the user:', error);
            }
        },

        async handleUnfollow(userID) {
            try {
                const response = await this.$axios.post(`/api/unfollow/${userID}`);
                console.log('Unfollow Response:', response);
                if (response.status === 200) {
                    const user = this.followingList.find((t) => t.UserID === userID);
                    user.isFollowedByMe = false;
                }
            } catch (error) {
                console.error('Error unfollowing the user:', error);
            }
        },
        getUserInfo(userTag){
            this.$axios.get('/api/get-user-tag/' + userTag)
            .then(response => {
                this.followuser = response.data.user;
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.getUserInfo(this.$route.params.UserTag);
        this.fetchFollowingList(this.$route.params.UserTag);
    },
}
</script>
<style lang="scss" scoped>
.following-container{
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
            color:white;
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
.people-container{
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    padding-top: 0px;
    padding-bottom:80px;
    .person{
        width:100%;
        height:70px;
        display:flex;
        flex-direction:row;
        align-items: center;
        justify-content: space-between;
        box-sizing: border-box;
        padding: 40px 20px;
        cursor:pointer;
        transition: all 0.3s;
        &:hover{
            background-color: #080808;
        }
        .user-info{
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            gap:10px;
            img{
                width:50px;
                height:50px;
                border-radius:50%;
                background-color: rgb(255, 255, 255);
            }
            .person-info{
                display:flex;
                flex-direction:column;
                align-items: flex-start;
                justify-content: flex-start;
                gap:5px;
                .username{
                    color: white;
                    font-weight: bold;
                    font-size: 16px;
                    margin:0;
                }
                .usertag{
                    color: #6e767d;
                    font-size: 14px;
                    margin: 0;
                }
            }
        }
        .follow-button{
            padding:10px 15px; 
            display:flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 50px;
            border:none;
            background-color: white;
            color:black;
            font-size:15px;
            font-weight: bold;
            transition:all 0.3s;
            cursor:pointer;
            &:hover{
                background-color: #D7DBDC;
            }
        }
        .followed-button{
            padding:10px 15px; 
            display:flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 50px;
            border:1px solid #6A6F74;
            background-color: black;
            color:white;
            font-size:15px;
            font-weight: bold;
            transition:all 0.3s;
            cursor:pointer;
        }
        .unfollow-button{
            padding:10px 15px; 
            display:flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 50px;
            border:1px solid #e42020;
            background-color: rgba($color: #e42020, $alpha: 0.4);
            color:#e42020;
            font-size:15px;
            font-weight: bold;
            transition:all 0.3s;
            cursor:pointer;
            &:hover{
                background-color: rgba($color: #e42020, $alpha: 0.15);
            }
        }
    }
}
</style>