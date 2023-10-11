
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
                    <button class="tweet-btn" @click="openTweetWindow">Tweet</button>

                    <div v-if="showTweetWindow" class="tweet-window">
                        <textarea class="tweet-windows" v-model="tweetText"></textarea>
                        <button class="tweet-window-close" @click="closeTweetWindow">Close</button>
                        <button class="tweet-window-submit" @click="submitTweet">Submit</button>
                    </div>
                    <button @click="logoutUser">Logout</button>
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
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
import { mapState } from 'vuex';
export default {
    name: 'Home',
    computed: {
        ...mapState(['user']),
    },
    data: () => ({
        showTweetWindow: false,
        followed: false,
        people: [
            { name: 'Joe Biden', username: '@JoeBiden', img: "https://akns-images.eonline.com/eol_images/Entire_Site/2014910/rs_600x600-141010052310-600.Joe-Biden-JR-101014.jpg?fit=around%7C1200:1200&output-quality=90&crop=1200:1200;center,top", followed: false },
            { name: 'Gustavs', username: '@Gusis', img: "data:image/jpeg;base64,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", followed: false },
            { name: 'Juris', username: '@Juritarded', img: "https://ssir.org/images/blog/Joe_Lee-headshot.png", followed: false },
            { name: 'Lebron', username: '@KingJames', img: "https://cdn.sportsforecaster.com/players/l.nba.com/60900/head/no-background/web", followed: false },
            { name: 'Angus', username: '@Angasa', img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXUv6ZrOiS4QQaWCBlsw2zbj64_mcv8Bk-ZCLwDSWLznS_Iu2bxfnet_eaChBoikcPoCc&usqp=CAU", followed: false },
        ]
    }),
    setup () {
        const router = useRouter();
        const store = useStore();

        if (store.state.isLoggedIn) {
        router.push('/home');
        }

        const logoutUser = async () => {
        try {
            await store.dispatch('logout'); // Call the logout action from your store
            router.push('/'); // Redirect to the login page or wherever you want after logging out
        } catch (error) {
            console.error(error);
        }
        };
        return {
        logoutUser,
            }
	},
    methods: {
        handleFollow(index) {
            this.people[index].followed = !this.people[index].followed;
        },
        openTweetWindow() {
            this.showTweetWindow = true;
        },
        closeTweetWindow() {
            this.showTweetWindow = false;
        },
        submitTweet() {
            this.closeTweetWindow();
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
    border: none;
}

/*TweetWindow*/
.tweet-window {
background-color:#262626 ;
width: 270px;
height: 130px;
margin-left:0px;
border: none;
color:white;
resize: none;
margin-top:20px;
}

.tweet-windows {
background-color:#262626 ;
width: 100%;
height: 100%;
margin-left:0px;
border: none;
color:white;
resize: none;

}
.tweet-window-close{
    width: 70px;
    height: 30px;
    align-items: center;
    background:rgb(184, 73, 73);
    color: white;
    text-align: center;
    margin-top: 5px;
    border-radius: 15px;
    font-weight: bold;
    border: none;
}

.tweet-window-submit{
    width: 70px;
    height: 30px;
    align-items: center;
    background:rgb(93, 104, 231);
    color: rgb(255, 255, 255);
    text-align: center;
    margin-top: 5px;
    border-radius: 15px;
    font-weight: bold;
    border: none;
    margin-left: 12px;
}

/*TweetWindowEND*/

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

.trends-for-you__header {
    font-weight: bold;
    font-size: 1.2em;
}


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
    width: 53px;
    height: 53px;
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
    font-weight: bold;
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
