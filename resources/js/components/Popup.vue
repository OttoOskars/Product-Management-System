<template>
    <div class="pop-up">
        <div class="pop-up-inner">
            <ion-icon name="logo-twitter" class="pop-up-icon"></ion-icon>
            <div class="pop-up-close-div">
                <button class="pop-up-close" @click="TogglePopup()"><ion-icon name="close" class="close"></ion-icon></button>
            </div>
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Popup',
    props: ['TogglePopup'],
}
</script>
<style lang="scss" scoped>
.pop-up {
    font-family: Arial, sans-serif;
    position:fixed;
    top:0;
    bottom:0;
    left:0;
    right:0;
    z-index: 99;
    background:rgba(29, 161, 242, 0.1);
    display:flex;
    justify-content:center;
    align-items:center;
    .pop-up-inner {
        background:#000000;
        padding:20px 70px;
        border-radius:20px;
        display:flex;
        flex-direction:column;
        gap:40px;
        justify-content: center;
        position: relative;
        .pop-up-close-div {
            position: absolute;
            top:10px;
            left:10px;
        }
        .pop-up-close {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #000;
            display:flex;
            justify-content: center;
            align-items: center;
            border: none;
            cursor: pointer;
        }
        .pop-up-close:hover{
            background-color: #202020;
        }
        .pop-up-icon{
            color:white;
            position:absolute;
            font-size:30px;
            top:5px;
            left:50%;
            transform: translate(-50%);
        }
    }
}
.close{
    font-size: 20px;
    color:white;
}
@media (max-width: 912px) {
    .pop-up{
        .pop-up-inner{
            margin-bottom: 700px;
        }
    }
}

@media (max-width: 820px) {
    .pop-up{
        .pop-up-inner{
            margin-bottom: 470px;
        }
    }
}

@media (max-width: 768px) {
    .pop-up{
        .pop-up-inner{
            margin-bottom: 50px;
        }
    }
}

@media (max-width: 570px) {
    .pop-up{
        .pop-up-inner{
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 270px;
            .pop-up-icon{
                font-size: 29px;
            }
        }
    }
}

@media (max-width: 540px) {
    .pop-up{
        .pop-up-inner{
            margin-bottom: 130px;
        }
    }
}

@media (max-width: 412px) {
    .pop-up{
        .pop-up-inner{
            margin-bottom: 280px;
        }
    }
}

@media (max-width: 410px) {
    .pop-up{
        .pop-up-inner{
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 280px;
            .pop-up-icon{
                font-size: 27px;
            }
        }
    }
}

@media (max-width: 380px) {
    .pop-up{
        .pop-up-inner{
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 210px;
            .pop-up-icon{
                font-size: 25px;
            }
        }
    }
}

@media (max-width: 350px) {
    .pop-up{
        .pop-up-inner{
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 180px;
            .pop-up-icon{
                font-size: 23px;
            }
        }
    }
}

@media (max-width: 340px) {
    .pop-up{
        .pop-up-inner{
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 200px;
            .pop-up-icon{
                font-size: 22px;
            }
        }
    }
}

@media (max-width: 325px) {
    .pop-up{
        .pop-up-inner{
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 220px;
            .pop-up-icon{
                font-size: 20px;
            }
        }
    }
}
</style>