<template>
    <div>
        <div v-if="users.list">
            <div v-if="!users.list.length">
                <h2> No users </h2>
            </div>
            <user-list
                :users="users.list"
            />
        </div>
        <div v-else>
            <h2>Your DataInfo:</h2>
            <user-info
                :single="users"
            />
        </div>
    </div>
</template>

<script>
    import UserList from '@/components/User/list';
    import UserInfo from '@/components/User/info';
    export default {
        components: {UserList, UserInfo},
        name: 'UsersList',

        data() {
            return {
                // users: {}
            }
        },
        created() {
            this.$store.dispatch('fetchUsers');
        },
        computed: {
            users() {
                console.log('create users', this.users);

                return this.$store.state.users;
            }
        },
        methods: {

        }
    }
</script>
