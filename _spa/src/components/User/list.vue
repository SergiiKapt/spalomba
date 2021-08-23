<template>
    <div>
        <div v-if="!users.length">
            <h2> No users </h2>
        </div>
        <table v-else class="table__list">
            <h2>Users</h2>

            <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>info</th>
                <th><span class="btn btn__create">+</span></th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td >{{ user.first_name}}</td>
                <td >{{ user.last_name}}</td>
                <td >{{ user.email}}</td>
                <td >{{ user.info}}</td>
                <td>
                    <!--                    <router-link :to="{name: 'UserEdit', params: {id: user.id}}" class="btn btn__edit" >Edit</router-link>-->
                    <span class="btn btn__edit" @click="editUser(user.id)">Edit</span>
                    <span class="btn btn__delete">DELETE</span></td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            users: Object,
        },
        created() {
            console.log('list', this.users);
        },
        methods: {
            editUser(id) {
                this.$store.commit('setUserId', id);
                this.$router.push({name: 'UserEdit', params: {id: id}})
            }
        }
    }
</script>