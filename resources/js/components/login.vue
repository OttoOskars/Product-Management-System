<template>

    <div id="shadowBox">
      <h3 class="rainbow rainbow_text_animated">HELLO THERE!</h3>
      <h3 class="rainbow rainbow_text_animated">TWITTER</h3>
      <h3>{{ counter }}</h3>
    </div>

    <button @click="counter++">+</button>
    <button @click="counter--">-</button>
    <template v-if="counter > 0">
        <input  :value="input" type="text" @input="onInput">
    </template>
  </template>
  <script>
  export default {
    name: 'login',
    data() {
      return {
        input: null,
        counter: 0,
      }
    },
    methods: {
      onInput() {
        this.counter++;
      },
      decrement() {
        this.counter--;
      },
    },
  };
  </script>
  <style lang="scss" scoped>

  </style>

