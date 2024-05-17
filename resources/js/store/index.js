// import { defineStore } from "pinia";

// const useCustomer = defineStore("customer", {
//     state: () => ({
//         isLoading: false,
//     }),
//     getters: {
//     },
//     actions: {
//     },
// });
// export default useCustomer;


import Vuex from 'vuex'
const state = {
    loading: false,
}

const mutations = {
    setLoading(state, value) {
        state.loading = value
    },

}

const getters = {
    isLoading(state) {
        return state.loading
    },

}

export default new Vuex.Store({
    state,
    mutations,
    getters
})
