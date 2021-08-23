<template>
    <div class="about">
        <h1 :error="error">Dashboard</h1>
        <router-view/>


        <!--    <list-users :users="users"></list-users>-->
<!--        <users-list></users-list>-->

<!--        <router-view/>-->
    </div>
</template>

<script>
    // import Login from '@/components/Login.vue';
    // import UsersList from '@/components/User/index.vue';
    // import EditUser from '@/components/User/edit.vue';
    // import axiosInstance from '@/api/index'
    export default {
        name: 'Dashboard',
        components: {
            // UsersList,
            // currentUserComponent
            // EditUser
            // HelloWorld,
            // Login,

        },
        data() {
            return {
                email: '',
                password: '',
                message: 'login',
                info: null,
                error: 'error',
                user: {
                    id: 22
                }
                // users:'',
            }
        },

        // created() {
        //   this.$store.dispatch('fetchUsers');
        //
        // },

        // mounted() {
        // this.$store.dispatch('fetchCharacter');
        // axiosInstance
        //         .get('https://eurolombard.ksask.net/api/user')
        //         .then(response => (this.info = response));

        // .then(res => {
        //     console.log('native',res)
        //   })

        // .then(function(res) {
        //   console.log(res)
        //
        // })
        // }
    }
</script>
