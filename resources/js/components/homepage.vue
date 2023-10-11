
<template>
    <div class="container">
        <!--Kreisa Puse-->
        <div class="container__side-bar">
            <ul class="nav-bar">
                <li class="nav-bar-brand">
                    <div>
                        <ion-icon name="logo-twitter"></ion-icon>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="item-icon home">
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
                <a href="#" class="profile-btn">
                <div class="profile-info">
                    <img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png" alt="" class="profile-img" width="35" height="35">
                    <div class="user-info">
                        <p class="username">{{ user.Name }}</p>
                        <p class="usertag">{{ user.UserTag }}</p>
                    </div>
                    <div class="options-icon">
                        <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </div>
                </div>
            </a>
            </ul>
        </div>

        <!--Vidus-->
        <div class="container__main-scroll">
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Konstantīns
                        </div>
                        <div class="tweets__twname">
                            @Ērglis_Konstantīns34
                        </div>
                        <div class="tweets__publish-time">
                            80m
                        </div>
                    </div>
                    <div class="tweets__content">
                        Meklēju otro pusīti! Par mani - 75 gadus vecs, vairs nestrādāju - meklēju draudzeni 18-19 gados.
                        VECĀKAS NĒ!!
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Juris
                        </div>
                        <div class="tweets__twname">
                            @Juritarded
                        </div>
                        <div class="tweets__publish-time">
                            10m
                        </div>
                    </div>
                    <div class="tweets__content">
                        Labdien!
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Arnis
                        </div>
                        <div class="tweets__twname">
                            @Arno
                        </div>
                        <div class="tweets__publish-time">
                            5m
                        </div>
                    </div>
                    <div class="tweets__content">
                        Šiš ira moja suns - PAratodu pa 5 Lati uj 2 liljiem Aldariem 4 litra Protjams!
                        <img class="tweets__bilde" src="https://www.cesarsway.com/wp-content/uploads/2015/06/AdobeStock_222480718-1024x740.jpeg">
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Matīs
                        </div>
                        <div class="tweets__twname">
                            @Mats
                        </div>
                        <div class="tweets__publish-time">
                            35m
                        </div>
                    </div>
                    <div class="tweets__content">
                        Tavu suni neviens negrib @Arno!
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Pētris
                        </div>
                        <div class="tweets__twname">
                            @Pečka445
                        </div>
                        <div class="tweets__publish-time">
                            1d
                        </div>
                    </div>
                    <div class="tweets__content">
                        NGL Gustavs ir a real one!
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Kārlis
                        </div>
                        <div class="tweets__twname">
                            @Vista
                        </div>
                        <div class="tweets__publish-time">
                            7h
                        </div>
                    </div>
                    <div class="tweets__content">
                        Jā es piekrītu Pētera teiktajam
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Anonīms
                        </div>
                        <div class="tweets__twname">
                            @Anonīms
                        </div>
                        <div class="tweets__publish-time">
                            3h
                        </div>
                    </div>
                    <div class="tweets__content">
                        Sprcis ir lohs
                    </div>
                </div>
            </div>
            <div class ="tweets">
                <img class="tweets__img" src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png">
                <div class="tweets__main">
                    <div class="tweets__header">
                        <div class="tweets__name">
                            Evija
                        </div>
                        <div class="tweets__twname">
                            @EvijaMāte
                        </div>
                        <div class="tweets__publish-time">
                            45m
                        </div>
                    </div>
                    <div class="tweets__content">
                        Ģimene ir number One! #MOMBOSS PS: Spricis = pajols
                        <img class="tweets__bilde" src="https://www.mintarrow.com/wp-content/uploads/2021/12/RESIZED-Family-04344.jpg">
                    </div>
                </div>
            </div>
        </div>

        <!--Labais-->
        <div class="container__foryou">
            <div class="trends-for-you__container">
                <div class="trends-for-you__header">
                    Trends for you
                </div>
                <div class ="trends-for-you__information">
                    Trending in Latvia
                </div>
                <div class ="trends-for-you__trend-name">
                    #MOMBOSS
                </div>
                <div class="trends-for-you__tweets">
                    5k Tweets
                </div>

                <div class="line"></div>

                <div class ="trends-for-you__information">
                    Trending in Germany
                </div>
                <div class ="trends-for-you__trend-name">
                    #StopCrime
                </div>
                <div class="trends-for-you__tweets">
                    154k Tweets
                </div>

                <div class="line"></div>

                <div class ="trends-for-you__information">
                    Trending in USA
                </div>
                <div class ="trends-for-you__trend-name">
                    #Election2024
                </div>
                <div class="trends-for-you__tweets">
                    3.4m Tweets
                </div>

                <div class="line"></div>

                <div class ="trends-for-you__information">
                    Trending in USA
                </div>
                <div class ="trends-for-you__trend-name">
                    #Election2024
                </div>
                <div class="trends-for-you__tweets">
                    3.4m Tweets
                </div>
            </div>

            <div class="follow">
                <div class="who-to-follow__header">
                    Who to follow
                </div>

                    <div v-for="(people,index) in people" :key="index" class="who-to-follow__block">
                        <div class="who-to-follow__content">
                            <img :src ="people.img" alt="" class="who-img">
                            <div>
                                <div class="who-to-follow__author-name">
                                    {{ people.name }}
                                </div>
                                <div class="who-to-follow__author-username">
                                    {{ people.username }}
                                </div>
                            </div>
                            <button class="who-to-follow__button" @click="handleFollow(index)" :class="{ 'followed-button': people.followed }">
                                {{ people.followed ? 'Followed' : 'Follow' }}
                            </button>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
