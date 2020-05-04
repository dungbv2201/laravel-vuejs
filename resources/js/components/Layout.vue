<template>
    <div class="app-main">
        <HeaderComponent/>
        <RouterView :key="key"/>
    </div>
</template>

<script>
    import HeaderComponent from "./HeaderComponent";

    export default {
        name: "Layout",
        components: {HeaderComponent},
        computed: {
            key() {
                return this.$route.fullPath
            }
        }
    }
</script>

<style scoped>

</style>
