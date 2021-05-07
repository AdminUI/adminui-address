<template>
    <div class="test-red">It works!</div>
</template>

<script>
export default {
    mounted() {
        console.log("Testing this out");
    }
}
</script>

<style lang="scss" scoped>
.test-red {
    color: red;
}
</style>