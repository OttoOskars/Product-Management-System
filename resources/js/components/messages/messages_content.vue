<template>
    <div class="messages-container">
        <div class="messages-main">
            <div class="top-top">
                <button class="back-icon" @click="goBack">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </button>
                <div class="top-top-top" v-if="user">
                    <p class="title">Messages</p>
                    <p class="user-tag">{{ user.UserTag }}</p>
                </div>
            </div>
            <div class="main-text">Welcome to your inbox!</div>
            <div class="under-text">Drop a line, share posts and more with private conversations between you and others on X. </div>
            <button class="write-button" @click="TogglePopup('EditTrigger')">New message</button>
        </div>
        <div class="messages-right">
            <div class="right-text">Select a message</div>
            <div class="right-under-text">Choose from your existing conversations, start a new one, or just keep swimming.</div>
            <button class="right-write-button" @click="TogglePopup('EditTrigger')">New message</button>
        </div>
        <Popup v-if="popupTriggers.EditTrigger" :TogglePopup="() => TogglePopup('EditTrigger')">
            <div class="edit-popup">
                <p class="title-popup">New message</p>
                <button class="next-btn">Next</button>
                <div class="search-people">
                    <div class="input-wrap">
                        <input v-model="searchInput" @input="handleSearchInput" class="Edit-Input" :class="{ 'focused': isInputFocused }" @focus="inputFocus" @blur="inputBlur" placeholder="Search usernames..." />
                        <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    </div>
                    <div class="people-container">
                        <div class="person" v-for="Person in foundUsers" :key="Person.UserID">
                            <div class="user-info">
                                <img :src="'/storage/' + Person.ProfilePicture" class="person-img">
                                <div class="person-info">
                                    <p class="username">{{ Person.Name }}</p>
                                    <p class="usertag">{{ Person.UserTag }}</p>
                                </div>
                            </div>
                        </div>
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
export default{
    name: 'Search',
    components: {
        Popup,
    },
    data() {
        return {
            searchInput: '',
            users:[],
            foundUsers: [],
            isInputFocused: false,
        };
    },
    computed: {
        ...mapState(['user']),
    },
    setup () {
        const popupTriggers = ref({
            EditTrigger: false,
        });
        const TogglePopup = (trigger) => {
            popupTriggers.value[trigger] = !popupTriggers.value[trigger]
            if (!popupTriggers.value[trigger]) {
            }
		}
        return {
            popupTriggers,
            TogglePopup,
        }
    },
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        inputFocus() {
            this.isInputFocused = true;
        },
        inputBlur() {
            this.isInputFocused = false;
        },
        redirectTo(where) {
            this.$router.push(where);
        },
        openTweet(id) {
            console.log(id);
        },
        handleSearchInput() {
            if (this.searchInput.length > 0) {
                this.foundUsers = this.users.filter(user => {
                const searchInputLower = this.searchInput.toLowerCase();
                const userTagLower = user.UserTag.toLowerCase();

                return userTagLower.includes(searchInputLower);
                });
            } else {
                this.foundUsers = [];
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
.messages-container{
    height: 100%;
    display: grid;
    grid-template-columns: 65% 100%;
    .messages-main{
        padding-top:0px;
        height: 100vh;
        padding-bottom:80px;
        display:flex;
        flex-direction:column;
        box-sizing: border-box;
        border-right: 1px solid #2F3336;
        border-left: 1px solid #2F3336;
        .main-text{
            color: white;
            text-align:left;
            font-size: 32px;
            font-weight: bold;
            display: flex;
            margin-top: 10%;
            margin-left:6%;
            margin-right:15.5%;
        }
        .under-text{
            color:gray;
            display: flex;
            font-size: 15px;
            text-align: left;
            padding-left: 6%;
            margin-top: 15px;
        }
        .write-button{
            display: block;
            width: 170px;
            align-items: center;
            background:#1d9bf0;
            color: white;
            text-align: center;
            margin-top: 35px;
            margin-left: 6%;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            height: 50px;
            &:hover{
                background:#0c79c2
            }
        }
    }
    .messages-right{
        height: 100vh;
        flex-direction:column;
        box-sizing: border-box;
        border-right: 1px solid #2F3336;
        justify-content: center;
        .right-text{
            color: white;
            text-align: left;
            font-size: 32px;
            font-weight: bold;
            display: flex;
            justify-content: center;
            margin-top: 40%;
            align-items: center;
        }
        .right-under-text{
            color:gray;
            display: flex;
            font-size: 15px;
            text-align: left;
            padding-right: 20%;
            padding-left: 29.4%;
            margin-top: 15px;
            justify-content: center;
        }
        .right-write-button{
            display: block;
            width: 170px;
            background:#1d9bf0;
            color: white;
            text-align: center;
            margin-top: 35px;
            margin-left: 29.5%;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            height: 50px;
            &:hover{
                background:#0c79c2
            }
        }
    }
    .edit-popup{
        width:500px;
        min-height:550px;
        display:flex;
        flex-direction:column;
        gap:10px;
        padding:50px 20px 10px 20px;
        box-sizing: border-box;
        .title-popup{
            margin:0;
            padding:0;
            font-weight: bold;
            font-size: 22px;
            color: white;
        }
        .next-btn{
            position:absolute;
            top:10px;
            right:10px;
            width:auto;
            height:auto;
            display:flex;
            align-items: center;
            justify-content: center;
            color:#000000;
            border:none;
            background-color: white;
            border-radius: 50px;
            font-size: 14px;
            font-weight: bold;
            padding:8px 16px;
            cursor: pointer;
            &:hover{
                background-color:rgba($color: #f2f2f2, $alpha: 0.8);
            }
        }
        .search-people{
            padding-top:20px;
            .input-wrap{
                height:60px;
                width:100%;
                display:flex;
                align-items: center;
                background-color:rgba($color: #000000, $alpha: 0.8);
                backdrop-filter: blur(5px);
                position:sticky;
                top:0;
                z-index:99;
                padding:0 20px;
                box-sizing: border-box;
                .Edit-Input{
                    width: 100%;
                    height: 80%;
                    border-radius: 50px;
                    padding-left:60px;
                    border:  1px solid transparent;
                    background-color: #202327;
                    position: relative;
                    color:white;
                    font-size: medium;
                    &.focused {
                        outline:none;
                        background-color: black;
                        border-color: #1D9BF0;
                        box-shadow: 0 0 5px #1D9BF0;
                    }
                }
                .Edit-Input:focus + .search-icon{
                    color: #1D9BF0;
                }
                .Edit-Input::-webkit-input-placeholder {
                    color: #71767B;
                }
                .search-icon {
                    position: absolute;
                    left: 40px;
                    top: 50%;
                    transform: translate(0, -50%);
                    color: #71767B;
                    font-size: 24px;
                }
            }
            .people-container{
                width:100%;
                max-height: 400px;
                overflow-y: auto;
                display:flex;
                flex-direction:column;
                box-sizing: border-box;
                padding-top: 0px;
                padding-bottom: 0px;
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
                &:disabled{
                    color:#808080;
                }
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
                        border-radius: 50px;
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
                }
            }
        }
    }
}
@media (max-width: 1000px){
    .messages-container{
        display: flex;
        flex-direction: column;
        .messages-main{
            height: 50%;
            padding-bottom: 0px;
            border-right: 0px;
            border-left: 0px;
            .main-text{
                margin-left:4%;
            }
            .under-text{
                padding-left: 4%;
            }
            .write-button{
                margin-left: 4%;
            }
        }
        .messages-right{
            height: 50%;
            border-right: 0px;
            border-left: 0px;
            padding-bottom: 0px;
            justify-content: left;
            .right-text{
                margin-top: 15%;
                padding-left: 4%;
                justify-content: left;
            }
            .right-under-text{
                padding-left: 4%;
                justify-content: left;
            }
            .right-write-button{
                margin-left: 4%;
            }
        }
    }
}
@media (max-width: 700px){
    .messages-container{
        display: flex;
        flex-direction: column;
        .messages-main{
            height: 50%;
            padding-bottom: 0px;
            border-right: 0px;
            border-left: 0px;
            .main-text{
                font-size: 26px;
                margin-top: 20%;
                margin-left:4%;
            }
            .under-text{
                font-size: 13px;
                padding-left: 4%;
                margin-top: 12px;
            }
            .write-button{
                width: 150px;
                margin-top: 30px;
                margin-left: 4%;
                font-size: 14px;
                height: 45px;
            }
        }
        .messages-right{
            height: 50%;
            border-right: 0px;
            border-left: 0px;
            padding-bottom: 0px;
            justify-content: left;
            .right-text{
                font-size: 26px;
                margin-top: 20%;
                padding-left: 4%;
                justify-content: left;
            }
            .right-under-text{
                font-size: 13px;
                padding-left: 4%;
                padding-right: 4%;
                margin-top: 12px;
                justify-content: left;
            }
            .right-write-button{
                width: 150px;
                margin-top: 30px;
                margin-left: 4%;
                font-size: 14px;
                height: 45px;
            }
        }
        .edit-popup{
            width: 100%;
        }
    }
}
</style>