<template>
    <div class="followers-container">
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="following-top">
                <p class="title">Followers</p>
            </div>
        </div>
        <div class="people-container">
            <div class="person" v-for="user in followersList" :key="user.UserID">
                <div class="user-info">
                    <img :src="user.ProfilePicture" alt="" class="person-img">
                    <div class="person-info">
                        <p class="username">{{ user.Name }}</p>
                        <p class="usertag">{{ user.UserTag }}</p>
                    </div>
                </div>
                <button class="follow-btn" @click="toggleFollowUnfollow(user.UserID)" :class="{ 'followed-btn': user.isFollowedByMe }">
                    {{ user.isFollowedByMe ? 'Unfollow' : 'Follow' }}
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'Followers',
    data(){
        return {
            followersList: [],
        }
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        fetchFollowersList() {
            axios.get('/api/followers')
                .then(response => {
                    this.followersList = response.data;
                })
                .catch(error => {
                    console.error('Error fetching followers list:', error);
                });
        },
    },
    mounted() {
        this.fetchFollowersList();
    },
}
</script>
<style lang="scss" scoped>
.followers-container{
    width:100%;
    height:auto;
    color:white;
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
    .following-top{
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
            margin-top: 7.5px;
            padding:0;
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
    padding-bottom:100px;
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
        .follow-btn {
            background-color: #1e87f9;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 20px;
            cursor: pointer;
            height: 40px;
            width: 80px;
            font-weight: bold;
        }
        .followed-btn {
            background-color: white;
            color:#1d9bf0
        }
    }
}
</style>