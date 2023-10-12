<template>
    <div class="tweets-container">
        <div class="top-bar">
            <div class="title">Home</div>
            <div class="post-type">
                <button>For you</button>
                <button>Following</button>
            </div>
        </div>
        <div class="post-container">
            <div class="create-tweet">
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="tweet-input-container">
                            <textarea class="tweet-input" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="buttons">
                            <button class="tweet-btn">Tweet</button>
                            <button class="tweet-btn">Tweet</button>
                            <button class="tweet-btn">Tweet</button>
                        </div>
                        <button class="post-button">POST</button>
                    </div>
                </div>
            </div>
            <div class="post"> 
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="userinfo">
                            <p class="username">username</p>
                            <p class="usertag">-  @usertag</p>
                        </div>
                        <div class="content-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus animi omnis quisquam quam voluptates saepe. Exercitationem?</p>
                        </div>
                    </div>
                    <div class="content-img">
                        <img>
                    </div>
                    <div class="bottom"><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon></div>
                </div>
            </div>
            <div class="post">
                <div class="left-side">
                    <img>
                </div>
                <div class="right-side">
                    <div class="top">
                        <div class="userinfo">
                            <p class="username">username</p>
                            <p class="usertag">-  @usertag</p>
                        </div>
                        <div class="content-text">
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus animi omnis quisquam quam voluptates saepe. Exercitationem?</p>
                        </div>
                    </div>
                    <div class="content-img">
                        <img>
                    </div>
                    <div class="bottom"><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon><ion-icon name="ellipsis-horizontal"></ion-icon></div>
                </div>
            </div>
            <!-- More posts -->
        </div>
    </div>
</template>
<script>
export default{
    name: 'Tweets',
}
</script>
<style lang="scss" scoped>
.tweets-container{
    width:100%;
    height:auto;
}

.top-bar{
    width:100%;
    height:125px;
    display:flex;
    flex-direction:column;
    background-color:rgba($color: #000000, $alpha: 0.8);
    position:fixed;
    top:0;
    width:5/12*100%;
    z-index:99;
    backdrop-filter: blur(5px);
    border-bottom:solid 1px #ffffff;

    .title{
        width:100%;
        box-sizing: border-box;
        height:50%;
        display:flex;
        justify-content: flex-start;
        align-items: center;
        color:white;
        padding:10px;

    }
    .post-type{
        width:100%;
        height:50%;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
        button{
            width:50%;
            height:100%;
            align-items: center;
            justify-content: center;
            color:white;
            padding:10px;


            border:none;
            background:none;
        }
    }
}

.post-container{
    padding-top:125px;
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;

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
}


.create-tweet{
    width:100%;
    min-height:fit-content;
    display:flex;
    flex-direction:row;
    box-sizing: border-box;
    gap:10px;
    padding:10px;
    border-bottom: 1px solid #ffffff;

    .right-side{
        width:90%;
        height:100%;
        display:flex;
        gap:10px;
        flex-direction:column;
        .top{
            width:100%;
            height:80%;
            display:flex;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            padding:0px;
            .tweet-input-container{
                width:100%;
                height:100%;
                display:flex;
                align-items: center;
                justify-content: center;
                .tweet-input{
                    width:100%;
                    height:100%;
                    background-color: #000000;
                    color:#ffffff;
                    resize: none;
                    transition: height 0.2s;
                }
            }
        }
        .bottom{
            width:100%;
            height:40px;
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            .buttons{
                display:flex;
                flex-direction: row;
                gap:20px;

                .tweet-btn{
                    height:100%;
                    width:auto;
                }
            }
            .post-button{
                width:75px;
                height:100%;
            }
        }
    }

}
.post{
    width:100%;
    min-height:auto;
    display:flex;
    flex-direction:row;
    gap:10px;
    box-sizing: border-box;
    padding:10px;
    border-bottom: 1px solid #ffffff;
    .right-side{
        width:90%;
        height:100%;
        display:flex;
        gap:10px;
        flex-direction:column;

        .top{
            width:100%;
            height:auto;
            display:flex;
            flex-direction:column;
            .userinfo{
                width:100%;
                height:10px;
                display:flex;
                flex-direction:row;
                justify-content: flex-start;
                align-items: center;
                color:white;
                padding-top:2px;
            }

            .content-text{
                width:100%;
                height:auto;
                text-align: left;
                color:white;
                padding:0px;
            }

        }
        .content-img{
            width:auto;
            height:auto;
            display:flex;
            justify-content: flex-start;
            align-items: center;
            box-sizing: border-box;
            img{
                border-radius:25px;
                width:300px;
                height:300px;
                border:solid 1px #ffffff;
                background-color: white;
            }
        }
        .bottom{
            width:100%;
            height:30px;
            display:flex;
            flex-direction: row;
            justify-content: space-evenly;
            color:#ffffff;
        }

    }

}
</style>