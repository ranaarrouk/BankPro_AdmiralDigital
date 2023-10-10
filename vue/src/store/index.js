import {createStore} from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("Token"),
        },
        transactions: {
            data: [],
            loading: false,
            links: []
        },
        notification: {
            show: false,
            type: null,
            message: null
        }
    },
    getters: {},
    actions: {
        register({commit}, user) {
            return axiosClient.post('/register', user)
                .then((response) => {
                    commit('setUser', response.data);
                    return response;
                })
        },
        login({commit}, user) {
            return axiosClient.post('/login', user)
                .then((response) => {
                    commit('setUser', response.data);
                    return response
                });
        },
        logout({commit}) {
            commit('logout');
        },
        getTransactions({commit}, {url = null} = {}) {
            commit('setTransactionsLoading', true);
            url = url || '/transactions';
            return axiosClient.get(url)
                .then((response) => {
                    commit('setTransactions', response);
                    commit('setTransactionsLoading', false);
                    return response
                });
        },
        deposit({commit}, amount) {
            return axiosClient.post('/deposit/', amount)
                .then((response) => {
                    console.log(response);
                    commit('setBalance', response.data);
                    return response;
                });
        },
        transfer({commit}, data) {
            return axiosClient.post('/transfer', data)
                .then((response) => {
                    commit('setBalance', response.data);
                    return response;
                });
        }
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
        },
        setBalance: (state, response) => {
            state.user.data.balance = response.new_balance;
        },
        setUser: (state, response) => {
            state.user.data = response.data;
            state.user.token = response.data.token;
            sessionStorage.setItem('Token', response.data.token);
        },
        setTransactionsLoading: (state, loading) => {
            state.transactions.loading = loading;
        },
        setTransactions: (state, transactions) => {
            state.transactions.data = transactions.data;
            state.transactions.links = transactions.data.meta.links;
        },
        notify: (state, {type, message}) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 3000);
        }
    },
    modules: {},
});

export default store;
