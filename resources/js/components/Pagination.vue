<template>
    <nav aria-label="Page navigation ">
        <ul class="pagination justify-content-end">
            <li :class="['page-item',currentPage ===1 && 'disabled']">
                <a class="page-link"
                   :href="currentPage !==1 ?`${path}?page=${currentPage -1}`:''"
                   @click.prevent="updateCurrentPage(currentPage -1)"
                   tabindex="-1" aria-disabled="true">
                    Previous
                </a>
            </li>
            <li v-for="page in totalPage"
                :class="['page-item',currentPage === page&&'active']">
                <a class="page-link"
                   :href="`${path}?page=${page}`"
                   @click.prevent="updateCurrentPage(page)">
                    {{ page }}
                </a>
            </li>
            <li :class="['page-item',currentPage === totalPage && 'disabled']">
                <a class="page-link"
                   :href="currentPage !==totalPage ?`${path}?page=${currentPage +1}`:''"
                   @click.prevent="updateCurrentPage(currentPage +1)"
                   tabindex="-1" aria-disabled="true">
                    Next
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            path: {
                required: true,
                type: String
            },
            totalPage: {
                required: true,
                type: Number
            },
            currentPage: {
                required: true,
                type: Number
            }
        },
        methods: {
            updateCurrentPage(page) {
                this.$emit('updateCurrentPage', page)
            }
        }
    }
</script>

<style scoped>

</style>
