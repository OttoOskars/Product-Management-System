<template>
    <div class="navbar-container">
      <nav>
        <ul>
            <li class="twitter-logo">
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
        </ul>

        <div>
            <button class="tweet-btn" @click="openTweetWindow">Tweet</button>
        </div>

        <div class="profile-info">
            <img src="https://cdn.pixabay.com/photo/2012/04/26/19/43/profile-42914_1280.png" alt="" class="profile-img" width="35" height="35">
            <div class="user-info">
                <p class="username">test</p>
                <p class="usertag">@test</p>
            </div>
            <div class="options-icon">
                <ion-icon name="ellipsis-horizontal"></ion-icon>
            </div>
        </div>
      </nav>
    </div>
</template>
  
<script>
  export default {
    name: 'NavBar',
  };
</script>
  
<style lang="scss" scoped>

  .navbar-container {
    background-color: black;
    height: 100%;
  }
  
  nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
    /* Change the following line to make the content vertical */
    flex-direction: column;
  }
  
  nav li {
    margin: 10px 10px;
  }
  
  nav a {
    text-decoration: none;
    color: white;
  }

  .twitter-logo {
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
    font-size: 20px;
  }

  .nav-item:hover {
    background-color: rgb(22, 22, 22);
  }

  .tweet-btn {
    width: 80%;
    align-items: center;
    background:#1d9bf0;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 50px;
    margin-left: 20px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: bold;
    border: none;
    justify-content: center; /* Center the links horizontally */
  }

  .tweet-btn:hover {
    background-color:#1a7fc3;
  }

  .profile-info {
    width: 80%;
    display: flex;
    justify-content: center; /* Center the links horizontally */
    align-items: center;
    padding: 10px;
    border-radius: 50px;
    font-size: 16px;
    margin-top: 130px;
    margin-left: 10px;
    height: 50px;
    background-color: #262626;
    color: white;
    cursor: pointer;
    }

    .profile-info:hover {
        background-color: #333333;
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
        margin-bottom: -10px;
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
  
  @media (max-width: 767px) {
    .navbar-container {
        display: block; /* Make it a block element to cover the entire width */
        width: 100%; /* Set it to 100% width to cover the entire width */
        background-color: black; /* Set background color to match the bar */
        position: fixed; /* Position it at the bottom */
        bottom: 0; /* Stick it to the bottom */
        left: 0; /* Position it at the left side */
        height: auto;
    }

    nav ul {
        flex-direction: row; /* Display the navigation links horizontally */
        justify-content: center; /* Center the links horizontally */
    }

    .item-link {
        display: none; /* Hide the text on small screens */
    }

    .twitter-logo {
        margin-top: 10px;
    }

    .tweet-btn {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 90%;
        justify-content: center; /* Center the links horizontally */
    }

    .profile-info {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 90%;
        justify-content: center; /* Center the links horizontally */
    }
  }

  @media (min-width: 300px) and (max-width: 767px) {
  nav ul {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center both rows of icons along the horizontal axis */
  }

  .nav-item, .twitter-logo {
    flex: 1;
    display: flex;
    flex-direction: column;
    text-align: center; /* Center the text under the icons */
  }

  .item-link {
    flex: 0; /* Prevent text from affecting icon centering */
  }

  .tweet-btn {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 90%;
        justify-content: center; /* Center the links horizontally */
    }

  .profile-info {
        margin-top: 10px;
        margin-bottom: 10px;
        width: 90%;
        justify-content: center; /* Center the links horizontally */
    }
}
</style>  