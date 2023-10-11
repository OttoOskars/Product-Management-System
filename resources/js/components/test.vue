<template>
    <div class="container-fluid">
        <div class="row">
        <!--Kreisa Puse-->
            <div class="col-lg-3 col-md-4 col-sm-12 vh-100">
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
                                <!-- <p class="username">{{ user.Name }}</p> -->
                                <!-- <p class="usertag">{{ user.UserTag }}</p> -->
                            </div>
                            <div class="options-icon">
                                <ion-icon name="ellipsis-horizontal"></ion-icon>
                            </div>
                        </div>
                    </a>
                    </ul>
                </div>
            </div>

            <!--Vidus-->
            <div class="col-lg-6 col-md-8 col-sm-12">
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
            </div>

            <!--Labais-->
            <div class="col-lg-3 col-md-4 col-sm-12 vh-100">
                <div class="container__foryou">
                    <div class="trends-for-you">
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
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    name: 'test',
    computed: {
        // ...mapState(['user']),
    },
    data: () => ({
        showCreateAccount: false,
        followed: false,
        people: [
            { name: 'Joe Biden', username: '@JoeBiden', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
            { name: 'Gustavs', username: '@Gusis', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
            { name: 'Juris', username: '@Juritarded', img: "https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png", followed: false },
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
    
}

a {
    text-decoration: none;
    color: white;
    font-size: 10px;
}
//Kreisais//
.container__side-bar {
  padding: 10px 0;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-top: 5px;
}

.nav-bar {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  z-index: 100;
  background-color: #262626;
  padding: 10px;
  overflow-y: auto;
  border-radius: 10px;
}

.nav-bar-brand div ion-icon {
  color: white;
  font-size: 30px;
  margin: 10px 0;
}

.nav-item {
  padding: 10px 0;
  border-radius: 50px;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  cursor: pointer;
}

.nav-item:hover {
    background-color: gray;
    border-radius: 50px;
    width: 200px;
    margin-left: 10px;
}

.item-link {
  font-size: 16px;
}

.nav-item .item-icon {
  margin-right: 10px;
  font-size: 24px;
}

.tweet-btn {
  display: block;
  width: 230px;
  align-items: center;
  background: #1d9bf0;
  color: white;
  text-align: center;
  padding: 10px;
  margin: 10px 0;
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
  background-color: #1a7fc3;
}

a.profile-btn {
  width: 250px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-radius: 50px;
  font-size: 16px;
  margin-top: 100px;
}

a.profile-btn:hover {
  background-color: #1d9bf020;
}

.profile-info {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.user-info {
  width: 100%;
  display: flex;
  flex-direction: column;
  text-align: left;
  margin-left: 10px; /* Add left margin to user info */
}

img.profile-img {
  border-radius: 50%;
  margin-right: 10px;
  width: 35px; /* Adjust image size */
  height: 35px; /* Adjust image size */
}

.profile-info .username {
  font-weight: bold;
  line-height: 1.2; /* Adjust line height */
  font-size: 18px; /* Adjust font size */
}

.profile-info .usertag {
  color: #6e767d;
  font-size: 14px; /* Adjust font size */
}

.options-icon {
  display: flex;
}
.options-icon ion-icon {
  font-size: 19px;
}

@media (max-width: 768px) {
  .container__side-bar {
    width: 100%; /* Make the sidebar full width */
    max-height: none; /* Remove the max-height for smaller screens */
  }

  .nav-bar {
    padding: 10px;
    overflow-y: auto;
  }

  .nav-item {
    width: 100%; /* Make each item full width */
    margin-left: 0; /* Remove margin-left for items */
  }

  .tweet-btn,
  a.profile-btn {
    width: 100%; /* Make the buttons full width */
  }
}

/* Media query for screens with a minimum width of 768px (typical tablets and larger screens) */
@media (min-width: 768px) {
  .container__side-bar {
    width: 25%; /* Set a specific width for the sidebar */
  }
}

@media (max-width: 992px) {
  .container__side-bar {
    width: 100%; /* Make the sidebar full width */
    max-height: none; /* Remove the max-height for smaller screens */
  }

  .nav-bar {
    padding: 10px;
    overflow-y: auto;
  }

  .nav-item {
    width: 100%; /* Make each item full width */
    margin-left: 0; /* Remove margin-left for items */
  }

  .tweet-btn,
  a.profile-btn {
    width: 100%; /* Make the buttons full width */
  }
}

/* Media query for screens with a minimum width of 768px (typical tablets and larger screens) */
@media (min-width: 992px) {
  .container__side-bar {
    width: 25%; /* Set a specific width for the sidebar */
  }
}

@media (max-width: 2490px) {
  .container__side-bar {
    width: 100%; /* Make the sidebar full width */
    max-height: none; /* Remove the max-height for smaller screens */
  }

  .nav-bar {
    padding: 10px;
    overflow-y: auto;
  }

  .nav-item {
    width: 100%; /* Make each item full width */
    margin-left: 0; /* Remove margin-left for items */
  }

  .tweet-btn,
  a.profile-btn {
    width: 100%; /* Make the buttons full width */
  }
}

/* Media query for screens with a minimum width of 768px (typical tablets and larger screens) */
@media (min-width: 2490px) {
  .container__side-bar {
    width: 25%; /* Set a specific width for the sidebar */
  }
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

@media (max-width: 768px) {
  .tweets {
    padding: 10px; /* Adjust padding for smaller screens */
  }

  .tweets__img {
    width: 49px;
    height: 49px;
  }

  .tweets__header {
    flex-direction: column;
  }

  .tweets__name {
    font-size: 15px;
    font-weight: 700;
    margin-right: 0;
  }

  .tweets__content {
    text-align: left;
    margin-top: 5px;
  }

  .tweets__twname {
    font-size: 15px;
    color: gray;
  }

  .tweets__publish-time {
    margin-left: 0;
  }

  .tweets__bilde {
    width: 100%;
    border-radius: 15px;
    margin-top: 20px;
    height: auto; /* Allow the image to scale proportionally */
  }
}

@media (max-width: 992px) {
  .tweets {
    padding: 10px; /* Adjust padding for smaller screens */
  }

  .tweets__img {
    width: 49px;
    height: 49px;
  }

  .tweets__header {
    flex-direction: column;
  }

  .tweets__name {
    font-size: 15px;
    font-weight: 700;
    margin-right: 0;
  }

  .tweets__content {
    text-align: left;
    margin-top: 5px;
  }

  .tweets__twname {
    font-size: 15px;
    color: gray;
  }

  .tweets__publish-time {
    margin-left: 0;
  }

  .tweets__bilde {
    width: 100%;
    border-radius: 15px;
    margin-top: 20px;
    height: auto; /* Allow the image to scale proportionally */
  }
}

@media (max-width: 2490px) {
  .tweets {
    padding: 10px; /* Adjust padding for smaller screens */
  }

  .tweets__img {
    width: 49px;
    height: 49px;
  }

  .tweets__header {
    flex-direction: column;
  }

  .tweets__name {
    font-size: 15px;
    font-weight: 700;
    margin-right: 0;
  }

  .tweets__content {
    text-align: left;
    margin-top: 5px;
  }

  .tweets__twname {
    font-size: 15px;
    color: gray;
  }

  .tweets__publish-time {
    margin-left: 0;
  }

  .tweets__bilde {
    width: 100%;
    border-radius: 15px;
    margin-top: 20px;
    height: auto; /* Allow the image to scale proportionally */
  }
}

//trends for you //
.container__foryou {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  color: white;
  height: 100%; /* Set the height to 100% of the parent container */
}

.trends-for-you {
  width: 100%;
  padding: 10px;
  background-color: #262626;
  border-radius: 10px;
  overflow-y: auto;
  overflow-x: hidden;
  margin: 10px 0; /* Add margin for a gap from the top */
//   max-height: calc(100vh - 140px); /* Adjust max height for responsiveness */
}

.trends-for-you::-webkit-scrollbar {
  width: 12px;
}

.trends-for-you::-webkit-scrollbar-thumb {
  background: transparent;
}

.follow {
  width: 100%;
  padding: 10px;
  background-color: #262626;
  border-radius: 10px;
  overflow-y: auto;
  overflow-x: hidden;
  margin: 10px 0; /* Add margin for a gap between sections */
//   max-height: calc(100vh - 270px); /* Adjust max height for responsiveness */
}

.follow::-webkit-scrollbar {
  width: 12px;
}

.follow::-webkit-scrollbar-thumb {
  background: transparent;
}

/* Keep the rest of the styles as is */

.trends-for-you__header,
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
  margin-right: 10px;
  position: relative;
  top: 30px;
}

.who-to-follow__button {
  background-color: #007BFF;
  color: #fff;
  border: none;
  padding: 5px 10px;
  border-radius: 20px;
  cursor: pointer;
  height: 40px;
  position: relative;
  left: 250px;
  bottom: 60px;
}

.followed-button {
  background-color: white;
  color: #007BFF;
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
    color: gray;
    position: relative;
    left: 60px;
    bottom: 15px;
}

</style>
