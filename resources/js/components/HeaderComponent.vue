<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Demo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <RouterLink v-for="link in links "
                            :key="link.routerName"
                            class="nav-item"
                            :to="{name: link.routerName}"
                            tag="li"
                            active-class="active"
                            exact>
                    <a class="nav-link">
                        {{ link.name }}
                    </a>
                </RouterLink>
            </ul>
            <button class="btn btn-outline-success mr-0" type="button" @click.prevent="logout">Logout</button>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "HeaderComponent",
        data() {
            return {
                links: [
                    {
                        name: 'User',
                        routerName: 'user-list'
                    }
                ]
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(response => {
                        this.$router.push({name: 'login'})
                    })
                    .catch(error => {

                    })
            },
        }
    }
</script>

<style scoped>

</style>
