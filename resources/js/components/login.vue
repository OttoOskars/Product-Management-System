<template>
  <!-- Twitter logo -->
  <div class="container">
    <ion-icon name="logo-twitter" class="twitter-logo"></ion-icon>
  </div>

    <!-- Welcome text -->
  <div>
    <div>
      <h1 class="login-text-1">Welcome</h1>
    </div>
    <div>
      <h2 class="login-text-2">Join today</h2>
    </div>
    <div>

      <!-- Google x Apple sign up buttons -->
      <div class="container">
        <button  class="sign-up-btn" @click="toggleShowAccount"> <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg">Sign up with Google</button>
      </div>
      <div class="container">
        <button class="sign-up-btn-apple" @click="toggleShowAccount"> <span><ion-icon class="apple-logo" name="logo-apple"></ion-icon></span>Sign up with Apple</button>
      </div>

      <!-- Create account -->
      <div class="line">
        <div class="left"></div>
        <span class="text">or</span>
        <div class="right"></div>
      </div>
      <div class="container">
        <button class="create-account" @click="toggleShowAccount">Create account</button>
      </div>
      <div class="container">
        <p class="text">Already have an account?</p>
      </div>
      <div class="container">
        <button class="sign-in" @click="() => TogglePopup('SignInTrigger')">Sign in</button>
      </div>
    </div>
  </div>

  <!-- Sign In 1 popup -->
  <Popup v-if="popupTriggers.SignInTrigger" :TogglePopup="() => TogglePopup('SignInTrigger')">
    <div class="Sign-Pop-Up">
      <h1 class="Bold-text">Sign in to Twitter</h1>
      <div>
        <div class="input-wrap">
          <input autocomplete="off" type="text" id="sign-in-email" class="SignInput" v-model="email" required :class="{ 'invalid-email': !isEmailValid.value }">
          <label for="sign-in-email">Email</label>
        </div>
        <div v-if ="emailError" class="warning-1">{{ emailError }}</div>
      </div>
      <button class="FormButton" @click="() => validateEmail()">Next</button>
      <p style="color:#434343" class="p">Don't have an account? <button class="sign-link-button" @click="toggleShowAccount">Sign up</button></p>
    </div>
  </Popup>

    <!-- Sign In 2 popup -->
  <Popup v-if="popupTriggers.SignIn2Trigger" :TogglePopup="() => TogglePopup('SignIn2Trigger')">
    <div class="Sign-Pop-Up">
      <h1 class="Bold-text">Password</h1>
      <div class="input-wrap disabled-input">
        <input type="text" class="SignInput" id="sign-in-email-disabled" :value="email" required disabled>
        <label for="sign-in-email-disabled">Email</label>
      </div>
      <div>
        <div class="input-wrap">
          <input
            autocomplete="off"
            type="password"
            id="sign-in-pass"
            v-model="password"
            class="SignInput"
            required
          />
          <label for="sign-in-pass">Password</label>
        </div>
        <div v-if ="errorLogin" class="warning-1">{{ errorLogin }}</div>
      </div>
      <button type="button" class="FormButton" @click="loginUser($event)">Log in</button>
      <p style="color:#434343" class="p">Don't have an account? <button class="sign-link-button" @click="toggleShowAccount">Sign up</button></p>
    </div>
  </Popup>
  <create-account v-if="showCreateAccount" @close-page="toggleShowAccount" />
