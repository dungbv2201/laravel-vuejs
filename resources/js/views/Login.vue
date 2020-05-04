<template>
    <div class="row justify-content-center">
        <div class="col-3 card login">
            <h3 class="text-success text-center mb-4">Login In</h3>
            <div class="form-text text-danger mb-3" v-if="isInvalid">{{ isInvalid }}</div>
            <form>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email"
                           class="form-control"
                           v-model="credentials.email"
                           id="email">
                    <small class="form-text text-danger" v-if="errors && errors.email">{{errors.email[0]}}</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           class="form-control"
                           v-model="credentials.password"
                           id="password">
                    <small class="form-text text-danger" v-if="errors && errors.password">{{errors.password[0]}}</small>
                </div>
                <button type="submit" class="btn btn-primary" @click.prevent="login">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    import {loginApi} from '../api/user.api.js'

    export default {
        name: "Login",
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                },
                isInvalid: '',
                errors: {},
                loginApi
            }
        },
        methods: {
            login() {
                this.$store.dispatch('login', this.credentials)
                    .then(response => {
                        this.resetError()
                        this.isInvalid = ''
                        this.$router.push({name: 'user-list'})
                    })
                    .catch(error => {
                        this.setError(error)
                    })
            },
            resetError() {
                this.errors = {}
            },
            setError(res) {
                if (res.invalidEmailOrPassword) {
                    this.resetError()
                    this.isInvalid = res.msg
                } else {
                    this.isInvalid = ''
                    this.errors = res.errors
                }
            }
        }
    }
</script>

<style scoped>
    .login {
        padding: 40px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -60%);
    }
</style>
