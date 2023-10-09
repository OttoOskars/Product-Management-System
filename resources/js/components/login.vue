<template>

  <div class="container">
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASsAAACoCAMAAACPKThEAAAAwFBMVEUAAAAdm/Adm+8cm/IemvIdnfMem+0fofkJAAAZne8fm+sdnfkdNEEemvUfmu4dn/cdVHgVLj4UN1AcWIMdaZ0gfbwdcaYdW4AZQFYJCQMICgsnebATKDQbS28mluASM0gtZo0YIywiic8eOEkiSWUOICwni8sVFhQVQmEdQlwgf7oubJQhY5IjjdQ0pvUuf7IYaaEwicMPFyMQGBsjRV0ikNcac68kUmwCDBQ5o+kcm/waMksUHCIrc6IkebkeT3HXmzN/AAAET0lEQVR4nO3ba1PbOBQG4OhyJEtaW7lSINQQF8JlE9pdSpd2ufz/f7VOmkDSRiYws1Emfh+GD8H2zOHMkXQsO40GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMDWSdqdbq+392H/IHYk2+6wK7Qncs5r0z9aPPJHrJC2VNJVjnHOhFJMMGP2kvmRj/l+zMA27Pjk1VMGhWYvKHMu/zT9+0mui/87vm3S18evnHGkHF/IFbNKiOvTs86QnDSvXbxTlKdPlSecW0rFQqpkyg0nIu+Zct0NRbkVLlwmTGWyei6Ti2WluGBKlb9WuMdNhbkVur6cgVRFsk4X56olmRtO5vjLo/DFu+WKyv86NZfBE3IKpErQn41Ge5T1NhhtXONproTfCxwPl5W8/lwIrfMkcOXuGU9LJFV6eLPyeD9UVkxIEsLkqy/bScV8ifPfV45Da0K5YlIyYerUin7x8+Ut1X/9/dvhGy1EIFVCCXdb3W7smM58PpJcSfPw6+Sz72QgVYxbV5xHiTmWliEx7conXRPzanS4dPhiuWVf4q8ixRzN2GeLo8yrq8Up6DKcK+470YKOpOOsWMwHFy4fPd/ltZwN11XtcpX80myKNCWveW90MZ27KtbB+uWq8bVc6srCeq4tKbgQarKtZ4rebXi6qmOuGp+dVGLlckcU7ETLAtTt2JFH0NcsC+ck6NWNr11zNSpvUh44VYy1EKrNBsPMrfPFt+a1VG9PFo8d+6Y9ejbZ4XwHGseOfdNG78rThP8WO/ZNO6tY6V7JVTN27Bs3fm+yarcMNhr/aGZC2y5BovyxsSOPYOjevgZyzqk+++wvzhkL3/OFKEWnsQOP4at+c125TPD6PJNY9KRTzlVp7Vxx7mrXMczs566cr8X6yRKW6vRQYknSzTwPbDasIuk2dsgRHXQKIdfuHbj+GDvgWNp3d3dnzet0rbriVkqqY3P100hrRy5dr6YsSWXqd38zl5RroCh78bXGIPfW5bEjjqijy+6Sr3lnKKwOv1ZTA7e+rKr1Nkc593W8vXlxY2U5AtfKlSJTz5b92UC5LPzYdGkI6tq2oXP3Q2/X6tvdQ+xQt8AH+8MLYZjgwT5LKkbD2HFuheRkaLyWk6280FzFyeL7ODODdvO7k+H9rB9VryzXzlOehltSaZGqZ4Oenr62tmr8yYzsv7ED3BrJSLtgTTHrxvgC3Ewyso6Fe6xMF5jWpw4ue9rT5E33QKqEHsWOMaqf79Emx+1Rz2jPJ2n6fW+UGFdKuLwVOdjYmtaUiSjzRBXbMTJNtap3UU3d7xld0SNMGEPUH8QOdCsMHrLKqiLN+3V7KS0suSiU99NNUSHme6OcTz6RM0UTq9+Sw+ajNZSSKuf2Wb7IE/HHDgbfKkdPX3q5El5r7WU27nWbR6ioavetVussdhAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAdfIfp5k1mSE7fEMAAAAASUVORK5CYII=">
  </div>

  <div>
    <div>
      <h1 class="welcome">Welcome</h1>
    </div>
    <div>
      <h2 class="join_today">Join today</h2>
    </div>
    <div>
      <div class="container">
        <button  class="google-signup" @click="toggleShowAccount"> <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg">Sign up with Google</button>
      </div>
      <div class="container">
        <button class="apple-signup" @click="toggleShowAccount"> <span><ion-icon class="apple-logo" name="logo-apple"></ion-icon></span>Sign up with Apple</button>
      </div>
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
  <Popup v-if="popupTriggers.SignInTrigger" :TogglePopup="() => TogglePopup('SignInTrigger')">
    <div class="Sign-Pop-Up">
      <h1 class="Bold-text">Sign in to Twitter</h1>
      <div class="input-wrap">
        <input type="text" id="sign-in-email" class="SignInput" required>
        <label for="sign-in-email">Email</label>
      </div>
      <button class="FormButton" @click="() => nextSignIn()">Next</button>
      <p style="color:#434343; font-size:small">Don't have an account? <button class="sign-link-button" @click="() => closeSignInOpenSignUp()">Sign up</button></p>
    </div>
  </Popup>
  <Popup v-if="popupTriggers.SignIn2Trigger" :TogglePopup="() => TogglePopup('SignIn2Trigger')">
    <div class="Sign-Pop-Up">
      <h1 class="Bold-text">Password</h1>
      <div class="input-wrap disabled-input">
        <input type="text" class="SignInput" id="sign-in-email-disabled" value="example@gmail.com" required disabled>
        <label for="sign-in-email-disabled">Email</label>
      </div>
      <div class="input-wrap">
        <input type="password" id="sign-in-pass" class="SignInput" required>
        <label for="sign-in-pass">Password</label>
      </div>
      <button class="FormButton">Log in</button>
      <p style="color:#434343; font-size:small">Don't have an account? <button class="sign-link-button" @click="() => closeSignInOpenSignUp()">Sign up</button></p>
    </div>
  </Popup>
  <create-account v-if="showCreateAccount" @close-page="toggleShowAccount" />
