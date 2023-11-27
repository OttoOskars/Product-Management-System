<template>
    <div class="tweets-container">
        <div class="black-line"></div>
        <div class="top-bar">
            <button class="back-icon" @click="goBack">
                <ion-icon name="arrow-back-outline"></ion-icon>
            </button>
            <div class="title">Trends</div>
        </div>

        <div class="trend-container">
            <p class="title">Trends for you</p>
            <div class="trend"></div>
                <ul id="trendsList"></ul>
                <li></li>
            </div>
                <div class="more-icon">
                    <ion-icon name="ellipsis-horizontal"></ion-icon>
                </div>
    </div>
</template>

<script>
import axios from 'axios';
axios.get('https://api.twitter.com/1.1/trends/place.json', {
  params: {
    id: 23424977,
  },
  headers: {
    Authorization: '1'
  }

})
  .then(response => {
    const trends = response.data[0].trends;
    const trendsList = document.getElementById('trendsList');
    trends.forEach(trend => {
      const listItem = document.createElement('li');
      listItem.textContent = trend.name;
      trendsList.appendChild(listItem);
    });
  })
  .catch(error => {
    console.error('Error fetching world trends:', error);
  });

export default{

    name: 'Tweets',
    data(){
        return {
        }
    },


    mounted() {
    this.fetchData();
}
}
</script>
<style lang="scss" scoped>
.tweets-container{
    width:100%;
    height:auto;
    color:white;
}

.black-line{
    position:fixed;
    top:0;
    left:0;
    right:0;
    height:2px;
    z-index:8;
    background-color: black;
}

.top-bar{
    height:60px;
    width:100%;
    background-color:rgba($color: #000000, $alpha: 0.8);
    border-bottom:solid 1px #2F3336;
    position:sticky;
    top:0;
    z-index:9;
    box-sizing: border-box;
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    padding:0 10px;
}

.title{
    width:100%;
    height:28px;
    display:flex;
    align-items: center;
    justify-content: flex-start;
    box-sizing: border-box;
    padding-left:20px;
    font-weight: bold;
    font-size: 22px;
}
.trend-container{
    width:100%;
    height:auto;
    display:flex;
    flex-direction:column;
    box-sizing: border-box;
    border-bottom: 1px solid #2F3336;
    padding-top:0px;
    padding-bottom:100px;
    .trend{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:row;
        justify-content: space-between;
        align-items: center;
        box-sizing: border-box;
        padding:10px 20px;
        .more-icon{
            display:flex;
            align-items: center;
            justify-content: center;
            padding:15px;
            border-radius: 50%;
            background:none;
            color:#6A6F74;
            cursor:pointer;
            transition: all 0.3s;
        }
        .more-icon:hover{
            background-color: rgba($color: #1D9BF0, $alpha: 0.1);
            color:#1D9BF0;
        }
    }
    .trend-info{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:column;
        gap:6px;
        box-sizing: border-box;
        cursor:pointer;
        .trend-rank{
            color: #6e767d;
            font-size: 13px;
            margin:0;
        }
        .trend-name{
            color:white;
            font-weight: bold;
            font-size: 16px;
            margin:0;
        }
        .trend-posts{
            color: #6e767d;
            font-size: 13px;
            margin:0;
        }
    }
    .trend:hover{
        background-color: #080808;
    }
}

.back-icon{
    display:flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    width:40px;
    height:40px;
    border-radius: 50%;
    border:none;
    font-size:22px;
    background:none;
    color:white;
    cursor:pointer;
    transition: all 0.3s;
}
.back-icon:hover{
    background-color: rgba($color: #1a1a1a, $alpha: 1);
}

@media (min-width: 500px) {
    .user-img, .logo{
        display:none !important;
    }
}
@media (max-width: 500px) {
    .top-bar{
        height:35px;
        width:100%;
        .search-input {
            width: 100%;
            height: 80%;
            border-radius: 50px;
            padding-left:30px;
            border:  1px solid transparent;
            background-color: #202327;
            position: relative;
            color:white;
            font-size: 13px;
        }

        .search-icon {
            position: absolute;
            left: 30px;
            top: 50%;
            transform: translate(0, -50%);
            color: #71767B;
            font-size: 16px;
        }
    }

    .title{
        font-size:17px !important;
    }
    .title2{
        width:100%;
        box-sizing: border-box;
        height:70%;
    }
    .trend-container{
        width:100%;
        height:auto;
        display:flex;
        flex-direction:column;
        box-sizing: border-box;
        border-bottom: 1px solid #2F3336;
        padding-bottom:100px;
        .trend{
            width:100%;
            height:auto;
            display:flex;
            flex-direction:row;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
            padding:10px 20px;
            .more-icon{
                display:flex;
                align-items: center;
                justify-content: center;
                padding:10px;
                border-radius: 50%;
                background:none;
                color:#6A6F74;
                cursor:pointer;
                transition: all 0.3s;
            }
            .more-icon:hover{
                background-color: rgba($color: #1D9BF0, $alpha: 0.1);
                color:#1D9BF0;
            }
        }
        .trend-info{
            width:100%;
            height:auto;
            display:flex;
            flex-direction:column;
            gap:6px;
            box-sizing: border-box;
            cursor:pointer;
            .trend-rank{
                color: #6e767d;
                font-size: 11px;
                margin:0;
            }
            .trend-name{
                color:white;
                font-weight: bold;
                font-size: 13px;
                margin:0;
            }
            .trend-posts{
                color: #6e767d;
                font-size: 11px;
                margin:0;
            }
        }
    }

#trendsList {
    list-style-type: none;
    padding: 0;
    margin: 0;
    color: white;

}

}
</style>
