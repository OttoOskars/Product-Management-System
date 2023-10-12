<template>
    <div class="navbar-container"><!-- display-flex column space-between -->
        <div class="buttons"><!-- display-flex column gap 10px -->
            <!-- Each button in a div??? -->
            <!-- Each button width: 100% and height:??? -->
            <div class="logo"><ion-icon name="logo-twitter"></ion-icon>Y</div>
            <button><ion-icon name="home-outline"></ion-icon>Home</button>
            <button><ion-icon name="search-outline"></ion-icon>Explore</button>
            <button><ion-icon name="notifications-outline"></ion-icon>Notifications</button>
            <button><ion-icon name="mail-outline"></ion-icon>Messages</button>
            <button><ion-icon name="bookmark-outline"></ion-icon>Bookmarks</button>
            <button><ion-icon name="person-outline"></ion-icon>Profile</button>
            <button><ion-icon name="apps-outline"></ion-icon>More</button>
            <button><ion-icon name="logo-twitter"></ion-icon>Tweet</button>
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
        width: 25%;
        height: 100%;
        display:flex;
        flex-direction: column;
        justify-content: space-between;
        position:fixed;

        box-sizing: border-box;
        padding-left:100px;

        border-right:solid 1px #ffffff;
        background:none;

        color:white;
    }
    .buttons{
        width:100%;
        display: flex;
        flex-direction: column;
        gap:10px;

        box-sizing: border-box;

        .logo{
            width: 100%;
            height:50px;
            display:flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;

            background-color:black;
        }

        button{
            width: 100%;
            height:50px;
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: space-between;

            border-radius: 50px;
            border:none;
            background-color:black;

            color:white;

            button:hover{
                background-color: #6e767d;
            }
        }
    }

    .profile{
        width:100%;
        display: flex;
        flex-direction: row;
        align-items: center;

        box-sizing: border-box;

        padding: 10px;
        margin:0;

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
                color: #6e767d;
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

</style>