</template>
<script>
import { ref } from 'vue';
import CreateAccount from './create_account.vue';
import Popup from './Popup.vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import axios from 'axios';
export default {
  name: 'Login',
  components: {
    CreateAccount,
    Popup,
  },
  data() {
    return {
      emails: '',
      passwords: '',
      errorLogin:null,
      emailError: null,

    }
  },
  setup () {
    const router = useRouter();
    const store = useStore();
    const errorLogin = ref(null);
    const emailError = ref(null);
    const password = ref('');
    const email = ref('');
    const isEmailValid = ref(true);
    const popupTriggers = ref({
      SignInTrigger: false,
      SignIn2Trigger: false,
    });
    
    if (store.state.isLoggedIn) {
      router.push('/home');
    }

    const validateEmail = async () => {
      email.value = email.value.toLowerCase();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      isEmailValid.value = emailRegex.test(email.value);

      if (isEmailValid.value) {
        try {
          const response = await axios.post('/api/check-email', {
            Email: email.value,
          });

          const data = response.data;

          if (data.success) {
            popupTriggers.value.SignInTrigger = false;
            popupTriggers.value.SignIn2Trigger = true;
            emailError.value = null;
            
          } else {
            emailError.value = 'Email is not registered.';
            setTimeout(() => { emailError.value = null; }, 3000);
          }
        } catch (error) {
          emailError.value = null;
          //setTimeout(() => { emailError.value = null; }, 10000);
        }
      } else{
        emailError.value = 'Please enter a valid email.';
        setTimeout(() => { emailError.value = null; }, 3000);
      }
    };
		const TogglePopup = (trigger) => {
			popupTriggers.value[trigger] = !popupTriggers.value[trigger]
      if (!popupTriggers.value[trigger]) {
        email.value='';
        password.value='';
        isEmailValid.value=true;
      }
		}
    const loginUser = async (event) => {
      event.preventDefault();
      console.log('Login button clicked');
      if (password.value.length > 0) {
        try {
          const loginSuccess = await store.dispatch('login', {
            Email: email.value,
            Password: password.value,
          });

          console.log('Login success:', loginSuccess);

          if (loginSuccess) {
            router.push('/home');
          }
        } catch (error) {
          errorLogin.value = 'Invalid password.';
          setTimeout(() => { errorLogin.value = null; }, 3000);
          console.error(error);
        }
      }
    };
		return {
      Popup,
			popupTriggers,
			TogglePopup,
      email,
      password,
      isEmailValid,
      validateEmail,
      loginUser,
      errorLogin,
      emailError,
		}
	},
  data: () => ({
    showCreateAccount: false,
  }),
  methods: {
    toggleShowAccount(){
        this.showCreateAccount = !this.showCreateAccount
        this.popupTriggers.SignInTrigger = false
        this.popupTriggers.SignIn2Trigger = false
        this.email=''
        this.password=''
    },
  },

};
</script>
<style lang="scss" scoped>
.warning-1 {
    color: red;
    font-size: 12px;
}
.apple-logo{
  font-size:27.5px;
}
.twitter-logo{
  color:#1da1f2;
  font-size:125px;
}
.login-text-1, .login-text-2 {
    text-align: center;
    color: white;
    font-family: Arial, Helvetica, sans-serif;
}
.text {
    font-family: Arial, Helvetica, sans-serif;
    padding: 0 10px;
    color: white;
}

.sign-up-btn-apple{
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
  border: none;
  border-radius: 50px;
  color: #333;
  padding: 6px 20px;
  text-align: center;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  margin: 4px 2px;
  margin-left: auto;
  margin-right: auto;
  width: 400px;
  cursor: pointer;
  span{margin-right: 10px;}
  img{margin-right: 10px;}
  transition:all ease 0.2s;
}
.sign-up-btn-apple:hover {
  background-color: rgb(223, 223, 223);
}
.sign-up-btn {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
  border: none;
  border-radius: 50px;
  color: #333;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  margin: 4px 2px;
  margin-left: auto;
  margin-right: auto;
  width: 400px;
  cursor: pointer;
  span{margin-right: 10px;}
  img{margin-right: 10px;}
  transition:all ease 0.2s;
}
.sign-up-btn:hover{
  background-color: rgb(223, 223, 223);
}
.container {
    text-align: center;
}
.line {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 400px;
    margin: 10px auto;
    .left, .right {
        flex: 1;
        height: 1px;
        background-color: lightgray;
    }
}
.create-account {
  font-family: Arial, Helvetica, sans-serif;
  background-color: blue;
  border: none;
  border-radius: 50px;
  color: white;
  font-weight: bold;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  margin-left: auto;
  margin-right: auto;
  width: 400px;
  cursor: pointer;
  transition:all ease 0.2s;
}
.create-account:hover {
    background-color: rgb(7, 7, 222);
}

