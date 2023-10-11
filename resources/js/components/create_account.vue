<template>
  <div class="account-background">
    <div class="account-container">
      <div class="X-2">
          <button class="X" @click="$emit('close-page')"><ion-icon name="close" class="close"></ion-icon></button>
      </div>
      <div class="heading_create">
          <h1>Create your account</h1>
      </div>
      <div>
        <form>
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
          <h3>Date of birth</h3>
          <p class="p">This will not be shown publicly. Confirm your own age, even if this account is for a business, a pet, or something else.</p>
        </div>
        <div>
          <div class="months">
            <select class="select-1" v-model="month" ref="selectEl">
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
        <div>
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
        return this.name &&this.username && this.email && this.password && this.confirmPassword && this.month && this.day && this.year;
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
      this.$refs.selectEl.style.color = "gray";
      this.$refs.selectDay.style.color = "gray";
      this.$refs.selectYear.style.color = "gray";
    },
    beforeDestroy() {
      document.removeEventListener('click', this.handleClickOutside);
    },
    watch: {
      month: function () {
        this.$refs.selectEl.style.color = "white";
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
.close{
  font-size: 20px;
  color:white;
}

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

.account-input {
  padding-top: 20px;
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
  color: blue;
}

.input-label.committed {
  color: gray;
}

.account-background{
  background:rgba(29, 161, 242, 0.1);
  z-index: 99;
  position: absolute;
  top: 0;
  left: 0;
  right:0;
  bottom:0;
}
.account-container {
  z-index: 100;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 500px;
  height: 700px;
  background-color: black;
  border-radius: 20px;
  font-family: Arial, Helvetica, sans-serif;
  color: white;
}

.heading_create {
  position: absolute;
  top: 20px;
  left: 40px;
}

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
}

.p {
  font-size: 12px;
  color: gray;
  width: 420px;
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
  border: 2px solid gray;
  outline: none;
}
  
.account-input:focus {
  border: 2px solid blue;
}

.account-input::-webkit-input-placeholder {
  color: gray;
}

.account-input:focus::-webkit-input-placeholder {
  color: blue;
}

select {
  border: 2px solid gray;
  background-color: black;
  height: 50px;
  border-radius: 10px;
  outline: none;
}

.select-1 {
  width: 200px;
}

.select-1:focus, .select-2:focus, .select-3:focus {
  border-color: blue;
}

.select-2 {
  width: 70px;
}

.select-3 {
  width: 130px;
}

.months {
  position: relative;
  top: 280px;
  left: 40px;
}

.days {
  position: relative;
  top: 230px;
  left: 250px;
}

.years {
  position: relative;
  top: 180px;
  left: 330px;
}

select option:disabled { display: none; }
select option { color: white; }

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

.X {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: black;
  display:flex;
  justify-content: center;
  align-items: center;
  border: none;
  cursor: pointer;
}

.X:hover {
  background-color: gray;
}

.X-2 {
  position: absolute;
  top: 10px;
  left: 10px;
}
</style>