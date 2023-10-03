<template>

    <div class="account-container">
        <div class="X-2">
            <button class="X" @click="$emit('close-page')"><font-awesome-icon :icon="['fas', 'xmark']" /></button>
        </div>
        <div class="heading_create">
            <h1>Create your account</h1>
        </div>
        <div>
            <div class="name">
                <input type="text" maxlength="50" placeholder="Name" class="account-input" style="padding-left: 10px;" v-model="name" />
            </div>
            <div class="email">
                <input type="email" maxlength="50" placeholder="Email" class="account-input" style="padding-left: 10px;" v-model="email" />
            </div>
            <div class="password">
                <input type="password" maxlength="50" placeholder="Password" class="account-input" style="padding-left: 10px;" v-model="password" />
            </div>
            <div class="confirm_password">
                <input type="password" maxlength="50" placeholder="Confirm password" class="account-input" style="padding-left: 10px;" v-model="confirmPassword" />
            </div>
            <div class="birth_date">
                <h3>Date of birth</h3>
                <p class="p">This will not be shown publicly. Confirm your own age, even if this account is for a business, a pet, or something else.</p>
            </div>
            <div>
                <div class="months">
                    <select class="select-1" v-model="month">
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
                    <select class="select-2" v-model="day">
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
                    <select class="select-3" v-model="year">
                        <option value="" disabled selected>Year</option>
                        <option id="year" v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>
                </div>
            </div>
            <div>
                <button class="next" v-bind:disabled="!allFieldsFilled">Next</button>
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
      years: Array.from({length: 121}, (_, i) => (1903 + i))
    };
  },
  computed: {
    allFieldsFilled() {
      return this.name && this.email && this.password && this.confirmPassword && this.month && this.day && this.year;
    },
  },
};
</script>
<style lang="scss" scoped>

</style>