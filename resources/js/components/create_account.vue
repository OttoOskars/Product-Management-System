<template>

    <div class="account-container">
        <div class="X-2">
            <button class="X" @click="$emit('close-page')"><ion-icon name="close" class="close"></ion-icon></button>
        </div>
        <div class="heading_create">
            <h1>Create your account</h1>
        </div>
        <div>
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
                <p v-if="invalidEmail" class="warning-1">Please enter a valid email address.</p>
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
                <p v-if="passwordsDoNotMatch" class="warning-2">Passwords do not match.</p>
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
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
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
                <button class="next" @click="validateForm" v-bind:disabled="!allFieldsFilled">Next</button>
            </div>
        </div>
    </div>

</template>

<script>
export default {
  name: 'account',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      month: '',
      day: '',
      year: '',
      years: Array.from({length: 121}, (_, i) => (1903 + i)),
      invalidEmail: false,
      passwordsDoNotMatch: false,
      isLabelActive: {
        name: false,
        email: false,
        password: false,
        confirmPassword: false,
      },
        isInputCommitted: {
        name: false,
        email: false,
        password: false,
        confirmPassword: false,
      },
    };
  },
  computed: {
    allFieldsFilled() {
      return this.name && this.email && this.password && this.confirmPassword && this.month && this.day && this.year;
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
  },
  methods: {
    validateForm() {
      this.invalidEmail = false;
      this.passwordsDoNotMatch = false;

      if (!this.email.includes('@')) {
        this.invalidEmail = true;
        setTimeout(() => { this.invalidEmail = false; }, 3000);
        return;
      }

      if (this.password !== this.confirmPassword) {
        this.passwordsDoNotMatch = true;
        setTimeout(() => { this.passwordsDoNotMatch = false; }, 3000);
        return;
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
  },
};
</script>
<style lang="scss" scoped>
    .close{
        font-size: 20px;
        color:white;
    }

    .warning-1 {
        position: absolute;
        top: 80%;
        left: 0;
        color: red;
        font-size: 12px;
    }

    .warning-2 {
        position: absolute;
        top: 100%;
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

</style>