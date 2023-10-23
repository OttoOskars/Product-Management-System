<template>
    <div class="tweets-container">
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="title">People who follow</div>
        </div>

        <div class="people-container">
            <div v-for="(people, index) in people" :key="index" class="person">
                <div class="user-info">
                    <img :src="people.img" alt="" class="person-img">
                    <div class="person-info">
                        <p class="username">{{ people.name }}</p>
                        <p class="usertag">{{ people.username }}</p>
                    </div>
                </div>
                <button class="follow-btn" @click="handleFollow(index)" :class="{ 'followed-btn': people.followed }">
                        {{ people.followed ? 'Followed' : 'Follow' }}
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
export default {
    name: 'Tweets',
    data: () => ({
        showTweetWindow: false,
        followed: false,
        people: [
            { name: 'Joe Biden', username: '@JoeBiden', img: "https://akns-images.eonline.com/eol_images/Entire_Site/2014910/rs_600x600-141010052310-600.Joe-Biden-JR-101014.jpg?fit=around%7C1200:1200&output-quality=90&crop=1200:1200;center,top", followed: false },
            { name: 'Gustavs', username: '@Gusis', img: "data:image/jpeg;base64,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", followed: false },
            { name: 'Juris', username: '@Juritarded', img: "https://ssir.org/images/blog/Joe_Lee-headshot.png", followed: false },
            { name: 'Lebron', username: '@KingJames', img: "https://cdn.sportsforecaster.com/players/l.nba.com/60900/head/no-background/web", followed: false },
            { name: 'Angus', username: '@Angasa', img: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXUv6ZrOiS4QQaWCBlsw2zbj64_mcv8Bk-ZCLwDSWLznS_Iu2bxfnet_eaChBoikcPoCc&usqp=CAU", followed: false },
            { name: 'Diana', username: '@Diana', img: "https://pbs.twimg.com/profile_images/1317795886701969408/i9inMUiu_400x400.jpg", followed: false },
            { name: 'Donald Trump', username: '@Donalt_J_T', img: "https://pbs.twimg.com/media/F4VbjODbMAIWiEA.jpg", followed: false },
            { name: 'Obama', username: '@Barack', img: "https://pfps.gg/assets/pfps/6197-obama.png", followed: false },
        ]
    }),
    methods: {
        goBack() {
            this.$router.go(-1);
        },
        handleFollow(index) {
            this.people[index].followed = !this.people[index].followed;
        },
    },

}
</script>
<style lang="scss" scoped>
.tweets-container {
    width: 100%;
    height: auto;
    color: white;
}

.top-bar {
    height: 60px;
    background-color: rgba($color: #000000, $alpha: 0.8);
    position: fixed;
    top: 0;
    width: 5/12*100%;
    z-index: 99;
    box-sizing: border-box;
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    padding: 0 10px;
}

.title {
    width: 100%;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    box-sizing: border-box;
    padding-left: 20px;
    font-weight: bold;
    font-size: 22px;
}


.people-container{
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    padding-top: 60px;
    .person{
        width:100%;
        height:70px;
        display:flex;
        flex-direction:row;
        align-items: center;
        justify-content: space-between;
        box-sizing: border-box;
        padding: 40px 20px;
        cursor:pointer;
        transition: all 0.3s;
        &:hover{
            background-color: #080808;
        }

        .user-info{
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: flex-start;
            box-sizing: border-box;
            gap:10px;
            img{
                width:50px;
                height:50px;
                border-radius:50%;
                background-color: rgb(255, 255, 255);
            }
            .person-info{
                display:flex;
                flex-direction:column;
                align-items: flex-start;
                justify-content: flex-start;
                gap:5px;
                .username{
                    color: white;
                    font-weight: bold;
                    font-size: 16px;
                    margin:0;
                }
                .usertag{
                    color: #6e767d;
                    font-size: 14px;
                    margin: 0;
                }
            }
        }
        .follow-btn {
            background-color: #1e87f9;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 20px;
            cursor: pointer;
            height: 40px;
            width: 80px;
            font-weight: bold;
        }

        .followed-btn {
            background-color: white;
            color:#1d9bf0
        }
    }
}


.back-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    font-size: 22px;
    background-color: black;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
}

.back-icon:hover {
    background-color: rgba($color: #1a1a1a, $alpha: 0.9);

}
</style>
