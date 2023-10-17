<template>
    <div class="navbar-container"><!-- display-flex column space-between -->
        <div class="buttons"><!-- display-flex column gap 10px -->
            <!-- Each button in a div??? -->
            <!-- Each button width: 100% and height:??? -->
            <div class="logo">
                <div class="button-content">
                    <ion-icon name="logo-yahoo" style="font-size: 36px;"></ion-icon>
                </div>
            </div>

            <button class="Home">
                <div class="button-content">
                    <ion-icon name="home-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Home</span>
                </div>
            </button>

            <button class="Explore">
                <div class="button-content">
                    <ion-icon name="search-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Explore</span>
                </div>
            </button>

            <button class="Notifications">
                <div class="button-content">
                    <ion-icon name="notifications-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Notifications</span>
                </div>
            </button>

            <button class="Messages">
                <div class="button-content">
                    <ion-icon name="mail-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Messages</span>
                </div>
            </button>

            <button class="Bookmarks">
                <div class="button-content">
                    <ion-icon name="bookmark-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Bookmarks</span>
                </div>
            </button>

            <button class="Profile">
                <div class="button-content">
                    <ion-icon name="person-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">Profile</span>
                </div>
            </button>

            <button class="More">
                <div class="button-content">
                    <ion-icon name="apps-outline" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 20px;">More</span>
                </div>
            </button>

            <button class="Tweet" style="background-color: #1d9bf0; justify-content: center;" onmouseover="this.style.backgroundColor='#1a7fc3';" onmouseout="this.style.backgroundColor='#1d9bf0';">
                <div class="button-content">
                    <ion-icon name="logo-twitter" style="font-size: 24px;"></ion-icon>
                    <span style="font-size: 18px; margin-left: 10px;">Tweet</span>
                </div>
            </button>

        </div>
        <div class="profile"><!-- display-flex row align-items-center padding:???-->
            <div class="user-img"><!-- +/- 20% -->
                <img>
            </div><!-- +/- 60% -->
            <div class="user-info"><!-- display-flex column -->
                <p class="username">username</p>
                <p class="usertag">@usertag</p>
            </div>
            <div class="more-icon"><!-- +/- 20% -->
                <ion-icon name="ellipsis-horizontal"></ion-icon>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    name: 'NavBar',
}
</script>
<style lang="scss" scoped>
    .navbar-container{
        width: 3/12*100%;
        height: 100vh;
        display:flex;
        flex-direction: column;
        justify-content: space-between;
        position:fixed;
        box-sizing: border-box;
        padding-left:100px;

        z-index:10;
        border-right:solid 1px #2F3336;
        background:black;

        color:white;
    }
    .buttons{
        width:90%;
        display: flex;
        flex-direction: column;
        gap:10px;

        box-sizing: border-box;

        .button-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo{
            width: 100%;
            height:50px;
            display:flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color:black;
        }

        button{
            width: 100%;
            height:50px;
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            border-radius: 50px;
            background-color:black;
            border:none;
            font-size: 20px;
            color:white;
        }
        button:hover{
            background-color: #6e767d;
        }
    }

    .profile{
        width:100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        cursor: pointer;
        box-sizing: border-box;

        padding: 10px;
        margin-bottom:10px;

        font-size: 16px;

        border-radius: 50px;
        background:none;

        .user-img{
            width: auto;
            height:100%;
            display:flex;
            align-items: center;
            justify-content: center;
            img{
                width:50px;
                height:50px;

                border-radius:50%;
                background-color: rgb(255, 255, 255);
            }
        }
        .user-info{
            width: 60%;
            height:100%;
            display:flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            gap:10px;
            padding-left:10px;
            .username{
                font-weight: bold;
                font-size: 14px;
                margin:0;
            }
            .usertag{
                color: #6A6F74;
                font-size: 14px;
                margin:0;
            }
        }
        .more-icon{
            width: 20%;
            height:100%;
            display:flex;
            align-items: center;
            justify-content: center;
        }
    }

    .profile:hover{
        background-color: #2F3336;
    }
    @media (max-width: 1250px) {
        .navbar-container {
            position: fixed;
            bottom: 0;
            width: 100px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: black;
            z-index: 999;
        }

        .buttons {
            width:auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-wrap: nowrap;
        }

        .buttons button {
            width: 50px;
            height: 50px;
            border-radius:50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .buttons span {
            display: none;
        }
        .profile{
            justify-content: center;
            .user-info{
                display:none;
            }
            .more-icon{
                display:none;
            }
        }
    }
    @media (max-width: 500px) {
        .navbar-container {
            position: fixed;
            bottom: 0;
            width: 100%;
            height:50px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            padding: 5px !important;
            background-color: black;
            z-index: 10;
            border-top: 1px solid #2F3336;
        }

        .buttons {
            width:100%;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .Home, .Explore, .Notifications, .Messages{
            display:flex;
            align-items: center;
            justify-content: center;
            height:40px !important;
            width:40px !important;
            border-radius: 50% !important;
        }

        .Profile, .logo, .Bookmarks, .More, .profile{
            display:none !important;
        }
        .Tweet{
            width:45px !important;
            height:45px !important;
            position:fixed;
            right:12px;
            bottom:55px;
            border-radius:50% !important;
        }
    }

</style>
