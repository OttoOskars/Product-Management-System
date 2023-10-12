<template>
    <div class="tweets-container">
      <div>
        <h1>Tweets</h1>
      </div>
    </div>
</template>
  
<script>
  export default {
    name: 'Tweets',
  };
</script>
  
<style lang="scss" scoped>
  .tweets-container {
    display: flex;
    width: 100%;
    height: 100%;
    background-color: aqua;
  }
  
  @media (max-width: 767px) {
    .tweets-container {
      flex-direction: column;
      width: 100%;
      height: 95%;
    }
  }
</style>  