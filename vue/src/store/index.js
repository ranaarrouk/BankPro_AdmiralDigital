import {createStore} from "vuex";
import {Axios as axiosClient} from "axios";

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
    mutations: {},
    modules: {},
});

export default store;
