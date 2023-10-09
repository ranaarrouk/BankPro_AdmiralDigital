import {createStore} from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("Token"),
            balance: 0
        },
        transactions: {
            data: [],
            loading: false
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
        logout({commit}) {
            commit('logout');
        },
        getTransactions({commit}) {
            commit('setTransactionsLoading', true);
            return axiosClient.get('/transactions')
                .then((response) => {
                    commit('setTransactions', response);
                    commit('setTransactionsLoading', false);
                    return response
                });
        },
        deposit({commit}, amount) {
            return axiosClient.post('/deposit/', amount)
                .then((response) => {

                    return response;
                });
        },
        transfer({commit}, data) {
            return axiosClient.post('/transfer', data)
                .then((response) => {

                    return response;
                });
        }
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            state.user.balance = 0;
        },
        setUser: (state, response) => {
            console.log(response);
            state.user.data = response.data;
            state.user.token = response.data.data.token;
            sessionStorage.setItem('Token', response.data.token);
        },
        setTransactionsLoading: (state, loading) => {
            state.transactions.loading = loading;
        },
        setTransactions: (state, transactions) => {
            state.transactions.data = transactions.data;
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
