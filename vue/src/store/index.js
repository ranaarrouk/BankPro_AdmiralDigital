import {createStore} from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("Token")
        },
        transactions: {
            data: [],
            loading: false
        }
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
        getTransactions({commit}) {
            commit('setTransactionsLoading', true);
            return axiosClient.get('/transactions')
                .then((response) => {
                    commit('setTransactions', response);
                    commit('setTransactionsLoading', false);
                    return response
                });
        }
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
        setTransactionsLoading: (state, loading) => {
            state.transactions.loading = loading;
        },
        setTransactions: (state, transactions) => {
            state.transactions.data = transactions.data;
        }
    },
    modules: {},
});

export default store;
