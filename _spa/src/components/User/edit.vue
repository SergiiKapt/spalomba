<template>
    <div>edit
        <div v-if="user">
        <h2>Edit {{ user.first_name }}</h2>
            <p class="d-none" :class="{error: error}">{{message??this.$store.state.message}}</p>
            <form v-on:submit.prevent="submitForm">
        <label>first_name
            <input type="text" name="first_name" v-model="form.first_name" required />
        </label>
        <br>
        <label>last_name
            <input type="text" name="last_name" v-model="form.last_name" />
        </label>
        <br>
        <label>email
            <input type="email" name="email" v-model="form.email" required/>
        </label>
        <br>
        <label>info
            <input type="text" name="info" v-model="form.info" />
        </label>
        <br><br>
        <label>password
        <input  name="password" type="password" v-model="form.password" />
        </label>
        <br>
        <label>confirm password</label>
        <input name="confirm_pass" type="password" v-model="form.confirm_pass" />
        <br>
        <br>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

<!--    <div v-for="param in user" :key="user.id"></div>-->
</template>

<script>
    export default {
        name: 'edit-user',
        data() {
            return {
                form: {},
                user: false,
                error:false,
            }
        },
        created() {
            this.$store.dispatch('fetchUser', this.$router.currentRoute.value.params.id);

        },

        computed: {
            single() {
                console.log('user list', this.$store.state.user.user);
                return this.$store.state.user.user;
            }
        },
        watch: {
            single() {
                this.form = this.single;
                this.user = this.single;
            }
        },
        methods: {
            errorStore() {
                console.log('ERROR STATUS', this.$store.state.error);
                this.error = this.$store.state.error;
            },

            submitForm(){
                this.error = false;
                console.log(this.form.password)
                console.log(this.form.confirm_pass)
                if(!this.validateEmail(this.form.email)) {
                    this.message = 'email not validate';
                    this.error = true;
                }
                if(this.form.password) {
                    if(
                        this.form.password.length < 3
                        && this.form.confirm_pass.length < 3
                        && this.form.confirm_pass.length === this.form.password.length
                    ){
                        this.message = 'Password must more 3 chars end equel confirm';
                        this.error = true;
                    }
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
                await this.$store.dispatch('fetchUpdateUser', (this.form));
                this.message=this.$store.state.message;
                this.errorStore();
                if(!this.error) {
                    this.$router.push({ name: 'UserList'});
                }
            }
        }
    }
</script>