<template>
    <div class="search-container">
        <div class="who-to-follow">
            <div class="title">Who to follow</div>
            <div class="people-container">
                <div class="person" v-for="user in users" :key="user.UserID">
                    <div class="user">
                        <div class="user-img">
                            <img :src="'/storage/' + user.ProfilePicture" alt="" class="person-img"> 
                        </div>
                        <div class="user-info">
                            <p class="username">{{ user.Name }}</p>
                            <p class="usertag">{{ user.UserTag }}</p>
                        </div>
                    </div>
                    <div class="button-container">
                        <button class="follow-button" @click="toggleFollowUnfollow(user.UserID)">
                            {{ user.isFollowedByMe ? 'Unfollow' : 'Follow' }}
                        </button>
                    </div>
                </div>
                <!-- Add more people -->
            </div>
            <div class="show-more-container">
                <button class="show-more-btn" @click="redirectTo('/people')">Show more</button>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
export default{
    name: 'Search',
    data() {
        return {
            isInputFocused: false,
            users: [],
            trends: 5,
        };
    },
    setup () {
    },
    methods: {
        redirectTo(where) {
            this.$router.push(where);
        },
        openProfile(id){
            console.log(id);
        },
        openTweet(id) {
            console.log(id);
        },
        toggleFollowUnfollow(userID) {
            const user = this.users.find((t) => t.UserID === userID);
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
                    const user = this.users.find((t) => t.UserID === userID);
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
                    const user = this.users.find((t) => t.UserID === userID);
                    user.isFollowedByMe = false;
                }
            } catch (error) {
                console.error('Error unfollowing the user:', error);
            }
        },
    },
    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.$axios.get('/api/topFollowedUsers')
        .then(response => {
            this.users = response.data;
        })
        .catch(error => {
            console.error(error);
        });
    }, 
}
</script>
<style lang="scss" scoped>
.search-container{
    width:100%;
    height: 100%;
    display:flex;
    flex-direction: column;
    gap:20px;
    position:fixed;
    box-sizing: border-box;
    padding-left:30px;
    padding-top:10px;
    border-left:solid 1px #2F3336;
    background:none;

    color:white;
}

.title{
    width:100%;
    height:38px;
    display:flex;
    align-items: center;
    justify-content: flex-start;
    box-sizing: border-box;
    padding-left:20px;
    padding-top:20px;
    font-weight: bold;
    font-size: x-large;
}
.who-to-follow{
    width:400px;
    height:auto;
    background-color: #16181C;
    display:flex;
    flex-direction: column;
    box-sizing: border-box;
    margin-top:15px;
    border-radius: 25px;
    .people-container{
        box-sizing: border-box;
        padding-top:20px;
        width:100%;
        height:100%;
        display:flex;
        flex-direction: column;
        .person{
            box-sizing: border-box;
            padding:10px 20px;
            width:100%;
            height:auto;
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            transition:all 0.3s;
            cursor:pointer;
            .user{
                width:auto;
                height:100%;
                display:flex;
                flex-direction: row;
                align-items: center;
                justify-content: flex-start;
                .user-img{
                    width:auto;
                    height:auto;
                    display:flex;
                    align-items: center;
                    justify-content: center;
                    img{
                        width:50px;
                        height:50px;
                        border-radius:50%;
                        background-color: #ffffff;
                    }
                }
                .user-info{
                    padding-left:10px;
                    width:100%;
                    height:100%;
                    display:flex;
                    flex-direction: column;
                    align-items: flex-start;
                    justify-content: center;
                    gap:10px;
                    .username{
                        font-weight: bold;
                        font-size: 14px;
                        margin:0;
                    }
                    .usertag{
                        color: #71767B;
                        font-size: 14px;
                        margin:0;
                    }
                }
            }
            .button-container{
                width:auto;
                height:100%;
                display:flex;
                align-items: center;
                justify-content: center;
                .follow-button{
                    padding:10px 20px; 
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
                }
                .follow-button:hover{
                    background-color: #D7DBDC;
                }
            }
        }
        .person:hover{
            background-color: #1D1F23;
        }
    }
}

.show-more-container{
    width:100%;
    height:auto;
    .show-more-btn{
        width:100%;
        height:60px;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
        border:none;
        display:flex;
        align-items: center;
        padding-left:25px;
        background: none;
        font-size:18px;
        color:#1D9BF0;
        cursor: pointer;
        transition:all 0.3s;
    }
    .show-more-btn:hover{
        background-color: #1D1F23;
    }
}
@media (max-width: 1250px) {
    .who-to-follow{
        width:300px;
    }
    .search-input-container{
        width:300px;
    }
    .trends{
        width:300px;
    }
}
@media (max-width: 1100px) {
    .who-to-follow{
        width:300px;
    }
    .search-input-container{
        width:300px;
    }
    .trends{
        width:300px;
    }
}
</style>