import { mapState } from 'vuex';
export default {
    name: 'Home',
    computed: {
        ...mapState(['user']),
    },
    data: () => ({
        showCreateAccount: false,
        followed: false,
        people: [
            { name: 'Joe Biden', username: '@JoeBiden', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
            { name: 'Gustavs', username: '@Gusis', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
            { name: 'Juris', username: '@Juritarded', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
            { name: 'Lebron', username: '@KingJames', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
            { name: 'Angus', username: '@Angasa', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
        ]
    }),
    methods: {
        toggleShowAccount(){
            this.showCreateAccount = !this.showCreateAccount
        },
        handleFollow(index) {
            this.people[index].followed = !this.people[index].followed;
        },
    },
};
</script>

<style lang="scss" scoped>

* {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
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
    display: grid;
    grid-template-columns: 275px auto 350px;
    margin: 0 auto;
}
//Kreisais//
.container__side-bar {
    height: 100%;
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
    position: fixed;

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
    background-color: rgb(22, 22, 22);
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
    margin-top: 200px;

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

//MainPage//
.tweets {
    color: white;
    display: flex;
    border-bottom: 1px solid #333637;
    margin-bottom: 4px;
    padding: 15px 20px;
    width: 100%;

}

.tweets:last-child {
    border-bottom: none;
}

.tweets__img {
    widows: 49px;
    height: 49px;
    border-radius: 50%;
    margin-right: 10px;
}

.tweets__header {
    display: flex;
}


.tweets__name {
    font-size: 15px;
    font-weight: 700;
    margin-right: 5px;
}

.tweets__content {
    display: flex;
    flex-direction: column;
    text-align: left;
    margin-top: 5px;
}

.tweets__twname {
    font-size: 15px;
    color:gray;

}

.tweets__publish-time
{
    margin-left: 8px;
}

.tweets__bilde {
    width: 100%;
    border-radius: 15px;
    margin-top: 20px;
    height: 500px;
}

//trends for you //
.container__foryou {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    color: white;
    height: 100%;
}

.trends-for-you__container {
    width: 280px;
    height: 40%;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #262626;
    position: fixed;
    margin-left: 50px;
    border-radius: 10px;
    overflow-y: auto;
    overflow-x: hidden;
}

.trends-for-you__container::-webkit-scrollbar {
    width: 12px;
}

.trends-for-you__container::-webkit-scrollbar-thumb {
    background: transparent;
}

.follow {
    width: 280px;
    height: 330px;
    padding: 10px;
    background-color: #262626;
    position: fixed;
    margin-top: 330px;
    margin-left: 50px;
    border-radius: 10px;
    overflow-y: auto;
    overflow-x: hidden;
}

.follow::-webkit-scrollbar {
    width: 12px;
}

.follow::-webkit-scrollbar-thumb {
    background: transparent;
}


.who-to-follow__header {
    font-weight: bold;
    font-size: 1.2em;
}

.trends-for-you__information {
    margin: 5px 0;
    margin-top: 20px;
}
.trends-for-you__trend-name {
    color: gray;
    margin: 5px 0;
}
.who-to-follow__content {
    margin: 5px 0;
}

.trends-for-you__tweets {
    margin: 5px 0;
}

.who-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    position: relative;
    margin-right: 10px;
    top: 30px;
}

.who-to-follow__button {
    background-color: #1e87f9;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 20px;
    cursor: pointer;
    position: relative;
    left: 190px;
    bottom: 50px;
    height: 40px;
    width: 80px;
}

.followed-button {
    background-color: white;
    color:#1d9bf0
}

.line {
    background-color: white;
    height: 1px;
}

.who-to-follow__author-name {
    position: relative;
    left: 60px;
    bottom: 20px;
}

.who-to-follow__author-username {
    position: relative;
    left: 60px;
    bottom: 15px;
    color: gray;
}

</style>
