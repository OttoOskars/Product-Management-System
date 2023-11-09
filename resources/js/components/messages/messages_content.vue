<template>
    <div class="messages-container">
        <div class="messages-main">
            <div class="title">Messages</div>
            <div class="main-text">Welcome to your inbox!</div>
            <div class="under-text">Drop a line, share posts and more with private conversations between you and others on X. </div>
            <button class="write-button">Write a message</button>
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
                            <!-- <input type="text" id="name-input" class="Edit-Input" autocomplete="on" maxlength="30" required> -->
                            <input v-model="searchInput" @input="handleSearchInput" class="Edit-Input" placeholder="Search usernames..." />
                            <!-- <label for="name-input"><ion-icon name="search-outline"></ion-icon>Search people</label> -->
                        </div>

                            <div class="person" v-for="Person in foundUsers" :key="Person.UserID">{{ Person.UserTag }}
                                <!-- <div class="profile">
                                    <img :src="Person.profilePicture" alt="Profile Picture" class="profile-picture">
                                </div> -->
                            </div>
                    </div>
             </div>
        </Popup>



    </div>

</template>

<script>
import { ref } from 'vue';
import Popup from '@/components/Popup.vue';
import { mapState } from 'vuex';
export default{
    name: 'Search',
    components: {
        Popup,
    },
    data() {
        return {
            isInputFocused: false,
            people: 3,
            searchInput: '',
            users:[],
            foundUsers: [],
        };
    },
    computed: {
        ...mapState(['user']),
    },
    setup () {
        const popupTriggers = ref({
            TweetTrigger: false,
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
        redirectTo(where) {
            this.$router.push(where);
        },

        openTweet(id) {
            console.log(id);
        },
     handleSearchInput() {
       if (this.searchInput.length > 0) {
         this.foundUsers = this.users.filter(user => {
           // Convert both searchInput and UserTag to lowercase
           const searchInputLower = this.searchInput.toLowerCase();
           const userTagLower = user.UserTag.toLowerCase();

           return userTagLower.includes(searchInputLower);
         });
       } else {
         this.foundUsers = [];
       }
     }


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
}


    .title{
        color:white;
        padding:10px;
        padding-left:20px;
        font-size: 23px;
        font-weight:bold;
    }

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
    margin-right:15%;
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
    }
}


.write-button:hover{
    background:#0c79c2;
}

.right-write-button:hover{
    background:#0c79c2;
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
    }

    .input-wrap{
            border: none;
            border-radius:6px;
            font-family: Arial, sans-serif;
            position:relative;
            width:auto;
            height: 60px;
            box-sizing: border-box;
            display:flex;
            .Edit-Input{
                font-family: Arial, sans-serif;
                box-sizing:border-box;
                border: 1px solid #434343;
                color:#ffffff;
                padding: 20px 13px 5px 13px;
                outline:none;
                background: none;
                position:relative;
                display:flex;
                width:100%;
                height:100%;
                border-radius:6px;
                font-size:18px;
                resize: none;
                overflow: hidden;
                transition: 0.3s all;
                &:disabled{
                    color:#808080;
                }
                &:focus{
                    border:1px solid #1da1f2;
                }
            }
            label{
                font-size:18px;
                color:#434343;
                padding:5px;
                position:absolute;
                top:15px;
                left:5px;
                pointer-events: none;
                transition: 0.3s all;
            }
            .Edit-Input:focus+label,
            .Edit-Input:disabled+label,
            .Edit-Input:valid+label{
                font-size:16px;
                top:5px;
                left:7px;
                padding:0 5px 0 5px;
            }
            .Edit-Input:focus+label{
                color:#1da1f2;
            }
        }
        .search-people{
            padding-top:20px;
        }


.person {
    color: gray;
    margin-left: 2%;
    margin-top: 7%;
    font-size:16px;




}


}




</style>

