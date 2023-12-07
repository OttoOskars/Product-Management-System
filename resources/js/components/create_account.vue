<template>
  <div class="account-background">
    <div class="account-container">
      <div class="X-2">
          <button class="X" @click="$emit('close-page')"><ion-icon name="close" class="close"></ion-icon></button>
      </div>
      <div class="heading_create">
          <h1>Create your account</h1>
      </div>
      <div class="div-form">
        <form class="form">
          <div class="name">
            <div class="input-container">
              <input
                type="text"
                maxlength="50"
                class="account-input"
                style="padding-left: 10px;"
                v-model="name"
                @input="updateLabel('name')"
                @focus="moveLabelUp('name')"
                @blur="resetLabelPosition('name')"
              />
              <label class="input-label" :class="{ active: isLabelActive['name'], committed: isInputCommitted['name'] }">Name</label>
            </div>
            <p v-if="nameHasSpaces" class="warning">Name should not contain spaces.</p>
          </div>

          <div class="username">
            <div class="input-container">
              <input
                type="text"
                maxlength="50"
                class="account-input"
                style="padding-left: 10px;"
                v-model="username"
                @input="updateLabel('username')"
                @focus="moveLabelUp('username')"
                @blur="resetLabelPosition('username')"
              />
              <label class="input-label" :class="{ active: isLabelActive['username'], committed: isInputCommitted['username'] }">Username</label>
            </div>
            <p v-if="usernameHasSpaces" class="warning">Username should not contain spaces.</p>
            <p v-if="usernameError" class="warning">{{ usernameError }}</p>
          </div>

          <div class="email">
            <div class="input-container">
              <input
                  type="email"
                  maxlength="50"
                  class="account-input"
                  style="padding-left: 10px;"
                  v-model="email"
                  @input="updateLabel('email')"
                  @focus="moveLabelUp('email')"
                  @blur="resetLabelPosition('email')"
              />
              <label class="input-label" :class="{ active: isLabelActive['email'], committed: isInputCommitted['email'] }">Email</label>
            </div>
            <p v-if="invalidEmail" class="warning">Please enter a valid email address.</p>
            <p v-if="emailError" class="warning">{{ emailError }}</p>
          </div>

          <div class="password">
            <div class="input-container">
                <input
                    type="password"
                    maxlength="50"
                    class="account-input"
                    style="padding-left: 10px;"
                    v-model="password"
                    @input="updateLabel('password')"
                    @focus="moveLabelUp('password')"
                    @blur="resetLabelPosition('password')"
                />
                <label class="input-label" :class="{ active: isLabelActive['password'], committed: isInputCommitted['password'] }">Password</label>
            </div>
            <p v-if="passwordWarningVisible" class="warning">Password must be at least 8 characters long.</p>
          </div>

          <div class="confirm_password">
            <div class="input-container">
                <input
                    type="password"
                    maxlength="50"
                    class="account-input"
                    style="padding-left: 10px;"
                    v-model="confirmPassword"
                    @input="updateLabel('confirmPassword')"
                    @focus="moveLabelUp('confirmPassword')"
                    @blur="resetLabelPosition('confirmPassword')"
                />
                <label class="input-label" :class="{ active: isLabelActive['confirmPassword'], committed: isInputCommitted['confirmPassword'] }">Confirm Password</label>
            </div>
            <p v-if="passwordsDoNotMatch" class="warning">Passwords do not match.</p>
          </div>

          <div class="birth_date">
            <h3 class="date">Date of birth</h3>
            <p class="p">This will not be shown publicly. Confirm your own age, even if this account is for a business, a pet, or something else.</p>
          </div>
          <div class="time">
            <div class="months">
              <select class="select-1" v-model="month" ref="selectMonth">
                  <option value="" disabled selected>Month</option>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November">November</option>
                  <option value="December">December</option>
              </select>
            </div>
            <div class="days">
              <select class="select-2" v-model="day" ref="selectDay">
                  <option value="" disabled selected>Day</option>
                  <option v-for="day in daysInMonth" :key="day" :value="day">{{ day }}</option>
              </select>
            </div>
            <div class="years">
              <select class="select-3" v-model="year" ref="selectYear">
                  <option value="" disabled selected>Year</option>
                  <option id="year" v-for="year in years" :key="year" :value="year">{{ year }}</option>
              </select>
            </div>
          </div>
          <div class="submit-form">
            <button type="submit" class="next" @click="validateForm" v-bind:disabled="!allFieldsFilled">Create account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
