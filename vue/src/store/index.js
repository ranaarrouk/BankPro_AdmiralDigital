import {createStore} from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("Token")
        },
    },
    getters: {},
    actions: {
        register({commit}, user) {
            return axiosClient.post('/register', user)
                .then((data) => {
                    commit('setUser', data);
                    return data;
                })
        }
        ,

        login({commit}, user) {
            return axiosClient.post('/login', user)
                .then((response) => {
                    commit('setUser', response);
                    return response
                });
        },
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
        },
        setUser: (state, response) => {
            state.user.data = response.data.user;
            state.user.token = response.data.token;
            sessionStorage.setItem('Token', response.data.token);
        },
    },
    modules: {},
});

export default store;
