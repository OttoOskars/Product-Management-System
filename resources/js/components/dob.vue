<template>
    <div class="DOBselects">
        <div class="select-wrap Month">
            <select class="SignSelect" id="dob-month" v-model="selectedMonth" required>
                <option disabled></option>
                <option v-for="(month, index) in months" :key="index" :value="index + 1">{{ month }}</option>
            </select>
            <label for="dob-month">Month</label>
            <ion-icon class="chevron" name="chevron-down-outline"></ion-icon>
        </div>
        <div class="select-wrap Year">
            <select class="SignSelect" id="dob-year" v-model="selectedYear" required>
                <option disabled></option>
                <option v-for="year in getYearOptions()" :key="year" :value="year">{{ year }}</option>
            </select>
            <label for="dob-year">Year</label>
            <ion-icon class="chevron" name="chevron-down-outline"></ion-icon>
        </div>
        <div class="select-wrap Day">
            <select class="SignSelect" id="dob-day" v-model="selectedDay" required>
                <option disabled></option>
                <option v-for="day in days" :key="day" :value="day">{{ day }}</option>
            </select>
            <label for="dob-day">Day</label>
            <ion-icon class="chevron" name="chevron-down-outline"></ion-icon>
        </div>
    </div>
</template>
  
<script>
export default {
data() {
    return {
    selectedDay: null,
    selectedMonth: null,
    selectedYear: null
    };
},
computed: {
    days() {
    const daysInMonth = (year, month) => {
        if (month === 2) {
        // February
        return (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0)) ? 29 : 28;
        } else if ([4, 6, 9, 11].includes(month)) {
        // April, June, September, November
        return 30;
        } else {
        // All other months
        return 31;
        }
    };

    if (this.selectedYear && this.selectedMonth) {
        return [...Array(daysInMonth(this.selectedYear, this.selectedMonth)).keys()].map((day) => day + 1);
    } else {
        return [];
    }
    },
    months() {
    // An array of month names
    return [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    }
},
methods: {
    getYearOptions() {
    const currentYear = new Date().getFullYear();
    return [...Array(100).keys()].map((year) => currentYear - year);
    }
}
};
</script>
  
<style lang="scss" scoped>
.DateofBirth{
margin-bottom:40px;
}

.select-wrap{
    border: 1px solid #434343;
    border-radius:6px;
    font-family: Arial, sans-serif;
    position:relative;
    width:auto;
    height: auto;
    z-index: 2;

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
    .chevron{
        color:#434343;
        position:absolute;
        top:50%;
        right:10px;
        transform: translate(-50%, -50%);
        z-index: 1;
    }
}
.DOBselects{
display:flex;
flex-direction:row;
gap:5px;
    .Month{
        width:50%;
    }
    .Day{
        width:20%;
    }
    .Year{
        width:30%;
    }
    }
    .SignSelect{
    border-radius:6px;
    border:none;
    color:#ffffff;
    padding: 16px 8px;
    font-size:medium;
    outline:none;
    background: none;
    position:relative;
    top:8px;
    left:0px;
    width:100%;
    -moz-appearance:none !important;
    -webkit-appearance: none !important; 
    appearance: none !important;
    option:not(:checked) {
        color:#fff;
        background-color: #000;
        border:none;
    }
    option:checked {
        color:#fff;
        background-color: #1d1d1d;
        border:none;
    }
    option:hover {
        color:#fff;
        background-color: #1d1d1d !important;
        border:none;
    }
}
.SignSelect:focus+label,
.SignSelect:valid+label{
font-size:small;
top:3px;
left:7px;
padding:0 5px 0 5px;
}
</style>