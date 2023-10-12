<template>
    <div class="search-container">
      <div>
        <h1>Search</h1>
      </div>
    </div>
</template>
  
<script>
  export default {
    name: 'Search',
  };
</script>
  
<style lang="scss" scoped>
  .search-container {
    display: flex;
    width: 100%;
    height: 100%;
    background-color: aquamarine;
  }
  
  @media (max-width: 767px) {
    .search-container {
      flex-direction: column;
      width: 100%;
      height: 95%;
    }
  }
</style>  