</template>
<script>
import { ref } from 'vue';
import CreateAccount from './create_account.vue'
import Popup from './Popup.vue';
export default {
  name: 'login',
  components: {
    CreateAccount,
    Popup,
  },
  setup () {
		const popupTriggers = ref({
			buttonTrigger: false,
      SignInTrigger:false,
		});

    const nextSignIn = () => {
      popupTriggers.value.SignInTrigger=false;
      popupTriggers.value.SignIn2Trigger=true;
    }

    const closeSignInOpenSignUp = () => {
      popupTriggers.value.SignInTrigger = false;
      popupTriggers.value.SignUpTrigger = true;
    }
		const TogglePopup = (trigger) => {
			popupTriggers.value[trigger] = !popupTriggers.value[trigger]
		}
		return {
			Popup,
			popupTriggers,
      closeSignInOpenSignUp,
			TogglePopup,
      nextSignIn
		}
	},
  data: () => ({
    showCreateAccount: false,
  }),
  methods: {
    toggleShowAccount(){
        this.showCreateAccount = !this.showCreateAccount
    },
  }
};
</script>
<style lang="scss" scoped>
.apple-logo{
  font-size:27.5px;
}
.login-text {
  text-align: center;
  color: white;
  font-family: Arial, Helvetica, sans-serif;

}
.text {
  font-family: Arial, Helvetica, sans-serif;
  padding: 0 10px;
  color: white;
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
  cursor: pointer;
  span{margin-right: 10px;}
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
  width:100%;
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
.FormButton{
  margin-bottom:10px;
  font-weight:bold;
}
.SignInput:focus+label,
.SignInput:disabled+label,
.SignInput:valid+label{
  font-size:small;
  top:3px;
  left:7px;
  padding:0 5px 0 5px;
}
.sign-link-button{
  border:none;
  background:none;
  color:#1da1f2;
  padding:0;
}
.Bold-text{
  font-weight: bold;
  color:white;
}
.DateofBirth{
  margin-bottom:20px;
}
</style>

