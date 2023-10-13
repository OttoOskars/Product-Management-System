<template>
    <div class="search-container">
        <div class="search-input-container">
            <input 
                type="text"
                id="search-input"
                class="search-input" 
                maxlength="30" 
                placeholder="Search"
                :class="{ 'focused': isInputFocused }"
                @focus="inputFocus"
                @blur="inputBlur"
                v-model="search"
                >
            <ion-icon name="search-outline" class="search-icon"></ion-icon>
            <button class="close-icon-btn" @click="clearSearch" :class="{ 'focused': isInputFocused }"><ion-icon name="close-circle-sharp" class="close-icon"></ion-icon></button>
        </div>
        <div class="who-to-follow">
            <div class="title">Who to follow</div>
            <div class="people-container">
                <div class="person" v-for="i in people" :key="i">
                    <div class="user">
                            <div class="user-img">
                                <img> 
                            </div>
                            <div class="user-info">
                                <p class="username">username</p>
                                <p class="usertag">@usertag</p>
                            </div>
                        </div>
                    <div class="button-container">
                        <button class="follow-button">Follow</button>
                    </div>
                </div>
                <!-- Add more people -->
            </div>
            <div class="show-more-container">
                <button class="show-more-btn">Show more</button>
            </div>
        </div>
        <div class="trends">
            <div class="title">Trending Latvia</div>
            <div class="trend-container">
                <div class="trend"  v-for="i in trends" :key="i">
                    <p class="trend-rank">1. News. Trending</p>
                    <p class="trend-name">Skolā bumba</p>
                    <p class="trend-posts">1232 posts</p>
                </div>
            </div>
            <div class="show-more-container">
                <button class="show-more-btn">Show more</button>
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
            people: 3,
            trends: 5,
        };
    },
    setup () {
        const search = ref('');
        const clearSearch = () => {
            search.value = '';
        }
        return {
            search,
            clearSearch
        }
    },
    methods: {
        inputFocus() {
            this.isInputFocused = true;
        },
        inputBlur() {
            this.isInputFocused = false;
        },
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

    box-sizing: border-box;
    padding-left:30px;
    padding-top:10px;
    border-left:solid 1px #2F3336;
    background:none;

    color:white;
}
.search-input-container {
    width: 400px;
    height: 60px;
    position: fixed;
    top: 0;
    box-sizing: border-box;
    z-index: 99;
    padding: 5px 0 2px 0;
    background-color: black;
    display: flex;
    align-items: center;
    .search-input {
        width: 100%;
        height: 90%;
        border-radius: 50px;
        padding-left:60px;
        border:  1px solid transparent;
        background-color: #202327;
        position: relative;
        color:white;
        font-size: medium;
        &.focused {
            outline:none;
            background-color: black; /* Change input background when focused */
            border-color: #1D9BF0; /* Change input border when focused */
            box-shadow: 0 0 5px #1D9BF0;
        }
    }

    .search-input:focus + .search-icon{
        color: #1D9BF0;
    }



    .search-input::-webkit-input-placeholder {
        color: #71767B;
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translate(0, -50%);
        color: #71767B;
        font-size: 24px;
    }
    .close-icon-btn{
        position: absolute;
        background:none;
        border:none;
        top: 50%;
        right:7px;
        transform: translate(0, -45%);
        display:none;
        cursor: pointer;
        &.focused {
            display:block;
        }
        .close-icon{
        color: #1D9BF0;
        font-size:30px;
        }
    }
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
    margin-top:70px;
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
.trends{
    position:sticky;
    top:80px;
    width:400px;
    height:auto;
    background-color: #16181C;
    display:flex;
    flex-direction: column;
    box-sizing: border-box;
    border-radius: 25px;
    .trend-container{
        width:100%;
        height:100%;
        display:flex;
        flex-direction: column;
        padding-top:20px;
        box-sizing: border-box;
        .trend{
            width:100%;
            height:auto;
            display:flex;
            flex-direction: column;
            padding: 10px 20px;
            box-sizing: border-box;
            gap:5px;
            justify-content: center;
            align-items: flex-start;
            cursor:pointer;
            .trend-rank{
                color: #6e767d;
                font-size: 12px;
                margin:0;
            }
            .trend-name{
                color:white;
                font-weight: bold;
                font-size: 14px;
                margin:0;
            }
            .trend-posts{
                color: #6e767d;
                font-size: 12px;
                margin:0;
            }

        }
        .trend:hover{
            background-color: #1D1F23;
        }
    }
}

</style>