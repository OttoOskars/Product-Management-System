<template>
    <div class="asdf">
        Homepage
    </div>
</template>

<script>
export default {
    name: 'Home',
    data: () => ({
        showCreateAccount: false,
    }),
    methods: {
        toggleShowAccount(){
            this.showCreateAccount = !this.showCreateAccount
        },
    },
};

</script>
<style lang="scss" scoped>
.asdf{
    color: pink !important;
}
</style>
