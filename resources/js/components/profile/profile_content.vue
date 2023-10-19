<template>
    <div class="profile-container">
        <div class="top">
            <div class="title"><button class="back-icon" @click="goBack"><ion-icon name="arrow-back-outline"></ion-icon></button><span style="margin-left: 10px;">Profile</span></div>
            <div class="tweet-count">0 tweets</div>
            <div class="image"></div>
            <div class="user-img">
                <img> 
            </div>
            <div class="edit-button">
                <button class="edit-profile">Edit profile</button>
            </div>
        </div>
        <div class="profile-info">
            <div class="user-info">
                <div class="name">Name</div>
                <div class="user">@user</div>
                <div class="description">Description</div>
                <div class="joined"><ion-icon name="calendar-outline"></ion-icon><span style="margin-left: 10px;">Joined October 2023</span></div>
            </div>
            <div class="follow">
                <div class="amount">0</div>
                <div class="following">Following</div>
                <div class="amount">0</div>
                <div class="following">Followers</div>
            </div>
        </div>
        <div class="post-type">
            <button @click="switchToTweets" class="post-type-btn" :class ="{ 'active-post-type': postType == 'tweets' }">Posts<div class="active-line" :class ="{ 'active': postType == 'tweets' }"></div></button>
            <button @click="switchToReplies" class="post-type-btn" :class ="{ 'active-post-type': postType == 'replies' }">Replies<div class="active-line" :class ="{ 'active': postType == 'replies' }"></div></button>
            <button @click="switchToLikes" class="post-type-btn" :class ="{ 'active-post-type': postType == 'likes' }">Likes<div class="active-line" :class ="{ 'active': postType == 'likes' }"></div></button>
        </div>
        <div class="topics">
            <div class="topics-2">Topics to follow</div>
            <div class="topics-3">Tweets about the Topics you follow show up in your home timeline</div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Profile',
    data(){
        return {
            postType: 'tweets',
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
    },
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
            height: 100%;
            width: 100%;
            background-color: gray;
            z-index: 9;
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
</style>