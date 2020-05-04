<template>
    <div class="container">
        <div class="row">
            <ListComponent
                :fields="fields"
                :list-api="getListUsers"
                :deleteApi="deleteUserApi"
                :modal-title="modalTitle"
            >
                <h2>List Users</h2>
                <template v-slot:form="{ item }">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="name"
                                       v-model="item.name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       class="form-control"
                                       id="title"
                                       v-model="item.email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       v-model="item.password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirm" class="col-sm-2 col-form-label">Password Confirm</label>
                            <div class="col-sm-10">
                                <input type="password"
                                       class="form-control"
                                       id="password_confirm"
                                       v-model="item.password_confirm">
                            </div>
                        </div>
                    </form>
                </template>
            </ListComponent>
        </div>
    </div>
</template>

<script>
    import ListComponent from "../../components/ListComponent"
    import {getListUsers,deleteUserApi} from "../../api/user.api.js"

    export default {
        name: "PostHe",
        components: {
            ListComponent
        },
        data() {
            return {
                getListUsers,
                deleteUserApi,
                fields: [
                    {
                        name: 'id',
                        title: 'ID',
                        id: true

                    },
                    {
                        name: 'email',
                        title: 'Email'

                    },
                    {
                        name: 'name',
                        title: 'Name'

                    },
                    {
                        name: 'password',
                        title: 'Name'

                    }
                ],
                modalTitle: 'User'
            }
        }
    }
</script>

<style scoped>

</style>