.sign-in {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
  border: 1px solid blue;
  border-radius: 50px;
  color: blue;
  font-weight: bold;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  margin-left: auto;
  margin-right: auto;
  width: 400px;
  cursor: pointer;
  transition:all ease 0.2s;
}
.sign-in:hover {
    background-color: rgb(25, 26, 27);
}

.FormButton{
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
  border: none;
  border-radius: 50px;
  color: #333;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  width: 100%;
  margin-bottom:10px;
  font-weight:bold;
  cursor: pointer;
  span{margin-right: 10px;}
  transition:all ease 0.2s;
}
.FormButton:hover{
  background-color: rgb(205, 205, 205);
}

.Sign-Pop-Up{
  display:flex;
  flex-direction:column;
  justify-content: center;
  width:400px;
  gap:15px;
  margin-top:10px;
}
.SignInput{
  border:none;
  color:#ffffff;
  padding: 16px 12px;
  font-size:medium;
  outline:none;
  background: none;
  position:relative;
  top:8px;
  width:90%;
}
.SignInput:disabled{
  color:#434343;
}

.input-wrap{
  border: 1px solid #434343;
  border-radius:6px;
  font-family: Arial, sans-serif;
  position:relative;
  width:auto;
  height: auto;
  label{
    font-size:medium;
    color:#434343;
    padding:5px;
    position:absolute;
    top:11px;
    left:5px;
    pointer-events: none;
    transition: 0.3s ease all;
  }
}
.disabled-input{
  background-color:rgba(34, 34, 34,0.4);
  border:none;
}

.SignInput:focus+label,
.SignInput:disabled+label,
.SignInput:valid+label{
  font-size:small;
  top:3px;
  left:7px;
  padding:0 5px 0 5px;
}
.p{
  font-size: 13px;
}
.sign-link-button{
  border:none;
  background:none;
  color:#1da1f2;
  padding:0;
  cursor:pointer;
}
.sign-link-button:hover{
    color:#1589d2;
    text-decoration-line: underline;
}
.Bold-text{
  font-weight: bold;
  color:white;
}
.DateofBirth{
  margin-bottom:20px;
}

@media (max-width: 570px) {
  .twitter-logo {
    font-size: 100px;
  }
  .login-text-1 {
    font-size: 30px;
  }
  .login-text-2 {
    font-size: 25px;
  }
  .sign-up-btn-apple, .sign-up-btn, .create-account, .sign-in, .line {
    width: 90%;
  }
  .sign-up-btn {
    img {
      height: 23px;
    }
  }
  .apple-logo {
    font-size: 25px;
  }
  .sign-up-btn-apple, .sign-up-btn {
    height: 40px;
    font-size: 13px;
    padding: 10px;
  }
  .create-account, .sign-in {
    height: 35px;
    font-size: 13px;
    padding: 10px;
  }
  .text {
    font-size: 13px;
  }
  .Sign-Pop-Up {
    width: 100%;
    margin: 0 auto;
    padding: 10px;
  }
  .Bold-text {
    font-size: 22px;
  }
  .SignInput {
    font-size: 15px;
    top: 4px;
  }
  .FormButton {
    font-size: 14px;
    height: 30px;
  }
  .input-wrap {
    height: 44px;
    label {
      font-size: 16px;
      padding:5px;
      position:absolute;
      top:7px;
      left:5px;
    }
  }
  .SignInput:focus+label,
  .SignInput:disabled+label,
  .SignInput:valid+label{
    font-size:14px;
    top:3px;
    left:5px;
    padding:0 5px 0 5px;
  }
  .sign-link-button {
    font-size: 15px;
  }
  .p {
    font-size: 14px;
  }
  .warning-1 {
    font-size: 11px;
    margin-top: 3px;
  }
}

