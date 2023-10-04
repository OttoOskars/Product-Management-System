<template>
<div class="container">
        <div class="side-bar">
            <ul class="nav-bar">
                <li class="nav-bar-brand">
                    <div>
                        <ion-icon name="logo-twitter"></ion-icon>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="search-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">Search</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="notifications-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">Notifications</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="mail-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">Messages</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="bookmark-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">Bookmarks</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="person-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">Profile</a>
                </li>

                <li class="nav-item">
                    <a href="#" class="item-icon home">
                        <ion-icon name="apps-outline"></ion-icon>
                    </a>
                    <a href="#" class="item-link">More</a>
                </li>
                <a href="#" class="tweet-btn">
                    <ion-icon name="pencil"></ion-icon>
                    <div class="text">Tweet</div>
                </a>
            </ul>
            <a href="#" class="profile-btn">
                <div class="profile-info">
                    <img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png" alt="" class="profile-img" width="35" height="35">
                    <div class="user-info">
                        <p class="username">Gustavs</p>
                        <p class="usertag">@Gust123</p>
                    </div>
                    <div class="options-icon">
                        <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </div>
                </div>
            </a>

        </div>
    </div>
</template>

<script>
export default {
    name: 'Home',
    data: () => ({
        showCreateAccount: false,
    }),
    methods: {
        toggleShowAccount(){
            this.showCreateAccount = !this.showCreateAccount
        },
    },
};

</script>
<style lang="scss" scoped>

* {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    transition: 0.2s ease;
}	


html {
    font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

a {
    text-decoration: none;
    color: white;
    font-size: 10px;
    
    
}

li {
    list-style: none;
}

body {
    background-color: black;
    padding: 0 3em;
}

.container {
    max-width: 1440px;
    margin: auto;
    height: 100vh;
}

.side-bar {
    position:fixed;
    height: 100%;
    width: 260px;
    border-right: 1px solid #fff2;
    top:0;
    bottom:0;
    padding: 10px 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    
}

.nav-bar {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    z-index: 100;
}

.nav-bar-brand {
    padding: 4px 8px;
}

.nav-bar-brand div ion-icon {
    color: white;
    font-size: 30px;
}


.nav-item {
    padding: 0px 25px 0px 10px;
    border-radius: 50px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    cursor: pointer; 
}

.nav-item:hover {
    background-color: #1d9bf020;
}

.item-link {
    font-size: 20px;
}


.nav-item .item-icon {
    margin-right: 10px;
    font-size: 40px;
    
}

.nav-item .item-icon ion-icon {
    font-size: 24px;
}

.tweet-btn {
    display: block;
    width: 230px;
    align-items: center;
    background:#1d9bf0;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 5px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: bold;
}

a.tweet-btn ion-icon {
    font-size: 20px;
    color: white;
    display: none;
}

.tweet-btn:hover {
    background-color:#1a7fc3;
}

a.profile-btn {
    width: 250px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-radius: 50px;
    font-size: 16px;

}


a.profile-btn:hover {
    background-color: #1d9bf020;
}

.profile-info {
    width:100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-info{
    width:100%;
    display: flex;
    flex-direction: column;
    text-align: left;
}
img.profile-img {
    border-radius: 50%;
    margin-right: 10px;
}

.profile-info .username {
    font-weight: bold;
    line-height: 1.5;

}

.profile-info .usertag {
    color:#6e767d
}

.options-icon {
    display: flex;
}
.options-icon ion-icon {
    font-size: 19px;
}
</style>
