<template>
    <div>
        <h2>Login</h2>
        <form v-on:submit.prevent="submitForm">
            <p class="d-none" :class="{error: error}">{{message??this.$store.state.message}}</p>
            <div>
                <label > Email <br>
                    <input type="email" name="email" required v-model="form.email">
                </label>
            </div>
            <br>
            <div>
                <label > Password <br>
                    <input type="password" name="password"  required v-model="form.password">
                </label>
            </div>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<script>


    export default {
        name: 'login',
        data() {
            return {
                error: this.$store.state.error,
                error_: false,
                formSubmit: true,
                form: {},
                message: 'login'
            }
        },
        methods: {
            errorStore() {
                console.log('ERROR STATUS', this.$store.state.error);
                this.error = this.$store.state.error;
            },

            submitForm(){
                this.error = false;
                if(!this.validateEmail(this.form.email)) {
                    this.message = 'email not validate';
                    this.error = true;
                }
                if(this.form.password.length <3) {
                    this.message = 'Password must more 3 chars';
                    this.error = true;
                }
                if(!this.error) {
                    this.sendLogin();
                }
            },

            validateEmail(email) {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            },

             async sendLogin ()
             {
                 await this.$store.dispatch('fetchLogin', (this.form));
                 this.message=this.$store.state.message;
                 this.errorStore();
                 if(!this.error) {
                     this.$router.push({ name: 'UserList'});
                 }
             }
        }
    }
</script>