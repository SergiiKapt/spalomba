import {createStore} from 'vuex'
import axios from "axios";

const USER = (id) => `user/${id}`;
axios.defaults.baseURL = "http://eurolombard.ksask.net/api/";

export default createStore({
    state: {
        login: false,
        token: 'huy',
        users: {},
        user: {},
        userId: '',
        autUserId: '',
        role: 0,
        error: false,
        status: true,
        message:'',
    },
    mutations: {
        setToken(state, {token}) {
            state.token = token;
        },
        setUsers(state, {users}) {
            state.users = users;
        },
        setUserId(state, id) {
            state.userId = id;
        },
        setUser(state, user) {
            state.user = user;
        },
        setError(state, {error}) {
            state.error = error;
        },
        setMessage(state, {message}) {
            state.message = message;
        },

    },
    actions: {
        fetchLogin({commit}, loginData) {
            console.log('fetchLogin',loginData );

            return axios
                .post('login',loginData)
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        if (res.data.status === 'success') {
                            commit('setError', {error:false});
                            commit('setToken', {token: res.data.token});
                            console.log('setToken', res.data.token);
                        } else {
                            commit('setError', {error:true});
                            commit('setMessage', {message:res.data.message});
                        }
                    }
                })
                .catch(err => console.log('error', err));
        },

        fetchUsers({commit}, ) {
            axios.defaults.headers.common['Authorization'] = this._state.data.token;
            return axios
                .get('user')
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        if (res.data.status === 'success') {
                            commit('setError', {error:false});
                            commit('setUsers', {users: res.data.data})
                        } else {
                            commit('setError', {error:true});
                            commit('setMessage', {message:res.data.message});
                        }
                    }
                })
                .catch(err => console.log('error', err));

        },
        fetchUser({commit}, userId) {
            axios.defaults.headers.common['Authorization'] = this._state.data.token;
            console.log('userId');
            return axios
                .get(USER(userId))
                .then((res) => {
                    if (res.status === 200) {
                        console.log(res);
                        if (res.data.status === 'success') {

                            commit('setError', {error:false});
                            commit('setUser', {user: res.data.data});
                            console.log('setUser', this._state.data.user );
                        } else {
                            commit('setError', {error:true});
                            commit('setMessage', {message:res.data.message});
                        }
                    }
                })
                .catch(err => console.log('error', err));
        },
    },
    getters: {
        error: state => state.error,
    },
    modules: {},


})

export const $axios = axios.create();