export default {
  name: 'account',
  data() {
    return {
      name: '',
      username: '',
      email: '',
      password: '',
      confirmPassword: '',
      month: '',
      day: '',
      year: '',
      dob: '',
      years: Array.from({length: 121}, (_, i) => (1903 + i)),
      nameHasSpaces: false,
      usernameHasSpaces: false,
      invalidEmail: false,
      passwordWarningVisible: false,
      passwordsDoNotMatch: false,
      isLabelActive: {
        name: false,
        username: false,
        email: false,
        password: false,
        confirmPassword: false,
      },
        isInputCommitted: {
        name: false,
        username: false,
        email: false,
        password: false,
        confirmPassword: false,
      },
      emailError: '',
      usernameError: '',
      error:null,
    };
  },
  computed: {
    allFieldsFilled() {
      return this.name && this.username && this.email && this.password && this.confirmPassword && this.month && this.day && this.year;
    },
    daysInMonth() {
      if (["April", "June", "September", "November"].includes(this.month)) {
        return Array.from({ length: 30 }, (_, i) => i + 1);
      } else if (this.month === "February") {
        return Array.from({ length: 28 }, (_, i) => i + 1);
      } else {
        return Array.from({ length: 31 }, (_, i) => i + 1);
      }
    },
  },
  mounted() {
    document.addEventListener('click', this.handleClickOutside);
    this.$refs.selectMonth.style.color = "gray";
    this.$refs.selectDay.style.color = "gray";
    this.$refs.selectYear.style.color = "gray";
  },
  beforeDestroy() {
    document.removeEventListener('click', this.handleClickOutside);
  },
  watch: {
    month: function () {
      this.$refs.selectMonth.style.color = "white";
    },
    day: function () {
      this.$refs.selectDay.style.color = "white";
    },
    year: function () {
      this.$refs.selectYear.style.color = "white";
    },
    selectedMonth() {
      this.day = '';
    },
  },
  methods: {
    validateForm(e) {
      e.preventDefault()
      this.nameHasSpaces = false;
      this.usernameHasSpaces = false;
      this.invalidEmail = false;
      this.passwordsDoNotMatch = false;

      if (this.name.includes(' ')) {
        this.nameHasSpaces = true;
        setTimeout(() => { this.nameHasSpaces = false; }, 3000);
        return;
      }

      if (this.username.includes(' ')) {
        this.usernameHasSpaces = true;
        setTimeout(() => { this.usernameHasSpaces = false; }, 3000);
        return;
      }

      if (!emailRegex.test(this.email)) {
        this.invalidEmail = true;
        setTimeout(() => { this.invalidEmail = false; }, 3000);
        return;
      }

      if (this.password.length < 8) {
        this.passwordWarningVisible = true;
        setTimeout(() => {
          this.passwordWarningVisible = false;
        }, 3000);
        return;
      }

      if (this.password !== this.confirmPassword) {
        this.passwordsDoNotMatch = true;
        setTimeout(() => { this.passwordsDoNotMatch = false; }, 3000);
        return;
      }
      if (!this.nameHasSpaces && !this.usernameHasSpaces && !this.invalidEmail && !this.passwordsDoNotMatch) {
        this.registerUser();
      }
    },
    updateLabel(fieldName) {
        this.isLabelActive[fieldName] = this[fieldName].length > 0;
        this.isInputCommitted[fieldName] = false;
    },
    moveLabelUp(fieldName) {
        this.isLabelActive[fieldName] = true;
        this.isInputCommitted[fieldName] = false;
    },
    resetLabelPosition(fieldName) {
      if (this[fieldName].length === 0) {
        this.isLabelActive[fieldName] = false;
      }
      if (this[fieldName].length > 0) {
        this.isInputCommitted[fieldName] = true;
      }
    },
    handleClickOutside(event) {
        const inputContainer = this.$el.querySelector('.input-container');
        if (inputContainer && !inputContainer.contains(event.target)) {
          this.resetLabelPosition();
        }
    },
    async registerUser() {
      this.emailError = '';
      this.usernameError = '';

      try {
        const registrationData = {
          Name: this.name,
          UserTag: this.username,
          Email: this.email,
          Password: this.password,
          DOB: `${this.year}-${this.month}-${this.day}`,
        };
        const response = await this.$store.dispatch('register', registrationData);

        if (response.success) {
          this.$router.push('/home');
        } else {
          if (response.message.includes('Email')) {
            this.emailError = response.message;
            setTimeout(() => {
              this.emailError = '';
            }, 3000);
          }
          if (response.message.includes('Username')) {
            this.usernameError = response.message;
            setTimeout(() => {
              this.usernameError = '';
            }, 3000);
          }
        }
      } catch (error) {
        console.error(error);
      }
    },
  },
}
</script>
<style lang="scss" scoped>
.warning {
  position: absolute;
  top: 80%;
  left: 0;
  color: red;
  font-size: 12px;
}
.input-container {
  position: relative;
  display: inline-block;
}
.input-label {
  position: absolute;
  left: 10px;
  transition: 0.3s ease all;
  font-size: 15px;
  color: gray;
  pointer-events: none;
  top: 50%;
  transform: translateY(-50%);
}
.input-label.active {
  transform: translateY(-100%);
  font-size: 10px;
  color: #1D9BF0;
}
.input-label.committed {
  color: gray;
}
input[type="text"], input[type="password"], input[type="email"] {
  box-sizing: border-box;
  height: 50px;
  width: 420px;
  border-radius: 10px;
  background-color: black;
  color: white;
}
.account-input {
  border: 1px solid gray;
  outline: none;
  padding-top: 20px;
}
.account-input:focus {
  border: 1px solid #1D9BF0;
}
.account-input::-webkit-input-placeholder {
  color: gray;
}
.account-input:focus::-webkit-input-placeholder {
  color: #1D9BF0;
}
select {
  border: 1px solid gray;
  background-color: black;
  height: 50px;
  border-radius: 10px;
  outline: none;
}
select option:disabled { display: none; }
select option { color: white; }
///////////////////////////////////////////////////////////////////////////////////////////////////////
.account-background{
  background:rgba(29, 161, 242, 0.1);
  z-index: 99;
  position: fixed;
  top: 0;
  left: 0;
  right:0;
  bottom:0;
  .account-container {
    z-index: 100;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
    height: 670px;
    background-color: black;
    border-radius: 20px;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
    .X-2 {
      position: absolute;
      top: 13px;
      left: 13px;
      .X {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: black;
        display:flex;
        justify-content: center;
        align-items: center;
        border: none;
        cursor: pointer;
        .close{
          font-size: 20px;
          color:white;
        }
      }
      .X:hover {
        background-color: gray;
      }
    }
    .heading_create {
      position: absolute;
      top: 20px;
      left: 40px;
    }
    .div-form{
      .form{
        .name {
          position: relative;
          top: 100px;
          left: 40px;
          width: 420px;
        }
        .username {
          position: relative;
          top: 120px;
          left: 40px;
          width: 420px;
        }
        .email {
          position: relative;
          top: 140px;
          left: 40px;
          width: 420px;
        }
        .password {
          position: relative;
          top: 160px;
          left: 40px;
          width: 420px;
        }
        .confirm_password {
          position: relative;
          top: 180px;
          left: 40px;
          width: 420px;
        }
        .birth_date {
          position: absolute;
          top: 430px;
          left: 40px;
          .date {
            font-size: 18px;
          }
          .p {
            font-size: 12px;
            color: gray;
            width: 420px;
          }
        }
        .time{
          .months {
            position: relative;
            top: 280px;
            left: 40px;
            .select-1 {
              width: 200px;
            }
            .select-1:focus {
              border-color: #1D9BF0;
            }
          }
          .days {
            position: relative;
            top: 230px;
            left: 250px;
            .select-2 {
              width: 70px;
              &::-webkit-scrollbar{
                width:8px;
              }
              &::-webkit-scrollbar-thumb{
                  background-color: #2F3336;
                  border-radius: 5px;
                  border:none;
              }
              &::-webkit-scrollbar-track{
                  background:none;
                  border:none;
              }
              &:focus{
                  outline:none;
              }
            }
            .select-2:focus {
              border-color: #1D9BF0;
            }
          }
          .years {
            position: relative;
            top: 180px;
            left: 330px;
            .select-3 {
              width: 130px;
              &::-webkit-scrollbar{
                width:8px;
              }
              &::-webkit-scrollbar-thumb{
                  background-color: #2F3336;
                  border-radius: 5px;
                  border:none;
              }
              &::-webkit-scrollbar-track{
                  background:none;
                  border:none;
              }
              &:focus{
                  outline:none;
              }
            }
            .select-3:focus {
              border-color: #1D9BF0;
            }
          }
        }
        .submit-form{
          .next {
            background-color: deepskyblue;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            position: absolute;
            width: 420px;
            height: 50px;
            left: 40px;
            top: 600px;
            cursor: pointer;
          }

          .next:not(:disabled):hover {
            background-color: dodgerblue;
          }
        }
      }
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 1024px) {
  .account-background{
    .account-container {
      width: 450px;
      height: 560px;
      .X-2 {
        top: 12px;
        left: 12px;
        .X {
          width: 31px;
          height: 31px;
        }
      }
      .heading_create {
        top: 22px;
        left: 30px;
        font-size: 12px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 40px;
            width: 390px;
          }
          .name {
            top: 72px;
            left: 30px;
            width: 390px;
          }
          .username {
            top: 87px;
            left: 30px;
            width: 390px;
          }
          .email {
            top: 102px;
            left: 30px;
            width: 390px;
          }
          .password {
            top: 117px;
            left: 30px;
            width: 390px;
          }
          .confirm_password {
            top: 132px;
            left: 30px;
            width: 390px;
          }
          .birth_date {
            top: 330px;
            left: 30px;
            .date {
              font-size: 16px;
            }
            .p {
              font-size: 11px;
              width: 390px;
            }
          }
          .time{
            select {
              height: 40px;
              font-size: 12px;
            }
            .months {
              top: 230px;
              left: 30px;
              .select-1 {
                width: 170px;
              }
            }
            .days {
              top: 190px;
              left: 210px;
              .select-2 {
                width: 70px;
              }
            }
            .years {
              top: 150px;
              left: 290px;
              .select-3 {
                width: 130px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 12px;
              width: 390px;
              height: 40px;
              left: 30px;
              top: 500px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 12px;
    }
    .input-label.active {
      font-size: 9px;
    }
    .account-input {
      padding-top: 18px;
      font-size: 11px;
    }
    .warning {
      top: 80%;
      font-size: 10px;
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 650px) {
  .account-background{
    .account-container {
      width: 550px;
      height: 650px;
      .X-2 {
        top: 11px;
        left: 11px;
        .X {
          width: 30px;
          height: 30px;
        }
      }
      .heading_create {
        top: 10px;
        left: 40px;
        font-size: 14px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 50px;
            width: 470px;
          }
          .name {
            top: 70px;
            left: 40px;
            width: 470px;
          }
          .username {
            top: 85px;
            left: 40px;
            width: 470px;
          }
          .email {
            top: 100px;
            left: 40px;
            width: 470px;
          }
          .password {
            top: 115px;
            left: 40px;
            width: 470px;
          }
          .confirm_password {
            top: 130px;
            left: 40px;
            width: 470px;
          }
          .birth_date {
            top: 380px;
            left: 40px;
            .date {
              font-size: 18px;
            }
            .p {
              font-size: 13px;
              width: 470px;
            }
          }
          .time{
            select {
              height: 50px;
              font-size: 14px;
            }
            .months {
              top: 230px;
              left: 40px;
              .select-1 {
                width: 200px;
              }
            }
            .days {
              top: 180px;
              left: 250px;
              .select-2 {
                width: 90px;
              }
            }
            .years {
              top: 130px;
              left: 350px;
              .select-3 {
                width: 160px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 14px;
              width: 470px;
              height: 50px;
              left: 40px;
              top: 570px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 14px;
    }
    .input-label.active {
      font-size: 11px;
    }
    .account-input {
      padding-top: 18px;
      font-size: 13px;
    }
    .warning {
      top: 75%;
      font-size: 12px;
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 600px) {
  .account-background{
    .account-container {
      width: 500px;
      height: 600px;
      .X-2 {
        top: 10px;
        left: 10px;
        .X {
          width: 29px;
          height: 29px;
        }
      }
      .heading_create {
        top: 15px;
        left: 30px;
        font-size: 13px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 45px;
            width: 440px;
          }
          .name {
            top: 70px;
            left: 30px;
            width: 440px;
          }
          .username {
            top: 85px;
            left: 30px;
            width: 440px;
          }
          .email {
            top: 100px;
            left: 30px;
            width: 440px;
          }
          .password {
            top: 115px;
            left: 30px;
            width: 440px;
          }
          .confirm_password {
            top: 130px;
            left: 30px;
            width: 440px;
          }
          .birth_date {
            top: 350px;
            left: 30px;
            .date {
              font-size: 17px;
            }
            .p {
              font-size: 12px;
              width: 440px;
            }
          }
          .time{
            select {
              height: 45px;
              font-size: 13px;
            }
            .months {
              top: 230px;
              left: 30px;
              .select-1 {
                width: 190px;
              }
            }
            .days {
              top: 185px;
              left: 230px;
              .select-2 {
                width: 80px;
              }
            }
            .years {
              top: 140px;
              left: 320px;
              .select-3 {
                width: 150px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 13px;
              width: 440px;
              height: 45px;
              left: 30px;
              top: 530px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 13px;
    }
    .input-label.active {
      font-size: 10px;
    }
    .account-input {
      padding-top: 18px;
      font-size: 12px;
    }
    .warning {
      top: 80%;
      font-size: 11px;
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 550px) {
  .account-background{
    .account-container {
      width: 450px;
      height: 560px;
      .X-2 {
        top: 9px;
        left: 9px;
        .X {
          width: 28px;
          height: 28px;
        }
      }
      .heading_create {
        top: 15px;
        left: 30px;
        font-size: 12px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 40px;
            width: 390px;
          }
          .name {
            top: 70px;
            left: 30px;
            width: 390px;
          }
          .username {
            top: 85px;
            left: 30px;
            width: 390px;
          }
          .email {
            top: 100px;
            left: 30px;
            width: 390px;
          }
          .password {
            top: 115px;
            left: 30px;
            width: 390px;
          }
          .confirm_password {
            top: 130px;
            left: 30px;
            width: 390px;
          }
          .birth_date {
            top: 330px;
            left: 30px;
            .date {
              font-size: 16px;
            }
            .p {
              font-size: 11px;
              width: 390px;
            }
          }
          .time{
            select {
              height: 40px;
              font-size: 12px;
            }
            .months {
              top: 230px;
              left: 30px;
              .select-1 {
                width: 170px;
              }
            }
            .days {
              top: 190px;
              left: 210px;
              .select-2 {
                width: 70px;
              }
            }
            .years {
              top: 150px;
              left: 290px;
              .select-3 {
                width: 130px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 12px;
              width: 390px;
              height: 40px;
              left: 30px;
              top: 500px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 12px;
    }
    .input-label.active {
      font-size: 9px;
    }
    .account-input {
      padding-top: 18px;
      font-size: 11px;
    }
    .warning {
      top: 80%;
      font-size: 10px;
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 500px) {
  .account-background{
    .account-container {
      width: 400px;
      height: 560px;
      .X-2 {
        top: 8px;
        left: 8px;
        .X {
          width: 27px;
          height: 27px;
        }
      }
      .heading_create {
        top: 15px;
        left: 30px;
        font-size: 12px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 40px;
            width: 340px;
          }
          .name {
            top: 70px;
            left: 30px;
            width: 340px;
          }
          .username {
            top: 85px;
            left: 30px;
            width: 340px;
          }
          .email {
            top: 100px;
            left: 30px;
            width: 340px;
          }
          .password {
            top: 115px;
            left: 30px;
            width: 340px;
          }
          .confirm_password {
            top: 130px;
            left: 30px;
            width: 340px;
          }
          .birth_date {
            top: 330px;
            left: 30px;
            .date {
              font-size: 16px;
            }
            .p {
              font-size: 11px;
              width: 340px;
            }
          }
          .time{
            select {
              height: 40px;
              font-size: 12px;
            }
            .months {
              top: 230px;
              left: 30px;
              .select-1 {
                width: 150px;
              }
            }
            .days {
              top: 190px;
              left: 190px;
              .select-2 {
                width: 60px;
              }
            }
            .years {
              top: 150px;
              left: 260px;
              .select-3 {
                width: 110px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 12px;
              width: 340px;
              height: 40px;
              left: 30px;
              top: 500px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 12px;
    }
    .input-label.active {
      font-size: 9px;
    }
    .account-input {
      padding-top: 18px;
      font-size: 11px;
    }
    .warning {
      top: 80%;
      font-size: 10px;
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 450px) {
  .account-background{
    .account-container {
      width: 350px;
      height: 500px;
      .X-2 {
        top: 7px;
        left: 7px;
        .X {
          width: 26px;
          height: 26px;
        }
      }
      .heading_create {
        top: 15px;
        left: 20px;
        font-size: 10px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 35px;
            width: 310px;
          }
          .name {
            top: 60px;
            left: 20px;
            width: 310px;
          }
          .username {
            top: 75px;
            left: 20px;
            width: 310px;
          }
          .email {
            top: 90px;
            left: 20px;
            width: 310px;
          }
          .password {
            top: 105px;
            left: 20px;
            width: 310px;
          }
          .confirm_password {
            top: 120px;
            left: 20px;
            width: 310px;
          }
          .birth_date {
            top: 300px;
            left: 20px;
            .date {
              font-size: 14px;
            }
            .p {
              font-size: 10px;
              width: 310px;
            }
          }
          .time{
            select {
              height: 35px;
              font-size: 11px;
            }
            .months {
              top: 210px;
              left: 20px;
              .select-1 {
                width: 140px;
              }
            }
            .days {
              top: 175px;
              left: 170px;
              .select-2 {
                width: 50px;
              }
            }
            .years {
              top: 140px;
              left: 230px;
              .select-3 {
                width: 100px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 11px;
              width: 310px;
              height: 35px;
              left: 20px;
              top: 440px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 11px;
    }
    .input-label.active {
      font-size: 8px;
    }
    .account-input {
      padding-top: 16px;
      font-size: 10px;
    }
    .warning {
      top: 80%;
      font-size: 9px;
    }
  }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
@media (max-width: 400px) {
  .account-background{
    .account-container {
      width: 300px;
      height: 410px;
      .X-2 {
        top: 6px;
        left: 6px;
        .X {
          width: 25px;
          height: 25px;
        }
      }
      .heading_create {
        top: 18px;
        left: 15px;
        font-size: 9px;
      }
      .div-form{
        .form{
          input[type="text"], input[type="password"], input[type="email"] {
            height: 30px;
            width: 270px;
          }
          .name {
            top: 55px;
            left: 15px;
            width: 270px;
          }
          .username {
            top: 65px;
            left: 15px;
            width: 270px;
          }
          .email {
            top: 75px;
            left: 15px;
            width: 270px;
          }
          .password {
            top: 85px;
            left: 15px;
            width: 270px;
          }
          .confirm_password {
            top: 95px;
            left: 15px;
            width: 270px;
          }
          .birth_date {
            top: 240px;
            left: 15px;
            .date {
              font-size: 13px;
            }
            .p {
              font-size: 9px;
              width: 270px;
            }
          }
          .time{
            select {
              height: 30px;
              font-size: 10px;
            }
            .months {
              top: 160px;
              left: 15px;
              .select-1 {
                width: 130px;
              }
            }
            .days {
              top: 130px;
              left: 155px;
              .select-2 {
                width: 45px;
              }
            }
            .years {
              top: 100px;
              left: 210px;
              .select-3 {
                width: 75px;
              }
            }
          }
          .submit-form{
            .next {
              font-size: 10px;
              width: 270px;
              height: 30px;
              left: 15px;
              top: 360px;
            }
          }
        }
      }
    }
    .input-label {
      font-size: 10px;
    }
    .input-label.active {
      font-size: 7px;
    }
    .account-input {
      padding-top: 14px;
      font-size: 9px;
    }
    .warning {
      top: 75%;
      font-size: 8px;
    }
  }
}
</style>