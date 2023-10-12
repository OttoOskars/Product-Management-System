<template>
    <div class="search-container">
        <div class="search-input-container">
            <input type="text" class="search-input" maxlength="30" placeholder="Search">
            <ion-icon name="search-outline" class="search-icon"></ion-icon>
        </div>
        <div class="who-to-follow">
            <div class="title">Who to follow</div>
            <div class="people-container">
                <div class="person">
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
                <div class="person">
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
                <div class="person">
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
                <div class="trend">
                    <p class="trend-rank">1. News. Trending</p>
                    <p class="trend-name">Skolā bumba</p>
                    <p class="trend-posts">1232 posts</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    name: 'Search',
}
</script>
<style lang="scss" scoped>
.search-container{
    width: 100%;
    height: 100%;
    display:flex;
    flex-direction: column;
    gap:20px;

    box-sizing: border-box;
    padding:10px 140px 10px 30px;

    border-left:solid 1px #2F3336;
    background:none;

    color:white;
}
.search-input-container {
    width:100%;
    height:60px;
    position:fixed;
    top:0;
    box-sizing: border-box;
    z-index:99;
    padding:5px 0px;
    background-color: black;
    display:flex;
    align-items:center;

    .search-input {
        width:200px;
        height:90%;
        border-radius: 50px;
        border:none;
        background-color: #16181C;
    }

    .search-icon {
        
    }
}

.title{
    width:100%;
    height:40px;
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
    width:100%;
    height:auto;
    background-color: #16181C;
    display:flex;
    flex-direction: column;
    box-sizing: border-box;
    margin-top:60px;
    border-radius: 25px;
    .people-container{
        box-sizing: border-box;
        padding:15px;
        width:100%;
        height:100%;
        display:flex;
        flex-direction: column;
        .person{
            padding-top:10px;
            padding-bottom:10px;
            width:100%;
            height:auto;
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
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
                    width:80px;
                    height:35px;
                    display:flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    border-radius: 50px;
                    border:none;
                    background-color: rgb(255, 255, 255);
                    color:black;
                    font-weight: bold;
                }
            }
        }
    }
}

.show-more-container{
    width:100%;
    height:auto;
    .show-more-btn{
        width:100%;
        height:50px;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
        border:none;
    }
}
.trends{
    width:100%;
    height:400px;
    background-color: #16181C;
    display:flex;
    flex-direction: column;
    box-sizing: border-box;
    gap:10px;
    border-radius: 25px;
    .trend-container{
        width:100%;
        height:100%;
        display:flex;
        flex-direction: column;
        padding-left: 20px;
        padding-right: 20px;
        .trend{
            width:100%;
            height:auto;
            display:flex;
            flex-direction: column;
            gap:5px;
            justify-content: center;
            align-items: flex-start;
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
    }
}

</style>