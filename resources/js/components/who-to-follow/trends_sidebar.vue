<!-- <template>
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
        <div class="trends">
            <div class="title">Trending Latvia</div>
            <div class="trend-container">
                <div class="trend">
                    <ul id="trendsList"></ul>
                </div>
            </div>
            <div class="show-more-container">
                <button class="show-more-btn" @click="redirectTo('/trends')">Show more</button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import { ref } from 'vue';
import axios from 'axios';
export default{
    name: 'Search',
    data() {
        return {
            isInputFocused: false,
        };
    },
    setup () {
        const search = ref('');
        const clearSearch = () => {
            search.value = '';
        }
        return {
            search,
            clearSearch,
            trends: [],

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

        fetchData() {
            fetch('https://api.twitter.com/1.1/trends/place.json')
            .then(response => response.json())
            .then(data => {
                const trendsList = document.getElementById('trendsList');
                data.forEach(trend => {
                    const listItem = document.createElement('li');
                    listItem.textContent = trend.name;
                    trendsList.appendChild(listItem);
        });
      });
  }
},

mounted() {
  this.fetchData();
}


}


</script>
<style lang="scss" scoped>
.search-container {
    padding-bottom:178px;
}
</style> -->
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
        <div class="trends">
            <div class="title">Trending Latvia</div>
            <div class="trend-container">
                <div class="trend"  v-for="i in trends" :key="i">
                    <p class="trend-rank">1. News. Trending</p>
                    <p class="trend-name">Skolā bumba</p>
                    <p class="trend-posts">1232 posts</p>
                </div>
            </div>
            <div class="show-more-container">
                <button class="show-more-btn" @click="redirectTo('/trends')">Show more</button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import { ref } from 'vue';
export default{
    name: 'Search',
    data() {
        return {
            isInputFocused: false,
            trends: 5,
        };
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
        }
    },

}
</script>
<style lang="scss" scoped>
.search-container {
    padding-bottom:178px;
}
</style>