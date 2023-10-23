<template>
  <div class="login-container">
    <div class="left-side">
      <ion-icon name="logo-yahoo" class="y-logo1"></ion-icon>
    </div>
    <div class="right-side">
      <div class="sign-container">
        <div class="logo-container">
          <ion-icon name="logo-yahoo" class="y-logo2"></ion-icon>
        </div>
        <p class="title-welcome">Welcome</p>
        <div class="sign-up-container">
          <p class="title-join">Join today.</p>
          <div class="sign-up-button-container">
            <button  class="sign-up-btn-google" @click="toggleShowAccount"><span><ion-icon class="google-logo" name="logo-google"></ion-icon></span>Sign up with Google</button>
            <button class="sign-up-btn-apple" @click="toggleShowAccount"><span><ion-icon class="apple-logo" name="logo-apple"></ion-icon></span>Sign up with Apple</button>
          </div>
          <div class="line">
            <div class="left"></div>
            <span class="text">or</span>
            <div class="right"></div>
          </div>
          <button class="create-account-btn" @click="toggleShowAccount">Create account</button>
        </div>
        <div class="sign-in-container">
          <p class="title-already">Already have an account?</p>
          <button class="sign-in-btn" @click="() => TogglePopup('SignInTrigger')">Sign in</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Sign In 1 popup -->
  <Popup v-if="popupTriggers.SignInTrigger" :TogglePopup="() => TogglePopup('SignInTrigger')">
    <div class="Sign-Pop-Up">
      <h1 class="title">Sign in to Twitter</h1>
      <div>
        <div class="input-wrap">
          <input autocomplete="off" type="text" id="sign-in-email" class="SignInput" v-model="email" required :class="{ 'invalid-email': !isEmailValid.value }">
          <label for="sign-in-email">Email</label>
        </div>
        <div v-if ="emailError" class="warning-1">{{ emailError }}</div>
      </div>
      <button class="FormButton" @click="() => validateEmail()" :disabled="isButtonDisabled2">Next</button>
      <p style="color:#434343" class="text">Don't have an account? <button class="sign-link-button" @click="toggleShowAccount">Sign up</button></p>
    </div>
  </Popup>

    <!-- Sign In 2 popup -->
  <Popup v-if="popupTriggers.SignIn2Trigger" :TogglePopup="() => TogglePopup('SignIn2Trigger')">
    <div class="Sign-Pop-Up">
      <h1 class="title">Password</h1>
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
        <button class="forgot-password" @click="openResetPasswordPopup">Forgot Password?</button>
      </div>
      <button type="button" class="FormButton" @click="loginUser($event)" :disabled="isButtonDisabled3">Log in</button>
      <p style="color:#434343" class="text">Don't have an account? <button class="sign-link-button" @click="toggleShowAccount">Sign up</button></p>
    </div>
  </Popup>

  <Popup v-if="popupTriggers.ResetPasswordTrigger" :TogglePopup="() => TogglePopup('ResetPasswordTrigger')">
    <div class="Sign-Pop-Up">
      <h1 class="title">Reset Password</h1>
      <div>
        <div class="input-wrap">
          <input type="password" v-model="newPassword" class="SignInput" required>
          <label for="sign-in-pass">New password</label>
        </div>
        <div v-if="newPasswordError" class="warning-1">Password must be at least 8 characters long.</div>
      </div>

      <div class="input-wrap">
        <input type="password" v-model="confirmPassword" class="SignInput" required>
        <label for="sign-in-pass">Confirm password</label>
      </div>
      <div v-if="passwordMismatch" class="warning-1">Passwords do not match.</div>
      <button type="button" class="FormButton" @click="resetPassword" :disabled="isButtonDisabled">Reset Password</button>
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
  computed: {
    isButtonDisabled() {
      return !(this.newPassword.length > 0 && this.confirmPassword.length > 0);
    },
    isButtonDisabled2() {
      return !(this.email.length > 0);
    },
    isButtonDisabled3() {
      return !(this.password.length > 0);
    },
  },
  setup () {
    const router = useRouter();
    const store = useStore();
    const errorLogin = ref(null);
    const emailError = ref(null);
    const password = ref('');
    const email = ref('');
    const newPassword = ref('');
    const confirmPassword = ref('');
    const isEmailValid = ref(true);
    const newPasswordError = ref(false);
    const passwordMismatch = ref(false);
    const popupTriggers = ref({
      SignInTrigger: false,
      SignIn2Trigger: false,
      ResetPasswordTrigger: false,
    });

    if (store.state.isLoggedIn) {
      router.push('/home2');
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
        newPassword.value = '';
        confirmPassword.value = '';
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
            router.push('/home2');
          }
        } catch (error) {
          errorLogin.value = 'Invalid password.';
          setTimeout(() => { errorLogin.value = null; }, 3000);
          console.error(error);
        }
      }
    };

    const openResetPasswordPopup = () => {
      popupTriggers.value.SignIn2Trigger = false;
      popupTriggers.value.ResetPasswordTrigger = true;
    };

    const resetPassword = async () => {
      // client-side validation to check if the new password and confirm password match
      if (newPassword.value.length >= 8) {
        newPasswordError.value = false;

        if (newPassword.value === confirmPassword.value) {
          passwordMismatch.value = false;

          // an API call to reset the password
          try {
            const response = await axios.post('/api/reset-password', {
              email: email.value,
              newPassword: newPassword.value,
            });

            const data = response.data;

            if (data.success) {
              //
            } else {
              // any other error conditions
              popupTriggers.value.ResetPasswordTrigger = false;
              popupTriggers.value.SignIn2Trigger = true;
              password.value='';
            }
          } catch (error) {
            console.error(error);
          }
        } else {
          passwordMismatch.value = true;
          setTimeout(() => {
            passwordMismatch.value = false;
          }, 3000);
        }
      } else {
        newPasswordError.value = true;
        setTimeout(() => {
          newPasswordError.value = false;
        }, 3000);
      }
    };

		return {
      Popup,
			popupTriggers,
			TogglePopup,
      email,
      password,
      newPassword,
      confirmPassword,
      isEmailValid,
      validateEmail,
      loginUser,
      resetPassword,
      errorLogin,
      emailError,
      newPasswordError,
      passwordMismatch,
      openResetPasswordPopup,
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
.login-container{
  position:fixed;
  top:0;
  bottom:0;
  left:0;
  right:0;
  display:flex;
  flex-direction: row;
  box-sizing: border-box;
  padding:80px 0px;

  color:white;
  .left-side{
    width:55%;
    height:100%;
    display:flex;
    align-items: center;
    justify-content: center;
    .y-logo1{
      font-size:400px;
    }
  }
  .right-side{
    width:45%;
    height:100%;
    display:flex;
    flex-direction: column;

    .sign-container{
      display:flex;
      flex-direction: column;
      justify-content: center;
      width:400px;
      height:100%;
      .title-welcome{
        font-size:80px;
        font-weight:600;
        margin:0;
      }
      .sign-up-container{
        display:flex;
        flex-direction: column;
        gap:10px;
        padding:30px 0px;
        .title-join{
          font-size:40px;
          font-weight:600;
          margin:0px;
          padding-bottom:20px;
        }
        .sign-up-button-container{
          display:flex;
          flex-direction:column;
          gap:15px;
          .sign-up-btn-google, .sign-up-btn-apple{
            width:100%;
            height:45px;
            border-radius: 50px;
            border:none;
            background-color: white;
            display:flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap:5px;
            font-size:16px;
            font-weight:bold;
            transition:0.3s;
            cursor:pointer;
            &:hover{
              background-color: rgb(205, 205, 205);
            }
            span{
              font-size:25px;
            }
          }
          .sign-up-btn-google{
            span{
              padding-top:5px;
            }
          }
          .sign-up-btn-apple{
            span{
              padding-top:2px;
            }
          }
        }
        .line{
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
          color: lightgray;
          .left, .right{
            flex: 1;
            height: 1px;
            background-color: lightgray;
          }
          .text{
            font-size: 18px;
            padding:0 10px;
          }
        }
        .create-account-btn{
          width:100%;
          height:45px;
          border-radius: 50px;
          border:none;
          background-color: #1da1f2;;
          color:white;
          display:flex;
          flex-direction: row;
          justify-content: center;
          align-items: center;
          gap:5px;
          font-size:16px;
          font-weight:bold;
          transition:0.3s;
          cursor:pointer;
          &:hover{
            background-color: #2394db;;
          }
        }
      }
      .sign-in-container{
        display:flex;
        flex-direction: column;
        .title-already{
          font-size:20px;
          font-weight: 600;
        }
        .sign-in-btn{
          width:100%;
          height:45px;
          border-radius: 50px;
          border:solid 2px #1da1f2;;
          background-color: black;;
          color:white;
          display:flex;
          flex-direction: row;
          justify-content: center;
          align-items: center;
          gap:5px;
          font-size:16px;
          font-weight:bold;
          transition:0.3s;
          cursor:pointer;
          &:hover{
            background-color: #171717;
          }
        }
      }
    }
  }
}

.Sign-Pop-Up{
  display:flex;
  flex-direction:column;
  justify-content: center;
  width:500px;
  padding:60px 50px;
  gap:20px;
  margin-top:10px;
  box-sizing: border-box;
  .title{
    color:white;
    font-size:30px;
    font-weight:600;
    margin:0;
  }
  .disabled-input{
    background-color:rgba(34, 34, 34,0.4);
    border:none;
  }
  .input-wrap{
    border: none;
    border-radius:6px;
    font-family: Arial, sans-serif;
    position:relative;
    width:auto;
    height: 60px;
    box-sizing: border-box;
    display:flex;
    .SignInput{
      box-sizing:border-box;
      border: 1px solid #434343;
      color:#ffffff;
      padding: 20px 13px 5px 13px;
      outline:none;
      background: none;
      position:relative;
      display:flex;
      width:100%;
      height:100%;
      border-radius:6px;
      font-size:18px;
      transition: 0.3s all;
      &:disabled{
        color:#808080;
      }
      &:focus{
        border:1px solid #1da1f2;
      }
    }
    label{
      font-size:18px;
      color:#434343;
      padding:5px;
      position:absolute;
      top:15px;
      left:5px;
      pointer-events: none;
      transition: 0.3s all;
    }
    .SignInput:focus+label,
    .SignInput:disabled+label,
    .SignInput:valid+label{
      font-size:16px;
      top:5px;
      left:7px;
      padding:0 5px 0 5px;
    }
    .SignInput:focus+label{
      color:#1da1f2;
    }
  }
  .FormButton{
    background-color: white;
    border: none;
    border-radius: 50px;
    color: #333;
    height:40px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    margin-bottom:10px;
    font-size: 16px;
    font-weight:bold;
    transition:all 0.3s;
    cursor: pointer;
    &:hover{
      background-color: rgb(205, 205, 205);
    }
  }
  .FormButton:disabled {
    color: gray;
  }
  .FormButton:disabled:hover {
    background-color: white;
  }
  .text{
    font-size:13px;
    .sign-link-button{
      border:none;
      background:none;
      color:#1da1f2;
      padding:0;
      font-size:13px;
      transition: all 0.3s;
      cursor:pointer;
      &:hover{
        color:#1589d2;
        text-decoration-line: underline;
      }
    }
  }
  .forgot-password{
    border:none;
    background:none;
    color:#1da1f2;
    padding:0;
    font-size:13px;
    transition: all 0.3s;
    cursor:pointer;
    &:hover{
      color:#1589d2;
      text-decoration-line: underline;
    }
  }
}
// ========================================================================================
@media (min-width: 450px) {
  .y-logo2{
    display:none;
  }
}
@media (max-width: 1000px) {
  .login-container{
    .y-logo1{
      display:none;
    }
    .left-side{
      display:none;
    }
    .right-side{
      width:100%;
      align-items:center;
    }
  }
}
@media (max-width: 500px) {
  .Sign-Pop-Up{
    display:flex;
    flex-direction:column;
    justify-content: center;
    width:100%;
    padding:60px 50px;
    gap:20px;
    margin-top:10px;
    box-sizing: border-box;
  }
}
@media (max-width: 450px) {
  .login-container{
    padding:0px 10px;
    .y-logo1{
      display:none;
    }
    .y-logo2{
      display:block;
      font-size:50px;
    }
    .left-side{
      display:none;
    }
    .right-side{
      text-align: center;
      .sign-container{
        width:100%;
        .logo-container{
          display:flex;
          justify-content: center;
          align-items: center;
        }
        .title-welcome{
          font-size:40px;
          font-weight:600;
          margin:0;
        }
        .sign-up-container{
          gap:5px;
          padding:15px 0px;
          .title-join{
            font-size:30px;
            font-weight:600;
            margin:0px;
            padding-bottom:10px;
          }
          .sign-up-button-container{
            gap:10px;
            .sign-up-btn-google, .sign-up-btn-apple{
              width:100%;
              height:30px;
              border-radius: 50px;
              gap:5px;
              font-size:13px;
              font-weight:bold;
              span{
                font-size:20px;
              }
            }
            .sign-up-btn-google{
              span{
                padding-top:5px;
              }
            }
            .sign-up-btn-apple{
              span{
                padding-top:2px;
              }
            }
          }
          .line{
            .left, .right{
              flex: 1;
              height: 1px;
            }
            .text{
              font-size: 12px;
              padding:0 5px;
            }
          }
          .create-account-btn{
            width:100%;
            height:30px;
            border-radius: 50px;
            gap:5px;
            font-size:13px;
            font-weight:bold;
          }
        }
        .sign-in-container{
          .title-already{
            font-size:15px;
            font-weight: 600;
            margin:0;
            padding:10px 0;
          }
          .sign-in-btn{
            width:100%;
            height:30px;
            border-radius: 50px;
            gap:5px;
            font-size:13px;
            font-weight:bold;
          }
        }
      }
    }
  }
.Sign-Pop-Up{
  width:100%;
  padding:40px 15px;
  gap:10px;
  .title{
      font-size:20px;
      font-weight:600;
    }
    .input-wrap{
      border-radius:6px;
      height: 35px;
      .SignInput{
        padding: 13px 13px 1px 7px;
        width:100%;
        height:100%;
        font-size:13px;
      }
      label{
        font-size:13px;
        padding:5px;
        top:5px;
        left:2px;
      }
      .SignInput:focus+label,
      .SignInput:disabled+label,
      .SignInput:valid+label{
        font-size:10px;
        top:4px;
        left:2px;
        padding:0 5px 0 5px;
      }
    }
    .FormButton{
      border-radius: 50px;
      height:30px;
      width: 100%;
      margin-bottom:10px;
      font-size: 12px;
      font-weight:bold;
    }
    .text{
      font-size:10px;
      .sign-link-button{
        padding:0;
        font-size:10px;
      }
    }
  }
}
</style>