@media (max-width: 410px) {
  .twitter-logo {
    font-size: 90px;
  }
  .login-text-1 {
    font-size: 28px;
  }
  .login-text-2 {
    font-size: 23px;
  }
  .sign-up-btn-apple, .sign-up-btn, .create-account, .sign-in, .line {
    width: 90%;
  }
  .sign-up-btn {
    img {
      height: 21px;
    }
  }
  .apple-logo {
    font-size: 23px;
  }
  .sign-up-btn-apple, .sign-up-btn {
    height: 38px;
    font-size: 12px;
    padding: 9px;
  }
  .create-account, .sign-in {
    height: 33px;
    font-size: 12px;
    padding: 9px;
  }
  .text {
    font-size: 12px;
  }
  .Sign-Pop-Up {
    width: 100%;
    margin: 0 auto;
    padding: 9px;
  }
  .Bold-text {
    font-size: 21px;
  }
  .SignInput {
    font-size: 14px;
    top: 3px;
  }
  .FormButton {
    font-size: 13px;
    height: 28px;
  }
  .input-wrap {
    height: 41px;
    label {
      font-size: 15px;
      padding:5px;
      position:absolute;
      top:7px;
      left:5px;
    }
  }
  .SignInput:focus+label,
  .SignInput:disabled+label,
  .SignInput:valid+label{
    font-size:13px;
    top:3px;
    left:5px;
    padding:0 5px 0 5px;
  }
  .sign-link-button {
    font-size: 14px;
  }
  .p {
    font-size: 13px;
  }
  .warning-1 {
    font-size: 11px;
    margin-top: 3px;
  }
}

@media (max-width: 380px) {
  .twitter-logo {
    font-size: 80px;
  }
  .login-text-1 {
    font-size: 26px;
  }
  .login-text-2 {
    font-size: 21px;
  }
  .sign-up-btn-apple, .sign-up-btn, .create-account, .sign-in, .line {
    width: 90%;
  }
  .sign-up-btn {
    img {
      height: 19px;
    }
  }
  .apple-logo {
    font-size: 21px;
  }
  .sign-up-btn-apple, .sign-up-btn {
    height: 36px;
    font-size: 11px;
    padding: 8px;
  }
  .create-account, .sign-in {
    height: 31px;
    font-size: 11px;
    padding: 8px;
  }
  .text {
    font-size: 11px;
  }
  .Sign-Pop-Up {
    width: 100%;
    margin: 0 auto;
    padding: 8px;
  }
  .Bold-text {
    font-size: 20px;
  }
  .SignInput {
    font-size: 13px;
    top: 2px;
  }
  .FormButton {
    font-size: 12px;
    height: 26px;
  }
  .input-wrap {
    height: 38px;
    label {
      font-size: 14px;
      padding:5px;
      position:absolute;
      top:7px;
      left:5px;
    }
  }
  .SignInput:focus+label,
  .SignInput:disabled+label,
  .SignInput:valid+label{
    font-size:11px;
    top:2px;
    left:5px;
    padding:0 5px 0 5px;
  }
  .sign-link-button {
    font-size: 13px;
  }
  .p {
    font-size: 12px;
  }
  .warning-1 {
    font-size: 11px;
    margin-top: 3px;
  }
}

@media (max-width: 350px) {
  .twitter-logo {
    font-size: 70px;
  }
  .login-text-1 {
    font-size: 24px;
  }
  .login-text-2 {
    font-size: 19px;
  }
  .sign-up-btn-apple, .sign-up-btn, .create-account, .sign-in, .line {
    width: 90%;
  }
  .sign-up-btn {
    img {
      height: 17px;
    }
  }
  .apple-logo {
    font-size: 19px;
  }
  .sign-up-btn-apple, .sign-up-btn {
    height: 34px;
    font-size: 10px;
    padding: 7px;
  }
  .create-account, .sign-in {
    height: 29px;
    font-size: 10px;
    padding: 7px;
  }
  .text {
    font-size: 10px;
  }
  .Sign-Pop-Up {
    width: 100%;
    margin: 0 auto;
    padding: 7px;
  }
  .Bold-text {
    font-size: 19px;
  }
  .SignInput {
    font-size: 12px;
    top: 1px;
  }
  .FormButton {
    font-size: 11px;
    height: 24px;
  }
  .input-wrap {
    height: 35px;
    label {
      font-size: 13px;
      padding:5px;
      position:absolute;
      top:4px;
      left:5px;
    }
  }
  .SignInput:focus+label,
  .SignInput:disabled+label,
  .SignInput:valid+label{
    font-size:10px;
    top:4px;
    left:5px;
    padding:0 5px 0 5px;
  }
  .sign-link-button {
    font-size: 12px;
  }
  .p {
    font-size: 11px;
  }
  .warning-1 {
    font-size: 10px;
    margin-top: 3px;
  }
}

