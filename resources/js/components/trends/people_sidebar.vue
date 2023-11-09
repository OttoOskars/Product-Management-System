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
                <div class="person" v-for="person in users" :key="person.UserID">
                    <div class="user">
                        <div class="user-img">
                            <img @click.stop="openProfile(person.UserTag)" :src="'/storage/' + person.ProfilePicture" alt="" class="person-img"> 
                        </div>
                        <div class="user-info">
                            <p class="username">{{ person.Name }}</p>
                            <p class="usertag">{{ person.UserTag }}</p>
                        </div>
                    </div>
                    <div class="button-container">
                        <button  
                            class="follow-button" 
                            @click="toggleFollowUnfollow(person.UserID)"
                            v-if="!(person.UserID === user.UserID)"
                            :class="{
                                'followed-button': person.isFollowedByMe,
                                'unfollow-button': person.isFollowedByMe && isHovered[person.UserID]
                            }"
                            @mouseover="isHovered[person.UserID] = true"
                            @mouseout="isHovered[person.UserID] = false">
                            {{ followButtonLabel(person) }}
                        </button>
                    </div>
                </div>
                <!-- Add more people -->
            </div>
            <div class="show-more-container">
                <button class="show-more-btn" @click="redirectTo('/people')">Show more</button>
            </div>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
import { mapState } from 'vuex';
export default{
    name: 'Search',
    data() {
        return {
            isInputFocused: false,
            users: [],
            isHovered: [],
        };
    },
    computed: {
        ...mapState(['user']),
        followButtonLabel() {
            return (person) => {
                if (this.isHovered[person.UserID] && person.isFollowedByMe) {
                    return 'Unfollow';
                } else if (person.isFollowedByMe) {
                    return 'Following';
                } else {
                    return 'Follow';
                }
            };
        },
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
        redirectTo(where) {
            this.$router.push(where);
        },
        openProfile(tag){
            const NoSymbolTag = tag.replace(/^@/, '');
            this.$router.push('/profile/' + NoSymbolTag);
            console.log(tag);
        },
        toggleFollowUnfollow(userID) {
            const user = this.users.find((t) => t.UserID === userID);
            if (user.isFollowedByMe) {
                this.handleUnfollow(userID);
            } else {
                this.handleFollow(userID);
            }
        },
        async handleFollow(userID) {
            try {
                const response = await this.$axios.post(`/api/follow/${userID}`);
                console.log('Follow Response:', response);
                if (response.status === 200) {
                    const user = this.users.find((t) => t.UserID === userID);
                    user.isFollowedByMe = true;
                }
            } catch (error) {
                console.error('Error following the user:', error);
            }
        },

        async handleUnfollow(userID) {
            try {
                const response = await this.$axios.post(`/api/unfollow/${userID}`);
                console.log('Unfollow Response:', response);
                if (response.status === 200) {
                    const user = this.users.find((t) => t.UserID === userID);
                    user.isFollowedByMe = false;
                }
            } catch (error) {
                console.error('Error unfollowing the user:', error);
            }
        },
    },
    async mounted() {
        await this.$store.dispatch('initializeApp');
        this.$axios.get('/api/topFollowedUsers')
        .then(response => {
            this.users = response.data;
        })
        .catch(error => {
            console.error(error);
        });
    }, 

}
</script>
<style lang="scss" scoped>
.search-container{
    padding-bottom:178px;
}
.who-to-follow{
    position:sticky;
    top:80px;
}
</style>