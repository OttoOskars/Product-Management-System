<template>
    <div class="tweets-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="title">Who to follow</div>
        </div>

        <div class="people-container">
            <div class="person" v-for="person in users" :key="person.UserID">
                <div class="user-info">
                    <img :src="'/storage/' + person.ProfilePicture" class="person-img"> 
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
import { mapState } from 'vuex';
export default {
    name: 'Tweets',
    data: () => ({
        showTweetWindow: false,
        followed: false,
        users:[],
        isHovered:  [],
    }),
    computed: {
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
        this.$axios.get('/api/allusers')
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
.tweets-container {
    width: 100%;
    height: auto;
    color: white;
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
.top-bar {
    height: 60px;
    width:100%;
    background-color: rgba($color: #000000, $alpha: 0.8);
    border-bottom:solid 1px #2F3336;
    position: sticky;
    top: 0;
    z-index: 9;
    box-sizing: border-box;
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    padding: 0 10px;
}

.title {
    width: 100%;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    box-sizing: border-box;
    padding-left: 20px;
    font-weight: bold;
    font-size: 22px;
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


.back-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    font-size: 22px;
    background:none;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
}

.back-icon:hover {
    background-color: rgba($color: #1a1a1a, $alpha: 0.9);

}
@media (max-width: 500px) {
    .top-bar{
        height:35px;
        width:100%;
        .search-input {
            width: 100%;
            height: 80%;
            border-radius: 50px;
            padding-left:30px;
            border:  1px solid transparent;
            background-color: #202327;
            position: relative;
            color:white;
            font-size: 13px;
        }

        .search-icon {
            position: absolute;
            left: 30px;
            top: 50%;
            transform: translate(0, -50%);
            color: #71767B;
            font-size: 16px;
        }
    }

    .title{
        font-size:17px !important;
    }
    .title2{
        width:100%;
        box-sizing: border-box;
        height:70%;
    }
    .people-container{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:column;
        box-sizing: border-box;
        padding-bottom:100px;
        .person{
            width:100%;
            height:40px;
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: space-between;
            box-sizing: border-box;
            padding: 30px 20px;
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
                    width:40px;
                    height:40px;
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
                        font-size: 11px;
                        margin:0;
                    }
                    .usertag{
                        color: #6e767d;
                        font-size: 11px;
                        margin: 0;
                    }
                }
            }
            .follow-btn {
                background-color: #1e87f9;
                color: #fff;
                border: none;
                border-radius: 20px;
                display:flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                height: 30px;
                width: 50px;
                font-weight: bold;
                font-size:11px;
            }

            .followed-btn {
                background-color: white;
                color:#1d9bf0
            }
        }
    }
}
</style>