@media (max-width: 340px) {
  .twitter-logo {
    font-size: 65px;
  }
  .login-text-1 {
    font-size: 22px;
  }
  .login-text-2 {
    font-size: 17px;
  }
  .sign-up-btn-apple, .sign-up-btn, .create-account, .sign-in, .line {
    width: 90%;
  }
  .sign-up-btn {
    img {
      height: 16px;
    }
  }
  .apple-logo {
    font-size: 18px;
  }
  .sign-up-btn-apple, .sign-up-btn {
    height: 33px;
    font-size: 10px;
    padding: 7px;
  }
  .create-account, .sign-in {
    height: 28px;
    font-size: 10px;
    padding: 7px;
  }
  .text {
    font-size: 10px;
  }
  .Sign-Pop-Up {
    width: 100%;
    margin: 0 auto;
    padding: 7px;
  }
  .Bold-text {
    font-size: 19px;
  }
  .SignInput {
    font-size: 11px;
    top: 0px;
  }
  .FormButton {
    font-size: 11px;
    height: 23px;
  }
  .input-wrap {
    height: 32px;
    label {
      font-size: 12px;
      padding:5px;
      position:absolute;
      top:3px;
      left:5px;
    }
  }
  .SignInput:focus+label,
  .SignInput:disabled+label,
  .SignInput:valid+label{
    font-size:10px;
    top:3px;
    left:5px;
    padding:0 5px 0 5px;
  }
  .sign-link-button {
    font-size: 11px;
  }
  .p {
    font-size: 10px;
  }
  .warning-1 {
    font-size: 10px;
    margin-top: 3px;
  }
}

@media (max-width: 325px) {
  .twitter-logo {
    font-size: 60px;
  }
  .login-text-1 {
    font-size: 20px;
  }
  .login-text-2 {
    font-size: 15px;
  }
  .sign-up-btn-apple, .sign-up-btn, .create-account, .sign-in, .line {
    width: 90%;
  }
  .sign-up-btn {
    img {
      height: 15px;
    }
  }
  .apple-logo {
    font-size: 17px;
  }
  .sign-up-btn-apple, .sign-up-btn {
    height: 32px;
    font-size: 9px;
    padding: 6px;
  }
  .create-account, .sign-in {
    height: 27px;
    font-size: 9px;
    padding: 6px;
  }
  .text {
    font-size: 9px;
  }
  .Sign-Pop-Up {
    width: 100%;
    margin: 0 auto;
    padding: 6px;
  }
  .Bold-text {
    font-size: 18px;
  }
  .SignInput {
    font-size: 10px;
    top: 0px;
  }
  .FormButton {
    font-size: 10px;
    height: 23px;
  }
  .input-wrap {
    height: 30px;
    label {
      font-size: 12px;
      padding:5px;
      position:absolute;
      top:3px;
      left:5px;
    }
  }
  .SignInput:focus+label,
  .SignInput:disabled+label,
  .SignInput:valid+label{
    font-size:10px;
    top:3px;
    left:5px;
    padding:0 5px 0 5px;
  }
  .sign-link-button {
    font-size: 11px;
  }
  .p {
    font-size: 10px;
  }
  .warning-1 {
    font-size: 9px;
    margin-top: 3px;
  }
}
</style>